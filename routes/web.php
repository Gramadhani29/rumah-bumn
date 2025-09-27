<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProposalController;
use App\Models\News;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    // Jika user sudah login, redirect ke dashboard
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    
    // Gunakan query yang sama dengan halaman berita untuk konsistensi
    $featuredNews = News::published()
        ->with('author')
        ->featured()
        ->latest('published_at')
        ->first();
    
    // Jika ada featured news, ambil 4 regular news
    // Jika tidak ada featured news, ambil 5 regular news
    $takeCount = $featuredNews ? 4 : 5;
    
    $regularNews = News::published()
        ->with('author')
        ->where('is_featured', false)
        ->latest('published_at')
        ->take($takeCount)
        ->get();
    
    return view('welcome', compact('featuredNews', 'regularNews'));
});

// Route untuk halaman berita
Route::get('/berita', function (Request $request) {
    $query = News::published()->with('author');
    
    // Filter by category
    if ($request->filled('category') && $request->category !== 'all') {
        $query->where('category', $request->category);
    }
    
    // Search functionality
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('title', 'like', "%{$search}%")
              ->orWhere('excerpt', 'like', "%{$search}%")
              ->orWhere('content', 'like', "%{$search}%");
        });
    }
    
    $news = $query->orderBy('published_at', 'desc')->paginate(12);
    
    // Get statistics for header
    $totalNews = News::published()->count();
    $totalViews = News::published()->sum('views');
    
    return view('berita', compact('news'));
})->name('berita');

// Route untuk detail berita
Route::get('/berita/{slug}', function ($slug) {
    $news = News::published()->where('slug', $slug)->firstOrFail();
    
    // Increment views
    $news->increment('views');
    
    // Get random related news (exclude current article)
    $relatedNews = News::published()
        ->where('id', '!=', $news->id)
        ->inRandomOrder()
        ->take(4)
        ->get();
    
    return view('berita-detail', compact('news', 'relatedNews'));
})->name('berita.detail');

Route::get('/admin/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/admin', function () {
    return redirect()->route('dashboard');
})->middleware(['auth', 'verified'])->name('admin');

// API Routes for booking data
Route::get('/api/rooms/{room}/bookings', [BookingController::class, 'getBookingsByDate']);

// Admin Routes (protected by auth middleware)
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::resource('news', NewsController::class);
    Route::post('news/{news}/toggle-status', [NewsController::class, 'toggleStatus'])->name('news.toggle-status');
    Route::post('news/{news}/toggle-featured', [NewsController::class, 'toggleFeatured'])->name('news.toggle-featured');
    
    // Admin Room Management Routes
    Route::resource('rooms', RoomController::class);
    
    // Admin Booking Management Routes
    Route::get('bookings', [BookingController::class, 'adminIndex'])->name('bookings.index');
    Route::patch('bookings/{booking}/confirm', [BookingController::class, 'confirm'])->name('bookings.confirm');
    Route::patch('bookings/{booking}/reject', [BookingController::class, 'reject'])->name('bookings.reject');
    Route::get('bookings/{booking}/download-pdf', [BookingController::class, 'downloadPdf'])->name('bookings.download-pdf');
    
    // Admin Proposal Management Routes
    Route::get('proposals', [ProposalController::class, 'adminIndex'])->name('proposals.index');
    Route::get('proposals/{proposal}', [ProposalController::class, 'adminShow'])->name('proposals.show');
    Route::patch('proposals/{proposal}/approve', [ProposalController::class, 'approve'])->name('proposals.approve');
    Route::patch('proposals/{proposal}/reject', [ProposalController::class, 'reject'])->name('proposals.reject');
});

// Public Booking Routes
Route::prefix('booking')->name('booking.')->group(function () {
    Route::get('/', [BookingController::class, 'index'])->name('index');
    Route::get('rooms/{room}', [BookingController::class, 'create'])->name('create');
    Route::get('rooms/{room}/slots', [BookingController::class, 'getAvailableSlots'])->name('slots');
    Route::post('/', [BookingController::class, 'store'])->name('store'); // Remove auth middleware
    Route::get('{booking}', [BookingController::class, 'show'])->name('show'); // Remove auth middleware
    Route::get('{booking}/download-pdf', [BookingController::class, 'downloadPdf'])->name('download-pdf'); // New PDF route
    
    // Auth required routes
    Route::middleware('auth')->group(function () {
        Route::get('my-bookings', [BookingController::class, 'myBookings'])->name('my-bookings');
        Route::patch('{booking}/cancel', [BookingController::class, 'cancel'])->name('cancel');
    });
});

// Public Proposal Routes
Route::prefix('proposal')->name('proposal.')->group(function () {
    Route::get('create', [ProposalController::class, 'create'])->name('create');
    Route::post('/', [ProposalController::class, 'store'])->name('store');
    Route::get('{proposalCode}', [ProposalController::class, 'show'])->name('show');
    Route::get('{proposal}/download-file', [ProposalController::class, 'downloadFile'])->name('download-file');
    
    // Auth required routes
    Route::middleware('auth')->group(function () {
        Route::get('my-proposals', [ProposalController::class, 'myProposals'])->name('my-proposals');
        Route::patch('{proposal}/cancel', [ProposalController::class, 'cancel'])->name('cancel');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
