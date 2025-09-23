<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Ensure we have an admin user first
        $adminUser = DB::table('users')->where('email', 'admin@test.com')->first();
        if (!$adminUser) {
            $userId = DB::table('users')->insertGetId([
                'name' => 'Admin User',
                'email' => 'admin@test.com',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } else {
            $userId = $adminUser->id;
        }

        // Create sample news data to test views column
        DB::table('news')->insert([
            [
                'title' => 'Sample News 1',
                'slug' => 'sample-news-1',
                'excerpt' => 'This is a sample excerpt for testing.',
                'content' => 'This is the full content of the sample news article.',
                'category' => 'program-utama',
                'status' => 'published',
                'is_featured' => false,
                'views' => 0,
                'published_at' => now(),
                'author_id' => $userId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Sample News 2',
                'slug' => 'sample-news-2',
                'excerpt' => 'Another sample excerpt for testing purposes.',
                'content' => 'This is another full content of sample news article.',
                'category' => 'event',
                'status' => 'published',
                'is_featured' => true,
                'views' => 10,
                'published_at' => now(),
                'author_id' => $userId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Create sample room data
        $roomId = DB::table('rooms')->insertGetId([
            'name' => 'Ruang Meeting A',
            'description' => 'Ruang meeting dengan kapasitas 10 orang',
            'capacity' => 10,
            'status' => 'available',
            'facilities' => json_encode(['Proyektor', 'Whiteboard', 'AC']),
            'amenities' => json_encode(['WiFi', 'Sound System']),
            'available_from' => '08:00',
            'available_until' => '17:00',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create sample booking data
        DB::table('bookings')->insert([
            'booking_code' => 'BK-' . date('Ymd') . '-001',
            'room_id' => $roomId,
            'booking_date' => now()->addDays(1),
            'time_from' => '09:00',
            'time_until' => '11:00',
            'duration_hours' => 2,
            'status' => 'pending',
            'contact_name' => 'John Doe',
            'contact_phone' => '08123456789',
            'contact_email' => 'john@example.com',
            'purpose' => 'Rapat koordinasi',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('bookings')->where('booking_code', 'like', 'BK-' . date('Ymd') . '%')->delete();
        DB::table('rooms')->where('name', 'Ruang Meeting A')->delete();
        DB::table('news')->where('slug', 'like', 'sample-news-%')->delete();
        DB::table('users')->where('email', 'admin@test.com')->delete();
    }
};