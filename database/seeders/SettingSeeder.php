<?php

namespace Database\Seeders;

use App\Settings\BrandSettings;
use App\Settings\ContactSettings;
use App\Settings\SeoSettings;
use App\Settings\SocialMediaSettings;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Brand Identity Settings
        $brandSettings = app(BrandSettings::class);
        $brandSettings->site_name = 'PT Bersih Sebagian Dari Iman';
        $brandSettings->site_tagline = 'Solusi Kebersihan Profesional, Higienis, dan Terpercaya';
        $brandSettings->site_description = 'Layanan cleaning service profesional untuk kantor, rumah, gedung komersial, dan fasilitas publik.';
        $brandSettings->site_logo = '/images/logo.png';
        $brandSettings->site_logo_white = '/images/logo-white.png';
        $brandSettings->site_favicon = '/images/favicon.ico';
        $brandSettings->save();

        // 2. Contact & Operational Settings
        $contactSettings = app(ContactSettings::class);
        $contactSettings->email = 'info@bersihsebagian.com';
        $contactSettings->phone = '+62 21 5555 8888';
        $contactSettings->whatsapp = '+62 812 3456 7890';
        $contactSettings->address = 'Jl. Kebersihan Raya No. 99, Jakarta Selatan, DKI Jakarta 12340';
        $contactSettings->operating_hours = 'Senin - Sabtu: 08:00 - 17:00 WIB';
        $contactSettings->google_maps_embed = 'https://maps.google.com/maps?q=Jakarta&t=&z=13&ie=UTF8&iwloc=&output=embed';
        $contactSettings->save();

        // 3. Social Media Settings
        $socialSettings = app(SocialMediaSettings::class);
        $socialSettings->facebook = 'https://facebook.com/bersihsebagian';
        $socialSettings->instagram = 'https://instagram.com/bersihsebagian';
        $socialSettings->twitter = 'https://x.com/bersihsebagian';
        $socialSettings->tiktok = 'https://tiktok.com/@bersihsebagian';
        $socialSettings->youtube = 'https://youtube.com/@bersihsebagian';
        $socialSettings->linkedin = 'https://linkedin.com/company/bersihsebagian';
        $socialSettings->save();

        // 4. SEO Settings
        $seoSettings = app(SeoSettings::class);
        $seoSettings->meta_title = 'Cleaning Service Profesional & Terpercaya - Bersih Sebagian Dari Iman';
        $seoSettings->meta_description = 'Jasa cleaning service kantor, rumah, dan industri dengan standar mutu tinggi dan tenaga ahli profesional.';
        $seoSettings->meta_keywords = 'cleaning service, jasa bersih rumah, cleaning kantor, deep cleaning, jasa kebersihan jakarta';
        $seoSettings->og_image = '/images/og-image.jpg';
        $seoSettings->canonical_url = 'http://localhost';
        $seoSettings->save();
    }
}
