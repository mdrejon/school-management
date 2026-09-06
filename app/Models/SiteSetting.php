<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
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
        'about_page_breadcrumb_title',
        'about_page_seo_title',
        'about_page_seo_description',
        'about_page_seo_keywords',
        'chairman_name',
        'chairman_designation',
        'chairman_message',
        'chairman_page_breadcrumb_title',
        'chairman_page_seo_title',
        'chairman_page_seo_description',
        'chairman_page_seo_keywords',
        'principal_name',
        'principal_designation',
        'principal_message',
        'principal_page_breadcrumb_title',
        'principal_page_seo_title',
        'principal_page_seo_description',
        'principal_page_seo_keywords',
        'ex_principal_name',
        'ex_principal_designation',
        'ex_principal_message',
        'ex_principal_page_breadcrumb_title',
        'ex_principal_page_seo_title',
        'ex_principal_page_seo_description',
        'ex_principal_page_seo_keywords',
        'student_list_page_breadcrumb_title',
        'student_list_page_seo_title',
        'student_list_page_seo_description',
        'student_list_page_seo_keywords',
        'tuition_fee_page_breadcrumb_title',
        'tuition_fee_page_seo_title',
        'tuition_fee_page_seo_description',
        'tuition_fee_page_seo_keywords',
        'tuition_fee_page_content',
        'exam_result_page_breadcrumb_title',
        'exam_result_page_seo_title',
        'exam_result_page_seo_description',
        'exam_result_page_seo_keywords',
        'academic_result_page_breadcrumb_title',
        'academic_result_page_seo_title',
        'academic_result_page_seo_description',
        'academic_result_page_seo_keywords',
        'evaluation_result_page_breadcrumb_title',
        'evaluation_result_page_seo_title',
        'evaluation_result_page_seo_description',
        'evaluation_result_page_seo_keywords',
        'board_exam_result_page_breadcrumb_title',
        'board_exam_result_page_seo_title',
        'board_exam_result_page_seo_description',
        'board_exam_result_page_seo_keywords',
        'contact_open_time',
        'contact_open_time_label',
        'contact_address_label',
        'contact_address_value',
        'contact_phone_label',
        'contact_phone_value',
        'contact_email_label',
        'contact_email_value',
        'contact_form_title',
        'contact_form_description',
        'contact_page_breadcrumb_title',
        'contact_page_seo_title',
        'contact_page_seo_description',
        'contact_page_seo_keywords',
        'footer_quick_links_title',
        'footer_campus_title',
        'footer_newsletter_title',
        'footer_newsletter_text',
        'sidebar_notice_title',
        'sidebar_minister_name',
        'sidebar_minister_role',
        'sidebar_minister_button_text',
        'sidebar_minister_title',
        'sidebar_secretary_name',
        'sidebar_secretary_role',
        'sidebar_secretary_button_text',
        'sidebar_secretary_title',
        'sidebar_principal_button_text',
        'sidebar_principal_title',
        'sidebar_vice_principal_name',
        'sidebar_vice_principal_role',
        'sidebar_vice_principal_button_text',
        'sidebar_vice_principal_title',
        'sidebar_calendar_title',
    ];

    protected $fillable = [
        'site_name',
        'homepage_template',
        'primary_color',
        'secondary_color',
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
        'about_page_breadcrumb_image',
        'about_page_breadcrumb_title',
        'about_page_seo_title',
        'about_page_seo_description',
        'about_page_seo_keywords',
        'chairman_photo',
        'chairman_name',
        'chairman_designation',
        'chairman_message',
        'chairman_page_breadcrumb_image',
        'chairman_page_breadcrumb_title',
        'chairman_page_seo_title',
        'chairman_page_seo_description',
        'chairman_page_seo_keywords',
        'principal_photo',
        'principal_name',
        'principal_designation',
        'principal_message',
        'principal_page_breadcrumb_image',
        'principal_page_breadcrumb_title',
        'principal_page_seo_title',
        'principal_page_seo_description',
        'principal_page_seo_keywords',
        'ex_principal_photo',
        'ex_principal_name',
        'ex_principal_designation',
        'ex_principal_message',
        'ex_principal_page_breadcrumb_image',
        'ex_principal_page_breadcrumb_title',
        'ex_principal_page_seo_title',
        'ex_principal_page_seo_description',
        'ex_principal_page_seo_keywords',
        'student_list_page_breadcrumb_image',
        'student_list_page_breadcrumb_title',
        'student_list_page_seo_title',
        'student_list_page_seo_description',
        'student_list_page_seo_keywords',
        'tuition_fee_page_breadcrumb_image',
        'tuition_fee_page_breadcrumb_title',
        'tuition_fee_page_seo_title',
        'tuition_fee_page_seo_description',
        'tuition_fee_page_seo_keywords',
        'tuition_fee_page_content',
        'exam_result_page_breadcrumb_image',
        'exam_result_page_breadcrumb_title',
        'exam_result_page_seo_title',
        'exam_result_page_seo_description',
        'exam_result_page_seo_keywords',
        'academic_result_page_breadcrumb_image',
        'academic_result_page_breadcrumb_title',
        'academic_result_page_seo_title',
        'academic_result_page_seo_description',
        'academic_result_page_seo_keywords',
        'evaluation_result_page_breadcrumb_image',
        'evaluation_result_page_breadcrumb_title',
        'evaluation_result_page_seo_title',
        'evaluation_result_page_seo_description',
        'evaluation_result_page_seo_keywords',
        'board_exam_result_page_breadcrumb_image',
        'board_exam_result_page_breadcrumb_title',
        'board_exam_result_page_seo_title',
        'board_exam_result_page_seo_description',
        'board_exam_result_page_seo_keywords',
        'contact_open_time',
        'contact_open_time_label',
        'contact_address_label',
        'contact_address_value',
        'contact_phone_label',
        'contact_phone_value',
        'contact_email_label',
        'contact_email_value',
        'contact_form_title',
        'contact_form_description',
        'contact_image',
        'contact_map_embed_url',
        'contact_page_breadcrumb_image',
        'contact_page_breadcrumb_title',
        'contact_page_seo_title',
        'contact_page_seo_description',
        'contact_page_seo_keywords',
        'footer_quick_links_title',
        'footer_quick_links',
        'footer_campus_title',
        'footer_campus_links',
        'footer_newsletter_title',
        'footer_newsletter_text',
        'sidebar_notice_show',
        'sidebar_notice_title',
        'sidebar_notice_limit',
        'sidebar_minister_show',
        'sidebar_minister_photo',
        'sidebar_minister_name',
        'sidebar_minister_role',
        'sidebar_minister_button_text',
        'sidebar_minister_title',
        'sidebar_minister_button_url',
        'sidebar_secretary_show',
        'sidebar_secretary_photo',
        'sidebar_secretary_name',
        'sidebar_secretary_role',
        'sidebar_secretary_button_text',
        'sidebar_secretary_title',
        'sidebar_secretary_button_url',
        'sidebar_principal_show',
        'sidebar_principal_button_text',
        'sidebar_principal_title',
        'sidebar_vice_principal_show',
        'sidebar_vice_principal_photo',
        'sidebar_vice_principal_name',
        'sidebar_vice_principal_role',
        'sidebar_vice_principal_button_text',
        'sidebar_vice_principal_title',
        'sidebar_vice_principal_button_url',
        'sidebar_calendar_show',
        'sidebar_calendar_title',
    ];

    protected $casts = [
        'institute_info' => 'array',
        'cta_stats' => 'array',
        'partner_logos' => 'array',
        'choose_features' => 'array',
        'skill_items' => 'array',
        'about_badge_icon' => 'array',
        'about_items' => 'array',
        'footer_quick_links' => 'array',
        'footer_campus_links' => 'array',
        'sidebar_notice_show' => 'boolean',
        'sidebar_notice_limit' => 'integer',
        'sidebar_minister_show' => 'boolean',
        'sidebar_secretary_show' => 'boolean',
        'sidebar_principal_show' => 'boolean',
        'sidebar_vice_principal_show' => 'boolean',
        'sidebar_calendar_show' => 'boolean',
    ];

    protected $appends = [
        'logo_url', 'footer_logo_url', 'video_thumbnail_url', 'offer_background_url', 'choose_image_url',
        'about_image_1_url', 'about_image_2_url', 'about_image_3_url', 'about_page_breadcrumb_image_url',
        'chairman_photo_url', 'chairman_page_breadcrumb_image_url',
        'principal_photo_url', 'principal_page_breadcrumb_image_url',
        'ex_principal_photo_url', 'ex_principal_page_breadcrumb_image_url',
        'student_list_page_breadcrumb_image_url',
        'tuition_fee_page_breadcrumb_image_url',
        'exam_result_page_breadcrumb_image_url',
        'academic_result_page_breadcrumb_image_url',
        'evaluation_result_page_breadcrumb_image_url',
        'board_exam_result_page_breadcrumb_image_url',
        'contact_image_url', 'contact_page_breadcrumb_image_url',
        'sidebar_minister_photo_url', 'sidebar_secretary_photo_url', 'sidebar_vice_principal_photo_url',
    ];

    protected static function booted(): void
    {
        static::saved(fn () => Cache::forget('site_settings.current'));
    }

    public function getLogoUrlAttribute(): ?string
    {
        return $this->logo ? asset('storage/'.ltrim($this->logo, '/')) : null;
    }

    public function getFooterLogoUrlAttribute(): ?string
    {
        $logo = $this->footer_logo ?: $this->logo;

        return $logo ? '/storage/'.ltrim($logo, '/') : null;
    }

    public function getVideoThumbnailUrlAttribute(): ?string
    {
        return $this->video_thumbnail ? asset('storage/'.ltrim($this->video_thumbnail, '/')) : null;
    }

    public function getOfferBackgroundUrlAttribute(): ?string
    {
        return $this->offer_background ? asset('storage/'.ltrim($this->offer_background, '/')) : null;
    }

    public function getChooseImageUrlAttribute(): ?string
    {
        return $this->choose_image ? asset('storage/'.ltrim($this->choose_image, '/')) : null;
    }

    public function getAboutImage1UrlAttribute(): ?string
    {
        return $this->about_image_1 ? asset('storage/'.ltrim($this->about_image_1, '/')) : null;
    }

    public function getAboutImage2UrlAttribute(): ?string
    {
        return $this->about_image_2 ? asset('storage/'.ltrim($this->about_image_2, '/')) : null;
    }

    public function getAboutImage3UrlAttribute(): ?string
    {
        return $this->about_image_3 ? asset('storage/'.ltrim($this->about_image_3, '/')) : null;
    }

    public function getAboutPageBreadcrumbImageUrlAttribute(): ?string
    {
        return $this->about_page_breadcrumb_image ? asset('storage/'.ltrim($this->about_page_breadcrumb_image, '/')) : null;
    }

    public function getChairmanPhotoUrlAttribute(): ?string
    {
        return $this->chairman_photo ? asset('storage/'.ltrim($this->chairman_photo, '/')) : null;
    }

    public function getChairmanPageBreadcrumbImageUrlAttribute(): ?string
    {
        return $this->chairman_page_breadcrumb_image ? asset('storage/'.ltrim($this->chairman_page_breadcrumb_image, '/')) : null;
    }

    public function getPrincipalPhotoUrlAttribute(): ?string
    {
        return $this->principal_photo ? asset('storage/'.ltrim($this->principal_photo, '/')) : null;
    }

    public function getPrincipalPageBreadcrumbImageUrlAttribute(): ?string
    {
        return $this->principal_page_breadcrumb_image ? asset('storage/'.ltrim($this->principal_page_breadcrumb_image, '/')) : null;
    }

    public function getExPrincipalPhotoUrlAttribute(): ?string
    {
        return $this->ex_principal_photo ? asset('storage/'.ltrim($this->ex_principal_photo, '/')) : null;
    }

    public function getExPrincipalPageBreadcrumbImageUrlAttribute(): ?string
    {
        return $this->ex_principal_page_breadcrumb_image ? asset('storage/'.ltrim($this->ex_principal_page_breadcrumb_image, '/')) : null;
    }

    public function getStudentListPageBreadcrumbImageUrlAttribute()
    {
        return $this->student_list_page_breadcrumb_image ? Storage::disk('public')->url($this->student_list_page_breadcrumb_image) : null;
    }

    public function getTuitionFeePageBreadcrumbImageUrlAttribute()
    {
        return $this->tuition_fee_page_breadcrumb_image ? Storage::disk('public')->url($this->tuition_fee_page_breadcrumb_image) : null;
    }

    public function getExamResultPageBreadcrumbImageUrlAttribute()
    {
        return $this->exam_result_page_breadcrumb_image ? Storage::disk('public')->url($this->exam_result_page_breadcrumb_image) : null;
    }

    public function getAcademicResultPageBreadcrumbImageUrlAttribute()
    {
        return $this->academic_result_page_breadcrumb_image ? Storage::disk('public')->url($this->academic_result_page_breadcrumb_image) : null;
    }

    public function getEvaluationResultPageBreadcrumbImageUrlAttribute()
    {
        return $this->evaluation_result_page_breadcrumb_image ? Storage::disk('public')->url($this->evaluation_result_page_breadcrumb_image) : null;
    }

    public function getBoardExamResultPageBreadcrumbImageUrlAttribute()
    {
        return $this->board_exam_result_page_breadcrumb_image ? Storage::disk('public')->url($this->board_exam_result_page_breadcrumb_image) : null;
    }

    public function getContactImageUrlAttribute(): ?string
    {
        return $this->contact_image ? asset('storage/'.ltrim($this->contact_image, '/')) : null;
    }

    public function getContactPageBreadcrumbImageUrlAttribute(): ?string
    {
        return $this->contact_page_breadcrumb_image ? asset('storage/'.ltrim($this->contact_page_breadcrumb_image, '/')) : null;
    }

    public function getSidebarMinisterPhotoUrlAttribute(): ?string
    {
        return $this->sidebar_minister_photo ? asset('storage/'.ltrim($this->sidebar_minister_photo, '/')) : null;
    }

    public function getSidebarSecretaryPhotoUrlAttribute(): ?string
    {
        return $this->sidebar_secretary_photo ? asset('storage/'.ltrim($this->sidebar_secretary_photo, '/')) : null;
    }

    public function getSidebarVicePrincipalPhotoUrlAttribute(): ?string
    {
        return $this->sidebar_vice_principal_photo ? asset('storage/'.ltrim($this->sidebar_vice_principal_photo, '/')) : null;
    }

    /**
     * Footer "Quick Links" column rows resolved to plain strings for the
     * given locale — same shape/fallback as instituteInfoItems(), except
     * `url` is a plain (not translatable) freeform string the admin types
     * directly, not a route/model picker like MenuItem's — simpler than
     * reusing the header's WordPress-style menu builder for what's just
     * two flat footer columns with no submenus.
     */
    public function footerQuickLinkItems(?string $locale = null): array
    {
        $locale ??= app()->getLocale();
        $default = Language::defaultLanguage()?->code ?? config('app.fallback_locale');

        return collect($this->footer_quick_links ?? [])
            ->map(fn (array $item) => [
                'label' => $item['label'][$locale] ?? $item['label'][$default] ?? '',
                'url' => $item['url'] ?? '#',
            ])
            ->filter(fn (array $item) => $item['label'] !== '')
            ->values()
            ->all();
    }

    /**
     * Footer "Our Campus" column rows — same shape as footerQuickLinkItems().
     */
    public function footerCampusLinkItems(?string $locale = null): array
    {
        $locale ??= app()->getLocale();
        $default = Language::defaultLanguage()?->code ?? config('app.fallback_locale');

        return collect($this->footer_campus_links ?? [])
            ->map(fn (array $item) => [
                'label' => $item['label'][$locale] ?? $item['label'][$default] ?? '',
                'url' => $item['url'] ?? '#',
            ])
            ->filter(fn (array $item) => $item['label'] !== '')
            ->values()
            ->all();
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
