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
        // Add more sample bookings for today and tomorrow
        $roomId = DB::table('rooms')->first()->id;

        DB::table('bookings')->insert([
            // Today's bookings
            [
                'booking_code' => 'BK-' . date('Ymd') . '-002',
                'room_id' => $roomId,
                'booking_date' => now(),
                'time_from' => '09:00',
                'time_until' => '11:00',
                'duration_hours' => 2,
                'status' => 'confirmed',
                'contact_name' => 'Ahmad Rizki',
                'contact_phone' => '08123456790',
                'contact_email' => 'ahmad@example.com',
                'purpose' => 'Meeting tim marketing',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'booking_code' => 'BK-' . date('Ymd') . '-003',
                'room_id' => $roomId,
                'booking_date' => now(),
                'time_from' => '13:00',
                'time_until' => '15:00',
                'duration_hours' => 2,
                'status' => 'pending',
                'contact_name' => 'Sari Dewi',
                'contact_phone' => '08123456791',
                'contact_email' => 'sari@example.com',
                'purpose' => 'Presentasi produk baru',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'booking_code' => 'BK-' . date('Ymd') . '-004',
                'room_id' => $roomId,
                'booking_date' => now(),
                'time_from' => '15:30',
                'time_until' => '17:00',
                'duration_hours' => 1.5,
                'status' => 'confirmed',
                'contact_name' => 'Budi Santoso',
                'contact_phone' => '08123456792',
                'contact_email' => 'budi@example.com',
                'purpose' => 'Training karyawan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Tomorrow's additional bookings
            [
                'booking_code' => 'BK-' . now()->addDay()->format('Ymd') . '-001',
                'room_id' => $roomId,
                'booking_date' => now()->addDay(),
                'time_from' => '08:00',
                'time_until' => '10:00',
                'duration_hours' => 2,
                'status' => 'confirmed',
                'contact_name' => 'Lisa Permata',
                'contact_phone' => '08123456793',
                'contact_email' => 'lisa@example.com',
                'purpose' => 'Workshop digital marketing',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('bookings')->where('booking_code', 'like', 'BK-' . date('Ymd') . '-%')->delete();
        DB::table('bookings')->where('booking_code', 'like', 'BK-' . now()->addDay()->format('Ymd') . '-%')->delete();
    }
};