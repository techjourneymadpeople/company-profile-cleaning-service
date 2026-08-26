<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthAndDashboardTest extends TestCase
{
    public function test_home_page_is_accessible_and_shows_guest_buttons(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Admin Panel');
        $response->assertSee('Masuk');
    }

    public function test_login_page_renders_successfully(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertSee('Sign In');
        $response->assertSee('Alamat Email');
    }

    public function test_user_can_login_and_access_dashboard(): void
    {
        $user = User::where('email', 'superadmin@bersihsebagian.com')->first();
        if (!$user) {
            $this->artisan('db:seed');
            $user = User::where('email', 'superadmin@bersihsebagian.com')->first();
        }

        $response = $this->post('/login', [
            'email' => 'superadmin@bersihsebagian.com',
            'password' => 'password',
        ]);

        $response->assertRedirect('/dashboard');
        $this->assertAuthenticatedAs($user);

        $dashboardResponse = $this->actingAs($user)->get('/dashboard');
        $dashboardResponse->assertStatus(200);
        $dashboardResponse->assertSee('Super Admin');
        $dashboardResponse->assertSee('Dashboard Utama');
    }

    public function test_registration_and_two_factor_are_disabled(): void
    {
        $registerResponse = $this->get('/register');
        $registerResponse->assertStatus(404);

        $twoFactorResponse = $this->get('/two-factor-challenge');
        $twoFactorResponse->assertStatus(404);
    }

    public function test_super_admin_can_see_all_dynamic_menus(): void
    {
        $superAdmin = User::where('email', 'superadmin@bersihsebagian.com')->first();
        $response = $this->actingAs($superAdmin)->get('/dashboard');
        $response->assertStatus(200);
        $response->assertSee('Dashboard');
        $response->assertSee('User Management');
        $response->assertSee('Role');
        $response->assertSee('Permission');
        $response->assertSee('Menu');
        $response->assertSee('Pengaturan Sistem');
    }

    public function test_owner_does_not_see_technical_role_and_permission_menus(): void
    {
        $owner = User::where('email', 'owner@bersihsebagian.com')->first();
        $response = $this->actingAs($owner)->get('/dashboard');
        $response->assertStatus(200);
        $response->assertSee('Dashboard');
        $response->assertSee('User Management');
        $response->assertSee('Menu');
        $response->assertSee('Pengaturan Sistem');
        $response->assertDontSee('Roles & Permissions');
    }

    public function test_admin_only_sees_permitted_menus(): void
    {
        $admin = User::where('email', 'admin@bersihsebagian.com')->first();
        $response = $this->actingAs($admin)->get('/dashboard');
        $response->assertStatus(200);
        $response->assertSee('Dashboard');
        $response->assertSee('Menu');
        $response->assertDontSee('User Management');
        $response->assertDontSee('Pengaturan Sistem');
    }
}
