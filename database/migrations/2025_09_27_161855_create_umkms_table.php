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
        Schema::create('umkms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('owner_name');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->text('address');
            $table->string('city');
            $table->string('province');
            $table->string('postal_code', 10);
            $table->enum('category', ['fashion', 'makanan', 'minuman', 'kerajinan', 'elektronik', 'lainnya']);
            $table->string('logo')->nullable();
            $table->string('banner')->nullable();
            $table->boolean('is_verified')->default(false);
            $table->boolean('is_active')->default(true);
            $table->decimal('rating', 2, 1)->default(0);
            $table->integer('total_products')->default(0);
            $table->integer('total_sold')->default(0);
            $table->timestamp('joined_at')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('umkms');
    }
};
