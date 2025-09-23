<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    protected $fillable = [
        'name',
        'description',
        'capacity',
        'location',
        'image',
        'status',
        'facilities',
        'amenities',
        'available_from',
        'available_until'
    ];

    protected $casts = [
        'facilities' => 'array',
        'amenities' => 'array',
        'available_from' => 'string',
        'available_until' => 'string'
    ];

    // Relationships
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    // Accessors
    public function getImageUrlAttribute(): string
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        return asset('images/room-placeholder.jpg');
    }

    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'available' => 'Tersedia',
            'maintenance' => 'Maintenance',
            'unavailable' => 'Tidak Tersedia',
            default => 'Unknown'
        };
    }

    // Scopes
    public function scopeAvailable($query)
    {
        return $query->where('status', 'available');
    }

    public function scopeWithCapacity($query, $minCapacity)
    {
        return $query->where('capacity', '>=', $minCapacity);
    }

    // Methods
    public function isAvailable(): bool
    {
        return $this->status === 'available';
    }

    public function isBookedAt($date, $timeFrom, $timeUntil): bool
    {
        return $this->bookings()
            ->where('booking_date', $date)
            ->where('status', '!=', 'cancelled')
            ->where(function ($query) use ($timeFrom, $timeUntil) {
                $query->whereBetween('time_from', [$timeFrom, $timeUntil])
                      ->orWhereBetween('time_until', [$timeFrom, $timeUntil])
                      ->orWhere(function ($q) use ($timeFrom, $timeUntil) {
                          $q->where('time_from', '<=', $timeFrom)
                            ->where('time_until', '>=', $timeUntil);
                      });
            })
            ->exists();
    }

    public function getAvailableTimeSlots($date): array
    {
        $slots = [];
        $start = $this->available_from;
        $end = $this->available_until;
        
        // Generate hourly slots
        $current = \Carbon\Carbon::createFromFormat('H:i:s', $start);
        $endTime = \Carbon\Carbon::createFromFormat('H:i:s', $end);
        
        while ($current < $endTime) {
            $slotEnd = $current->copy()->addHour();
            if ($slotEnd <= $endTime) {
                $timeFrom = $current->format('H:i');
                $timeUntil = $slotEnd->format('H:i');
                
                if (!$this->isBookedAt($date, $timeFrom, $timeUntil)) {
                    $slots[] = [
                        'time_from' => $timeFrom,
                        'time_until' => $timeUntil,
                        'label' => $timeFrom . ' - ' . $timeUntil
                    ];
                }
            }
            $current->addHour();
        }
        
        return $slots;
    }
}
