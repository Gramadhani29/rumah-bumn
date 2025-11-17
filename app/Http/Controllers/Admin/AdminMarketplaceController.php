<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Umkm;
use App\Models\Booking;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AdminMarketplaceController extends Controller
{
    // Dashboard marketplace
    public function index()
    {
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalUmkms = Umkm::count();
        $recentOrders = Order::latest()
            ->take(5)
            ->get();
        
        $recentProducts = Product::with('umkm')
            ->whereHas('umkm')
            ->latest()
            ->take(5)
            ->get();
            
        return view('admin.marketplace.index', compact(
            'totalProducts', 
            'totalOrders', 
            'totalUmkms',
            'recentOrders',
            'recentProducts'
        ));
    }
    
    // Kelola Pesanan
    public function orders(Request $request)
    {
        $query = Order::query();
            
        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        // Filter berdasarkan tanggal
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }
        
        // Search
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('customer_name', 'like', '%' . $request->search . '%')
                  ->orWhere('customer_email', 'like', '%' . $request->search . '%')
                  ->orWhere('order_id', 'like', '%' . $request->search . '%');
            });
        }
        
        $orders = $query->latest()->paginate(15);
        
        return view('admin.marketplace.orders', compact('orders'));
    }
    
    // Detail pesanan
    public function orderShow($id)
    {
        $order = Order::findOrFail($id);
        return view('admin.marketplace.order-detail', compact('order'));
    }
    
    // Update status pesanan
    public function updateOrderStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,paid,processing,shipped,delivered,cancelled'
        ]);
        
        $order = Order::findOrFail($id);
        $updateData = ['status' => $request->status];
        
        // Update timestamps based on status
        if ($request->status === 'shipped' && !$order->shipped_at) {
            $updateData['shipped_at'] = now();
        } elseif ($request->status === 'delivered' && !$order->delivered_at) {
            $updateData['delivered_at'] = now();
        }
        
        $order->update($updateData);
        
        return redirect()->back()->with('success', 'Status pesanan berhasil diupdate!');
    }
    
    // Kelola Produk
    public function products(Request $request)
    {
        $query = Product::with('umkm')
            ->whereHas('umkm');
        
        // Filter berdasarkan UMKM
        if ($request->filled('umkm_id')) {
            $query->where('umkm_id', $request->umkm_id);
        }
        
        // Filter berdasarkan kategori
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }
        
        // Filter berdasarkan status
        if ($request->filled('is_active')) {
            $query->where('is_active', $request->is_active);
        }
        
        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }
        
        $products = $query->latest()->paginate(12);
        $umkms = Umkm::where('is_active', true)->get();
        
        return view('admin.marketplace.products', compact('products', 'umkms'));
    }
    
    // Form tambah produk
    public function productCreate()
    {
        $umkms = Umkm::where('is_active', true)->get();
        $categories = ['fashion', 'makanan', 'kerajinan', 'elektronik', 'kesehatan', 'kecantikan'];
        
        return view('admin.marketplace.create-product', compact('umkms', 'categories'));
    }
    
    // Store produk baru
    public function productStore(Request $request)
    {
        $request->validate([
            'umkm_id' => 'required|exists:umkms,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'weight' => 'required|numeric|min:0',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'discount_percentage' => 'nullable|numeric|between:0,100',
            'discount_starts_at' => 'nullable|date',
            'discount_ends_at' => 'nullable|date|after:discount_starts_at'
        ]);
        
        $productData = $request->except(['images', 'specifications']);
        
        // Handle specifications
        if ($request->filled('spec_keys') && $request->filled('spec_values')) {
            $specKeys = $request->spec_keys;
            $specValues = $request->spec_values;
            $specifications = [];
            
            for ($i = 0; $i < count($specKeys); $i++) {
                if (!empty($specKeys[$i]) && !empty($specValues[$i])) {
                    $specifications[$specKeys[$i]] = $specValues[$i];
                }
            }
            $productData['specifications'] = $specifications;
        }
        
        // Generate slug
        $productData['slug'] = Str::slug($request->name);
        $productData['sku'] = 'PRD-' . strtoupper(Str::random(8));
        $productData['published_at'] = now();
        
        // Handle discount
        if ($request->filled('discount_percentage') && $request->discount_percentage > 0) {
            $productData['is_on_sale'] = true;
            $productData['discount_starts_at'] = $request->discount_starts_at ?? now();
            $productData['discount_ends_at'] = $request->discount_ends_at;
        }
        
        // Handle image uploads
        $imageNames = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $imageName = time() . '_' . $index . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/products'), $imageName);
                $imageNames[] = $imageName;
            }
            $productData['images'] = $imageNames;
            $productData['main_image'] = $imageNames[0] ?? null;
        }
        
        Product::create($productData);
        
        return redirect()->route('admin.marketplace.products')
                        ->with('success', 'Produk berhasil ditambahkan!');
    }
    
    // Edit produk
    public function productEdit($id)
    {
        $product = Product::findOrFail($id);
        $umkms = Umkm::where('is_active', true)->get();
        $categories = ['fashion', 'makanan', 'kerajinan', 'elektronik', 'kesehatan', 'kecantikan'];
        
        return view('admin.marketplace.edit-product', compact('product', 'umkms', 'categories'));
    }
    
    // Update produk
    public function productUpdate(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        
        $request->validate([
            'umkm_id' => 'required|exists:umkms,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'weight' => 'required|numeric|min:0',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'discount_percentage' => 'nullable|numeric|between:0,100',
            'discount_starts_at' => 'nullable|date',
            'discount_ends_at' => 'nullable|date|after:discount_starts_at'
        ]);
        
        $productData = $request->except(['images', 'specifications']);
        
        // Handle specifications
        if ($request->filled('spec_keys') && $request->filled('spec_values')) {
            $specKeys = $request->spec_keys;
            $specValues = $request->spec_values;
            $specifications = [];
            
            for ($i = 0; $i < count($specKeys); $i++) {
                if (!empty($specKeys[$i]) && !empty($specValues[$i])) {
                    $specifications[$specKeys[$i]] = $specValues[$i];
                }
            }
            $productData['specifications'] = $specifications;
        }
        
        // Update slug if name changed
        if ($request->name !== $product->name) {
            $productData['slug'] = Str::slug($request->name);
        }
        
        // Handle discount
        if ($request->filled('discount_percentage') && $request->discount_percentage > 0) {
            $productData['is_on_sale'] = true;
            $productData['discount_starts_at'] = $request->discount_starts_at ?? now();
            $productData['discount_ends_at'] = $request->discount_ends_at;
        } else {
            $productData['is_on_sale'] = false;
            $productData['discount_percentage'] = 0;
            $productData['discount_starts_at'] = null;
            $productData['discount_ends_at'] = null;
        }
        
        // Handle new image uploads
        if ($request->hasFile('images')) {
            // Delete old images
            if ($product->images && is_array($product->images)) {
                foreach ($product->images as $oldImage) {
                    if (file_exists(public_path('images/products/' . $oldImage))) {
                        unlink(public_path('images/products/' . $oldImage));
                    }
                }
            }
            
            // Upload new images
            $imageNames = [];
            foreach ($request->file('images') as $index => $image) {
                $imageName = time() . '_' . $index . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/products'), $imageName);
                $imageNames[] = $imageName;
            }
            $productData['images'] = $imageNames;
            $productData['main_image'] = $imageNames[0] ?? null;
        }
        
        $product->update($productData);
        
        return redirect()->route('admin.marketplace.products')
                        ->with('success', 'Produk berhasil diupdate!');
    }
    
    // Delete produk
    public function productDestroy($id)
    {
        $product = Product::findOrFail($id);
        
        // Delete images
        if ($product->images && is_array($product->images)) {
            foreach ($product->images as $image) {
                if (file_exists(public_path('images/products/' . $image))) {
                    unlink(public_path('images/products/' . $image));
                }
            }
        }
        
        $product->delete();
        
        return redirect()->route('admin.marketplace.products')
                        ->with('success', 'Produk berhasil dihapus!');
    }
    // Toggle product status
    public function toggleProductStatus($id)
    {
        $product = Product::findOrFail($id);
        $product->update(['is_active' => !$product->is_active]);
        
        $status = $product->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return redirect()->back()->with('success', "Produk berhasil {$status}!");
    }
}
