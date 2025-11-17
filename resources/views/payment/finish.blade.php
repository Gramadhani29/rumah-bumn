@extends('layouts.public')

@section('title', $title)

@section('content')
<section class="payment-status-section">
    <div class="container">
        <div class="payment-status-card">
            <div class="status-icon success">
                <svg width="64" height="64" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                </svg>
            </div>
            
            <h1>{{ $title }}</h1>
            <p>{{ $message }}</p>
            
            <div class="status-actions">
                <a href="{{ route('toko.index') }}" class="btn btn-primary">
                    Lanjut Belanja
                </a>
            </div>
        </div>
    </div>
</section>

<style>
.payment-status-section {
    padding: 4rem 0;
    background: #f8fafc;
    min-height: 60vh;
    display: flex;
    align-items: center;
}

.payment-status-card {
    background: white;
    border-radius: 16px;
    padding: 3rem;
    text-align: center;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    max-width: 500px;
    margin: 0 auto;
}

.status-icon {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 2rem;
}

.status-icon.success {
    background: #d1fae5;
    color: #10b981;
}

.payment-status-card h1 {
    font-size: 1.75rem;
    font-weight: 700;
    color: #1a202c;
    margin-bottom: 1rem;
}

.payment-status-card p {
    color: #64748b;
    margin-bottom: 2rem;
    font-size: 1.125rem;
}

.status-actions {
    display: flex;
    gap: 1rem;
    justify-content: center;
}

.btn {
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
}

.btn-primary {
    background: #0098ff;
    color: white;
}

.btn-primary:hover {
    background: #0066cc;
}
</style>
@endsection