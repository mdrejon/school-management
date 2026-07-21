<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Translatable\HasTranslations;

class Course extends Model
{
    use HasTranslations;

    public array $translatable = [
        'title',
        'category',
        'short_description',
        'duration',
        'description',
        'instructor_name',
        'enrolled_text',
        'requirement_title',
        'experience_title',
        'experience_description',
    ];

    protected $fillable = [
        'slug',
        'title',
        'category',
        'thumbnail',
        'short_description',
        'lessons_count',
        'rating',
        'seats',
        'duration',
        'price',
        'description',
        'gallery_image_1',
        'gallery_image_2',
        'instructor_name',
        'instructor_image',
        'enrolled_text',
        'requirement_title',
        'requirement_items',
        'experience_title',
        'experience_description',
        'features',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'requirement_items' => 'array',
        'features' => 'array',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
        'lessons_count' => 'integer',
        'seats' => 'integer',
        'rating' => 'decimal:1',
    ];

    protected $appends = ['thumbnail_url', 'instructor_image_url', 'gallery_image_1_url', 'gallery_image_2_url'];

    protected static function booted(): void
    {
        static::creating(function (Course $course) {
            if (blank($course->slug)) {
                $default = Language::defaultLanguage()?->code ?? config('app.fallback_locale');
                $course->slug = static::uniqueSlugFrom($course->getTranslation('title', $default) ?: 'course');
            }
        });
    }

    protected static function uniqueSlugFrom(string $source): string
    {
        $base = Str::slug($source) ?: 'course';
        $slug = $base;
        $suffix = 2;

        while (static::where('slug', $slug)->exists()) {
            $slug = "{$base}-{$suffix}";
            $suffix++;
        }

        return $slug;
    }

    public function getThumbnailUrlAttribute(): ?string
    {
        return $this->thumbnail ? '/storage/'.ltrim($this->thumbnail, '/') : null;
    }

    public function getInstructorImageUrlAttribute(): ?string
    {
        return $this->instructor_image ? '/storage/'.ltrim($this->instructor_image, '/') : null;
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
     * "Course Requirement" bullet list resolved to plain strings for the
     * given locale — same fallback pattern as SiteSetting's repeater
     * resolvers (e.g. instituteInfoItems()).
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
     * Sidebar "Course Features" list (icon + label + value) resolved to
     * plain strings for the given locale — same shape/fallback as
     * SiteSetting::ctaStatsItems().
     */
    public function featureItems(?string $locale = null): array
    {
        $locale ??= app()->getLocale();
        $default = Language::defaultLanguage()?->code ?? config('app.fallback_locale');

        return collect($this->features ?? [])
            ->map(fn (array $item) => [
                'icon' => $item['icon'] ?? ['source' => 'upload', 'value' => ''],
                'label' => $item['label'][$locale] ?? $item['label'][$default] ?? '',
                'value' => $item['value'][$locale] ?? $item['value'][$default] ?? '',
            ])
            ->filter(fn (array $item) => $item['label'] !== '' || $item['value'] !== '')
            ->values()
            ->all();
    }

    public static function forHomepage(int $limit = 6)
    {
        return static::where('is_active', true)->orderBy('sort_order')->limit($limit)->get();
    }
}
