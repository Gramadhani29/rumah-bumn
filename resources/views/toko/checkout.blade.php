@extends('layouts.public')

@section('title', 'Checkout - Toko UMKM')
@section('description', 'Checkout produk UMKM')

@section('content')
    <!-- Breadcrumb -->
    <section class="breadcrumb-section">
        <div class="container">
            <nav class="breadcrumb">
                <a href="{{ route('toko.index') }}">Toko</a>
                <span class="breadcrumb-separator">/</span>
                <a href="{{ route('toko.cart') }}">Keranjang</a>
                <span class="breadcrumb-separator">/</span>
                <span class="breadcrumb-current">Checkout</span>
            </nav>
        </div>
    </section>

    <!-- Checkout Section -->
    <section class="checkout-section">
        <div class="container">
            <div class="checkout-header">
                <h1>Checkout</h1>
                <div class="checkout-steps">
                    <div class="step active">
                        <div class="step-number">1</div>
                        <span>Informasi Pengantaran</span>
                    </div>
                    <div class="step">
                        <div class="step-number">2</div>
                        <span>Pembayaran</span>
                    </div>
                    <div class="step">
                        <div class="step-number">3</div>
                        <span>Konfirmasi</span>
                    </div>
                </div>
            </div>

            <div class="checkout-content">
                <!-- Checkout Form -->
                <div class="checkout-form">
                    <form id="checkoutForm">
                        @csrf
                        
                        <!-- Delivery Information -->
                        <div class="form-section">
                            <h3>Informasi Pengantaran</h3>
                            
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="firstName">Nama Depan *</label>
                                    <input type="text" id="firstName" name="first_name" required>
                                </div>
                                <div class="form-group">
                                    <label for="lastName">Nama Belakang *</label>
                                    <input type="text" id="lastName" name="last_name" required>
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="email">Email *</label>
                                    <input type="email" id="email" name="email" required>
                                </div>
                                <div class="form-group">
                                    <label for="phone">Nomor Telepon *</label>
                                    <input type="tel" id="phone" name="phone" required>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="address">Alamat Lengkap *</label>
                                <textarea id="address" name="address" rows="3" required placeholder="Masukkan alamat lengkap termasuk nama jalan, nomor rumah, RT/RW"></textarea>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="city">Kota *</label>
                                    <select id="city" name="city" required>
                                        <option value="">Pilih Kota</option>
                                        <option value="pekalongan">Pekalongan</option>
                                        <option value="semarang">Semarang</option>
                                        <option value="jakarta">Jakarta</option>
                                        <option value="surabaya">Surabaya</option>
                                        <option value="bandung">Bandung</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="postalCode">Kode Pos *</label>
                                    <input type="text" id="postalCode" name="postal_code" required>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Method -->
                        <div class="form-section">
                            <h3>Metode Pembayaran</h3>
                            
                            <div class="payment-options">
                                <div class="payment-option">
                                    <input type="radio" id="midtrans" name="payment_method" value="midtrans" checked>
                                    <label for="midtrans">
                                        <div class="payment-info">
                                            <div class="payment-name">Midtrans Payment Gateway</div>
                                            <div class="payment-desc">Bank Transfer, E-Wallet, Kartu Kredit</div>
                                        </div>
                                        <div class="payment-logo">
                                            <img src="{{ asset('images/midtrans-logo.png') }}" alt="Midtrans" style="height: 24px;">
                                        </div>
                                    </label>
                                </div>
                                
                                <div class="payment-option">
                                    <input type="radio" id="cod" name="payment_method" value="cod">
                                    <label for="cod">
                                        <div class="payment-info">
                                            <div class="payment-name">Cash on Delivery (COD)</div>
                                            <div class="payment-desc">Bayar saat barang diterima</div>
                                        </div>
                                        <div class="payment-extra">+Rp 5.000</div>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Order Notes -->
                        <div class="form-section">
                            <h3>Catatan Pesanan (Opsional)</h3>
                            <textarea id="orderNotes" name="order_notes" rows="3" placeholder="Catatan khusus untuk pesanan Anda..."></textarea>
                        </div>
                    </form>
                </div>

                <!-- Order Summary -->
                <div class="order-summary">
                    <div class="summary-card">
                        <h3>Ringkasan Pesanan</h3>
                        
                        <!-- Order Items -->
                        <div class="order-items">
                            @foreach($cartItems as $item)
                                <div class="order-item">
                                    <div class="item-image">
                                        <img src="{{ asset($item['product']->image ?? 'images/products/placeholder.jpg') }}" alt="{{ $item['product']->name }}">
                                        <span class="item-quantity">{{ $item['quantity'] }}</span>
                                    </div>
                                    <div class="item-details">
                                        <div class="item-name">{{ $item['product']->name }}</div>
                                        <div class="item-price">Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <!-- Price Breakdown -->
                        <div class="price-breakdown">
                            <div class="price-row">
                                <span>Subtotal</span>
                                <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                            <div class="price-row" id="codFeeRow" style="display: none;">
                                <span>Biaya COD</span>
                                <span>Rp 5.000</span>
                            </div>
                            <hr>
                            <div class="price-row total">
                                <span>Total Pembayaran</span>
                                <span id="finalTotal">Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                        </div>
                        
                        <!-- Checkout Button -->
                        <button type="button" class="btn-place-order" onclick="processCheckout()">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                            </svg>
                            Buat Pesanan
                        </button>
                        
                        <!-- Security Info -->
                        <div class="security-info">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12,1L3,5V11C3,16.55 6.84,21.74 12,23C17.16,21.74 21,16.55 21,11V5L12,1M10,17L6,13L7.41,11.59L10,14.17L16.59,7.58L18,9L10,17Z"/>
                            </svg>
                            <span>Transaksi Anda dilindungi dengan enkripsi SSL</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<!-- Midtrans Snap JS -->
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const paymentOptions = document.querySelectorAll('input[name="payment_method"]');
    
    // Update payment method
    paymentOptions.forEach(option => {
        option.addEventListener('change', updateTotalCost);
    });
    
    function updateTotalCost() {
        const selectedPayment = document.querySelector('input[name="payment_method"]:checked');
        const codFeeRow = document.getElementById('codFeeRow');
        
        let codFee = 0;
        
        // Calculate COD fee
        if (selectedPayment.value === 'cod') {
            codFee = 5000;
            codFeeRow.style.display = 'flex';
        } else {
            codFeeRow.style.display = 'none';
        }
        
        // Update UI
        const subtotal = {{ $total }};
        const finalTotal = subtotal + codFee;
        document.getElementById('finalTotal').textContent = `Rp ${finalTotal.toLocaleString('id-ID')}`;
    }
});

function processCheckout() {
    // Validate form
    const form = document.getElementById('checkoutForm');
    if (!form.checkValidity()) {
        form.reportValidity();
        return;
    }
    
    // Get form data
    const formData = new FormData(form);
    const orderData = Object.fromEntries(formData);
    
    // Show loading state
    const btnPlaceOrder = document.querySelector('.btn-place-order');
    const originalText = btnPlaceOrder.innerHTML;
    btnPlaceOrder.innerHTML = '<div class="loading-spinner"></div> Memproses...';
    btnPlaceOrder.disabled = true;
    
    // Check payment method
    if (orderData.payment_method === 'midtrans') {
        // Process with Midtrans
        processMidtransPayment(orderData, btnPlaceOrder, originalText);
    } else {
        // Process COD order
        processCODOrder(orderData, btnPlaceOrder, originalText);
    }
}

function processMidtransPayment(orderData, btnPlaceOrder, originalText) {
    // Send order data to create Midtrans transaction
    fetch('{{ route("payment.create") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify(orderData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success && data.snap_token) {
            // Open Midtrans Snap popup
            snap.pay(data.snap_token, {
                onSuccess: function(result) {
                    showNotification('Pembayaran berhasil! Terima kasih atas pesanan Anda.', 'success');
                    setTimeout(() => {
                        window.location.href = '{{ route("payment.finish") }}?order_id=' + result.order_id;
                    }, 2000);
                },
                onPending: function(result) {
                    showNotification('Menunggu pembayaran...', 'info');
                    setTimeout(() => {
                        window.location.href = '{{ route("payment.unfinish") }}?order_id=' + result.order_id;
                    }, 2000);
                },
                onError: function(result) {
                    showNotification('Pembayaran gagal. Silakan coba lagi.', 'error');
                    btnPlaceOrder.innerHTML = originalText;
                    btnPlaceOrder.disabled = false;
                },
                onClose: function() {
                    showNotification('Pembayaran dibatalkan.', 'warning');
                    btnPlaceOrder.innerHTML = originalText;
                    btnPlaceOrder.disabled = false;
                }
            });
        } else {
            showNotification(data.message || 'Terjadi kesalahan saat memproses pembayaran.', 'error');
            btnPlaceOrder.innerHTML = originalText;
            btnPlaceOrder.disabled = false;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('Terjadi kesalahan. Silakan coba lagi.', 'error');
        btnPlaceOrder.innerHTML = originalText;
        btnPlaceOrder.disabled = false;
    });
}

function processCODOrder(orderData, btnPlaceOrder, originalText) {
    // Process COD order (you can implement this later)
    setTimeout(() => {
        showNotification('Pesanan COD berhasil dibuat! Anda akan dihubungi untuk konfirmasi.', 'success');
        btnPlaceOrder.innerHTML = originalText;
        btnPlaceOrder.disabled = false;
        
        // Clear cart after successful order
        fetch('{{ route("toko.cart.clear") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        }).then(() => {
            setTimeout(() => {
                window.location.href = '{{ route("toko.index") }}';
            }, 2000);
        });
    }, 1500);
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
    }, 4000);
}
</script>
@endpush