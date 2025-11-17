@extends('layouts.admin')

@section('title', 'Detail Pesanan')

@section('content')
<div class="order-detail">
    <!-- Header -->
    <div class="page-header">
        <div class="header-content">
            <div class="header-left">
                <h1 class="page-title">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="title-icon">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6z"/>
                    </svg>
                    Detail Pesanan
                </h1>
                <p class="page-subtitle">Detail pesanan {{ $order->order_id }}</p>
            </div>
            <div class="header-right">
                <a href="{{ route('admin.marketplace.orders') }}" class="btn-secondary">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/>
                    </svg>
                    Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="detail-content">
        <!-- Order Summary -->
        <div class="detail-section">
            <div class="section-card">
                <div class="section-header">
                    <h2>Informasi Pesanan</h2>
                    <div class="order-status">
                        <span class="status-badge {{ $order->status }}">{{ ucfirst($order->status) }}</span>
                        <span class="payment-badge {{ $order->payment_status }}">{{ ucfirst($order->payment_status) }}</span>
                    </div>
                </div>
                
                <div class="info-grid">
                    <div class="info-item">
                        <label>Order ID</label>
                        <value class="order-id">{{ $order->order_id }}</value>
                    </div>
                    <div class="info-item">
                        <label>Tanggal Pesanan</label>
                        <value>{{ $order->created_at->format('d M Y, H:i') }} WIB</value>
                    </div>
                    <div class="info-item">
                        <label>Total Amount</label>
                        <value class="total-amount">{{ $order->formatted_total }}</value>
                    </div>
                    <div class="info-item">
                        <label>Payment Method</label>
                        <value>{{ ucfirst($order->payment_method ?? 'N/A') }}</value>
                    </div>
                    
                    @if($order->paid_at)
                    <div class="info-item">
                        <label>Tanggal Bayar</label>
                        <value>{{ $order->paid_at->format('d M Y, H:i') }} WIB</value>
                    </div>
                    @endif
                    
                    @if($order->shipped_at)
                    <div class="info-item">
                        <label>Tanggal Kirim</label>
                        <value>{{ $order->shipped_at->format('d M Y, H:i') }} WIB</value>
                    </div>
                    @endif
                    
                    @if($order->delivered_at)
                    <div class="info-item">
                        <label>Tanggal Terima</label>
                        <value>{{ $order->delivered_at->format('d M Y, H:i') }} WIB</value>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Customer Information -->
        <div class="detail-section">
            <div class="section-card">
                <div class="section-header">
                    <h2>Informasi Customer</h2>
                </div>
                
                <div class="customer-details">
                    <div class="customer-avatar">
                        {{ substr($order->customer_name, 0, 1) }}
                    </div>
                    <div class="customer-info-grid">
                        <div class="info-item">
                            <label>Nama Lengkap</label>
                            <value>{{ $order->customer_name }}</value>
                        </div>
                        <div class="info-item">
                            <label>Email</label>
                            <value>{{ $order->customer_email }}</value>
                        </div>
                        <div class="info-item">
                            <label>Nomor Telepon</label>
                            <value>{{ $order->customer_phone }}</value>
                        </div>
                        <div class="info-item">
                            <label>Kota</label>
                            <value>{{ $order->customer_city }}</value>
                        </div>
                        <div class="info-item span-2">
                            <label>Alamat Lengkap</label>
                            <value>{{ $order->customer_address }}</value>
                        </div>
                        <div class="info-item">
                            <label>Kode Pos</label>
                            <value>{{ $order->customer_postal_code }}</value>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Items -->
        <div class="detail-section">
            <div class="section-card">
                <div class="section-header">
                    <h2>Item Pesanan</h2>
                    <div class="items-summary">{{ count($order->items) }} item(s)</div>
                </div>
                
                <div class="items-list">
                    @foreach($order->items as $item)
                        <div class="item-row">
                            <div class="item-info">
                                <div class="item-name">{{ $item['name'] }}</div>
                                <div class="item-merchant">{{ $item['merchant_name'] ?? 'N/A' }}</div>
                            </div>
                            <div class="item-quantity">
                                <span class="quantity">{{ $item['quantity'] }}x</span>
                            </div>
                            <div class="item-price">
                                <div class="unit-price">Rp {{ number_format($item['price'], 0, ',', '.') }}</div>
                                <div class="total-price">Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</div>
                            </div>
                        </div>
                    @endforeach
                    
                    <div class="items-total">
                        <div class="total-row">
                            <span>Total Pesanan:</span>
                            <span class="total-amount">{{ $order->formatted_total }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Actions -->
        <div class="detail-section">
            <div class="section-card">
                <div class="section-header">
                    <h2>Aksi Pesanan</h2>
                </div>
                
                <form method="POST" action="{{ route('admin.marketplace.orders.status', $order->id) }}" class="status-form">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="status">Update Status Pesanan</label>
                        <div class="status-actions">
                            <select name="status" id="status" class="form-select">
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="paid" {{ $order->status == 'paid' ? 'selected' : '' }}>Paid</option>
                                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                            <button type="submit" class="btn-primary">Update Status</button>
                        </div>
                    </div>
                </form>
                
                @if($order->notes)
                <div class="notes-section">
                    <label>Catatan Pesanan</label>
                    <div class="notes-content">{{ $order->notes }}</div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
.order-detail {
    padding: 2rem;
    max-width: 1200px;
    margin: 0 auto;
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

.detail-content {
    display: grid;
    gap: 2rem;
}

.section-card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    overflow: hidden;
}

.section-header {
    padding: 1.5rem 2rem;
    border-bottom: 1px solid #e2e8f0;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.section-header h2 {
    font-size: 1.25rem;
    font-weight: 700;
    color: #1a202c;
}

.order-status {
    display: flex;
    gap: 0.5rem;
}

.status-badge, .payment-badge {
    padding: 0.25rem 0.75rem;
    border-radius: 6px;
    font-size: 0.75rem;
    font-weight: 600;
}

.status-badge.pending { background: #fef3c7; color: #92400e; }
.status-badge.paid { background: #d1fae5; color: #065f46; }
.status-badge.processing { background: #fef3c7; color: #92400e; }
.status-badge.shipped { background: #dbeafe; color: #1e40af; }
.status-badge.delivered { background: #dcfce7; color: #166534; }
.status-badge.cancelled { background: #fee2e2; color: #991b1b; }

.payment-badge.pending { background: #fef3c7; color: #92400e; }
.payment-badge.paid { background: #d1fae5; color: #065f46; }
.payment-badge.failed { background: #fee2e2; color: #991b1b; }

.info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
    padding: 2rem;
}

.info-item {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.info-item.span-2 {
    grid-column: span 2;
}

.info-item label {
    font-size: 0.875rem;
    font-weight: 600;
    color: #64748b;
}

.info-item value {
    font-size: 1rem;
    color: #1a202c;
}

.order-id {
    font-family: monospace;
    background: #f8fafc;
    padding: 0.5rem;
    border-radius: 6px;
    border: 1px solid #e2e8f0;
}

.total-amount {
    font-weight: 700;
    color: #059669;
    font-size: 1.125rem;
}

.customer-details {
    padding: 2rem;
    display: grid;
    grid-template-columns: auto 1fr;
    gap: 2rem;
    align-items: start;
}

.customer-avatar {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #0098ff, #0066cc);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    font-weight: 600;
}

.customer-info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1.5rem;
}

.items-list {
    padding: 0 2rem 2rem;
}

.item-row {
    display: grid;
    grid-template-columns: 2fr 1fr 1fr;
    gap: 1rem;
    padding: 1rem 0;
    border-bottom: 1px solid #f1f5f9;
    align-items: center;
}

.item-row:last-of-type {
    border-bottom: none;
}

.item-info {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.item-name {
    font-weight: 600;
    color: #1a202c;
}

.item-merchant {
    color: #64748b;
    font-size: 0.875rem;
}

.item-quantity {
    text-align: center;
}

.quantity {
    background: #f8fafc;
    color: #374151;
    padding: 0.25rem 0.75rem;
    border-radius: 6px;
    font-weight: 600;
    font-size: 0.875rem;
}

.item-price {
    text-align: right;
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.unit-price {
    color: #64748b;
    font-size: 0.875rem;
}

.total-price {
    font-weight: 600;
    color: #1a202c;
}

.items-total {
    border-top: 2px solid #e2e8f0;
    padding-top: 1rem;
    margin-top: 1rem;
}

.total-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 1.125rem;
    font-weight: 700;
}

.status-form {
    padding: 2rem;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.form-group label {
    font-weight: 600;
    color: #374151;
}

.status-actions {
    display: flex;
    gap: 1rem;
    align-items: center;
}

.form-select {
    padding: 0.75rem;
    border: 2px solid #e2e8f0;
    border-radius: 8px;
    font-size: 0.875rem;
    min-width: 200px;
}

.btn-primary {
    padding: 0.75rem 1.5rem;
    background: #0098ff;
    color: white;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    background: #0066cc;
}

.notes-section {
    margin-top: 2rem;
    padding-top: 2rem;
    border-top: 1px solid #e2e8f0;
}

.notes-section label {
    font-weight: 600;
    color: #374151;
    margin-bottom: 0.5rem;
    display: block;
}

.notes-content {
    background: #f8fafc;
    padding: 1rem;
    border-radius: 8px;
    border-left: 4px solid #0098ff;
}

.items-summary {
    color: #64748b;
    font-size: 0.875rem;
}

@media (max-width: 768px) {
    .order-detail {
        padding: 1rem;
    }
    
    .header-content {
        flex-direction: column;
        gap: 1rem;
        align-items: stretch;
    }
    
    .info-grid {
        grid-template-columns: 1fr;
        padding: 1rem;
    }
    
    .info-item.span-2 {
        grid-column: span 1;
    }
    
    .customer-details {
        grid-template-columns: 1fr;
        gap: 1rem;
        padding: 1rem;
    }
    
    .customer-info-grid {
        grid-template-columns: 1fr;
    }
    
    .item-row {
        grid-template-columns: 1fr;
        gap: 0.5rem;
        text-align: left;
    }
    
    .item-price {
        text-align: left;
    }
    
    .status-actions {
        flex-direction: column;
        align-items: stretch;
    }
}
</style>
@endsection