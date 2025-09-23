<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Berita - Dashboard Admin</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body class="dashboard-body">
    <!-- Admin Header -->
    <header class="admin-header">
        <div class="admin-container">
            <div class="admin-header-left">
                <img src="{{ asset('images/Logo RBP.png') }}" alt="Logo RBP" class="admin-logo">
                <div class="admin-title">
                    <h1>KELOLA BERITA</h1>
                    <p>Rumah BUMN Telkom Pekalongan</p>
                </div>
            </div>
            
            <div class="admin-header-right">
                <div class="admin-user-info">
                    <span class="admin-welcome">Selamat datang, {{ Auth::user()->name }}</span>
                    <div class="admin-actions">
                        <a href="{{ route('dashboard') }}" class="admin-btn-back">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/>
                            </svg>
                            Dashboard
                        </a>
                        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                            @csrf
                            <button type="submit" class="admin-btn-logout">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M17 7l-1.41 1.41L18.17 11H8v2h10.17l-2.58 2.59L17 17l5-5zM4 5h8V3H4c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h8v-2H4V5z"/>
                                </svg>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- News Management Content -->
    <main class="admin-main">
        <div class="admin-container">
            <!-- Action Bar -->
            <div class="admin-action-bar">
                <div class="admin-action-left">
                    <h2>Daftar Berita</h2>
                    <p>Kelola semua artikel dan berita website</p>
                </div>
                <div class="admin-action-right">
                    <a href="{{ route('admin.news.create') }}" class="admin-btn-primary">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
                        </svg>
                        Tambah Berita
                    </a>
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
</body>
</html>