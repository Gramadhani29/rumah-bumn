<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Booking;
use Carbon\Carbon;

class UpdateBookingStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bookings:update-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update booking status - mark past confirmed bookings as completed';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Updating booking statuses...');

        // Get all confirmed bookings that have passed
        $pastBookings = Booking::where('status', 'confirmed')
            ->where('booking_date', '<', Carbon::today())
            ->get();

        $count = 0;
        foreach ($pastBookings as $booking) {
            $booking->markAsCompleted();
            $count++;
        }

        $this->info("Updated {$count} booking(s) to completed status.");

        return 0;
    }
}
