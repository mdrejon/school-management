<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Spatie\Translatable\HasTranslations;

class ClassSchedulePageSetting extends Model
{
    use HasTranslations;

    public array $translatable = [
        'section_title',
        'section_description',
        'breadcrumb_title',
        'seo_title',
        'seo_description',
        'seo_keywords',
    ];

    protected $fillable = [
        'section_title',
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
        static::saved(fn () => Cache::forget('class_schedule_page_settings.current'));
    }

    public function getBreadcrumbImageUrlAttribute(): ?string
    {
        return $this->breadcrumb_image ? '/storage/'.ltrim($this->breadcrumb_image, '/') : null;
    }

    public static function current(): self
    {
        $row = Cache::rememberForever('class_schedule_page_settings.current', function () {
            $settings = static::query()->first();

            if (! $settings) {
                $settings = static::create([
                    'section_title' => ['en' => 'Daily Activities'],
                    'breadcrumb_title' => ['en' => 'Class Schedule'],
                ]);
            }

            return $settings->getAttributes();
        });

        return static::hydrate([$row])->first();
    }
}
