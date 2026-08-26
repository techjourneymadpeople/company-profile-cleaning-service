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
            [
                'title' => 'Dashboard',
                'route' => 'admin.dashboard',
                'icon' => 'heroicon-o-squares-2x2',
                'permission_name' => 'access.dashboard',
                'order' => 1,
                'is_active' => true,
            ],
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
                'title' => 'Menu',
                'route' => 'admin.menus.index',
                'icon' => 'heroicon-o-list-bullet',
                'permission_name' => 'menu.view',
                'order' => 5,
                'is_active' => true,
            ],
            [
                'title' => 'Pengaturan Sistem',
                'route' => 'admin.settings.index',
                'icon' => 'heroicon-o-cog-6-tooth',
                'permission_name' => 'setting.view',
                'order' => 6,
                'is_active' => true,
            ],
        ];

        foreach ($menus as $item) {
            Menu::updateOrCreate(
                ['title' => $item['title']],
                $item
            );
        }
    }
}
