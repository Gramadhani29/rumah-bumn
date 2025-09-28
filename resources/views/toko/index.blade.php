@extends('layouts.public')

@section('title', 'Toko UMKM - Rumah BUMN Telkom Pekalongan')
@section('description', 'Belanja produk-produk unggulan dari UMKM binaan Rumah BUMN Telkom Pekalongan')

@section('content')
    <!-- Toko Header Section -->
    <section class="toko-header-section">
        <div class="container">
            <div class="toko-header-content">
                <h1>Toko UMKM</h1>
                <p>Dukung produk lokal dari UMKM binaan Rumah BUMN Telkom Pekalongan</p>
            </div>
        </div>
    </section>

    <!-- Filter & Search Section -->
    <section class="toko-filter-section">
        <div class="container">
            <div class="toko-filter-controls">
                <div class="filter-categories">
                    @foreach($categories as $key => $label)
                        <a href="{{ route('toko.index', ['category' => $key]) }}" 
                           class="filter-category {{ request('category', 'all') === $key ? 'active' : '' }}" 
                           data-category="{{ $key }}">
                            @if($key === 'all')
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z"/>
                                </svg>
                            @elseif($key === 'fashion')
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                </svg>
                            @elseif($key === 'makanan')
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M8.1 13.34L1.94 7.18C1.54 6.78 1.54 6.14 1.94 5.74S3.04 5.34 3.44 5.74L9.54 11.84L8.1 13.34Z"/>
                                </svg>
                            @elseif($key === 'minuman')
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M5 3v18h2l2-2h6l2 2h2V3H5zm12 16H7V5h10v14z"/>
                                </svg>
                            @else
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"/>
                                </svg>
                            @endif
                            {{ $label }}
                        </a>
                    @endforeach
                </div>

                <div class="toko-search">
                    <form action="{{ route('toko.index') }}" method="GET" class="search-form">
                        @if(request('category'))
                            <input type="hidden" name="category" value="{{ request('category') }}">
                        @endif
                        <div class="search-input-wrapper">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" class="search-icon">
                                <path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5 6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
                            </svg>
                            <input type="text" name="search" placeholder="Cari produk..." class="search-input" 
                                   value="{{ request('search') }}" id="productSearch">
                            @if(request('search'))
                                <a href="{{ route('toko.index', ['category' => request('category')]) }}" class="search-clear">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
                                    </svg>
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Products Grid Section -->
    <section class="toko-products-section">
        <div class="container">
            <div class="products-grid">
                @foreach($products as $product)
                    <div class="product-card" data-category="{{ $product->category }}">
                        <div class="product-image">
                            <img src="{{ $product->main_image_url }}" alt="{{ $product->name }}" loading="lazy">
                            <div class="product-overlay">
                                <button class="product-quick-view" onclick="quickView({{ $product->id }})">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>
                                    </svg>
                                </button>
                                <button class="product-add-cart" onclick="addToCart({{ $product->id }})">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M7 18c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12L8.1 13h7.45c.75 0 1.41-.41 1.75-1.03L21.7 4H5.21l-.94-2H1zm16 16c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/>
                                    </svg>
                                </button>
                            </div>
                            <div class="product-category">{{ ucfirst($product->category) }}</div>
                            @if($product->is_featured)
                                <div class="featured-badge">Featured</div>
                            @endif
                            @if($product->stock <= 5 && $product->stock > 0)
                                <div class="product-stock-warning">Stok Terbatas</div>
                            @endif
                        </div>
                        
                        <div class="product-content">
                            <div class="product-umkm">{{ $product->umkm->name }}</div>
                            <h3 class="product-title">{{ $product->name }}</h3>
                            <p class="product-description">{{ Str::limit($product->description, 100) }}</p>
                            
                            <div class="product-footer">
                                <div class="product-price">
                                    @if($product->is_discount_active)
                                        <div class="price-with-discount">
                                            <span class="discounted-price">{{ $product->formatted_discounted_price }}</span>
                                            <span class="original-price">{{ $product->formatted_price }}</span>
                                            <span class="discount-badge">{{ $product->discount_percentage }}% OFF</span>
                                        </div>
                                    @else
                                        <span class="current-price">{{ $product->formatted_price }}</span>
                                    @endif
                                </div>
                                <div class="product-stock">
                                    @if($product->stock > 0)
                                        <span class="in-stock">Stok: {{ $product->stock }}</span>
                                    @else
                                        <span class="out-of-stock">Stok Habis</span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="product-actions">
                                <a href="{{ route('toko.produk.show', $product->id) }}" class="btn-detail">
                                    Lihat Detail
                                </a>
                                @if($product->stock > 0)
                                    <button class="btn-add-cart" onclick="addToCart({{ $product->id }})">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M7 18c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12L8.1 13h7.45c.75 0 1.41-.41 1.75-1.03L21.7 4H5.21l-.94-2H1zm16 16c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/>
                                        </svg>
                                        Tambah Keranjang
                                    </button>
                                @else
                                    <button class="btn-add-cart" disabled>
                                        Stok Habis
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <!-- Pagination -->
            @if($products->hasPages())
                <div class="pagination-wrapper">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    </section>

    <!-- Include Cart Components -->
    @include('partials.cart-sidebar')
    @include('partials.cart-float')
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    
    // Filter functionality
    const filterButtons = document.querySelectorAll('.filter-category');
    const productCards = document.querySelectorAll('.product-card');
    
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            const category = this.dataset.category;
            
            // Update active button
            filterButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            
            // Filter products
            productCards.forEach(card => {
                if (category === 'all' || card.dataset.category === category) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
    
    // Search functionality
    const searchInput = document.getElementById('productSearch');
    const searchClear = document.getElementById('searchClear');
    
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        
        if (searchTerm.length > 0) {
            searchClear.style.display = 'block';
        } else {
            searchClear.style.display = 'none';
        }
        
        productCards.forEach(card => {
            const title = card.querySelector('.product-title').textContent.toLowerCase();
            const description = card.querySelector('.product-description').textContent.toLowerCase();
            const umkm = card.querySelector('.product-umkm').textContent.toLowerCase();
            
            if (title.includes(searchTerm) || description.includes(searchTerm) || umkm.includes(searchTerm)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    });
    
    searchClear.addEventListener('click', function() {
        searchInput.value = '';
        this.style.display = 'none';
        productCards.forEach(card => {
            card.style.display = 'block';
        });
    });
});

// Cart functions
function addToCart(productId) {
    const csrfToken = document.querySelector('meta[name="csrf-token"]');
    if (!csrfToken) {
        showNotification('CSRF token tidak ditemukan', 'error');
        return;
    }

    fetch(`{{ route('toko.cart.add') }}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken.getAttribute('content'),
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            product_id: productId,
            quantity: 1
        })
    })
    .then(response => {
        console.log('Response status:', response.status);
        if (!response.ok) {
            return response.text().then(text => {
                console.error('Error response:', text);
                throw new Error(`HTTP error! status: ${response.status}, body: ${text}`);
            });
        }
        return response.json();
    })
    .then(data => {
        console.log('Response data:', data);
        if (data.success) {
            updateCartCount(data.cart_count);
            loadCartItems(); // Refresh sidebar cart
            showNotification(data.message || 'Produk berhasil ditambahkan ke keranjang', 'success');
        } else {
            showNotification(data.message || 'Gagal menambahkan produk', 'error');
        }
    })
    .catch(error => {
        console.error('Full error details:', error);
        showNotification('Terjadi kesalahan saat menambahkan produk: ' + error.message, 'error');
    });
}

function quickView(productId) {
    window.location.href = `/toko/produk/${productId}`;
}

// Functions sudah ada di partials/cart-sidebar.blade.php dan partials/cart-float.blade.php

function showNotification(message, type) {
    // Create and show notification
    const notification = document.createElement('div');
    notification.className = `notification notification-${type} show`;
    notification.textContent = message;
    
    // Add some basic styling
    notification.style.position = 'fixed';
    notification.style.top = '20px';
    notification.style.right = '20px';
    notification.style.padding = '1rem 1.5rem';
    notification.style.borderRadius = '8px';
    notification.style.color = 'white';
    notification.style.fontWeight = '600';
    notification.style.zIndex = '9999';
    notification.style.minWidth = '250px';
    notification.style.boxShadow = '0 4px 12px rgba(0,0,0,0.15)';
    
    // Set background color based on type
    switch(type) {
        case 'success':
            notification.style.backgroundColor = '#10b981';
            break;
        case 'error':
            notification.style.backgroundColor = '#ef4444';
            break;
        case 'warning':
            notification.style.backgroundColor = '#f59e0b';
            break;
        default:
            notification.style.backgroundColor = '#3b82f6';
    }
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.classList.add('show');
    }, 100);
    
    setTimeout(() => {
        notification.classList.remove('show');
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 300);
    }, 3000);
}
</script>
@endpush