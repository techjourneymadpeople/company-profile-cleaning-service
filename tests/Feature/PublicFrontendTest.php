<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\Inquiry;
use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicFrontendTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }

    public function test_homepage_renders_successfully_with_seo_and_components(): void
    {
        $response = $this->get(route('public.home'));
        $response->assertStatus(200);
        $response->assertSee('Kebersihan Adalah Komitmen Kami');
        $response->assertSee('CLEAN SPACE, BETTER LIFE');
        $response->assertSee('Mengapa Memilih Kami?');
        $response->assertSee('Layanan Kebersihan Unggulan');
        $response->assertSee('Dipercaya oleh Berbagai Perusahaan');
    }

    public function test_services_index_renders_and_supports_filtering(): void
    {
        $response = $this->get(route('public.services'));
        $response->assertStatus(200);
        $response->assertSee('Layanan Kami');

        // Test category filter
        $filterResponse = $this->get(route('public.services', ['kategori' => 'Kebersihan']));
        $filterResponse->assertStatus(200);
    }

    public function test_single_service_detail_renders_with_seo_and_sidebar(): void
    {
        $service = Service::active()->first();
        $this->assertNotNull($service);

        $response = $this->get(route('public.services.show', $service->slug));
        $response->assertStatus(200);
        $response->assertSee($service->name);
        $response->assertSee('Minta Penawaran (RFQ)');
        $response->assertSee('Layanan Lainnya');
    }

    public function test_portfolio_page_renders_with_clients_and_before_after(): void
    {
        $response = $this->get(route('public.portfolio'));
        $response->assertStatus(200);
        $response->assertSee('Mitra Kami', false);
        $response->assertSee('Galeri Hasil Kerja', false);
    }

    public function test_articles_index_and_search(): void
    {
        $response = $this->get(route('public.articles'));
        $response->assertStatus(200);
        $response->assertSee('Artikel', false);

        $searchResponse = $this->get(route('public.articles', ['q' => 'Kantor']));
        $searchResponse->assertStatus(200);
    }

    public function test_single_article_detail_page(): void
    {
        $article = Article::published()->first();
        $this->assertNotNull($article);

        $response = $this->get(route('public.articles.show', $article->slug));
        $response->assertStatus(200);
        $response->assertSee($article->title);
        $response->assertSee('Bagikan Artikel Ini:');
    }

    public function test_contact_page_renders_and_submits_rfq_inquiry(): void
    {
        $response = $this->get(route('public.contact'));
        $response->assertStatus(200);
        $response->assertSee('Kontak Kami', false);
        $response->assertSee('Kirim Pesan', false);

        $postResponse = $this->post(route('public.contact.submit'), [
            'name' => 'Budi Santoso',
            'email' => 'budi@ptmaju.co.id',
            'phone' => '081234567890',
            'company_name' => 'PT Maju Terus',
            'service_requested' => 'Commercial Cleaning',
            'message' => 'Mohon penawaran untuk gedung kantor 4 lantai di Bandung.',
        ]);

        $postResponse->assertRedirect();
        $postResponse->assertSessionHas('success_inquiry');

        $this->assertDatabaseHas('inquiries', [
            'email' => 'budi@ptmaju.co.id',
            'company_name' => 'PT Maju Terus',
            'status' => 'new',
        ]);
    }

    public function test_sitemap_xml_generates_successfully(): void
    {
        $response = $this->get(route('public.sitemap'));
        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'text/xml; charset=UTF-8');
        $response->assertSee('urlset', false);
        $response->assertSee(route('public.home'), false);
        $response->assertSee(route('public.services'), false);
    }
}
