@extends('layouts.admin')

@section('title', 'Kelola Berita')

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
                            <h1>KELOLA BERITA</h1>
                            <p>Manajemen artikel dan berita Rumah BUMN</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filter Bar -->
            <div class="admin-filter-bar">
                <form method="GET" action="{{ route('admin.news.index') }}" class="admin-filter-form">
                    <div class="admin-filter-group">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari berita..." class="admin-input-search">
                    </div>
                    
                    <div class="admin-filter-group">
                        <select name="status" class="admin-select">
                            <option value="">Semua Status</option>
                            <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Published</option>
                            <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                        </select>
                    </div>
                    
                    <div class="admin-filter-group">
                        <select name="category" class="admin-select">
                            <option value="">Semua Kategori</option>
                            <option value="program-utama" {{ request('category') === 'program-utama' ? 'selected' : '' }}>Program Utama</option>
                            <option value="pelatihan" {{ request('category') === 'pelatihan' ? 'selected' : '' }}>Pelatihan</option>
                            <option value="prestasi" {{ request('category') === 'prestasi' ? 'selected' : '' }}>Prestasi</option>
                            <option value="kemitraan" {{ request('category') === 'kemitraan' ? 'selected' : '' }}>Kemitraan</option>
                            <option value="event" {{ request('category') === 'event' ? 'selected' : '' }}>Event</option>
                        </select>
                    </div>
                    
                    <button type="submit" class="admin-btn-filter">Filter</button>
                    <a href="{{ route('admin.news.index') }}" class="admin-btn-reset">Reset</a>
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

            <!-- News Table -->
            <div class="admin-table-container">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Gambar</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Status</th>
                            <th>Featured</th>
                            <th>Views</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($news as $item)
                            <tr>
                                <td>
                                    <div class="admin-table-image">
                                        <img src="{{ $item->image_url }}" alt="{{ $item->title }}">
                                    </div>
                                </td>
                                <td>
                                    <div class="admin-table-title">
                                        <h4>{{ $item->title }}</h4>
                                        <p>{{ Str::limit($item->excerpt, 60) }}</p>
                                    </div>
                                </td>
                                <td>
                                    <span class="admin-badge admin-badge-{{ $item->category }}">
                                        {{ $item->category_label }}
                                    </span>
                                </td>
                                <td>
                                    <button class="admin-badge admin-badge-{{ $item->status }} admin-toggle-status" 
                                            data-id="{{ $item->id }}">
                                        {{ ucfirst($item->status) }}
                                    </button>
                                </td>
                                <td>
                                    <button class="admin-toggle-featured {{ $item->is_featured ? 'featured' : '' }}" 
                                            data-id="{{ $item->id }}">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                        </svg>
                                    </button>
                                </td>
                                <td>{{ number_format($item->views) }}</td>
                                <td>
                                    <div class="admin-table-date">
                                        <div>{{ $item->created_at->format('d M Y') }}</div>
                                        <small>{{ $item->created_at->format('H:i') }}</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="admin-table-actions">
                                        <a href="{{ route('admin.news.show', $item) }}" class="admin-btn-action admin-btn-view" title="Lihat">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>
                                            </svg>
                                        </a>
                                        <a href="{{ route('admin.news.edit', $item) }}" class="admin-btn-action admin-btn-edit" title="Edit">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
                                            </svg>
                                        </a>
                                        <form method="POST" action="{{ route('admin.news.destroy', $item) }}" style="display: inline;" 
                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">
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
                                            <path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 2 2h8c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/>
                                        </svg>
                                        <h3>Belum ada berita</h3>
                                        <p>Mulai buat berita pertama Anda</p>
                                        <a href="{{ route('admin.news.create') }}" class="admin-btn-primary">Tambah Berita</a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($news->hasPages())
                <div class="admin-pagination">
                    {{ $news->links() }}
                </div>
            @endif
        </div>
    </main>

    <script>
        // Toggle Status
        document.querySelectorAll('.admin-toggle-status').forEach(button => {
            button.addEventListener('click', function() {
                const newsId = this.dataset.id;
                
                fetch(`/admin/news/${newsId}/toggle-status`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        this.textContent = data.status.charAt(0).toUpperCase() + data.status.slice(1);
                        this.className = `admin-badge admin-badge-${data.status} admin-toggle-status`;
                    }
                });
            });
        });

        // Toggle Featured
        document.querySelectorAll('.admin-toggle-featured').forEach(button => {
            button.addEventListener('click', function() {
                const newsId = this.dataset.id;
                
                fetch(`/admin/news/${newsId}/toggle-featured`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        this.classList.toggle('featured', data.is_featured);
                    }
                });
            });
        });
    </script>
        </div>
    </div>
@endsection