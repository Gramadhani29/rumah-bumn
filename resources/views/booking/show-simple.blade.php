@extends('layouts.public-booking')@extends('layouts.public-booking')



@section('title', 'Booking #' . $booking->booking_code . ' - Rumah BUMN Telkom Pekalongan')@section('title', 'Booking #' . $booking->booking_code . ' - Rumah BUMN Telkom Pekalongan')

@section('description', 'Detail booking ruangan ' . $booking->room->name)@section('description', 'Detail booking ruangan ' . $booking->room->name)



@section('content')@section('content')

<div class="booking-container">/* Simple inline styles for booking show page */

    <!-- Page Header -->body {

    <div class="page-header">    background-color: #f8f9fa;

        <nav class="breadcrumb">    font-family: 'Inter', sans-serif;

            <a href="{{ url('/') }}">🏠 Beranda</a> › }

            <a href="{{ route('booking.index') }}">Booking Ruangan</a> › 

            <span style="color: #fbbf24;">{{ $booking->booking_code }}</span>.booking-container {

        </nav>    max-width: 1200px;

            margin: 0 auto;

        <h1 class="page-title">Booking #{{ $booking->booking_code }}</h1>    padding: 20px;

        <p class="page-subtitle">{{ $booking->room->name }} • {{ $booking->formatted_date }} • {{ $booking->formatted_time }}</p>}

    </div>

.page-header {

    <div class="booking-grid">    background: linear-gradient(135deg, #1e293b 0%, #334155 100%);

        <!-- Status Card -->    color: white;

        <div class="status-card">    padding: 40px 20px;

            <div class="status-header">    margin: -20px -20px 30px -20px;

                <div class="status-icon {{ $booking->status }}">    border-radius: 0 0 16px 16px;

                    @if($booking->status === 'pending')}

                        ⏳

                    @elseif($booking->status === 'confirmed').breadcrumb {

                        ✅    margin-bottom: 20px;

                    @elseif($booking->status === 'cancelled')    font-size: 14px;

                        ❌}

                    @else

                        🎉.breadcrumb a {

                    @endif    color: #cbd5e1;

                </div>    text-decoration: none;

                <div class="status-info">    margin-right: 8px;

                    <h3>{{ $booking->status_label }}</h3>}

                    <p class="status-code">{{ $booking->booking_code }}</p>

                    <span class="status-badge {{ $booking->status }}">.breadcrumb a:hover {

                        @if($booking->status === 'pending') MENUNGGU KONFIRMASI    color: white;

                        @elseif($booking->status === 'confirmed') DIKONFIRMASI}

                        @elseif($booking->status === 'cancelled') DIBATALKAN

                        @else SELESAI.page-title {

                        @endif    font-size: 2rem;

                    </span>    font-weight: 700;

                </div>    margin: 0;

            </div>}

            

            <div class="status-body">.page-subtitle {

                <div class="status-message">    color: #cbd5e1;

                    @if($booking->status === 'pending')    margin: 8px 0 0 0;

                        <h4>⏳ Menunggu Konfirmasi</h4>}

                        <p>Booking Anda sedang direview oleh admin. Kami akan mengkonfirmasi dalam 24 jam.</p>

                        <div class="next-steps">.booking-grid {

                            <h5>Langkah selanjutnya:</h5>    display: grid;

                            <ul>    grid-template-columns: 1fr 2fr;

                                <li>Tunggu email/SMS konfirmasi dari admin</li>    gap: 30px;

                                <li>Simpan bukti booking ini sebagai PDF</li>    margin-top: 30px;

                                <li>Siapkan dokumen yang diperlukan</li>}

                            </ul>

                        </div>.status-card {

                    @elseif($booking->status === 'confirmed')    background: white;

                        <h4>✅ Booking Dikonfirmasi!</h4>    border-radius: 12px;

                        <p>Booking Anda telah dikonfirmasi. Silakan datang sesuai waktu yang dijadwalkan.</p>    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);

                        @if($booking->confirmed_at)    height: fit-content;

                            <small style="color: #94a3b8; font-style: italic;">Dikonfirmasi pada: {{ $booking->confirmed_at->format('d M Y H:i') }}</small>    overflow: hidden;

                        @endif}

                        <div class="next-steps">

                            <h5>Yang perlu Anda bawa:</h5>.status-header {

                            <ul>    background: linear-gradient(135deg, #1e293b 0%, #334155 100%);

                                <li>Bukti booking (PDF atau screenshot)</li>    color: white;

                                <li>Kartu identitas yang valid</li>    padding: 30px;

                                <li>Datang 10 menit sebelum waktu booking</li>    display: flex;

                            </ul>    align-items: center;

                        </div>    gap: 20px;

                    @elseif($booking->status === 'cancelled')}

                        <h4>❌ Booking Dibatalkan</h4>

                        <p>Booking ini telah dibatalkan.</p>.status-icon {

                        @if($booking->cancelled_at)    width: 60px;

                            <small style="color: #94a3b8; font-style: italic;">Dibatalkan pada: {{ $booking->cancelled_at->format('d M Y H:i') }}</small>    height: 60px;

                        @endif    border-radius: 50%;

                        <div class="next-steps">    display: flex;

                            <h5>Anda dapat:</h5>    align-items: center;

                            <ul>    justify-content: center;

                                <li>Membuat booking baru dengan waktu berbeda</li>    flex-shrink: 0;

                                <li>Menghubungi admin untuk informasi lebih lanjut</li>}

                            </ul>

                        </div>.status-icon.pending {

                    @else    background: #f59e0b;

                        <h4>🎉 Booking Selesai</h4>}

                        <p>Terima kasih telah menggunakan fasilitas kami!</p>

                        <div class="next-steps">.status-icon.confirmed {

                            <h5>Feedback:</h5>    background: #10b981;

                            <p>Kami sangat menghargai feedback Anda untuk meningkatkan layanan kami.</p>}

                        </div>

                    @endif.status-icon.cancelled {

                </div>    background: #ef4444;

            </div>}

        </div>

.status-icon.completed {

        <!-- Booking Info -->    background: #6366f1;

        <div class="info-card">}

            <div class="card-header">

                <h3>📋 Informasi Booking</h3>.status-info h3 {

            </div>    font-size: 1.5rem;

                margin: 0 0 8px 0;

            <!-- Room Info -->}

            <div class="info-section">

                <h4 class="section-title">🏢 Detail Ruangan</h4>.status-code {

                <div class="room-card">    font-family: monospace;

                    <div class="room-icon">🏢</div>    opacity: 0.8;

                    <div class="room-details">    margin: 0 0 10px 0;

                        <h5>{{ $booking->room->name }}</h5>}

                        <p class="room-capacity">👥 {{ $booking->room->capacity }} orang</p>

                        @if($booking->room->description).status-badge {

                            <p style="color: #64748b; font-size: 14px; margin-top: 8px;">{{ $booking->room->description }}</p>    display: inline-block;

                        @endif    padding: 4px 12px;

                    </div>    border-radius: 12px;

                </div>    font-size: 12px;

            </div>    font-weight: 600;

                text-transform: uppercase;

            <!-- Time Info -->}

            <div class="info-section">

                <h4 class="section-title">⏰ Waktu & Tanggal</h4>.status-badge.pending {

                <div class="info-grid">    background: rgba(245, 158, 11, 0.2);

                    <div class="info-item">    color: #f59e0b;

                        <p class="info-label">📅 Tanggal</p>}

                        <p class="info-value">{{ $booking->formatted_date }}</p>

                    </div>.status-badge.confirmed {

                    <div class="info-item">    background: rgba(16, 185, 129, 0.2);

                        <p class="info-label">🕐 Waktu</p>    color: #10b981;

                        <p class="info-value">{{ $booking->formatted_time }}</p>}

                    </div>

                    <div class="info-item">.status-badge.cancelled {

                        <p class="info-label">⏱️ Durasi</p>    background: rgba(239, 68, 68, 0.2);

                        <p class="info-value">{{ $booking->duration_hours }} jam</p>    color: #ef4444;

                    </div>}

                </div>

            </div>.status-badge.completed {

                background: rgba(99, 102, 241, 0.2);

            <!-- Contact Info -->    color: #6366f1;

            <div class="info-section">}

                <h4 class="section-title">👤 Informasi Kontak</h4>

                <div class="info-grid">.status-body {

                    <div class="info-item">    padding: 30px;

                        <p class="info-label">👤 Nama Lengkap</p>}

                        <p class="info-value">{{ $booking->contact_name }}</p>

                    </div>.status-message h4 {

                    <div class="info-item">    color: #1e293b;

                        <p class="info-label">📱 No. Telepon</p>    margin: 0 0 12px 0;

                        <p class="info-value">{{ $booking->contact_phone }}</p>}

                    </div>

                    @if($booking->contact_email).status-message p {

                        <div class="info-item">    color: #64748b;

                            <p class="info-label">📧 Email</p>    line-height: 1.6;

                            <p class="info-value">{{ $booking->contact_email }}</p>    margin: 0 0 20px 0;

                        </div>}

                    @endif

                    @if($booking->organization).next-steps {

                        <div class="info-item">    background: #f8fafc;

                            <p class="info-label">🏢 Organisasi</p>    border: 1px solid #e2e8f0;

                            <p class="info-value">{{ $booking->organization }}</p>    border-radius: 8px;

                        </div>    padding: 16px;

                    @endif    margin-top: 20px;

                </div>}

            </div>

            .next-steps h5 {

            <!-- Event Info -->    color: #475569;

            <div class="info-section">    font-size: 14px;

                <h4 class="section-title">📝 Detail Acara</h4>    margin: 0 0 12px 0;

                <div class="info-item">}

                    <p class="info-label">🎯 Tujuan Penggunaan</p>

                    <p class="info-value">{{ $booking->purpose }}</p>.next-steps ul {

                </div>    margin: 0;

                @if($booking->notes)    padding-left: 20px;

                    <div class="info-item" style="margin-top: 16px;">}

                        <p class="info-label">📝 Catatan Tambahan</p>

                        <p class="info-value">{{ $booking->notes }}</p>.next-steps li {

                    </div>    color: #64748b;

                @endif    margin-bottom: 4px;

            </div>}

        </div>

    </div>.info-card {

        background: white;

    <!-- Action Buttons -->    border-radius: 12px;

    <div class="action-buttons">    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);

        <a href="{{ route('booking.download-pdf', $booking) }}" class="btn btn-download" target="_blank">    overflow: hidden;

            📄 Download Bukti PDF}

        </a>

        <a href="{{ route('booking.index') }}" class="btn btn-new">.card-header {

            📅 Booking Ruangan Lagi    background: #f8fafc;

        </a>    border-bottom: 1px solid #e2e8f0;

    </div>    padding: 24px;

    }

    <!-- Help Card -->

    <div class="help-card">.card-header h3 {

        <h4>🆘 Perlu Bantuan?</h4>    color: #1e293b;

        <p>Hubungi admin melalui:</p>    margin: 0;

        <div class="contact-links">    font-size: 1.25rem;

            <a href="tel:+628123456789">📞 (0285) 123-456</a>}

            <a href="mailto:admin@rumahbumn.id">📧 admin@rumahbumn.id</a>

        </div>.info-section {

    </div>    padding: 24px;

</div>    border-bottom: 1px solid #f1f5f9;

@endsection}

.info-section:last-child {
    border-bottom: none;
}

.section-title {
    color: #334155;
    font-size: 1.1rem;
    font-weight: 600;
    margin: 0 0 16px 0;
}

.info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 16px;
}

.info-item {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 16px;
}

.info-label {
    color: #64748b;
    font-size: 14px;
    font-weight: 500;
    margin: 0 0 4px 0;
}

.info-value {
    color: #1e293b;
    font-weight: 600;
    margin: 0;
}

.room-card {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 20px;
    display: flex;
    gap: 16px;
    align-items: center;
}

.room-icon {
    width: 60px;
    height: 60px;
    background: #6366f1;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    flex-shrink: 0;
}

.room-details h5 {
    color: #1e293b;
    margin: 0 0 8px 0;
    font-size: 1.1rem;
}

.room-capacity {
    color: #64748b;
    margin: 0;
}

.action-buttons {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-top: 30px;
}

.btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    padding: 16px 24px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-download {
    background: #10b981;
    color: white;
}

.btn-download:hover {
    background: #059669;
    color: white;
    text-decoration: none;
    transform: translateY(-1px);
}

.btn-new {
    background: #6366f1;
    color: white;
}

.btn-new:hover {
    background: #4f46e5;
    color: white;
    text-decoration: none;
    transform: translateY(-1px);
}

.help-card {
    background: white;
    border-radius: 8px;
    padding: 20px;
    margin-top: 20px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.help-card h4 {
    color: #1e293b;
    margin: 0 0 12px 0;
}

.help-card p {
    color: #64748b;
    margin: 0 0 16px 0;
}

.contact-links a {
    display: block;
    color: #6366f1;
    text-decoration: none;
    margin-bottom: 8px;
}

.contact-links a:hover {
    text-decoration: underline;
}

/* Responsive */
@media (max-width: 768px) {
    .booking-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .action-buttons {
        grid-template-columns: 1fr;
    }
    
    .info-grid {
        grid-template-columns: 1fr;
    }
    
    .room-card {
        flex-direction: column;
        text-align: center;
    }
    
    .page-title {
        font-size: 1.5rem;
    }
}
</style>

<div class="booking-container">
    <!-- Page Header -->
    <div class="page-header">
        <nav class="breadcrumb">
            <a href="{{ url('/') }}">🏠 Beranda</a> › 
            <a href="{{ route('booking.index') }}">Booking Ruangan</a> › 
            <span style="color: #fbbf24;">{{ $booking->booking_code }}</span>
        </nav>
        
        <h1 class="page-title">Booking #{{ $booking->booking_code }}</h1>
        <p class="page-subtitle">{{ $booking->room->name }} • {{ $booking->formatted_date }} • {{ $booking->formatted_time }}</p>
    </div>

    <div class="booking-grid">
        <!-- Status Card -->
        <div class="status-card">
            <div class="status-header">
                <div class="status-icon {{ $booking->status }}">
                    @if($booking->status === 'pending')
                        ⏳
                    @elseif($booking->status === 'confirmed')
                        ✅
                    @elseif($booking->status === 'cancelled')
                        ❌
                    @else
                        🎉
                    @endif
                </div>
                <div class="status-info">
                    <h3>{{ $booking->status_label }}</h3>
                    <p class="status-code">{{ $booking->booking_code }}</p>
                    <span class="status-badge {{ $booking->status }}">
                        @if($booking->status === 'pending') MENUNGGU KONFIRMASI
                        @elseif($booking->status === 'confirmed') DIKONFIRMASI
                        @elseif($booking->status === 'cancelled') DIBATALKAN
                        @else SELESAI
                        @endif
                    </span>
                </div>
            </div>
            
            <div class="status-body">
                <div class="status-message">
                    @if($booking->status === 'pending')
                        <h4>⏳ Menunggu Konfirmasi</h4>
                        <p>Booking Anda sedang direview oleh admin. Kami akan mengkonfirmasi dalam 24 jam.</p>
                        <div class="next-steps">
                            <h5>Langkah selanjutnya:</h5>
                            <ul>
                                <li>Tunggu email/SMS konfirmasi dari admin</li>
                                <li>Simpan bukti booking ini sebagai PDF</li>
                                <li>Siapkan dokumen yang diperlukan</li>
                            </ul>
                        </div>
                    @elseif($booking->status === 'confirmed')
                        <h4>✅ Booking Dikonfirmasi!</h4>
                        <p>Booking Anda telah dikonfirmasi. Silakan datang sesuai waktu yang dijadwalkan.</p>
                        @if($booking->confirmed_at)
                            <small style="color: #94a3b8; font-style: italic;">Dikonfirmasi pada: {{ $booking->confirmed_at->format('d M Y H:i') }}</small>
                        @endif
                        <div class="next-steps">
                            <h5>Yang perlu Anda bawa:</h5>
                            <ul>
                                <li>Bukti booking (PDF atau screenshot)</li>
                                <li>Kartu identitas yang valid</li>
                                <li>Datang 10 menit sebelum waktu booking</li>
                            </ul>
                        </div>
                    @elseif($booking->status === 'cancelled')
                        <h4>❌ Booking Dibatalkan</h4>
                        <p>Booking ini telah dibatalkan.</p>
                        @if($booking->cancelled_at)
                            <small style="color: #94a3b8; font-style: italic;">Dibatalkan pada: {{ $booking->cancelled_at->format('d M Y H:i') }}</small>
                        @endif
                        <div class="next-steps">
                            <h5>Anda dapat:</h5>
                            <ul>
                                <li>Membuat booking baru dengan waktu berbeda</li>
                                <li>Menghubungi admin untuk informasi lebih lanjut</li>
                            </ul>
                        </div>
                    @else
                        <h4>🎉 Booking Selesai</h4>
                        <p>Terima kasih telah menggunakan fasilitas kami!</p>
                        <div class="next-steps">
                            <h5>Feedback:</h5>
                            <p>Kami sangat menghargai feedback Anda untuk meningkatkan layanan kami.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Booking Info -->
        <div class="info-card">
            <div class="card-header">
                <h3>📋 Informasi Booking</h3>
            </div>
            
            <!-- Room Info -->
            <div class="info-section">
                <h4 class="section-title">🏢 Detail Ruangan</h4>
                <div class="room-card">
                    <div class="room-icon">🏢</div>
                    <div class="room-details">
                        <h5>{{ $booking->room->name }}</h5>
                        <p class="room-capacity">👥 {{ $booking->room->capacity }} orang</p>
                        @if($booking->room->description)
                            <p style="color: #64748b; font-size: 14px; margin-top: 8px;">{{ $booking->room->description }}</p>
                        @endif
                    </div>
                </div>
            </div>
            
            <!-- Time Info -->
            <div class="info-section">
                <h4 class="section-title">⏰ Waktu & Tanggal</h4>
                <div class="info-grid">
                    <div class="info-item">
                        <p class="info-label">📅 Tanggal</p>
                        <p class="info-value">{{ $booking->formatted_date }}</p>
                    </div>
                    <div class="info-item">
                        <p class="info-label">🕐 Waktu</p>
                        <p class="info-value">{{ $booking->formatted_time }}</p>
                    </div>
                    <div class="info-item">
                        <p class="info-label">⏱️ Durasi</p>
                        <p class="info-value">{{ $booking->duration_hours }} jam</p>
                    </div>
                </div>
            </div>
            
            <!-- Contact Info -->
            <div class="info-section">
                <h4 class="section-title">👤 Informasi Kontak</h4>
                <div class="info-grid">
                    <div class="info-item">
                        <p class="info-label">👤 Nama Lengkap</p>
                        <p class="info-value">{{ $booking->contact_name }}</p>
                    </div>
                    <div class="info-item">
                        <p class="info-label">📱 No. Telepon</p>
                        <p class="info-value">{{ $booking->contact_phone }}</p>
                    </div>
                    @if($booking->contact_email)
                        <div class="info-item">
                            <p class="info-label">📧 Email</p>
                            <p class="info-value">{{ $booking->contact_email }}</p>
                        </div>
                    @endif
                    @if($booking->organization)
                        <div class="info-item">
                            <p class="info-label">🏢 Organisasi</p>
                            <p class="info-value">{{ $booking->organization }}</p>
                        </div>
                    @endif
                </div>
            </div>
            
            <!-- Event Info -->
            <div class="info-section">
                <h4 class="section-title">📝 Detail Acara</h4>
                <div class="info-item">
                    <p class="info-label">🎯 Tujuan Penggunaan</p>
                    <p class="info-value">{{ $booking->purpose }}</p>
                </div>
                @if($booking->notes)
                    <div class="info-item" style="margin-top: 16px;">
                        <p class="info-label">📝 Catatan Tambahan</p>
                        <p class="info-value">{{ $booking->notes }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <!-- Action Buttons -->
    <div class="action-buttons">
        <a href="{{ route('booking.download-pdf', $booking) }}" class="btn btn-download" target="_blank">
            📄 Download Bukti PDF
        </a>
        <a href="{{ route('booking.index') }}" class="btn btn-new">
            📅 Booking Ruangan Lagi
        </a>
    </div>
    
    <!-- Help Card -->
    <div class="help-card">
        <h4>🆘 Perlu Bantuan?</h4>
        <p>Hubungi admin melalui:</p>
        <div class="contact-links">
            <a href="tel:+628123456789">📞 (0285) 123-456</a>
            <a href="mailto:admin@rumahbumn.id">📧 admin@rumahbumn.id</a>
        </div>
    </div>
</div>
@endsection