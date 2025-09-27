<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Booking;
use App\Models\Room;
use App\Models\Proposal;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index(): View
    {
        // Statistik berita
        $totalNews = News::count();
        $publishedNews = News::where('status', 'published')->count();
        $draftNews = News::where('status', 'draft')->count();
        
        // Hitung persentase perubahan berita dari bulan lalu
        $lastMonthNews = News::where('created_at', '>=', Carbon::now()->subMonth()->startOfMonth())
            ->where('created_at', '<', Carbon::now()->startOfMonth())
            ->count();
        $currentMonthNews = News::where('created_at', '>=', Carbon::now()->startOfMonth())->count();
        $newsChangePercent = $lastMonthNews > 0 ? (($currentMonthNews - $lastMonthNews) / $lastMonthNews) * 100 : 0;
        
        // Total kunjungan website (simulasi - dalam implementasi nyata bisa menggunakan Google Analytics API atau tabel tracking)
        $totalVisitors = $this->getTotalVisitors();
        $lastMonthVisitors = $this->getLastMonthVisitors();
        $visitorsChangePercent = $lastMonthVisitors > 0 ? (($totalVisitors - $lastMonthVisitors) / $lastMonthVisitors) * 100 : 0;
        
        // Statistik booking
        $totalBookings = Booking::count();
        $pendingBookings = Booking::where('bookings.status', 'pending')->count();
        $confirmedBookings = Booking::where('bookings.status', 'confirmed')->count();
        $cancelledBookings = Booking::where('bookings.status', 'cancelled')->count();
        
        // Booking bulan ini vs bulan lalu
        $thisMonthBookings = Booking::where('created_at', '>=', Carbon::now()->startOfMonth())->count();
        $lastMonthBookingsCount = Booking::where('created_at', '>=', Carbon::now()->subMonth()->startOfMonth())
            ->where('created_at', '<', Carbon::now()->startOfMonth())
            ->count();
        $bookingsChangePercent = $lastMonthBookingsCount > 0 ? (($thisMonthBookings - $lastMonthBookingsCount) / $lastMonthBookingsCount) * 100 : 0;
        
        // Room paling populer
        $popularRoom = Room::withCount('bookings')
            ->orderBy('bookings_count', 'desc')
            ->first();
        
        // Statistik proposal
        $totalProposals = Proposal::count();
        $pendingProposals = Proposal::where('status', 'pending')->count();
        $approvedProposals = Proposal::where('status', 'approved')->count();
        $rejectedProposals = Proposal::where('status', 'rejected')->count();
        
        $stats = [
            'total_visitors' => $totalVisitors,
            'visitors_change_percent' => $visitorsChangePercent,
            'total_articles' => $totalNews,
            'published_articles' => $publishedNews,
            'draft_articles' => $draftNews,
            'news_change_percent' => $newsChangePercent,
            'total_rooms' => Room::count(),
            'total_bookings' => $totalBookings,
            'pending_bookings' => $pendingBookings,
            'confirmed_bookings' => $confirmedBookings,
            'cancelled_bookings' => $cancelledBookings,
            'bookings_change_percent' => $bookingsChangePercent,
            'popular_room' => $popularRoom,
            'total_proposals' => $totalProposals,
            'pending_proposals' => $pendingProposals,
            'approved_proposals' => $approvedProposals,
            'rejected_proposals' => $rejectedProposals,
        ];

        return view('admin.dashboard', compact('stats'));
    }
    
    /**
     * Simulasi mendapatkan total visitors
     * Dalam implementasi nyata, bisa menggunakan:
     * - Google Analytics API
     * - Tabel tracking visitors
     * - Log files analysis
     */
    private function getTotalVisitors(): int
    {
        // Simulasi data berdasarkan total berita yang dipublikasikan
        $baseVisitors = 500;
        $publishedNews = News::where('status', 'published')->count();
        $totalViews = News::where('status', 'published')->sum('views');
        
        return $baseVisitors + ($publishedNews * 15) + ($totalViews ?? 0);
    }
    
    /**
     * Simulasi mendapatkan visitors bulan lalu
     */
    private function getLastMonthVisitors(): int
    {
        $lastMonthNews = News::where('status', 'published')
            ->where('created_at', '<', Carbon::now()->startOfMonth())
            ->count();
        
        return 500 + ($lastMonthNews * 12);
    }
}
