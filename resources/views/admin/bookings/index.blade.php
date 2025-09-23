@extends('layouts.admin-booking')@extends('layouts.admin-booking')



@section('title', 'Kelola Booking - Admin Rumah BUMN')@section('title', 'Kelola Booking - Admin Rumah BUMN')

@section('description', 'Panel admin untuk mengelola booking ruangan')@section('description', 'Panel admin untuk mengelola booking ruangan')



@section('content')@section('content')

    <div class="container mx-auto px-4 py-8">        /* Admin Booking Styles */

        <!-- Tombol Kembali -->        .admin-stats-row {

        <div class="mb-6">            display: grid;

            <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg transition duration-200">            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));

                <i class="fas fa-arrow-left mr-2"></i>            gap: 1.5rem;

                Kembali ke Dashboard            margin-bottom: 2rem;

            </a>        }

        </div>

        .admin-stat-item {

        <div class="bg-white rounded-lg shadow-md p-6">            background: white;

            <div class="flex justify-between items-center mb-6">            padding: 1.5rem;

                <h2 class="text-2xl font-bold text-gray-800">Kelola Booking</h2>            border-radius: 12px;

            </div>            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);

            text-align: center;

            <!-- Stats Summary -->        }

            <div class="admin-stats-row">

                <div class="admin-stat-item">        .admin-stat-number {

                    <div class="admin-stat-number">{{ $bookings->total() }}</div>            font-size: 2rem;

                    <div class="admin-stat-label">Total Booking</div>            font-weight: 700;

                </div>            color: #1e293b;

                <div class="admin-stat-item">            margin-bottom: 0.5rem;

                    <div class="admin-stat-number pending">{{ $bookings->where('status', 'pending')->count() }}</div>        }

                    <div class="admin-stat-label">Pending</div>

                </div>        .admin-stat-number.pending {

                <div class="admin-stat-item">            color: #f59e0b;

                    <div class="admin-stat-number confirmed">{{ $bookings->where('status', 'confirmed')->count() }}</div>        }

                    <div class="admin-stat-label">Dikonfirmasi</div>

                </div>        .admin-stat-number.confirmed {

                <div class="admin-stat-item">            color: #10b981;

                    <div class="admin-stat-number cancelled">{{ $bookings->where('status', 'cancelled')->count() }}</div>        }

                    <div class="admin-stat-label">Dibatalkan</div>

                </div>        .admin-stat-number.cancelled {

            </div>            color: #ef4444;

        }

            <!-- Filter -->

            <div class="admin-filters">        .admin-stat-label {

                <form method="GET" action="{{ route('admin.bookings.index') }}" class="admin-filter-form">            color: #64748b;

                    <div class="admin-filter-group">            font-weight: 500;

                        <select name="status" class="admin-filter-select">            font-size: 0.875rem;

                            <option value="">Semua Status</option>        }

                            <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>

                            <option value="confirmed" {{ request('status') === 'confirmed' ? 'selected' : '' }}>Dikonfirmasi</option>        .admin-filters {

                            <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>            background: white;

                        </select>            padding: 1.5rem;

                    </div>            border-radius: 12px;

                    <div class="admin-filter-group">            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);

                        <input type="date" name="date" value="{{ request('date') }}" class="admin-filter-input" placeholder="Tanggal">            margin-bottom: 2rem;

                    </div>        }

                    <div class="admin-filter-group">

                        <input type="text" name="search" value="{{ request('search') }}" class="admin-filter-input" placeholder="Cari booking code atau nama...">        .admin-filter-form {

                    </div>            display: grid;

                    <button type="submit" class="admin-btn-filter">Filter</button>            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));

                    <a href="{{ route('admin.bookings.index') }}" class="admin-btn-reset">Reset</a>            gap: 1rem;

                </form>            align-items: end;

            </div>        }



            <!-- Bookings Table -->        .admin-filter-group {

            <div class="admin-table-container">            display: flex;

                <table class="admin-table">            flex-direction: column;

                    <thead>        }

                        <tr>

                            <th>Booking Code</th>        .admin-filter-select, .admin-filter-input {

                            <th>User</th>            padding: 0.75rem;

                            <th>Ruangan</th>            border: 2px solid #e5e7eb;

                            <th>Tanggal</th>            border-radius: 8px;

                            <th>Waktu</th>            font-size: 0.875rem;

                            <th>Durasi</th>            transition: border-color 0.2s;

                            <th>Status</th>        }

                            <th>Aksi</th>

                        </tr>        .admin-filter-select:focus, .admin-filter-input:focus {

                    </thead>            outline: none;

                    <tbody>            border-color: #3b82f6;

                        @forelse($bookings as $booking)            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);

                        <tr>        }

                            <td>        .admin-empty-content h3 {

                                <strong>{{ $booking->booking_code }}</strong>            font-size: 1.125rem;

                            </td>            font-weight: 600;

                            <td>            color: #374151;

                                <div class="admin-user-cell">            margin: 0;

                                    @if($booking->user)        }

                                        <strong>{{ $booking->user->name }}</strong>

                                        <span class="admin-user-email">{{ $booking->user->email }}</span>        .admin-empty-content p {

                                    @else            margin: 0;

                                        <strong>{{ $booking->contact_name }}</strong>            font-size: 0.875rem;

                                        <span class="admin-user-email">{{ $booking->contact_phone }}</span>        }

                                        @if($booking->contact_email)

                                            <span class="admin-user-email">{{ $booking->contact_email }}</span>        .admin-pagination {

                                        @endif            display: flex;

                                    @endif            justify-content: center;

                                </div>            margin-top: 2rem;

                            </td>        }

                            <td>

                                <div class="admin-room-cell">        /* Responsive */

                                    <strong>{{ $booking->room->name }}</strong>        @media (max-width: 768px) {

                                    <span class="admin-room-capacity">Kapasitas: {{ $booking->room->capacity }} orang</span>            .admin-filter-form {

                                </div>                grid-template-columns: 1fr;

                            </td>            }

                            <td>{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}</td>            

                            <td>{{ \Carbon\Carbon::parse($booking->time_from)->format('H:i') }} - {{ \Carbon\Carbon::parse($booking->time_until)->format('H:i') }}</td>            .admin-table-container {

                            <td>{{ $booking->duration_hours }} jam</td>                overflow-x: auto;

                            <td>            }

                                <span class="admin-status-badge status-{{ $booking->status }}">            

                                    @switch($booking->status)            .admin-table {

                                        @case('pending')                min-width: 800px;

                                            Menunggu Konfirmasi            }

                                            @break            

                                        @case('confirmed')            .admin-action-buttons {

                                            Dikonfirmasi                flex-direction: column;

                                            @break            }

                                        @case('cancelled')        }

                                            Dibatalkan

                                            @break        .admin-btn-filter, .admin-btn-reset {

                                        @default            padding: 0.75rem 1.5rem;

                                            {{ $booking->status }}            border-radius: 8px;

                                    @endswitch            font-weight: 600;

                                </span>            text-decoration: none;

                            </td>            display: inline-flex;

                            <td>            align-items: center;

                                <div class="admin-action-buttons">            justify-content: center;

                                    @if($booking->status === 'pending')            transition: all 0.2s;

                                        <form method="POST" action="{{ route('admin.bookings.confirm', $booking) }}" style="display: inline;">            border: none;

                                            @csrf            cursor: pointer;

                                            @method('PATCH')        }

                                            <button type="submit" class="admin-btn admin-btn-confirm" onclick="return confirm('Konfirmasi booking ini?')">

                                                <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">        .admin-btn-filter {

                                                    <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>            background: #3b82f6;

                                                </svg>            color: white;

                                                Konfirmasi        }

                                            </button>

                                        </form>        .admin-btn-filter:hover {

                                        <form method="POST" action="{{ route('admin.bookings.reject', $booking) }}" style="display: inline;">            background: #2563eb;

                                            @csrf        }

                                            @method('PATCH')

                                            <button type="submit" class="admin-btn admin-btn-reject" onclick="return confirm('Tolak booking ini?')">        .admin-btn-reset {

                                                <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">            background: #6b7280;

                                                    <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>            color: white;

                                                </svg>            margin-left: 0.5rem;

                                                Tolak        }

                                            </button>

                                        </form>        .admin-btn-reset:hover {

                                    @elseif($booking->status === 'confirmed')            background: #4b5563;

                                        <div class="admin-confirmed-actions">            text-decoration: none;

                                            <span class="admin-no-action">Dikonfirmasi</span>        }

                                            @if($booking->confirmation_pdf_path)

                                                <a href="{{ route('admin.bookings.download-pdf', $booking) }}" class="admin-btn admin-btn-download" target="_blank">        .admin-table-container {

                                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">            background: white;

                                                        <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z"/>            border-radius: 12px;

                                                    </svg>            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);

                                                    Download PDF            overflow: hidden;

                                                </a>            margin-bottom: 2rem;

                                            @endif        }

                                        </div>

                                    @else        .admin-table {

                                        <span class="admin-no-action">            width: 100%;

                                            {{ ucfirst($booking->status) }}            border-collapse: collapse;

                                        </span>        }

                                    @endif

                                </div>        .admin-table th {

                            </td>            background: #f8fafc;

                        </tr>            padding: 1rem;

                        @empty            text-align: left;

                        <tr>            font-weight: 600;

                            <td colspan="8" class="admin-empty-state">            color: #374151;

                                <div class="admin-empty-content">            border-bottom: 1px solid #e5e7eb;

                                    <svg width="48" height="48" viewBox="0 0 24 24" fill="currentColor">            font-size: 0.875rem;

                                        <path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2z"/>        }

                                    </svg>

                                    <h3>Belum Ada Booking</h3>        .admin-table td {

                                    <p>Tidak ada booking yang ditemukan dengan filter saat ini.</p>            padding: 1rem;

                                </div>            border-bottom: 1px solid #f1f5f9;

                            </td>            vertical-align: top;

                        </tr>        }

                        @endforelse

                    </tbody>        .admin-table tr:hover {

                </table>            background: #f8fafc;

            </div>        }



            <!-- Pagination -->        .admin-user-cell, .admin-room-cell {

            @if($bookings->hasPages())            display: flex;

            <div class="admin-pagination">            flex-direction: column;

                {{ $bookings->appends(request()->query())->links() }}            gap: 0.25rem;

            </div>        }

            @endif

        </div>        .admin-user-email, .admin-room-capacity {

    </div>            color: #6b7280;

@endsection            font-size: 0.8rem;

        }

@push('scripts')

<script>        .admin-status-badge {

    // Auto-refresh setiap 30 detik untuk status pending            display: inline-block;

    setTimeout(function() {            padding: 0.375rem 0.75rem;

        if (document.querySelector('.status-pending')) {            border-radius: 20px;

            location.reload();            font-size: 0.75rem;

        }            font-weight: 600;

    }, 30000);            text-transform: uppercase;

</script>            letter-spacing: 0.05em;

@endpush        }

        .admin-status-badge.status-pending {
            background: rgba(245, 158, 11, 0.1);
            color: #f59e0b;
        }

        .admin-status-badge.status-confirmed {
            background: rgba(16, 185, 129, 0.1);
            color: #10b981;
        }

        .admin-status-badge.status-cancelled {
            background: rgba(239, 68, 68, 0.1);
            color: #ef4444;
        }

        .admin-action-buttons {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .admin-btn {
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-weight: 500;
            font-size: 0.8rem;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
            transition: all 0.2s;
        }

        .admin-btn-confirm {
            background: #10b981;
            color: white;
        }

        .admin-btn-confirm:hover {
            background: #059669;
        }

        .admin-btn-reject {
            background: #ef4444;
            color: white;
        }

        .admin-btn-reject:hover {
            background: #dc2626;
        }

        .admin-btn-download {
            background: #3b82f6;
            color: white;
            text-decoration: none;
        }

        .admin-btn-download:hover {
            background: #2563eb;
            text-decoration: none;
        }

        .admin-confirmed-actions {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            align-items: flex-start;
        }

        .admin-no-action {
            color: #6b7280;
            font-style: italic;
            font-size: 0.875rem;
        }

        .admin-empty-state {
            text-align: center;
            padding: 3rem 1rem;
        }

        .admin-empty-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1rem;
            color: #6b7280;
        }

        .admin-empty-content svg {
            opacity: 0.5;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <!-- Tombol Kembali -->
        <div class="mb-6">
            <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg transition duration-200">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali ke Dashboard
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Kelola Booking</h2>
            </div>

            <!-- Stats Summary -->
            <div class="admin-stats-row">
                <div class="admin-stat-item">
                    <div class="admin-stat-number">{{ $bookings->total() }}</div>
                    <div class="admin-stat-label">Total Booking</div>
                </div>
                <div class="admin-stat-item">
                    <div class="admin-stat-number pending">{{ $bookings->where('status', 'pending')->count() }}</div>
                    <div class="admin-stat-label">Pending</div>
                </div>
                <div class="admin-stat-item">
                    <div class="admin-stat-number confirmed">{{ $bookings->where('status', 'confirmed')->count() }}</div>
                    <div class="admin-stat-label">Dikonfirmasi</div>
                </div>
                <div class="admin-stat-item">
                    <div class="admin-stat-number cancelled">{{ $bookings->where('status', 'cancelled')->count() }}</div>
                    <div class="admin-stat-label">Dibatalkan</div>
                </div>
            </div>

            <!-- Filter -->
            <div class="admin-filters">
                <form method="GET" action="{{ route('admin.bookings.index') }}" class="admin-filter-form">
                    <div class="admin-filter-group">
                        <select name="status" class="admin-filter-select">
                            <option value="">Semua Status</option>
                            <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ request('status') === 'confirmed' ? 'selected' : '' }}>Dikonfirmasi</option>
                            <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                        </select>
                    </div>
                    <div class="admin-filter-group">
                        <input type="date" name="date" value="{{ request('date') }}" class="admin-filter-input" placeholder="Tanggal">
                    </div>
                    <div class="admin-filter-group">
                        <input type="text" name="search" value="{{ request('search') }}" class="admin-filter-input" placeholder="Cari booking code atau nama...">
                    </div>
                    <button type="submit" class="admin-btn-filter">Filter</button>
                    <a href="{{ route('admin.bookings.index') }}" class="admin-btn-reset">Reset</a>
                </form>
            </div>

            <!-- Bookings Table -->
            <div class="admin-table-container">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Booking Code</th>
                            <th>User</th>
                            <th>Ruangan</th>
                            <th>Tanggal</th>
                            <th>Waktu</th>
                            <th>Durasi</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bookings as $booking)
                        <tr>
                            <td>
                                <strong>{{ $booking->booking_code }}</strong>
                            </td>
                            <td>
                                <div class="admin-user-cell">
                                    @if($booking->user)
                                        <strong>{{ $booking->user->name }}</strong>
                                        <span class="admin-user-email">{{ $booking->user->email }}</span>
                                    @else
                                        <strong>{{ $booking->contact_name }}</strong>
                                        <span class="admin-user-email">{{ $booking->contact_phone }}</span>
                                        @if($booking->contact_email)
                                            <span class="admin-user-email">{{ $booking->contact_email }}</span>
                                        @endif
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="admin-room-cell">
                                    <strong>{{ $booking->room->name }}</strong>
                                    <span class="admin-room-capacity">Kapasitas: {{ $booking->room->capacity }} orang</span>
                                </div>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($booking->time_from)->format('H:i') }} - {{ \Carbon\Carbon::parse($booking->time_until)->format('H:i') }}</td>
                            <td>{{ $booking->duration_hours }} jam</td>
                            <td>
                                <span class="admin-status-badge status-{{ $booking->status }}">
                                    @switch($booking->status)
                                        @case('pending')
                                            Menunggu Konfirmasi
                                            @break
                                        @case('confirmed')
                                            Dikonfirmasi
                                            @break
                                        @case('cancelled')
                                            Dibatalkan
                                            @break
                                        @default
                                            {{ $booking->status }}
                                    @endswitch
                                </span>
                            </td>
                            <td>
                                <div class="admin-action-buttons">
                                    @if($booking->status === 'pending')
                                        <form method="POST" action="{{ route('admin.bookings.confirm', $booking) }}" style="display: inline;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="admin-btn admin-btn-confirm" onclick="return confirm('Konfirmasi booking ini?')">
                                                <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                                                    <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                                                </svg>
                                                Konfirmasi
                                            </button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.bookings.reject', $booking) }}" style="display: inline;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="admin-btn admin-btn-reject" onclick="return confirm('Tolak booking ini?')">
                                                <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                                                    <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
                                                </svg>
                                                Tolak
                                            </button>
                                        </form>
                                    @elseif($booking->status === 'confirmed')
                                        <div class="admin-confirmed-actions">
                                            <span class="admin-no-action">Dikonfirmasi</span>
                                            @if($booking->confirmation_pdf_path)
                                                <a href="{{ route('admin.bookings.download-pdf', $booking) }}" class="admin-btn admin-btn-download" target="_blank">
                                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                                                        <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z"/>
                                                    </svg>
                                                    Download PDF
                                                </a>
                                            @endif
                                        </div>
                                    @else
                                        <span class="admin-no-action">
                                            {{ ucfirst($booking->status) }}
                                        </span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="admin-empty-state">
                                <div class="admin-empty-content">
                                    <svg width="48" height="48" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2z"/>
                                    </svg>
                                    <h3>Belum Ada Booking</h3>
                                    <p>Tidak ada booking yang ditemukan dengan filter saat ini.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($bookings->hasPages())
            <div class="admin-pagination">
                {{ $bookings->appends(request()->query())->links() }}
            </div>
            @endif
            </div>
        </div>
    </div>

    <script>
        // Auto-refresh setiap 30 detik untuk status pending
        setTimeout(function() {
            if (document.querySelector('.status-pending')) {
                location.reload();
            }
        }, 30000);
    </script>
</body>
</html>