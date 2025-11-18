<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Product;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;
use App\Models\Order;

class PaymentController extends Controller
{
    public function __construct()
    {
        // Set Midtrans configuration
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.environment') === 'production';
        Config::$isSanitized = config('services.midtrans.sanitized');
        Config::$is3ds = config('services.midtrans.enable_3ds');
    }

    public function createTransaction(Request $request)
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return response()->json(['error' => 'Keranjang kosong'], 400);
        }

        // Get cart items with product details
        $cartItems = [];
        $totalAmount = 0;

        $productIds = array_keys($cart);
        $products = Product::with('umkm')->whereIn('id', $productIds)->get();

        foreach ($products as $product) {
            $quantity = $cart[$product->id];
            
            // Gunakan harga diskon jika sedang ada diskon aktif
            $finalPrice = $product->is_discount_active ? $product->discounted_price : $product->price;
            $subtotal = $finalPrice * $quantity;
            
            $cartItems[] = [
                'id' => $product->id,
                'price' => (int) $finalPrice, // Gunakan harga setelah diskon
                'quantity' => $quantity,
                'name' => $product->name,
                'merchant_name' => $product->umkm->name
            ];
            
            $totalAmount += $subtotal;
        }

        // Validate customer information
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'postal_code' => 'required|string'
        ]);

        // Generate unique order ID
        $orderId = 'RUMAH-BUMN-' . time() . '-' . Str::random(4);

        $transactionDetails = [
            'order_id' => $orderId,
            'gross_amount' => (int) $totalAmount
        ];

        $customerDetails = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'billing_address' => [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'address' => $request->address,
                'city' => $request->city,
                'postal_code' => $request->postal_code,
                'phone' => $request->phone,
                'country_code' => 'IDN'
            ]
        ];

        $enabledPayments = [
            'gopay', 'shopeepay', 'qris', 'bank_transfer', 'echannel', 
            'permata_va', 'bca_va', 'bni_va', 'bri_va', 'other_va',
            'credit_card', 'cimb_va', 'danamon_va'
        ];

        $transactionData = [
            'transaction_details' => $transactionDetails,
            'customer_details' => $customerDetails,
            'item_details' => $cartItems,
            'enabled_payments' => $enabledPayments,
            'callbacks' => [
                'finish' => route('payment.finish'),
                'unfinish' => route('payment.unfinish'),
                'error' => route('payment.error')
            ]
        ];

        try {
            $snapToken = Snap::getSnapToken($transactionData);
            
            // Create order record in database with user_id
            $order = Order::create([
                'user_id' => auth()->id(), // Simpan user_id agar muncul di riwayat
                'order_id' => $orderId,
                'customer_name' => $request->first_name . ' ' . $request->last_name,
                'customer_email' => $request->email,
                'customer_phone' => $request->phone,
                'customer_address' => $request->address,
                'customer_city' => $request->city,
                'customer_postal_code' => $request->postal_code,
                'total_amount' => $totalAmount,
                'status' => 'pending',
                'payment_status' => 'pending',
                'payment_method' => 'midtrans',
                'items' => $cartItems
            ]);
            
            // Create OrderItem records untuk relasi yang benar
            foreach ($cartItems as $item) {
                \App\Models\OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['id'],
                    'product_name' => $item['name'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'subtotal' => $item['price'] * $item['quantity']
                ]);
            }

            return response()->json([
                'success' => true,
                'snap_token' => $snapToken,
                'order_id' => $orderId
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal membuat transaksi: ' . $e->getMessage()
            ], 500);
        }
    }

    public function paymentFinish(Request $request)
    {
        // Clear cart after successful payment
        session()->forget('cart');

        return view('payment.finish')->with([
            'title' => 'Pembayaran Berhasil',
            'message' => 'Terima kasih! Pembayaran Anda telah berhasil diproses.',
            'order_id' => $request->order_id
        ]);
    }
    
    /**
     * Manual update status untuk testing di localhost
     * HAPUS METHOD INI DI PRODUCTION!
     */
    public function manualSuccess($orderId)
    {
        $order = Order::where('order_id', $orderId)->first();
        
        if (!$order) {
            return redirect()->route('eksternal.dashboard')
                ->with('error', 'Order tidak ditemukan');
        }
        
        // Simulasi notification success dari Midtrans
        $this->updateOrderStatus($orderId, 'success', 'credit_card');
        
        return redirect()->route('eksternal.orders')
            ->with('success', 'Status pembayaran berhasil diupdate menjadi Success!');
    }

    public function paymentUnfinish(Request $request)
    {
        return view('payment.unfinish')->with([
            'title' => 'Pembayaran Belum Selesai',
            'message' => 'Pembayaran Anda belum selesai. Silakan coba lagi.'
        ]);
    }

    public function paymentError(Request $request)
    {
        return view('payment.error')->with([
            'title' => 'Pembayaran Gagal',
            'message' => 'Terjadi kesalahan dalam proses pembayaran. Silakan coba lagi.'
        ]);
    }

    public function handleNotification(Request $request)
    {
        // Log raw request untuk debugging
        \Log::info('Midtrans Notification Raw Request', [
            'method' => $request->method(),
            'all_data' => $request->all(),
            'headers' => $request->headers->all()
        ]);
        
        try {
            // Try using Midtrans Notification class
            $notification = new Notification();
            
            $transactionStatus = $notification->transaction_status;
            $fraudStatus = $notification->fraud_status ?? null;
            $orderId = $notification->order_id;
            $paymentType = $notification->payment_type ?? null;
            
        } catch (\Exception $e) {
            // Fallback: Parse request manually if Notification class fails
            \Log::warning('Midtrans Notification class failed, using manual parsing', [
                'error' => $e->getMessage()
            ]);
            
            $transactionStatus = $request->transaction_status;
            $fraudStatus = $request->fraud_status ?? null;
            $orderId = $request->order_id;
            $paymentType = $request->payment_type ?? null;
        }
        
        try {
            \Log::info('Midtrans Notification Received', [
                'order_id' => $orderId,
                'transaction_status' => $transactionStatus,
                'fraud_status' => $fraudStatus,
                'payment_type' => $paymentType,
                'gross_amount' => $request->gross_amount ?? null
            ]);

            // Handle different payment status
            if ($transactionStatus == 'capture') {
                if ($fraudStatus == 'challenge') {
                    $this->updateOrderStatus($orderId, 'challenge', $paymentType);
                } else if ($fraudStatus == 'accept') {
                    $this->updateOrderStatus($orderId, 'success', $paymentType);
                }
            } else if ($transactionStatus == 'settlement') {
                $this->updateOrderStatus($orderId, 'success', $paymentType);
            } else if ($transactionStatus == 'pending') {
                $this->updateOrderStatus($orderId, 'pending', $paymentType);
            } else if ($transactionStatus == 'deny') {
                $this->updateOrderStatus($orderId, 'denied', $paymentType);
            } else if ($transactionStatus == 'expire') {
                $this->updateOrderStatus($orderId, 'expired', $paymentType);
            } else if ($transactionStatus == 'cancel') {
                $this->updateOrderStatus($orderId, 'cancelled', $paymentType);
            }

            return response()->json(['status' => 'ok']);
            
        } catch (\Exception $e) {
            \Log::error('Midtrans Notification Error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    private function updateOrderStatus($orderId, $status, $paymentType = null)
    {
        try {
            $order = Order::where('order_id', $orderId)->first();
            
            if ($order) {
                $orderStatus = 'pending';
                $paymentStatus = 'pending';
                $paidAt = null;
                
                switch ($status) {
                    case 'success':
                        $orderStatus = 'processing'; // Status order berubah ke processing setelah dibayar
                        $paymentStatus = 'paid';
                        $paidAt = now();
                        break;
                    case 'pending':
                        $orderStatus = 'pending';
                        $paymentStatus = 'pending';
                        break;
                    case 'denied':
                    case 'cancelled':
                    case 'expired':
                        $orderStatus = 'cancelled';
                        $paymentStatus = 'failed';
                        break;
                    case 'challenge':
                        $orderStatus = 'pending';
                        $paymentStatus = 'challenge';
                        break;
                }
                
                $updateData = [
                    'status' => $orderStatus,
                    'payment_status' => $paymentStatus,
                    'paid_at' => $paidAt
                ];
                
                // Tambahkan midtrans_transaction_id jika ada
                if ($paymentType) {
                    $updateData['payment_method'] = $paymentType;
                }
                
                $order->update($updateData);
                
                \Log::info("Order {$orderId} updated successfully", [
                    'status' => $orderStatus,
                    'payment_status' => $paymentStatus,
                    'payment_type' => $paymentType,
                    'user_id' => $order->user_id
                ]);
            } else {
                \Log::warning("Order {$orderId} not found in database");
            }
        } catch (\Exception $e) {
            \Log::error("Failed to update order {$orderId}: " . $e->getMessage());
        }
    }
}
