<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'umkm_id',
        'name',
        'slug',
        'description',
        'specifications',
        'category',
        'price',
        'original_price',
        'stock',
        'min_order',
        'weight',
        'sku',
        'images',
        'main_image',
        'is_featured',
        'is_active',
        'rating',
        'total_reviews',
        'total_sold',
        'views',
        'tags',
        'published_at',
        'discount_percentage',
        'is_on_sale',
        'discount_starts_at',
        'discount_ends_at'
    ];

    protected $casts = [
        'images' => 'array',
        'tags' => 'array',
        'specifications' => 'array',
        'price' => 'decimal:2',
        'original_price' => 'decimal:2',
        'weight' => 'decimal:2',
        'rating' => 'decimal:1',
        'discount_percentage' => 'decimal:2',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'is_on_sale' => 'boolean',
        'published_at' => 'datetime',
        'discount_starts_at' => 'datetime',
        'discount_ends_at' => 'datetime'
    ];

    // Boot method untuk auto-generate slug
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }
            if (empty($product->sku)) {
                $product->sku = 'PRD-' . strtoupper(Str::random(8));
            }
        });
    }

    // Relasi dengan UMKM
    public function umkm()
    {
        return $this->belongsTo(Umkm::class);
    }

    // Scope untuk produk yang aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope untuk produk yang dipublikasi
    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at')
                    ->where('published_at', '<=', now());
    }

    // Scope untuk produk featured
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    // Scope untuk pencarian
    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%")
              ->orWhereJsonContains('tags', $search);
        });
    }

    // Scope untuk filter kategori
    public function scopeCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    // Accessor untuk URL gambar utama
    public function getMainImageUrlAttribute()
    {
        return $this->main_image ? asset('images/products/' . $this->main_image) : asset('images/default-product.jpg');
    }

    // Accessor untuk array URL gambar
    public function getImageUrlsAttribute()
    {
        if (!$this->images || !is_array($this->images)) {
            return [asset('images/default-product.jpg')];
        }

        return array_map(function ($image) {
            return asset('images/products/' . $image);
        }, $this->images);
    }

    // Accessor untuk format harga
    public function getFormattedPriceAttribute()
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    // Accessor untuk format harga asli
    public function getFormattedOriginalPriceAttribute()
    {
        return $this->original_price ? 'Rp ' . number_format($this->original_price, 0, ',', '.') : null;
    }

    // Check apakah produk sedang diskon aktif
    public function getIsDiscountActiveAttribute()
    {
        if (!$this->is_on_sale || $this->discount_percentage <= 0) {
            return false;
        }

        $now = now();
        $startsAt = $this->discount_starts_at;
        $endsAt = $this->discount_ends_at;

        // Jika tidak ada tanggal, berarti diskon permanent
        if (!$startsAt && !$endsAt) {
            return true;
        }

        // Check apakah dalam periode diskon
        if ($startsAt && $now < $startsAt) {
            return false;
        }

        if ($endsAt && $now > $endsAt) {
            return false;
        }

        return true;
    }

    // Hitung harga setelah diskon
    public function getDiscountedPriceAttribute()
    {
        if (!$this->is_discount_active) {
            return $this->price;
        }

        $discountAmount = $this->price * ($this->discount_percentage / 100);
        return $this->price - $discountAmount;
    }

    // Format harga yang sudah didiskon
    public function getFormattedDiscountedPriceAttribute()
    {
        return 'Rp ' . number_format($this->discounted_price, 0, ',', '.');
    }

    // Check apakah ada diskon (backward compatibility)
    public function getHasDiscountAttribute()
    {
        return $this->is_discount_active;
    }

    // Hitung berapa rupiah yang dihemat
    public function getDiscountAmountAttribute()
    {
        if (!$this->is_discount_active) {
            return 0;
        }

        return $this->price - $this->discounted_price;
    }

    // Format jumlah diskon dalam rupiah
    public function getFormattedDiscountAmountAttribute()
    {
        return 'Rp ' . number_format($this->discount_amount, 0, ',', '.');
    }

    // Check stock availability
    public function isInStock()
    {
        return $this->stock > 0;
    }

    // Increment views
    public function incrementViews()
    {
        $this->increment('views');
    }
}
