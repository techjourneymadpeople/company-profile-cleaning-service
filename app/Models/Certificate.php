<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'issuer',
        'image_path',
        'license_number',
        'valid_until',
    ];

    protected $casts = [
        'valid_until' => 'date',
    ];
}
