@extends('layouts.admin')

@section('title', 'Kelola Marketplace')

@section('content')
<div class="admin-main">
    <div class="admin-container">
        <!-- Header -->
        <div class="admin-page-header">
            <div class="admin-page-title">
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                    <a href="{{ route('dashboard') }}" style="display: flex; align-items: center; justify-content: center; width: 32px; height: 32px; background: #f3f4f6; border-radius: 8px; transition: all 0.2s; text-decoration: none;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" style="color: #374151;">
                            <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/>
                        </svg>
                    </a>
                    <div>
                        <h1>KELOLA MARKETPLACE</h1>
                        <p>Dashboard untuk mengelola produk dan pesanan marketplace UMKM</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="stats-grid">
            <div class="stat-card stat-products">
                <div class="stat-icon">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                    </svg>
                </div>
                <div class="stat-content">
                    <div class="stat-number">{{ $totalProducts }}</div>
                    <div class="stat-label">Total Produk</div>
                </div>
            </div>

            <div class="stat-card stat-orders">
                <div class="stat-icon">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6z"/>
                    </svg>
                </div>
                <div class="stat-content">
                    <div class="stat-number">{{ $totalOrders }}</div>
                    <div class="stat-label">Total Pesanan</div>
                </div>
            </div>

            <div class="stat-card stat-umkm">
                <div class="stat-icon">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="currentColor">
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
        <div class="marketplace-section">
            <h2 class="section-title">Aksi Cepat</h2>
            <div class="action-grid">
                <a href="{{ route('admin.marketplace.orders') }}" class="marketplace-action-card action-secondary">
                    <div class="action-icon-wrapper">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6z"/>
                        </svg>
                    </div>
                    <div class="action-content">
                        <h3>Kelola Pesanan</h3>
                        <p>Lihat dan kelola semua pesanan</p>
                    </div>
                </a>

                <a href="{{ route('admin.marketplace.products') }}" class="marketplace-action-card action-tertiary">
                    <div class="action-icon-wrapper">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="currentColor">
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

        </div>

        <!-- Recent Activities -->
        <div class="marketplace-section">
            <h2 class="section-title">Aktivitas Terbaru</h2>
            <div class="marketplace-recent-grid">
            <!-- Recent Orders -->
            <div class="marketplace-recent-card">
                <div class="marketplace-card-header">
                    <h3>Pesanan Terbaru</h3>
                    <a href="{{ route('admin.marketplace.orders') }}" class="marketplace-view-all">Lihat Semua →</a>
                </div>
                <div class="marketplace-list">
                    @forelse($recentOrders as $order)
                        <div class="marketplace-list-item">
                            <div class="marketplace-item-avatar">
                                {{ substr($order->customer_name, 0, 1) }}
                            </div>
                            <div class="marketplace-item-content">
                                <div class="marketplace-item-title">{{ $order->order_id }}</div>
                                <div class="marketplace-item-subtitle">{{ $order->customer_name }}</div>
                                <div class="marketplace-item-meta">{{ $order->formatted_total }} • {{ $order->created_at->diffForHumans() }}</div>
                            </div>
                            <span class="marketplace-status-badge status-{{ $order->status }}">{{ ucfirst($order->status) }}</span>
                        </div>
                    @empty
                        <div class="marketplace-empty-state">
                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6z"/>
                            </svg>
                            <p>Belum ada pesanan terbaru</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Recent Products -->
            <div class="marketplace-recent-card">
                <div class="marketplace-card-header">
                    <h3>Produk Terbaru</h3>
                    <a href="{{ route('admin.marketplace.products') }}" class="marketplace-view-all">Lihat Semua →</a>
                </div>
                <div class="marketplace-list">
                    @forelse($recentProducts as $product)
                        <div class="marketplace-list-item">
                            <div class="marketplace-product-thumb">
                                @if($product->main_image)
                                    <img src="{{ asset('images/products/' . $product->main_image) }}" alt="{{ $product->name }}">
                                @else
                                    <div class="marketplace-item-avatar">P</div>
                                @endif
                            </div>
                            <div class="marketplace-item-content">
                                <div class="marketplace-item-title">{{ Str::limit($product->name, 30) }}</div>
                                <div class="marketplace-item-subtitle">{{ $product->umkm ? $product->umkm->name : 'UMKM not found' }}</div>
                                <div class="marketplace-item-meta">{{ $product->created_at->diffForHumans() }}</div>
                            </div>
                            <span class="marketplace-price">{{ $product->formatted_price }}</span>
                        </div>
                    @empty
                        <div class="marketplace-empty-state">
                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                            <p>Belum ada produk terbaru</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Stats Grid */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.stat-card {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    display: flex;
    align-items: center;
    gap: 1.25rem;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.stat-products .stat-icon { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
.stat-orders .stat-icon { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); }
.stat-umkm .stat-icon { background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); }

.stat-icon {
    width: 64px;
    height: 64px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    flex-shrink: 0;
}

.stat-content {
    flex: 1;
}

.stat-number {
    font-size: 2rem;
    font-weight: 800;
    color: #1f2937;
    line-height: 1;
    margin-bottom: 0.25rem;
}

.stat-label {
    color: #6b7280;
    font-size: 0.875rem;
    font-weight: 500;
}

/* Section */
.marketplace-section {
    margin-bottom: 2rem;
}

.section-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 1rem;
}

/* Action Grid */
.action-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 1.5rem;
}

.marketplace-action-card {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    display: flex;
    align-items: center;
    gap: 1.25rem;
    text-decoration: none;
    color: inherit;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

.marketplace-action-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.action-primary .action-icon-wrapper { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
.action-secondary .action-icon-wrapper { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); }
.action-tertiary .action-icon-wrapper { background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); }

.action-icon-wrapper {
    width: 56px;
    height: 56px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    flex-shrink: 0;
}

.action-content h3 {
    font-size: 1.125rem;
    font-weight: 600;
    color: #1f2937;
    margin-bottom: 0.25rem;
}

.action-content p {
    color: #6b7280;
    font-size: 0.875rem;
    margin: 0;
}

/* Recent Activities */
.marketplace-recent-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(450px, 1fr));
    gap: 1.5rem;
    padding: 0 0.5rem;
}

.marketplace-recent-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

.marketplace-card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.25rem 1.5rem;
    border-bottom: 1px solid #e5e7eb;
}

.marketplace-card-header h3 {
    font-size: 1.125rem;
    font-weight: 600;
    color: #1f2937;
    margin: 0;
}

.marketplace-view-all {
    color: #0098ff;
    text-decoration: none;
    font-size: 0.875rem;
    font-weight: 500;
    transition: color 0.2s;
}

.marketplace-view-all:hover {
    color: #0077cc;
}

.marketplace-list {
    padding: 0.5rem;
    max-height: 400px;
    overflow-y: auto;
}

.marketplace-list-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    border-radius: 8px;
    transition: background 0.2s;
}

.marketplace-list-item:hover {
    background: #f9fafb;
}

.marketplace-item-avatar {
    width: 48px;
    height: 48px;
    border-radius: 10px;
    background: linear-gradient(135deg, #0098ff 0%, #0077cc 100%);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 1.125rem;
    flex-shrink: 0;
}

.marketplace-product-thumb {
    width: 48px;
    height: 48px;
    border-radius: 10px;
    overflow: hidden;
    flex-shrink: 0;
}

.marketplace-product-thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.marketplace-item-content {
    flex: 1;
    min-width: 0;
}

.marketplace-item-title {
    font-weight: 600;
    color: #1f2937;
    font-size: 0.875rem;
    margin-bottom: 0.125rem;
}

.marketplace-item-subtitle {
    color: #6b7280;
    font-size: 0.75rem;
    margin-bottom: 0.125rem;
}

.marketplace-item-meta {
    color: #9ca3af;
    font-size: 0.75rem;
}

.marketplace-status-badge {
    font-size: 0.75rem;
    font-weight: 600;
    padding: 0.375rem 0.75rem;
    border-radius: 6px;
    text-transform: capitalize;
    white-space: nowrap;
}

.status-pending { background: #fef3c7; color: #92400e; }
.status-paid { background: #dcfce7; color: #166534; }
.status-processing { background: #fef3c7; color: #92400e; }
.status-shipped { background: #dbeafe; color: #1e40af; }
.status-delivered { background: #dcfce7; color: #166534; }
.status-cancelled { background: #fee2e2; color: #991b1b; }

.marketplace-price {
    font-weight: 700;
    color: #0098ff;
    font-size: 0.875rem;
    white-space: nowrap;
}

.marketplace-empty-state {
    text-align: center;
    padding: 3rem 1rem;
    color: #9ca3af;
}

.marketplace-empty-state svg {
    margin: 0 auto 1rem;
    opacity: 0.5;
}

.marketplace-empty-state p {
    margin: 0;
    font-size: 0.875rem;
}

@media (max-width: 768px) {
    .stats-grid {
        grid-template-columns: 1fr;
    }
    
    .action-grid {
        grid-template-columns: 1fr;
    }
    
    .marketplace-recent-grid {
        grid-template-columns: 1fr;
    }
}
</style>
@endsection