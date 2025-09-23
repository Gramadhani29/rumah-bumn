@extends('layouts.public-booking')

@section('title', 'Book ' . $room->name . ' - Rumah BUMN Telkom Pekalongan')
@section('description', 'Form booking untuk ' . $room->name . ' di Rumah BUMN Telkom Pekalongan')
/* Reset and Base Styles */
* {
    box-sizing: border-box;
}

.container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 1rem;
}

.section {
    padding: 2rem 0;
}

/* Page Header Styles */
.page-header-section {
    background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
    color: white;
    padding: 2rem 0;
    position: relative;
    overflow: hidden;
}

.page-header-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd"><g fill="%23ffffff" fill-opacity="0.05"><circle cx="36" cy="24" r="6"/></g></svg>') repeat;
    opacity: 0.3;
}

.page-header-content {
    position: relative;
    z-index: 1;
}

/* Breadcrumb Styles */
.breadcrumb {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 2rem;
    flex-wrap: wrap;
}

.breadcrumb a {
    display: flex;
    align-items: center;
    gap: 0.375rem;
    color: #e2e8f0;
    text-decoration: none;
    font-size: 0.875rem;
    font-weight: 500;
    padding: 0.375rem 0.75rem;
    border-radius: 6px;
    transition: all 0.3s ease;
}

.breadcrumb a:hover {
    background: rgba(255, 255, 255, 0.1);
    color: white;
}

.breadcrumb svg {
    color: #64748b;
    opacity: 0.5;
}

.breadcrumb span {
    color: #fbbf24;
    font-weight: 600;
    font-size: 0.875rem;
    padding: 0.375rem 0.75rem;
    background: rgba(251, 191, 36, 0.1);
    border-radius: 6px;
    border: 1px solid rgba(251, 191, 36, 0.2);
}

.page-header-content h1 {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 0.75rem;
    color: white;
    line-height: 1.2;
}

.page-header-content p {
    font-size: 1.125rem;
    color: #cbd5e1;
    margin: 0;
    font-weight: 400;
}

/* Booking Form Section */
.booking-form-section {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    min-height: 80vh;
    padding: 3rem 0;
}

.booking-layout {
    display: grid;
    grid-template-columns: 400px 600px;
    gap: 2rem;
    max-width: 1200px;
    margin: 0 auto;
    align-items: start;
    justify-content: center;
}

/* Form Area Wrapper */
.form-area {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

/* Room Info Card */
.room-info-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.12), 0 8px 25px -8px rgba(0, 0, 0, 0.08);
    overflow: hidden;
    transition: all 0.3s ease;
    margin-bottom: 2rem;
}

.room-info-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15), 0 12px 30px -8px rgba(0, 0, 0, 0.1);
}

.room-image {
    width: 100%;
    height: 200px;
    overflow: hidden;
    position: relative;
}

.room-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.room-info-card:hover .room-image img {
    transform: scale(1.05);
}

.room-details {
    padding: 2rem;
}

.room-details h3 {
    font-size: 1.5rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 1rem;
}

.room-details p {
    color: #64748b;
    line-height: 1.6;
    margin-bottom: 1.5rem;
}

.room-specs {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
    margin-bottom: 2rem;
}

.spec-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem 1rem;
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    border-radius: 12px;
    border: 1px solid #e2e8f0;
    color: #475569;
    font-weight: 500;
    font-size: 0.875rem;
}

.spec-item svg {
    color: #6366f1;
    flex-shrink: 0;
}

.room-facilities h4 {
    font-size: 1rem;
    font-weight: 600;
    color: #374151;
    margin-bottom: 1rem;
}

.facilities-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
}

.facility-item {
    display: inline-flex;
    align-items: center;
    gap: 0.375rem;
    padding: 0.375rem 0.75rem;
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 500;
}

.facility-item svg {
    width: 12px;
    height: 12px;
}

/* Existing Bookings Card */
.existing-bookings-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.12), 0 8px 25px -8px rgba(0, 0, 0, 0.08);
    padding: 1.5rem;
    margin-bottom: 1rem;
    transition: all 0.3s ease;
}

.existing-bookings-card:hover {
    transform: translateY(-1px);
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15), 0 12px 30px -8px rgba(0, 0, 0, 0.1);
}

.existing-bookings-card h3 {
    font-size: 1.25rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.existing-bookings-card h3::before {
    content: '';
    width: 4px;
    height: 24px;
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    border-radius: 2px;
}

.loading-text, .no-bookings, .error-text {
    color: #64748b;
    font-style: italic;
    text-align: center;
    padding: 2rem 0;
}

.booking-timeline {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.booking-slot {
    padding: 1.25rem;
    border-radius: 12px;
    border-left: 4px solid;
    transition: all 0.3s ease;
}

.booking-slot.confirmed {
    background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
    border-left-color: #10b981;
}

.booking-slot.pending {
    background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
    border-left-color: #f59e0b;
}

.booking-slot.cancelled {
    background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
    border-left-color: #ef4444;
}

.booking-time {
    font-size: 1rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 0.5rem;
}

.booking-info {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 0.5rem;
}

.booking-info strong {
    color: #374151;
}

.booking-status {
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    padding: 0.25rem 0.5rem;
    border-radius: 12px;
}

.status-confirmed {
    background: rgba(16, 185, 129, 0.2);
    color: #10b981;
}

.status-pending {
    background: rgba(245, 158, 11, 0.2);
    color: #f59e0b;
}

.status-cancelled {
    background: rgba(239, 68, 68, 0.2);
    color: #ef4444;
}

.booking-purpose {
    color: #6b7280;
    font-size: 0.875rem;
    font-style: italic;
}

.booking-note {
    margin-top: 1.5rem;
    padding: 1rem;
    background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
    border-radius: 8px;
    color: #1e40af;
    font-size: 0.875rem;
}

/* Booking Form Card */
.booking-form-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.12), 0 8px 25px -8px rgba(0, 0, 0, 0.08);
    padding: 2rem;
    transition: all 0.3s ease;
}

.booking-form-card:hover {
    transform: translateY(-1px);
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15), 0 12px 30px -8px rgba(0, 0, 0, 0.1);
}

.booking-form-card h3 {
    font-size: 1.5rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.booking-form-card h3::before {
    content: '';
    width: 4px;
    height: 28px;
    background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
    border-radius: 2px;
}

/* Alert Styles */
.alert {
    padding: 1rem 1.5rem;
    border-radius: 12px;
    margin-bottom: 2rem;
    border: none;
}

.alert-error {
    background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
    color: #dc2626;
    border-left: 4px solid #ef4444;
}

.alert ul {
    margin: 0;
    padding-left: 1.5rem;
}

.alert li {
    margin-bottom: 0.5rem;
}

/* Form Styles */
.form-group {
    margin-bottom: 1.5rem;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
}

.form-section {
    margin-bottom: 2rem;
    padding: 1.5rem;
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    border-radius: 16px;
    border: 1px solid #e2e8f0;
}

.form-section h4 {
    font-size: 1.25rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.form-section h4::before {
    content: '';
    width: 3px;
    height: 20px;
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    border-radius: 2px;
}

label {
    display: block;
    font-weight: 600;
    color: #374151;
    margin-bottom: 0.5rem;
    font-size: 0.875rem;
}

.required {
    color: #ef4444;
}

.form-control {
    width: 100%;
    padding: 0.875rem 1rem;
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: white;
}

.form-control:focus {
    outline: none;
    border-color: #6366f1;
    box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
}

.form-control:hover {
    border-color: #d1d5db;
}

textarea.form-control {
    resize: vertical;
    min-height: 100px;
}

.help-text {
    display: block;
    margin-top: 0.5rem;
    color: #6b7280;
    font-size: 0.8rem;
    font-style: italic;
}

/* Time Selection */
.time-selection {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.5rem;
}

.time-input-group {
    display: flex;
    flex-direction: column;
}

.time-input-group label {
    margin-bottom: 0.5rem;
    font-size: 0.875rem;
    color: #6b7280;
}

/* Available Slots */
.available-slots {
    margin-top: 1.5rem;
    padding: 1.5rem;
    background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
    border-radius: 12px;
    border: 1px solid #0ea5e9;
}

.available-slots p {
    font-weight: 600;
    color: #0369a1;
    margin-bottom: 1rem;
}

#slotsContainer {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
    gap: 0.75rem;
}

.slot-button {
    padding: 0.75rem 1rem;
    border: 2px solid #e2e8f0;
    border-radius: 8px;
    background: white;
    color: #374151;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
    text-align: center;
}

.slot-button:hover {
    border-color: #6366f1;
    background: #f8fafc;
}

.slot-button.selected {
    background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
    color: white;
    border-color: #4f46e5;
}

.slot-button.unavailable {
    background: #f3f4f6;
    color: #9ca3af;
    cursor: not-allowed;
    border-color: #e5e7eb;
}

/* Form Actions */
.form-actions {
    display: flex;
    gap: 1.5rem;
    justify-content: flex-end;
    margin-top: 3rem;
    padding-top: 2rem;
    border-top: 1px solid #e5e7eb;
}

.btn-primary, .btn-secondary {
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    padding: 1rem 2rem;
    border-radius: 12px;
    font-weight: 600;
    text-decoration: none;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 1rem;
}

.btn-primary {
    background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
    color: white;
    box-shadow: 0 10px 25px -8px rgba(99, 102, 241, 0.3);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 15px 35px -8px rgba(99, 102, 241, 0.4);
    color: white;
    text-decoration: none;
}

.btn-secondary {
    background: white;
    color: #6b7280;
    border: 2px solid #e5e7eb;
}

.btn-secondary:hover {
    background: #f9fafb;
    border-color: #d1d5db;
    color: #374151;
    text-decoration: none;
    transform: translateY(-1px);
}

/* Responsive Design */
@media (max-width: 1024px) {
    .booking-layout {
        grid-template-columns: 350px 500px;
        gap: 1.5rem;
        max-width: 1000px;
    }
    
    .form-row {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .time-selection {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
}

@media (max-width: 768px) {
    .page-header-section {
        padding: 1.5rem 0;
    }
    
    .page-header-content h1 {
        font-size: 2rem;
    }
    
    .booking-layout {
        grid-template-columns: 1fr;
        gap: 1.5rem;
        max-width: 100%;
    }
    
    .form-area {
        order: 1;
    }
    
    .room-info-card {
        position: static;
        order: 2;
        margin-bottom: 0;
    }
    
    .room-details {
        padding: 1.5rem;
    }
    
    .booking-form-card {
        padding: 2rem;
    }
    
    .form-section {
        padding: 1.5rem;
        margin-bottom: 2rem;
    }
    
    .form-actions {
        flex-direction: column;
        gap: 1rem;
    }
    
    .btn-primary, .btn-secondary {
        justify-content: center;
    }
    
    .breadcrumb {
        justify-content: center;
        margin-bottom: 1.5rem;
    }
    
    .container {
        padding: 0 1rem;
    }
}

@media (max-width: 480px) {
    .page-header-content h1 {
        font-size: 1.75rem;
    }
    
    .booking-form-card,
    .existing-bookings-card {
        padding: 1.5rem;
    }
    
    .room-details {
        padding: 1.25rem;
    }
    
    .form-section {
        padding: 1.25rem;
    }
    
    #slotsContainer {
        grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
        gap: 0.5rem;
    }
    
    .slot-button {
        padding: 0.5rem 0.75rem;
        font-size: 0.875rem;
    }
}
</style>
@endpush

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
        <div class="container">
            <div class="booking-layout">
                <!-- Room Info -->
                <div class="room-info-card">
                    <div class="room-image">
                        @if($room->image_url)
                            <img src="{{ $room->image_url }}" alt="{{ $room->name }}">
                        @else
                            <div style="background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%); width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; color: white;">
                                <svg width="64" height="64" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12,11A1,1 0 0,0 13,12A1,1 0 0,0 12,13A1,1 0 0,0 11,12A1,1 0 0,0 12,11M12,7A5,5 0 0,1 17,12A5,5 0 0,1 12,17A5,5 0 0,1 7,12A5,5 0 0,1 12,7M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2Z"/>
                                </svg>
                            </div>
                        @endif
                    </div>
                    
                    <div class="room-details">
                        <h3>{{ $room->name }}</h3>
                        <p>{{ $room->description }}</p>
                        
                        <div class="room-specs">
                            <div class="spec-item">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M16 7c0-2.21-1.79-4-4-4S8 4.79 8 7s1.79 4 4 4 4-1.79 4-4zm-4 6c-2.67 0-8 1.34-8 4v3h16v-3c0-2.66-5.33-4-8-4z"/>
                                </svg>
                                <span>Kapasitas: {{ $room->capacity }} orang</span>
                            </div>
                            
                            <div class="spec-item">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm3.5 6L12 10.5 8.5 8 12 5.5 15.5 8zM12 17.5L8.5 15l3.5-2.5 3.5 2.5L12 17.5z"/>
                                </svg>
                                <span>Jam Operasional: {{ $room->available_from }} - {{ $room->available_until }}</span>
                            </div>
                        </div>
                        
                        @if($room->facilities)
                            <div class="room-facilities">
                                <h4>Fasilitas Tersedia:</h4>
                                <div class="facilities-grid">
                                    @foreach($room->facilities as $facility)
                                        <span class="facility-item">
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                            </svg>
                                            {{ $facility }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Form Area -->
                <div class="form-area">
                    <!-- Existing Bookings Info -->
                    <div class="existing-bookings-card">
                    <h3>
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M19,3H5C3.89,3 3,3.89 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V5C21,3.89 20.1,3 19,3M19,19H5V8H19V19M19,6H5V5H19V6Z"/>
                        </svg>
                        Booking Hari Ini
                    </h3>
                    <div id="todayBookings">
                        <p class="loading-text">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12,4V2A10,10 0 0,0 2,12H4A8,8 0 0,1 12,4Z">
                                    <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s" from="0 12 12" to="360 12 12" repeatCount="indefinite"/>
                                </path>
                            </svg>
                            Pilih tanggal untuk melihat booking yang sudah ada...
                        </p>
                    </div>
                </div>

                <!-- Booking Form -->
                <div class="booking-form-card">
                    <h3>
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M19,3H5C3.89,3 3,3.89 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V5C21,3.89 20.1,3 19,3M19,19H5V8H19V19M19,6H5V5H19V6Z"/>
                        </svg>
                        Form Booking
                    </h3>
                    
                    @if ($errors->any())
                        <div class="alert alert-error">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <form action="{{ route('booking.store') }}" method="POST" id="bookingForm">
                        @csrf
                        <input type="hidden" name="room_id" value="{{ $room->id }}">
                        
                        <!-- Date Selection -->
                        <div class="form-group">
                            <label for="booking_date">Tanggal Booking <span class="required">*</span></label>
                            <input type="date" 
                                   id="booking_date" 
                                   name="booking_date" 
                                   class="form-control" 
                                   min="{{ $today }}" 
                                   max="{{ $maxDate }}"
                                   value="{{ old('booking_date') }}"
                                   required>
                            <small class="help-text">Pilih tanggal untuk melihat slot waktu yang tersedia</small>
                        </div>
                        
                        <!-- Time Selection -->
                        <div class="form-group">
                            <label>Waktu Booking <span class="required">*</span></label>
                            <div class="time-selection">
                                <div class="time-input-group">
                                    <label for="time_from">Dari:</label>
                                    <input type="time" 
                                           id="time_from" 
                                           name="time_from" 
                                           class="form-control"
                                           min="{{ $room->available_from }}"
                                           max="{{ $room->available_until }}"
                                           value="{{ old('time_from') }}"
                                           required>
                                </div>
                                <div class="time-input-group">
                                    <label for="time_until">Sampai:</label>
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
                            <div id="availableSlots" class="available-slots" style="display: none;">
                                <p>Slot waktu yang tersedia:</p>
                                <div id="slotsContainer"></div>
                            </div>
                        </div>
                        
                        <!-- Contact Information -->
                        <div class="form-section">
                            <h4>
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12,4A4,4 0 0,1 16,8A4,4 0 0,1 12,12A4,4 0 0,1 8,8A4,4 0 0,1 12,4M12,14C16.42,14 20,15.79 20,18V20H4V18C4,15.79 7.58,14 12,14Z"/>
                                </svg>
                                Informasi Kontak
                            </h4>
                            
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
                        
                        <!-- Event Details -->
                        <div class="form-section">
                            <h4>
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M13,9H18.5L13,3.5V9M6,2H14L20,8V20A2,2 0 0,1 18,22H6C4.89,22 4,21.1 4,20V4C4,2.89 4.89,2 6,2M15,18V16H6V18H15M18,14V12H6V14H18Z"/>
                                </svg>
                                Detail Acara
                            </h4>
                            
                            <div class="form-group">
                                <label for="purpose">Tujuan Penggunaan <span class="required">*</span></label>
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
                                    <path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11zM7 10h5v5H7z"/>
                                </svg>
                                Submit Booking
                            </button>
                        </div>
                    </form>
                </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    const bookingDateInput = document.getElementById('booking_date');
    const timeFromInput = document.getElementById('time_from');
    const timeUntilInput = document.getElementById('time_until');
    const availableSlots = document.getElementById('availableSlots');
    
    // Load existing bookings when date changes
    bookingDateInput.addEventListener('change', function() {
        if (this.value) {
            loadExistingBookings(this.value);
            loadAvailableSlots(this.value);
        }
    });
    
    // Load existing bookings for selected date
    function loadExistingBookings(date) {
        const todayBookingsContainer = document.getElementById('todayBookings');
        todayBookingsContainer.innerHTML = `
            <div style="text-align: center; padding: 2rem 0;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" style="color: #6366f1; margin-bottom: 0.5rem;">
                    <path d="M12,4V2A10,10 0 0,0 2,12H4A8,8 0 0,1 12,4Z">
                        <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s" from="0 12 12" to="360 12 12" repeatCount="indefinite"/>
                    </path>
                </svg>
                <p class="loading-text">Memuat data booking...</p>
            </div>
        `;
        
        fetch(`/api/rooms/{{ $room->id }}/bookings?date=${date}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    displayExistingBookings(data.bookings, date);
                } else {
                    todayBookingsContainer.innerHTML = `
                        <div style="text-align: center; padding: 2rem 0;">
                            <svg width="48" height="48" viewBox="0 0 24 24" fill="currentColor" style="color: #10b981; margin-bottom: 1rem;">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                            </svg>
                            <p class="no-bookings">Tidak ada booking pada tanggal ini</p>
                            <small style="color: #6b7280;">Ruangan tersedia sepanjang hari</small>
                        </div>
                    `;
                }
            })
            .catch(error => {
                console.error('Error loading bookings:', error);
                todayBookingsContainer.innerHTML = `
                    <div style="text-align: center; padding: 2rem 0;">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="currentColor" style="color: #ef4444; margin-bottom: 1rem;">
                            <path d="M12,2C17.53,2 22,6.47 22,12C22,17.53 17.53,22 12,22C6.47,22 2,17.53 2,12C2,6.47 6.47,2 12,2M15.59,7L12,10.59L8.41,7L7,8.41L10.59,12L7,15.59L8.41,17L12,13.41L15.59,17L17,15.59L13.41,12L17,8.41L15.59,7Z"/>
                        </svg>
                        <p class="error-text">Gagal memuat data booking</p>
                        <small style="color: #6b7280;">Silakan coba lagi dalam beberapa saat</small>
                    </div>
                `;
            });
    }
    
    function displayExistingBookings(bookings, date) {
        const container = document.getElementById('todayBookings');
        
        if (bookings.length === 0) {
            container.innerHTML = `
                <div style="text-align: center; padding: 2rem 0;">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="currentColor" style="color: #10b981; margin-bottom: 1rem;">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                    </svg>
                    <p class="no-bookings">Tidak ada booking pada tanggal ini</p>
                    <small style="color: #6b7280;">Ruangan tersedia sepanjang hari</small>
                </div>
            `;
            return;
        }
        
        const dateFormatted = new Date(date).toLocaleDateString('id-ID', {
            weekday: 'long',
            day: 'numeric',
            month: 'long',
            year: 'numeric'
        });
        
        let html = `<h4 style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1.5rem;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" style="color: #6366f1;">
                <path d="M19,3H5C3.89,3 3,3.89 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V5C21,3.89 20.1,3 19,3M19,19H5V8H19V19M19,6H5V5H19V6Z"/>
            </svg>
            Booking untuk ${dateFormatted}:
        </h4>`;
        html += '<div class="booking-timeline">';
        
        bookings.forEach(booking => {
            const statusClass = booking.status === 'confirmed' ? 'confirmed' : 
                               booking.status === 'pending' ? 'pending' : 'cancelled';
            
            const statusIcon = booking.status === 'confirmed' ? 
                '<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>' :
                booking.status === 'pending' ? 
                '<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2M12,6A6,6 0 0,0 6,12A6,6 0 0,0 12,18A6,6 0 0,0 18,12A6,6 0 0,0 12,6M12,8A4,4 0 0,1 16,12A4,4 0 0,1 12,16A4,4 0 0,1 8,12A4,4 0 0,1 12,8Z"/></svg>' :
                '<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12,2C17.53,2 22,6.47 22,12C22,17.53 17.53,22 12,22C6.47,22 2,17.53 2,12C2,6.47 6.47,2 12,2M15.59,7L12,10.59L8.41,7L7,8.41L10.59,12L7,15.59L8.41,17L12,13.41L15.59,17L17,15.59L13.41,12L17,8.41L15.59,7Z"/></svg>';
            
            const statusText = booking.status === 'confirmed' ? 'Dikonfirmasi' :
                              booking.status === 'pending' ? 'Menunggu' : 'Dibatalkan';
            
            html += `
                <div class="booking-slot ${statusClass}">
                    <div class="booking-time">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" style="margin-right: 0.5rem;">
                            <path d="M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2M12.5,7V12.25L17,14.92L16.25,16.15L11,13V7H12.5Z"/>
                        </svg>
                        ${booking.start_time} - ${booking.end_time}
                    </div>
                    <div class="booking-info">
                        <strong>${booking.name}</strong>
                        <span class="booking-status status-${statusClass}">
                            ${statusIcon}
                            ${statusText}
                        </span>
                    </div>
                    ${booking.purpose ? `<div class="booking-purpose">${booking.purpose}</div>` : ''}
                </div>
            `;
        });
        
        html += '</div>';
        html += `<div class="booking-note">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" style="margin-right: 0.5rem; vertical-align: top;">
                <path d="M13,9H18.5L13,3.5V9M6,2H14L20,8V20A2,2 0 0,1 18,22H6C4.89,22 4,21.1 4,20V4C4,2.89 4.89,2 6,2M15,18V16H6V18H15M18,14V12H6V14H18Z"/>
            </svg>
            <strong>Catatan:</strong> Pastikan waktu booking Anda tidak bertabrakan dengan booking yang sudah ada.
        </div>`;
        
        container.innerHTML = html;
    }
    
    function loadAvailableSlots(date) {
        // This function would load available time slots based on existing bookings
        // For now, we'll just show time validation
        validateTimeInputs();
    }
    
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
        
        // Additional validation can be added here
        return true;
    });
    
    // Load today's bookings by default
    const today = new Date().toISOString().split('T')[0];
    if (bookingDateInput.value === today || !bookingDateInput.value) {
        loadExistingBookings(today);
    }
</script>
@endpush