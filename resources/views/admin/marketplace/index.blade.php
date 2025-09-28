@extends('layouts.admin')

@section('title', 'Kelola Marketplace')

@section('content')
<div class="marketplace-dashboard">
    <!-- Header -->
    <div class="dashboard-header">
        <div class="header-content">
            <h1 class="page-title">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="title-icon">
                    <path d="M7 18c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12L8.1 13h7.45c.75 0 1.41-.41 1.75-1.03L21.7 4H5.21l-.94-2H1zm16 16c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/>
                </svg>
                Kelola Marketplace
            </h1>
            <p class="page-subtitle">Dashboard untuk mengelola produk dan pesanan marketplace UMKM</p>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon products">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                </svg>
            </div>
            <div class="stat-content">
                <div class="stat-number">{{ $totalProducts }}</div>
                <div class="stat-label">Total Produk</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon orders">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M9 11H7v6h2v-6zm4 0h-2v6h2v-6zm4 0h-2v6h2v-6zm2.5-8H18V1h-2v2H8V1H6v2H4.5C3.12 3 2 4.12 2 5.5v14C2 20.88 3.12 22 4.5 22h15c1.38 0 2.5-1.12 2.5-2.5v-14C22 4.12 20.88 3 19.5 3z"/>
                </svg>
            </div>
            <div class="stat-content">
                <div class="stat-number">{{ $totalOrders }}</div>
                <div class="stat-label">Total Pesanan</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon umkms">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                </svg>
            </div>
            <div class="stat-content">
                <div class="stat-number">{{ $totalUmkms }}</div>
                <div class="stat-label">UMKM Aktif</div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="quick-actions">
        <div class="section-header">
            <h2 class="section-title">Aksi Cepat</h2>
        </div>
        <div class="action-grid">
            <a href="{{ route('admin.marketplace.products.create') }}" class="action-card primary">
                <div class="action-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
                    </svg>
                </div>
                <div class="action-content">
                    <h3>Tambah Produk</h3>
                    <p>Tambahkan produk baru dari UMKM</p>
                </div>
            </a>

            <a href="{{ route('admin.marketplace.orders') }}" class="action-card secondary">
                <div class="action-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6z"/>
                    </svg>
                </div>
                <div class="action-content">
                    <h3>Kelola Pesanan</h3>
                    <p>Lihat dan kelola semua pesanan</p>
                </div>
            </a>

            <a href="{{ route('admin.marketplace.products') }}" class="action-card tertiary">
                <div class="action-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M4 6H2v14c0 1.1.9 2 2 2h14v-2H4V6zm16-4H8c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-1 9H9V9h10v2zm-4 4H9v-2h6v2z"/>
                    </svg>
                </div>
                <div class="action-content">
                    <h3>Kelola Produk</h3>
                    <p>Edit dan kelola produk existing</p>
                </div>
            </a>
        </div>
    </div>

    <!-- Recent Activities -->
    <div class="recent-activities">
        <div class="activities-grid">
            <!-- Recent Orders -->
            <div class="activity-card">
                <div class="card-header">
                    <h3 class="card-title">Pesanan Terbaru</h3>
                    <a href="{{ route('admin.marketplace.orders') }}" class="view-all">Lihat Semua</a>
                </div>
                <div class="activity-list">
                    @forelse($recentOrders as $order)
                        <div class="activity-item">
                            <div class="activity-avatar">
                                <div class="avatar-placeholder">
                                    {{ $order->user ? substr($order->user->name, 0, 1) : 'U' }}
                                </div>
                            </div>
                            <div class="activity-content">
                                <div class="activity-title">{{ $order->event_name }}</div>
                                <div class="activity-subtitle">{{ $order->user ? $order->user->name : 'User deleted' }}</div>
                                <div class="activity-meta">{{ $order->created_at->diffForHumans() }}</div>
                            </div>
                            <div class="activity-status">
                                <span class="status-badge {{ $order->status }}">{{ ucfirst($order->status) }}</span>
                            </div>
                        </div>
                    @empty
                        <div class="empty-state">
                            <p>Belum ada pesanan terbaru</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Recent Products -->
            <div class="activity-card">
                <div class="card-header">
                    <h3 class="card-title">Produk Terbaru</h3>
                    <a href="{{ route('admin.marketplace.products') }}" class="view-all">Lihat Semua</a>
                </div>
                <div class="activity-list">
                    @forelse($recentProducts as $product)
                        <div class="activity-item">
                            <div class="activity-avatar">
                                @if($product->main_image)
                                    <img src="{{ asset('images/products/' . $product->main_image) }}" alt="{{ $product->name }}" class="product-thumb">
                                @else
                                    <div class="avatar-placeholder">P</div>
                                @endif
                            </div>
                            <div class="activity-content">
                                <div class="activity-title">{{ Str::limit($product->name, 30) }}</div>
                                <div class="activity-subtitle">{{ $product->umkm ? $product->umkm->name : 'UMKM not found' }}</div>
                                <div class="activity-meta">{{ $product->created_at->diffForHumans() }}</div>
                            </div>
                            <div class="activity-status">
                                <span class="price">{{ $product->formatted_price }}</span>
                            </div>
                        </div>
                    @empty
                        <div class="empty-state">
                            <p>Belum ada produk terbaru</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.marketplace-dashboard {
    padding: 2rem;
}

.dashboard-header {
    margin-bottom: 2rem;
}

.header-content {
    background: white;
    padding: 2rem;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
}

.page-title {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-size: 1.75rem;
    font-weight: 700;
    color: #1a202c;
    margin-bottom: 0.5rem;
}

.title-icon {
    color: #0098ff;
}

.page-subtitle {
    color: #64748b;
    font-size: 1rem;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.stat-card {
    background: white;
    padding: 1.5rem;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    display: flex;
    align-items: center;
    gap: 1rem;
}

.stat-icon {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
}

.stat-icon.products { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
.stat-icon.orders { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); }
.stat-icon.umkms { background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); }

.stat-number {
    font-size: 1.75rem;
    font-weight: 800;
    color: #1a202c;
}

.stat-label {
    color: #64748b;
    font-size: 0.875rem;
}

.quick-actions {
    margin-bottom: 2rem;
}

.section-header {
    margin-bottom: 1rem;
}

.section-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: #1a202c;
}

.action-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1.5rem;
}

.action-card {
    background: white;
    padding: 1.5rem;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    display: flex;
    align-items: center;
    gap: 1rem;
    text-decoration: none;
    color: inherit;
    transition: all 0.3s ease;
}

.action-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
}

.action-icon {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
}

.action-card.primary .action-icon { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
.action-card.secondary .action-icon { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); }
.action-card.tertiary .action-icon { background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); }

.action-content h3 {
    font-size: 1rem;
    font-weight: 600;
    color: #1a202c;
    margin-bottom: 0.25rem;
}

.action-content p {
    color: #64748b;
    font-size: 0.875rem;
}

.recent-activities {
    margin-bottom: 2rem;
}

.activities-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
    gap: 1.5rem;
}

.activity-card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
}

.card-header {
    display: flex;
    justify-content: between;
    align-items: center;
    padding: 1.5rem 1.5rem 1rem;
    border-bottom: 1px solid #e2e8f0;
}

.card-title {
    font-size: 1.125rem;
    font-weight: 600;
    color: #1a202c;
}

.view-all {
    color: #0098ff;
    text-decoration: none;
    font-size: 0.875rem;
    font-weight: 500;
}

.activity-list {
    padding: 1rem 1.5rem 1.5rem;
}

.activity-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 0.75rem 0;
    border-bottom: 1px solid #f1f5f9;
}

.activity-item:last-child {
    border-bottom: none;
}

.activity-avatar {
    width: 40px;
    height: 40px;
    border-radius: 8px;
    overflow: hidden;
    flex-shrink: 0;
}

.avatar-placeholder {
    width: 100%;
    height: 100%;
    background: #0098ff;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
}

.product-thumb {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.activity-content {
    flex: 1;
}

.activity-title {
    font-weight: 600;
    color: #1a202c;
    font-size: 0.875rem;
}

.activity-subtitle {
    color: #64748b;
    font-size: 0.75rem;
    margin-top: 0.125rem;
}

.activity-meta {
    color: #94a3b8;
    font-size: 0.75rem;
    margin-top: 0.125rem;
}

.status-badge {
    font-size: 0.75rem;
    font-weight: 600;
    padding: 0.25rem 0.5rem;
    border-radius: 6px;
    text-transform: capitalize;
}

.status-badge.pending { background: #fef3c7; color: #92400e; }
.status-badge.confirmed { background: #d1fae5; color: #065f46; }
.status-badge.completed { background: #dbeafe; color: #1e40af; }
.status-badge.cancelled { background: #fee2e2; color: #991b1b; }

.price {
    font-weight: 600;
    color: #0098ff;
    font-size: 0.875rem;
}

.empty-state {
    text-align: center;
    padding: 2rem;
    color: #94a3b8;
}

@media (max-width: 768px) {
    .marketplace-dashboard {
        padding: 1rem;
    }
    
    .stats-grid {
        grid-template-columns: 1fr;
    }
    
    .action-grid {
        grid-template-columns: 1fr;
    }
    
    .activities-grid {
        grid-template-columns: 1fr;
    }
}
</style>
@endsection