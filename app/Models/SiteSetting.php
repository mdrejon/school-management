<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Spatie\Translatable\HasTranslations;

class SiteSetting extends Model
{
    use HasTranslations;

    public array $translatable = [
        'site_name',
        'address',
        'footer_about',
        'copyright_text',
        'video_tagline',
        'video_title',
        'video_highlight',
        'video_description',
        'video_button_text',
        'offer_title',
        'offer_description',
        'offer_button_text',
        'choose_tagline',
        'choose_title',
        'choose_highlight',
        'choose_description',
        'skill_enroll_title',
        'skill_enroll_subtitle',
        'skill_tagline',
        'skill_title',
        'skill_highlight',
        'skill_description',
        'skill_button_text',
        'about_tagline',
        'about_title',
        'about_highlight',
        'about_description',
        'about_quote',
        'about_button_text',
        'about_badge_text',
    ];

    protected $fillable = [
        'site_name',
        'logo',
        'footer_logo',
        'address',
        'phone',
        'email',
        'facebook_url',
        'instagram_url',
        'youtube_url',
        'whatsapp_url',
        'linkedin_url',
        'footer_about',
        'copyright_text',
        'institute_info',
        'cta_stats',
        'partner_logos',
        'video_tagline',
        'video_title',
        'video_highlight',
        'video_description',
        'video_button_text',
        'video_button_url',
        'video_youtube_url',
        'video_thumbnail',
        'offer_title',
        'offer_description',
        'offer_button_text',
        'offer_button_url',
        'offer_background',
        'choose_tagline',
        'choose_title',
        'choose_highlight',
        'choose_description',
        'choose_image',
        'choose_features',
        'skill_enroll_title',
        'skill_enroll_subtitle',
        'skill_tagline',
        'skill_title',
        'skill_highlight',
        'skill_description',
        'skill_button_text',
        'skill_button_url',
        'skill_items',
        'about_button_url',
        'about_badge_icon',
        'about_image_1',
        'about_image_2',
        'about_image_3',
        'about_items',
    ];

    protected $casts = [
        'institute_info' => 'array',
        'cta_stats' => 'array',
        'partner_logos' => 'array',
        'choose_features' => 'array',
        'skill_items' => 'array',
        'about_badge_icon' => 'array',
        'about_items' => 'array',
    ];

    protected $appends = [
        'logo_url', 'footer_logo_url', 'video_thumbnail_url', 'offer_background_url', 'choose_image_url',
        'about_image_1_url', 'about_image_2_url', 'about_image_3_url',
    ];

    protected static function booted(): void
    {
        static::saved(fn () => Cache::forget('site_settings.current'));
    }

    public function getLogoUrlAttribute(): ?string
    {
        return $this->logo ? '/storage/'.ltrim($this->logo, '/') : null;
    }

    public function getFooterLogoUrlAttribute(): ?string
    {
        $logo = $this->footer_logo ?: $this->logo;

        return $logo ? '/storage/'.ltrim($logo, '/') : null;
    }

    public function getVideoThumbnailUrlAttribute(): ?string
    {
        return $this->video_thumbnail ? '/storage/'.ltrim($this->video_thumbnail, '/') : null;
    }

    public function getOfferBackgroundUrlAttribute(): ?string
    {
        return $this->offer_background ? '/storage/'.ltrim($this->offer_background, '/') : null;
    }

    public function getChooseImageUrlAttribute(): ?string
    {
        return $this->choose_image ? '/storage/'.ltrim($this->choose_image, '/') : null;
    }

    public function getAboutImage1UrlAttribute(): ?string
    {
        return $this->about_image_1 ? '/storage/'.ltrim($this->about_image_1, '/') : null;
    }

    public function getAboutImage2UrlAttribute(): ?string
    {
        return $this->about_image_2 ? '/storage/'.ltrim($this->about_image_2, '/') : null;
    }

    public function getAboutImage3UrlAttribute(): ?string
    {
        return $this->about_image_3 ? '/storage/'.ltrim($this->about_image_3, '/') : null;
    }

    /**
     * Institute info repeater rows resolved to plain strings for the given
     * locale (each row's label/value are themselves per-language, so this
     * can't go through HasTranslations — that only resolves flat
     * locale-keyed columns). Falls back to the default language, same as
     * every other translatable field on the public site.
     */
    public function instituteInfoItems(?string $locale = null): array
    {
        $locale ??= app()->getLocale();
        $default = Language::defaultLanguage()?->code ?? config('app.fallback_locale');

        return collect($this->institute_info ?? [])
            ->map(fn (array $item) => [
                'label' => $item['label'][$locale] ?? $item['label'][$default] ?? '',
                'value' => $item['value'][$locale] ?? $item['value'][$default] ?? '',
            ])
            ->filter(fn (array $item) => $item['label'] !== '' || $item['value'] !== '')
            ->values()
            ->all();
    }

    /**
     * Homepage counter/CTA strip rows resolved to plain strings for the
     * given locale — icon and value are plain (not per-language), only
     * label goes through the same fallback as instituteInfoItems().
     */
    public function ctaStatsItems(?string $locale = null): array
    {
        $locale ??= app()->getLocale();
        $default = Language::defaultLanguage()?->code ?? config('app.fallback_locale');

        return collect($this->cta_stats ?? [])
            ->map(fn (array $item) => [
                'icon' => $item['icon'] ?? ['source' => 'upload', 'value' => ''],
                'value' => $item['value'] ?? '',
                'label' => $item['label'][$locale] ?? $item['label'][$default] ?? '',
            ])
            ->filter(fn (array $item) => $item['label'] !== '' || $item['value'] !== '')
            ->values()
            ->all();
    }

    /**
     * Partner logo strip resolved to public URLs. No label — logos aren't
     * translatable, unlike institute_info/cta_stats.
     */
    public function partnerLogoItems(): array
    {
        return collect($this->partner_logos ?? [])
            ->map(fn (array $item) => [
                'image_url' => isset($item['image']) ? '/storage/'.ltrim($item['image'], '/') : null,
            ])
            ->filter(fn (array $item) => filled($item['image_url']))
            ->values()
            ->all();
    }

    /**
     * "Why Choose Us" feature boxes resolved to plain strings for the given
     * locale — icon is plain, title/description follow the same fallback
     * as instituteInfoItems().
     */
    public function chooseFeatureItems(?string $locale = null): array
    {
        $locale ??= app()->getLocale();
        $default = Language::defaultLanguage()?->code ?? config('app.fallback_locale');

        return collect($this->choose_features ?? [])
            ->map(fn (array $item) => [
                'icon' => $item['icon'] ?? ['source' => 'upload', 'value' => ''],
                'title' => $item['title'][$locale] ?? $item['title'][$default] ?? '',
                'description' => $item['description'][$locale] ?? $item['description'][$default] ?? '',
            ])
            ->filter(fn (array $item) => $item['title'] !== '' || $item['description'] !== '')
            ->values()
            ->all();
    }

    /**
     * "Our Skills" progress bars resolved to plain strings for the given
     * locale — percentage is plain, label follows the same fallback as
     * instituteInfoItems().
     */
    public function skillItems(?string $locale = null): array
    {
        $locale ??= app()->getLocale();
        $default = Language::defaultLanguage()?->code ?? config('app.fallback_locale');

        return collect($this->skill_items ?? [])
            ->map(fn (array $item) => [
                'label' => $item['label'][$locale] ?? $item['label'][$default] ?? '',
                'percentage' => $item['percentage'] ?? '',
            ])
            ->filter(fn (array $item) => $item['label'] !== '')
            ->values()
            ->all();
    }

    /**
     * "About Us" feature items resolved to plain strings for the given
     * locale — same shape/fallback as chooseFeatureItems().
     */
    public function aboutItems(?string $locale = null): array
    {
        $locale ??= app()->getLocale();
        $default = Language::defaultLanguage()?->code ?? config('app.fallback_locale');

        return collect($this->about_items ?? [])
            ->map(fn (array $item) => [
                'icon' => $item['icon'] ?? ['source' => 'upload', 'value' => ''],
                'title' => $item['title'][$locale] ?? $item['title'][$default] ?? '',
                'description' => $item['description'][$locale] ?? $item['description'][$default] ?? '',
            ])
            ->filter(fn (array $item) => $item['title'] !== '' || $item['description'] !== '')
            ->values()
            ->all();
    }

    /**
     * The single settings row, created with sane defaults on first access.
     *
     * Cached as the model's raw attributes (getAttributes()), not the
     * model itself and not toArray(): caching the model risks the database
     * cache driver corrupting the serialized object into
     * __PHP_Incomplete_Class on unserialize (see Language::active()), and
     * toArray() is worse here specifically — HasTranslations overrides
     * attribute access so toArray() would resolve site_name/address/etc.
     * down to just the current request's locale, permanently losing every
     * other language's text the moment it's cached. getAttributes() returns
     * the untouched raw values (translatable columns still as JSON
     * strings), which is both safe to serialize and locale-agnostic.
     */
    public static function current(): self
    {
        $row = Cache::rememberForever('site_settings.current', function () {
            $settings = static::query()->first();

            if (! $settings) {
                $settings = static::create([
                    'site_name' => ['en' => config('app.name', 'School')],
                    'copyright_text' => ['en' => 'All Rights Reserved.'],
                ]);
            }

            return $settings->getAttributes();
        });

        return static::hydrate([$row])->first();
    }
}
