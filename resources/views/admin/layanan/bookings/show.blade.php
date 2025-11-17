<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Ruangan - Dashboard Admin</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body class="dashboard-body">
    <!-- Admin Navbar -->
    <nav class="admin-navbar">
        <div class="admin-navbar-container">
            <div class="admin-navbar-left">
                <a href="{{ route('dashboard') }}" class="admin-navbar-brand">
                    <img src="{{ asset('images/Logo RBP.png') }}" alt="Logo Rumah BUMN" class="admin-navbar-logo">
                </a>
            </div>
            
            <div class="admin-navbar-right">
                <form method="POST" action="{{ route('logout') }}" class="admin-navbar-logout-form">
                    @csrf
                    <button type="submit" class="admin-navbar-logout-btn">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M17 7l-1.41 1.41L18.17 11H8v2h10.17l-2.58 2.59L17 17l5-5zM4 5h8V3H4c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h8v-2H4V5z"/>
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <main class="admin-main">
        <div class="admin-container">
            <!-- Success/Error Messages -->
            @if(session('success'))
                <div class="admin-alert admin-alert-success">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="admin-alert admin-alert-error">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
                    </svg>
                    <div>
                        @foreach($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="admin-detail-container">
                <div class="admin-detail-header">
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <a href="{{ route('admin.rooms.index') }}" style="display: flex; align-items: center; justify-content: center; width: 32px; height: 32px; background: #f3f4f6; border-radius: 8px; transition: all 0.2s; text-decoration: none;">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" style="color: #374151;">
                                <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/>
                            </svg>
                        </a>
                        <h2>{{ $room->name }}</h2>
                    </div>
                    <span class="admin-badge admin-badge-{{ $room->status }}">
                        @if($room->status === 'available')
                            Tersedia
                        @elseif($room->status === 'maintenance')
                            Maintenance
                        @else
                            Tidak Tersedia
                        @endif
                    </span>
                </div>

                <div class="room-detail-layout">
                    <div class="room-detail-left">
                        @if($room->image)
                            <div class="room-detail-image">
                                <img src="{{ Storage::url($room->image) }}" alt="{{ $room->name }}">
                            </div>
                        @else
                            <div class="room-detail-image-placeholder">
                                <span>Foto</span>
                            </div>
                        @endif
                    </div>

                    <div class="room-detail-right">
                        <div class="room-detail-item">
                            <label>Deskripsi</label>
                            <p>{{ $room->description }}</p>
                        </div>

                        <div class="room-detail-item">
                            <label>Lokasi</label>
                            <p>{{ $room->location ?? '-' }}</p>
                        </div>

                        <div class="room-detail-item">
                            <label>Kapasitas</label>
                            <p>{{ $room->capacity }} Orang</p>
                        </div>

                        <div class="room-detail-item">
                            <label>Jam Operasional</label>
                            <p>{{ \Carbon\Carbon::parse($room->available_from)->format('H:i') }} - {{ \Carbon\Carbon::parse($room->available_until)->format('H:i') }}</p>
                        </div>

                        @if($room->facilities && count($room->facilities) > 0)
                            <div class="room-detail-item">
                                <label>Fasilitas</label>
                                <ul>
                                    @foreach($room->facilities as $facility)
                                        <li>{{ $facility }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>

                @if($room->bookings && $room->bookings->count() > 0)
                    <div class="room-booking-section">
                        <h3>Booking Mendatang</h3>
                        <div class="admin-table-container">
                            <table class="admin-table">
                                <thead>
                                    <tr>
                                        <th>Kode Booking</th>
                                        <th>Tanggal</th>
                                        <th>Waktu</th>
                                        <th>Pengaju</th>
                                        <th>Kontak</th>
                                        <th>Organisasi</th>
                                        <th>Tujuan</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($room->bookings as $booking)
                                        <tr>
                                            <td>
                                                <strong>{{ $booking->booking_code }}</strong>
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}</td>
                                            <td>
                                                <div class="admin-table-date">
                                                    <div>{{ \Carbon\Carbon::parse($booking->time_from)->format('H:i') }}</div>
                                                    <small>s/d {{ \Carbon\Carbon::parse($booking->time_until)->format('H:i') }}</small>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="admin-table-title">
                                                    <h4>{{ $booking->contact_name ?? ($booking->user ? $booking->user->name : '-') }}</h4>
                                                    <p>{{ $booking->contact_email ?? ($booking->user ? $booking->user->email : '-') }}</p>
                                                </div>
                                            </td>
                                            <td>{{ $booking->contact_phone ?? '-' }}</td>
                                            <td>{{ $booking->organization ?? '-' }}</td>
                                            <td>
                                                <div style="max-width: 200px;">
                                                    {{ Str::limit($booking->purpose ?? '-', 50) }}
                                                </div>
                                            </td>
                                            <td>
                                                <span class="admin-badge admin-badge-{{ $booking->status }}">
                                                    {{ $booking->status_label }}
                                                </span>
                                            </td>
                                            <td>
                                                @if($booking->status === 'pending')
                                                    <div style="display: flex; gap: 0.5rem;">
                                                        <form action="{{ route('admin.bookings.confirm', $booking) }}" method="POST" style="margin: 0;">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" 
                                                                    class="admin-btn-action admin-btn-accept" 
                                                                    title="Terima"
                                                                    onclick="return confirm('Apakah Anda yakin ingin menerima booking ini?')">
                                                                <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                                                                    <path d="M9 16.2L4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4L9 16.2z"/>
                                                                </svg>
                                                            </button>
                                                        </form>
                                                        <form action="{{ route('admin.bookings.reject', $booking) }}" method="POST" style="margin: 0;">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" 
                                                                    class="admin-btn-action admin-btn-reject" 
                                                                    title="Tolak"
                                                                    onclick="return confirm('Apakah Anda yakin ingin menolak booking ini?')">
                                                                <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                                                                    <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
                                                                </svg>
                                                            </button>
                                                        </form>
                                                    </div>
                                                @else
                                                    <span style="color: #9ca3af; font-size: 0.85rem;">-</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @else
                    <div class="room-booking-section">
                        <h3>Booking Mendatang</h3>
                        <div style="padding: 3rem; text-align: center;">
                            <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="1.5" style="margin: 0 auto 1rem;">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                                <line x1="16" y1="2" x2="16" y2="6"/>
                                <line x1="8" y1="2" x2="8" y2="6"/>
                                <line x1="3" y1="10" x2="21" y2="10"/>
                            </svg>
                            <p style="color: #9ca3af; font-size: 1rem; margin: 0;">Belum ada booking yang dijadwalkan untuk ruangan ini</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </main>
</body>
</html>
/