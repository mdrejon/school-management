<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Spatie\Translatable\HasTranslations;

class CampusTourPageSetting extends Model
{
    use HasTranslations;

    public array $translatable = [
        'tagline',
        'title',
        'highlight',
        'description',
        'breadcrumb_title',
        'seo_title',
        'seo_description',
        'seo_keywords',
    ];

    protected $fillable = [
        'tagline',
        'title',
        'highlight',
        'description',
        'breadcrumb_title',
        'breadcrumb_image',
        'seo_title',
        'seo_description',
        'seo_keywords',
    ];

    protected $appends = ['breadcrumb_image_url'];

    protected static function booted(): void
    {
        static::saved(fn () => Cache::forget('campus_tour_page_settings.current'));
    }

    public function getBreadcrumbImageUrlAttribute(): ?string
    {
        return $this->breadcrumb_image ? asset('storage/'.ltrim($this->breadcrumb_image, '/')) : null;
    }

    public static function current(): self
    {
        $row = Cache::rememberForever('campus_tour_page_settings.current', function () {
            $settings = static::query()->first();

            if (! $settings) {
                $settings = static::create([
                    'tagline' => ['en' => 'Campus Tour'],
                    'title' => ['en' => 'Take A Look At Our Campus'],
                    'highlight' => ['en' => 'Campus'],
                    'description' => ['en' => 'Explore our state-of-the-art facilities, modern classrooms, and vibrant campus life.'],
                    'breadcrumb_title' => ['en' => 'Campus Tour'],
                ]);
            }

            return $settings->getAttributes();
        });

        return static::hydrate([$row])->first();
    }
}
