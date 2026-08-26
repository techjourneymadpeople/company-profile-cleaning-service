<?php

namespace Tests\Feature;

use App\Models\Menu;
use App\Models\User;
use App\Settings\BrandSettings;
use App\Settings\ContactSettings;
use App\Settings\SeoSettings;
use App\Settings\SocialMediaSettings;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class MenuAndSettingsTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }

    public function test_super_admin_can_perform_crud_on_menus(): void
    {
        $superAdmin = User::where('email', 'superadmin@bersihsebagian.com')->first();
        $this->actingAs($superAdmin);

        // 1. Index
        $response = $this->get(route('admin.menus.index'));
        $response->assertStatus(200);
        $response->assertSee('Dynamic Menu Management');
        $response->assertSee('Dashboard');

        // 2. Create Page
        $createResponse = $this->get(route('admin.menus.create'));
        $createResponse->assertStatus(200);
        $createResponse->assertSee('Formulir Tambah Menu Navigasi');

        // 3. Store Menu
        $storeResponse = $this->post(route('admin.menus.store'), [
            'title' => 'Layanan Cleaning',
            'route' => 'admin.services.index',
            'icon' => 'heroicon-o-sparkles',
            'permission_name' => 'access.dashboard',
            'order' => 10,
            'is_active' => true,
        ]);
        $storeResponse->assertRedirect(route('admin.menus.index'));

        $menu = Menu::where('title', 'Layanan Cleaning')->first();
        $this->assertNotNull($menu);
        $this->assertEquals('heroicon-o-sparkles', $menu->icon);
        $this->assertEquals(10, $menu->order);

        // 4. Edit Menu
        $editResponse = $this->get(route('admin.menus.edit', $menu));
        $editResponse->assertStatus(200);
        $editResponse->assertSee('Edit Menu: Layanan Cleaning');

        $updateResponse = $this->put(route('admin.menus.update', $menu), [
            'title' => 'Layanan & Paket',
            'route' => 'admin.services.index',
            'icon' => 'heroicon-o-sparkles',
            'order' => 12,
            'is_active' => true,
        ]);
        $updateResponse->assertRedirect(route('admin.menus.index'));

        $menu->refresh();
        $this->assertEquals('Layanan & Paket', $menu->title);
        $this->assertEquals(12, $menu->order);

        // 5. Delete Menu
        $deleteResponse = $this->delete(route('admin.menus.destroy', $menu));
        $deleteResponse->assertRedirect(route('admin.menus.index'));
        $this->assertNull(Menu::where('title', 'Layanan & Paket')->first());
    }

    public function test_super_admin_can_update_system_settings(): void
    {
        Storage::fake('public');

        $superAdmin = User::where('email', 'superadmin@bersihsebagian.com')->first();
        $this->actingAs($superAdmin);

        // 1. Settings Index
        $response = $this->get(route('admin.settings.index'));
        $response->assertStatus(200);
        $response->assertSee('System Settings');
        $response->assertSee('Identitas Brand');

        // 2. Update Brand Settings
        $brandUpdateResponse = $this->put(route('admin.settings.brand.update'), [
            'site_name' => 'PT Bersih Berkah Sejahtera',
            'site_tagline' => 'Solusi Kebersihan Terbaik',
            'site_logo' => UploadedFile::fake()->image('logo.png', 200, 200),
        ]);
        $brandUpdateResponse->assertRedirect(route('admin.settings.index', ['tab' => 'brand']));

        $brandSettings = app(BrandSettings::class);
        $this->assertEquals('PT Bersih Berkah Sejahtera', $brandSettings->site_name);
        $this->assertNotNull($brandSettings->site_logo);
        Storage::disk('public')->assertExists($brandSettings->site_logo);

        // 3. Update Contact Settings
        $contactUpdateResponse = $this->put(route('admin.settings.contact.update'), [
            'phone' => '021-99887766',
            'whatsapp' => '081234567899',
            'email' => 'contact@bersihsebagian.com',
            'address' => 'Jl. Sudirman No. 88, Jakarta Selatan',
            'google_maps_embed' => 'https://maps.google.com/test',
            'operating_hours' => 'Senin - Sabtu: 08:00 - 18:00 WIB',
        ]);
        $contactUpdateResponse->assertRedirect(route('admin.settings.index', ['tab' => 'contact']));

        $contactSettings = app(ContactSettings::class);
        $this->assertEquals('021-99887766', $contactSettings->phone);
        $this->assertEquals('081234567899', $contactSettings->whatsapp);

        // 4. Update Social Media Settings
        $socialUpdateResponse = $this->put(route('admin.settings.social.update'), [
            'instagram' => 'https://instagram.com/bersihsebagian.id',
            'facebook' => 'https://facebook.com/bersihsebagian.id',
        ]);
        $socialUpdateResponse->assertRedirect(route('admin.settings.index', ['tab' => 'social']));

        $socialSettings = app(SocialMediaSettings::class);
        $this->assertEquals('https://instagram.com/bersihsebagian.id', $socialSettings->instagram);

        // 5. Update SEO Settings
        $seoUpdateResponse = $this->put(route('admin.settings.seo.update'), [
            'meta_title' => 'Jasa Cleaning Service Profesional Terbaik',
            'meta_description' => 'Layanan kebersihan kantor dan rumah terpercaya.',
            'meta_keywords' => 'cleaning, cuci kasur, poles marmer',
            'canonical_url' => 'https://bersihsebagian.com',
        ]);
        $seoUpdateResponse->assertRedirect(route('admin.settings.index', ['tab' => 'seo']));

        $seoSettings = app(SeoSettings::class);
        $this->assertEquals('Jasa Cleaning Service Profesional Terbaik', $seoSettings->meta_title);
    }
}
