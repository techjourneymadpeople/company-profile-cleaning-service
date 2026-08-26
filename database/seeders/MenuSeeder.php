<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menus = [
            // 1. Dashboard
            [
                'title' => 'Dashboard',
                'route' => 'admin.dashboard',
                'icon' => 'heroicon-o-squares-2x2',
                'permission_name' => 'access.dashboard',
                'order' => 1,
                'is_active' => true,
            ],

            // 2. User dan Akses Kontrol
            [
                'title' => 'User Management',
                'route' => 'admin.users.index',
                'icon' => 'heroicon-o-users',
                'permission_name' => 'user.view',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Role',
                'route' => 'admin.roles.index',
                'icon' => 'heroicon-o-shield-check',
                'permission_name' => 'role.view',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Permission',
                'route' => 'admin.permissions.index',
                'icon' => 'heroicon-o-key',
                'permission_name' => 'permission.view',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'title' => 'Menu Navigasi',
                'route' => 'admin.menus.index',
                'icon' => 'heroicon-o-list-bullet',
                'permission_name' => 'menu.view',
                'order' => 5,
                'is_active' => true,
            ],

            // 3. Content
            [
                'title' => 'Solusi & Layanan',
                'route' => 'admin.services.index',
                'icon' => 'heroicon-o-sparkles',
                'permission_name' => 'service.view',
                'order' => 6,
                'is_active' => true,
            ],
            [
                'title' => 'Galeri Hasil Kerja',
                'route' => 'admin.projects.index',
                'icon' => 'heroicon-o-photo',
                'permission_name' => 'project.view',
                'order' => 7,
                'is_active' => true,
            ],
            [
                'title' => 'Klien & Mitra',
                'route' => 'admin.clients.index',
                'icon' => 'heroicon-o-building-office-2',
                'permission_name' => 'client.view',
                'order' => 8,
                'is_active' => true,
            ],
            [
                'title' => 'Sertifikasi ISO',
                'route' => 'admin.certificates.index',
                'icon' => 'heroicon-o-academic-cap',
                'permission_name' => 'certificate.view',
                'order' => 9,
                'is_active' => true,
            ],
            [
                'title' => 'Angka Pencapaian',
                'route' => 'admin.statistics.index',
                'icon' => 'heroicon-o-chart-bar',
                'permission_name' => 'statistic.view',
                'order' => 10,
                'is_active' => true,
            ],
            [
                'title' => 'Testimoni Klien',
                'route' => 'admin.testimonials.index',
                'icon' => 'heroicon-o-chat-bubble-bottom-center-text',
                'permission_name' => 'testimonial.view',
                'order' => 11,
                'is_active' => true,
            ],
            [
                'title' => 'Berita & Artikel',
                'route' => 'admin.articles.index',
                'icon' => 'heroicon-o-newspaper',
                'permission_name' => 'article.view',
                'order' => 12,
                'is_active' => true,
            ],
            [
                'title' => 'Kotak Masuk Leads',
                'route' => 'admin.inquiries.index',
                'icon' => 'heroicon-o-inbox-arrow-down',
                'permission_name' => 'inquiry.view',
                'order' => 13,
                'is_active' => true,
            ],

            // 4. Pengaturan
            [
                'title' => 'Pengaturan Sistem',
                'route' => 'admin.settings.index',
                'icon' => 'heroicon-o-cog-6-tooth',
                'permission_name' => 'setting.view',
                'order' => 14,
                'is_active' => true,
            ],
        ];

        foreach ($menus as $menuData) {
            Menu::updateOrCreate(
                ['title' => $menuData['title']],
                $menuData
            );
        }
    }
}
