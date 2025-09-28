<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('umkm_id')->constrained('umkms')->onDelete('cascade');
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description');
            $table->text('specifications')->nullable(); // JSON field untuk spesifikasi
            $table->enum('category', ['fashion', 'makanan', 'minuman', 'kerajinan', 'elektronik', 'lainnya']);
            $table->decimal('price', 12, 2);
            $table->decimal('original_price', 12, 2)->nullable(); // Harga asli sebelum diskon
            $table->integer('stock');
            $table->integer('min_order')->default(1);
            $table->decimal('weight', 8, 2)->nullable(); // Berat dalam gram
            $table->string('sku')->unique()->nullable();
            $table->json('images'); // Array gambar produk
            $table->string('main_image'); // Gambar utama
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->decimal('rating', 2, 1)->default(0);
            $table->integer('total_reviews')->default(0);
            $table->integer('total_sold')->default(0);
            $table->integer('views')->default(0);
            $table->json('tags')->nullable(); // Tags untuk pencarian
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
            
            // Indexes
            $table->index(['category', 'is_active']);
            $table->index(['is_featured', 'is_active']);
            $table->index('published_at');
            $table->fullText(['name', 'description']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
