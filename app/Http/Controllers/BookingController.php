<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class BookingController extends Controller
{
    /**
     * Display available rooms for booking
     */
    public function index(): View
    {
        $rooms = Room::available()->orderBy('name')->get();
        
        return view('booking.index', compact('rooms'));
    }

    /**
     * Show booking form for specific room
     */
    public function create(Room $room): View
    {
        if (!$room->isAvailable()) {
            abort(404, 'Ruangan tidak tersedia');
        }

        $today = Carbon::today()->format('Y-m-d');
        $maxDate = Carbon::today()->addMonths(3)->format('Y-m-d');
        
        return view('booking.create', compact('room', 'today', 'maxDate'));
    }

    /**
     * Get bookings for a specific room and date (API endpoint)
     */
    public function getBookingsByDate(Room $room, Request $request)
    {
        $date = $request->query('date', now()->toDateString());
        
        $bookings = $room->bookings()
            ->whereDate('booking_date', $date)
            ->where('status', '!=', 'cancelled')
            ->orderBy('time_from')
            ->get(['contact_name', 'contact_phone', 'time_from', 'time_until', 'purpose', 'status']);
        
        return response()->json([
            'success' => true,
            'bookings' => $bookings->map(function ($booking) {
                return [
                    'name' => $booking->contact_name,
                    'phone' => substr($booking->contact_phone, 0, 4) . 'xxx' . substr($booking->contact_phone, -3), // Hide phone partially
                    'start_time' => date('H:i', strtotime($booking->time_from)),
                    'end_time' => date('H:i', strtotime($booking->time_until)),
                    'purpose' => $booking->purpose,
                    'status' => $booking->status,
                ];
            })
        ]);
    }
    public function getAvailableSlots(Request $request, Room $room)
    {
        $request->validate([
            'date' => 'required|date|after_or_equal:today'
        ]);

        $slots = $room->getAvailableTimeSlots($request->date);
        
        return response()->json([
            'success' => true,
            'slots' => $slots
        ]);
    }

    /**
     * Store a booking
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'booking_date' => 'required|date|after_or_equal:today',
            'time_from' => 'required|date_format:H:i',
            'time_until' => 'required|date_format:H:i|after:time_from',
            'contact_name' => 'required|string|max:255',
            'contact_phone' => 'required|string|max:20',
            'contact_email' => 'nullable|email|max:255',
            'organization' => 'nullable|string|max:255',
            'purpose' => 'required|string',
            'notes' => 'nullable|string'
        ]);

        $room = Room::findOrFail($request->room_id);

        // Additional validation: check if time is not in the past for today's bookings
        $bookingDateTime = Carbon::parse($request->booking_date . ' ' . $request->time_from);
        if ($bookingDateTime->isPast()) {
            return back()->withErrors(['time_from' => 'Tidak dapat booking waktu yang sudah berlalu.'])->withInput();
        }

        // Check if room is still available at requested time
        if ($room->isBookedAt($request->booking_date, $request->time_from, $request->time_until)) {
            return back()->withErrors(['time' => 'Waktu yang dipilih sudah dibooking.'])->withInput();
        }

        // Calculate duration (for information only, no pricing)
        $timeFrom = Carbon::createFromFormat('H:i', $request->time_from);
        $timeUntil = Carbon::createFromFormat('H:i', $request->time_until);
        $durationHours = $timeFrom->diffInMinutes($timeUntil) / 60; // More precise calculation

        // Generate booking code
        $bookingCode = 'BK-' . date('Ymd') . '-' . strtoupper(substr(md5(uniqid()), 0, 4));

        // Create booking
        $booking = Booking::create([
            'booking_code' => $bookingCode,
            'user_id' => auth()->id() ?? null, // Optional user if logged in
            'room_id' => $room->id,
            'booking_date' => $request->booking_date,
            'time_from' => $request->time_from,
            'time_until' => $request->time_until,
            'duration_hours' => $durationHours,
            'contact_name' => $request->contact_name,
            'contact_phone' => $request->contact_phone,
            'contact_email' => $request->contact_email,
            'organization' => $request->organization,
            'purpose' => $request->purpose,
            'notes' => $request->notes,
            'status' => 'pending'
        ]);

        return redirect()->route('booking.show', ['booking' => $booking->id])
            ->with('success', 'Booking berhasil dibuat! Silakan tunggu konfirmasi dari admin.');
    }

    /**
     * Show booking details by ID (public access)
     */
    public function show($bookingId): View
    {
        $booking = Booking::with('room', 'user')->findOrFail($bookingId);
        
        return view('booking.show', compact('booking'));
    }

    /**
     * Show user's bookings
     */
    public function myBookings(): View
    {
        $bookings = Booking::where('user_id', auth()->id())
            ->with('room')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('booking.my-bookings', compact('bookings'));
    }

    /**
     * Cancel a booking
     */
    public function cancel(Booking $booking): RedirectResponse
    {
        // Check if user can cancel this booking
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        if (!$booking->canBeCancelled()) {
            return back()->withErrors(['cancel' => 'Booking tidak dapat dibatalkan.']);
        }

        $booking->cancel();

        return back()->with('success', 'Booking berhasil dibatalkan.');
    }

    /**
     * Admin: Show all bookings
     */
    public function adminIndex(Request $request): View
    {
        $query = Booking::with(['room', 'user']);
        
        // Apply filters if provided
        if ($request->filled('status')) {
            $query->where('bookings.status', $request->status);
        }
        
        if ($request->filled('date')) {
            $query->whereDate('booking_date', $request->date);
        }
        
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('booking_code', 'like', "%{$search}%")
                  ->orWhere('contact_name', 'like', "%{$search}%")
                  ->orWhere('contact_phone', 'like', "%{$search}%")
                  ->orWhereHas('user', function($userQuery) use ($search) {
                      $userQuery->where('name', 'like', "%{$search}%");
                  });
            });
        }
        
        $bookings = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.bookings.index', compact('bookings'));
    }

    /**
     * Admin: Confirm a booking
     */
    public function confirm(Booking $booking): RedirectResponse
    {
        if (!$booking->canBeConfirmed()) {
            return back()->withErrors(['confirm' => 'Booking tidak dapat dikonfirmasi.']);
        }

        $booking->confirm();
        
        // Generate PDF bukti konfirmasi
        $this->generateConfirmationPdf($booking);

        return back()->with('success', 'Booking berhasil dikonfirmasi. Bukti PDF telah digenerate.');
    }

    /**
     * Admin: Reject/Cancel a booking
     */
    public function reject(Booking $booking): RedirectResponse
    {
        if ($booking->status === 'cancelled') {
            return back()->withErrors(['reject' => 'Booking sudah dibatalkan.']);
        }

        $booking->cancel();

        return back()->with('success', 'Booking berhasil ditolak.');
    }

    /**
     * Download booking confirmation as PDF
     */
    public function downloadPdf(Booking $booking)
    {
        $booking->load('room');
        
        $pdf = Pdf::loadView('pdf.booking-confirmation', compact('booking'))
            ->setPaper('a4', 'portrait')
            ->setOptions([
                'isHtml5ParserEnabled' => true,
                'isPhpEnabled' => true,
                'defaultFont' => 'sans-serif',
                'enable_font_subsetting' => true,
                'enable_remote' => false
            ]);
            
        $filename = 'Bukti-Booking-' . $booking->booking_code . '.pdf';
        
        return $pdf->download($filename);
    }
    
    /**
     * Generate PDF confirmation file after booking is confirmed
     */
    private function generateConfirmationPdf(Booking $booking): void
    {
        try {
            $booking->load('room');
            
            $pdf = Pdf::loadView('pdf.booking-confirmation', compact('booking'))
                ->setPaper('a4', 'portrait')
                ->setOptions([
                    'isHtml5ParserEnabled' => true,
                    'isPhpEnabled' => true,
                    'defaultFont' => 'sans-serif',
                    'enable_font_subsetting' => true,
                    'enable_remote' => false
                ]);
            
            // Buat direktori jika belum ada
            $pdfDirectory = storage_path('app/public/booking-confirmations');
            if (!file_exists($pdfDirectory)) {
                mkdir($pdfDirectory, 0755, true);
            }
            
            // Simpan PDF ke storage
            $filename = 'Bukti-Booking-' . $booking->booking_code . '.pdf';
            $filepath = $pdfDirectory . '/' . $filename;
            
            $pdf->save($filepath);
            
            // Update booking record dengan path PDF
            $booking->update([
                'confirmation_pdf_path' => 'booking-confirmations/' . $filename
            ]);
            
        } catch (\Exception $e) {
            // Log error tapi jangan mengganggu proses konfirmasi
            logger('Error generating PDF: ' . $e->getMessage());
        }
    }
}
