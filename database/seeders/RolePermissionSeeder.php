<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // 1. Define all permissions
        $permissions = [
            // Dashboard
            'access.dashboard',

            // User Management
            'user.view',
            'user.create',
            'user.edit',
            'user.delete',

            // Role Management
            'role.view',
            'role.create',
            'role.edit',
            'role.delete',

            // Permission Management
            'permission.view',
            'permission.create',
            'permission.edit',
            'permission.delete',

            // Menu Management
            'menu.view',
            'menu.create',
            'menu.edit',
            'menu.delete',

            // Settings Management
            'setting.view',
            'setting.update',

            // 1. Solusi & Layanan (Services)
            'service.view',
            'service.create',
            'service.edit',
            'service.delete',

            // 2. Galeri Hasil Kerja Before & After (Projects)
            'project.view',
            'project.create',
            'project.edit',
            'project.delete',

            // 3. Klien & Mitra (Clients)
            'client.view',
            'client.create',
            'client.edit',
            'client.delete',

            // 4. Akreditasi & Sertifikasi ISO (Certificates)
            'certificate.view',
            'certificate.create',
            'certificate.edit',
            'certificate.delete',

            // 5. Angka Pencapaian (Statistics)
            'statistic.view',
            'statistic.create',
            'statistic.edit',
            'statistic.delete',

            // 6. Testimoni Klien (Testimonials)
            'testimonial.view',
            'testimonial.create',
            'testimonial.edit',
            'testimonial.delete',

            // 7. Berita & Artikel (Articles)
            'article.view',
            'article.create',
            'article.edit',
            'article.delete',

            // 8. Kotak Masuk Permintaan Penawaran (Inquiries / Leads)
            'inquiry.view',
            'inquiry.update',
            'inquiry.delete',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        // 2. Create Roles and Assign Permissions

        // A. Super Admin (Bisa Semua)
        $superAdminRole = Role::firstOrCreate(['name' => 'Super Admin', 'guard_name' => 'web']);
        $superAdminRole->syncPermissions(Permission::all());

        // B. Owner (Bisa Semua selain teknis: role & permission)
        $ownerRole = Role::firstOrCreate(['name' => 'Owner', 'guard_name' => 'web']);
        $ownerPermissions = [
            'access.dashboard',
            'user.view',
            'user.create',
            'user.edit',
            'user.delete',
            'menu.view',
            'menu.create',
            'menu.edit',
            'menu.delete',
            'setting.view',
            'setting.update',
            // Content modules
            'service.view', 'service.create', 'service.edit', 'service.delete',
            'project.view', 'project.create', 'project.edit', 'project.delete',
            'client.view', 'client.create', 'client.edit', 'client.delete',
            'certificate.view', 'certificate.create', 'certificate.edit', 'certificate.delete',
            'statistic.view', 'statistic.create', 'statistic.edit', 'statistic.delete',
            'testimonial.view', 'testimonial.create', 'testimonial.edit', 'testimonial.delete',
            'article.view', 'article.create', 'article.edit', 'article.delete',
            'inquiry.view', 'inquiry.update', 'inquiry.delete',
        ];
        $ownerRole->syncPermissions($ownerPermissions);

        // C. Admin (Konten, Leads, dan Dashboard/Menu)
        $adminRole = Role::firstOrCreate(['name' => 'Admin', 'guard_name' => 'web']);
        $adminPermissions = [
            'access.dashboard',
            'menu.view',
            // Content modules
            'service.view', 'service.create', 'service.edit', 'service.delete',
            'project.view', 'project.create', 'project.edit', 'project.delete',
            'client.view', 'client.create', 'client.edit', 'client.delete',
            'certificate.view', 'certificate.create', 'certificate.edit', 'certificate.delete',
            'statistic.view', 'statistic.create', 'statistic.edit', 'statistic.delete',
            'testimonial.view', 'testimonial.create', 'testimonial.edit', 'testimonial.delete',
            'article.view', 'article.create', 'article.edit', 'article.delete',
            'inquiry.view', 'inquiry.update', 'inquiry.delete',
        ];
        $adminRole->syncPermissions($adminPermissions);
    }
}
