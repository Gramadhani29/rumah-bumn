@extends('layouts.admin')

@section('title', 'Kelola Produk')

@section('content')
<div class="products-management">
    <!-- Header -->
    <div class="page-header">
        <div class="header-content">
            <div class="header-left">
                <h1 class="page-title">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="title-icon">
                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                    </svg>
                    Kelola Produk
                </h1>
                <p class="page-subtitle">Kelola semua produk dari UMKM</p>
            </div>
            <div class="header-right">
                <a href="{{ route('admin.marketplace.products.create') }}" class="btn-primary">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
                    </svg>
                    Tambah Produk
                </a>
                <a href="{{ route('admin.marketplace.index') }}" class="btn-secondary">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/>
                    </svg>
                    Dashboard
                </a>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="filters-section">
        <div class="filters-card">
            <form method="GET" action="{{ route('admin.marketplace.products') }}" class="filters-form">
                <div class="filter-group">
                    <label>UMKM</label>
                    <select name="umkm_id" class="filter-select">
                        <option value="">Semua UMKM</option>
                        @foreach($umkms as $umkm)
                            <option value="{{ $umkm->id }}" {{ request('umkm_id') == $umkm->id ? 'selected' : '' }}>
                                {{ $umkm->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="filter-group">
                    <label>Kategori</label>
                    <select name="category" class="filter-select">
                        <option value="">Semua Kategori</option>
                        <option value="fashion" {{ request('category') == 'fashion' ? 'selected' : '' }}>Fashion</option>
                        <option value="makanan" {{ request('category') == 'makanan' ? 'selected' : '' }}>Makanan</option>
                        <option value="kerajinan" {{ request('category') == 'kerajinan' ? 'selected' : '' }}>Kerajinan</option>
                        <option value="elektronik" {{ request('category') == 'elektronik' ? 'selected' : '' }}>Elektronik</option>
                        <option value="kesehatan" {{ request('category') == 'kesehatan' ? 'selected' : '' }}>Kesehatan</option>
                        <option value="kecantikan" {{ request('category') == 'kecantikan' ? 'selected' : '' }}>Kecantikan</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label>Status</label>
                    <select name="is_active" class="filter-select">
                        <option value="">Semua Status</option>
                        <option value="1" {{ request('is_active') == '1' ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ request('is_active') == '0' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label>Cari</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Nama produk..." class="filter-input">
                </div>

                <div class="filter-actions">
                    <button type="submit" class="btn-primary">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5 6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
                        </svg>
                        Filter
                    </button>
                    @if(request()->hasAny(['umkm_id', 'category', 'is_active', 'search']))
                        <a href="{{ route('admin.marketplace.products') }}" class="btn-secondary">Reset</a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <!-- Products Grid -->
    <div class="products-section">
        <div class="products-card">
            @if($products->count() > 0)
                <div class="products-grid">
                    @foreach($products as $product)
                        <div class="product-card">
                            <div class="product-image">
                                @if($product->main_image)
                                    <img src="{{ asset('images/products/' . $product->main_image) }}" alt="{{ $product->name }}">
                                @else
                                    <div class="product-placeholder">
                                        <svg width="48" height="48" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/>
                                        </svg>
                                    </div>
                                @endif
                                
                                <!-- Status Badge -->
                                <div class="status-badge {{ $product->is_active ? 'active' : 'inactive' }}">
                                    {{ $product->is_active ? 'Aktif' : 'Nonaktif' }}
                                </div>

                                <!-- Discount Badge -->
                                @if($product->is_discount_active)
                                    <div class="discount-badge">
                                        {{ $product->discount_percentage }}% OFF
                                    </div>
                                @endif
                            </div>

                            <div class="product-content">
                                <div class="product-meta">
                                    <span class="product-umkm">{{ $product->umkm ? $product->umkm->name : 'UMKM not found' }}</span>
                                    <span class="product-category">{{ ucfirst($product->category) }}</span>
                                </div>

                                <h3 class="product-name">{{ Str::limit($product->name, 50) }}</h3>
                                
                                <div class="product-price">
                                    @if($product->is_discount_active)
                                        <span class="discounted-price">{{ $product->formatted_discounted_price }}</span>
                                        <span class="original-price">{{ $product->formatted_price }}</span>
                                    @else
                                        <span class="current-price">{{ $product->formatted_price }}</span>
                                    @endif
                                </div>

                                <div class="product-stats">
                                    <div class="stat">
                                        <span class="stat-label">Stok:</span>
                                        <span class="stat-value {{ $product->stock <= 5 ? 'low-stock' : '' }}">{{ $product->stock }}</span>
                                    </div>
                                    <div class="stat">
                                        <span class="stat-label">Terjual:</span>
                                        <span class="stat-value">{{ $product->total_sold ?? 0 }}</span>
                                    </div>
                                </div>

                                <div class="product-actions">
                                    <a href="{{ route('admin.marketplace.products.edit', $product->id) }}" class="btn-action edit" title="Edit">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
                                        </svg>
                                    </a>
                                    
                                    <form method="POST" action="{{ route('admin.marketplace.products.toggle', $product->id) }}" class="toggle-form">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn-action toggle {{ $product->is_active ? 'active' : 'inactive' }}" title="{{ $product->is_active ? 'Nonaktifkan' : 'Aktifkan' }}">
                                            @if($product->is_active)
                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                                </svg>
                                            @else
                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm3.5 6L12 10.5 8.5 8 12 5.5 15.5 8zM12 13.5L8.5 16 12 18.5 15.5 16 12 13.5z"/>
                                                </svg>
                                            @endif
                                        </button>
                                    </form>

                                    <form method="POST" action="{{ route('admin.marketplace.products.destroy', $product->id) }}" class="delete-form" onsubmit="return confirm('Yakin ingin hapus produk ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action delete" title="Hapus">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="pagination-wrapper">
                    {{ $products->appends(request()->query())->links() }}
                </div>
            @else
                <div class="empty-state">
                    <div class="empty-icon">
                        <svg width="64" height="64" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                        </svg>
                    </div>
                    <h3>Belum Ada Produk</h3>
                    <p>Belum ada produk yang sesuai dengan filter yang dipilih.</p>
                    <a href="{{ route('admin.marketplace.products.create') }}" class="btn-primary">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
                        </svg>
                        Tambah Produk Pertama
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
.products-management {
    padding: 2rem;
}

.page-header {
    margin-bottom: 2rem;
}

.header-content {
    background: white;
    padding: 2rem;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    display: flex;
    justify-content: space-between;
    align-items: center;
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

.header-right {
    display: flex;
    gap: 0.75rem;
}

.btn-primary {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1rem;
    background: #0098ff;
    color: white;
    text-decoration: none;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    background: #0066cc;
}

.btn-secondary {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1rem;
    background: #f8fafc;
    color: #374151;
    text-decoration: none;
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-secondary:hover {
    background: #e2e8f0;
}

.filters-section {
    margin-bottom: 2rem;
}

.filters-card {
    background: white;
    padding: 1.5rem;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
}

.filters-form {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
    align-items: end;
}

.filter-group {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.filter-group label {
    font-weight: 600;
    color: #374151;
    font-size: 0.875rem;
}

.filter-select,
.filter-input {
    padding: 0.75rem;
    border: 2px solid #e2e8f0;
    border-radius: 8px;
    font-size: 0.875rem;
    transition: border-color 0.3s ease;
}

.filter-select:focus,
.filter-input:focus {
    outline: none;
    border-color: #0098ff;
}

.filter-actions {
    display: flex;
    gap: 0.5rem;
}

.products-section {
    margin-bottom: 2rem;
}

.products-card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    overflow: hidden;
}

.products-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 1.5rem;
    padding: 1.5rem;
}

.product-card {
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    overflow: hidden;
    transition: all 0.3s ease;
}

.product-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
}

.product-image {
    position: relative;
    height: 200px;
    overflow: hidden;
}

.product-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.product-placeholder {
    width: 100%;
    height: 100%;
    background: #f8fafc;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #94a3b8;
}

.status-badge {
    position: absolute;
    top: 0.75rem;
    left: 0.75rem;
    padding: 0.25rem 0.5rem;
    border-radius: 6px;
    font-size: 0.75rem;
    font-weight: 600;
}

.status-badge.active {
    background: #d1fae5;
    color: #065f46;
}

.status-badge.inactive {
    background: #fee2e2;
    color: #991b1b;
}

.discount-badge {
    position: absolute;
    top: 0.75rem;
    right: 0.75rem;
    background: #dc2626;
    color: white;
    padding: 0.25rem 0.5rem;
    border-radius: 6px;
    font-size: 0.75rem;
    font-weight: 700;
}

.product-content {
    padding: 1rem;
}

.product-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 0.5rem;
}

.product-umkm {
    font-size: 0.75rem;
    color: #0098ff;
    font-weight: 600;
}

.product-category {
    font-size: 0.75rem;
    color: #64748b;
    background: #f1f5f9;
    padding: 0.125rem 0.5rem;
    border-radius: 4px;
}

.product-name {
    font-size: 1rem;
    font-weight: 600;
    color: #1a202c;
    margin-bottom: 0.75rem;
    line-height: 1.4;
}

.product-price {
    margin-bottom: 0.75rem;
}

.discounted-price {
    font-size: 1.125rem;
    font-weight: 700;
    color: #dc2626;
    margin-right: 0.5rem;
}

.original-price {
    font-size: 0.875rem;
    color: #94a3b8;
    text-decoration: line-through;
}

.current-price {
    font-size: 1.125rem;
    font-weight: 700;
    color: #0098ff;
}

.product-stats {
    display: flex;
    justify-content: space-between;
    margin-bottom: 1rem;
    padding: 0.5rem 0;
    border-top: 1px solid #f1f5f9;
}

.stat {
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

.stat-label {
    font-size: 0.75rem;
    color: #64748b;
}

.stat-value {
    font-size: 0.75rem;
    font-weight: 600;
    color: #1a202c;
}

.stat-value.low-stock {
    color: #dc2626;
}

.product-actions {
    display: flex;
    gap: 0.5rem;
}

.btn-action {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    border-radius: 6px;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
}

.btn-action.edit {
    background: #dbeafe;
    color: #1e40af;
}

.btn-action.edit:hover {
    background: #bfdbfe;
}

.btn-action.toggle.active {
    background: #d1fae5;
    color: #065f46;
}

.btn-action.toggle.active:hover {
    background: #a7f3d0;
}

.btn-action.toggle.inactive {
    background: #fee2e2;
    color: #991b1b;
}

.btn-action.toggle.inactive:hover {
    background: #fecaca;
}

.btn-action.delete {
    background: #fee2e2;
    color: #991b1b;
}

.btn-action.delete:hover {
    background: #fecaca;
}

.pagination-wrapper {
    padding: 1.5rem;
    border-top: 1px solid #e2e8f0;
}

.empty-state {
    text-align: center;
    padding: 4rem 2rem;
}

.empty-icon {
    margin: 0 auto 1rem;
    width: 64px;
    height: 64px;
    color: #94a3b8;
}

.empty-state h3 {
    font-size: 1.25rem;
    font-weight: 600;
    color: #1a202c;
    margin-bottom: 0.5rem;
}

.empty-state p {
    color: #64748b;
    margin-bottom: 1.5rem;
}

@media (max-width: 768px) {
    .products-management {
        padding: 1rem;
    }
    
    .header-content {
        flex-direction: column;
        gap: 1rem;
        align-items: stretch;
    }
    
    .header-right {
        justify-content: center;
    }
    
    .filters-form {
        grid-template-columns: 1fr;
    }
    
    .products-grid {
        grid-template-columns: 1fr;
        padding: 1rem;
    }
}
</style>
@endsection