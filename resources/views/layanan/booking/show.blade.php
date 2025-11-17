@extends('layouts.public-booking')

@section('title', 'Booking #' . $booking->booking_code . ' - Rumah BUMN Telkom Pekalongan')
@section('description', 'Detail booking ruangan ' . $booking->room->name)

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
                    <a href="{{ route('booking.index') }}">Booking Ruangan</a>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M8.59 16.59L10 18l6-6-6-6-1.41 1.41L13.17 12z"/>
                    </svg>
                    <span>{{ $booking->booking_code }}</span>
                </nav>
                
                <h1>Booking #{{ $booking->booking_code }}</h1>
                <p>{{ $booking->room->name }} • {{ $booking->formatted_date }} • {{ $booking->formatted_time }}</p>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="section">
        <div class="booking-form-container">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Status Card -->
            <div style="background: white; border-radius: 15px; padding: 2rem; margin-bottom: 2rem; box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);">
                <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem;">
                    <div style="width: 60px; height: 60px; border-radius: 12px; display: flex; align-items: center; justify-content: center; 
                                background: @if($booking->status === 'confirmed') #10b981 @elseif($booking->status === 'pending') #f59e0b @else #ef4444 @endif;">
                        @if($booking->status === 'confirmed')
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="white">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                            </svg>
                        @elseif($booking->status === 'pending')
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="white">
                                <path d="M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2M12.5,7V12.25L17,14.92L16.25,16.15L11,13V7H12.5Z"/>
                            </svg>
                        @else
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="white">
                                <path d="M12,2C17.53,2 22,6.47 22,12C22,17.53 17.53,22 12,22C6.47,22 2,17.53 2,12C2,6.47 6.47,2 12,2M15.59,7L12,10.59L8.41,7L7,8.41L10.59,12L7,15.59L8.41,17L12,13.41L15.59,17L17,15.59L13.41,12L17,8.41L15.59,7Z"/>
                            </svg>
                        @endif
                    </div>
                    <div>
                        <h3 style="margin: 0 0 0.5rem 0; font-size: 24px; color: #2c3e50;">
                            @if($booking->status === 'confirmed')
                                Booking Dikonfirmasi
                            @elseif($booking->status === 'pending')
                                Menunggu Konfirmasi
                            @elseif($booking->status === 'cancelled')
                                Booking Dibatalkan
                            @else
                                Booking Selesai
                            @endif
                        </h3>
                        <span style="background: @if($booking->status === 'confirmed') #d4edda @elseif($booking->status === 'pending') #fff3cd @else #f8d7da @endif; 
                                     color: @if($booking->status === 'confirmed') #155724 @elseif($booking->status === 'pending') #856404 @else #721c24 @endif; 
                                     padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; text-transform: uppercase;">
                            {{ $booking->status_label }}
                        </span>
                    </div>
                </div>

                @if($booking->status === 'pending')
                    <div style="background: #f8f9fa; padding: 1rem; border-radius: 8px; border-left: 4px solid #f59e0b;">
                        <h4 style="margin: 0 0 0.5rem 0; color: #856404;">ℹ️ Booking sedang diproses</h4>
                        <p style="margin: 0; color: #6c757d; font-size: 14px;">
                            Booking Anda sedang direview oleh admin. Kami akan mengkonfirmasi dalam 24 jam melalui email atau SMS.
                        </p>
                    </div>
                @elseif($booking->status === 'confirmed')
                    <div style="background: #d4edda; padding: 1rem; border-radius: 8px; border-left: 4px solid #10b981;">
                        <h4 style="margin: 0 0 0.5rem 0; color: #155724;">✅ Booking berhasil dikonfirmasi!</h4>
                        <p style="margin: 0; color: #155724; font-size: 14px;">
                            Silakan datang sesuai waktu yang dijadwalkan. Bawa bukti booking ini sebagai referensi.
                        </p>
                    </div>
                @endif
            </div>

            <!-- Booking Details -->
            <div style="background: white; border-radius: 15px; padding: 2rem; margin-bottom: 2rem; box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
                    <h3 style="margin: 0; color: #2c3e50; display: flex; align-items: center; gap: 0.5rem;">
                        📋 Detail Booking
                    </h3>
                    <a href="{{ route('booking.download-pdf', $booking) }}" 
                       class="booking-action-btn btn-download" 
                       target="_blank" 
                       style="text-decoration: none; display: inline-flex; align-items: center; gap: 0.75rem; padding: 0.875rem 1.75rem; border-radius: 10px; font-weight: 600; transition: all 0.3s ease; background: linear-gradient(135deg, #1e88e5 0%, #1976d2 100%); color: white; box-shadow: 0 4px 12px rgba(30, 136, 229, 0.3);">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                            <polyline points="14 2 14 8 20 8"/>
                            <line x1="12" y1="18" x2="12" y2="12"/>
                            <line x1="9" y1="15" x2="15" y2="15"/>
                        </svg>
                        Download Bukti PDF
                    </a>
                </div>

                <!-- Room Info -->
                <div style="background: #f8f9fa; padding: 1.5rem; border-radius: 12px; margin-bottom: 2rem;">
                    <h4 style="margin: 0 0 1rem 0; color: #2c3e50;">🏢 {{ $booking->room->name }}</h4>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; margin-bottom: 1rem;">
                        <div>
                            <label style="font-size: 12px; color: #6c757d; text-transform: uppercase; font-weight: 600;">Kapasitas</label>
                            <p style="margin: 0; font-weight: 600; color: #2c3e50;">{{ $booking->room->capacity }} orang</p>
                        </div>
                        <div>
                            <label style="font-size: 12px; color: #6c757d; text-transform: uppercase; font-weight: 600;">Jam Operasional</label>
                            <p style="margin: 0; font-weight: 600; color: #2c3e50;">{{ $booking->room->available_from }} - {{ $booking->room->available_until }}</p>
                        </div>
                    </div>
                    @if($booking->room->description)
                        <p style="margin: 0; color: #6c757d; font-size: 14px;">{{ $booking->room->description }}</p>
                    @endif
                </div>

                <!-- Time & Date -->
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
                    <div>
                        <label style="font-size: 12px; color: #6c757d; text-transform: uppercase; font-weight: 600; display: flex; align-items: center; gap: 0.5rem;">
                            📅 Tanggal Booking
                        </label>
                        <p style="margin: 0.5rem 0 0 0; font-size: 18px; font-weight: 700; color: #2c3e50;">{{ $booking->formatted_date }}</p>
                    </div>
                    <div>
                        <label style="font-size: 12px; color: #6c757d; text-transform: uppercase; font-weight: 600; display: flex; align-items: center; gap: 0.5rem;">
                            ⏰ Waktu
                        </label>
                        <p style="margin: 0.5rem 0 0 0; font-size: 18px; font-weight: 700; color: #2c3e50;">{{ $booking->formatted_time }}</p>
                    </div>
                    <div>
                        <label style="font-size: 12px; color: #6c757d; text-transform: uppercase; font-weight: 600; display: flex; align-items: center; gap: 0.5rem;">
                            ⏱️ Durasi
                        </label>
                        <p style="margin: 0.5rem 0 0 0; font-size: 18px; font-weight: 700; color: #2c3e50;">{{ $booking->duration_hours }} jam</p>
                    </div>
                </div>

                <!-- Contact Info -->
                <div style="background: #f8f9fa; padding: 1.5rem; border-radius: 12px; margin-bottom: 2rem;">
                    <h4 style="margin: 0 0 1rem 0; color: #2c3e50;">👤 Informasi Kontak</h4>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
                        <div>
                            <label style="font-size: 12px; color: #6c757d; text-transform: uppercase; font-weight: 600;">Nama</label>
                            <p style="margin: 0; font-weight: 600; color: #2c3e50;">{{ $booking->contact_name }}</p>
                        </div>
                        <div>
                            <label style="font-size: 12px; color: #6c757d; text-transform: uppercase; font-weight: 600;">Telepon</label>
                            <p style="margin: 0; font-weight: 600; color: #2c3e50;">{{ $booking->contact_phone }}</p>
                        </div>
                        @if($booking->contact_email)
                            <div>
                                <label style="font-size: 12px; color: #6c757d; text-transform: uppercase; font-weight: 600;">Email</label>
                                <p style="margin: 0; font-weight: 600; color: #2c3e50;">{{ $booking->contact_email }}</p>
                            </div>
                        @endif
                        @if($booking->organization)
                            <div>
                                <label style="font-size: 12px; color: #6c757d; text-transform: uppercase; font-weight: 600;">Organisasi</label>
                                <p style="margin: 0; font-weight: 600; color: #2c3e50;">{{ $booking->organization }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Event Details -->
                <div>
                    <h4 style="margin: 0 0 1rem 0; color: #2c3e50;">📝 Detail Acara</h4>
                    <div style="background: #f8f9fa; padding: 1rem; border-radius: 8px; border-left: 4px solid #3498db; margin-bottom: 1rem;">
                        <label style="font-size: 12px; color: #6c757d; text-transform: uppercase; font-weight: 600;">Tujuan Penggunaan</label>
                        <p style="margin: 0.5rem 0 0 0; color: #2c3e50; line-height: 1.6;">{{ $booking->purpose }}</p>
                    </div>
                    @if($booking->notes)
                        <div style="background: #f8f9fa; padding: 1rem; border-radius: 8px; border-left: 4px solid #6c757d;">
                            <label style="font-size: 12px; color: #6c757d; text-transform: uppercase; font-weight: 600;">Catatan Tambahan</label>
                            <p style="margin: 0.5rem 0 0 0; color: #2c3e50; line-height: 1.6;">{{ $booking->notes }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Jadwal Booking Ruangan -->
            <div style="background: white; border-radius: 15px; padding: 2rem; margin-bottom: 2rem; box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);">
                <h3 style="margin: 0 0 2rem 0; color: #2c3e50; display: flex; align-items: center; gap: 0.5rem;">
                    📅 Jadwal Booking {{ $booking->room->name }}
                </h3>

                <!-- Today's Bookings -->
                @php
                    $todayBookings = $booking->room->bookings()
                        ->where('booking_date', $booking->booking_date)
                        ->where('status', '!=', 'cancelled')
                        ->orderBy('time_from')
                        ->get();
                    
                    $nextWeekBookings = $booking->room->bookings()
                        ->where('booking_date', '>', $booking->booking_date)
                        ->where('booking_date', '<=', $booking->booking_date->addDays(7))
                        ->where('status', '!=', 'cancelled')
                        ->orderBy('booking_date')
                        ->orderBy('time_from')
                        ->get()
                        ->groupBy('booking_date');
                @endphp

                <div style="margin-bottom: 2rem;">
                    <h4 style="margin: 0 0 1rem 0; color: #2c3e50; padding-bottom: 0.5rem; border-bottom: 2px solid #e9ecef;">
                        📍 {{ $booking->formatted_date }} (Hari Ini)
                    </h4>
                    
                    @if($todayBookings->count() > 0)
                        <div style="display: grid; gap: 0.75rem;">
                            @foreach($todayBookings as $todayBooking)
                                <div style="display: flex; align-items: center; justify-content: space-between; padding: 1rem; 
                                           background: {{ $todayBooking->id === $booking->id ? '#e3f2fd' : '#f8f9fa' }}; 
                                           border-radius: 8px; border-left: 4px solid {{ $todayBooking->status === 'confirmed' ? '#10b981' : ($todayBooking->status === 'pending' ? '#f59e0b' : '#6c757d') }};">
                                    <div style="display: flex; align-items: center; gap: 1rem;">
                                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                                            <span style="font-weight: 700; color: #2c3e50; font-size: 16px;">
                                                {{ \Carbon\Carbon::parse($todayBooking->time_from)->format('H:i') }} - {{ \Carbon\Carbon::parse($todayBooking->time_until)->format('H:i') }}
                                            </span>
                                            <span style="background: {{ $todayBooking->status === 'confirmed' ? '#d4edda' : ($todayBooking->status === 'pending' ? '#fff3cd' : '#f8d7da') }}; 
                                                         color: {{ $todayBooking->status === 'confirmed' ? '#155724' : ($todayBooking->status === 'pending' ? '#856404' : '#721c24') }}; 
                                                         padding: 2px 8px; border-radius: 12px; font-size: 10px; font-weight: 600; text-transform: uppercase;">
                                                {{ $todayBooking->status === 'confirmed' ? 'Konfirmasi' : ($todayBooking->status === 'pending' ? 'Pending' : 'Batal') }}
                                            </span>
                                        </div>
                                        <div>
                                            <p style="margin: 0; font-weight: 600; color: #2c3e50;">{{ $todayBooking->contact_name }}</p>
                                            <p style="margin: 0; font-size: 12px; color: #6c757d;">{{ Str::limit($todayBooking->purpose, 50) }}</p>
                                        </div>
                                    </div>
                                    <div style="text-align: right;">
                                        <p style="margin: 0; font-size: 12px; color: #6c757d;">{{ $todayBooking->duration_hours }} jam</p>
                                        @if($todayBooking->id === $booking->id)
                                            <span style="background: #2196f3; color: white; padding: 2px 6px; border-radius: 10px; font-size: 10px; font-weight: 600;">
                                                BOOKING ANDA
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div style="text-align: center; padding: 2rem; color: #6c757d;">
                            <p style="margin: 0; font-style: italic;">Belum ada booking untuk hari ini</p>
                        </div>
                    @endif
                </div>

                <!-- Next Week Bookings -->
                @if($nextWeekBookings->count() > 0)
                    <div>
                        <h4 style="margin: 0 0 1rem 0; color: #2c3e50; padding-bottom: 0.5rem; border-bottom: 2px solid #e9ecef;">
                            📆 Jadwal 7 Hari Kedepan
                        </h4>
                        
                        @foreach($nextWeekBookings as $date => $dateBookings)
                            <div style="margin-bottom: 1.5rem;">
                                <h5 style="margin: 0 0 0.75rem 0; color: #495057; font-size: 14px; font-weight: 600;">
                                    {{ \Carbon\Carbon::parse($date)->locale('id')->isoFormat('dddd, D MMMM Y') }}
                                </h5>
                                <div style="display: grid; gap: 0.5rem; margin-left: 1rem;">
                                    @foreach($dateBookings as $futureBooking)
                                        <div style="display: flex; align-items: center; justify-content: space-between; padding: 0.75rem; 
                                                   background: #f8f9fa; border-radius: 6px; border-left: 3px solid {{ $futureBooking->status === 'confirmed' ? '#10b981' : ($futureBooking->status === 'pending' ? '#f59e0b' : '#6c757d') }};">
                                            <div style="display: flex; align-items: center; gap: 1rem;">
                                                <span style="font-weight: 600; color: #2c3e50; font-size: 14px;">
                                                    {{ \Carbon\Carbon::parse($futureBooking->time_from)->format('H:i') }} - {{ \Carbon\Carbon::parse($futureBooking->time_until)->format('H:i') }}
                                                </span>
                                                <div>
                                                    <p style="margin: 0; font-weight: 500; color: #2c3e50; font-size: 14px;">{{ $futureBooking->contact_name }}</p>
                                                    <p style="margin: 0; font-size: 11px; color: #6c757d;">{{ Str::limit($futureBooking->purpose, 40) }}</p>
                                                </div>
                                            </div>
                                            <div style="text-align: right;">
                                                <span style="background: {{ $futureBooking->status === 'confirmed' ? '#d4edda' : ($futureBooking->status === 'pending' ? '#fff3cd' : '#f8d7da') }}; 
                                                             color: {{ $futureBooking->status === 'confirmed' ? '#155724' : ($futureBooking->status === 'pending' ? '#856404' : '#721c24') }}; 
                                                             padding: 1px 6px; border-radius: 10px; font-size: 9px; font-weight: 600;">
                                                    {{ $futureBooking->status === 'confirmed' ? 'OK' : ($futureBooking->status === 'pending' ? 'PENDING' : 'BATAL') }}
                                                </span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                <!-- Available Hours Info -->
                <div style="background: #e8f5e8; padding: 1rem; border-radius: 8px; border-left: 4px solid #10b981; margin-top: 1.5rem;">
                    <h5 style="margin: 0 0 0.5rem 0; color: #155724; font-size: 14px;">💡 Informasi Jam Operasional</h5>
                    <p style="margin: 0; color: #155724; font-size: 13px;">
                        Ruangan beroperasi dari <strong>{{ $booking->room->available_from }}</strong> sampai <strong>{{ $booking->room->available_until }}</strong>. 
                        Pastikan pilih waktu yang tidak bertabrakan dengan booking yang sudah ada.
                    </p>
                </div>
            </div>

            <!-- Actions -->
            <div style="display: flex; gap: 1rem; flex-wrap: wrap; justify-content: center; padding: 1.5rem 0;">
                <a href="{{ route('booking.index') }}" 
                   class="booking-action-btn btn-book-again" 
                   style="text-decoration: none; display: inline-flex; align-items: center; gap: 0.75rem; padding: 1rem 2rem; border-radius: 10px; font-weight: 600; transition: all 0.3s ease; background: white; color: #1976d2; border: 2px solid #1976d2; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                        <line x1="16" y1="2" x2="16" y2="6"/>
                        <line x1="8" y1="2" x2="8" y2="6"/>
                        <line x1="3" y1="10" x2="21" y2="10"/>
                    </svg>
                    Booking Ruangan Lagi
                </a>

                @if($booking->canBeCancelled())
                    <form action="{{ route('booking.cancel', $booking) }}" method="POST" 
                          onsubmit="return confirm('Apakah Anda yakin ingin membatalkan booking ini?')"
                          style="margin: 0;">
                        @csrf
                        @method('PATCH')
                        <button type="submit" 
                                class="booking-action-btn btn-cancel" 
                                style="display: inline-flex; align-items: center; gap: 0.75rem; padding: 1rem 2rem; border-radius: 10px; font-weight: 600; cursor: pointer; transition: all 0.3s ease; background: white; color: #ef4444; border: 2px solid #ef4444; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"/>
                                <line x1="15" y1="9" x2="9" y2="15"/>
                                <line x1="9" y1="9" x2="15" y2="15"/>
                            </svg>
                            Batalkan Booking
                        </button>
                    </form>
                @endif
            </div>

            <style>
                .booking-action-btn:hover {
                    transform: translateY(-2px);
                    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15) !important;
                }
                
                .btn-download:hover {
                    background: linear-gradient(135deg, #1976d2 0%, #1565c0 100%) !important;
                }
                
                .btn-book-again:hover {
                    background: #1976d2 !important;
                    color: white !important;
                }
                
                .btn-book-again:hover svg {
                    stroke: white;
                }
                
                .btn-cancel:hover {
                    background: #ef4444 !important;
                    color: white !important;
                }
                
                .btn-cancel:hover svg {
                    stroke: white;
                }
                
                @media (max-width: 640px) {
                    .booking-action-btn {
                        width: 100%;
                        justify-content: center;
                    }
                }
            </style>

            <!-- Help Section -->
            <div style="background: #e3f2fd; padding: 1.5rem; border-radius: 12px; margin-top: 2rem; text-align: center;">
                <h4 style="margin: 0 0 0.5rem 0; color: #1976d2;">💬 Butuh Bantuan?</h4>
                <p style="margin: 0 0 1rem 0; color: #1565c0; font-size: 14px;">
                    Hubungi admin untuk informasi lebih lanjut tentang booking Anda
                </p>
                <div style="display: flex; justify-content: center; gap: 1rem; flex-wrap: wrap;">
                    <a href="tel:+628123456789" style="color: #1976d2; text-decoration: none; font-weight: 500;">
                        📞 (0285) 123-456
                    </a>
                    <a href="mailto:admin@rumahbumn.id" style="color: #1976d2; text-decoration: none; font-weight: 500;">
                        ✉️ admin@rumahbumn.id
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection