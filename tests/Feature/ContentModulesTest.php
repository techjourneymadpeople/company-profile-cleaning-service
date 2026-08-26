<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\Certificate;
use App\Models\Client;
use App\Models\Inquiry;
use App\Models\Project;
use App\Models\Service;
use App\Models\Statistic;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ContentModulesTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }

    public function test_super_admin_can_perform_crud_on_services(): void
    {
        Storage::fake('public');
        $superAdmin = User::where('email', 'superadmin@bersihsebagian.com')->first();
        $this->actingAs($superAdmin);

        // Index
        $response = $this->get(route('admin.services.index'));
        $response->assertStatus(200);
        $response->assertSee('Services Management');

        // Store
        $storeResponse = $this->post(route('admin.services.store'), [
            'name' => 'General Cleaning Pabrik',
            'category' => 'Kebersihan',
            'excerpt' => 'Pembersihan area industrial pabrik.',
            'description' => '<p>Detail deskripsi pabrik.</p>',
            'icon' => 'heroicon-o-building-storefront',
            'thumbnail' => UploadedFile::fake()->image('thumb.jpg'),
            'is_active' => '1',
        ]);
        $storeResponse->assertRedirect(route('admin.services.index'));

        $service = Service::where('name', 'General Cleaning Pabrik')->first();
        $this->assertNotNull($service);
        $this->assertEquals('general-cleaning-pabrik', $service->slug);

        // Update
        $updateResponse = $this->put(route('admin.services.update', $service), [
            'name' => 'General Cleaning Pabrik & Gudang',
            'category' => 'Kebersihan',
            'is_active' => '1',
        ]);
        $updateResponse->assertRedirect(route('admin.services.index'));

        $service->refresh();
        $this->assertEquals('General Cleaning Pabrik & Gudang', $service->name);

        // Delete
        $deleteResponse = $this->delete(route('admin.services.destroy', $service));
        $deleteResponse->assertRedirect(route('admin.services.index'));
        $this->assertNull(Service::where('name', 'General Cleaning Pabrik & Gudang')->first());
    }

    public function test_super_admin_can_perform_crud_on_projects(): void
    {
        Storage::fake('public');
        $superAdmin = User::where('email', 'superadmin@bersihsebagian.com')->first();
        $this->actingAs($superAdmin);

        $service = Service::first();

        // Index
        $response = $this->get(route('admin.projects.index'));
        $response->assertStatus(200);
        $response->assertSee('Projects & Portfolio');

        // Store
        $storeResponse = $this->post(route('admin.projects.store'), [
            'title' => 'Poles Marmer Lobi Kantor BUMN',
            'service_id' => $service->id,
            'category' => 'Floor Polishing',
            'before_image' => UploadedFile::fake()->image('before.jpg'),
            'after_image' => UploadedFile::fake()->image('after.jpg'),
            'description' => 'Restorasi kilau marmer.',
            'completed_at' => '2026-08-20',
        ]);
        $storeResponse->assertRedirect(route('admin.projects.index'));

        $project = Project::where('title', 'Poles Marmer Lobi Kantor BUMN')->first();
        $this->assertNotNull($project);
        $this->assertEquals('Floor Polishing', $project->category);

        // Update
        $updateResponse = $this->put(route('admin.projects.update', $project), [
            'title' => 'Poles Marmer & Granit Lobi BUMN',
            'service_id' => $service->id,
        ]);
        $updateResponse->assertRedirect(route('admin.projects.index'));

        $project->refresh();
        $this->assertEquals('Poles Marmer & Granit Lobi BUMN', $project->title);

        // Delete
        $deleteResponse = $this->delete(route('admin.projects.destroy', $project));
        $deleteResponse->assertRedirect(route('admin.projects.index'));
        $this->assertNull(Project::where('title', 'Poles Marmer & Granit Lobi BUMN')->first());
    }

    public function test_super_admin_can_perform_crud_on_clients(): void
    {
        Storage::fake('public');
        $superAdmin = User::where('email', 'superadmin@bersihsebagian.com')->first();
        $this->actingAs($superAdmin);

        // Store
        $storeResponse = $this->post(route('admin.clients.store'), [
            'name' => 'PT Telkom Indonesia Tbk',
            'sort_order' => 10,
            'is_visible' => '1',
            'logo' => UploadedFile::fake()->image('telkom.png'),
        ]);
        $storeResponse->assertRedirect(route('admin.clients.index'));

        $client = Client::where('name', 'PT Telkom Indonesia Tbk')->first();
        $this->assertNotNull($client);
        $this->assertEquals(10, $client->sort_order);

        // Update
        $updateResponse = $this->put(route('admin.clients.update', $client), [
            'name' => 'Telkom Corporate Office',
            'sort_order' => 5,
            'is_visible' => '1',
        ]);
        $updateResponse->assertRedirect(route('admin.clients.index'));

        $client->refresh();
        $this->assertEquals('Telkom Corporate Office', $client->name);

        // Delete
        $deleteResponse = $this->delete(route('admin.clients.destroy', $client));
        $deleteResponse->assertRedirect(route('admin.clients.index'));
        $this->assertNull(Client::where('name', 'Telkom Corporate Office')->first());
    }

    public function test_super_admin_can_perform_crud_on_certificates(): void
    {
        Storage::fake('public');
        $superAdmin = User::where('email', 'superadmin@bersihsebagian.com')->first();
        $this->actingAs($superAdmin);

        // Store
        $storeResponse = $this->post(route('admin.certificates.store'), [
            'name' => 'ISO 14001:2015 Sistem Manajemen Lingkungan',
            'issuer' => 'TUV Rheinland',
            'license_number' => 'TUV-EMS-2025-881',
            'valid_until' => '2028-12-31',
        ]);
        $storeResponse->assertRedirect(route('admin.certificates.index'));

        $cert = Certificate::where('name', 'ISO 14001:2015 Sistem Manajemen Lingkungan')->first();
        $this->assertNotNull($cert);

        // Update
        $updateResponse = $this->put(route('admin.certificates.update', $cert), [
            'name' => 'ISO 14001:2015 Environmental System',
            'issuer' => 'TUV Rheinland Indonesia',
        ]);
        $updateResponse->assertRedirect(route('admin.certificates.index'));

        $cert->refresh();
        $this->assertEquals('ISO 14001:2015 Environmental System', $cert->name);

        // Delete
        $deleteResponse = $this->delete(route('admin.certificates.destroy', $cert));
        $deleteResponse->assertRedirect(route('admin.certificates.index'));
        $this->assertNull(Certificate::where('name', 'ISO 14001:2015 Environmental System')->first());
    }

    public function test_super_admin_can_perform_crud_on_statistics(): void
    {
        $superAdmin = User::where('email', 'superadmin@bersihsebagian.com')->first();
        $this->actingAs($superAdmin);

        // Store
        $storeResponse = $this->post(route('admin.statistics.store'), [
            'label' => 'Proyek Gedung Selesai',
            'value' => '1,200+',
            'icon' => 'heroicon-o-check-badge',
            'sort_order' => 5,
        ]);
        $storeResponse->assertRedirect(route('admin.statistics.index'));

        $stat = Statistic::where('label', 'Proyek Gedung Selesai')->first();
        $this->assertNotNull($stat);
        $this->assertEquals('1,200+', $stat->value);

        // Update
        $updateResponse = $this->put(route('admin.statistics.update', $stat), [
            'label' => 'Total Proyek Selesai',
            'value' => '1,500+',
            'icon' => 'heroicon-o-check-badge',
            'sort_order' => 5,
        ]);
        $updateResponse->assertRedirect(route('admin.statistics.index'));

        $stat->refresh();
        $this->assertEquals('1,500+', $stat->value);

        // Delete
        $deleteResponse = $this->delete(route('admin.statistics.destroy', $stat));
        $deleteResponse->assertRedirect(route('admin.statistics.index'));
        $this->assertNull(Statistic::where('label', 'Total Proyek Selesai')->first());
    }

    public function test_super_admin_can_perform_crud_on_testimonials(): void
    {
        $superAdmin = User::where('email', 'superadmin@bersihsebagian.com')->first();
        $this->actingAs($superAdmin);

        // Store
        $storeResponse = $this->post(route('admin.testimonials.store'), [
            'name' => 'Ir. Gunawan Wibisono',
            'designation_company' => 'Project Director - Sinarmas Land',
            'quote' => 'Hasil pengerjaan sangat rapi dan memenuhi SLA kebersihan dengan baik.',
            'rating' => 5,
        ]);
        $storeResponse->assertRedirect(route('admin.testimonials.index'));

        $testi = Testimonial::where('name', 'Ir. Gunawan Wibisono')->first();
        $this->assertNotNull($testi);

        // Update
        $updateResponse = $this->put(route('admin.testimonials.update', $testi), [
            'name' => 'Ir. Gunawan Wibisono, M.T.',
            'designation_company' => 'Project Director - Sinarmas Land',
            'quote' => 'Hasil pembersihan sangat bersih luar biasa.',
            'rating' => 5,
        ]);
        $updateResponse->assertRedirect(route('admin.testimonials.index'));

        $testi->refresh();
        $this->assertEquals('Ir. Gunawan Wibisono, M.T.', $testi->name);

        // Delete
        $deleteResponse = $this->delete(route('admin.testimonials.destroy', $testi));
        $deleteResponse->assertRedirect(route('admin.testimonials.index'));
        $this->assertNull(Testimonial::where('name', 'Ir. Gunawan Wibisono, M.T.')->first());
    }

    public function test_super_admin_can_perform_crud_on_articles(): void
    {
        $superAdmin = User::where('email', 'superadmin@bersihsebagian.com')->first();
        $this->actingAs($superAdmin);

        // Store
        $storeResponse = $this->post(route('admin.articles.store'), [
            'title' => 'Panduan Standar Kebersihan Rumah Sakit',
            'category' => 'Edukasi Kebersihan',
            'excerpt' => 'Prosedur sanitasi ruang rawat inap.',
            'content' => '<p>Sterilisasi menggunakan disinfektan medis.</p>',
            'status' => 'published',
        ]);
        $storeResponse->assertRedirect(route('admin.articles.index'));

        $article = Article::where('title', 'Panduan Standar Kebersihan Rumah Sakit')->first();
        $this->assertNotNull($article);
        $this->assertEquals('panduan-standar-kebersihan-rumah-sakit', $article->slug);

        // Update
        $updateResponse = $this->put(route('admin.articles.update', $article), [
            'title' => 'Panduan Standar Kebersihan & Sanitasi RS',
            'category' => 'Edukasi Kebersihan',
            'content' => '<p>Konten baru.</p>',
            'status' => 'published',
        ]);
        $updateResponse->assertRedirect(route('admin.articles.index'));

        $article->refresh();
        $this->assertEquals('Panduan Standar Kebersihan & Sanitasi RS', $article->title);

        // Delete
        $deleteResponse = $this->delete(route('admin.articles.destroy', $article));
        $deleteResponse->assertRedirect(route('admin.articles.index'));
        $this->assertNull(Article::where('title', 'Panduan Standar Kebersihan & Sanitasi RS')->first());
    }

    public function test_admin_can_view_and_update_inquiries(): void
    {
        $superAdmin = User::where('email', 'superadmin@bersihsebagian.com')->first();
        $this->actingAs($superAdmin);

        $inquiry = Inquiry::first();

        // Index
        $response = $this->get(route('admin.inquiries.index'));
        $response->assertStatus(200);
        $response->assertSee('Inquiries & Leads');

        // Show
        $showResponse = $this->get(route('admin.inquiries.show', $inquiry));
        $showResponse->assertStatus(200);
        $showResponse->assertSee($inquiry->name);

        // Update Status
        $updateResponse = $this->put(route('admin.inquiries.update', $inquiry), [
            'status' => 'completed',
        ]);
        $updateResponse->assertRedirect(route('admin.inquiries.index'));

        $inquiry->refresh();
        $this->assertEquals('completed', $inquiry->status);

        // Delete
        $deleteResponse = $this->delete(route('admin.inquiries.destroy', $inquiry));
        $deleteResponse->assertRedirect(route('admin.inquiries.index'));
    }
}
