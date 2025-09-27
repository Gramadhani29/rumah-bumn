@extends('layouts.public-booking')

@section('title', 'Booking Ruangan - Rumah BUMN Telkom Pekalongan')
@section('description', 'Layanan booking ruangan untuk kegiatan dan acara di Rumah BUMN Telkom Pekalongan')
@section('content')
    <!-- Jadwal Booking Hari Ini -->
    <section class="schedule-section section" style="background: #f8f9fa;">
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
            <div style="background: #ecfbff; padding: 1.5rem; border-radius: 12px; margin-top: 2rem; border-left: 4px solid #0098ff;">
                <h4 style="margin: 0 0 1rem 0; color: #0066cc; display: flex; align-items: center; gap: 0.5rem;">
                    💡 Tips Booking
                </h4>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1rem; color: #0066cc; font-size: 14px;">
                    <div>• Booking minimal 1 hari sebelum acara</div>
                    <div>• Pastikan jam tidak bentrok dengan booking lain</div>
                    <div>• Konfirmasi akan dikirim via email/SMS</div>
                    <div>• Hubungi admin jika ada pertanyaan</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Booking Section -->
    <section class="booking-section section" id="booking-content">
        <div class="container">
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
</style>
@endpush

@push('scripts')
<script>
    const roomsData = @json($rooms);
    
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
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" style="color: #0098ff;">
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