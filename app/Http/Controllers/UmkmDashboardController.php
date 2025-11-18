<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\Umkm;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class UmkmDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        // Get or create UMKM profile for this user
        $umkm = Umkm::firstOrCreate(
            ['user_id' => $user->id],
            [
                'business_name' => $user->business_name ?? $user->name,
                'slug' => Str::slug($user->business_name ?? $user->name),
                'is_active' => true
            ]
        );
        
        // Get products statistics
        $totalProducts = Product::where('umkm_id', $umkm->id)->count();
        $activeProducts = Product::where('umkm_id', $umkm->id)->active()->count();
        
        // Get orders statistics (from order items)
        $totalSold = DB::table('order_items')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->where('products.umkm_id', $umkm->id)
            ->sum('order_items.quantity');
            
        $totalRevenue = DB::table('order_items')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('products.umkm_id', $umkm->id)
            ->where('orders.status', 'completed')
            ->sum('order_items.subtotal');
        
        // Get recent products
        $recentProducts = Product::where('umkm_id', $umkm->id)
            ->latest()
            ->take(5)
            ->get();
        
        // Get sales chart data (last 7 days)
        $salesData = DB::table('order_items')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('products.umkm_id', $umkm->id)
            ->where('orders.created_at', '>=', now()->subDays(7))
            ->select(
                DB::raw('DATE(orders.created_at) as date'),
                DB::raw('SUM(order_items.subtotal) as total')
            )
            ->groupBy('date')
            ->orderBy('date')
            ->get();
        
        return view('umkm.dashboard', compact(
            'user',
            'umkm',
            'totalProducts',
            'activeProducts',
            'totalSold',
            'totalRevenue',
            'recentProducts',
            'salesData'
        ));
    }
    
    public function products()
    {
        $user = auth()->user();
        $umkm = Umkm::where('user_id', $user->id)->firstOrFail();
        
        $products = Product::where('umkm_id', $umkm->id)
            ->latest()
            ->paginate(15);
        
        return view('umkm.products.index', compact('products'));
    }
    
    public function createProduct()
    {
        return view('umkm.products.create');
    }
    
    public function storeProduct(Request $request)
    {
        $user = auth()->user();
        $umkm = Umkm::where('user_id', $user->id)->firstOrFail();
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048'
        ]);
        
        $validated['umkm_id'] = $umkm->id;
        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_active'] = true;
        $validated['published_at'] = now();
        
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $validated['main_image'] = basename($path);
        }
        
        Product::create($validated);
        
        return redirect()->route('umkm.products')->with('success', 'Produk berhasil ditambahkan!');
    }
    
    public function editProduct($id)
    {
        $user = auth()->user();
        $umkm = Umkm::where('user_id', $user->id)->firstOrFail();
        
        $product = Product::where('umkm_id', $umkm->id)->findOrFail($id);
        
        return view('umkm.products.edit', compact('product'));
    }
    
    public function updateProduct(Request $request, $id)
    {
        $user = auth()->user();
        $umkm = Umkm::where('user_id', $user->id)->firstOrFail();
        
        $product = Product::where('umkm_id', $umkm->id)->findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048'
        ]);
        
        $validated['slug'] = Str::slug($validated['name']);
        
        if ($request->hasFile('image')) {
            // Delete old image
            if ($product->main_image) {
                Storage::disk('public')->delete('products/' . $product->main_image);
            }
            
            $path = $request->file('image')->store('products', 'public');
            $validated['main_image'] = basename($path);
        }
        
        $product->update($validated);
        
        return redirect()->route('umkm.products')->with('success', 'Produk berhasil diperbarui!');
    }
    
    public function destroyProduct($id)
    {
        $user = auth()->user();
        $umkm = Umkm::where('user_id', $user->id)->firstOrFail();
        
        $product = Product::where('umkm_id', $umkm->id)->findOrFail($id);
        
        // Delete image
        if ($product->main_image) {
            Storage::disk('public')->delete('products/' . $product->main_image);
        }
        
        $product->delete();
        
        return redirect()->route('umkm.products')->with('success', 'Produk berhasil dihapus!');
    }
    
    public function toggleProductStatus($id)
    {
        $user = auth()->user();
        $umkm = Umkm::where('user_id', $user->id)->firstOrFail();
        
        $product = Product::where('umkm_id', $umkm->id)->findOrFail($id);
        $product->is_active = !$product->is_active;
        $product->save();
        
        $status = $product->is_active ? 'aktif' : 'nonaktif';
        
        return response()->json([
            'success' => true,
            'message' => "Produk berhasil diubah menjadi {$status}",
            'is_active' => $product->is_active
        ]);
    }
}
