@extends('layouts.public-booking')

@section('title', 'Layanan - Rumah BUMN Telkom Pekalongan')
@section('description', 'Layanan untuk kegiatan dan acara di Rumah BUMN Telkom Pekalongan')
@section('content')
    <!-- Service Selection -->
    <section class="service-selection-section section">
        <div class="container">
            <div class="service-selection-cards">
                <div class="service-card active" id="booking-card" onclick="showService('booking')">
                    <div class="service-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11zM7 10h5v5H7z"/>
                        </svg>
                    </div>
                    <div class="service-content">
                        <h3>Booking Ruangan</h3>
                    </div>
                </div>

                <div class="service-card" id="proposal-card" onclick="showService('proposal')">
                    <div class="service-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M14 2H6c-1.1 0-2 .9-2 2v16c0 1.1.89 2 2 2h12c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/>
                        </svg>
                    </div>
                    <div class="service-content">
                        <h3>Pengajuan Proposal</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Booking Section -->
    <section class="booking-section section" id="booking-content">
        <div class="container">
            <!-- Quick Info -->
            <div class="booking-info-cards">
                <div class="info-card">
                    <div class="info-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                        </svg>
                    </div>
                    <div class="info-content">
                        <h3>Simpel</h3>
                        <p>Tidak perlu login cukup isi nama dan nomor HP untuk booking</p>
                    </div>
                </div>
                
                <div class="info-card">
                    <div class="info-icon">
                        <svg width="24" height="24" viewBox="0 0 1024 1024" fill="currentColor">
                            <path d="M917.52 369.86L594.24 98.59l-98.62 117.52-181.15-67.54-124.33 290.24h-80.28V914h804.57V438.81h-54.78l57.87-68.95zM603.24 201.62l211.25 177.23-50.33 59.96H404.21l199.03-237.19z m-248.99 39.84l91.47 34.1-136.98 163.25h-39.01l84.52-197.35z m487.04 599.39H183.01v-328.9H841.3v328.9z" fill="white"/>
                            <path d="M621.68 640.96h146.29v73.14H621.68z" fill="white"/>
                        </svg>
                    </div>
                    <div class="info-content">
                        <h3>Gratis</h3>
                        <p>Layanan tidak dipungut biaya apapun</p>
                    </div>
                </div>
                
                <div class="info-card">
                    <div class="info-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                        </svg>
                    </div>
                    <div class="info-content">
                        <h3>Fasilitas Lengkap</h3>
                        <p>Ruangan dilengkapi fasilitas modern dan nyaman</p>
                    </div>
                </div>
            </div>

            <!-- Rooms Grid -->
            <div class="rooms-grid">
                @forelse($rooms as $room)
                    <div class="room-card">
                        <div class="room-image">
                            @if($room->image_url)
                                <img src="{{ $room->image_url }}" alt="{{ $room->name }}">
                            @else
                                <div class="room-placeholder">
                                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                        <polyline points="9,22 9,12 15,12 15,22"></polyline>
                                    </svg>
                                    <span>{{ $room->name }}</span>
                                </div>
                            @endif
                            <div class="room-status {{ $room->status }}">
                                {{ $room->status_label ?? 'Tersedia' }}
                            </div>
                        </div>
                        
                        <div class="room-content">
                            <div class="room-header">
                                <h3>{{ $room->name }}</h3>
                            </div>
                            
                            <p class="room-description">{{ $room->description }}</p>
                            
                            <div class="room-details">
                                <div class="detail-item">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M16 7c0-2.21-1.79-4-4-4S8 4.79 8 7s1.79 4 4 4 4-1.79 4-4zm-4 6c-2.67 0-8 1.34-8 4v3h16v-3c0-2.66-5.33-4-8-4z"/>
                                    </svg>
                                    <span>{{ $room->capacity }} orang</span>
                                </div>
                                
                                <div class="detail-item">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm3.5 6L12 10.5 8.5 8 12 5.5 15.5 8zM12 17.5L8.5 15l3.5-2.5 3.5 2.5L12 17.5z"/>
                                    </svg>
                                    <span>{{ $room->available_from }} - {{ $room->available_until }}</span>
                                </div>
                            </div>
                            
                            @if($room->facilities)
                                <div class="room-facilities">
                                    <h4>Fasilitas:</h4>
                                    <div class="facilities-list">
                                        @foreach(array_slice($room->facilities, 0, 4) as $facility)
                                            <span class="facility-tag">{{ $facility }}</span>
                                        @endforeach
                                        @if(count($room->facilities) > 4)
                                            <span class="facility-more">+{{ count($room->facilities) - 4 }} lainnya</span>
                                        @endif
                                    </div>
                                </div>
                            @endif
                            
                            <div class="room-actions">
                                <a href="{{ route('booking.create', $room) }}" class="btn-book">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11zM7 10h5v5H7z"/>
                                    </svg>
                                    Book Sekarang
                                </a>
                                
                                <button class="btn-details" onclick="showRoomDetails({{ $room->id }})">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/>
                                    </svg>
                                    Detail
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="no-rooms">
                        <div class="no-rooms-icon">
                            <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                <polyline points="9,22 9,12 15,12 15,22"></polyline>
                            </svg>
                        </div>
                        <h3>Belum ada ruangan tersedia</h3>
                        <p>Mohon maaf, saat ini belum ada ruangan yang tersedia untuk dibooking.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Proposal Section -->
    <section class="proposal-section section" id="proposal-content" style="display: none;">
        <div class="container">
            <div class="proposal-intro">
                <div class="intro-card">
                    <div class="intro-icon">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M14 2H6c-1.1 0-2 .9-2 2v16c0 1.1.89 2 2 2h12c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/>
                        </svg>
                    </div>
                    <div class="intro-content">
                        <h3>Pengajuan Proposal Kegiatan</h3>
                        <p>Ajukan proposal untuk kegiatan yang akan diselenggarakan di Rumah BUMN Telkom Pekalongan. Tim kami akan mengevaluasi dan memberikan feedback terkait proposal Anda.</p>
                        
                        <div class="kategori-info">
                            <h4>Kategori Kegiatan yang Tersedia:</h4>
                            <div class="kategori-grid">
                                <div class="kategori-item">
                                    <div class="kategori-icon">🎓</div>
                                    <div class="kategori-content">
                                        <h5>Pelatihan</h5>
                                        <p>Workshop, seminar, pelatihan keterampilan, dan program capacity building</p>
                                    </div>
                                </div>
                                <div class="kategori-item">
                                    <div class="kategori-icon">🤝</div>
                                    <div class="kategori-content">
                                        <h5>Kerja Sama</h5>
                                        <p>Program kemitraan, kolaborasi bisnis, dan inisiatif bersama</p>
                                    </div>
                                </div>
                                <div class="kategori-item">
                                    <div class="kategori-icon">🎪</div>
                                    <div class="kategori-content">
                                        <h5>Event</h5>
                                        <p>Pameran, launching produk, gathering, dan acara komunitas</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="action-buttons">
                            <a href="{{ route('proposal.create') }}" class="btn-primary">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
                                </svg>
                                Ajukan Proposal Baru
                            </a>
                            
                            @auth
                            <a href="{{ route('proposal.my-proposals') }}" class="btn-secondary">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M14 2H6c-1.1 0-2 .9-2 2v16c0 1.1.89 2 2 2h12c1.1 0 2-.9 2-2V8l-6-6zm-3 7V3.5L16.5 9H11z"/>
                                </svg>
                                Lihat Proposal Saya
                            </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>

            <!-- Requirements -->
            <div class="requirements-info">
                <h4>Persyaratan Proposal:</h4>
                <div class="requirements-grid">
                    <div class="requirement-item">
                        <div class="requirement-icon">📝</div>
                        <div class="requirement-content">
                            <h5>Deskripsi Lengkap</h5>
                            <p>Jelaskan tujuan, target peserta, dan manfaat kegiatan</p>
                        </div>
                    </div>
                    <div class="requirement-item">
                        <div class="requirement-icon">📅</div>
                        <div class="requirement-content">
                            <h5>Jadwal Kegiatan</h5>
                            <p>Tentukan tanggal dan durasi kegiatan dengan jelas</p>
                        </div>
                    </div>
                    <div class="requirement-item">
                        <div class="requirement-icon">👥</div>
                        <div class="requirement-content">
                            <h5>Estimasi Peserta</h5>
                            <p>Berikan perkiraan jumlah peserta yang akan hadir</p>
                        </div>
                    </div>
                    <div class="requirement-item">
                        <div class="requirement-icon">📞</div>
                        <div class="requirement-content">
                            <h5>Kontak PIC</h5>
                            <p>Sertakan informasi kontak person in charge yang dapat dihubungi</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Jadwal Booking Hari Ini - Only show for booking tab -->
    <section class="schedule-section section" id="booking-schedule" style="background: #f8f9fa;">
        <div class="container">
            <div style="text-align: center; margin-bottom: 2rem;">
                <h2 style="color: #2c3e50; margin-bottom: 0.5rem;">📅 Jadwal Booking Hari Ini</h2>
                <p style="color: #6c757d;">{{ now()->locale('id')->isoFormat('dddd, D MMMM Y') }}</p>
            </div>

            @php
                $todayBookings = \App\Models\Booking::with(['room'])
                    ->where('booking_date', now()->toDateString())
                    ->where('status', '!=', 'cancelled')
                    ->orderBy('time_from')
                    ->get()
                    ->groupBy('room.name');
            @endphp

            @if($todayBookings->count() > 0)
                <div style="display: grid; gap: 1.5rem;">
                    @foreach($todayBookings as $roomName => $bookings)
                        <div style="background: white; border-radius: 12px; padding: 1.5rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                            <h3 style="margin: 0 0 1rem 0; color: #2c3e50; display: flex; align-items: center; gap: 0.5rem;">
                                🏢 {{ $roomName }}
                            </h3>
                            
                            <div style="display: grid; gap: 0.75rem;">
                                @foreach($bookings as $booking)
                                    <div style="display: flex; align-items: center; justify-content: space-between; padding: 1rem; 
                                               background: #f8f9fa; border-radius: 8px; 
                                               border-left: 4px solid {{ $booking->status === 'confirmed' ? '#10b981' : '#f59e0b' }};">
                                        <div style="display: flex; align-items: center; gap: 1rem;">
                                            <div style="display: flex; align-items: center; gap: 0.5rem;">
                                                <span style="font-weight: 700; color: #2c3e50; font-size: 16px;">
                                                    {{ \Carbon\Carbon::parse($booking->time_from)->format('H:i') }} - {{ \Carbon\Carbon::parse($booking->time_until)->format('H:i') }}
                                                </span>
                                                <span style="background: {{ $booking->status === 'confirmed' ? '#d4edda' : '#fff3cd' }}; 
                                                             color: {{ $booking->status === 'confirmed' ? '#155724' : '#856404' }}; 
                                                             padding: 2px 8px; border-radius: 12px; font-size: 10px; font-weight: 600; text-transform: uppercase;">
                                                    {{ $booking->status === 'confirmed' ? 'Dikonfirmasi' : 'Pending' }}
                                                </span>
                                            </div>
                                            <div>
                                                <p style="margin: 0; font-weight: 600; color: #2c3e50;">{{ $booking->contact_name }}</p>
                                                <p style="margin: 0; font-size: 12px; color: #6c757d;">{{ Str::limit($booking->purpose, 50) }}</p>
                                            </div>
                                        </div>
                                        <div style="text-align: right;">
                                            <p style="margin: 0; font-size: 12px; color: #6c757d;">{{ $booking->duration_hours }} jam</p>
                                            <p style="margin: 0; font-size: 10px; color: #adb5bd;">#{{ $booking->booking_code }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div style="text-align: center; padding: 3rem; background: white; border-radius: 12px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                    <div style="font-size: 48px; margin-bottom: 1rem;">🎉</div>
                    <h3 style="color: #2c3e50; margin-bottom: 0.5rem;">Belum Ada Booking Hari Ini</h3>
                    <p style="color: #6c757d; margin: 0;">Semua ruangan masih tersedia untuk hari ini. Segera booking sebelum kehabisan!</p>
                </div>
            @endif

            <!-- Quick Booking Tips -->
            <div style="background: #e3f2fd; padding: 1.5rem; border-radius: 12px; margin-top: 2rem; border-left: 4px solid #2196f3;">
                <h4 style="margin: 0 0 1rem 0; color: #1565c0; display: flex; align-items: center; gap: 0.5rem;">
                    💡 Tips Booking
                </h4>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1rem; color: #1565c0; font-size: 14px;">
                    <div>• Booking minimal 1 hari sebelum acara</div>
                    <div>• Pastikan jam tidak bentrok dengan booking lain</div>
                    <div>• Konfirmasi akan dikirim via email/SMS</div>
                    <div>• Hubungi admin jika ada pertanyaan</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Room Details Modal -->
    <div id="roomModal" class="modal" style="display: none;">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="modalRoomName">Detail Ruangan</h3>
                <button class="modal-close" onclick="closeRoomModal()">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
                    </svg>
                </button>
            </div>
            <div class="modal-body" id="modalRoomContent">
                <!-- Content will be loaded dynamically -->
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
/* Service Selection Cards */
.service-selection-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 3rem 0;
}

.service-selection-cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 2rem;
    max-width: 800px;
    margin: 0 auto;
}

.service-card {
    background: rgba(255, 255, 255, 0.95);
    border-radius: 16px;
    padding: 1.5rem;
    cursor: pointer;
    transition: all 0.3s ease;
    border: 3px solid transparent;
    backdrop-filter: blur(10px);
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    min-height: 120px;
}

.service-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
}

.service-card.active {
    border-color: #667eea;
    background: white;
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(102, 126, 234, 0.3);
}

.service-icon {
    color: #667eea;
    margin-bottom: 1rem;
}

.service-content h3 {
    font-size: 1.25rem;
    font-weight: 700;
    color: #2c3e50;
    margin: 0;
}

/* Proposal Section Styles */
.proposal-section {
    background: #f8f9fa;
}

.intro-card {
    background: white;
    border-radius: 16px;
    padding: 2.5rem;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    margin-bottom: 2rem;
}

.intro-icon {
    text-align: center;
    margin-bottom: 1.5rem;
    color: #667eea;
}

.intro-content h3 {
    font-size: 2rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 1rem;
    text-align: center;
}

.kategori-info {
    margin: 2rem 0;
}

.kategori-info h4 {
    color: #2c3e50;
    margin-bottom: 1.5rem;
    font-size: 1.25rem;
}

.kategori-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.kategori-item {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 1.5rem;
    background: #f8f9fa;
    border-radius: 12px;
    border-left: 4px solid #667eea;
}

.kategori-icon {
    font-size: 2rem;
    flex-shrink: 0;
}

.kategori-content h5 {
    color: #2c3e50;
    margin-bottom: 0.5rem;
    font-weight: 600;
}

.kategori-content p {
    color: #6c757d;
    font-size: 0.9rem;
    line-height: 1.5;
    margin: 0;
}

.action-buttons {
    display: flex;
    gap: 1rem;
    justify-content: center;
    flex-wrap: wrap;
}

.btn-primary, .btn-secondary {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.875rem 1.5rem;
    border-radius: 10px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-primary {
    background: #667eea;
    color: white;
}

.btn-primary:hover {
    background: #5a6fd8;
    transform: translateY(-2px);
}

.btn-secondary {
    background: white;
    color: #667eea;
    border: 2px solid #667eea;
}

.btn-secondary:hover {
    background: #667eea;
    color: white;
    transform: translateY(-2px);
}

/* Requirements */
.requirements-info {
    background: white;
    border-radius: 16px;
    padding: 2rem;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
}

.requirements-info h4 {
    color: #2c3e50;
    margin-bottom: 1.5rem;
    font-size: 1.25rem;
}

.requirements-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
}

.requirement-item {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 1rem;
    background: #f8f9fa;
    border-radius: 10px;
}

.requirement-icon {
    font-size: 1.5rem;
    flex-shrink: 0;
}

.requirement-content h5 {
    color: #2c3e50;
    margin-bottom: 0.5rem;
    font-weight: 600;
}

.requirement-content p {
    color: #6c757d;
    font-size: 0.9rem;
    line-height: 1.5;
    margin: 0;
}

@media (max-width: 768px) {
    .service-selection-cards {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .service-card {
        padding: 1.5rem;
    }
    
    .action-buttons {
        flex-direction: column;
        align-items: center;
    }
    
    .btn-primary, .btn-secondary {
        width: 100%;
        max-width: 300px;
        justify-content: center;
    }
}
</style>
@endpush

@push('scripts')
<script>
    const roomsData = @json($rooms);
    
    // Service selection functionality
    function showService(serviceType) {
        // Update card states
        document.querySelectorAll('.service-card').forEach(card => {
            card.classList.remove('active');
        });
        document.getElementById(serviceType + '-card').classList.add('active');
        
        // Show/hide content sections
        if (serviceType === 'booking') {
            document.getElementById('booking-content').style.display = 'block';
            document.getElementById('proposal-content').style.display = 'none';
            document.getElementById('booking-schedule').style.display = 'block';
        } else {
            document.getElementById('booking-content').style.display = 'none';
            document.getElementById('proposal-content').style.display = 'block';
            document.getElementById('booking-schedule').style.display = 'none';
        }
    }
    
    function showRoomDetails(roomId) {
        const room = roomsData.find(r => r.id === roomId);
        if (!room) return;
        
        document.getElementById('modalRoomName').textContent = room.name;
        document.getElementById('roomModal').style.display = 'flex';
        
        const facilitiesList = room.facilities ? room.facilities.map(f => `<span class="facility-tag">${f}</span>`).join('') : '<p>Tidak ada fasilitas khusus</p>';
        
        document.getElementById('modalRoomContent').innerHTML = `
            <div class="room-detail-content">
                <div class="room-detail-image">
                    ${room.image_url ? 
                        `<img src="${room.image_url}" alt="${room.name}" style="width: 100%; height: 200px; object-fit: cover; border-radius: 10px;">` :
                        `<div class="room-placeholder" style="height: 200px; border-radius: 10px;">
                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                <polyline points="9,22 9,12 15,12 15,22"></polyline>
                            </svg>
                            <span>${room.name}</span>
                        </div>`
                    }
                </div>
                
                <div class="room-detail-info" style="margin-top: 20px;">
                    <h4 style="color: #2c3e50; margin-bottom: 10px;">Informasi Ruangan</h4>
                    <div class="detail-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; margin-bottom: 20px;">
                        <div class="detail-item">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" style="color: #3498db;">
                                <path d="M16 7c0-2.21-1.79-4-4-4S8 4.79 8 7s1.79 4 4 4 4-1.79 4-4zm-4 6c-2.67 0-8 1.34-8 4v3h16v-3c0-2.66-5.33-4-8-4z"/>
                            </svg>
                            <span>Kapasitas: ${room.capacity} orang</span>
                        </div>
                        <div class="detail-item">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" style="color: #27ae60;">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm3.5 6L12 10.5 8.5 8 12 5.5 15.5 8zM12 17.5L8.5 15l3.5-2.5 3.5 2.5L12 17.5z"/>
                            </svg>
                            <span>Tersedia: ${room.available_from} - ${room.available_until}</span>
                        </div>
                    </div>
                    
                    <h4 style="color: #2c3e50; margin-bottom: 10px;">Deskripsi</h4>
                    <p style="color: #6c757d; line-height: 1.6; margin-bottom: 20px;">${room.description}</p>
                    
                    <h4 style="color: #2c3e50; margin-bottom: 10px;">Fasilitas</h4>
                    <div class="facilities-list" style="margin-bottom: 20px;">
                        ${facilitiesList}
                    </div>
                    
                    <div style="text-align: center;">
                        <a href="/booking/rooms/${room.id}" class="btn-book" style="display: inline-flex; text-decoration: none;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11zM7 10h5v5H7z"/>
                            </svg>
                            Book Ruangan Ini
                        </a>
                    </div>
                </div>
            </div>
        `;
    }

    function closeRoomModal() {
        document.getElementById('roomModal').style.display = 'none';
    }

    // Close modal when clicking outside
    window.onclick = function(event) {
        const modal = document.getElementById('roomModal');
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }
    
    // Close modal with Escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeRoomModal();
        }
    });
</script>
@endpush