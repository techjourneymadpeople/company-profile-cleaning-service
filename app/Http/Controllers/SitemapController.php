<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Service;
use Illuminate\Http\Response;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $sitemap = Sitemap::create();

        // 1. Static Pages
        $sitemap->add(
            Url::create(route('public.home'))
                ->setLastModificationDate(now())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                ->setPriority(1.0)
        );

        $sitemap->add(
            Url::create(route('public.services'))
                ->setLastModificationDate(now())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.9)
        );

        $sitemap->add(
            Url::create(route('public.portfolio'))
                ->setLastModificationDate(now())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.8)
        );

        $sitemap->add(
            Url::create(route('public.articles'))
                ->setLastModificationDate(now())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                ->setPriority(0.8)
        );

        $sitemap->add(
            Url::create(route('public.contact'))
                ->setLastModificationDate(now())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                ->setPriority(0.7)
        );

        // 2. Dynamic Services
        $services = Service::active()->get();
        foreach ($services as $service) {
            $sitemap->add(
                Url::create(route('public.services.show', $service->slug))
                    ->setLastModificationDate($service->updated_at ?? now())
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                    ->setPriority(0.85)
            );
        }

        // 3. Dynamic Articles
        $articles = Article::published()->get();
        foreach ($articles as $article) {
            $sitemap->add(
                Url::create(route('public.articles.show', $article->slug))
                    ->setLastModificationDate($article->updated_at ?? now())
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                    ->setPriority(0.75)
            );
        }

        return response($sitemap->render(), 200, [
            'Content-Type' => 'text/xml',
        ]);
    }
}
