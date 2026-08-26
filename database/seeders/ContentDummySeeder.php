<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Certificate;
use App\Models\Client;
use App\Models\Inquiry;
use App\Models\Project;
use App\Models\Service;
use App\Models\Statistic;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Database\Seeder;

class ContentDummySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = User::first();

        // 1. Solusi & Layanan
        $services = [
            [
                'name' => 'Commercial & Office Cleaning',
                'slug' => 'commercial-office-cleaning',
                'category' => 'Kebersihan',
                'excerpt' => 'Layanan pembersihan menyeluruh untuk gedung perkantoran, pusat perbelanjaan, dan instansi bisnis.',
                'description' => '<p>Layanan <strong>Commercial & Office Cleaning</strong> kami dirancang untuk menjaga higienitas dan kenyamanan lingkungan kerja. Menggunakan peralatan standar industri serta chemical ramah lingkungan yang tersertifikasi.</p>',
                'icon' => 'heroicon-o-building-office',
                'is_active' => true,
            ],
            [
                'name' => 'Deep Cleaning & Sanitasi Kasur/Sofa',
                'slug' => 'deep-cleaning-sanitasi',
                'category' => 'Kebersihan',
                'excerpt' => 'Pembersihan mendalam ekstraksi debu, tungau, dan noda membandel pada sofa, kasur, serta karpet.',
                'description' => '<p>Metode <strong>Hydro Vacuum Extraction</strong> berkekuatan tinggi efektif mengangkat 99.9% tungau dan bakteri pada perabotan berbahan kain/busa tanpa merusak serat kain.</p>',
                'icon' => 'heroicon-o-sparkles',
                'is_active' => true,
            ],
            [
                'name' => 'Pest Control & Fogging Disinfektan',
                'slug' => 'pest-control-fogging',
                'category' => 'Keamanan & Higienitas',
                'excerpt' => 'Pengendalian hama terpadu (rayap, tikus, kecoa, nyamuk) dan sterilisasi ruangan dari virus.',
                'description' => '<p>Sistem pengendalian hama ramah lingkungan dengan teknik umpan biologis dan pengasapan cold fogging yang aman untuk penghuni dan aset properti.</p>',
                'icon' => 'heroicon-o-shield-check',
                'is_active' => true,
            ],
            [
                'name' => 'Facility Management & Outsourcing',
                'slug' => 'facility-management-outsourcing',
                'category' => 'Manajemen Fasilitas',
                'excerpt' => 'Penyediaan tenaga kerja kebersihan profesional terdidik, terlatih, dan berlisensi BNSP.',
                'description' => '<p>Solusi terpadu alih daya tenaga kerja kebersihan lengkap dengan manajemen pengawasan, absensi digital, dan evaluasi berkala SLA kualitas kerja.</p>',
                'icon' => 'heroicon-o-users',
                'is_active' => true,
            ],
        ];

        foreach ($services as $serviceData) {
            Service::updateOrCreate(['slug' => $serviceData['slug']], $serviceData);
        }

        // 2. Galeri Hasil Kerja Before & After
        $serviceOffice = Service::where('slug', 'commercial-office-cleaning')->first();
        $serviceDeep = Service::where('slug', 'deep-cleaning-sanitasi')->first();

        $projects = [
            [
                'title' => 'Restorasi Karpet Ballroom Hotel Bintang 5',
                'service_id' => $serviceDeep?->id,
                'category' => 'Deep Cleaning Karpet',
                'description' => 'Pembersihan noda tumpahan kopi dan lumpur pada area ballroom seluas 850m² dalam durasi 12 jam.',
                'completed_at' => now()->subDays(15),
            ],
            [
                'title' => 'General Cleaning Gedung Perkantoran Sudirman',
                'service_id' => $serviceOffice?->id,
                'category' => 'Commercial Cleaning',
                'description' => 'Pembersihan kaca luar ketinggian gedung bertingkat 20 lantai dan sanitasi lantai marmer lobi.',
                'completed_at' => now()->subDays(30),
            ],
        ];

        foreach ($projects as $proj) {
            Project::updateOrCreate(['title' => $proj['title']], $proj);
        }

        // 3. Klien & Mitra
        $clients = [
            ['name' => 'PT Indofood CBP Makmur', 'sort_order' => 1, 'is_visible' => true],
            ['name' => 'RS Antam Medika Jakarta', 'sort_order' => 2, 'is_visible' => true],
            ['name' => 'Bank Mandiri Corporate Office', 'sort_order' => 3, 'is_visible' => true],
            ['name' => 'Astra International Tower', 'sort_order' => 4, 'is_visible' => true],
            ['name' => 'Universitas Indonesia Facility', 'sort_order' => 5, 'is_visible' => true],
        ];

        foreach ($clients as $client) {
            Client::updateOrCreate(['name' => $client['name']], $client);
        }

        // 4. Akreditasi & Sertifikasi ISO
        $certificates = [
            [
                'name' => 'ISO 9001:2015 Quality Management System',
                'issuer' => 'Bureau Veritas Certification',
                'license_number' => 'ID-QMS-2024-0988',
                'valid_until' => now()->addYears(2),
            ],
            [
                'name' => 'Sertifikat Standar ASPPHAMI (Pengendalian Hama)',
                'issuer' => 'Asosiasi Perusahaan Pengendalian Hama Indonesia',
                'license_number' => 'ASPPHAMI-DKI-2025-114',
                'valid_until' => now()->addYears(3),
            ],
            [
                'name' => 'ISO 45001:2018 K3 Lingkungan Kerja',
                'issuer' => 'Sucofindo International Certification',
                'license_number' => 'ISO-OHSAS-2024-551',
                'valid_until' => now()->addYears(2),
            ],
        ];

        foreach ($certificates as $cert) {
            Certificate::updateOrCreate(['name' => $cert['name']], $cert);
        }

        // 5. Angka Pencapaian / Counters
        $statistics = [
            ['label' => 'Tenaga Kerja Bersertifikasi BNSP', 'value' => '3,500+', 'icon' => 'heroicon-o-user-group', 'sort_order' => 1],
            ['label' => 'Klien Korporat & Institusi', 'value' => '450+', 'icon' => 'heroicon-o-building-office', 'sort_order' => 2],
            ['label' => 'Kota Jangkauan Layanan', 'value' => '28+', 'icon' => 'heroicon-o-map-pin', 'sort_order' => 3],
            ['label' => 'Tingkat Kepuasan Pelanggan (SLA)', 'value' => '99.4%', 'icon' => 'heroicon-o-star', 'sort_order' => 4],
        ];

        foreach ($statistics as $stat) {
            Statistic::updateOrCreate(['label' => $stat['label']], $stat);
        }

        // 6. Testimoni Klien
        $testimonials = [
            [
                'name' => 'Bambang Prasetyo',
                'designation_company' => 'Head of Facility Management - Astra Group',
                'quote' => 'Pelayanan sangat profesional, staf disiplin, dan SLA kebersihan gedung kantor kami meningkat drastis sejak bekerja sama.',
                'rating' => 5,
            ],
            [
                'name' => 'Dr. Rina Suryani',
                'designation_company' => 'Direktur Operasional - RS Antam Medika',
                'quote' => 'Standar sanitasi rumah sakit sangat ketat, dan tim Bersih Sebagian mampu memenuhi audit higienitas medis dengan sempurna.',
                'rating' => 5,
            ],
            [
                'name' => 'Hendra Setiawan',
                'designation_company' => 'Building Manager - Menara Thamrin',
                'quote' => 'Respons sangat cepat saat ada kebutuhan emergency cleaning. Sangat direkomendasikan untuk properti komersial.',
                'rating' => 5,
            ],
        ];

        foreach ($testimonials as $testi) {
            Testimonial::updateOrCreate(['name' => $testi['name']], $testi);
        }

        // 7. Berita & Artikel
        $articles = [
            [
                'user_id' => $superAdmin?->id,
                'title' => '5 Tips Menjaga Kebersihan Udara Ruang Kantor untuk Cegah Sindrom Sakit Gedung',
                'slug' => 'tips-menjaga-kebersihan-udara-kantor',
                'category' => 'Edukasi Kebersihan',
                'excerpt' => 'Pelajari cara efektif mencegah sick building syndrome melalui perawatan HVAC berkala dan pembersihan karpet terjadwal.',
                'content' => '<p>Kualitas udara dalam ruang kerja sangat mempengaruhi produktivitas karyawan. Penumpukan debu mikro pada karpet dan filter AC menjadi salah satu pemicu utama alergi.</p>',
                'status' => 'published',
                'published_at' => now()->subDays(5),
            ],
            [
                'user_id' => $superAdmin?->id,
                'title' => 'PT Bersih Sebagian Dari Iman Raih Sertifikasi ISO 9001:2015 Mutu Pelayanan',
                'slug' => 'raih-sertifikasi-iso-9001-2015',
                'category' => 'Berita Perusahaan',
                'excerpt' => 'Bukti komitmen perusahaan dalam menghadirkan standar mutu kebersihan bertaraf internasional bagi seluruh mitra B2B.',
                'content' => '<p>Sebagai bagian dari komitmen continuous improvement, kami resmi meraih sertifikasi sistem manajemen mutu ISO 9001:2015.</p>',
                'status' => 'published',
                'published_at' => now()->subDays(12),
            ],
        ];

        foreach ($articles as $art) {
            Article::updateOrCreate(['slug' => $art['slug']], $art);
        }

        // 8. Kotak Masuk Permintaan Penawaran (Inquiries / Leads)
        $inquiries = [
            [
                'name' => 'Budi Santoso',
                'email' => 'budi.santoso@wika.co.id',
                'phone' => '081198765432',
                'company_name' => 'PT Wijaya Karya Project',
                'service_requested' => 'Commercial & Office Cleaning',
                'message' => 'Mohon penawaran harga untuk paket general cleaning pasca renovasi gedung 4 lantai di BSD City seluas 2400m².',
                'status' => 'new',
            ],
            [
                'name' => 'Dewi Anggraini',
                'email' => 'dewi@grandhotel.com',
                'phone' => '081234567811',
                'company_name' => 'Grand Orchid Hotel',
                'service_requested' => 'Deep Cleaning & Sanitasi',
                'message' => 'Kami memerlukan pencucian karpet kamar hotel berkala sebanyak 60 kamar per bulan.',
                'status' => 'contacted',
            ],
        ];

        foreach ($inquiries as $inq) {
            Inquiry::updateOrCreate(['email' => $inq['email']], $inq);
        }
    }
}
