<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class SeoSettings extends Settings
{
    public string $meta_title;
    public string $meta_description;
    public string $meta_keywords;
    public ?string $og_image;
    public ?string $canonical_url;

    public static function group(): string
    {
        return 'seo';
    }
}
