@extends('layouts.public')

@section('title', 'Riwayat Pesanan - Rumah BUMN')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Riwayat Pesanan</h1>
                <p class="text-gray-600 mt-2">Lihat semua pesanan Anda</p>
            </div>
            <a href="{{ route('eksternal.dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali
            </a>
        </div>
    </div>

    <!-- Orders List -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        @if($orders->count() > 0)
            @foreach($orders as $order)
            <div class="border-b border-gray-200 last:border-b-0 p-6 hover:bg-gray-50 transition">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center space-x-4">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">Order #{{ $order->order_number }}</h3>
                            <p class="text-sm text-gray-500">{{ $order->created_at->format('d F Y, H:i') }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        @if($order->status == 'pending')
                            <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                Menunggu Pembayaran
                            </span>
                        @elseif($order->status == 'processing')
                            <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                Sedang Diproses
                            </span>
                        @elseif($order->status == 'completed')
                            <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Selesai
                            </span>
                        @else
                            <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                Dibatalkan
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Order Items Preview -->
                <div class="space-y-2 mb-4">
                    @php
                        // Gunakan relasi items() jika ada OrderItem, atau convert items array ke collection
                        $orderItems = $order->relationLoaded('items') && $order->items instanceof \Illuminate\Database\Eloquent\Collection 
                            ? $order->items 
                            : collect(is_array($order->items) ? $order->items : []);
                        $itemsToShow = $orderItems->take(2);
                        $totalItems = $orderItems->count();
                    @endphp
                    
                    @foreach($itemsToShow as $item)
                    <div class="flex items-center text-sm text-gray-600">
                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                        @if(is_object($item) && isset($item->product))
                            {{ $item->product->name ?? 'Produk' }} ({{ $item->quantity }}x)
                        @elseif(is_array($item))
                            {{ $item['name'] ?? 'Produk' }} ({{ $item['quantity'] ?? 1 }}x)
                        @else
                            Produk (1x)
                        @endif
                    </div>
                    @endforeach
                    
                    @if($totalItems > 2)
                    <p class="text-sm text-gray-500 ml-6">+ {{ $totalItems - 2 }} produk lainnya</p>
                    @endif
                </div>

                <div class="flex items-center justify-between">
                    <div class="text-lg font-bold text-gray-800">
                        Total: Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                    </div>
                    <a href="{{ route('eksternal.order.detail', $order->id) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition">
                        Lihat Detail
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
            @endforeach

            <!-- Pagination -->
            <div class="p-6 border-t border-gray-200">
                {{ $orders->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
                <h3 class="mt-4 text-lg font-medium text-gray-900">Belum ada pesanan</h3>
                <p class="mt-2 text-sm text-gray-500">Mulai berbelanja produk UMKM sekarang!</p>
                <div class="mt-6">
                    <a href="{{ route('toko.index') }}" class="inline-flex items-center px-6 py-3 border border-transparent shadow-sm text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                        <svg class="-ml-1 mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        Belanja Sekarang
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
