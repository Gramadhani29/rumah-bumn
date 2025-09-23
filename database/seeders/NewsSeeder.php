<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\News;
use App\Models\User;
use Illuminate\Support\Str;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get admin user
        $admin = User::where('email', 'admin@rumahbumn.com')->first();
        
        if (!$admin) {
            $this->command->error('Admin user not found. Please run AdminUserSeeder first.');
            return;
        }

        $newsData = [
            [
                'title' => 'Program Pelatihan Digital Marketing untuk UMKM',
                'excerpt' => 'Rumah BUMN Telkom Pekalongan mengadakan pelatihan digital marketing gratis untuk meningkatkan kapasitas UMKM lokal.',
                'content' => '<p>Rumah BUMN Telkom Pekalongan kembali mengadakan program pelatihan digital marketing yang ditujukan untuk para pelaku UMKM di wilayah Pekalongan dan sekitarnya. Program ini merupakan bagian dari komitmen Rumah BUMN dalam memberdayakan ekonomi rakyat melalui transformasi digital.</p><p>Pelatihan ini akan mencakup berbagai materi penting seperti strategi pemasaran online, penggunaan media sosial untuk bisnis, optimasi marketplace, dan teknik fotografi produk. Peserta juga akan mendapatkan pendampingan langsung dalam membuat konten yang menarik dan efektif.</p><p>Kepala Rumah BUMN Telkom Pekalongan menyatakan bahwa program ini diharapkan dapat membantu UMKM untuk beradaptasi dengan era digital dan meningkatkan penjualan mereka melalui platform online.</p>',
                'category' => 'pelatihan',
                'status' => 'published',
                'is_featured' => true,
                'published_at' => now()->subDays(2),
            ],
            [
                'title' => 'Kemitraan Strategis dengan Bank Mandiri',
                'excerpt' => 'Penandatanganan MOU kerjasama pembiayaan UMKM antara Rumah BUMN Telkom Pekalongan dengan Bank Mandiri.',
                'content' => '<p>Rumah BUMN Telkom Pekalongan menjalin kemitraan strategis dengan Bank Mandiri dalam rangka memberikan akses pembiayaan yang lebih mudah bagi para pelaku UMKM binaan.</p><p>Kerjasama ini meliputi penyediaan kredit usaha mikro dengan bunga kompetitif, pendampingan business plan, dan program literasi keuangan. Para UMKM binaan Rumah BUMN akan mendapatkan kemudahan proses pengajuan kredit serta pendampingan dalam pengelolaan keuangan usaha.</p><p>Direktur Bank Mandiri Cabang Pekalongan menyambut baik kerjasama ini dan berkomitmen untuk mendukung pengembangan UMKM di wilayah Pekalongan melalui berbagai produk perbankan yang sesuai dengan kebutuhan pelaku usaha.</p>',
                'category' => 'kemitraan',
                'status' => 'published',
                'is_featured' => false,
                'published_at' => now()->subDays(1),
            ],
            [
                'title' => 'Prestasi UMKM Binaan di Pameran Produk Lokal',
                'excerpt' => 'Tiga UMKM binaan Rumah BUMN meraih penghargaan terbaik dalam Pameran Produk Lokal Jawa Tengah 2025.',
                'content' => '<p>Tiga UMKM binaan Rumah BUMN Telkom Pekalongan berhasil meraih prestasi membanggakan dalam Pameran Produk Lokal Jawa Tengah 2025 yang diselenggarakan di Solo.</p><p>UMKM Batik Pekalongan Heritage meraih juara pertama kategori produk fashion tradisional, sementara UMKM Kerajinan Bambu Nusantara mendapat penghargaan inovasi produk terbaik. UMKM Kuliner Tradisional Pekalongan juga meraih juara kedua kategori produk makanan olahan.</p><p>Prestasi ini merupakan hasil dari program pembinaan intensif yang dilakukan Rumah BUMN, meliputi peningkatan kualitas produk, kemasan, branding, dan strategi pemasaran. Para UMKM juga mendapat pendampingan dalam standarisasi produk dan sertifikasi halal.</p>',
                'category' => 'prestasi',
                'status' => 'published',
                'is_featured' => false,
                'published_at' => now()->subHours(12),
            ],
            [
                'title' => 'Workshop Packaging Design untuk Produk UMKM',
                'excerpt' => 'Pelatihan desain kemasan produk untuk meningkatkan daya tarik dan nilai jual produk UMKM binaan.',
                'content' => '<p>Rumah BUMN Telkom Pekalongan menggelar workshop packaging design yang diikuti oleh 50 pelaku UMKM dari berbagai sektor usaha. Workshop ini bertujuan untuk meningkatkan kemampuan UMKM dalam merancang kemasan produk yang menarik dan sesuai standar pasar.</p><p>Materi workshop meliputi prinsip-prinsip desain kemasan, pemilihan bahan kemasan yang tepat, regulasi label produk, dan strategi branding melalui kemasan. Peserta juga praktik langsung merancang kemasan untuk produk mereka dengan bimbingan ahli desain grafis.</p><p>Instruktur workshop yang merupakan profesional di bidang packaging design memberikan tips praktis tentang cara membuat kemasan yang tidak hanya menarik secara visual, tetapi juga fungsional dan ramah lingkungan.</p>',
                'category' => 'pelatihan',
                'status' => 'published',
                'is_featured' => false,
                'published_at' => now()->subHours(6),
            ],
            [
                'title' => 'Event Bazar UMKM Ramah Lingkungan',
                'excerpt' => 'Rumah BUMN menyelenggarakan bazar khusus produk UMKM ramah lingkungan dalam rangka Hari Lingkungan Hidup.',
                'content' => '<p>Dalam rangka memperingati Hari Lingkungan Hidup, Rumah BUMN Telkom Pekalongan menggelar event Bazar UMKM Ramah Lingkungan yang menampilkan berbagai produk berkelanjutan dari UMKM binaan.</p><p>Event ini menampilkan produk-produk inovatif seperti tas dari bahan daur ulang, kerajinan dari limbah plastik, produk makanan organik, dan kosmetik natural. Para pengunjung dapat melihat langsung proses pembuatan beberapa produk melalui demo yang disediakan.</p><p>Selain pameran produk, event ini juga menghadirkan talk show tentang pentingnya bisnis berkelanjutan dan workshop pembuatan produk ramah lingkungan. Acara ini diharapkan dapat meningkatkan kesadaran masyarakat akan pentingnya menjaga lingkungan melalui pilihan konsumsi yang bijak.</p>',
                'category' => 'event',
                'status' => 'published',
                'is_featured' => false,
                'published_at' => now()->subHours(3),
            ]
        ];

        foreach ($newsData as $data) {
            News::create([
                'title' => $data['title'],
                'slug' => Str::slug($data['title']),
                'excerpt' => $data['excerpt'],
                'content' => $data['content'],
                'image' => 'news/default-news.jpg', // You can add actual images later
                'category' => $data['category'],
                'status' => $data['status'],
                'is_featured' => $data['is_featured'],
                'views' => rand(50, 500),
                'published_at' => $data['published_at'],
                'author_id' => $admin->id,
            ]);
        }

        $this->command->info('Sample news created successfully!');
    }
}