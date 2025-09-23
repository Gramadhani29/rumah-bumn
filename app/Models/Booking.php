<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Booking extends Model
{
    protected $fillable = [
        'booking_code',
        'user_id',
        'room_id',
        'booking_date',
        'time_from',
        'time_until',
        'duration_hours',
        'status',
        'notes',
        'contact_name',
        'contact_phone',
        'contact_email',
        'organization',
        'purpose',
        'confirmed_at',
        'cancelled_at',
        'confirmation_pdf_path'
    ];

    protected $casts = [
        'booking_date' => 'date',
        'time_from' => 'string',
        'time_until' => 'string',
        'confirmed_at' => 'datetime',
        'cancelled_at' => 'datetime'
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($booking) {
            if (empty($booking->booking_code)) {
                $booking->booking_code = static::generateBookingCode();
            }
        });
    }

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    // Accessors
    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'pending' => 'Menunggu Konfirmasi',
            'confirmed' => 'Dikonfirmasi',
            'cancelled' => 'Dibatalkan',
            'completed' => 'Selesai',
            default => 'Unknown'
        };
    }

    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'pending' => 'warning',
            'confirmed' => 'success',
            'cancelled' => 'danger',
            'completed' => 'info',
            default => 'secondary'
        };
    }

    public function getFormattedDateAttribute(): string
    {
        return Carbon::parse($this->booking_date)->format('l, d F Y');
    }

    public function getFormattedTimeAttribute(): string
    {
        return date('H:i', strtotime($this->time_from)) . ' - ' . date('H:i', strtotime($this->time_until));
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeConfirmed($query)
    {
        return $query->where('status', 'confirmed');
    }

    public function scopeToday($query)
    {
        return $query->whereDate('booking_date', Carbon::today());
    }

    public function scopeUpcoming($query)
    {
        return $query->where('booking_date', '>=', Carbon::today());
    }

    // Methods
    public function canBeCancelled(): bool
    {
        return in_array($this->status, ['pending', 'confirmed']) && 
               $this->booking_date > Carbon::today();
    }

    public function canBeConfirmed(): bool
    {
        return $this->status === 'pending';
    }

    public function confirm(): void
    {
        $this->update([
            'status' => 'confirmed',
            'confirmed_at' => now()
        ]);
    }

    public function cancel(): void
    {
        $this->update([
            'status' => 'cancelled',
            'cancelled_at' => now()
        ]);
    }

    public function markAsCompleted(): void
    {
        $this->update(['status' => 'completed']);
    }

    // Static Methods
    public static function generateBookingCode(): string
    {
        do {
            $code = 'BK-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -4));
        } while (static::where('booking_code', $code)->exists());
        
        return $code;
    }

    public static function getTodayBookings()
    {
        return static::with(['room', 'user'])
            ->whereDate('booking_date', Carbon::today())
            ->orderBy('time_from')
            ->get();
    }

    public static function getUpcomingBookings($limit = 5)
    {
        return static::with(['room', 'user'])
            ->where('booking_date', '>=', Carbon::today())
            ->where('status', '!=', 'cancelled')
            ->orderBy('booking_date')
            ->orderBy('time_from')
            ->limit($limit)
            ->get();
    }
}
