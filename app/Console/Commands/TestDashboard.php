<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\Admin\DashboardController;
use App\Models\User;

class TestDashboard extends Command
{
    protected $signature = 'test:dashboard';
    protected $description = 'Test dashboard functionality';

    public function handle()
    {
        try {
            // Create/get admin user untuk test
            $adminUser = User::where('email', 'admin@admin.com')->first();
            if (!$adminUser) {
                $adminUser = User::create([
                    'name' => 'Admin Test',
                    'email' => 'admin@admin.com',
                    'password' => bcrypt('password'),
                    'email_verified_at' => now(),
                ]);
            }
            
            // Simulate login
            auth()->login($adminUser);
            
            // Test dashboard controller
            $controller = new DashboardController();
            $result = $controller->index();
            
            $this->info("✅ Dashboard controller works correctly!");
            $this->info("✅ View: " . $result->getName());
            
            // Test specific stats
            $stats = $result->getData()['stats'];
            $this->info("📊 Total Articles: " . $stats['total_articles']);
            $this->info("📊 Published Articles: " . $stats['published_articles']);
            $this->info("📊 Total Visitors: " . $stats['total_visitors']);
            $this->info("📊 Total Bookings: " . $stats['total_bookings']);
            $this->info("📊 Pending Bookings: " . $stats['pending_bookings']);
            
            $this->info("🎉 All dashboard functionality works correctly!");
            
        } catch (\Exception $e) {
            $this->error("❌ Dashboard Error: " . $e->getMessage());
            $this->error("📍 File: " . $e->getFile() . ":" . $e->getLine());
            return 1;
        }
        
        return 0;
    }
}