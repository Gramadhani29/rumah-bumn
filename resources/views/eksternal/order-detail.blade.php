@extends('layouts.public')

@section('title', 'Detail Pesanan - Rumah BUMN')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Detail Pesanan</h1>
                <p class="text-gray-600 mt-2">Order #{{ $order->order_id }}</p>
            </div>
            <a href="{{ route('eksternal.orders') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Order Details -->
        <div class="lg:col-span-2">
            <!-- Order Status -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Status Pesanan</h2>
                <div class="flex items-center space-x-4">
                    @if($order->status == 'pending')
                        <div class="flex-shrink-0 w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center">
                            <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">Menunggu Pembayaran</h3>
                            <p class="text-sm text-gray-600">Silakan selesaikan pembayaran Anda</p>
                        </div>
                    @elseif($order->status == 'processing')
                        <div class="flex-shrink-0 w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">Sedang Diproses</h3>
                            <p class="text-sm text-gray-600">Pesanan Anda sedang diproses oleh penjual</p>
                        </div>
                    @elseif($order->status == 'completed')
                        <div class="flex-shrink-0 w-16 h-16 bg-green-100 rounded-full flex items-center justify-center">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">Pesanan Selesai</h3>
                            <p class="text-sm text-gray-600">Terima kasih telah berbelanja!</p>
                        </div>
                    @else
                        <div class="flex-shrink-0 w-16 h-16 bg-red-100 rounded-full flex items-center justify-center">
                            <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">Pesanan Dibatalkan</h3>
                            <p class="text-sm text-gray-600">Pesanan telah dibatalkan</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Order Items -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Produk yang Dipesan</h2>
                <div class="space-y-4">
                    @php
                        // Gunakan relasi items() jika ada OrderItem, atau convert items array ke collection
                        $orderItems = $order->relationLoaded('items') && $order->items instanceof \Illuminate\Database\Eloquent\Collection 
                            ? $order->items 
                            : collect(is_array($order->items) ? $order->items : []);
                    @endphp
                    
                    @foreach($orderItems as $item)
                    <div class="flex items-center space-x-4 pb-4 border-b border-gray-200 last:border-b-0">
                        <div class="flex-shrink-0 w-20 h-20 bg-gray-100 rounded-lg overflow-hidden">
                            @if(is_object($item) && isset($item->product) && $item->product->image)
                                <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="flex-1">
                            @if(is_object($item) && isset($item->product))
                                <h3 class="font-semibold text-gray-800">{{ $item->product->name }}</h3>
                                <p class="text-sm text-gray-500">{{ $item->product->umkm->business_name ?? 'UMKM' }}</p>
                                <p class="text-sm text-gray-600 mt-1">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                            @elseif(is_array($item))
                                <h3 class="font-semibold text-gray-800">{{ $item['name'] ?? 'Produk' }}</h3>
                                <p class="text-sm text-gray-500">{{ $item['merchant_name'] ?? 'UMKM' }}</p>
                                <p class="text-sm text-gray-600 mt-1">{{ $item['quantity'] ?? 1 }} x Rp {{ number_format($item['price'] ?? 0, 0, ',', '.') }}</p>
                            @else
                                <h3 class="font-semibold text-gray-800">{{ $item->product_name ?? 'Produk' }}</h3>
                                <p class="text-sm text-gray-600 mt-1">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                            @endif
                        </div>
                        <div class="text-right">
                            @if(is_object($item))
                                <p class="font-semibold text-gray-800">Rp {{ number_format($item->subtotal ?? ($item->price * $item->quantity), 0, ',', '.') }}</p>
                            @elseif(is_array($item))
                                <p class="font-semibold text-gray-800">Rp {{ number_format(($item['price'] ?? 0) * ($item['quantity'] ?? 1), 0, ',', '.') }}</p>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-md p-6 sticky top-4">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Ringkasan Pesanan</h2>
                
                <div class="space-y-3 mb-4">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Order ID</span>
                        <span class="font-medium text-gray-800">{{ $order->order_id }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Tanggal Order</span>
                        <span class="font-medium text-gray-800">{{ $order->created_at->format('d M Y') }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Total Item</span>
                        <span class="font-medium text-gray-800">
                            @if($orderItems instanceof \Illuminate\Support\Collection)
                                {{ $orderItems->sum('quantity') }} produk
                            @else
                                {{ count($orderItems) }} produk
                            @endif
                        </span>
                    </div>
                </div>

                <div class="border-t border-gray-200 pt-4 mb-4">
                    <div class="flex justify-between text-sm mb-2">
                        <span class="text-gray-600">Subtotal</span>
                        <span class="text-gray-800">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-sm mb-2">
                        <span class="text-gray-600">Ongkir</span>
                        <span class="text-gray-800">Rp 0</span>
                    </div>
                </div>

                <div class="border-t border-gray-200 pt-4 mb-6">
                    <div class="flex justify-between">
                        <span class="text-lg font-bold text-gray-800">Total</span>
                        <span class="text-lg font-bold text-blue-600">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                    </div>
                </div>

                @if($order->status == 'pending')
                <button class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 rounded-lg transition">
                    Bayar Sekarang
                </button>
                @endif

                <div class="mt-4 p-4 bg-gray-50 rounded-lg">
                    <h3 class="font-semibold text-gray-800 mb-2">Informasi Pembeli</h3>
                    <p class="text-sm text-gray-600">{{ $order->customer_name ?? auth()->user()->name }}</p>
                    <p class="text-sm text-gray-600">{{ $order->customer_email ?? auth()->user()->email }}</p>
                    @if($order->customer_phone)
                    <p class="text-sm text-gray-600">{{ $order->customer_phone }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
