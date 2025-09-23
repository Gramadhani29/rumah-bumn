<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Booking - {{ $booking->booking_code }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 14px;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        
        .header {
            text-align: center;
            border-bottom: 3px solid #2563eb;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        
        .logo {
            margin-bottom: 10px;
        }
        
        .header h1 {
            color: #2563eb;
            margin: 10px 0;
            font-size: 24px;
        }
        
        .header p {
            color: #666;
            margin: 5px 0;
        }
        
        .booking-code {
            background: #f3f4f6;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            margin: 20px 0;
            font-weight: bold;
            font-size: 16px;
        }
        
        .status-badge {
            display: inline-block;
            padding: 5px 15px;
            border-radius: 20px;
            color: white;
            font-weight: bold;
            font-size: 12px;
            text-transform: uppercase;
        }
        
        .status-pending { background-color: #f59e0b; }
        .status-confirmed { background-color: #10b981; }
        .status-cancelled { background-color: #ef4444; }
        .status-completed { background-color: #6b7280; }
        
        .info-section {
            margin: 20px 0;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            overflow: hidden;
        }
        
        .info-header {
            background: #f9fafb;
            padding: 10px 15px;
            border-bottom: 1px solid #e5e7eb;
            font-weight: bold;
            color: #374151;
        }
        
        .info-content {
            padding: 15px;
        }
        
        .info-grid {
            display: table;
            width: 100%;
        }
        
        .info-row {
            display: table-row;
        }
        
        .info-label {
            display: table-cell;
            width: 30%;
            padding: 5px 10px 5px 0;
            font-weight: bold;
            color: #4b5563;
            vertical-align: top;
        }
        
        .info-value {
            display: table-cell;
            padding: 5px 0;
            color: #1f2937;
        }
        
        .highlight-box {
            background: #eff6ff;
            border: 1px solid #3b82f6;
            border-radius: 8px;
            padding: 15px;
            margin: 20px 0;
        }
        
        .highlight-box h3 {
            color: #1d4ed8;
            margin: 0 0 10px 0;
            font-size: 16px;
        }
        
        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            text-align: center;
            color: #6b7280;
            font-size: 12px;
        }
        
        .qr-section {
            float: right;
            text-align: center;
            margin-left: 20px;
        }
        
        .important-note {
            background: #fef3c7;
            border: 1px solid #f59e0b;
            border-radius: 8px;
            padding: 15px;
            margin: 20px 0;
        }
        
        .important-note h4 {
            color: #92400e;
            margin: 0 0 10px 0;
        }
        
        .important-note ul {
            margin: 10px 0;
            padding-left: 20px;
        }
        
        .important-note li {
            color: #78350f;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <div class="logo">
            <h1>RUMAH BUMN</h1>
            <p>Telkom Pekalongan</p>
        </div>
        <h1>BUKTI BOOKING RUANGAN</h1>
        <p>Jl. Dr. Sutomo No. 17, Pekalongan Timur, Kota Pekalongan</p>
        <p>Telepon: (0285) 123456 | Email: info@rumahbumn-pekalongan.com</p>
    </div>

    <!-- Booking Code & Status -->
    <div class="booking-code">
        KODE BOOKING: {{ $booking->booking_code }}
        <br>
        <span class="status-badge status-{{ $booking->status }}">
            @if($booking->status === 'pending') MENUNGGU KONFIRMASI
            @elseif($booking->status === 'confirmed') DIKONFIRMASI
            @elseif($booking->status === 'cancelled') DIBATALKAN
            @else SELESAI
            @endif
        </span>
    </div>

    <!-- Room Information -->
    <div class="info-section">
        <div class="info-header">INFORMASI RUANGAN</div>
        <div class="info-content">
            <div class="info-grid">
                <div class="info-row">
                    <div class="info-label">Nama Ruangan:</div>
                    <div class="info-value">{{ $booking->room->name }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Kapasitas:</div>
                    <div class="info-value">{{ $booking->room->capacity }} orang</div>
                </div>
                @if($booking->room->location)
                <div class="info-row">
                    <div class="info-label">Lokasi:</div>
                    <div class="info-value">{{ $booking->room->location }}</div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Booking Details -->
    <div class="info-section">
        <div class="info-header">DETAIL BOOKING</div>
        <div class="info-content">
            <div class="info-grid">
                <div class="info-row">
                    <div class="info-label">Tanggal:</div>
                    <div class="info-value">{{ \Carbon\Carbon::parse($booking->booking_date)->format('l, d F Y') }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Waktu:</div>
                    <div class="info-value">{{ date('H:i', strtotime($booking->time_from)) }} - {{ date('H:i', strtotime($booking->time_until)) }} WIB</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Durasi:</div>
                    <div class="info-value">{{ number_format($booking->duration_hours, 1) }} jam</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Tujuan:</div>
                    <div class="info-value">{{ $booking->purpose }}</div>
                </div>
                @if($booking->notes)
                <div class="info-row">
                    <div class="info-label">Catatan:</div>
                    <div class="info-value">{{ $booking->notes }}</div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Contact Information -->
    <div class="info-section">
        <div class="info-header">INFORMASI KONTAK</div>
        <div class="info-content">
            <div class="info-grid">
                <div class="info-row">
                    <div class="info-label">Nama:</div>
                    <div class="info-value">{{ $booking->contact_name }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Telepon:</div>
                    <div class="info-value">{{ $booking->contact_phone }}</div>
                </div>
                @if($booking->contact_email)
                <div class="info-row">
                    <div class="info-label">Email:</div>
                    <div class="info-value">{{ $booking->contact_email }}</div>
                </div>
                @endif
                @if($booking->organization)
                <div class="info-row">
                    <div class="info-label">Organisasi:</div>
                    <div class="info-value">{{ $booking->organization }}</div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Status Information -->
    @if($booking->status === 'confirmed')
    <div class="highlight-box">
        <h3>✅ BOOKING DIKONFIRMASI</h3>
        <p>Booking Anda telah dikonfirmasi oleh admin. Silakan datang sesuai dengan waktu yang telah dijadwalkan.</p>
        @if($booking->confirmed_at)
        <p><strong>Dikonfirmasi pada:</strong> {{ $booking->confirmed_at->format('d F Y H:i') }} WIB</p>
        @endif
    </div>
    @elseif($booking->status === 'pending')
    <div class="highlight-box">
        <h3>⏳ MENUNGGU KONFIRMASI</h3>
        <p>Booking Anda sedang dalam proses review oleh admin. Kami akan mengonfirmasi dalam waktu maksimal 24 jam.</p>
    </div>
    @endif

    <!-- Important Notes -->
    <div class="important-note">
        <h4>PENTING - HARAP DIBACA:</h4>
        <ul>
            <li>Tunjukkan bukti booking ini saat check-in</li>
            <li>Datang tepat waktu sesuai jadwal yang tertera</li>
            <li>Jika berhalangan hadir, harap hubungi admin minimal 2 jam sebelumnya</li>
            <li>Menjaga kebersihan dan fasilitas ruangan</li>
            <li>Dilarang merokok dan membawa makanan/minuman yang dapat mengotori ruangan</li>
            <li>Booking ini GRATIS - tidak dipungut biaya apapun</li>
        </ul>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>Dokumen ini dicetak pada: {{ now()->format('d F Y H:i') }} WIB</p>
        <p>Untuk informasi lebih lanjut, hubungi: (0285) 123456</p>
        <br>
        <p><strong>Rumah BUMN Telkom Pekalongan</strong></p>
        <p>Connecting Communities, Empowering Business</p>
    </div>
</body>
</html>