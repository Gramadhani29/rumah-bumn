@extends('layouts.public')

@section('title', $product->name . ' - Toko UMKM')
@section('description', $product->description)

@section('content')
    <!-- Breadcrumb -->
    <section class="breadcrumb-section">
        <div class="container">
            <nav class="breadcrumb">
                <a href="{{ route('toko.index') }}">Toko</a>
                <span class="breadcrumb-separator">/</span>
                <a href="{{ route('toko.index', ['category' => $product->category]) }}">{{ ucfirst($product->category) }}</a>
                <span class="breadcrumb-separator">/</span>
                <span class="breadcrumb-current">{{ $product->name }}</span>
            </nav>
        </div>
    </section>

    <!-- Product Detail Section -->
    <section class="product-detail-section">
        <div class="container">
            <div class="product-detail-grid">
                <!-- Product Images -->
                <div class="product-images">
                    <div class="main-image">
                        <img src="{{ $product->main_image_url }}" alt="{{ $product->name }}" id="mainProductImage">
                        <div class="image-zoom" id="imageZoom"></div>
                    </div>
                    
                    <!-- Thumbnail images -->
                    <div class="thumbnail-images">
                        @foreach($product->image_urls as $index => $imageUrl)
                            <div class="thumbnail {{ $index === 0 ? 'active' : '' }}" onclick="changeMainImage('{{ $imageUrl }}', this)">
                                <img src="{{ $imageUrl }}" alt="{{ $product->name }}">
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Product Info -->
                <div class="product-info">
                    <div class="product-badges">
                        <span class="badge category">{{ ucfirst($product->category) }}</span>
                        @if($product->is_featured)
                            <span class="badge featured">Featured</span>
                        @endif
                        @if($product->stock <= 5 && $product->stock > 0)
                            <span class="badge stock-warning">Stok Terbatas</span>
                        @elseif($product->stock == 0)
                            <span class="badge stock-warning">Stok Habis</span>
                        @endif
                    </div>

                    <h1 class="product-name">{{ $product->name }}</h1>
                    
                    <div class="product-meta">
                        <div class="umkm-info">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                            </svg>
                            <span>{{ $product->umkm->name }}</span>
                        </div>
                        <div class="product-rating">
                            <div class="stars">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= floor($product->rating))
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                        </svg>
                                    @else
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                        </svg>
                                    @endif
                                @endfor
                            </div>
                            <span class="rating-text">({{ $product->rating }}) {{ $product->total_reviews }} ulasan</span>
                        </div>
                    </div>

                    <div class="product-price-section">
                        @if($product->has_discount)
                            <div class="original-price">{{ $product->formatted_original_price }}</div>
                            <div class="current-price">{{ $product->formatted_price }}</div>
                            <div class="discount-info">Hemat {{ $product->discount_percentage }}%</div>
                        @else
                            <div class="current-price">{{ $product->formatted_price }}</div>
                        @endif
                        <div class="stock-info">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M20 6h-2.18c.11-.31.18-.65.18-1a2.996 2.996 0 0 0-5.5-1.65l-.5.67-.5-.68C10.96 2.54 10.05 2 9 2 7.34 2 6 3.34 6 5c0 .35.07.69.18 1H4c-1.11 0-1.99.89-1.99 2L2 19c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V8c0-1.11-.89-2-2-2zm-5-2c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zM9 4c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1z"/>
                            </svg>
                            @if($product->stock > 0)
                                <span>Stok tersedia: {{ $product->stock }} unit</span>
                            @else
                                <span class="out-of-stock">Stok habis</span>
                            @endif
                        </div>
                    </div>

                    <div class="product-description">
                        <h3>Deskripsi Produk</h3>
                        <p>{{ $product->description }}</p>
                    </div>

                    @if($product->specifications)
                    <div class="product-specifications">
                        <h3>Spesifikasi</h3>
                        <div class="specs-grid">
                            @foreach($product->specifications as $key => $value)
                            <div class="spec-item">
                                <span class="spec-label">{{ $key }}:</span>
                                <span class="spec-value">{{ $value }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Quantity & Add to Cart -->
                    <div class="product-actions">
                        @if($product->stock > 0)
                            <div class="quantity-section">
                                <label for="quantity">Jumlah:</label>
                                <div class="quantity-input">
                                    <button type="button" class="quantity-btn" onclick="changeQuantity(-1)">-</button>
                                    <input type="number" id="quantity" value="{{ $product->min_order }}" 
                                           min="{{ $product->min_order }}" max="{{ $product->stock }}">
                                    <button type="button" class="quantity-btn" onclick="changeQuantity(1)">+</button>
                                </div>
                                <small class="quantity-info">Min. order: {{ $product->min_order }} unit</small>
                            </div>

                            <div class="action-buttons">
                                <button class="btn-add-to-cart" onclick="addToCart({{ $product->id }})">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M7 18c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12L8.1 13h7.45c.75 0 1.41-.41 1.75-1.03L21.7 4H5.21l-.94-2H1zm16 16c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/>
                                    </svg>
                                    Tambah ke Keranjang
                                </button>
                                
                                <button class="btn-buy-now" onclick="buyNow({{ $product->id }})">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M13 3c-4.97 0-9 4.03-9 9H1l3.89 3.89.07.14L9 12H6c0-3.87 3.13-7 7-7s7 3.13 7 7-3.13 7-7 7c-1.93 0-3.68-.79-4.94-2.06l-1.42 1.42C8.27 19.99 10.51 21 13 21c4.97 0 9-4.03 9-9s-4.03-9-9-9zm-1 5v5l4.28 2.54.72-1.21-3.5-2.08V8H12z"/>
                                    </svg>
                                    Beli Sekarang
                                </button>
                            </div>
                        @else
                            <div class="out-of-stock-notice">
                                <h4>Produk Sedang Tidak Tersedia</h4>
                                <p>Maaf, stok produk ini sedang habis. Silakan hubungi UMKM untuk info restock.</p>
                                <button class="btn-notify-restock" onclick="notifyRestock({{ $product->id }})">
                                    Beritahu Saat Tersedia
                                </button>
                            </div>
                        @endif
                    </div>

                    <!-- Share & Wishlist -->
                    <div class="product-social">
                        <button class="btn-wishlist">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                            </svg>
                            Simpan ke Wishlist
                        </button>
                        
                        <div class="share-buttons">
                            <span>Bagikan:</span>
                            <button class="btn-share" data-platform="whatsapp">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                                </svg>
                            </button>
                            <button class="btn-share" data-platform="facebook">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- UMKM Info Section -->
    <section class="umkm-info-section">
        <div class="container">
            <div class="umkm-card">
                <div class="umkm-header">
                    <h3>Tentang {{ $product->umkm->name }}</h3>
                </div>
                <div class="umkm-details">
                    <div class="umkm-detail-item">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                        </svg>
                        <span>{{ $product->umkm->address }}, {{ $product->umkm->city }}</span>
                    </div>
                    <div class="umkm-detail-item">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
                        </svg>
                        <span>{{ $product->umkm->phone }}</span>
                    </div>
                    <div class="umkm-detail-item">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                        </svg>
                        <span>Rating: {{ $product->umkm->rating }}/5 ({{ $product->umkm->total_products }} produk)</span>
                    </div>
                </div>
                <div class="umkm-description" style="margin: 1rem 0;">
                    <p>{{ $product->umkm->description }}</p>
                </div>
                <div class="umkm-actions">
                    <button class="btn-contact-umkm" onclick="contactUmkm('{{ $product->umkm->phone }}')">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/>
                        </svg>
                        Hubungi UMKM
                    </button>
                    <a href="{{ route('toko.index', ['category' => $product->category]) }}" class="btn-view-umkm">
                        Lihat Produk Lainnya
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Include Cart Components -->
    @include('partials.cart-sidebar')
    @include('partials.cart-float')
@endsection

@push('scripts')
<script>
function changeQuantity(delta) {
    const quantityInput = document.getElementById('quantity');
    let currentValue = parseInt(quantityInput.value);
    let newValue = currentValue + delta;
    
    const minOrder = {{ $product->min_order }};
    const maxStock = {{ $product->stock }};
    
    if (newValue < minOrder) newValue = minOrder;
    if (newValue > maxStock) newValue = maxStock;
    
    quantityInput.value = newValue;
}

function addToCart(productId) {
    const quantity = document.getElementById('quantity').value;
    
    fetch(`{{ route('toko.cart.add') }}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            product_id: productId,
            quantity: parseInt(quantity)
        })
    })
    .then(response => {
        console.log('Response status:', response.status);
        if (!response.ok) {
            if (response.status === 401) {
                showNotification('Silakan login terlebih dahulu untuk melanjutkan pembelian', 'error');
                setTimeout(() => {
                    window.location.href = '{{ route("login") }}';
                }, 2000);
                throw new Error('Unauthenticated');
            }
            return response.text().then(text => {
                console.error('Error response:', text);
                throw new Error(`HTTP error! status: ${response.status}`);
            });
        }
        return response.json();
    })
    .then(data => {
        console.log('Response data:', data);
        if (data.success) {
            updateCartCount(data.cart_count);
            loadCartItems(); // Refresh sidebar cart
            showNotification('Produk berhasil ditambahkan ke keranjang', 'success');
        } else {
            showNotification(data.message || 'Gagal menambahkan produk', 'error');
        }
    })
    .catch(error => {
        console.error('Full error details:', error);
        if (error.message !== 'Unauthenticated') {
            showNotification('Terjadi kesalahan saat menambahkan produk', 'error');
        }
    });
}

function showNotification(message, type) {
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.textContent = message;
    
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

function changeMainImage(imageUrl, thumbnail) {
    const mainImage = document.getElementById('mainProductImage');
    mainImage.src = imageUrl;
    
    // Update active thumbnail
    document.querySelectorAll('.thumbnail').forEach(thumb => thumb.classList.remove('active'));
    thumbnail.classList.add('active');
}

function buyNow(productId) {
    const quantity = document.getElementById('quantity').value;
    
    // Add to cart first, then redirect to checkout
    fetch(`{{ route('toko.cart.add') }}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            product_id: productId,
            quantity: parseInt(quantity)
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.href = `{{ route('toko.checkout') }}`;
        } else {
            showNotification(data.message || 'Gagal melakukan checkout', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('Terjadi kesalahan', 'error');
    });
}

function contactUmkm(phone) {
    const message = `Halo, saya tertarik dengan produk {{ $product->name }}. Apakah masih tersedia?`;
    const whatsappUrl = `https://wa.me/${phone.replace(/[^0-9]/g, '')}?text=${encodeURIComponent(message)}`;
    window.open(whatsappUrl, '_blank');
}

function notifyRestock(productId) {
    // Untuk sementara hanya show notification
    // Nantinya bisa ditambahkan fitur email notification
    showNotification('Anda akan diberitahu saat produk tersedia kembali', 'info');
}

// Image zoom functionality
document.addEventListener('DOMContentLoaded', function() {
    const mainImage = document.getElementById('mainProductImage');
    const imageZoom = document.getElementById('imageZoom');
    
    if (mainImage && imageZoom) {
        mainImage.addEventListener('mousemove', function(e) {
            const rect = this.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            
            const xPercent = (x / rect.width) * 100;
            const yPercent = (y / rect.height) * 100;
            
            imageZoom.style.backgroundPosition = `${xPercent}% ${yPercent}%`;
            imageZoom.style.backgroundImage = `url(${this.src})`;
            imageZoom.style.display = 'block';
        });
        
        mainImage.addEventListener('mouseleave', function() {
            imageZoom.style.display = 'none';
        });
    }
});
</script>
@endpush