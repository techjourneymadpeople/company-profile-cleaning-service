<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class PageSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_key',
        'section_key',
        'section_name',
        'badge',
        'title',
        'subtitle',
        'body',
        'button_text',
        'button_url',
        'secondary_button_text',
        'secondary_button_url',
        'image',
        'data',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'data' => 'array',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function scopeForPage($query, string $pageKey)
    {
        return $query->where('page_key', $pageKey);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc')->orderBy('id', 'asc');
    }

    /**
     * Get all sections for a page indexed by section_key.
     * Cached for 1 hour, auto-invalidated on model save.
     */
    public static function getForPage(string $pageKey): Collection
    {
        return Cache::remember("page_sections_{$pageKey}", 3600, function () use ($pageKey) {
            return static::forPage($pageKey)
                ->ordered()
                ->get()
                ->keyBy('section_key');
        });
    }

    /**
     * Clear page section caches.
     */
    public static function clearPageCache(?string $pageKey = null): void
    {
        if ($pageKey) {
            Cache::forget("page_sections_{$pageKey}");
        } else {
            foreach (['home', 'services', 'portfolio', 'articles', 'contact'] as $key) {
                Cache::forget("page_sections_{$key}");
            }
        }
    }

    protected static function booted(): void
    {
        static::saved(function ($section) {
            static::clearPageCache($section->page_key);
        });

        static::deleted(function ($section) {
            static::clearPageCache($section->page_key);
        });
    }
}
