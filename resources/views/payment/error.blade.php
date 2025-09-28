@extends('layouts.public')

@section('title', $title)

@section('content')
<section class="payment-status-section">
    <div class="container">
        <div class="payment-status-card">
            <div class="status-icon error">
                <svg width="64" height="64" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
                </svg>
            </div>
            
            <h1>{{ $title }}</h1>
            <p>{{ $message }}</p>
            
            <div class="status-actions">
                <a href="{{ route('toko.checkout') }}" class="btn btn-primary">
                    Coba Lagi
                </a>
                <a href="{{ route('toko.index') }}" class="btn btn-secondary">
                    Kembali ke Toko
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

.status-icon.error {
    background: #fee2e2;
    color: #ef4444;
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

.btn-secondary {
    background: #f1f5f9;
    color: #64748b;
    border: 2px solid #e2e8f0;
}

.btn-secondary:hover {
    background: #e2e8f0;
}
</style>
@endsection