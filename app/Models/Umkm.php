<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Umkm extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'business_name',
        'slug',
        'description',
        'owner_name',
        'phone',
        'email',
        'address',
        'city',
        'province',
        'postal_code',
        'category',
        'logo',
        'banner',
        'is_verified',
        'is_active',
        'rating',
        'total_products',
        'total_sold',
        'joined_at'
    ];

    protected $casts = [
        'is_verified' => 'boolean',
        'is_active' => 'boolean',
        'rating' => 'decimal:1',
        'joined_at' => 'datetime'
    ];

    // Relasi dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi dengan Product
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    // Relasi dengan Product yang aktif
    public function activeProducts()
    {
        return $this->hasMany(Product::class)->where('is_active', true);
    }

    // Scope untuk UMKM yang terverifikasi
    public function scopeVerified($query)
    {
        return $query->where('is_verified', true);
    }

    // Scope untuk UMKM yang aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Accessor untuk logo URL
    public function getLogoUrlAttribute()
    {
        return $this->logo ? asset('images/umkm/logos/' . $this->logo) : asset('images/default-logo.png');
    }

    // Accessor untuk banner URL
    public function getBannerUrlAttribute()
    {
        return $this->banner ? asset('images/umkm/banners/' . $this->banner) : asset('images/default-banner.jpg');
    }
}
