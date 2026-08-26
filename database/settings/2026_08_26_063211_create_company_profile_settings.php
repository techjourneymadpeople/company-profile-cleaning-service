<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        // Brand Settings
        $this->migrator->add('brand.site_name', 'PT Bersih Sebagian Dari Iman');
        $this->migrator->add('brand.site_tagline', 'Solusi Kebersihan Profesional, Higienis, dan Terpercaya');
        $this->migrator->add('brand.site_description', 'Layanan cleaning service profesional untuk kantor, rumah, gedung, dan fasilitas publik.');
        $this->migrator->add('brand.site_logo', '/images/logo.png');
        $this->migrator->add('brand.site_logo_white', '/images/logo-white.png');
        $this->migrator->add('brand.site_favicon', '/images/favicon.ico');

        // Contact Settings
        $this->migrator->add('contact.email', 'info@bersihsebagian.com');
        $this->migrator->add('contact.phone', '+62 21 5555 8888');
        $this->migrator->add('contact.whatsapp', '+62 812 3456 7890');
        $this->migrator->add('contact.address', 'Jl. Kebersihan Raya No. 99, Jakarta Selatan, DKI Jakarta 12340');
        $this->migrator->add('contact.operating_hours', 'Senin - Sabtu: 08:00 - 17:00 WIB');
        $this->migrator->add('contact.google_maps_embed', 'https://maps.google.com/maps?q=Jakarta&t=&z=13&ie=UTF8&iwloc=&output=embed');

        // Social Media Settings
        $this->migrator->add('social.facebook', 'https://facebook.com/bersihsebagian');
        $this->migrator->add('social.instagram', 'https://instagram.com/bersihsebagian');
        $this->migrator->add('social.twitter', 'https://x.com/bersihsebagian');
        $this->migrator->add('social.tiktok', 'https://tiktok.com/@bersihsebagian');
        $this->migrator->add('social.youtube', 'https://youtube.com/@bersihsebagian');
        $this->migrator->add('social.linkedin', 'https://linkedin.com/company/bersihsebagian');

        // SEO Settings
        $this->migrator->add('seo.meta_title', 'Cleaning Service Profesional & Terpercaya - Bersih Sebagian Dari Iman');
        $this->migrator->add('seo.meta_description', 'Jasa cleaning service kantor, rumah, dan industri dengan standar mutu tinggi dan tenaga ahli profesional.');
        $this->migrator->add('seo.meta_keywords', 'cleaning service, jasa bersih rumah, cleaning kantor, deep cleaning, jasa kebersihan jakarta');
        $this->migrator->add('seo.og_image', '/images/og-image.jpg');
        $this->migrator->add('seo.canonical_url', 'http://localhost');
    }
};
