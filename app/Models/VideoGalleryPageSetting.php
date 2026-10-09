<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Spatie\Translatable\HasTranslations;

class VideoGalleryPageSetting extends Model
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
        static::saved(fn () => Cache::forget('video_gallery_page_settings.current'));
    }

    public function getBreadcrumbImageUrlAttribute(): ?string
    {
        return $this->breadcrumb_image ? asset('storage/'.ltrim($this->breadcrumb_image, '/')) : null;
    }

    public static function current(): self
    {
        $row = Cache::rememberForever('video_gallery_page_settings.current', function () {
            $settings = static::query()->first();

            if (! $settings) {
                $settings = static::create([
                    'section_tagline' => ['en' => 'Gallery'],
                    'section_title' => ['en' => 'Our Video Gallery'],
                    'section_highlight' => ['en' => 'Video Gallery'],
                    'breadcrumb_title' => ['en' => 'Video Gallery'],
                ]);
            }

            return $settings->getAttributes();
        });

        return static::hydrate([$row])->first();
    }
}
