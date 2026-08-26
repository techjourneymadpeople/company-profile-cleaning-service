<?php

namespace Database\Seeders;

use App\Models\PageSection;
use Illuminate\Database\Seeder;

class PageSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sections = [
            // ==========================================
            // 1. HOME (BERANDA)
            // ==========================================
            [
                'page_key' => 'home',
                'section_key' => 'hero',
                'section_name' => 'Hero Banner Utama',
                'badge' => 'CLEAN SPACE, BETTER LIFE',
                'title' => 'Kebersihan Adalah Komitmen Kami',
                'subtitle' => 'Bersih Sebagian Dari Iman Cleaning Service menyediakan layanan kebersihan profesional untuk rumah, kantor, gedung bertingkat, dan industri dengan standar mutu terbaik.',
                'button_text' => 'Lihat Layanan Kami',
                'button_url' => '/layanan',
                'secondary_button_text' => 'Minta Penawaran Harga',
                'secondary_button_url' => '/kontak',
                'image' => 'https://images.unsplash.com/photo-1581578731548-c64695cc6952?auto=format&fit=crop&w=800&q=80',
                'data' => [
                    'trust_points' => [
                        'Sertifikasi ISO 9001',
                        'Tenaga Kerja BNSP',
                    ],
                    'floating_badge_title' => 'Garansi Kebersihan 100%',
                    'floating_badge_subtitle' => 'Standar higienitas tinggi & chemical ramah lingkungan',
                ],
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'page_key' => 'home',
                'section_key' => 'usp',
                'section_name' => 'Value Proposition (3 Nilai Unggulan)',
                'badge' => 'KEUNGGULAN',
                'title' => 'Keunggulan Layanan Kami',
                'subtitle' => 'Tiga pilar utama dalam memberikan pelayanan kebersihan prima.',
                'data' => [
                    'cards' => [
                        [
                            'icon' => 'heroicon-o-shield-check',
                            'title' => 'Profesional & Terpercaya',
                            'description' => 'Tim kami terlatih, berpengalaman, dan bekerja dengan standar keselamatan & SOP tinggi.',
                        ],
                        [
                            'icon' => 'heroicon-o-check-badge',
                            'title' => 'Produk Aman & Ramah Lingkungan',
                            'description' => 'Menggunakan chemical bersertifikat yang ramah lingkungan dan aman bagi pernapasan.',
                        ],
                        [
                            'icon' => 'heroicon-o-clock',
                            'title' => 'Layanan Fleksibel',
                            'description' => 'Siap melayani kebutuhan pembersihan rutin harian, mingguan, maupun panggilan darurat.',
                        ],
                    ],
                ],
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'page_key' => 'home',
                'section_key' => 'counters',
                'section_name' => 'Bar Statistik & Pencapaian',
                'badge' => 'STATISTIK',
                'title' => 'Angka Pencapaian Prestasi Kami',
                'subtitle' => 'Statistik real-time komitmen kebersihan dan kepuasan mitra.',
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'page_key' => 'home',
                'section_key' => 'why_us',
                'section_name' => 'Mengapa Memilih Kami (Why Us)',
                'badge' => 'KEUNGGULAN UTAMA',
                'title' => 'Mengapa Memilih Bersih Sebagian?',
                'subtitle' => 'Kami mengutamakan standar higienitas tertinggi, tenaga kerja terlatih, serta chemical ramah lingkungan untuk kenyamanan dan kesehatan fasilitas Anda.',
                'data' => [
                    'cards' => [
                        [
                            'badge' => 'Standar Global',
                            'title' => 'Kualitas Teruji & Terstandar',
                            'description' => 'Mengikuti panduan manajemen mutu ISO 9001:2015 dan SOP kebersihan internasional yang ketat.',
                        ],
                        [
                            'badge' => 'SDM Unggul',
                            'title' => 'Tenaga Kerja Tersertifikasi',
                            'description' => 'Seluruh petugas kebersihan kami telah melalui seleksi ketat dan sertifikasi BNSP resmi.',
                        ],
                        [
                            'badge' => 'Eco-Friendly',
                            'title' => 'Chemical & Alat Modern',
                            'description' => 'Menggunakan mesin cleaning berteknologi tinggi dan bahan pembersih ramah lingkungan.',
                        ],
                        [
                            'badge' => 'Respon 24/7',
                            'title' => 'Layanan Cepat & Fleksibel',
                            'description' => 'Dukungan customer service responsif dan siap menerima panggilan darurat deep cleaning kapan saja.',
                        ],
                    ],
                ],
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'page_key' => 'home',
                'section_key' => 'services_highlight',
                'section_name' => 'Highlight Layanan Unggulan',
                'badge' => 'Solusi Terpadu',
                'title' => 'Layanan Kebersihan Unggulan',
                'subtitle' => 'Berbagai paket pembersihan profesional yang dirancang khusus untuk memenuhi kebutuhan instansi dan perorangan.',
                'button_text' => 'Lihat Semua Layanan',
                'button_url' => '/layanan',
                'is_active' => true,
                'sort_order' => 5,
            ],
            [
                'page_key' => 'home',
                'section_key' => 'certificates',
                'section_name' => 'Sertifikasi & Kredensial ISO',
                'badge' => 'JAMINAN MUTU RESMI',
                'title' => 'Standar Mutu & Sertifikasi Legalitas Kami',
                'subtitle' => 'Bukti komitmen nyata dalam menjaga kualitas dan keselamatan kerja berstandar internasional.',
                'is_active' => true,
                'sort_order' => 6,
            ],
            [
                'page_key' => 'home',
                'section_key' => 'portfolio_highlight',
                'section_name' => 'Highlight Galeri Portofolio',
                'badge' => 'HASIL NYATA',
                'title' => 'Portofolio Pengerjaan Before & After',
                'subtitle' => 'Bukti nyata dedikasi dan kualitas pembersihan mendalam oleh tim profesional kami.',
                'button_text' => 'Lihat Semua Portofolio',
                'button_url' => '/mitra-portofolio',
                'is_active' => true,
                'sort_order' => 7,
            ],
            [
                'page_key' => 'home',
                'section_key' => 'clients_highlight',
                'section_name' => 'Mitra & Klien Korporat',
                'badge' => 'Mitra Kami',
                'title' => 'Dipercaya oleh Berbagai Perusahaan & Instansi',
                'subtitle' => 'Bergabung dengan mitra kami dan rasakan layanan kebersihan berkualitas tinggi untuk lingkungan yang lebih bersih dan sehat.',
                'is_active' => true,
                'sort_order' => 8,
            ],
            [
                'page_key' => 'home',
                'section_key' => 'testimonials_highlight',
                'section_name' => 'Testimoni Pelanggan',
                'badge' => 'KATA MEREKA',
                'title' => 'Apa Kata Klien & Mitra Kami?',
                'subtitle' => 'Ulasan nyata dari para pengelola gedung dan kantor yang telah merasakan standar pelayanan prima kami.',
                'is_active' => true,
                'sort_order' => 9,
            ],
            [
                'page_key' => 'home',
                'section_key' => 'articles_highlight',
                'section_name' => 'Edukasi & Berita Terbaru',
                'badge' => 'BLOG & EDUKASI',
                'title' => 'Artikel & Tips Kebersihan Fasilitas',
                'subtitle' => 'Wawasan terkini seputar sanitasi, tata kelola fasilitas, dan tips menjaga kesehatan lingkungan kerja.',
                'button_text' => 'Lihat Semua Artikel',
                'button_url' => '/artikel',
                'is_active' => true,
                'sort_order' => 10,
            ],
            [
                'page_key' => 'home',
                'section_key' => 'cta_banner',
                'section_name' => 'Banner Ajakan Bertindak (CTA Footer)',
                'badge' => 'KONSULTASI GRATIS',
                'title' => 'Siap Mewujudkan Ruang Bersih, Sehat, dan Nyaman?',
                'subtitle' => 'Konsultasikan kebutuhan cleaning service fasilitas Anda sekarang dan dapatkan survei lokasi serta proposal penawaran harga gratis!',
                'button_text' => 'Hubungi Kami via WhatsApp',
                'button_url' => '/kontak',
                'secondary_button_text' => 'Minta Penawaran Resmi (RFQ)',
                'secondary_button_url' => '/kontak',
                'is_active' => true,
                'sort_order' => 11,
            ],

            // ==========================================
            // 2. SERVICES (LAYANAN)
            // ==========================================
            [
                'page_key' => 'services',
                'section_key' => 'header',
                'section_name' => 'Header Banner Layanan',
                'badge' => 'KATALOG LAYANAN',
                'title' => 'Layanan Kami',
                'subtitle' => 'Berbagai layanan kebersihan profesional yang kami sediakan untuk memenuhi kebutuhan Anda.',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'page_key' => 'services',
                'section_key' => 'bottom_cta',
                'section_name' => 'CTA Box Bawah Layanan',
                'badge' => 'BUTUH SOLUSI KUSTOM?',
                'title' => 'Butuh Layanan Kebersihan Profesional?',
                'subtitle' => 'Kami siap membantu Anda menciptakan lingkungan yang bersih, sehat, dan nyaman.',
                'button_text' => 'Hubungi Kami',
                'button_url' => '/kontak',
                'is_active' => true,
                'sort_order' => 2,
            ],

            // ==========================================
            // 3. PORTFOLIO (MITRA & PORTOFOLIO)
            // ==========================================
            [
                'page_key' => 'portfolio',
                'section_key' => 'header',
                'section_name' => 'Header Banner Portofolio',
                'badge' => 'BUKTI KINERJA',
                'title' => 'Mitra Kami & Portofolio Proyek',
                'subtitle' => 'Kami bangga bermitra dengan berbagai korporat, BUMN, dan institusi terkemuka untuk menjaga standar kebersihan fasilitas mereka.',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'page_key' => 'portfolio',
                'section_key' => 'clients_intro',
                'section_name' => 'Intro Mitra & Klien',
                'badge' => 'Trusted By',
                'title' => 'Deretan Klien & Mitra Korporat',
                'subtitle' => 'Deretan perusahaan terkemuka yang telah mempercayakan pengelolaan kebersihan gedungnya kepada kami.',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'page_key' => 'portfolio',
                'section_key' => 'case_studies_intro',
                'section_name' => 'Intro Studi Kasus Before & After',
                'badge' => 'Studi Kasus & Restorasi',
                'title' => 'Galeri Hasil Kerja Sebelum & Sesudah',
                'subtitle' => 'Dokumentasi transparansi hasil pengerjaan pembersihan mendalam tim kami di berbagai sektor properti.',
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'page_key' => 'portfolio',
                'section_key' => 'bottom_cta',
                'section_name' => 'CTA Box Bawah Portofolio',
                'badge' => 'KERJASAMA SEKARANG',
                'title' => 'Tertarik Menjadi Bagian dari Mitra Puas Kami?',
                'subtitle' => 'Dapatkan layanan cleaning berstandar internasional dengan survei lokasi dan konsultasi tanpa biaya.',
                'button_text' => 'Hubungi Tim Kami Sekarang',
                'button_url' => '/kontak',
                'is_active' => true,
                'sort_order' => 4,
            ],

            // ==========================================
            // 4. ARTICLES (ARTIKEL & BERITA)
            // ==========================================
            [
                'page_key' => 'articles',
                'section_key' => 'header',
                'section_name' => 'Header Banner Artikel',
                'badge' => 'PUSAT EDUKASI',
                'title' => 'Edukasi Kebersihan & Wawasan Fasilitas',
                'subtitle' => 'Kumpulan artikel edukasi kebersihan, tips manajemen fasilitas gedung, dan kabar aktivitas terbaru perusahaan.',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'page_key' => 'articles',
                'section_key' => 'newsletter_cta',
                'section_name' => 'CTA Box Bawah Artikel',
                'badge' => 'KONSULTASI GRATIS',
                'title' => 'Ingin Menerapkan Standar Kebersihan Terbaik di Gedung Anda?',
                'subtitle' => 'Hubungi kami hari ini untuk berdiskusi langsung dengan tim konsultan kebersihan profesional.',
                'button_text' => 'Minta Penawaran',
                'button_url' => '/kontak',
                'is_active' => true,
                'sort_order' => 2,
            ],

            // ==========================================
            // 5. CONTACT (KONTAK)
            // ==========================================
            [
                'page_key' => 'contact',
                'section_key' => 'header',
                'section_name' => 'Header Banner Kontak',
                'badge' => 'HUBUNGI KAMI',
                'title' => 'Hubungi Kami & Minta Penawaran',
                'subtitle' => 'Tim representatif kami siap merespons kebutuhan kebersihan fasilitas Anda dengan cepat, ramah, dan profesional.',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'page_key' => 'contact',
                'section_key' => 'contact_info',
                'section_name' => 'Info Kontak & Jam Operasional',
                'badge' => 'LAYANAN RESPONSIF',
                'title' => 'Informasi Kantor Pusat',
                'subtitle' => 'Silakan hubungi kami melalui saluran komunikasi resmi berikut atau kunjungi kantor operasional kami.',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'page_key' => 'contact',
                'section_key' => 'form_section',
                'section_name' => 'Form Permintaan Penawaran (RFQ)',
                'badge' => 'FORMULIR PENAWARAN CEPAT',
                'title' => 'Kirim Permintaan Penawaran (RFQ)',
                'subtitle' => 'Isi data kebutuhan kebersihan gedung atau ruangan Anda, kami akan segera mengirimkan estimasi penawaran resmi.',
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'page_key' => 'contact',
                'section_key' => 'map_section',
                'section_name' => 'Lokasi Kantor & Peta',
                'badge' => 'LOKASI KAMI',
                'title' => 'Kunjungi Kantor Kami',
                'subtitle' => 'Peta lokasi kantor operasional dan pusat koordinasi tim lapangan kami.',
                'is_active' => true,
                'sort_order' => 4,
            ],
        ];

        foreach ($sections as $sec) {
            PageSection::updateOrCreate(
                [
                    'page_key' => $sec['page_key'],
                    'section_key' => $sec['section_key'],
                ],
                $sec
            );
        }
    }
}
