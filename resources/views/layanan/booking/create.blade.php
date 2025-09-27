@extends('layouts.public-booking')

@section('title', 'Book ' . $room->name . ' - Rumah BUMN Telkom Pekalongan')
@section('description', 'Form booking untuk ' . $room->name . ' di Rumah BUMN Telkom Pekalongan')

@section('content')
    <!-- Room Image Header -->
    <section class="room-image-header">
        <div class="room-image-container">
            @if($room->image)
                <img src="{{ Storage::url($room->image) }}" 
                     alt="{{ $room->name }}" 
                     class="room-header-image">
            @else
                <div class="room-placeholder-image">
                    <svg width="120" height="120" viewBox="0 0 24 24" fill="currentColor" opacity="0.3">
                        <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H5l3.5-4.5 2.5 3.01L14.5 11l4.5 6z"/>
                    </svg>
                </div>
            @endif
            
            <!-- Breadcrumb Overlay -->
            <div class="breadcrumb-overlay">
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
                    <span>{{ $room->name }}</span>
                </nav>
            </div>
        </div>
    </section>

    <!-- Booking Form Section -->
    <section class="booking-form-section section">
        <div class="container-fluid">
            <div class="booking-form-container-full">
            <!-- Room Schedule Info -->
            <div style="background: white; border-radius: 15px; padding: 2rem; margin-bottom: 2rem; box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);">
                <h3 style="margin: 0 0 1.5rem 0; color: #2c3e50; display: flex; align-items: center; gap: 0.5rem;">
                    📅 Jadwal Booking {{ $room->name }}
                </h3>

                @php
                    $todayBookings = $room->bookings()
                        ->where('booking_date', now()->toDateString())
                        ->where('status', '!=', 'cancelled')
                        ->orderBy('time_from')
                        ->get();
                    
                    $tomorrowBookings = $room->bookings()
                        ->where('booking_date', now()->addDay()->toDateString())
                        ->where('status', '!=', 'cancelled')
                        ->orderBy('time_from')
                        ->get();
                @endphp

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem;">
                    <!-- Today's Schedule -->
                    <div>
                        <h4 style="margin: 0 0 1rem 0; color: #495057; padding-bottom: 0.5rem; border-bottom: 2px solid #e9ecef;">
                            📍 Hari Ini ({{ now()->locale('id')->isoFormat('D MMM') }})
                        </h4>
                        @if($todayBookings->count() > 0)
                            <div style="display: grid; gap: 0.5rem;">
                                @foreach($todayBookings as $booking)
                                    <div style="display: flex; justify-content: space-between; padding: 0.75rem; 
                                               background: #f8f9fa; border-radius: 6px; 
                                               border-left: 3px solid {{ $booking->status === 'confirmed' ? '#dc3545' : '#ffc107' }};">
                                        <span style="font-weight: 600; color: #2c3e50;">
                                            {{ \Carbon\Carbon::parse($booking->time_from)->format('H:i') }} - {{ \Carbon\Carbon::parse($booking->time_until)->format('H:i') }}
                                        </span>
                                        <span style="font-size: 12px; color: {{ $booking->status === 'confirmed' ? '#dc3545' : '#856404' }}; font-weight: 500;">
                                            {{ $booking->status === 'confirmed' ? 'TERISI' : 'PENDING' }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div style="text-align: center; padding: 1.5rem; color: #28a745; background: #d4edda; border-radius: 8px;">
                                <p style="margin: 0; font-weight: 500;">✅ Semua jam tersedia</p>
                            </div>
                        @endif
                    </div>

                    <!-- Tomorrow's Schedule -->
                    <div>
                        <h4 style="margin: 0 0 1rem 0; color: #495057; padding-bottom: 0.5rem; border-bottom: 2px solid #e9ecef;">
                            📍 Besok ({{ now()->addDay()->locale('id')->isoFormat('D MMM') }})
                        </h4>
                        @if($tomorrowBookings->count() > 0)
                            <div style="display: grid; gap: 0.5rem;">
                                @foreach($tomorrowBookings as $booking)
                                    <div style="display: flex; justify-content: space-between; padding: 0.75rem; 
                                               background: #f8f9fa; border-radius: 6px; 
                                               border-left: 3px solid {{ $booking->status === 'confirmed' ? '#dc3545' : '#ffc107' }};">
                                        <span style="font-weight: 600; color: #2c3e50;">
                                            {{ \Carbon\Carbon::parse($booking->time_from)->format('H:i') }} - {{ \Carbon\Carbon::parse($booking->time_until)->format('H:i') }}
                                        </span>
                                        <span style="font-size: 12px; color: {{ $booking->status === 'confirmed' ? '#dc3545' : '#856404' }}; font-weight: 500;">
                                            {{ $booking->status === 'confirmed' ? 'TERISI' : 'PENDING' }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div style="text-align: center; padding: 1.5rem; color: #28a745; background: #d4edda; border-radius: 8px;">
                                <p style="margin: 0; font-weight: 500;">✅ Semua jam tersedia</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Operating Hours Info -->
                <div style="background: #fff3cd; padding: 1rem; border-radius: 8px; margin-top: 1.5rem; border-left: 4px solid #ffc107;">
                    <p style="margin: 0; color: #856404; font-size: 14px;">
                        ⏰ <strong>Jam Operasional:</strong> {{ $room->available_from }} - {{ $room->available_until }} 
                        | <strong>Kapasitas:</strong> {{ $room->capacity }} orang
                    </p>
                </div>
            </div>

            <div class="booking-form-content">
                <!-- Form Header -->
                <div class="form-header">
                    <div class="form-header-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11zM7 10h5v5H7z"/>
                        </svg>
                    </div>
                    <h2>Form Booking Ruangan</h2>
                    <p>Lengkapi semua informasi yang diperlukan untuk booking ruangan</p>
                </div>

                @if ($errors->any())
                    <div class="alert alert-error">
                        <ul style="margin: 0; padding-left: 1.5rem;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <form action="{{ route('booking.store') }}" method="POST" id="bookingForm">
                    @csrf
                    <input type="hidden" name="room_id" value="{{ $room->id }}">
                    
                    <div class="form-sections">
                        <!-- Section 1: Informasi Ruangan -->
                        <div class="form-section">
                            <h3>🏢 Informasi Ruangan</h3>
                            
                            <div class="room-info-card">
                                <h4>{{ $room->name }}</h4>
                                <p>{{ $room->description }}</p>
                                <div class="room-details">
                                    <span class="detail-item">👥 Kapasitas: {{ $room->capacity }} orang</span>
                                    <span class="detail-item">⏰ {{ $room->available_from }} - {{ $room->available_until }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Section 2: Waktu Booking -->
                        <div class="form-section">
                            <h3>📅 Waktu Booking</h3>
                            
                            <div class="form-group">
                                <label for="booking_date">Tanggal Booking <span class="required">*</span></label>
                                <input type="date" 
                                       id="booking_date" 
                                       name="booking_date" 
                                       class="form-control" 
                                       min="{{ date('Y-m-d') }}" 
                                       max="{{ date('Y-m-d', strtotime('+30 days')) }}"
                                       value="{{ old('booking_date') }}"
                                       required>
                                <small class="form-text">Pilih tanggal untuk melihat slot waktu yang tersedia</small>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="time_from">Waktu Mulai <span class="required">*</span></label>
                                    <input type="time" 
                                           id="time_from" 
                                           name="time_from" 
                                           class="form-control"
                                           min="{{ $room->available_from }}"
                                           max="{{ $room->available_until }}"
                                           value="{{ old('time_from') }}"
                                           required>
                                </div>
                                <div class="form-group">
                                    <label for="time_until">Waktu Selesai <span class="required">*</span></label>
                                    <input type="time" 
                                           id="time_until" 
                                           name="time_until" 
                                           class="form-control"
                                           min="{{ $room->available_from }}"
                                           max="{{ $room->available_until }}"
                                           value="{{ old('time_until') }}"
                                           required>
                                </div>
                            </div>
                        </div>

                        <!-- Section 3: Informasi Kontak -->
                        <div class="form-section">
                            <h3>👤 Informasi Kontak</h3>
                            
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="contact_name">Nama Lengkap <span class="required">*</span></label>
                                    <input type="text" 
                                           id="contact_name" 
                                           name="contact_name" 
                                           class="form-control"
                                           value="{{ old('contact_name', auth()->user()->name ?? '') }}"
                                           placeholder="Masukkan nama lengkap Anda"
                                           required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="contact_phone">No. Telepon <span class="required">*</span></label>
                                    <input type="tel" 
                                           id="contact_phone" 
                                           name="contact_phone" 
                                           class="form-control"
                                           value="{{ old('contact_phone') }}"
                                           placeholder="08xxxxxxxxxx"
                                           required>
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="contact_email">Email</label>
                                    <input type="email" 
                                           id="contact_email" 
                                           name="contact_email" 
                                           class="form-control"
                                           value="{{ old('contact_email', auth()->user()->email ?? '') }}"
                                           placeholder="Email Anda (opsional)">
                                </div>
                                
                                <div class="form-group">
                                    <label for="organization">Organisasi/Instansi</label>
                                    <input type="text" 
                                           id="organization" 
                                           name="organization" 
                                           class="form-control"
                                           value="{{ old('organization') }}"
                                           placeholder="Nama perusahaan/organisasi (opsional)">
                                </div>
                            </div>
                        </div>

                        <!-- Section 4: Detail Kegiatan -->
                        <div class="form-section">
                            <h3>📝 Detail Kegiatan</h3>
                            
                            <div class="form-group">
                                <label for="purpose">Tujuan Penggunaan <span class="required">*</span></label>
                                <textarea id="purpose" 
                                          name="purpose" 
                                          class="form-control" 
                                          rows="4"
                                          placeholder="Jelaskan tujuan penggunaan ruangan, agenda kegiatan, dan peserta yang akan hadir..."
                                          required>{{ old('purpose') }}</textarea>
                            </div>
                            
                            <div class="form-group">
                                <label for="notes">Catatan Tambahan</label>
                                <textarea id="notes" 
                                          name="notes" 
                                          class="form-control" 
                                          rows="3"
                                          placeholder="Permintaan khusus, peralatan yang dibutuhkan, atau informasi tambahan lainnya (opsional)">{{ old('notes') }}</textarea>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Submit Button -->
                    <div class="form-actions">
                        <a href="{{ route('booking.index') }}" class="btn-secondary">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/>
                            </svg>
                            Kembali
                        </a>
                        <button type="submit" class="btn-primary" id="submitBtn">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                            </svg>
                            Submit Booking
                        </button>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
<style>
/* Room Image Header */
.room-image-header {
    position: relative;
    height: 400px;
    overflow: hidden;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.room-image-container {
    position: relative;
    width: 100%;
    height: 100%;
}

.room-header-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
}

.room-placeholder-image {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    height: 100%;
    color: #fff;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.breadcrumb-overlay {
    position: absolute;
    top: 2rem;
    left: 2rem;
    z-index: 2;
}

.breadcrumb-overlay .breadcrumb {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    background: rgba(255, 255, 255, 0.95);
    padding: 0.75rem 1.5rem;
    border-radius: 25px;
    backdrop-filter: blur(10px);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    font-size: 0.9rem;
}

.breadcrumb-overlay .breadcrumb a {
    color: #667eea;
    text-decoration: none;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 0.25rem;
    transition: color 0.2s ease;
}

.breadcrumb-overlay .breadcrumb a:hover {
    color: #5a67d8;
}

.breadcrumb-overlay .breadcrumb span {
    color: #2c3e50;
    font-weight: 600;
}

.breadcrumb-overlay .breadcrumb svg {
    opacity: 0.6;
}

.booking-form-section {
    padding: 2rem 0;
    background: #f8f9fa;
    margin-top: -50px;
    position: relative;
    z-index: 1;
}

.booking-form-container-full {
    width: 100%;
    margin: 0;
    padding: 0 1rem;
}

.booking-form-content {
    background: white;
    border-radius: 16px;
    padding: 2.5rem;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    margin-top: 1.5rem;
}

/* Form Header */
.form-header {
    text-align: center;
    margin-bottom: 2rem;
    padding-bottom: 1.5rem;
    border-bottom: 2px solid #f1f3f4;
}

.form-header-icon {
    color: #667eea;
    margin-bottom: 1rem;
}

.form-header h2 {
    color: #2c3e50;
    margin-bottom: 0.5rem;
    font-size: 1.8rem;
    font-weight: 700;
}

.form-header p {
    color: #6c757d;
    margin: 0;
    font-size: 1rem;
}

/* Form Sections */
.form-sections {
    display: flex;
    flex-direction: column;
    gap: 2rem;
}

.form-section {
    background: #f8f9fa;
    border-radius: 12px;
    padding: 1.5rem;
    border-left: 4px solid #667eea;
}

.form-section h3 {
    color: #2c3e50;
    margin: 0 0 1.5rem 0;
    font-size: 1.2rem;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

/* Room Info Card */
.room-info-card {
    background: white;
    border-radius: 10px;
    padding: 1.5rem;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
}

.room-info-card h4 {
    color: #2c3e50;
    margin: 0 0 0.5rem 0;
    font-size: 1.3rem;
    font-weight: 600;
}

.room-info-card p {
    color: #6c757d;
    margin: 0 0 1rem 0;
    line-height: 1.5;
}

.room-details {
    display: flex;
    gap: 1.5rem;
    flex-wrap: wrap;
}

.detail-item {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: #e3f2fd;
    color: #1976d2;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: 500;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
}

.form-group label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 600;
    color: #2c3e50;
    font-size: 0.95rem;
}

.required {
    color: #e74c3c;
}

.form-text {
    color: #6c757d;
    font-size: 0.8rem;
    margin-top: 0.25rem;
    display: block;
}

.form-control {
    width: 100%;
    padding: 0.75rem 1rem;
    border: 2px solid #e9ecef;
    border-radius: 8px;
    font-size: 1rem;
    transition: all 0.2s ease;
    background: #fff;
}

.form-control:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

.form-control:invalid {
    border-color: #e74c3c;
}

textarea.form-control {
    resize: vertical;
    min-height: 100px;
}

.form-actions {
    display: flex;
    gap: 1rem;
    justify-content: flex-end;
    margin-top: 2rem;
    padding-top: 2rem;
    border-top: 2px solid #f1f3f4;
}

.btn-primary, .btn-secondary {
    padding: 0.75rem 2rem;
    border-radius: 50px;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    border: none;
    cursor: pointer;
    transition: all 0.2s ease;
    font-size: 1rem;
}

.btn-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
}

.btn-secondary {
    background: #f8f9fa;
    color: #6c757d;
    border: 2px solid #e9ecef;
}

.btn-secondary:hover {
    background: #e9ecef;
    color: #495057;
}

.alert {
    padding: 1rem 1.5rem;
    border-radius: 8px;
    margin-bottom: 1.5rem;
}

.alert-error {
    background: #f8d7da;
    border: 1px solid #f5c6cb;
    color: #721c24;
}

/* Responsive Design */
@media (max-width: 768px) {
    .room-image-header {
        height: 250px;
    }
    
    .breadcrumb-overlay {
        top: 1rem;
        left: 1rem;
        right: 1rem;
    }
    
    .breadcrumb-overlay .breadcrumb {
        padding: 0.5rem 1rem;
        font-size: 0.8rem;
    }
    
    .booking-form-section {
        margin-top: -30px;
    }
    
    .booking-form-container-full {
        padding: 0 0.5rem;
    }
    
    .booking-form-content {
        padding: 1.5rem;
    }
    
    .form-row {
        grid-template-columns: 1fr;
        gap: 0;
    }
    
    .form-actions {
        flex-direction: column;
    }
    
    .btn-primary, .btn-secondary {
        width: 100%;
        justify-content: center;
    }
}

@media (max-width: 480px) {
    .container-fluid {
        padding: 0 1rem !important;
    }
}
</style>
@endpush

@push('scripts')
<script>
    const bookingDateInput = document.getElementById('booking_date');
    const timeFromInput = document.getElementById('time_from');
    const timeUntilInput = document.getElementById('time_until');
    
    function validateTimeInputs() {
        const timeFrom = timeFromInput.value;
        const timeUntil = timeUntilInput.value;
        const bookingDate = bookingDateInput.value;
        
        if (timeFrom && timeUntil) {
            if (timeUntil <= timeFrom) {
                alert('Waktu selesai harus lebih dari waktu mulai');
                timeUntilInput.value = '';
                return false;
            }
        }
        
        // Check if booking time is in the past for today's date
        if (bookingDate && timeFrom) {
            const now = new Date();
            const selectedDate = new Date(bookingDate);
            const selectedDateTime = new Date(bookingDate + 'T' + timeFrom + ':00');
            
            // If booking is for today and time is in the past
            if (selectedDate.toDateString() === now.toDateString() && selectedDateTime < now) {
                alert('Tidak dapat booking waktu yang sudah berlalu');
                timeFromInput.value = '';
                return false;
            }
        }
        
        return true;
    }
    
    // Add event listeners for time validation
    timeFromInput.addEventListener('change', validateTimeInputs);
    timeUntilInput.addEventListener('change', validateTimeInputs);
    bookingDateInput.addEventListener('change', validateTimeInputs);
    
    // Form validation
    document.getElementById('bookingForm').addEventListener('submit', function(e) {
        const submitBtn = document.getElementById('submitBtn');
        
        if (!validateTimeInputs()) {
            e.preventDefault();
            return false;
        }
        
        const timeFrom = timeFromInput.value;
        const timeUntil = timeUntilInput.value;
        
        if (!timeFrom || !timeUntil) {
            e.preventDefault();
            alert('Mohon pilih waktu booking yang valid');
            return false;
        }
        
        // Show loading state
        setButtonLoading(submitBtn, true);
        
        return true;
    });
</script>
@endpush