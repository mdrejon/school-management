<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Translatable\HasTranslations;

class Department extends Model
{
    use HasTranslations;

    public array $translatable = [
        'title',
        'short_description',
        'description',
        'requirement_title',
    ];

    protected $fillable = [
        'slug',
        'icon',
        'title',
        'short_description',
        'image',
        'description',
        'gallery_image_1',
        'gallery_image_2',
        'requirement_title',
        'requirement_items',
        'downloads',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'icon' => 'array',
        'requirement_items' => 'array',
        'downloads' => 'array',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    protected $appends = ['image_url', 'gallery_image_1_url', 'gallery_image_2_url'];

    protected static function booted(): void
    {
        static::creating(function (Department $department) {
            if (blank($department->slug)) {
                $default = Language::defaultLanguage()?->code ?? config('app.fallback_locale');
                $department->slug = static::uniqueSlugFrom($department->getTranslation('title', $default) ?: 'department');
            }
        });
    }

    protected static function uniqueSlugFrom(string $source): string
    {
        $base = Str::slug($source) ?: 'department';
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
        return $this->image ? '/storage/'.ltrim($this->image, '/') : null;
    }

    public function getGalleryImage1UrlAttribute(): ?string
    {
        return $this->gallery_image_1 ? '/storage/'.ltrim($this->gallery_image_1, '/') : null;
    }

    public function getGalleryImage2UrlAttribute(): ?string
    {
        return $this->gallery_image_2 ? '/storage/'.ltrim($this->gallery_image_2, '/') : null;
    }

    /**
     * "How To Prepare..." style bullet list resolved to plain strings for
     * the given locale — same pattern as Course::requirementItems().
     */
    public function requirementItems(?string $locale = null): array
    {
        $locale ??= app()->getLocale();
        $default = Language::defaultLanguage()?->code ?? config('app.fallback_locale');

        return collect($this->requirement_items ?? [])
            ->map(fn (array $item) => $item['text'][$locale] ?? $item['text'][$default] ?? '')
            ->filter(fn (string $text) => $text !== '')
            ->values()
            ->all();
    }

    /**
     * Downloadable files (label + storage path) resolved to plain strings
     * for the given locale label.
     */
    public function downloadItems(?string $locale = null): array
    {
        $locale ??= app()->getLocale();
        $default = Language::defaultLanguage()?->code ?? config('app.fallback_locale');

        return collect($this->downloads ?? [])
            ->map(fn (array $item) => [
                'label' => $item['label'][$locale] ?? $item['label'][$default] ?? '',
                'file_url' => isset($item['file']) ? '/storage/'.ltrim($item['file'], '/') : null,
            ])
            ->filter(fn (array $item) => filled($item['file_url']))
            ->values()
            ->all();
    }

    public static function forHomepage(int $limit = 8)
    {
        return static::where('is_active', true)->orderBy('sort_order')->limit($limit)->get();
    }
}
