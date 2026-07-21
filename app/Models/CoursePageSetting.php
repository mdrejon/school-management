<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Spatie\Translatable\HasTranslations;

class CoursePageSetting extends Model
{
    use HasTranslations;

    public array $translatable = [
        'section_tagline',
        'section_title',
        'section_highlight',
        'section_description',
        'breadcrumb_title',
        'seo_title',
        'seo_description',
        'seo_keywords',
    ];

    protected $fillable = [
        'section_tagline',
        'section_title',
        'section_highlight',
        'section_description',
        'breadcrumb_title',
        'breadcrumb_image',
        'seo_title',
        'seo_description',
        'seo_keywords',
    ];

    protected $appends = ['breadcrumb_image_url'];

    protected static function booted(): void
    {
        static::saved(fn () => Cache::forget('course_page_settings.current'));
    }

    public function getBreadcrumbImageUrlAttribute(): ?string
    {
        return $this->breadcrumb_image ? '/storage/'.ltrim($this->breadcrumb_image, '/') : null;
    }

    /**
     * The single settings row, created with sane defaults on first access.
     * Same caching approach as SiteSetting::current() — cached as raw
     * getAttributes(), not toArray(), so translatable columns stay
     * locale-agnostic JSON in cache (see SiteSetting's docblock for why).
     */
    public static function current(): self
    {
        $row = Cache::rememberForever('course_page_settings.current', function () {
            $settings = static::query()->first();

            if (! $settings) {
                $settings = static::create([
                    'section_tagline' => ['en' => 'Our Courses'],
                    'section_title' => ['en' => "Let's Check Our Courses"],
                    'section_highlight' => ['en' => 'Courses'],
                    'breadcrumb_title' => ['en' => 'Our Courses'],
                ]);
            }

            return $settings->getAttributes();
        });

        return static::hydrate([$row])->first();
    }
}
