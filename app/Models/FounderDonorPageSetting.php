<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Spatie\Translatable\HasTranslations;

class FounderDonorPageSetting extends Model
{
    use HasTranslations;

    public array $translatable = [
        'section_tagline',
        'section_title',
        'section_highlight',
        'section_description',
        'founders_table_title',
        'donors_table_title',
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
        'founders_table_title',
        'donors_table_title',
        'breadcrumb_title',
        'breadcrumb_image',
        'seo_title',
        'seo_description',
        'seo_keywords',
    ];

    protected $appends = ['breadcrumb_image_url'];

    protected static function booted(): void
    {
        static::saved(fn () => Cache::forget('founder_donor_page_settings.current'));
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
        $row = Cache::rememberForever('founder_donor_page_settings.current', function () {
            $settings = static::query()->first();

            if (! $settings) {
                $settings = static::create([
                    'section_tagline' => ['en' => 'Our Contributors'],
                    'section_title' => ['en' => 'Founder & Donor List'],
                    'section_highlight' => ['en' => 'Donor'],
                    'section_description' => ['en' => 'We gratefully acknowledge the founding members and generous donors whose vision and support made the growth of this institution possible.'],
                    'founders_table_title' => ['en' => 'Founding Members'],
                    'donors_table_title' => ['en' => 'Honorable Donors'],
                    'breadcrumb_title' => ['en' => 'Founder & Donor List'],
                ]);
            }

            return $settings->getAttributes();
        });

        return static::hydrate([$row])->first();
    }
}
