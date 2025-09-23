<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Room;
use App\Models\Booking;
use Carbon\Carbon;

class TestBookingSchedule extends Command
{
    protected $signature = 'test:booking-schedule';
    protected $description = 'Test booking schedule display functionality';

    public function handle()
    {
        try {
            // Get a room with bookings
            $room = Room::with('bookings')->first();
            if (!$room) {
                $this->error("❌ No rooms found in database");
                return 1;
            }

            $this->info("✅ Testing room: {$room->name}");

            // Test today's bookings
            $todayBookings = $room->bookings()
                ->where('booking_date', now()->toDateString())
                ->where('status', '!=', 'cancelled')
                ->orderBy('time_from')
                ->get();

            $this->info("📅 Today's bookings: {$todayBookings->count()}");

            foreach($todayBookings as $booking) {
                $timeFrom = Carbon::parse($booking->time_from)->format('H:i');
                $timeUntil = Carbon::parse($booking->time_until)->format('H:i');
                $this->info("   ⏰ {$timeFrom} - {$timeUntil} | {$booking->contact_name} | {$booking->status}");
            }

            // Test tomorrow's bookings
            $tomorrowBookings = $room->bookings()
                ->where('booking_date', now()->addDay()->toDateString())
                ->where('status', '!=', 'cancelled')
                ->orderBy('time_from')
                ->get();

            $this->info("📅 Tomorrow's bookings: {$tomorrowBookings->count()}");

            // Test all rooms today booking summary
            $allTodayBookings = Booking::with(['room'])
                ->where('booking_date', now()->toDateString())
                ->where('status', '!=', 'cancelled')
                ->orderBy('time_from')
                ->get()
                ->groupBy('room.name');

            $this->info("🏢 Total rooms with bookings today: {$allTodayBookings->count()}");

            foreach($allTodayBookings as $roomName => $bookings) {
                $this->info("   📍 {$roomName}: {$bookings->count()} bookings");
            }

            $this->info("🎉 All booking schedule tests passed!");

        } catch (\Exception $e) {
            $this->error("❌ Error: " . $e->getMessage());
            $this->error("📍 File: " . $e->getFile() . ":" . $e->getLine());
            return 1;
        }

        return 0;
    }
}