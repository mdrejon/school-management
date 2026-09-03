<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Spatie\Translatable\HasTranslations;

class VisionMissionPageSetting extends Model
{
    use HasTranslations;

    public array $translatable = [
        'tagline',
        'title',
        'highlight',
        'description',
        'experience_text',
        'mission_tagline',
        'mission_title',
        'mission_highlight',
        'mission_description',
        'mission_experience_text',
        'values_tagline',
        'values_title',
        'values_highlight',
        'values_description',
        'values_experience_text',
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
        'experience_text',
        'image_1',
        'image_2',
        'image_3',
        'mission_tagline',
        'mission_title',
        'mission_highlight',
        'mission_description',
        'mission_experience_text',
        'mission_image_1',
        'mission_image_2',
        'mission_image_3',
        'values_tagline',
        'values_title',
        'values_highlight',
        'values_description',
        'values_experience_text',
        'values_image_1',
        'values_image_2',
        'values_image_3',
        'breadcrumb_title',
        'breadcrumb_image',
        'seo_title',
        'seo_description',
        'seo_keywords',
    ];

    protected $appends = [
        'image_1_url',
        'image_2_url',
        'image_3_url',
        'mission_image_1_url',
        'mission_image_2_url',
        'mission_image_3_url',
        'values_image_1_url',
        'values_image_2_url',
        'values_image_3_url',
        'breadcrumb_image_url',
    ];

    protected static function booted(): void
    {
        static::saved(fn () => Cache::forget('vision_mission_page_settings.current'));
    }

    public function getImage1UrlAttribute(): ?string
    {
        return $this->image_1 ? asset('storage/'.ltrim($this->image_1, '/')) : null;
    }

    public function getImage2UrlAttribute(): ?string
    {
        return $this->image_2 ? asset('storage/'.ltrim($this->image_2, '/')) : null;
    }

    public function getImage3UrlAttribute(): ?string
    {
        return $this->image_3 ? asset('storage/'.ltrim($this->image_3, '/')) : null;
    }

    public function getMissionImage1UrlAttribute(): ?string
    {
        return $this->mission_image_1 ? asset('storage/'.ltrim($this->mission_image_1, '/')) : null;
    }

    public function getMissionImage2UrlAttribute(): ?string
    {
        return $this->mission_image_2 ? asset('storage/'.ltrim($this->mission_image_2, '/')) : null;
    }

    public function getMissionImage3UrlAttribute(): ?string
    {
        return $this->mission_image_3 ? asset('storage/'.ltrim($this->mission_image_3, '/')) : null;
    }

    public function getValuesImage1UrlAttribute(): ?string
    {
        return $this->values_image_1 ? asset('storage/'.ltrim($this->values_image_1, '/')) : null;
    }

    public function getValuesImage2UrlAttribute(): ?string
    {
        return $this->values_image_2 ? asset('storage/'.ltrim($this->values_image_2, '/')) : null;
    }

    public function getValuesImage3UrlAttribute(): ?string
    {
        return $this->values_image_3 ? asset('storage/'.ltrim($this->values_image_3, '/')) : null;
    }

    public function getBreadcrumbImageUrlAttribute(): ?string
    {
        return $this->breadcrumb_image ? asset('storage/'.ltrim($this->breadcrumb_image, '/')) : null;
    }

    public static function current(): self
    {
        $row = Cache::rememberForever('vision_mission_page_settings.current', function () {
            $settings = static::query()->first();

            if (! $settings) {
                $settings = static::create([
                    'tagline' => ['en' => 'Our Vision'],
                    'title' => ['en' => 'Shaping A Brighter Future For Every Student.'],
                    'highlight' => ['en' => 'Brighter Future'],
                    'description' => ['en' => 'There are many variations of passages available but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable.'],
                    'experience_text' => ['en' => "30 Years Of \n Quality Service"],
                    'mission_tagline' => ['en' => 'Our Mission'],
                    'mission_title' => ['en' => 'Empowering Students To Achieve Academic & Personal Excellence.'],
                    'mission_highlight' => ['en' => 'Empowering Students'],
                    'mission_description' => ['en' => 'Our mission is to provide an inclusive, inspiring learning environment that fosters critical thinking, creativity, moral values, and life-long learning skills.'],
                    'mission_experience_text' => ['en' => "Dedicated \n Educator Team"],
                    'values_tagline' => ['en' => 'Our Values'],
                    'values_title' => ['en' => 'Guiding Principles That Drive Our Educational Journey.'],
                    'values_highlight' => ['en' => 'Core Values'],
                    'values_description' => ['en' => "Integrity, Excellence, Innovation, Respect, and Community Engagement form the foundation of our institution's culture and daily endeavors."],
                    'values_experience_text' => ['en' => "Values Driven \n Community"],
                    'breadcrumb_title' => ['en' => 'Vision & Mission'],
                ]);
            }

            return $settings->getAttributes();
        });

        return static::hydrate([$row])->first();
    }
}
