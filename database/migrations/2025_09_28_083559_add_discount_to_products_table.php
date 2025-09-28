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
        Schema::table('products', function (Blueprint $table) {
            $table->decimal('discount_percentage', 5, 2)->default(0)->comment('Persentase diskon (0-100)');
            $table->boolean('is_on_sale')->default(false)->comment('Status apakah produk sedang diskon');
            $table->timestamp('discount_starts_at')->nullable()->comment('Tanggal mulai diskon');
            $table->timestamp('discount_ends_at')->nullable()->comment('Tanggal berakhir diskon');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['discount_percentage', 'is_on_sale', 'discount_starts_at', 'discount_ends_at']);
        });
    }
};
