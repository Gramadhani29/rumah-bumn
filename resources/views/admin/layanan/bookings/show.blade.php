@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center mb-6">
            <a href="{{ route('admin.rooms.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h2 class="text-2xl font-bold text-gray-800">Detail Ruangan: {{ $room->name }}</h2>
            <div class="ml-auto flex space-x-2">
                <a href="{{ route('admin.rooms.edit', $room) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition duration-200">
                    <i class="fas fa-edit mr-2"></i>Edit
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Informasi Ruangan -->
            <div class="lg:col-span-1">
                <div class="bg-gray-50 rounded-lg p-4">
                    @if($room->image)
                        <img src="{{ asset('storage/' . $room->image) }}" alt="{{ $room->name }}" class="w-full h-48 object-cover rounded-lg mb-4">
                    @else
                        <div class="w-full h-48 bg-gray-200 rounded-lg mb-4 flex items-center justify-center">
                            <i class="fas fa-image text-gray-400 text-4xl"></i>
                        </div>
                    @endif

                    <div class="space-y-3">
                        <div class="flex items-center">
                            <i class="fas fa-users text-gray-600 w-5"></i>
                            <span class="ml-2">{{ $room->capacity }} orang</span>
                        </div>
                        
                        @if($room->location)
                        <div class="flex items-center">
                            <i class="fas fa-map-marker-alt text-gray-600 w-5"></i>
                            <span class="ml-2">{{ $room->location }}</span>
                        </div>
                        @endif

                        <div class="flex items-center">
                            <i class="fas fa-clock text-gray-600 w-5"></i>
                            <span class="ml-2">{{ $room->available_from }} - {{ $room->available_until }}</span>
                        </div>

                        <div class="flex items-center">
                            <i class="fas fa-info-circle text-gray-600 w-5"></i>
                            <span class="ml-2">
                                @if($room->status === 'available')
                                    <span class="text-green-600">Tersedia</span>
                                @elseif($room->status === 'maintenance')
                                    <span class="text-yellow-600">Maintenance</span>
                                @else
                                    <span class="text-red-600">Tidak Tersedia</span>
                                @endif
                            </span>
                        </div>
                    </div>

                    @if($room->description)
                        <div class="mt-4">
                            <h4 class="font-semibold text-gray-800 mb-2">Deskripsi</h4>
                            <p class="text-gray-600 text-sm">{{ $room->description }}</p>
                        </div>
                    @endif

                    @if($room->facilities && count($room->facilities) > 0)
                        <div class="mt-4">
                            <h4 class="font-semibold text-gray-800 mb-2">Fasilitas</h4>
                            <div class="flex flex-wrap gap-2">
                                @php
                                $facilityLabels = [
                                    'wifi' => 'WiFi',
                                    'proyektor' => 'Proyektor',
                                    'ac' => 'AC',
                                    'whiteboard' => 'Whiteboard',
                                    'sound_system' => 'Sound System',
                                    'tv' => 'TV/Monitor',
                                    'flipchart' => 'Flipchart',
                                    'microphone' => 'Microphone',
                                    'printer' => 'Printer'
                                ];
                                @endphp
                                @foreach($room->facilities as $facility)
                                    <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">
                                        {{ $facilityLabels[$facility] ?? $facility }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Jadwal Booking -->
            <div class="lg:col-span-2">
                <div class="bg-gray-50 rounded-lg p-4">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Jadwal Booking Hari Ini</h3>
                    
                    @php
                    $today = now()->toDateString();
                    $todayBookings = $room->bookings()
                        ->whereDate('booking_date', $today)
                        ->where('status', '!=', 'cancelled')
                        ->orderBy('time_from')
                        ->get();
                    @endphp

                    @if($todayBookings->count() > 0)
                        <div class="space-y-3">
                            @foreach($todayBookings as $booking)
                                <div class="bg-white border-l-4 border-blue-500 p-3 rounded shadow-sm">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <div class="font-medium text-gray-800">{{ $booking->contact_name }}</div>
                                            <div class="text-sm text-gray-600">{{ $booking->contact_phone }}</div>
                                            <div class="text-sm text-gray-500 mt-1">
                                                {{ date('H:i', strtotime($booking->time_from)) }} - {{ date('H:i', strtotime($booking->time_until)) }}
                                            </div>
                                            @if($booking->purpose)
                                                <div class="text-sm text-gray-500 mt-1">{{ $booking->purpose }}</div>
                                            @endif
                                        </div>
                                        <span class="px-2 py-1 text-xs rounded-full
                                            @if($booking->status === 'confirmed') bg-green-100 text-green-800
                                            @elseif($booking->status === 'pending') bg-yellow-100 text-yellow-800
                                            @else bg-red-100 text-red-800
                                            @endif">
                                            {{ ucfirst($booking->status) }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8 text-gray-500">
                            <i class="fas fa-calendar-times text-4xl mb-2"></i>
                            <p>Tidak ada booking hari ini</p>
                        </div>
                    @endif
                </div>

                <!-- Statistik Booking -->
                <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="bg-blue-50 rounded-lg p-4">
                        <div class="flex items-center">
                            <div class="p-2 bg-blue-100 rounded-lg">
                                <i class="fas fa-calendar-check text-blue-600"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-600">Total Booking</p>
                                <p class="text-lg font-semibold text-gray-900">{{ $room->bookings()->count() }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-green-50 rounded-lg p-4">
                        <div class="flex items-center">
                            <div class="p-2 bg-green-100 rounded-lg">
                                <i class="fas fa-check-circle text-green-600"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-600">Booking Confirmed</p>
                                <p class="text-lg font-semibold text-gray-900">{{ $room->bookings()->where('status', 'confirmed')->count() }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-yellow-50 rounded-lg p-4">
                        <div class="flex items-center">
                            <div class="p-2 bg-yellow-100 rounded-lg">
                                <i class="fas fa-clock text-yellow-600"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-600">Booking Pending</p>
                                <p class="text-lg font-semibold text-gray-900">{{ $room->bookings()->where('status', 'pending')->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Booking Minggu Ini -->
                <div class="mt-6 bg-gray-50 rounded-lg p-4">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Booking Minggu Ini</h3>
                    
                    @php
                    $startOfWeek = now()->startOfWeek();
                    $endOfWeek = now()->endOfWeek();
                    $weekBookings = $room->bookings()
                        ->whereBetween('booking_date', [$startOfWeek, $endOfWeek])
                        ->where('status', '!=', 'cancelled')
                        ->orderBy('booking_date')
                        ->orderBy('time_from')
                        ->get()
                        ->groupBy('booking_date');
                    @endphp

                    @if($weekBookings->count() > 0)
                        <div class="space-y-4">
                            @foreach($weekBookings as $date => $bookings)
                                <div>
                                    <h4 class="font-medium text-gray-700 mb-2">
                                        {{ \Carbon\Carbon::parse($date)->format('l, d M Y') }}
                                        @if($date === $today)
                                            <span class="text-blue-600 text-sm">(Hari ini)</span>
                                        @endif
                                    </h4>
                                    <div class="space-y-2">
                                        @foreach($bookings as $booking)
                                            <div class="bg-white p-2 rounded border-l-2 border-gray-300 text-sm">
                                                <span class="font-medium">{{ $booking->contact_name }}</span> - 
                                                {{ date('H:i', strtotime($booking->time_from)) }} - {{ date('H:i', strtotime($booking->time_until)) }}
                                                <span class="ml-2 px-2 py-1 text-xs rounded
                                                    @if($booking->status === 'confirmed') bg-green-100 text-green-700
                                                    @elseif($booking->status === 'pending') bg-yellow-100 text-yellow-700
                                                    @else bg-red-100 text-red-700
                                                    @endif">
                                                    {{ ucfirst($booking->status) }}
                                                </span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8 text-gray-500">
                            <i class="fas fa-calendar-times text-4xl mb-2"></i>
                            <p>Tidak ada booking minggu ini</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection