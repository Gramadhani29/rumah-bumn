@extends('layouts.public-booking')

@section('title', 'Book ' . $room->name . ' - Rumah BUMN Telkom Pekalongan')
@section('description', 'Form booking untuk ' . $room->name . ' di Rumah BUMN Telkom Pekalongan')

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
                    <span>{{ $room->name }}</span>
                </nav>
                
                <h1>Book {{ $room->name }}</h1>
                <p>Isi form di bawah untuk melakukan booking ruangan</p>
            </div>
        </div>
    </section>

    <!-- Booking Form Section -->
    <section class="booking-form-section section">
        <div class="booking-form-container">
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

            <div class="booking-form-header">
                <h2>Form Booking Ruangan</h2>
                <p>Isi data dengan lengkap untuk proses booking ruangan</p>
            </div>
            
            <div class="booking-form-content">
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
                    
                    <!-- Room Info Summary -->
                    <div class="form-group">
                        <div style="background: #f8f9fa; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem;">
                            <h4 style="margin: 0 0 0.5rem 0; color: #2c3e50;">{{ $room->name }}</h4>
                            <p style="margin: 0 0 0.5rem 0; color: #6c757d; font-size: 14px;">{{ $room->description }}</p>
                            <div style="display: flex; gap: 1rem; font-size: 14px; color: #6c757d;">
                                <span>🏢 Kapasitas: {{ $room->capacity }} orang</span>
                                <span>🕐 {{ $room->available_from }} - {{ $room->available_until }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Date Selection -->
                    <div class="form-group">
                        <label for="booking_date">Tanggal Booking <span style="color: #e74c3c;">*</span></label>
                        <input type="date" 
                               id="booking_date" 
                               name="booking_date" 
                               class="form-control" 
                               min="{{ date('Y-m-d') }}" 
                               max="{{ date('Y-m-d', strtotime('+30 days')) }}"
                               value="{{ old('booking_date') }}"
                               required>
                        <small style="color: #6c757d; font-size: 12px;">Pilih tanggal untuk melihat slot waktu yang tersedia</small>
                    </div>
                    
                    <!-- Time Selection -->
                    <div class="form-row">
                        <div class="form-group">
                            <label for="time_from">Waktu Mulai <span style="color: #e74c3c;">*</span></label>
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
                            <label for="time_until">Waktu Selesai <span style="color: #e74c3c;">*</span></label>
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
                    
                    <!-- Contact Information -->
                    <div class="form-row">
                        <div class="form-group">
                            <label for="contact_name">Nama Lengkap <span style="color: #e74c3c;">*</span></label>
                            <input type="text" 
                                   id="contact_name" 
                                   name="contact_name" 
                                   class="form-control"
                                   value="{{ old('contact_name', auth()->user()->name ?? '') }}"
                                   placeholder="Masukkan nama lengkap Anda"
                                   required>
                        </div>
                        
                        <div class="form-group">
                            <label for="contact_phone">No. Telepon <span style="color: #e74c3c;">*</span></label>
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
                    
                    <!-- Event Details -->
                    <div class="form-group">
                        <label for="purpose">Tujuan Penggunaan <span style="color: #e74c3c;">*</span></label>
                        <textarea id="purpose" 
                                  name="purpose" 
                                  class="form-control" 
                                  rows="3"
                                  placeholder="Jelaskan tujuan penggunaan ruangan..."
                                  required>{{ old('purpose') }}</textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="notes">Catatan Tambahan</label>
                        <textarea id="notes" 
                                  name="notes" 
                                  class="form-control" 
                                  rows="3"
                                  placeholder="Permintaan khusus atau informasi tambahan (opsional)">{{ old('notes') }}</textarea>
                    </div>
                    
                    <!-- Submit Button -->
                    <div class="form-actions">
                        <a href="{{ route('booking.index') }}" class="btn-secondary">
                            ← Kembali
                        </a>
                        <button type="submit" class="btn-primary" id="submitBtn">
                            📅 Submit Booking
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

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