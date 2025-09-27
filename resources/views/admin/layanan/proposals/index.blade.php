@extends('layouts.admin')

@section('title', 'Kelola Proposal - Admin Rumah BUMN')
@section('description', 'Panel admin untuk mengelola proposal kegiatan')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">Kelola Proposal Kegiatan</h1>
                    <p class="text-gray-600 mt-1">Kelola semua proposal kegiatan yang masuk</p>
                </div>
                <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg transition duration-200">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali ke Dashboard
                </a>
            </div>
        </div>

        <!-- Stats Summary -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow-md p-6 text-center">
                <div class="text-3xl font-bold text-blue-600">{{ $proposals->total() }}</div>
                <div class="text-gray-600 mt-1">Total Proposal</div>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6 text-center">
                <div class="text-3xl font-bold text-yellow-600">{{ $proposals->where('status', 'pending')->count() }}</div>
                <div class="text-gray-600 mt-1">Menunggu Review</div>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6 text-center">
                <div class="text-3xl font-bold text-green-600">{{ $proposals->where('status', 'approved')->count() }}</div>
                <div class="text-gray-600 mt-1">Disetujui</div>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6 text-center">
                <div class="text-3xl font-bold text-red-600">{{ $proposals->where('status', 'rejected')->count() }}</div>
                <div class="text-gray-600 mt-1">Ditolak</div>
            </div>
        </div>

        <!-- Filters -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <form method="GET" class="grid grid-cols-1 md:grid-cols-5 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu Review</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Disetujui</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                    <select name="kategori" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Semua Kategori</option>
                        <option value="pelatihan" {{ request('kategori') == 'pelatihan' ? 'selected' : '' }}>Pelatihan</option>
                        <option value="kerja_sama" {{ request('kategori') == 'kerja_sama' ? 'selected' : '' }}>Kerja Sama</option>
                        <option value="event" {{ request('kategori') == 'event' ? 'selected' : '' }}>Event</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Kegiatan</label>
                    <input type="date" name="date" value="{{ request('date') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Pencarian</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari proposal..." class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="flex items-end">
                    <button type="submit" class="w-full px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md transition duration-200">
                        <i class="fas fa-search mr-2"></i>Filter
                    </button>
                </div>
            </form>
        </div>

        <!-- Proposals Table -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Proposal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kegiatan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pengaju</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">File</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($proposals as $proposal)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">#{{ $proposal->proposal_code }}</div>
                                        <div class="text-sm text-gray-500">{{ $proposal->created_at->format('d M Y H:i') }}</div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900">{{ Str::limit($proposal->nama_kegiatan, 50) }}</div>
                                    <div class="text-sm text-gray-500">Peserta: {{ $proposal->estimasi_peserta }} orang</div>
                                    <div class="text-sm text-gray-500">{{ $proposal->jam_mulai }} - {{ $proposal->jam_selesai }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @switch($proposal->kategori)
                                        @case('pelatihan')
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                                🎓 Pelatihan
                                            </span>
                                            @break
                                        @case('kerja_sama')
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-purple-100 text-purple-800">
                                                🤝 Kerja Sama
                                            </span>  
                                            @break
                                        @case('event')
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-indigo-100 text-indigo-800">
                                                🎪 Event
                                            </span>
                                            @break
                                    @endswitch
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($proposal->tanggal_kegiatan)->format('d M Y') }}</div>
                                    <div class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($proposal->tanggal_kegiatan)->diffForHumans() }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $proposal->contact_name }}</div>
                                    <div class="text-sm text-gray-500">{{ $proposal->contact_phone }}</div>
                                    @if($proposal->organisasi)
                                        <div class="text-sm text-gray-500">{{ $proposal->organisasi }}</div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    @if($proposal->proposal_file)
                                        <div class="flex flex-col items-center">
                                            <a href="{{ route('proposal.download-file', $proposal) }}" class="text-blue-600 hover:text-blue-900" title="Download File">
                                                <i class="fas fa-file-pdf text-lg"></i>
                                            </a>
                                            <span class="text-xs text-gray-500 mt-1">{{ $proposal->formatted_file_size }}</span>
                                        </div>
                                    @else
                                        <span class="text-gray-400">
                                            <i class="fas fa-minus"></i>
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @switch($proposal->status)
                                        @case('pending')
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                ⏳ Menunggu Review
                                            </span>
                                            @break
                                        @case('approved')
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                                ✅ Disetujui
                                            </span>
                                            @break
                                        @case('rejected')
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                                ❌ Ditolak
                                            </span>
                                            @break
                                    @endswitch
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('admin.proposals.show', $proposal) }}" class="text-blue-600 hover:text-blue-900" title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        @if($proposal->status === 'pending')
                                            <button type="button" onclick="showApproveModal('{{ $proposal->id }}')" class="text-green-600 hover:text-green-900" title="Setujui">
                                                <i class="fas fa-check"></i>
                                            </button>
                                            <button type="button" onclick="showRejectModal('{{ $proposal->id }}')" class="text-red-600 hover:text-red-900" title="Tolak">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-4 text-center text-gray-500">
                                    Tidak ada proposal ditemukan
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            @if($proposals->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $proposals->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </div>

    <!-- Approve Modal -->
    <div id="approveModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <h3 class="text-lg font-medium text-gray-900">Setujui Proposal</h3>
                <form id="approveForm" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Catatan Admin (Opsional)</label>
                        <textarea name="admin_notes" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Catatan persetujuan..."></textarea>
                    </div>
                    <div class="flex justify-center space-x-4 mt-6">
                        <button type="button" onclick="closeModal('approveModal')" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                            Batal
                        </button>
                        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                            Setujui
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Reject Modal -->
    <div id="rejectModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <h3 class="text-lg font-medium text-gray-900">Tolak Proposal</h3>
                <form id="rejectForm" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Alasan Penolakan <span class="text-red-500">*</span></label>
                        <textarea name="admin_notes" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500" placeholder="Jelaskan alasan penolakan..." required></textarea>
                    </div>
                    <div class="flex justify-center space-x-4 mt-6">
                        <button type="button" onclick="closeModal('rejectModal')" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                            Batal
                        </button>
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                            Tolak
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function showApproveModal(proposalId) {
            document.getElementById('approveForm').action = `/admin/proposals/${proposalId}/approve`;
            document.getElementById('approveModal').classList.remove('hidden');
        }

        function showRejectModal(proposalId) {
            document.getElementById('rejectForm').action = `/admin/proposals/${proposalId}/reject`;
            document.getElementById('rejectModal').classList.remove('hidden');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const approveModal = document.getElementById('approveModal');
            const rejectModal = document.getElementById('rejectModal');
            if (event.target == approveModal) {
                approveModal.classList.add('hidden');
            }
            if (event.target == rejectModal) {
                rejectModal.classList.add('hidden');
            }
        }
    </script>
@endsection