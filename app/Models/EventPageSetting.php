<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Spatie\Translatable\HasTranslations;

class EventPageSetting extends Model
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
        static::saved(fn () => Cache::forget('event_page_settings.current'));
    }

    public function getBreadcrumbImageUrlAttribute(): ?string
    {
        return $this->breadcrumb_image ? '/storage/'.ltrim($this->breadcrumb_image, '/') : null;
    }

    /**
     * The single settings row, created with sane defaults on first access.
     * Same caching approach as SiteSetting::current().
     */
    public static function current(): self
    {
        $row = Cache::rememberForever('event_page_settings.current', function () {
            $settings = static::query()->first();

            if (! $settings) {
                $settings = static::create([
                    'section_tagline' => ['en' => 'Events'],
                    'section_title' => ['en' => 'Our Upcoming Events'],
                    'section_highlight' => ['en' => 'Events'],
                    'breadcrumb_title' => ['en' => 'Events'],
                ]);
            }

            return $settings->getAttributes();
        });

        return static::hydrate([$row])->first();
    }
}
