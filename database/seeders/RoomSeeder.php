<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rooms = [
            [
                'name' => 'Area Ruang Tamu',
                'description' => 'Ruang tamu yang nyaman untuk pertemuan informal dan penyambutan tamu. Dilengkapi dengan sofa dan meja kopi yang elegan.',
                'capacity' => 10,
                'facilities' => ['Sofa', 'Meja Kopi', 'AC', 'WiFi', 'TV'],
                'amenities' => ['Tea & Coffee', 'Welcome Drink'],
                'available_from' => '08:00',
                'available_until' => '17:00',
                'status' => 'available'
            ],
            [
                'name' => 'Co Working Space',
                'description' => 'Ruang kerja bersama yang modern dengan suasana produktif. Ideal untuk freelancer dan startup.',
                'capacity' => 20,
                'facilities' => ['Meja Kerja', 'Kursi Ergonomis', 'Power Outlet', 'WiFi', 'Printer', 'Scanner'],
                'amenities' => ['Free Coffee', '24/7 Access', 'Locker'],
                'available_from' => '07:00',
                'available_until' => '22:00',
                'status' => 'available'
            ],
            [
                'name' => 'Basecamp Milenial',
                'description' => 'Ruang kreatif untuk generasi milenial dengan desain modern dan fasilitas teknologi terkini.',
                'capacity' => 15,
                'facilities' => ['Gaming Area', 'Smart TV', 'Sound System', 'WiFi', 'Bean Bags', 'Whiteboard'],
                'amenities' => ['Snacks', 'Energy Drinks', 'PlayStation'],
                'available_from' => '09:00',
                'available_until' => '21:00',
                'status' => 'available'
            ],
            [
                'name' => 'Area Display Produk',
                'description' => 'Ruang pameran untuk menampilkan produk UMKM dan hasil karya lokal.',
                'capacity' => 30,
                'facilities' => ['Display Case', 'Lighting', 'Security System', 'WiFi'],
                'amenities' => ['Brochure Stand', 'Guest Book'],
                'available_from' => '08:00',
                'available_until' => '18:00',
                'status' => 'available'
            ],
            [
                'name' => 'Ruang Meeting',
                'description' => 'Ruang pertemuan profesional dengan fasilitas lengkap untuk keperluan bisnis.',
                'capacity' => 12,
                'facilities' => ['Conference Table', 'Projector', 'Screen', 'AC', 'WiFi', 'Whiteboard'],
                'amenities' => ['Meeting Kit', 'Refreshments'],
                'available_from' => '08:00',
                'available_until' => '17:00',
                'status' => 'available'
            ],
            [
                'name' => 'Auditorium',
                'description' => 'Ruang auditorium untuk acara besar, seminar, dan presentasi dengan kapasitas hingga 100 orang.',
                'capacity' => 100,
                'facilities' => ['Stage', 'Sound System', 'Projector', 'AC', 'WiFi', 'Lighting'],
                'amenities' => ['Microphone', 'Sound Technician'],
                'available_from' => '08:00',
                'available_until' => '22:00',
                'status' => 'available'
            ],
            [
                'name' => 'Studio Kreatif',
                'description' => 'Studio untuk kegiatan kreatif seperti workshop, pelatihan, dan aktivitas seni.',
                'capacity' => 25,
                'facilities' => ['Workshop Tables', 'Storage', 'Good Lighting', 'WiFi', 'Power Outlets'],
                'amenities' => ['Art Supplies', 'Equipment Storage'],
                'available_from' => '09:00',
                'available_until' => '18:00',
                'status' => 'available'
            ],
            [
                'name' => 'VIP Lounge',
                'description' => 'Ruang VIP eksklusif untuk pertemuan tingkat tinggi dan tamu penting.',
                'capacity' => 8,
                'facilities' => ['Luxury Seating', 'Premium TV', 'Mini Bar', 'AC', 'WiFi'],
                'amenities' => ['Premium Service', 'Exclusive Catering'],
                'available_from' => '08:00',
                'available_until' => '20:00',
                'status' => 'available'
            ],
            [
                'name' => 'Outdoor Terrace',
                'description' => 'Teras outdoor dengan pemandangan indah, cocok untuk acara outdoor dan gathering.',
                'capacity' => 50,
                'facilities' => ['Outdoor Furniture', 'Sound System', 'Lighting', 'WiFi'],
                'amenities' => ['BBQ Set', 'Garden View'],
                'available_from' => '10:00',
                'available_until' => '22:00',
                'status' => 'available'
            ]
        ];

        foreach ($rooms as $roomData) {
            Room::create($roomData);
        }
    }
}