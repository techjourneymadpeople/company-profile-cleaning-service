<?php

namespace Tests\Feature;

use App\Models\PageSection;
use App\Models\User;
use Database\Seeders\MenuSeeder;
use Database\Seeders\PageSectionSeeder;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PageSectionManagementTest extends TestCase
{
    use RefreshDatabase;

    protected User $superAdmin;
    protected User $regularUser;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RolePermissionSeeder::class);
        $this->seed(MenuSeeder::class);
        $this->seed(PageSectionSeeder::class);

        $this->superAdmin = User::factory()->create([
            'name' => 'Super Administrator',
            'email' => 'superadmin@bersihsebagian.com',
        ]);
        $this->superAdmin->assignRole('Super Admin');

        $this->regularUser = User::factory()->create([
            'name' => 'Regular User',
            'email' => 'regular@example.com',
        ]);
    }

    public function test_super_admin_can_view_page_sections_index_and_switch_tabs(): void
    {
        $response = $this->actingAs($this->superAdmin)
            ->get(route('admin.page-sections.index', ['page' => 'home']));

        $response->assertOk();
        $response->assertSee('Content Halaman Publik');
        $response->assertSee('Hero Banner Utama');
        $response->assertSee('Value Proposition');
        $response->assertSee('Mengapa Memilih Kami');

        // Switch to services page tab
        $servicesResponse = $this->actingAs($this->superAdmin)
            ->get(route('admin.page-sections.index', ['page' => 'services']));

        $servicesResponse->assertOk();
        $servicesResponse->assertSee('Header Banner Layanan');
        $servicesResponse->assertSee('CTA Box Bawah Layanan');
    }

    public function test_super_admin_can_edit_page_section_content(): void
    {
        $heroSection = PageSection::where('page_key', 'home')->where('section_key', 'hero')->firstOrFail();

        $editResponse = $this->actingAs($this->superAdmin)
            ->get(route('admin.page-sections.edit', $heroSection));

        $editResponse->assertOk();
        $editResponse->assertSee($heroSection->section_name);
        $editResponse->assertSee($heroSection->title);

        $updateResponse = $this->actingAs($this->superAdmin)
            ->put(route('admin.page-sections.update', $heroSection), [
                'section_name' => 'Hero Banner Utama Diperbarui',
                'badge' => 'SPECIAL CLEANING 2026',
                'title' => 'Solusi Higienis Terbaik Nomor 1',
                'subtitle' => 'Deskripsi baru yang telah disesuaikan oleh administrator.',
                'button_text' => 'Pesan Sekarang',
                'button_url' => '/layanan',
                'secondary_button_text' => 'Hubungi Marketing',
                'secondary_button_url' => '/kontak',
                'is_active' => '1',
                'sort_order' => 1,
                'data' => [
                    'trust_points' => [
                        'Sertifikasi ISO 9001:2015',
                        'Tim Ahli Higienitas BNSP',
                    ],
                    'floating_badge_title' => 'Garansi Kepuasan 100%',
                    'floating_badge_subtitle' => 'Pembersihan steril berstandar rumah sakit',
                ],
            ]);

        $updateResponse->assertRedirect(route('admin.page-sections.index', ['page' => 'home']));
        $updateResponse->assertSessionHas('status');

        $heroSection->refresh();
        $this->assertEquals('Hero Banner Utama Diperbarui', $heroSection->section_name);
        $this->assertEquals('SPECIAL CLEANING 2026', $heroSection->badge);
        $this->assertEquals('Solusi Higienis Terbaik Nomor 1', $heroSection->title);
        $this->assertEquals('Pesan Sekarang', $heroSection->button_text);
        $this->assertEquals('Garansi Kepuasan 100%', $heroSection->data['floating_badge_title']);
    }

    public function test_super_admin_can_upload_image_for_section(): void
    {
        Storage::fake('public');

        $heroSection = PageSection::where('page_key', 'home')->where('section_key', 'hero')->firstOrFail();
        $fakeImage = UploadedFile::fake()->image('new_hero_banner.jpg', 1200, 800);

        $response = $this->actingAs($this->superAdmin)
            ->put(route('admin.page-sections.update', $heroSection), [
                'section_name' => $heroSection->section_name,
                'title' => $heroSection->title,
                'is_active' => '1',
                'image_file' => $fakeImage,
            ]);

        $response->assertRedirect();
        $heroSection->refresh();

        $this->assertNotNull($heroSection->image);
        Storage::disk('public')->assertExists($heroSection->image);
    }

    public function test_super_admin_can_toggle_section_status(): void
    {
        $heroSection = PageSection::where('page_key', 'home')->where('section_key', 'hero')->firstOrFail();
        $this->assertTrue($heroSection->is_active);

        $response = $this->actingAs($this->superAdmin)
            ->patch(route('admin.page-sections.toggle-status', $heroSection));

        $response->assertRedirect();
        $heroSection->refresh();
        $this->assertFalse($heroSection->is_active);

        // Toggle back to active
        $this->actingAs($this->superAdmin)
            ->patch(route('admin.page-sections.toggle-status', $heroSection));

        $heroSection->refresh();
        $this->assertTrue($heroSection->is_active);
    }

    public function test_public_homepage_renders_dynamic_section_contents(): void
    {
        $heroSection = PageSection::where('page_key', 'home')->where('section_key', 'hero')->firstOrFail();
        $heroSection->update([
            'badge' => 'TESTING BADGE HERO',
            'title' => 'JUDUL HERO DINAMIS TERBARU',
            'subtitle' => 'Subjudul hero dinamis yang sangat spesifik dan unik.',
        ]);

        $whyUsSection = PageSection::where('page_key', 'home')->where('section_key', 'why_us')->firstOrFail();
        $whyUsSection->update([
            'title' => 'JUDUL WHY US DINAMIS',
        ]);

        $response = $this->get(route('public.home'));

        $response->assertOk();
        $response->assertSee('TESTING BADGE HERO');
        $response->assertSee('JUDUL HERO DINAMIS TERBARU');
        $response->assertSee('Subjudul hero dinamis yang sangat spesifik dan unik.');
        $response->assertSee('JUDUL WHY US DINAMIS');
    }

    public function test_unauthenticated_user_cannot_access_page_section_management(): void
    {
        $response = $this->get(route('admin.page-sections.index'));
        $response->assertRedirect(route('login'));
    }
}
