<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Certificate;
use App\Models\Client;
use App\Models\Inquiry;
use App\Models\PageSection;
use App\Models\Project;
use App\Models\Service;
use App\Models\Statistic;
use App\Models\Testimonial;
use App\Settings\BrandSettings;
use App\Settings\ContactSettings;
use App\Settings\SeoSettings;
use App\Settings\SocialMediaSettings;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PublicController extends Controller
{
    public function home(
        BrandSettings $brand,
        ContactSettings $contact,
        SocialMediaSettings $social,
        SeoSettings $seo
    ): View {
        // Dynamic SEO Configuration
        $siteTitle = $seo->meta_title ?: ($brand->site_name . ' - Jasa Cleaning Service & Facility Management');
        $siteDescription = $seo->meta_description ?: ($brand->site_description ?: 'Penyedia layanan jasa cleaning service komersial, deep cleaning, dan facility management profesional bersertifikasi.');

        SEOTools::setTitle($siteTitle);
        SEOTools::setDescription($siteDescription);
        SEOTools::setCanonical(url('/'));
        SEOTools::opengraph()->setUrl(url('/'));
        SEOTools::opengraph()->addProperty('type', 'website');
        SEOTools::twitter()->setSite('@' . ($social->twitter ?: 'bersihprima'));
        if ($brand->site_logo) {
            SEOTools::opengraph()->addImage(asset('storage/' . $brand->site_logo));
        }

        // Data for Sections
        $sections = PageSection::getForPage('home');
        $services = Service::active()->take(6)->get();
        $projects = Project::with('service')->latest()->take(6)->get();
        $clients = Client::visible()->get();
        $certificates = Certificate::latest()->get();
        $statistics = Statistic::orderBy('sort_order', 'asc')->get();
        $testimonials = Testimonial::latest()->take(6)->get();
        $recentArticles = Article::published()->latest()->take(3)->get();

        return view('frontend.home', compact(
            'brand',
            'contact',
            'social',
            'sections',
            'services',
            'projects',
            'clients',
            'certificates',
            'statistics',
            'testimonials',
            'recentArticles'
        ));
    }

    public function services(Request $request, BrandSettings $brand, SeoSettings $seo): View
    {
        $category = $request->query('kategori');

        SEOTools::setTitle('Solusi & Layanan Kebersihan - ' . $brand->site_name);
        SEOTools::setDescription('Jelajahi paket solusi cleaning service perkantoran, industri, komersial, dan alih daya tenaga kerja fasilitas.');
        SEOTools::setCanonical(route('public.services'));

        $categories = ['Semua', 'Kebersihan', 'Keamanan & Higienitas', 'Manajemen Fasilitas'];
        $sections = PageSection::getForPage('services');

        $services = Service::active()
            ->when($category && $category !== 'Semua', function ($query) use ($category) {
                $query->where('category', $category);
            })
            ->get();

        return view('frontend.services.index', compact('brand', 'sections', 'services', 'categories', 'category'));
    }

    public function serviceDetail(string $slug, BrandSettings $brand): View
    {
        $service = Service::active()->where('slug', $slug)->firstOrFail();

        // SEO per Single Service
        SEOTools::setTitle($service->name . ' - ' . $brand->site_name);
        SEOTools::setDescription($service->excerpt ?: strip_tags(substr($service->description, 0, 160)));
        SEOTools::setCanonical(route('public.services.show', $service->slug));
        SEOTools::opengraph()->setUrl(route('public.services.show', $service->slug));
        SEOTools::opengraph()->addProperty('type', 'article');
        if ($service->thumbnail) {
            SEOTools::opengraph()->addImage(asset('storage/' . $service->thumbnail));
        }

        $relatedProjects = Project::where('service_id', $service->id)->latest()->take(4)->get();
        $otherServices = Service::active()->where('id', '!=', $service->id)->take(5)->get();

        return view('frontend.services.show', compact('brand', 'service', 'relatedProjects', 'otherServices'));
    }

    public function portfolio(BrandSettings $brand): View
    {
        SEOTools::setTitle('Mitra Klien & Portofolio Hasil Kerja - ' . $brand->site_name);
        SEOTools::setDescription('Lihat deretan mitra korporat yang mempercayai kami serta dokumentasi komparasi before & after proyek pengerjaan kebersihan.');
        SEOTools::setCanonical(route('public.portfolio'));

        $sections = PageSection::getForPage('portfolio');
        $clients = Client::visible()->get();
        $projects = Project::with('service')->latest()->get();

        return view('frontend.portfolio', compact('brand', 'sections', 'clients', 'projects'));
    }

    public function articles(Request $request, BrandSettings $brand): View
    {
        $search = $request->query('q');
        $category = $request->query('kategori');

        SEOTools::setTitle('Edukasi Kebersihan & Berita - ' . $brand->site_name);
        SEOTools::setDescription('Kumpulan artikel edukasi kebersihan, tips manajemen fasilitas gedung, dan kabar aktivitas terbaru perusahaan.');
        SEOTools::setCanonical(route('public.articles'));

        $sections = PageSection::getForPage('articles');

        $articles = Article::published()
            ->with('author')
            ->when($search, function ($query, $search) {
                $query->where('title', 'like', "%{$search}%")
                      ->orWhere('excerpt', 'like', "%{$search}%");
            })
            ->when($category, function ($query, $category) {
                $query->where('category', $category);
            })
            ->latest('published_at')
            ->paginate(6)
            ->withQueryString();

        $categories = Article::published()->distinct()->pluck('category');

        return view('frontend.articles.index', compact('brand', 'sections', 'articles', 'categories', 'search', 'category'));
    }

    public function articleDetail(string $slug, BrandSettings $brand): View
    {
        $article = Article::published()->with('author')->where('slug', $slug)->firstOrFail();

        // Dynamic SEO per Article
        SEOTools::setTitle($article->title . ' - ' . $brand->site_name);
        SEOTools::setDescription($article->excerpt ?: strip_tags(substr($article->content, 0, 160)));
        SEOTools::setCanonical(route('public.articles.show', $article->slug));
        SEOTools::opengraph()->setUrl(route('public.articles.show', $article->slug));
        SEOTools::opengraph()->addProperty('type', 'article');
        if ($article->featured_image) {
            SEOTools::opengraph()->addImage(asset('storage/' . $article->featured_image));
        }

        $relatedArticles = Article::published()
            ->where('id', '!=', $article->id)
            ->where('category', $article->category)
            ->latest('published_at')
            ->take(3)
            ->get();

        if ($relatedArticles->isEmpty()) {
            $relatedArticles = Article::published()
                ->where('id', '!=', $article->id)
                ->latest('published_at')
                ->take(3)
                ->get();
        }

        return view('frontend.articles.show', compact('brand', 'article', 'relatedArticles'));
    }

    public function contact(BrandSettings $brand, ContactSettings $contact): View
    {
        SEOTools::setTitle('Kontak Kami & Permintaan Penawaran - ' . $brand->site_name);
        SEOTools::setDescription('Hubungi kantor pusat kami atau kirim formulir permintaan penawaran harga (RFQ) cleaning service gratis.');
        SEOTools::setCanonical(route('public.contact'));

        $sections = PageSection::getForPage('contact');
        $services = Service::active()->get();

        return view('frontend.contact', compact('brand', 'sections', 'contact', 'services'));
    }

    public function submitInquiry(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:50'],
            'company_name' => ['nullable', 'string', 'max:255'],
            'service_requested' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:2000'],
        ]);

        $validated['status'] = 'new';

        Inquiry::create($validated);

        return redirect()->back()->with('success_inquiry', 'Terima kasih! Permintaan penawaran Anda telah kami terima. Tim representatif kami akan segera menghubungi Anda melalui WhatsApp/Email.');
    }
}
