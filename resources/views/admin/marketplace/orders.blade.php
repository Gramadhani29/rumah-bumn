@extends('layouts.admin')

@section('title', 'Kelola Pesanan')

@section('content')
<div class="admin-main">
    <div class="admin-container">
        <!-- Header -->
        <div class="admin-page-header">
            <div class="admin-page-title">
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                    <a href="{{ route('admin.marketplace.index') }}" style="display: flex; align-items: center; justify-content: center; width: 32px; height: 32px; background: #f3f4f6; border-radius: 8px; transition: all 0.2s; text-decoration: none;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" style="color: #374151;">
                            <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/>
                        </svg>
                    </a>
                    <div>
                        <h1>KELOLA PESANAN</h1>
                        <p>Kelola semua pesanan dari marketplace UMKM</p>
                    </div>
                </div>
            </div>
        </div>

    <!-- Filters -->
    <div class="filters-section">
        <div class="filters-card">
            <form method="GET" action="{{ route('admin.marketplace.orders') }}" class="filters-form">
                <div class="filter-group">
                    <label>Status</label>
                    <select name="status" class="filter-select">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label>Dari Tanggal</label>
                    <input type="date" name="date_from" value="{{ request('date_from') }}" class="filter-input">
                </div>

                <div class="filter-group">
                    <label>Sampai Tanggal</label>
                    <input type="date" name="date_to" value="{{ request('date_to') }}" class="filter-input">
                </div>

                <div class="filter-group">
                    <label>Cari</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Nama user atau event..." class="filter-input">
                </div>

                <div class="filter-actions">
                    <button type="submit" class="btn-primary">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5 6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
                        </svg>
                        Filter
                    </button>
                    @if(request()->hasAny(['status', 'date_from', 'date_to', 'search']))
                        <a href="{{ route('admin.marketplace.orders') }}" class="btn-secondary">Reset</a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <!-- Orders List -->
    <div class="orders-section">
        <div class="orders-card">
            @if($orders->count() > 0)
                <div class="orders-table">
                    <div class="table-header">
                        <div class="table-row">
                            <div class="table-cell">Customer</div>
                            <div class="table-cell">Order ID</div>
                            <div class="table-cell">Total</div>
                            <div class="table-cell">Tanggal</div>
                            <div class="table-cell">Status</div>
                            <div class="table-cell">Aksi</div>
                        </div>
                    </div>
                    <div class="table-body">
                        @foreach($orders as $order)
                            <div class="table-row">
                                <div class="table-cell">
                                    <div class="customer-info">
                                        <div class="customer-avatar">
                                            {{ substr($order->customer_name, 0, 1) }}
                                        </div>
                                        <div class="customer-details">
                                            <div class="customer-name">{{ $order->customer_name }}</div>
                                            <div class="customer-email">{{ $order->customer_email }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-cell">
                                    <div class="order-info">
                                        <div class="order-id">{{ $order->order_id }}</div>
                                        <div class="order-items">{{ $order->total_items }} item(s)</div>
                                    </div>
                                </div>
                                <div class="table-cell">
                                    <div class="total-info">
                                        <div class="total-amount">{{ $order->formatted_total }}</div>
                                        <div class="payment-status">{{ ucfirst($order->payment_status) }}</div>
                                    </div>
                                </div>
                                <div class="table-cell">
                                    <div class="date-info">
                                        <div class="order-date">{{ $order->created_at->format('d M Y') }}</div>
                                        <div class="order-time">{{ $order->created_at->format('H:i') }}</div>
                                    </div>
                                </div>
                                <div class="table-cell">
                                    <form method="POST" action="{{ route('admin.marketplace.orders.status', $order->id) }}" class="status-form">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" class="status-select {{ $order->status }}" onchange="this.form.submit()">
                                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="paid" {{ $order->status == 'paid' ? 'selected' : '' }}>Paid</option>
                                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                            <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                            <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        </select>
                                    </form>
                                </div>
                                <div class="table-cell">
                                    <div class="action-buttons">
                                        <a href="{{ route('admin.marketplace.orders.show', $order->id) }}" class="btn-action view" title="Lihat Detail">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Pagination -->
                <div class="pagination-wrapper">
                    {{ $orders->appends(request()->query())->links() }}
                </div>
            @else
                <div class="empty-state">
                    <div class="empty-icon">
                        <svg width="64" height="64" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6z"/>
                        </svg>
                    </div>
                    <h3>Belum Ada Pesanan</h3>
                    <p>Belum ada pesanan yang masuk sesuai filter yang dipilih.</p>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
.orders-management {
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

.btn-primary {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1rem;
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

.orders-section {
    margin-bottom: 2rem;
}

.orders-card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    overflow: hidden;
}

.orders-table {
    width: 100%;
}

.table-header {
    background: #f8fafc;
    border-bottom: 1px solid #e2e8f0;
}

.table-row {
    display: grid;
    grid-template-columns: 2fr 1.5fr 1.5fr 1fr 1fr 1fr;
    gap: 1rem;
    padding: 1rem 1.5rem;
    align-items: center;
}

.table-header .table-row {
    font-weight: 600;
    color: #374151;
    font-size: 0.875rem;
}

.table-body .table-row {
    border-bottom: 1px solid #f1f5f9;
    transition: background-color 0.3s ease;
}

.table-body .table-row:hover {
    background: #f8fafc;
}

.table-body .table-row:last-child {
    border-bottom: none;
}

.customer-info {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.customer-avatar {
    width: 40px;
    height: 40px;
    border-radius: 8px;
    background: #0098ff;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 0.875rem;
}

.customer-name {
    font-weight: 600;
    color: #1a202c;
    font-size: 0.875rem;
}

.customer-email {
    color: #64748b;
    font-size: 0.75rem;
}

.event-name {
    font-weight: 600;
    color: #1a202c;
    font-size: 0.875rem;
    margin-bottom: 0.125rem;
}

.event-meta {
    color: #64748b;
    font-size: 0.75rem;
}

.order-info {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.order-id {
    font-weight: 600;
    color: #1a202c;
    font-size: 0.875rem;
    font-family: monospace;
}

.order-items {
    color: #64748b;
    font-size: 0.75rem;
}

.total-info {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.total-amount {
    font-weight: 700;
    color: #059669;
    font-size: 0.875rem;
}

.payment-status {
    color: #64748b;
    font-size: 0.75rem;
    text-transform: capitalize;
}

.order-date {
    font-weight: 600;
    color: #1a202c;
    font-size: 0.875rem;
}

.order-time {
    color: #64748b;
    font-size: 0.75rem;
}

.status-select {
    padding: 0.5rem 0.75rem;
    border: 2px solid #e2e8f0;
    border-radius: 6px;
    font-size: 0.75rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.status-select.pending {
    background: #fef3c7;
    color: #92400e;
    border-color: #f59e0b;
}

.status-select.confirmed {
    background: #d1fae5;
    color: #065f46;
    border-color: #10b981;
}

.status-select.paid {
    background: #d1fae5;
    color: #065f46;
    border-color: #10b981;
}

.status-select.processing {
    background: #fef3c7;
    color: #92400e;
    border-color: #f59e0b;
}

.status-select.shipped {
    background: #dbeafe;
    color: #1e40af;
    border-color: #3b82f6;
}

.status-select.delivered {
    background: #dcfce7;
    color: #166534;
    border-color: #22c55e;
}

.status-select.cancelled {
    background: #fee2e2;
    color: #991b1b;
    border-color: #ef4444;
}

.btn-action {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    border-radius: 6px;
    text-decoration: none;
    transition: all 0.3s ease;
}

.btn-action.view {
    background: #dbeafe;
    color: #1e40af;
}

.btn-action.view:hover {
    background: #bfdbfe;
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
}

@media (max-width: 768px) {
    .orders-management {
        padding: 1rem;
    }
    
    .header-content {
        flex-direction: column;
        gap: 1rem;
        align-items: stretch;
    }
    
    .filters-form {
        grid-template-columns: 1fr;
    }
    
    .table-row {
        grid-template-columns: 1fr;
        gap: 0.5rem;
    }
    
    .table-header {
        display: none;
    }
    
    .table-body .table-row {
        padding: 1rem;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        margin-bottom: 1rem;
    }
}
</style>
@endsection