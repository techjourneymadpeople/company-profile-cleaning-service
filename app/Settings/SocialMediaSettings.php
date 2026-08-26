<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class SocialMediaSettings extends Settings
{
    public ?string $facebook;
    public ?string $instagram;
    public ?string $twitter;
    public ?string $tiktok;
    public ?string $youtube;
    public ?string $linkedin;

    public static function group(): string
    {
        return 'social';
    }
}
