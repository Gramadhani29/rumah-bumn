@php
    $cart = session()->get('cart', []);
    $cartCount = array_sum($cart);
@endphp

<!-- Cart Float Button -->
<div class="cart-float" onclick="toggleCartSidebar()">
    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
        <path d="M7 18c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12L8.1 13h7.45c.75 0 1.41-.41 1.75-1.03L21.7 4H5.21l-.94-2H1zm16 16c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/>
    </svg>
    <span class="cart-count" id="cartCount" data-count="{{ $cartCount }}">
        {{ $cartCount }}
    </span>
</div>

<script>
// Global cart functions
function toggleCartSidebar() {
    const sidebar = document.getElementById('cartSidebar');
    if (sidebar) {
        sidebar.classList.toggle('active');
    }
}

function updateCartCount(count) {
    const cartCountElement = document.querySelector('.cart-count');
    if (cartCountElement) {
        const displayCount = count || 0;
        cartCountElement.textContent = displayCount;
        cartCountElement.setAttribute('data-count', displayCount);
        
        if (displayCount > 0) {
            cartCountElement.style.display = 'flex';
        } else {
            cartCountElement.style.display = 'none';
        }
    }
}

// Load initial cart count on page load
document.addEventListener('DOMContentLoaded', function() {
    const cartCountElement = document.querySelector('.cart-count');
    if (cartCountElement) {
        const initialCount = parseInt(cartCountElement.textContent) || 0;
        updateCartCount(initialCount);
    }
});
</script>