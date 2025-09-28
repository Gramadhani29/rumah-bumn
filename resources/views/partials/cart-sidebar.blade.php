<!-- Cart Sidebar -->
<div id="cartSidebar" class="cart-sidebar">
    <div class="cart-header">
        <h3>Keranjang Belanja</h3>
        <button class="cart-close" onclick="toggleCartSidebar()">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
            </svg>
        </button>
    </div>
    
    <div class="cart-content">
        <div id="cartItems">
            <!-- Cart items akan dimuat di sini -->
        </div>
        
        <div class="cart-footer">
            <div class="cart-total">
                <strong>Total: Rp <span id="cartTotal">0</span></strong>
            </div>
            <a href="{{ route('toko.cart') }}" class="btn-view-cart">Lihat Keranjang</a>
            <a href="{{ route('toko.checkout') }}" class="btn-checkout">Checkout</a>
        </div>
    </div>
</div>

<script>
// Cart sidebar functions
function loadCartItems() {
    fetch(`{{ route('toko.cart') }}?ajax=1`, {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        updateCartSidebar(data.cartItems, data.total);
        updateCartCount(data.cart_count);
    })
    .catch(error => {
        console.error('Error loading cart items:', error);
    });
}

// Update cart sidebar content
function updateCartSidebar(cartItems, total) {
    const cartItemsContainer = document.getElementById('cartItems');
    const cartTotalSpan = document.getElementById('cartTotal');
    
    if (!cartItemsContainer || !cartTotalSpan) return;
    
    // Update total
    cartTotalSpan.textContent = new Intl.NumberFormat('id-ID').format(total);
    
    // Clear existing items
    cartItemsContainer.innerHTML = '';
    
    if (cartItems.length === 0) {
        cartItemsContainer.innerHTML = '<p class="empty-cart-message">Keranjang kosong</p>';
        return;
    }
    
    // Add each cart item
    cartItems.forEach(item => {
        const cartItemHtml = `
            <div class="sidebar-cart-item" data-id="${item.product.id}">
                <div class="item-image">
                    <img src="${item.product.image || '{{ asset('images/products/placeholder.jpg') }}'}" alt="${item.product.name}">
                </div>
                <div class="item-details">
                    <h4>${item.product.name}</h4>
                    <p class="item-price">Rp ${new Intl.NumberFormat('id-ID').format(item.product.price)}</p>
                    <div class="item-quantity-controls">
                        <button class="qty-btn minus" onclick="updateSidebarQuantity(${item.product.id}, -1)">-</button>
                        <span class="qty-display">${item.quantity}</span>
                        <button class="qty-btn plus" onclick="updateSidebarQuantity(${item.product.id}, 1)">+</button>
                    </div>
                </div>
                <button class="remove-item" onclick="removeFromCartSidebar(${item.product.id})">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
                    </svg>
                </button>
            </div>
        `;
        cartItemsContainer.innerHTML += cartItemHtml;
    });
}

// Remove item from cart sidebar
function removeFromCartSidebar(productId) {
    fetch(`/toko/keranjang/${productId}`, {
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
            // Reload cart items
            loadCartItems();
            updateCartCount(data.cart_count);
            showNotification(data.message, 'success');
        } else {
            showNotification(data.message || 'Gagal menghapus item', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('Terjadi kesalahan saat menghapus item', 'error');
    });
}

// Update quantity in sidebar
function updateSidebarQuantity(productId, change) {
    fetch(`/toko/keranjang/update`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            product_id: productId,
            change: change
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Reload cart items to reflect changes
            loadCartItems();
            updateCartCount(data.cart_count);
            
            if (data.message) {
                showNotification(data.message, 'success');
            }
        } else {
            showNotification(data.message || 'Gagal mengupdate quantity', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('Terjadi kesalahan saat mengupdate quantity', 'error');
    });
}

// Show notification function
function showNotification(message, type) {
    // Check if function already exists globally
    if (typeof window.showNotification === 'function') {
        return window.showNotification(message, type);
    }
    
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
            if (document.body.contains(notification)) {
                document.body.removeChild(notification);
            }
        }, 300);
    }, 3000);
}

// Load cart items on page load
document.addEventListener('DOMContentLoaded', function() {
    loadCartItems();
});
</script>