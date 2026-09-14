<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Cache;
use Spatie\Translatable\HasTranslations;

class EducationLevelPageSetting extends Model
{
    use HasTranslations;

    public array $translatable = [
        'breadcrumb_title',
        'seo_title',
        'seo_description',
        'seo_keywords',
    ];

    protected $fillable = [
        'breadcrumb_title',
        'breadcrumb_image',
        'seo_title',
        'seo_description',
        'seo_keywords',
    ];

    protected $appends = ['breadcrumb_image_url'];

    protected static function booted(): void
    {
        static::saved(fn () => Cache::forget('education_level_page_settings.current'));
    }

    public function getBreadcrumbImageUrlAttribute(): ?string
    {
        return $this->breadcrumb_image ? asset('storage/'.ltrim($this->breadcrumb_image, '/')) : null;
    }

    public static function current(): self
    {
        $row = Cache::rememberForever('education_level_page_settings.current', function () {
            $settings = static::query()->first();

            if (! $settings) {
                $settings = static::create([
                    'breadcrumb_title' => ["en" => "Education Levels"],
                ]);
            }

            return $settings->getAttributes();
        });

        return static::hydrate([$row])->first();
    }
}
