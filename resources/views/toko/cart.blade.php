@extends('layouts.public')

@section('title', 'Keranjang Belanja - Toko UMKM')
@section('description', 'Keranjang belanja produk UMKM')

@section('content')
    <!-- Breadcrumb -->
    <section class="breadcrumb-section">
        <div class="container">
            <nav class="breadcrumb">
                <a href="{{ route('toko.index') }}">Toko</a>
                <span class="breadcrumb-separator">/</span>
                <span class="breadcrumb-current">Keranjang Belanja</span>
            </nav>
        </div>
    </section>

    <!-- Cart Section -->
    <section class="cart-section">
        <div class="container">
            @if(empty($cartItems))
                <!-- Empty Cart -->
                <div class="empty-cart">
                    <div class="empty-cart-icon">
                        <svg width="80" height="80" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M7 18c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12L8.1 13h7.45c.75 0 1.41-.41 1.75-1.03L21.7 4H5.21l-.94-2H1zm16 16c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/>
                        </svg>
                    </div>
                    <h2>Keranjang Belanja Kosong</h2>
                    <p>Belum ada produk yang ditambahkan ke keranjang belanja Anda</p>
                    <a href="{{ route('toko.index') }}" class="btn-continue-shopping">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/>
                        </svg>
                        Lanjut Belanja
                    </a>
                </div>
            @else
                <!-- Cart Content -->
                <div class="cart-content">
                    <div class="cart-header">
                        <h1>Keranjang Belanja</h1>
                        <span class="cart-item-count">{{ count($cartItems) }} item</span>
                    </div>

                    <div class="cart-main">
                        <!-- Cart Items -->
                        <div class="cart-items">
                            @foreach($cartItems as $item)
                                <div class="cart-item" data-id="{{ $item['product']->id }}">
                                    <div class="cart-item-image">
                                        <img src="{{ asset($item['product']->image ?? 'images/products/placeholder.jpg') }}" alt="{{ $item['product']->name }}">
                                    </div>
                                    
                                    <div class="cart-item-details">
                                        <h3 class="cart-item-name">{{ $item['product']->name }}</h3>
                                        <div class="cart-item-price">Rp {{ number_format($item['product']->price, 0, ',', '.') }}</div>
                                        <div class="cart-item-store">{{ $item['product']->umkm->name ?? 'UMKM' }}</div>
                                    </div>
                                    
                                    <div class="cart-item-quantity">
                                        <div class="quantity-controls">
                                            <button class="quantity-btn" onclick="updateQuantity({{ $item['product']->id }}, -1)">-</button>
                                            <input type="number" value="{{ $item['quantity'] }}" min="1" class="quantity-input" onchange="updateQuantity({{ $item['product']->id }}, 0, this.value)">
                                            <button class="quantity-btn" onclick="updateQuantity({{ $item['product']->id }}, 1)">+</button>
                                        </div>
                                    </div>
                                    
                                    <div class="cart-item-subtotal">
                                        Rp {{ number_format($item['subtotal'], 0, ',', '.') }}
                                    </div>
                                    
                                    <div class="cart-item-actions">
                                        <button class="btn-remove" onclick="removeFromCart({{ $item['product']->id }})">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Cart Summary -->
                        <div class="cart-summary">
                            <div class="summary-card">
                                <h3>Ringkasan Pesanan</h3>
                                
                                <div class="summary-row">
                                    <span>Subtotal ({{ count($cartItems) }} item)</span>
                                    <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                                </div>
                                
                                <hr class="summary-divider">
                                
                                <div class="summary-row total">
                                    <span>Total</span>
                                    <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                                </div>
                                
                                <div class="summary-actions">
                                    <a href="{{ route('toko.checkout') }}" class="btn-checkout">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M13 3c-4.97 0-9 4.03-9 9H1l3.89 3.89.07.14L9 12H6c0-3.87 3.13-7 7-7s7 3.13 7 7-3.13 7-7 7c-1.93 0-3.68-.79-4.94-2.06l-1.42 1.42C8.27 19.99 10.51 21 13 21c4.97 0 9-4.03 9-9s-4.03-9-9-9zm-1 5v5l4.28 2.54.72-1.21-3.5-2.08V8H12z"/>
                                        </svg>
                                        Lanjut ke Checkout
                                    </a>
                                    
                                    <a href="{{ route('toko.index') }}" class="btn-continue-shopping">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/>
                                        </svg>
                                        Lanjut Belanja
                                    </a>
                                </div>
                            </div>

                            <!-- Promo Code -->
                            <div class="promo-card">
                                <h4>Kode Promo</h4>
                                <div class="promo-input">
                                    <input type="text" placeholder="Masukkan kode promo" id="promoCode">
                                    <button class="btn-apply-promo">Terapkan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- Recommended Products -->
    @if(!empty($cartItems))
    <section class="recommended-section">
        <div class="container">
            <h2>Produk Lainnya</h2>
            <div class="recommended-products">
                <!-- Add recommended products here -->
                <div class="product-card-small">
                    <img src="{{ asset('images/products/batik2.jpg') }}" alt="Produk Rekomendasi">
                    <div class="product-info">
                        <h4>Kemeja Batik Modern</h4>
                        <div class="price">Rp 120.000</div>
                        <button class="btn-add-to-cart-small">Tambah</button>
                    </div>
                </div>
                <!-- More recommended products... -->
            </div>
        </div>
    </section>
    @endif
@endsection

@push('scripts')
<script>
function updateQuantity(itemId, delta, newValue = null) {
    let quantity;
    
    if (newValue !== null) {
        quantity = parseInt(newValue);
    } else {
        const quantityInput = document.querySelector(`.cart-item[data-id="${itemId}"] .quantity-input`);
        quantity = parseInt(quantityInput.value) + delta;
    }
    
    if (quantity < 1) quantity = 1;
    
    // Update UI immediately
    const quantityInput = document.querySelector(`.cart-item[data-id="${itemId}"] .quantity-input`);
    quantityInput.value = quantity;
    
    // Update subtotal
    updateItemSubtotal(itemId, quantity);
    
    // Send to server (in real app)
    // updateCartOnServer(itemId, quantity);
}

function updateItemSubtotal(itemId, quantity) {
    const cartItem = document.querySelector(`.cart-item[data-id="${itemId}"]`);
    const priceText = cartItem.querySelector('.cart-item-price').textContent;
    const price = parseInt(priceText.replace(/[^0-9]/g, ''));
    const subtotal = price * quantity;
    
    cartItem.querySelector('.cart-item-subtotal').textContent = 
        `Rp ${subtotal.toLocaleString('id-ID')}`;
    
    updateCartTotal();
}

function updateCartTotal() {
    let total = 0;
    const subtotalElements = document.querySelectorAll('.cart-item-subtotal');
    
    subtotalElements.forEach(element => {
        const subtotal = parseInt(element.textContent.replace(/[^0-9]/g, ''));
        total += subtotal;
    });
    
    document.querySelector('.summary-row.total span:last-child').textContent = 
        `Rp ${total.toLocaleString('id-ID')}`;
    document.querySelector('.summary-row:first-child span:last-child').textContent = 
        `Rp ${total.toLocaleString('id-ID')}`;
}

function removeFromCart(itemId) {
    if (confirm('Apakah Anda yakin ingin menghapus item ini dari keranjang?')) {
        // Send delete request using fetch API
        fetch(`/toko/keranjang/${itemId}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Remove item from DOM
                const cartItem = document.querySelector(`.cart-item[data-id="${itemId}"]`);
                if (cartItem) {
                    cartItem.remove();
                }
                
                // Update cart total
                updateCartTotal();
                
                // Update cart count in navbar
                updateCartCount(data.cart_count);
                
                showNotification(data.message, 'success');
                
                // Reload page if cart is empty
                const remainingItems = document.querySelectorAll('.cart-item');
                if (remainingItems.length === 0) {
                    location.reload();
                }
            } else {
                showNotification(data.message || 'Gagal menghapus item dari keranjang', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('Terjadi kesalahan saat menghapus item', 'error');
        });
    }
}

// Promo code functionality
document.addEventListener('DOMContentLoaded', function() {
    const applyPromoBtn = document.querySelector('.btn-apply-promo');
    if (applyPromoBtn) {
        applyPromoBtn.addEventListener('click', function() {
            const promoCode = document.getElementById('promoCode').value;
            
            if (promoCode.trim() === '') {
                showNotification('Masukkan kode promo terlebih dahulu', 'warning');
                return;
            }
            
            // Validate promo code (dummy validation)
            if (promoCode.toUpperCase() === 'DISKON10') {
                showNotification('Kode promo berhasil diterapkan! Diskon 10%', 'success');
                // Apply discount logic here
            } else {
                showNotification('Kode promo tidak valid', 'error');
            }
        });
    }
});

function updateCartCount(count) {
    // Update cart count in floating cart button
    const cartCountElement = document.querySelector('.cart-count');
    if (cartCountElement) {
        cartCountElement.textContent = count;
        if (count === 0) {
            cartCountElement.style.display = 'none';
        } else {
            cartCountElement.style.display = 'inline';
        }
    }
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
</script>
@endpush