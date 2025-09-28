<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Umkm;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            // Batik Sari Indah Products
            [
                'umkm_id' => 1,
                'name' => 'Batik Pekalongan Premium Motif Mega Mendung',
                'description' => 'Batik tulis premium dengan motif mega mendung khas Pekalongan. Dibuat dengan teknik tradisional menggunakan pewarna alami yang ramah lingkungan. Cocok untuk acara formal maupun casual.',
                'specifications' => [
                    'Bahan' => 'Katun Premium',
                    'Ukuran' => '115cm x 240cm',
                    'Teknik' => 'Batik Tulis',
                    'Motif' => 'Mega Mendung',
                    'Pewarnaan' => 'Natural Dye'
                ],
                'category' => 'fashion',
                'price' => 185000,
                'original_price' => 210000,
                'stock' => 25,
                'weight' => 250,
                'images' => ['batik-mega-mendung-1.jpg', 'batik-mega-mendung-2.jpg', 'batik-mega-mendung-3.jpg'],
                'main_image' => 'batik-mega-mendung-1.jpg',
                'is_featured' => true,
                'rating' => 4.8,
                'total_reviews' => 24,
                'total_sold' => 67,
                'views' => 1250,
                'tags' => ['batik', 'pekalongan', 'premium', 'tulis', 'mega mendung'],
                'published_at' => now()->subWeeks(4)
            ],
            [
                'umkm_id' => 1,
                'name' => 'Kemeja Batik Modern Lengan Panjang',
                'description' => 'Kemeja batik modern dengan desain contemporary yang cocok untuk pria. Bahan katun yang nyaman dan tidak mudah kusut, perfect untuk kegiatan sehari-hari.',
                'specifications' => [
                    'Bahan' => 'Katun Stretch',
                    'Ukuran' => 'M, L, XL, XXL',
                    'Lengan' => 'Panjang',
                    'Model' => 'Slim Fit',
                    'Care' => 'Machine Washable'
                ],
                'category' => 'fashion',
                'price' => 165000,
                'stock' => 40,
                'weight' => 180,
                'images' => ['kemeja-batik-modern-1.jpg', 'kemeja-batik-modern-2.jpg'],
                'main_image' => 'kemeja-batik-modern-1.jpg',
                'rating' => 4.6,
                'total_reviews' => 18,
                'total_sold' => 43,
                'views' => 890,
                'tags' => ['kemeja', 'batik', 'modern', 'pria', 'formal'],
                'published_at' => now()->subWeeks(3)
            ],

            // Snack Barokah Products
            [
                'umkm_id' => 2,
                'name' => 'Keripik Tempe Renyah Original',
                'description' => 'Keripik tempe khas Pekalongan dengan tekstur renyah dan bumbu rahasia yang gurih. Terbuat dari tempe pilihan dan digoreng dengan minyak berkualitas tinggi.',
                'specifications' => [
                    'Bahan Utama' => 'Tempe Kedelai',
                    'Bumbu' => 'Bawang Putih, Garam, Merica',
                    'Kemasan' => 'Plastik Food Grade',
                    'Berat Bersih' => '250 gram',
                    'Expired' => '3 bulan dari tanggal produksi'
                ],
                'category' => 'makanan',
                'price' => 25000,
                'stock' => 150,
                'weight' => 280,
                'images' => ['keripik-tempe-original-1.jpg', 'keripik-tempe-original-2.jpg'],
                'main_image' => 'keripik-tempe-original-1.jpg',
                'is_featured' => true,
                'rating' => 4.7,
                'total_reviews' => 95,
                'total_sold' => 287,
                'views' => 2150,
                'tags' => ['keripik', 'tempe', 'renyah', 'snack', 'pekalongan'],
                'published_at' => now()->subWeeks(6)
            ],
            [
                'umkm_id' => 2,
                'name' => 'Keripik Tempe Pedas Manis',
                'description' => 'Varian keripik tempe dengan bumbu pedas manis yang menggugah selera. Perpaduan sempurna antara pedas, manis, dan gurih dalam satu gigitan.',
                'specifications' => [
                    'Bahan Utama' => 'Tempe Kedelai',
                    'Bumbu' => 'Cabai, Gula Merah, Bawang',
                    'Level Pedas' => 'Medium',
                    'Berat Bersih' => '250 gram',
                    'Halal' => 'Bersertifikat MUI'
                ],
                'category' => 'makanan',
                'price' => 28000,
                'stock' => 120,
                'weight' => 280,
                'images' => ['keripik-tempe-pedas-1.jpg', 'keripik-tempe-pedas-2.jpg'],
                'main_image' => 'keripik-tempe-pedas-1.jpg',
                'rating' => 4.5,
                'total_reviews' => 67,
                'total_sold' => 156,
                'views' => 1890,
                'tags' => ['keripik', 'tempe', 'pedas', 'manis', 'snack'],
                'published_at' => now()->subWeeks(5)
            ],

            // Kopi Nusantara Products
            [
                'umkm_id' => 3,
                'name' => 'Kopi Robusta Pekalongan Premium',
                'description' => 'Kopi robusta premium dari dataran tinggi Pekalongan dengan karakteristik body yang kuat dan aroma yang khas. Diproses dengan metode natural untuk menghasilkan rasa yang kompleks.',
                'specifications' => [
                    'Jenis Kopi' => 'Robusta',
                    'Asal' => 'Dataran Tinggi Pekalongan',
                    'Proses' => 'Natural Process',
                    'Roast Level' => 'Medium Dark',
                    'Kemasan' => '250 gram'
                ],
                'category' => 'minuman',
                'price' => 65000,
                'original_price' => 75000,
                'stock' => 80,
                'weight' => 280,
                'images' => ['kopi-robusta-premium-1.jpg', 'kopi-robusta-premium-2.jpg', 'kopi-robusta-premium-3.jpg'],
                'main_image' => 'kopi-robusta-premium-1.jpg',
                'is_featured' => true,
                'rating' => 4.9,
                'total_reviews' => 45,
                'total_sold' => 89,
                'views' => 1560,
                'tags' => ['kopi', 'robusta', 'premium', 'pekalongan', 'natural'],
                'published_at' => now()->subWeeks(7)
            ],
            [
                'umkm_id' => 3,
                'name' => 'Kopi Arabica Blend House Special',
                'description' => 'Blend khusus arabica dengan perpaduan beans dari berbagai daerah Indonesia. Menghasilkan rasa yang seimbang dengan aroma floral yang memikat.',
                'specifications' => [
                    'Jenis Kopi' => 'Arabica Blend',
                    'Komposisi' => 'Aceh 40%, Toraja 30%, Java 30%',
                    'Roast Level' => 'Medium',
                    'Grind' => 'Whole Bean',
                    'Kemasan' => '250 gram'
                ],
                'category' => 'minuman',
                'price' => 85000,
                'stock' => 60,
                'weight' => 280,
                'images' => ['kopi-arabica-blend-1.jpg', 'kopi-arabica-blend-2.jpg'],
                'main_image' => 'kopi-arabica-blend-1.jpg',
                'rating' => 4.7,
                'total_reviews' => 32,
                'total_sold' => 54,
                'views' => 1120,
                'tags' => ['kopi', 'arabica', 'blend', 'medium roast', 'specialty'],
                'published_at' => now()->subWeeks(2)
            ],

            // Kerajinan Bambu Sejahtera Products
            [
                'umkm_id' => 4,
                'name' => 'Vas Bunga Bambu Minimalis',
                'description' => 'Vas bunga dari bambu pilihan dengan desain minimalis modern. Cocok untuk dekorasi rumah atau kantor. Finishing natural yang menampilkan keindahan serat bambu asli.',
                'specifications' => [
                    'Bahan' => 'Bambu Betung',
                    'Tinggi' => '25 cm',
                    'Diameter' => '12 cm',
                    'Finishing' => 'Natural Coating',
                    'Style' => 'Minimalis Modern'
                ],
                'category' => 'kerajinan',
                'price' => 45000,
                'stock' => 35,
                'weight' => 150,
                'images' => ['vas-bambu-minimalis-1.jpg', 'vas-bambu-minimalis-2.jpg'],
                'main_image' => 'vas-bambu-minimalis-1.jpg',
                'rating' => 4.6,
                'total_reviews' => 23,
                'total_sold' => 38,
                'views' => 760,
                'tags' => ['vas', 'bambu', 'minimalis', 'dekorasi', 'natural'],
                'published_at' => now()->subWeeks(3)
            ],

            // Fashion Muslim Amanah Products
            [
                'umkm_id' => 5,
                'name' => 'Hijab Segiempat Premium Voal',
                'description' => 'Hijab segiempat dari bahan voal premium yang lembut dan tidak mudah kusut. Tersedia dalam berbagai warna elegan yang cocok untuk segala acara.',
                'specifications' => [
                    'Bahan' => 'Voal Premium',
                    'Ukuran' => '110cm x 110cm',
                    'Tekstur' => 'Lembut dan Halus',
                    'Care' => 'Hand Wash',
                    'Warna' => 'Dusty Pink, Cream, Navy'
                ],
                'category' => 'fashion',
                'price' => 35000,
                'stock' => 200,
                'weight' => 50,
                'images' => ['hijab-voal-premium-1.jpg', 'hijab-voal-premium-2.jpg', 'hijab-voal-premium-3.jpg'],
                'main_image' => 'hijab-voal-premium-1.jpg',
                'is_featured' => true,
                'rating' => 4.8,
                'total_reviews' => 156,
                'total_sold' => 445,
                'views' => 3200,
                'tags' => ['hijab', 'segiempat', 'voal', 'premium', 'muslim'],
                'published_at' => now()->subWeeks(8)
            ],
            [
                'umkm_id' => 5,
                'name' => 'Gamis Syari Polos Elegant',
                'description' => 'Gamis syari dengan desain simple dan elegant. Bahan jersey premium yang nyaman digunakan sehari-hari. Model longgar yang syar\'i dan tetap fashionable.',
                'specifications' => [
                    'Bahan' => 'Jersey Premium',
                    'Model' => 'Syari Longgar',
                    'Ukuran' => 'All Size fit to XL',
                    'Panjang' => '140 cm',
                    'Lengan' => 'Panjang dengan Karet'
                ],
                'category' => 'fashion',
                'price' => 125000,
                'original_price' => 145000,
                'stock' => 75,
                'weight' => 320,
                'images' => ['gamis-syari-elegant-1.jpg', 'gamis-syari-elegant-2.jpg'],
                'main_image' => 'gamis-syari-elegant-1.jpg',
                'rating' => 4.9,
                'total_reviews' => 89,
                'total_sold' => 167,
                'views' => 2450,
                'tags' => ['gamis', 'syari', 'polos', 'elegant', 'muslim'],
                'published_at' => now()->subWeeks(5)
            ],
            // PRODUK DENGAN DISKON - Flash Sale
            [
                'umkm_id' => 1,
                'name' => 'Batik Dress Elegant Motif Bunga',
                'description' => 'Dress batik elegant dengan motif bunga yang cantik. Perfect untuk acara formal atau semi formal. Bahan katun premium yang nyaman dipakai seharian.',
                'specifications' => [
                    'Bahan' => 'Katun Premium',
                    'Ukuran' => 'S, M, L, XL',
                    'Model' => 'A-Line Dress',
                    'Panjang' => 'Midi (90cm)',
                    'Care' => 'Hand Wash'
                ],
                'category' => 'fashion',
                'price' => 549000,
                'stock' => 15,
                'weight' => 350,
                'images' => ['batik-dress-bunga-1.jpg', 'batik-dress-bunga-2.jpg'],
                'main_image' => 'batik-dress-bunga-1.jpg',
                'is_featured' => true,
                'rating' => 4.9,
                'total_reviews' => 18,
                'total_sold' => 42,
                'views' => 890,
                'tags' => ['batik', 'dress', 'elegant', 'bunga', 'formal'],
                'published_at' => now()->subWeeks(2),
                // DISCOUNT FIELDS
                'discount_percentage' => 20.00,
                'is_on_sale' => true,
                'discount_starts_at' => now()->subDays(3),
                'discount_ends_at' => now()->addDays(4)
            ],
            [
                'umkm_id' => 3,
                'name' => 'Kopi Robusta Premium 500gr - Special Sale',
                'description' => 'Kopi robusta premium dari dataran tinggi Pekalongan. Roasted fresh dengan profil rasa yang kuat dan aroma yang menggoda. Limited time offer!',
                'specifications' => [
                    'Jenis' => 'Robusta Premium',
                    'Asal' => 'Dataran Tinggi Pekalongan',
                    'Roast Level' => 'Medium Dark',
                    'Proses' => 'Natural Process',
                    'Kemasan' => 'Valve Bag'
                ],
                'category' => 'makanan',
                'price' => 125000,
                'stock' => 50,
                'weight' => 500,
                'images' => ['kopi-robusta-premium-1.jpg', 'kopi-robusta-premium-2.jpg'],
                'main_image' => 'kopi-robusta-premium-1.jpg',
                'is_featured' => true,
                'rating' => 4.8,
                'total_reviews' => 32,
                'total_sold' => 89,
                'views' => 1560,
                'tags' => ['kopi', 'robusta', 'premium', 'dataran tinggi', 'fresh roast'],
                'published_at' => now()->subWeeks(3),
                // DISCOUNT FIELDS
                'discount_percentage' => 15.00,
                'is_on_sale' => true,
                'discount_starts_at' => now()->subDays(1),
                'discount_ends_at' => now()->addDays(7)
            ],
            [
                'umkm_id' => 2,
                'name' => 'Keripik Tempe Balado Jumbo Pack',
                'description' => 'Keripik tempe dengan bumbu balado yang pedas dan nikmat. Kemasan jumbo pack untuk kebutuhan keluarga atau acara. Harga spesial untuk pembelian pack!',
                'specifications' => [
                    'Bahan Utama' => 'Tempe Kedelai Organik',
                    'Bumbu' => 'Balado Pedas',
                    'Kemasan' => '5 Pack @ 250gr',
                    'Total Berat' => '1.25 kg',
                    'Level Pedas' => 'Hot'
                ],
                'category' => 'makanan',
                'price' => 120000,
                'stock' => 30,
                'weight' => 1300,
                'images' => ['keripik-tempe-balado-jumbo-1.jpg', 'keripik-tempe-balado-jumbo-2.jpg'],
                'main_image' => 'keripik-tempe-balado-jumbo-1.jpg',
                'rating' => 4.6,
                'total_reviews' => 25,
                'total_sold' => 48,
                'views' => 672,
                'tags' => ['keripik', 'tempe', 'balado', 'pedas', 'jumbo pack'],
                'published_at' => now()->subWeeks(1),
                // DISCOUNT FIELDS
                'discount_percentage' => 25.00,
                'is_on_sale' => true,
                'discount_starts_at' => now()->subHours(12),
                'discount_ends_at' => now()->addDays(3)
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }

        // Update total_products untuk setiap UMKM
        $umkms = Umkm::withCount('products')->get();
        foreach ($umkms as $umkm) {
            $umkm->update(['total_products' => $umkm->products_count]);
        }
    }
}
