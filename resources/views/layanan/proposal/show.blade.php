@extends('layouts.public')

@section('title', 'Proposal ' . $proposal->proposal_code . ' - Rumah BUMN Telkom Pekalongan')
@section('description', 'Detail proposal kegiatan ' . $proposal->nama_kegiatan)

@section('content')
    <!-- Page Header -->
    <section class="page-header-section">
        <div class="container">
            <div class="page-header-content">
                <nav class="breadcrumb">
                    <a href="{{ url('/') }}">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                        </svg>
                        Beranda
                    </a>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M8.59 16.59L10 18l6-6-6-6-1.41 1.41L13.17 12z"/>
                    </svg>
                    <a href="{{ route('booking.index') }}">Layanan</a>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M8.59 16.59L10 18l6-6-6-6-1.41 1.41L13.17 12z"/>
                    </svg>
                    <span>Detail Proposal</span>
                </nav>
                
                <h1>Detail Proposal Kegiatan</h1>
                <p>{{ $proposal->proposal_code }}</p>
            </div>
        </div>
    </section>

    <!-- Proposal Details Section -->
    <section class="proposal-details-section section">
        <div class="container">
            <div class="proposal-container">
                <!-- Main Content -->
                <div class="proposal-content">
                    <!-- Status Card -->
                    <div class="status-card">
                        <div class="status-header">
                            <div class="status-icon {{ $proposal->status_color }}">
                                @if($proposal->status === 'pending')
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                    </svg>
                                @elseif($proposal->status === 'approved')
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                                    </svg>
                                @elseif($proposal->status === 'rejected')
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
                                    </svg>
                                @else
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
                                    </svg>
                                @endif
                            </div>
                            <div class="status-content">
                                <h3>Status: {{ $proposal->status_label }}</h3>
                                <p>Diajukan pada {{ $proposal->submitted_at->format('d M Y, H:i') }}</p>
                                @if($proposal->approved_at)
                                    <p>{{ $proposal->status === 'approved' ? 'Disetujui' : 'Diperbarui' }} pada {{ $proposal->approved_at->format('d M Y, H:i') }}</p>
                                @endif
                            </div>
                        </div>
                        
                        @if($proposal->admin_notes)
                            <div class="admin-notes">
                                <h4>Catatan Admin:</h4>
                                <p>{{ $proposal->admin_notes }}</p>
                            </div>
                        @endif
                    </div>

                    <!-- Proposal Info -->
                    <div class="proposal-info-card">
                        <div class="info-header">
                            <h2>{{ $proposal->nama_kegiatan }}</h2>
                            <span class="kategori-badge {{ $proposal->kategori }}">
                                @if($proposal->kategori === 'pelatihan')
                                    🎓 {{ $proposal->kategori_label }}
                                @elseif($proposal->kategori === 'kerja_sama')
                                    🤝 {{ $proposal->kategori_label }}
                                @else
                                    🎪 {{ $proposal->kategori_label }}
                                @endif
                            </span>
                        </div>

                        <div class="info-grid">
                            <div class="info-item">
                                <div class="info-icon">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11z"/>
                                    </svg>
                                </div>
                                <div class="info-content">
                                    <h4>Tanggal & Waktu</h4>
                                    <p>{{ $proposal->tanggal_kegiatan->format('d M Y') }}</p>
                                    <p>{{ \Carbon\Carbon::parse($proposal->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($proposal->jam_selesai)->format('H:i') }} ({{ $proposal->duration_hours }} jam)</p>
                                </div>
                            </div>

                            <div class="info-item">
                                <div class="info-icon">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M16 7c0-2.21-1.79-4-4-4S8 4.79 8 7s1.79 4 4 4 4-1.79 4-4zm-4 6c-2.67 0-8 1.34-8 4v3h16v-3c0-2.66-5.33-4-8-4z"/>
                                    </svg>
                                </div>
                                <div class="info-content">
                                    <h4>Estimasi Peserta</h4>
                                    <p>{{ number_format($proposal->estimasi_peserta) }} orang</p>
                                </div>
                            </div>
                        </div>

                        <div class="description-section">
                            <h4>Deskripsi Kegiatan</h4>
                            <div class="description-content">
                                {{ $proposal->deskripsi_kegiatan }}
                            </div>
                        </div>

                        @if($proposal->kebutuhan_khusus)
                            <div class="requirements-section">
                                <h4>Kebutuhan Khusus</h4>
                                <div class="requirements-content">
                                    {{ $proposal->kebutuhan_khusus }}
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Contact Info -->
                    <div class="contact-info-card">
                        <h3>Informasi Kontak</h3>
                        <div class="contact-grid">
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                    </svg>
                                </div>
                                <div class="contact-content">
                                    <h4>Nama Lengkap</h4>
                                    <p>{{ $proposal->contact_name }}</p>
                                </div>
                            </div>

                            <div class="contact-item">
                                <div class="contact-icon">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
                                    </svg>
                                </div>
                                <div class="contact-content">
                                    <h4>Nomor HP/WA</h4>
                                    <p>{{ $proposal->contact_phone }}</p>
                                </div>
                            </div>

                            @if($proposal->contact_email)
                                <div class="contact-item">
                                    <div class="contact-icon">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                                        </svg>
                                    </div>
                                    <div class="contact-content">
                                        <h4>Email</h4>
                                        <p>{{ $proposal->contact_email }}</p>
                                    </div>
                                </div>
                            @endif

                            @if($proposal->organisasi)
                                <div class="contact-item">
                                    <div class="contact-icon">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12 7V3H2v18h20V7H12zM6 19H4v-2h2v2zm0-4H4v-2h2v2zm0-4H4V9h2v2zm0-4H4V5h2v2zm4 12H8v-2h2v2zm0-4H8v-2h2v2zm0-4H8V9h2v2zm0-4H8V5h2v2zm10 12h-8v-2h2v-2h-2v-2h2v-2h-2V9h8v10zm-2-8h-2v2h2v-2zm0 4h-2v2h2v-2z"/>
                                        </svg>
                                    </div>
                                    <div class="contact-content">
                                        <h4>Organisasi</h4>
                                        <p>{{ $proposal->organisasi }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="actions-card">
                        @if($proposal->canBeCancelled() && auth()->check() && auth()->id() === $proposal->user_id)
                            <form action="{{ route('proposal.cancel', $proposal) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn-danger" onclick="return confirm('Apakah Anda yakin ingin membatalkan proposal ini?')">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
                                    </svg>
                                    Batalkan Proposal
                                </button>
                            </form>
                        @endif
                        
                        <a href="{{ route('booking.index') }}" class="btn-secondary">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M19 7v4H5.83l3.58-3.59L8 6l-6 6 6 6 1.41-1.41L5.83 13H21V7z"/>
                            </svg>
                            Kembali ke Layanan
                        </a>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="proposal-sidebar">
                    <div class="sidebar-card">
                        <h4>ℹ️ Informasi Proposal</h4>
                        <div class="proposal-meta">
                            <div class="meta-item">
                                <strong>Kode Proposal:</strong>
                                <span>{{ $proposal->proposal_code }}</span>
                            </div>
                            <div class="meta-item">
                                <strong>Tanggal Pengajuan:</strong>
                                <span>{{ $proposal->submitted_at->format('d M Y, H:i') }}</span>
                            </div>
                            <div class="meta-item">
                                <strong>Status:</strong>
                                <span class="status-badge {{ $proposal->status_color }}">{{ $proposal->status_label }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="sidebar-card">
                        <h4>📞 Butuh Bantuan?</h4>
                        <p>Hubungi tim kami untuk informasi lebih lanjut:</p>
                        <div class="help-contacts">
                            <div class="help-item">
                                <span>📱 WhatsApp: 0285-123456</span>
                            </div>
                            <div class="help-item">
                                <span>📧 Email: info@rumahbumn.com</span>
                            </div>
                        </div>
                    </div>

                    @auth
                        @if(auth()->id() === $proposal->user_id)
                            <div class="sidebar-card">
                                <h4>📋 Proposal Saya</h4>
                                <p>Lihat semua proposal yang pernah Anda ajukan</p>
                                <a href="{{ route('proposal.my-proposals') }}" class="btn-outline">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M14 2H6c-1.1 0-2 .9-2 2v16c0 1.1.89 2 2 2h12c1.1 0 2-.9 2-2V8l-6-6zm-3 7V3.5L16.5 9H11z"/>
                                    </svg>
                                    Lihat Proposal Saya
                                </a>
                            </div>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
<style>
.proposal-details-section {
    padding: 2rem 0;
    background: #f8f9fa;
}

.proposal-container {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 2rem;
    max-width: 1200px;
    margin: 0 auto;
}

/* Status Card */
.status-card {
    background: white;
    border-radius: 16px;
    padding: 2rem;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    margin-bottom: 2rem;
}

.status-header {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.status-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
}

.status-icon.warning { background: #f39c12; }
.status-icon.success { background: #27ae60; }
.status-icon.danger { background: #e74c3c; }
.status-icon.secondary { background: #6c757d; }

.status-content h3 {
    color: #2c3e50;
    margin-bottom: 0.5rem;
    font-size: 1.5rem;
}

.status-content p {
    color: #6c757d;
    margin: 0;
    font-size: 0.9rem;
}

.admin-notes {
    background: #f8f9fa;
    border-radius: 10px;
    padding: 1.5rem;
    border-left: 4px solid #667eea;
}

.admin-notes h4 {
    color: #2c3e50;
    margin-bottom: 0.75rem;
}

.admin-notes p {
    color: #6c757d;
    margin: 0;
    line-height: 1.6;
}

/* Proposal Info Card */
.proposal-info-card {
    background: white;
    border-radius: 16px;
    padding: 2rem;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    margin-bottom: 2rem;
}

.info-header {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    margin-bottom: 2rem;
    flex-wrap: wrap;
    gap: 1rem;
}

.info-header h2 {
    color: #2c3e50;
    margin: 0;
    font-size: 1.75rem;
    flex: 1;
}

.kategori-badge {
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-weight: 600;
    font-size: 0.9rem;
}

.kategori-badge.pelatihan { background: #e8f5e8; color: #27ae60; }
.kategori-badge.kerja_sama { background: #e3f2fd; color: #2196f3; }
.kategori-badge.event { background: #fff3e0; color: #ff9800; }

.info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.info-item {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 1.5rem;
    background: #f8f9fa;
    border-radius: 12px;
}

.info-icon {
    color: #667eea;
    flex-shrink: 0;
}

.info-content h4 {
    color: #2c3e50;
    margin-bottom: 0.5rem;
    font-weight: 600;
}

.info-content p {
    color: #6c757d;
    margin: 0.25rem 0;
    font-size: 0.9rem;
}

.description-section,
.requirements-section {
    margin-bottom: 2rem;
}

.description-section h4,
.requirements-section h4 {
    color: #2c3e50;
    margin-bottom: 1rem;
    font-size: 1.25rem;
}

.description-content,
.requirements-content {
    background: #f8f9fa;
    padding: 1.5rem;
    border-radius: 10px;
    line-height: 1.7;
    color: #6c757d;
    white-space: pre-line;
}

/* Contact Info Card */
.contact-info-card {
    background: white;
    border-radius: 16px;
    padding: 2rem;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    margin-bottom: 2rem;
}

.contact-info-card h3 {
    color: #2c3e50;
    margin-bottom: 1.5rem;
    font-size: 1.5rem;
}

.contact-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
}

.contact-item {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 1rem;
    background: #f8f9fa;
    border-radius: 10px;
}

.contact-icon {
    color: #667eea;
    flex-shrink: 0;
}

.contact-content h4 {
    color: #2c3e50;
    margin-bottom: 0.5rem;
    font-weight: 600;
}

.contact-content p {
    color: #6c757d;
    margin: 0;
    font-size: 0.9rem;
}

/* Actions Card */
.actions-card {
    background: white;
    border-radius: 16px;
    padding: 2rem;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    display: flex;
    gap: 1rem;
    justify-content: flex-end;
    flex-wrap: wrap;
}

.btn-danger,
.btn-secondary,
.btn-outline {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.875rem 1.5rem;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    text-decoration: none;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-danger {
    background: #e74c3c;
    color: white;
}

.btn-danger:hover {
    background: #c0392b;
    transform: translateY(-2px);
}

.btn-secondary {
    background: #6c757d;
    color: white;
}

.btn-secondary:hover {
    background: #5a6268;
    transform: translateY(-2px);
}

.btn-outline {
    background: white;
    color: #667eea;
    border: 2px solid #667eea;
}

.btn-outline:hover {
    background: #667eea;
    color: white;
    transform: translateY(-2px);
}

/* Sidebar */
.proposal-sidebar {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.sidebar-card {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

.sidebar-card h4 {
    color: #2c3e50;
    margin-bottom: 1rem;
    font-size: 1.1rem;
}

.proposal-meta {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.meta-item {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.meta-item strong {
    color: #2c3e50;
    font-size: 0.9rem;
}

.meta-item span {
    color: #6c757d;
    font-size: 0.9rem;
}

.status-badge {
    display: inline-block;
    padding: 0.25rem 0.75rem;
    border-radius: 12px;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
}

.status-badge.warning { background: #fff3cd; color: #856404; }
.status-badge.success { background: #d4edda; color: #155724; }
.status-badge.danger { background: #f8d7da; color: #721c24; }
.status-badge.secondary { background: #e2e3e5; color: #383d41; }

.help-contacts,
.help-item {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.help-item span {
    color: #6c757d;
    font-size: 0.9rem;
}

@media (max-width: 768px) {
    .proposal-container {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .info-header {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .actions-card {
        flex-direction: column;
    }
    
    .btn-danger,
    .btn-secondary,
    .btn-outline {
        width: 100%;
        justify-content: center;
    }
}
</style>
@endpush