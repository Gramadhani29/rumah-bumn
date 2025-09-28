<?php

namespace Database\Seeders;

use App\Models\Umkm;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UmkmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $umkms = [
            [
                'name' => 'Batik Sari Indah',
                'description' => 'UMKM yang berfokus pada produksi batik tradisional Pekalongan dengan kualitas premium. Telah berdiri sejak 1995 dan melayani pelanggan di seluruh Indonesia.',
                'owner_name' => 'Siti Nurhaliza',
                'phone' => '081234567890',
                'email' => 'contact@batiksariindah.com',
                'address' => 'Jl. Batik Raya No. 15, Pekalongan Timur',
                'city' => 'Pekalongan',
                'province' => 'Jawa Tengah',
                'postal_code' => '51127',
                'category' => 'fashion',
                'logo' => 'batik-sari-indah-logo.jpg',
                'banner' => 'batik-sari-indah-banner.jpg',
                'is_verified' => true,
                'is_active' => true,
                'rating' => 4.8,
                'total_products' => 0,
                'total_sold' => 150,
                'joined_at' => now()->subYears(2)
            ],
            [
                'name' => 'Snack Barokah',
                'description' => 'Produsen makanan ringan tradisional dengan cita rasa autentik. Mengutamakan bahan-bahan berkualitas dan higienis dalam setiap produksi.',
                'owner_name' => 'Ahmad Maulana',
                'phone' => '081345678901',
                'email' => 'info@snackbarokah.id',
                'address' => 'Jl. Industri No. 23, Kelurahan Bendan',
                'city' => 'Pekalongan',
                'province' => 'Jawa Tengah',
                'postal_code' => '51119',
                'category' => 'makanan',
                'logo' => 'snack-barokah-logo.jpg',
                'banner' => 'snack-barokah-banner.jpg',
                'is_verified' => true,
                'is_active' => true,
                'rating' => 4.6,
                'total_products' => 0,
                'total_sold' => 320,
                'joined_at' => now()->subYears(1)
            ],
            [
                'name' => 'Kopi Nusantara',
                'description' => 'Roaster kopi lokal yang menghadirkan cita rasa kopi nusantara terbaik. Bermitra langsung dengan petani kopi untuk menjamin kualitas biji kopi.',
                'owner_name' => 'Budi Santoso',
                'phone' => '081456789012',
                'email' => 'hello@kopinusantara.co.id',
                'address' => 'Jl. Pemuda No. 45, Pekalongan Utara',
                'city' => 'Pekalongan',
                'province' => 'Jawa Tengah',
                'postal_code' => '51141',
                'category' => 'minuman',
                'logo' => 'kopi-nusantara-logo.jpg',
                'banner' => 'kopi-nusantara-banner.jpg',
                'is_verified' => true,
                'is_active' => true,
                'rating' => 4.7,
                'total_products' => 0,
                'total_sold' => 89,
                'joined_at' => now()->subMonths(8)
            ],
            [
                'name' => 'Kerajinan Bambu Sejahtera',
                'description' => 'Pengrajin bambu yang menghasilkan berbagai produk kerajinan bambu berkualitas tinggi. Mendukung kelestarian lingkungan dengan menggunakan bambu sebagai bahan utama.',
                'owner_name' => 'Wati Suhartini',
                'phone' => '081567890123',
                'email' => 'order@bambusejahtera.com',
                'address' => 'Desa Wonokerto, Kec. Wonokerto',
                'city' => 'Pekalongan',
                'province' => 'Jawa Tengah',
                'postal_code' => '51156',
                'category' => 'kerajinan',
                'logo' => 'bambu-sejahtera-logo.jpg',
                'banner' => 'bambu-sejahtera-banner.jpg',
                'is_verified' => true,
                'is_active' => true,
                'rating' => 4.5,
                'total_products' => 0,
                'total_sold' => 67,
                'joined_at' => now()->subMonths(6)
            ],
            [
                'name' => 'Fashion Muslim Amanah',
                'description' => 'Produsen busana muslim modern dengan desain yang elegan dan nyaman. Mengutamakan kualitas bahan dan jahitan yang rapi.',
                'owner_name' => 'Fatimah Azzahra',
                'phone' => '081678901234',
                'email' => 'cs@fashionamanah.id',
                'address' => 'Jl. Diponegoro No. 78, Pekalongan Selatan',
                'city' => 'Pekalongan',
                'province' => 'Jawa Tengah',
                'postal_code' => '51113',
                'category' => 'fashion',
                'logo' => 'fashion-amanah-logo.jpg',
                'banner' => 'fashion-amanah-banner.jpg',
                'is_verified' => true,
                'is_active' => true,
                'rating' => 4.9,
                'total_products' => 0,
                'total_sold' => 234,
                'joined_at' => now()->subMonths(10)
            ]
        ];

        foreach ($umkms as $umkm) {
            Umkm::create($umkm);
        }
    }
}
