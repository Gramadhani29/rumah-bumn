<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Rumah BUMN Telkom Pekalongan</title>
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
                    <h1>DASHBOARD ADMIN</h1>
                    <p>Rumah BUMN Telkom Pekalongan</p>
                </div>
            </div>
            
            <div class="admin-header-right">
                <div class="admin-user-info">
                    <span class="admin-welcome">Selamat datang, {{ Auth::user()->name }}</span>
                    <div class="admin-actions">
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

    <!-- Dashboard Content -->
    <main class="admin-main">
        <div class="admin-container">
            <!-- Stats Cards -->
            <div class="admin-stats-grid">
                <div class="admin-stat-card">
                    <div class="admin-stat-icon users">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M16 7c0-2.21-1.79-4-4-4S8 4.79 8 7s1.79 4 4 4 4-1.79 4-4zm-4 6c-2.67 0-8 1.34-8 4v3h16v-3c0-2.66-5.33-4-8-4z"/>
                        </svg>
                    </div>
                    <div class="admin-stat-content">
                        <h3>Total Pengunjung</h3>
                        <p class="admin-stat-number">{{ number_format($stats['total_visitors']) }}</p>
                        <span class="admin-stat-change {{ $stats['visitors_change_percent'] >= 0 ? 'positive' : 'negative' }}">
                            {{ $stats['visitors_change_percent'] >= 0 ? '+' : '' }}{{ number_format($stats['visitors_change_percent'], 1) }}% dari bulan lalu
                        </span>
                    </div>
                </div>

                <div class="admin-stat-card">
                    <div class="admin-stat-icon content">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 2 2h8c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/>
                        </svg>
                    </div>
                    <div class="admin-stat-content">
                        <h3>Artikel/Berita</h3>
                        <p class="admin-stat-number">{{ $stats['total_articles'] }}</p>
                        <span class="admin-stat-change neutral">
                            {{ $stats['draft_articles'] }} draft tersimpan, 
                            {{ $stats['published_articles'] }} dipublikasikan
                        </span>
                    </div>
                </div>

                <div class="admin-stat-card">
                    <div class="admin-stat-icon bookings">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11zM7 10h5v5H7z"/>
                        </svg>
                    </div>
                    <div class="admin-stat-content">
                        <h3>Total Booking</h3>
                        <p class="admin-stat-number">{{ $stats['total_bookings'] }}</p>
                        <span class="admin-stat-change {{ $stats['bookings_change_percent'] >= 0 ? 'positive' : 'negative' }}">
                            {{ $stats['bookings_change_percent'] >= 0 ? '+' : '' }}{{ number_format($stats['bookings_change_percent'], 1) }}% dari bulan lalu
                        </span>
                    </div>
                </div>

                <div class="admin-stat-card">
                    <div class="admin-stat-icon pending">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.94-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/>
                        </svg>
                    </div>
                    <div class="admin-stat-content">
                        <h3>Pending Review</h3>
                        <p class="admin-stat-number">{{ $stats['pending_bookings'] }}</p>
                        <span class="admin-stat-change neutral">
                            Butuh konfirmasi admin
                        </span>
                    </div>
                </div>

                <div class="admin-stat-card">
                    <div class="admin-stat-icon proposals">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M9 11H7v6h2v-6zm4 0h-2v6h2v-6zm4 0h-2v6h2v-6zm2.5-9H19V1h-2v1H7V1H5v1H4.5C3.11 2 2.02 3.09 2.02 4.5L2 19.5C2 20.91 3.11 22 4.5 22h15c1.39 0 2.5-1.09 2.5-2.5v-15C22 3.09 20.89 2 19.5 2zM19.5 19.5h-15V8h15v11.5z"/>
                        </svg>
                    </div>
                    <div class="admin-stat-content">
                        <h3>Total Proposal</h3>
                        <p class="admin-stat-number">{{ $stats['total_proposals'] ?? 0 }}</p>
                        <span class="admin-stat-change neutral">
                            {{ $stats['pending_proposals'] ?? 0 }} menunggu review
                        </span>
                    </div>
                </div>

                <div class="admin-stat-card">
                    <div class="admin-stat-icon rooms">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M20 2H4c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zM6 4h5v8l-2.5-1.5L6 12V4z"/>
                        </svg>
                    </div>
                    <div class="admin-stat-content">
                        <h3>Total Ruangan</h3>
                        <p class="admin-stat-number">{{ $stats['total_rooms'] }}</p>
                        <span class="admin-stat-change neutral">
                            @if($stats['popular_room'])
                                Populer: {{ $stats['popular_room']->name }}
                            @else
                                Semua ruangan tersedia
                            @endif
                        </span>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="admin-quick-actions">
                <h2>Aksi Cepat</h2>
                <div class="admin-actions-grid">
                    <a href="{{ route('admin.news.index') }}" class="admin-action-card">
                        <div class="admin-action-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 2 2h8c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/>
                            </svg>
                        </div>
                        <h3>Kelola Berita</h3>
                        <p>Buat dan kelola artikel berita</p>
                    </a>

                    <a href="{{ route('admin.bookings.index') }}" class="admin-action-card">
                        <div class="admin-action-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11zM7 10h5v5H7z"/>
                            </svg>
                        </div>
                        <h3>Kelola Booking</h3>
                        <p>Lihat dan konfirmasi reservasi</p>
                    </a>

                    <a href="{{ route('admin.proposals.index') }}" class="admin-action-card">
                        <div class="admin-action-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M14 2H6c-1.1 0-2 .9-2 2v16c0 1.1.89 2 2 2h12c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/>
                            </svg>
                        </div>
                        <h3>Kelola Proposal</h3>
                        <p>Review proposal kegiatan yang masuk</p>
                    </a>

                    <a href="{{ route('admin.rooms.index') }}" class="admin-action-card">
                        <div class="admin-action-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M20 2H4c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zM6 4h5v8l-2.5-1.5L6 12V4z"/>
                            </svg>
                        </div>
                        <h3>Kelola Ruangan</h3>
                        <p>Tambah dan edit ruangan</p>
                    </a>

                    <a href="{{ route('admin.marketplace.index') }}" class="admin-action-card">
                        <div class="admin-action-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M7 18c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12L8.1 13h7.45c.75 0 1.41-.41 1.75-1.03L21.7 4H5.21l-.94-2H1zm16 16c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/>
                            </svg>
                        </div>
                        <h3>Kelola Marketplace</h3>
                        <p>Kelola produk dan pesanan UMKM</p>
                    </a>

                    <a href="#" class="admin-action-card">
                        <div class="admin-action-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                            </svg>
                        </div>
                        <h3>Pengaturan</h3>
                        <p>Konfigurasi website</p>
                    </a>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="admin-recent-activity">
                <h2>Aktivitas Terbaru</h2>
                <div class="admin-activity-list">
                    <div class="admin-activity-item">
                        <div class="admin-activity-icon new">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                        </div>
                        <div class="admin-activity-content">
                            <p><strong>Produk baru</strong> "Batik Pekalongan Premium" ditambahkan</p>
                            <span class="admin-activity-time">2 jam yang lalu</span>
                        </div>
                    </div>

                    <div class="admin-activity-item">
                        <div class="admin-activity-icon booking">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2z"/>
                            </svg>
                        </div>
                        <div class="admin-activity-content">
                            <p><strong>Booking baru</strong> dari Sari Wulandari untuk konsultasi bisnis</p>
                            <span class="admin-activity-time">3 jam yang lalu</span>
                        </div>
                    </div>

                    <div class="admin-activity-item">
                        <div class="admin-activity-icon article">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 2 2h8c1.1 0 2-.9 2-2V8l-6-6z"/>
                            </svg>
                        </div>
                        <div class="admin-activity-content">
                            <p><strong>Artikel</strong> "Program Digitalisasi UMKM 2025" dipublikasikan</p>
                            <span class="admin-activity-time">1 hari yang lalu</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
