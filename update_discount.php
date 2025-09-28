<?php

require_once 'vendor/autoload.php';

// Load Laravel application
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Product;

// Update beberapa produk dengan diskon
$updates = [
    [
        'id' => 1, // Batik Pekalongan Premium
        'discount_percentage' => 20.00,
        'is_on_sale' => true,
        'discount_starts_at' => now()->subDays(3),
        'discount_ends_at' => now()->addDays(4)
    ],
    [
        'id' => 3, // Keripik Tempe Renyah
        'discount_percentage' => 15.00,
        'is_on_sale' => true,
        'discount_starts_at' => now()->subDays(1),
        'discount_ends_at' => now()->addDays(7)
    ],
    [
        'id' => 7, // Kopi Robusta Premium
        'discount_percentage' => 25.00,
        'is_on_sale' => true,
        'discount_starts_at' => now()->subHours(12),
        'discount_ends_at' => now()->addDays(3)
    ]
];

foreach ($updates as $update) {
    $product = Product::find($update['id']);
    if ($product) {
        $product->update([
            'discount_percentage' => $update['discount_percentage'],
            'is_on_sale' => $update['is_on_sale'],
            'discount_starts_at' => $update['discount_starts_at'],
            'discount_ends_at' => $update['discount_ends_at']
        ]);
        echo "Updated product: {$product->name} with {$update['discount_percentage']}% discount\n";
    } else {
        echo "Product ID {$update['id']} not found\n";
    }
}

echo "Discount updates completed!\n";