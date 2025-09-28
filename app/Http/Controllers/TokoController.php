<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Umkm;
use Illuminate\Http\Request;

class TokoController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('umkm')
            ->active()
            ->published()
            ->latest('published_at');

        // Filter berdasarkan kategori
        if ($request->filled('category') && $request->category !== 'all') {
            $query->category($request->category);
        }

        // Pencarian
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        // Pagination
        $products = $query->paginate(12);

        // Data untuk filter
        $categories = [
            'all' => 'Semua Produk',
            'fashion' => 'Fashion',
            'makanan' => 'Makanan', 
            'minuman' => 'Minuman',
            'kerajinan' => 'Kerajinan',
            'elektronik' => 'Elektronik',
            'lainnya' => 'Lainnya'
        ];

        return view('toko.index', compact('products', 'categories'));
    }

    public function show($id)
    {
        $product = Product::with('umkm')
            ->active()
            ->published()
            ->findOrFail($id);

        // Increment views
        $product->incrementViews();

        // Produk terkait dari UMKM yang sama
        $relatedProducts = Product::with('umkm')
            ->active()
            ->published()
            ->where('umkm_id', $product->umkm_id)
            ->where('id', '!=', $product->id)
            ->limit(4)
            ->get();

        return view('toko.show', compact('product', 'relatedProducts'));
    }

    public function cart(Request $request)
    {
        // Ambil data cart dari session
        $cart = session()->get('cart', []);
        $cartItems = [];
        $total = 0;

        if (!empty($cart)) {
            $productIds = array_keys($cart);
            $products = Product::with('umkm')->whereIn('id', $productIds)->get();

            foreach ($products as $product) {
                $quantity = $cart[$product->id];
                $subtotal = $product->price * $quantity;
                
                $cartItems[] = [
                    'product' => $product,
                    'quantity' => $quantity,
                    'subtotal' => $subtotal
                ];
                
                $total += $subtotal;
            }
        }

        // If AJAX request, return JSON
        if ($request->ajax() || $request->has('ajax')) {
            return response()->json([
                'cartItems' => $cartItems,
                'total' => $total,
                'cart_count' => array_sum($cart)
            ]);
        }

        return view('toko.cart', compact('cartItems', 'total'));
    }

    public function addToCart(Request $request)
    {
        // Log incoming request for debugging
        \Log::info('Add to cart request', [
            'data' => $request->all(),
            'headers' => $request->headers->all()
        ]);

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $product = Product::findOrFail($request->product_id);

        // Check stock
        if ($product->stock < $request->quantity) {
            return response()->json([
                'success' => false,
                'message' => 'Stok tidak mencukupi'
            ]);
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $newQuantity = $cart[$product->id] + $request->quantity;
            if ($newQuantity > $product->stock) {
                return response()->json([
                    'success' => false,
                    'message' => 'Total quantity melebihi stok yang tersedia'
                ]);
            }
            $cart[$product->id] = $newQuantity;
        } else {
            $cart[$product->id] = $request->quantity;
        }

        session()->put('cart', $cart);

        // Hitung total item di cart
        $cartCount = array_sum($cart);

        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil ditambahkan ke keranjang',
            'cart_count' => $cartCount
        ]);
    }

    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
            
            // Calculate remaining cart count
            $cartCount = array_sum($cart);
            
            return response()->json([
                'success' => true,
                'message' => 'Produk berhasil dihapus dari keranjang',
                'cart_count' => $cartCount
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Produk tidak ditemukan di keranjang'
        ], 404);
    }

    public function updateCartQuantity(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'change' => 'required|integer'
        ]);

        $product = Product::findOrFail($request->product_id);
        $cart = session()->get('cart', []);

        if (!isset($cart[$product->id])) {
            return response()->json([
                'success' => false,
                'message' => 'Produk tidak ditemukan di keranjang'
            ], 404);
        }

        $currentQuantity = $cart[$product->id];
        $newQuantity = $currentQuantity + $request->change;

        // Check minimum quantity (at least 1)
        if ($newQuantity < 1) {
            // If quantity becomes 0 or less, remove the item
            unset($cart[$product->id]);
            session()->put('cart', $cart);
            
            $cartCount = array_sum($cart);
            
            return response()->json([
                'success' => true,
                'message' => 'Produk dihapus dari keranjang',
                'cart_count' => $cartCount
            ]);
        }

        // Check stock availability
        if ($newQuantity > $product->stock) {
            return response()->json([
                'success' => false,
                'message' => 'Quantity melebihi stok yang tersedia (' . $product->stock . ' unit)'
            ]);
        }

        // Update quantity
        $cart[$product->id] = $newQuantity;
        session()->put('cart', $cart);

        $cartCount = array_sum($cart);

        return response()->json([
            'success' => true,
            'message' => $request->change > 0 ? 'Quantity berhasil ditambah' : 'Quantity berhasil dikurangi',
            'cart_count' => $cartCount,
            'new_quantity' => $newQuantity
        ]);
    }

    public function clearCart()
    {
        session()->forget('cart');
        
        return response()->json([
            'success' => true,
            'message' => 'Keranjang berhasil dikosongkan'
        ]);
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('toko.cart')->with('error', 'Keranjang kosong');
        }

        $cartItems = [];
        $total = 0;

        $productIds = array_keys($cart);
        $products = Product::with('umkm')->whereIn('id', $productIds)->get();

        foreach ($products as $product) {
            $quantity = $cart[$product->id];
            $subtotal = $product->price * $quantity;
            
            $cartItems[] = [
                'product' => $product,
                'quantity' => $quantity,
                'subtotal' => $subtotal
            ];
            
            $total += $subtotal;
        }

        return view('toko.checkout', compact('cartItems', 'total'));
    }

    // Method yang sudah ada sebelumnya untuk data dummy
    private function getDummyProducts()
    {
        // Data produk dummy untuk tampilan awal
        $products = [
            [
                'id' => 1,
                'name' => 'Batik Pekalongan Premium',
                'price' => 150000,
                'image' => 'images/products/batik1.jpg',
                'category' => 'Fashion',
                'description' => 'Batik khas Pekalongan dengan motif tradisional yang elegan',
                'stock' => 25,
                'umkm_name' => 'Batik Sari Indah'
            ],
            [
                'id' => 2,
                'name' => 'Kemeja Batik Modern',
                'price' => 120000,
                'image' => 'images/products/batik2.jpg',
                'category' => 'Fashion',
                'description' => 'Kemeja batik dengan desain modern untuk segala acara',
                'stock' => 15,
                'umkm_name' => 'Batik Nusantara'
            ],
            [
                'id' => 3,
                'name' => 'Keripik Tempe Renyah',
                'price' => 25000,
                'image' => 'images/products/keripik1.jpg',
                'category' => 'Makanan',
                'description' => 'Keripik tempe renyah dengan bumbu rahasia yang gurih',
                'stock' => 50,
                'umkm_name' => 'Snack Barokah'
            ],
            [
                'id' => 4,
                'name' => 'Kopi Robusta Pekalongan',
                'price' => 45000,
                'image' => 'images/products/kopi1.jpg',
                'category' => 'Minuman',
                'description' => 'Kopi robusta pilihan dari petani lokal Pekalongan',
                'stock' => 30,
                'umkm_name' => 'Kopi Bumi'
            ],
            [
                'id' => 5,
                'name' => 'Tas Rajut Cantik',
                'price' => 85000,
                'image' => 'images/products/tas1.jpg',
                'category' => 'Fashion',
                'description' => 'Tas rajut handmade dengan kualitas premium',
                'stock' => 20,
                'umkm_name' => 'Rajut Kreatif'
            ],
            [
                'id' => 6,
                'name' => 'Sambal Pecel Pedas',
                'price' => 15000,
                'image' => 'images/products/sambal1.jpg',
                'category' => 'Makanan',
                'description' => 'Sambal pecel dengan resep turun temurun yang autentik',
                'stock' => 40,
                'umkm_name' => 'Dapur Ibu'
            ],
            [
                'id' => 7,
                'name' => 'Teh Herbal Sehat',
                'price' => 35000,
                'image' => 'images/products/teh1.jpg',
                'category' => 'Minuman',
                'description' => 'Teh herbal alami untuk kesehatan tubuh',
                'stock' => 35,
                'umkm_name' => 'Herbal Nusantara'
            ],
            [
                'id' => 8,
                'name' => 'Dompet Kulit Asli',
                'price' => 75000,
                'image' => 'images/products/dompet1.jpg',
                'category' => 'Fashion',
                'description' => 'Dompet kulit asli dengan desain minimalis dan elegan',
                'stock' => 18,
                'umkm_name' => 'Leather Craft'
            ]
        ];

        return $this->getDummyProducts();
    }
}