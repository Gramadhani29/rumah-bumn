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
            $subtotal = $product->price * $quantity;
            
            $cartItems[] = [
                'id' => $product->id,
                'price' => (int) $product->price,
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
            
            // Create order record in database
            $order = Order::create([
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
            'message' => 'Terima kasih! Pembayaran Anda telah berhasil diproses.'
        ]);
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
        try {
            $notification = new Notification();
            
            $transactionStatus = $notification->transaction_status;
            $fraudStatus = $notification->fraud_status;
            $orderId = $notification->order_id;

            // Handle different payment status
            if ($transactionStatus == 'capture') {
                if ($fraudStatus == 'challenge') {
                    // Handle challenge transaction
                    $this->updateOrderStatus($orderId, 'challenge');
                } else if ($fraudStatus == 'accept') {
                    // Handle successful transaction
                    $this->updateOrderStatus($orderId, 'success');
                }
            } else if ($transactionStatus == 'settlement') {
                // Handle successful transaction
                $this->updateOrderStatus($orderId, 'success');
            } else if ($transactionStatus == 'pending') {
                // Handle pending transaction
                $this->updateOrderStatus($orderId, 'pending');
            } else if ($transactionStatus == 'deny') {
                // Handle denied transaction
                $this->updateOrderStatus($orderId, 'denied');
            } else if ($transactionStatus == 'expire') {
                // Handle expired transaction
                $this->updateOrderStatus($orderId, 'expired');
            } else if ($transactionStatus == 'cancel') {
                // Handle cancelled transaction
                $this->updateOrderStatus($orderId, 'cancelled');
            }

            return response()->json(['status' => 'ok']);
            
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    private function updateOrderStatus($orderId, $status)
    {
        try {
            $order = Order::where('order_id', $orderId)->first();
            
            if ($order) {
                $orderStatus = 'pending';
                $paymentStatus = 'pending';
                $paidAt = null;
                
                switch ($status) {
                    case 'success':
                        $orderStatus = 'paid';
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
                }
                
                $order->update([
                    'status' => $orderStatus,
                    'payment_status' => $paymentStatus,
                    'paid_at' => $paidAt
                ]);
                
                \Log::info("Order {$orderId} updated - Status: {$orderStatus}, Payment: {$paymentStatus}");
            } else {
                \Log::warning("Order {$orderId} not found in database");
            }
        } catch (\Exception $e) {
            \Log::error("Failed to update order {$orderId}: " . $e->getMessage());
        }
    }
}
