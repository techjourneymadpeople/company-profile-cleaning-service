<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Settings\BrandSettings;
use App\Settings\ContactSettings;
use App\Settings\SeoSettings;
use App\Settings\SocialMediaSettings;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SettingController extends Controller
{
    /**
     * Display the settings index page with all groups.
     */
    public function index(
        BrandSettings $brand,
        ContactSettings $contact,
        SocialMediaSettings $social,
        SeoSettings $seo
    ): View {
        return view('admin.settings.index', compact('brand', 'contact', 'social', 'seo'));
    }

    /**
     * Update Brand identity settings.
     */
    public function updateBrand(Request $request, BrandSettings $settings): RedirectResponse
    {
        $validated = $request->validate([
            'site_name' => ['required', 'string', 'max:255'],
            'site_tagline' => ['required', 'string', 'max:255'],
            'site_description' => ['nullable', 'string', 'max:500'],
            'site_logo' => ['nullable', 'image', 'mimes:png,jpg,jpeg,svg,webp', 'max:2048'],
            'site_favicon' => ['nullable', 'image', 'mimes:png,ico,svg,webp', 'max:1024'],
        ]);

        $settings->site_name = $validated['site_name'];
        $settings->site_tagline = $validated['site_tagline'];
        $settings->site_description = $validated['site_description'] ?? '';

        if ($request->hasFile('site_logo')) {
            $logoPath = $request->file('site_logo')->store('brand', 'public');
            $settings->site_logo = $logoPath;
        }

        if ($request->hasFile('site_favicon')) {
            $faviconPath = $request->file('site_favicon')->store('brand', 'public');
            $settings->site_favicon = $faviconPath;
        }

        $settings->save();

        return redirect()->route('admin.settings.index', ['tab' => 'brand'])
            ->with('status', 'Identitas Brand dan logo berhasil diperbarui.');
    }

    /**
     * Update Contact & Operational settings.
     */
    public function updateContact(Request $request, ContactSettings $settings): RedirectResponse
    {
        $validated = $request->validate([
            'phone' => ['required', 'string', 'max:50'],
            'whatsapp' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email', 'max:255'],
            'address' => ['required', 'string', 'max:500'],
            'google_maps_embed' => ['nullable', 'string', 'max:1000'],
            'operating_hours' => ['required', 'string', 'max:255'],
        ]);

        $settings->phone = $validated['phone'];
        $settings->whatsapp = $validated['whatsapp'];
        $settings->email = $validated['email'];
        $settings->address = $validated['address'];
        $settings->google_maps_embed = $validated['google_maps_embed'] ?? '';
        $settings->operating_hours = $validated['operating_hours'];
        $settings->save();

        return redirect()->route('admin.settings.index', ['tab' => 'contact'])
            ->with('status', 'Informasi kontak dan operasional berhasil diperbarui.');
    }

    /**
     * Update Social Media links.
     */
    public function updateSocial(Request $request, SocialMediaSettings $settings): RedirectResponse
    {
        $validated = $request->validate([
            'facebook' => ['nullable', 'url', 'max:255'],
            'instagram' => ['nullable', 'url', 'max:255'],
            'twitter' => ['nullable', 'url', 'max:255'],
            'tiktok' => ['nullable', 'url', 'max:255'],
            'youtube' => ['nullable', 'url', 'max:255'],
            'linkedin' => ['nullable', 'url', 'max:255'],
        ]);

        $settings->facebook = $validated['facebook'] ?? '';
        $settings->instagram = $validated['instagram'] ?? '';
        $settings->twitter = $validated['twitter'] ?? '';
        $settings->tiktok = $validated['tiktok'] ?? '';
        $settings->youtube = $validated['youtube'] ?? '';
        $settings->linkedin = $validated['linkedin'] ?? '';
        $settings->save();

        return redirect()->route('admin.settings.index', ['tab' => 'social'])
            ->with('status', 'Tautan media sosial resmi berhasil diperbarui.');
    }

    /**
     * Update SEO & Meta tag configurations.
     */
    public function updateSeo(Request $request, SeoSettings $settings): RedirectResponse
    {
        $validated = $request->validate([
            'meta_title' => ['required', 'string', 'max:255'],
            'meta_description' => ['required', 'string', 'max:500'],
            'meta_keywords' => ['nullable', 'string', 'max:255'],
            'canonical_url' => ['nullable', 'url', 'max:255'],
        ]);

        $settings->meta_title = $validated['meta_title'];
        $settings->meta_description = $validated['meta_description'];
        $settings->meta_keywords = $validated['meta_keywords'] ?? '';
        $settings->canonical_url = $validated['canonical_url'] ?? '';
        $settings->save();

        return redirect()->route('admin.settings.index', ['tab' => 'seo'])
            ->with('status', 'Pengaturan SEO dan metadata berhasil diperbarui.');
    }
}
