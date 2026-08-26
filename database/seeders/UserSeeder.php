<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Super Admin User
        $superAdmin = User::firstOrCreate(
            ['email' => 'superadmin@bersihsebagian.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        $superAdmin->syncRoles(['Super Admin']);

        // 2. Owner User
        $owner = User::firstOrCreate(
            ['email' => 'owner@bersihsebagian.com'],
            [
                'name' => 'Owner',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        $owner->syncRoles(['Owner']);

        // 3. Admin (Content) User
        $admin = User::firstOrCreate(
            ['email' => 'admin@bersihsebagian.com'],
            [
                'name' => 'Admin Content',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        $admin->syncRoles(['Admin']);
    }
}
