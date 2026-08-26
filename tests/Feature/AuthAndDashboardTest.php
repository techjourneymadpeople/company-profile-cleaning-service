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
        $response->assertSee('Masuk ke Dashboard');
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
}
