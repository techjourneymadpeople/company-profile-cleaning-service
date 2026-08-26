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

            // Content Management
            'content.view',
            'content.create',
            'content.edit',
            'content.delete',
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
            'content.view',
            'content.create',
            'content.edit',
            'content.delete',
        ];
        $ownerRole->syncPermissions($ownerPermissions);

        // C. Admin (Hanya content & view menu/dashboard)
        $adminRole = Role::firstOrCreate(['name' => 'Admin', 'guard_name' => 'web']);
        $adminPermissions = [
            'access.dashboard',
            'menu.view',
            'content.view',
            'content.create',
            'content.edit',
            'content.delete',
        ];
        $adminRole->syncPermissions($adminPermissions);
    }
}
