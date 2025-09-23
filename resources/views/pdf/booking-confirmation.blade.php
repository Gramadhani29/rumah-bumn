<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bukti Konfirmasi Booking - {{ $booking->booking_code }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            margin: 0;
            padding: 20px;
            font-size: 12px;
            color: #333;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #0066cc;
            padding-bottom: 15px;
        }
        
        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #0066cc;
            margin-bottom: 5px;
        }
        
        .subtitle {
            font-size: 14px;
            color: #666;
        }
        
        .document-title {
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            margin: 20px 0;
            color: #0066cc;
        }
        
        .info-section {
            margin-bottom: 20px;
        }
        
        .section-title {
            font-size: 14px;
            font-weight: bold;
            background-color: #f5f5f5;
            padding: 8px;
            margin-bottom: 10px;
            border-left: 4px solid #0066cc;
        }
        
        .info-row {
            display: flex;
            margin-bottom: 8px;
            border-bottom: 1px dotted #ccc;
            padding-bottom: 5px;
        }
        
        .info-label {
            font-weight: bold;
            width: 150px;
            color: #666;
        }
        
        .info-value {
            flex: 1;
            color: #333;
        }
        
        .status-confirmed {
            display: inline-block;
            background-color: #10b981;
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 11px;
            text-transform: uppercase;
        }
        
        .booking-code {
            font-size: 16px;
            font-weight: bold;
            color: #0066cc;
            text-align: center;
            background-color: #f0f8ff;
            padding: 10px;
            border: 2px solid #0066cc;
            border-radius: 5px;
            margin: 15px 0;
        }
        
        .footer {
            margin-top: 40px;
            border-top: 1px solid #ccc;
            padding-top: 15px;
            text-align: center;
            font-size: 10px;
            color: #666;
        }
        
        .important-note {
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }
        
        .note-title {
            font-weight: bold;
            color: #856404;
            margin-bottom: 5px;
        }
        
        .note-text {
            color: #856404;
            font-size: 11px;
            line-height: 1.4;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        td {
            padding: 5px 0;
            vertical-align: top;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <div class="logo">RUMAH BUMN</div>
        <div class="subtitle">Sistem Manajemen Booking Ruangan</div>
    </div>
    
    <!-- Document Title -->
    <div class="document-title">BUKTI KONFIRMASI BOOKING</div>
    
    <!-- Booking Code -->
    <div class="booking-code">
        Kode Booking: {{ $booking->booking_code }}
    </div>
    
    <!-- Status -->
    <div style="text-align: center; margin: 15px 0;">
        <span class="status-confirmed">DIKONFIRMASI</span>
    </div>
    
    <!-- Informasi Peminjam -->
    <div class="info-section">
        <div class="section-title">INFORMASI PEMINJAM</div>
        <table>
            <tr>
                <td class="info-label">Nama Kontak:</td>
                <td class="info-value">{{ $booking->contact_name }}</td>
            </tr>
            <tr>
                <td class="info-label">Email:</td>
                <td class="info-value">{{ $booking->contact_email }}</td>
            </tr>
            <tr>
                <td class="info-label">No. Telepon:</td>
                <td class="info-value">{{ $booking->contact_phone }}</td>
            </tr>
            @if($booking->organization)
            <tr>
                <td class="info-label">Organisasi:</td>
                <td class="info-value">{{ $booking->organization }}</td>
            </tr>
            @endif
            @if($booking->purpose)
            <tr>
                <td class="info-label">Tujuan:</td>
                <td class="info-value">{{ $booking->purpose }}</td>
            </tr>
            @endif
        </table>
    </div>
    
    <!-- Detail Booking -->
    <div class="info-section">
        <div class="section-title">DETAIL BOOKING</div>
        <table>
            <tr>
                <td class="info-label">Ruangan:</td>
                <td class="info-value">{{ $booking->room->name }}</td>
            </tr>
            <tr>
                <td class="info-label">Lokasi:</td>
                <td class="info-value">{{ $booking->room->location }}</td>
            </tr>
            <tr>
                <td class="info-label">Kapasitas:</td>
                <td class="info-value">{{ $booking->room->capacity }} orang</td>
            </tr>
            <tr>
                <td class="info-label">Tanggal:</td>
                <td class="info-value">{{ \Carbon\Carbon::parse($booking->booking_date)->format('d F Y') }}</td>
            </tr>
            <tr>
                <td class="info-label">Waktu:</td>
                <td class="info-value">{{ \Carbon\Carbon::parse($booking->time_from)->format('H:i') }} - {{ \Carbon\Carbon::parse($booking->time_until)->format('H:i') }}</td>
            </tr>
            <tr>
                <td class="info-label">Durasi:</td>
                <td class="info-value">{{ $booking->duration_hours }} jam</td>
            </tr>
            <tr>
                <td class="info-label">Tanggal Konfirmasi:</td>
                <td class="info-value">{{ $booking->confirmed_at ? \Carbon\Carbon::parse($booking->confirmed_at)->format('d F Y H:i') : '-' }}</td>
            </tr>
        </table>
    </div>
    
    <!-- Catatan Penting -->
    <div class="important-note">
        <div class="note-title">CATATAN PENTING:</div>
        <div class="note-text">
            • Harap tiba 15 menit sebelum waktu booking dimulai<br>
            • Tunjukkan bukti konfirmasi ini kepada petugas<br>
            • Ruangan harus dikembalikan dalam kondisi bersih<br>
            • Hubungi admin jika ada perubahan atau pembatalan<br>
            • Dokumen ini adalah bukti sah peminjaman ruangan
        </div>
    </div>
    
    @if($booking->notes)
    <div class="info-section">
        <div class="section-title">CATATAN TAMBAHAN</div>
        <div style="padding: 10px; background-color: #f8f9fa; border-radius: 3px;">
            {{ $booking->notes }}
        </div>
    </div>
    @endif
    
    <!-- Footer -->
    <div class="footer">
        <div>Dokumen ini digenerate secara otomatis pada {{ \Carbon\Carbon::now()->format('d F Y H:i:s') }}</div>
        <div>Rumah BUMN - Sistem Manajemen Booking Ruangan</div>
        <div style="margin-top: 5px; font-size: 9px;">
            Untuk pertanyaan atau bantuan, silakan hubungi administrator sistem.
        </div>
    </div>
</body>
</html>