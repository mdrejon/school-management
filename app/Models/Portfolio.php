<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Translatable\HasTranslations;

class Portfolio extends Model
{
    use HasTranslations;

    public array $translatable = [
        'title',
        'category',
        'description',
        'highlight_title',
        'overview_title',
        'overview_description',
    ];

    protected $fillable = [
        'slug',
        'title',
        'category',
        'image',
        'description',
        'gallery_image_1',
        'gallery_image_2',
        'highlight_title',
        'highlight_items',
        'overview_title',
        'overview_description',
        'client_name',
        'event_date',
        'cost',
        'manager_name',
        'location',
        'website_url',
        'rating',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'highlight_items' => 'array',
        'event_date' => 'date',
        'rating' => 'integer',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    protected $appends = ['image_url', 'gallery_image_1_url', 'gallery_image_2_url'];

    protected static function booted(): void
    {
        static::creating(function (Portfolio $portfolio) {
            if (blank($portfolio->slug)) {
                $default = Language::defaultLanguage()?->code ?? config('app.fallback_locale');
                $portfolio->slug = static::uniqueSlugFrom($portfolio->getTranslation('title', $default) ?: 'portfolio');
            }
        });
    }

    protected static function uniqueSlugFrom(string $source): string
    {
        $base = Str::slug($source) ?: 'portfolio';
        $slug = $base;
        $suffix = 2;

        while (static::where('slug', $slug)->exists()) {
            $slug = "{$base}-{$suffix}";
            $suffix++;
        }

        return $slug;
    }

    public function getImageUrlAttribute(): ?string
    {
        return $this->image ? asset('storage/'.ltrim($this->image, '/')) : null;
    }

    public function getGalleryImage1UrlAttribute(): ?string
    {
        return $this->gallery_image_1 ? asset('storage/'.ltrim($this->gallery_image_1, '/')) : null;
    }

    public function getGalleryImage2UrlAttribute(): ?string
    {
        return $this->gallery_image_2 ? asset('storage/'.ltrim($this->gallery_image_2, '/')) : null;
    }

    /**
     * "Health Care Tips" style bullet list resolved to plain strings for
     * the given locale — same pattern as Course::requirementItems().
     */
    public function highlightItems(?string $locale = null): array
    {
        $locale ??= app()->getLocale();
        $default = Language::defaultLanguage()?->code ?? config('app.fallback_locale');

        return collect($this->highlight_items ?? [])
            ->map(fn (array $item) => $item['text'][$locale] ?? $item['text'][$default] ?? '')
            ->filter(fn (string $text) => $text !== '')
            ->values()
            ->all();
    }
}
