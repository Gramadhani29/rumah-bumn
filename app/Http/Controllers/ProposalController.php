<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ProposalController extends Controller
{
    /**
     * Display proposal form
     */
    public function create(): View
    {
        $today = Carbon::today()->format('Y-m-d');
        $maxDate = Carbon::today()->addMonths(6)->format('Y-m-d');
        
        return view('layanan.proposal.create', compact('today', 'maxDate'));
    }

    /**
     * Store a new proposal
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'deskripsi_kegiatan' => 'required|string',
            'kategori' => 'required|in:pelatihan,kerja_sama,event',
            'tanggal_kegiatan' => 'required|date|after:today',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'estimasi_peserta' => 'required|integer|min:1|max:1000',
            'contact_name' => 'required|string|max:255',
            'contact_phone' => 'required|string|max:20',
            'contact_email' => 'nullable|email|max:255',
            'organisasi' => 'nullable|string|max:255',
            'kebutuhan_khusus' => 'nullable|string',
            'proposal_file' => 'nullable|file|mimes:pdf|max:10240' // 10MB max
        ]);

        // Handle file upload
        $proposalFile = null;
        $originalFilename = null;
        $fileSize = null;
        
        if ($request->hasFile('proposal_file')) {
            $file = $request->file('proposal_file');
            $originalFilename = $file->getClientOriginalName();
            $fileSize = $file->getSize();
            
            // Generate unique filename
            $filename = 'proposal_' . time() . '_' . Str::random(10) . '.pdf';
            $proposalFile = $file->storeAs('proposals', $filename, 'public');
        }

        $proposal = Proposal::create([
            'nama_kegiatan' => $request->nama_kegiatan,
            'deskripsi_kegiatan' => $request->deskripsi_kegiatan,
            'kategori' => $request->kategori,
            'tanggal_kegiatan' => $request->tanggal_kegiatan,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'estimasi_peserta' => $request->estimasi_peserta,
            'contact_name' => $request->contact_name,
            'contact_phone' => $request->contact_phone,
            'contact_email' => $request->contact_email,
            'organisasi' => $request->organisasi,
            'kebutuhan_khusus' => $request->kebutuhan_khusus,
            'proposal_file' => $proposalFile,
            'original_filename' => $originalFilename,
            'file_size' => $fileSize,
            'user_id' => auth()->id()
        ]);

        return redirect()->route('proposal.show', $proposal->proposal_code)
            ->with('success', 'Proposal kegiatan berhasil diajukan! Kami akan menghubungi Anda untuk konfirmasi.');
    }

    /**
     * Show proposal details
     */
    public function show(string $proposalCode): View
    {
        $proposal = Proposal::where('proposal_code', $proposalCode)
            ->with('user')
            ->firstOrFail();
        
        return view('layanan.proposal.show', compact('proposal'));
    }

    /**
     * Show user's proposals (requires auth)
     */
    public function myProposals(): View
    {
        $proposals = Proposal::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('layanan.proposal.my-proposals', compact('proposals'));
    }

    /**
     * Cancel a proposal
     */
    public function cancel(Proposal $proposal): RedirectResponse
    {
        // Check if user can cancel this proposal
        if ($proposal->user_id !== auth()->id()) {
            abort(403);
        }

        if (!$proposal->canBeCancelled()) {
            return back()->withErrors(['cancel' => 'Proposal tidak dapat dibatalkan.']);
        }

        $proposal->cancel();

        return back()->with('success', 'Proposal berhasil dibatalkan.');
    }

    /**
     * Admin: Show all proposals
     */
    public function adminIndex(Request $request): View
    {
        $query = Proposal::with('user');
        
        // Apply filters if provided
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }
        
        if ($request->filled('date')) {
            $query->whereDate('tanggal_kegiatan', $request->date);
        }
        
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('proposal_code', 'like', "%{$search}%")
                  ->orWhere('nama_kegiatan', 'like', "%{$search}%")
                  ->orWhere('contact_name', 'like', "%{$search}%")
                  ->orWhere('contact_phone', 'like', "%{$search}%")
                  ->orWhere('organisasi', 'like', "%{$search}%");
            });
        }
        
        $proposals = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.layanan.proposals.index', compact('proposals'));
    }

    /**
     * Admin: Show single proposal detail
     */
    public function adminShow(Proposal $proposal): View
    {
        return view('admin.layanan.proposals.show', compact('proposal'));
    }

    /**
     * Admin: Approve a proposal
     */
    public function approve(Proposal $proposal, Request $request): RedirectResponse
    {
        $request->validate([
            'admin_notes' => 'nullable|string'
        ]);

        $proposal->approve($request->admin_notes);

        return back()->with('success', 'Proposal berhasil disetujui.');
    }

    /**
     * Admin: Reject a proposal
     */
    public function reject(Proposal $proposal, Request $request): RedirectResponse
    {
        $request->validate([
            'admin_notes' => 'required|string'
        ]);

        $proposal->reject($request->admin_notes);

        return back()->with('success', 'Proposal berhasil ditolak.');
    }

    /**
     * Download proposal file
     */
    public function downloadFile(Proposal $proposal)
    {
        if (!$proposal->proposal_file || !file_exists(storage_path('app/public/' . $proposal->proposal_file))) {
            abort(404, 'File tidak ditemukan');
        }

        return response()->download(
            storage_path('app/public/' . $proposal->proposal_file),
            $proposal->original_filename ?: 'proposal.pdf'
        );
    }
}
