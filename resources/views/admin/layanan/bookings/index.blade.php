@extends('layouts.admin')

@section('title', 'Kelola Ruangan')

@section('content')
    <!-- Page Header -->
    <div class="admin-main">
        <div class="admin-container">
            <div class="admin-page-header">
                <div class="admin-page-title">
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <a href="{{ route('dashboard') }}" style="display: flex; align-items: center; justify-content: center; width: 32px; height: 32px; background: #f3f4f6; border-radius: 8px; transition: all 0.2s; text-decoration: none;">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" style="color: #374151;">
                                <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/>
                            </svg>
                        </a>
                        <div>
                            <h1>KELOLA RUANGAN</h1>
                            <p>Manajemen ruangan Rumah BUMN</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search Bar -->
            <div class="admin-filter-bar">
                <form method="GET" action="{{ route('admin.rooms.index') }}" class="admin-filter-form">
                    <div class="admin-filter-group" style="flex: 1;">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari ruangan..." class="admin-input-search">
                    </div>
                    
                    <button type="submit" class="admin-btn-filter">Cari</button>
                    @if(request('search'))
                        <a href="{{ route('admin.rooms.index') }}" class="admin-btn-reset">Reset</a>
                    @endif
                </form>
            </div>

            <!-- Success Message -->
            @if(session('success'))
                <div class="admin-alert admin-alert-success">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            <!-- Rooms Table -->
            <div class="admin-table-container">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Gambar</th>
                            <th>Nama Ruangan</th>
                            <th>Lokasi</th>
                            <th>Kapasitas</th>
                            <th>Jam Operasional</th>
                            <th>Status</th>
                            <th>Total Booking</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rooms as $room)
                            <tr>
                                <td>
                                    <div class="admin-table-image">
                                        @if($room->image)
                                            <img src="{{ Storage::url($room->image) }}" alt="{{ $room->name }}">
                                        @else
                                            <div class="admin-table-image-placeholder">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                                    <path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11zM7 10h5v5H7z"/>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="admin-table-title">
                                        <h4>{{ $room->name }}</h4>
                                        <p>{{ Str::limit($room->description, 60) }}</p>
                                    </div>
                                </td>
                                <td>{{ $room->location ?? '-' }}</td>
                                <td>
                                    <span class="admin-badge admin-badge-info">
                                        {{ $room->capacity }} Orang
                                    </span>
                                </td>
                                <td>
                                    <div class="admin-table-date">
                                        <div>{{ \Carbon\Carbon::parse($room->available_from)->format('H:i') }}</div>
                                        <small>s/d {{ \Carbon\Carbon::parse($room->available_until)->format('H:i') }}</small>
                                    </div>
                                </td>
                                <td>
                                    <button class="admin-badge admin-badge-{{ $room->status }} admin-toggle-status" 
                                            data-id="{{ $room->id }}">
                                        @if($room->status === 'available')
                                            Tersedia
                                        @elseif($room->status === 'maintenance')
                                            Maintenance
                                        @else
                                            Tidak Tersedia
                                        @endif
                                    </button>
                                </td>
                                <td>
                                    <span class="admin-badge admin-badge-primary">
                                        {{ $room->bookings_count ?? 0 }} Booking
                                    </span>
                                </td>
                                <td>
                                    <div class="admin-table-actions">
                                        <a href="{{ route('admin.rooms.show', $room) }}" class="admin-btn-action admin-btn-view" title="Lihat">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>
                                            </svg>
                                        </a>
                                        <a href="{{ route('admin.rooms.edit', $room) }}" class="admin-btn-action admin-btn-edit" title="Edit">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
                                            </svg>
                                        </a>
                                        <form method="POST" action="{{ route('admin.rooms.destroy', $room) }}" style="display: inline;" 
                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus ruangan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="admin-btn-action admin-btn-delete" title="Hapus">
                                                <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                                                    <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="admin-table-empty">
                                    <div class="admin-empty-state">
                                        <svg width="48" height="48" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11zM7 10h5v5H7z"/>
                                        </svg>
                                        <h3>Belum ada ruangan</h3>
                                        <p>Mulai tambahkan ruangan pertama Anda</p>
                                        <a href="{{ route('admin.rooms.create') }}" class="admin-btn-primary">Tambah Ruangan</a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($rooms->hasPages())
                <div class="admin-pagination">
                    {{ $rooms->links() }}
                </div>
            @endif
        </div>
    </main>

    <script>
        // Toggle Status
        document.querySelectorAll('.admin-toggle-status').forEach(button => {
            button.addEventListener('click', function() {
                const roomId = this.dataset.id;
                const currentStatus = this.textContent.trim();
                
                let newStatus;
                if (currentStatus === 'Tersedia') {
                    newStatus = 'maintenance';
                } else if (currentStatus === 'Maintenance') {
                    newStatus = 'unavailable';
                } else {
                    newStatus = 'available';
                }
                
                fetch(`/admin/rooms/${roomId}/toggle-status`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                    },
                    body: JSON.stringify({ status: newStatus })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    }
                })
                .catch(error => console.error('Error:', error));
            });
        });
    </script>
        </div>
    </div>
@endsection
