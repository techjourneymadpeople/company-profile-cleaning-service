<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class ContactSettings extends Settings
{
    public string $email;
    public string $phone;
    public string $whatsapp;
    public string $address;
    public string $operating_hours;
    public ?string $google_maps_embed;

    public static function group(): string
    {
        return 'contact';
    }
}
