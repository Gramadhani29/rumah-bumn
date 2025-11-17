<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_address',
        'customer_city',
        'customer_postal_code',
        'total_amount',
        'status',
        'payment_status',
        'payment_method',
        'midtrans_transaction_id',
        'items',
        'notes',
        'paid_at',
        'shipped_at',
        'delivered_at'
    ];

    protected $casts = [
        'items' => 'array',
        'total_amount' => 'decimal:2',
        'paid_at' => 'datetime',
        'shipped_at' => 'datetime',
        'delivered_at' => 'datetime'
    ];

    // Accessor untuk mendapatkan nama customer lengkap
    public function getFullNameAttribute()
    {
        return $this->customer_name;
    }
    
    // Accessor untuk mendapatkan total items
    public function getTotalItemsAttribute()
    {
        return collect($this->items)->sum('quantity');
    }

    // Accessor untuk formatted total amount
    public function getFormattedTotalAttribute()
    {
        return 'Rp ' . number_format($this->total_amount, 0, ',', '.');
    }

    // Scope untuk filter berdasarkan status
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    // Scope untuk filter berdasarkan payment status
    public function scopeByPaymentStatus($query, $status)
    {
        return $query->where('payment_status', $status);
    }
}
