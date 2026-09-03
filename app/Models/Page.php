<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Translatable\HasTranslations;

class Page extends Model
{
    use HasTranslations;

    public array $translatable = [
        'title',
        'content',
        'seo_title',
        'seo_description',
        'seo_keywords',
    ];

    protected $fillable = [
        'slug',
        'title',
        'content',
        'custom_css',
        'breadcrumb_image',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected $appends = ['breadcrumb_image_url'];

    protected static function booted(): void
    {
        static::creating(function (Page $page) {
            if (blank($page->slug)) {
                $default = Language::defaultLanguage()?->code ?? config('app.fallback_locale');
                $page->slug = static::uniqueSlugFrom($page->getTranslation('title', $default) ?: 'page');
            }
        });
    }

    protected static function uniqueSlugFrom(string $source): string
    {
        $base = Str::slug($source) ?: 'page';
        $slug = $base;
        $suffix = 2;

        while (static::where('slug', $slug)->exists()) {
            $slug = "{$base}-{$suffix}";
            $suffix++;
        }

        return $slug;
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function getBreadcrumbImageUrlAttribute(): ?string
    {
        return $this->breadcrumb_image ? asset('storage/'.ltrim($this->breadcrumb_image, '/')) : null;
    }
}
