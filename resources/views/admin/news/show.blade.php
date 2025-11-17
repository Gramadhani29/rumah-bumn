<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $news->title }} - Dashboard Admin</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body class="dashboard-body">
    <!-- Admin Navbar -->
    <nav class="admin-navbar">
        <div class="admin-navbar-container">
            <div class="admin-navbar-left">
                <a href="{{ route('dashboard') }}" class="admin-navbar-brand">
                    <img src="{{ asset('images/Logo RBP.png') }}" alt="Logo Rumah BUMN" class="admin-navbar-logo">
                </a>
            </div>
            
            <div class="admin-navbar-right">
                <form method="POST" action="{{ route('logout') }}" class="admin-navbar-logout-form">
                    @csrf
                    <button type="submit" class="admin-navbar-logout-btn">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M17 7l-1.41 1.41L18.17 11H8v2h10.17l-2.58 2.59L17 17l5-5zM4 5h8V3H4c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h8v-2H4V5z"/>
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <main class="admin-main">
        <div class="admin-container">
            <div class="admin-page-header">
                <div class="admin-page-title">
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <a href="{{ route('admin.news.index') }}" style="display: flex; align-items: center; justify-content: center; width: 32px; height: 32px; background: #f3f4f6; border-radius: 8px; transition: all 0.2s; text-decoration: none;">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" style="color: #374151;">
                                <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/>
                            </svg>
                        </a>
                        <div>
                            <h1>DETAIL BERITA</h1>
                            <p>Rumah BUMN Telkom Pekalongan</p>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- News Detail Content -->
    <main class="admin-main">
        <div class="admin-container">
            <!-- Action Bar -->
            <div class="admin-action-bar">
                <div class="admin-action-left">
                    <h2>{{ $news->title }}</h2>
                    <div class="admin-news-meta">
                        <span class="admin-badge admin-badge-{{ $news->category }}">{{ $news->category_label }}</span>
                        <span class="admin-badge admin-badge-{{ $news->status }}">{{ ucfirst($news->status) }}</span>
                        @if($news->is_featured)
                            <span class="admin-badge admin-badge-featured">Featured</span>
                        @endif
                    </div>
                </div>
                <div class="admin-action-right">
                    <a href="{{ route('admin.news.edit', $news) }}" class="admin-btn-primary">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
                        </svg>
                        Edit Berita
                    </a>
                </div>
            </div>

            <!-- News Content -->
            <div class="admin-news-detail">
                <div class="admin-news-detail-grid">
                    <!-- Main Content -->
                    <div class="admin-news-content">
                        <!-- Featured Image -->
                        @if($news->image)
                            <div class="admin-news-image">
                                <img src="{{ $news->image_url }}" alt="{{ $news->title }}">
                            </div>
                        @endif

                        <!-- Content -->
                        <div class="admin-news-body">
                            <div class="admin-news-excerpt">
                                <h3>Ringkasan</h3>
                                <p>{{ $news->excerpt }}</p>
                            </div>

                            <div class="admin-news-full-content">
                                <h3>Konten Lengkap</h3>
                                <div class="admin-content">
                                    {!! nl2br(e($news->content)) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div class="admin-news-sidebar">
                        <!-- Info Card -->
                        <div class="admin-sidebar-card">
                            <h4>Informasi Berita</h4>
                            <div class="admin-info-list">
                                <div class="admin-info-item">
                                    <label>Penulis</label>
                                    <span>{{ $news->author->name }}</span>
                                </div>
                                <div class="admin-info-item">
                                    <label>Kategori</label>
                                    <span>{{ $news->category_label }}</span>
                                </div>
                                <div class="admin-info-item">
                                    <label>Status</label>
                                    <span class="admin-badge admin-badge-{{ $news->status }}">{{ ucfirst($news->status) }}</span>
                                </div>
                                <div class="admin-info-item">
                                    <label>Tanggal Dibuat</label>
                                    <span>{{ $news->created_at->format('d M Y, H:i') }}</span>
                                </div>
                                @if($news->published_at)
                                    <div class="admin-info-item">
                                        <label>Tanggal Publikasi</label>
                                        <span>{{ $news->published_at->format('d M Y, H:i') }}</span>
                                    </div>
                                @endif
                                <div class="admin-info-item">
                                    <label>Views</label>
                                    <span>{{ number_format($news->views) }}</span>
                                </div>
                                <div class="admin-info-item">
                                    <label>Featured</label>
                                    <span>{{ $news->is_featured ? 'Ya' : 'Tidak' }}</span>
                                </div>
                                <div class="admin-info-item">
                                    <label>Slug</label>
                                    <span class="admin-slug">{{ $news->slug }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Actions Card -->
                        <div class="admin-sidebar-card">
                            <h4>Aksi</h4>
                            <div class="admin-action-list">
                                <a href="{{ route('admin.news.edit', $news) }}" class="admin-action-btn edit">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
                                    </svg>
                                    Edit Berita
                                </a>
                                
                                <button class="admin-action-btn toggle-status" data-id="{{ $news->id }}">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                    </svg>
                                    {{ $news->status === 'published' ? 'Unpublish' : 'Publish' }}
                                </button>
                                
                                <button class="admin-action-btn toggle-featured" data-id="{{ $news->id }}">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                    </svg>
                                    {{ $news->is_featured ? 'Unfeature' : 'Feature' }}
                                </button>
                                
                                <form method="POST" action="{{ route('admin.news.destroy', $news) }}" 
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="admin-action-btn delete">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/>
                                        </svg>
                                        Hapus Berita
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Get CSRF token
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Toggle Status
        document.querySelector('.toggle-status').addEventListener('click', function() {
            const newsId = this.dataset.id;
            const button = this;
            
            // Disable button during request
            button.disabled = true;
            button.style.opacity = '0.6';
            
            fetch(`/admin/news/${newsId}/toggle-status`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert('Gagal mengubah status: ' + (data.message || 'Unknown error'));
                    button.disabled = false;
                    button.style.opacity = '1';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat mengubah status');
                button.disabled = false;
                button.style.opacity = '1';
            });
        });

        // Toggle Featured
        document.querySelector('.toggle-featured').addEventListener('click', function() {
            const newsId = this.dataset.id;
            const button = this;
            
            // Disable button during request
            button.disabled = true;
            button.style.opacity = '0.6';
            
            fetch(`/admin/news/${newsId}/toggle-featured`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert('Gagal mengubah featured: ' + (data.message || 'Unknown error'));
                    button.disabled = false;
                    button.style.opacity = '1';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat mengubah featured status');
                button.disabled = false;
                button.style.opacity = '1';
            });
        });
    </script>
</body>
</html>