@extends('layouts.admin')

@section('title', 'Detail Proposal - Admin Rumah BUMN')
@section('description', 'Detail lengkap proposal kegiatan')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">Detail Proposal</h1>
                    <p class="text-gray-600 mt-1">Review lengkap proposal kegiatan</p>
                </div>
                <a href="{{ route('admin.proposals.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg transition duration-200">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali ke Daftar
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <!-- Proposal Header -->
                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800">{{ $proposal->nama_kegiatan }}</h2>
                            <p class="text-gray-600 mt-1">Kode: #{{ $proposal->proposal_code }}</p>
                        </div>
                        <div class="text-right">
                            @switch($proposal->status)
                                @case('pending')
                                    <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        ⏳ Menunggu Review
                                    </span>
                                    @break
                                @case('approved')
                                    <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-800">
                                        ✅ Disetujui
                                    </span>
                                    @break
                                @case('rejected')
                                    <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full bg-red-100 text-red-800">
                                        ❌ Ditolak
                                    </span>
                                    @break
                            @endswitch
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="flex items-center">
                            @switch($proposal->kategori)
                                @case('pelatihan')
                                    <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full bg-blue-100 text-blue-800">
                                        🎓 Pelatihan
                                    </span>
                                    @break
                                @case('kerja_sama')
                                    <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full bg-purple-100 text-purple-800">
                                        🤝 Kerja Sama
                                    </span>  
                                    @break
                                @case('event')
                                    <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full bg-indigo-100 text-indigo-800">
                                        🎪 Event
                                    </span>
                                    @break
                            @endswitch
                        </div>
                        <div class="text-sm text-gray-600">
                            Diajukan: {{ $proposal->created_at->format('d M Y H:i') }}
                        </div>
                    </div>
                </div>

                <!-- Informasi Kegiatan -->
                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">📋 Informasi Kegiatan</h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Deskripsi Kegiatan</label>
                            <div class="mt-1 p-3 bg-gray-50 rounded-md">
                                <p class="text-gray-800 whitespace-pre-line">{{ $proposal->deskripsi_kegiatan }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Waktu & Peserta -->
                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">📅 Waktu & Peserta</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Tanggal Kegiatan</label>
                                <div class="mt-1 text-gray-800">
                                    {{ \Carbon\Carbon::parse($proposal->tanggal_kegiatan)->format('d F Y') }}
                                    <span class="text-sm text-gray-500">({{ \Carbon\Carbon::parse($proposal->tanggal_kegiatan)->diffForHumans() }})</span>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Waktu Pelaksanaan</label>
                                <div class="mt-1 text-gray-800">
                                    {{ $proposal->jam_mulai }} - {{ $proposal->jam_selesai }}
                                    <span class="text-sm text-gray-500">({{ $proposal->formatted_duration }})</span>
                                </div>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Estimasi Peserta</label>
                                <div class="mt-1 text-gray-800">{{ $proposal->estimasi_peserta }} orang</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Informasi Kontak -->
                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">👤 Informasi Kontak</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nama Penanggung Jawab</label>
                                <div class="mt-1 text-gray-800">{{ $proposal->contact_name }}</div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">No. Telepon</label>
                                <div class="mt-1 text-gray-800">{{ $proposal->contact_phone }}</div>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Email</label>
                                <div class="mt-1 text-gray-800">{{ $proposal->contact_email ?: '-' }}</div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Organisasi</label>
                                <div class="mt-1 text-gray-800">{{ $proposal->organisasi ?: '-' }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Catatan Admin -->
                @if($proposal->admin_notes)
                    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">📝 Catatan Admin</h3>
                        <div class="p-3 bg-gray-50 rounded-md">
                            <p class="text-gray-800 whitespace-pre-line">{{ $proposal->admin_notes }}</p>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <!-- File Proposal -->
                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">📄 File Proposal</h3>
                    
                    @if($proposal->proposal_file)
                        <div class="text-center">
                            <div class="mb-4">
                                <i class="fas fa-file-pdf text-6xl text-red-500"></i>
                            </div>
                            <div class="space-y-2">
                                <div class="text-sm font-medium text-gray-800">{{ $proposal->original_filename }}</div>
                                <div class="text-sm text-gray-600">{{ $proposal->formatted_file_size }}</div>
                                <a href="{{ route('proposal.download-file', $proposal) }}" 
                                   class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition duration-200">
                                    <i class="fas fa-download mr-2"></i>
                                    Download PDF
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="text-center text-gray-500">
                            <i class="fas fa-file-times text-4xl mb-2"></i>
                            <p>Tidak ada file yang diunggah</p>
                        </div>
                    @endif
                </div>

                <!-- Actions -->
                @if($proposal->status === 'pending')
                    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">⚡ Aksi</h3>
                        
                        <div class="space-y-3">
                            <button type="button" onclick="showApproveModal()" 
                                    class="w-full px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition duration-200">
                                <i class="fas fa-check mr-2"></i>
                                Setujui Proposal
                            </button>
                            <button type="button" onclick="showRejectModal()" 
                                    class="w-full px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition duration-200">
                                <i class="fas fa-times mr-2"></i>
                                Tolak Proposal
                            </button>
                        </div>
                    </div>
                @endif

                <!-- Riwayat Status -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">📊 Riwayat Status</h3>
                    
                    <div class="space-y-3">
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-blue-500 rounded-full mr-3"></div>
                            <div>
                                <div class="text-sm font-medium text-gray-800">Proposal Diajukan</div>
                                <div class="text-xs text-gray-600">{{ $proposal->created_at->format('d M Y H:i') }}</div>
                            </div>
                        </div>
                        
                        @if($proposal->status !== 'pending')
                            <div class="flex items-center">
                                <div class="w-3 h-3 {{ $proposal->status === 'approved' ? 'bg-green-500' : 'bg-red-500' }} rounded-full mr-3"></div>
                                <div>
                                    <div class="text-sm font-medium text-gray-800">
                                        {{ $proposal->status === 'approved' ? 'Proposal Disetujui' : 'Proposal Ditolak' }}
                                    </div>
                                    <div class="text-xs text-gray-600">{{ $proposal->updated_at->format('d M Y H:i') }}</div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Approve Modal -->
    <div id="approveModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <h3 class="text-lg font-medium text-gray-900">Setujui Proposal</h3>
                <form method="POST" action="{{ route('admin.proposals.approve', $proposal) }}">
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
                <form method="POST" action="{{ route('admin.proposals.reject', $proposal) }}">
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
        function showApproveModal() {
            document.getElementById('approveModal').classList.remove('hidden');
        }

        function showRejectModal() {
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