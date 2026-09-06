<?php

namespace App\Http\Requests\Admin;

use App\Models\Language;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;

class UpdateSiteSettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $default = Language::defaultLanguage()?->code ?? 'en';

        return [
            'homepage_template' => ['nullable', 'string', 'in:default,index-1,index-2'],
            'primary_color' => ['nullable', 'string', 'regex:/^#[a-fA-F0-9]{6}$/'],
            'secondary_color' => ['nullable', 'string', 'regex:/^#[a-fA-F0-9]{6}$/'],
            'logo' => ['nullable', 'image', 'max:2048'],
            'footer_logo' => ['nullable', 'image', 'max:2048'],

            "site_name.$default" => ['required', 'string', 'max:150'],
            'site_name.*' => ['nullable', 'string', 'max:150'],

            'address.*' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:150'],

            'facebook_url' => ['nullable', 'url', 'max:255'],
            'instagram_url' => ['nullable', 'url', 'max:255'],
            'youtube_url' => ['nullable', 'url', 'max:255'],
            'whatsapp_url' => ['nullable', 'url', 'max:255'],
            'linkedin_url' => ['nullable', 'url', 'max:255'],

            'footer_about.*' => ['nullable', 'string', 'max:1000'],
            'copyright_text.*' => ['nullable', 'string', 'max:150'],

            'footer_quick_links_title.*' => ['nullable', 'string', 'max:100'],
            'footer_quick_links' => ['nullable', 'array'],
            "footer_quick_links.*.label.$default" => ['required', 'string', 'max:100'],
            'footer_quick_links.*.label.*' => ['nullable', 'string', 'max:100'],
            'footer_quick_links.*.url' => ['nullable', 'string', 'max:255'],

            'footer_campus_title.*' => ['nullable', 'string', 'max:100'],
            'footer_campus_links' => ['nullable', 'array'],
            "footer_campus_links.*.label.$default" => ['required', 'string', 'max:100'],
            'footer_campus_links.*.label.*' => ['nullable', 'string', 'max:100'],
            'footer_campus_links.*.url' => ['nullable', 'string', 'max:255'],

            'footer_newsletter_title.*' => ['nullable', 'string', 'max:100'],
            'footer_newsletter_text.*' => ['nullable', 'string', 'max:255'],

            'institute_info' => ['nullable', 'array'],
            "institute_info.*.label.$default" => ['required', 'string', 'max:100'],
            'institute_info.*.label.*' => ['nullable', 'string', 'max:100'],
            "institute_info.*.value.$default" => ['required', 'string', 'max:100'],
            'institute_info.*.value.*' => ['nullable', 'string', 'max:100'],

            'cta_stats' => ['nullable', 'array'],
            'cta_stats.*.icon.source' => ['required', 'in:lucide,upload'],
            'cta_stats.*.icon.value' => ['required', $this->iconValueRule()],
            'cta_stats.*.value' => ['required', 'string', 'max:20'],
            "cta_stats.*.label.$default" => ['required', 'string', 'max:100'],
            'cta_stats.*.label.*' => ['nullable', 'string', 'max:100'],

            'partner_logos' => ['nullable', 'array'],
            // Each row is either a freshly-picked file (new/replaced logo)
            // or the existing storage path string (row left untouched) —
            // never both, so this can't use a single built-in file/string rule.
            'partner_logos.*.image' => ['required', function (string $attribute, mixed $value, \Closure $fail) {
                if ($value instanceof UploadedFile) {
                    if (! $value->isValid()) {
                        $fail('The image failed to upload.');
                    } elseif (! in_array(strtolower($value->getClientOriginalExtension()), ['jpg', 'jpeg', 'png', 'svg', 'webp'])) {
                        $fail('The image must be a jpg, png, svg, or webp file.');
                    } elseif ($value->getSize() > 2048 * 1024) {
                        $fail('The image must not be greater than 2MB.');
                    }
                } elseif (! is_string($value) || $value === '') {
                    $fail('The image is required.');
                }
            }],

            'video_thumbnail' => ['nullable', 'image', 'max:2048'],
            'video_tagline.*' => ['nullable', 'string', 'max:100'],
            'video_title.*' => ['nullable', 'string', 'max:150'],
            'video_highlight.*' => ['nullable', 'string', 'max:50'],
            'video_description.*' => ['nullable', 'string', 'max:500'],
            'video_button_text.*' => ['nullable', 'string', 'max:50'],
            'video_button_url' => ['nullable', 'string', 'max:255'],
            'video_youtube_url' => ['nullable', 'url', 'max:255'],

            'offer_background' => ['nullable', 'image', 'max:2048'],
            'offer_title.*' => ['nullable', 'string', 'max:150'],
            'offer_description.*' => ['nullable', 'string', 'max:500'],
            'offer_button_text.*' => ['nullable', 'string', 'max:50'],
            'offer_button_url' => ['nullable', 'string', 'max:255'],

            'choose_image' => ['nullable', 'image', 'max:2048'],
            'choose_tagline.*' => ['nullable', 'string', 'max:100'],
            'choose_title.*' => ['nullable', 'string', 'max:150'],
            'choose_highlight.*' => ['nullable', 'string', 'max:50'],
            'choose_description.*' => ['nullable', 'string', 'max:500'],
            'choose_features' => ['nullable', 'array'],
            'choose_features.*.icon.source' => ['required', 'in:lucide,upload'],
            'choose_features.*.icon.value' => ['required', $this->iconValueRule()],
            "choose_features.*.title.$default" => ['required', 'string', 'max:100'],
            'choose_features.*.title.*' => ['nullable', 'string', 'max:100'],
            "choose_features.*.description.$default" => ['required', 'string', 'max:255'],
            'choose_features.*.description.*' => ['nullable', 'string', 'max:255'],

            'skill_enroll_title.*' => ['nullable', 'string', 'max:100'],
            'skill_enroll_subtitle.*' => ['nullable', 'string', 'max:150'],
            'skill_tagline.*' => ['nullable', 'string', 'max:100'],
            'skill_title.*' => ['nullable', 'string', 'max:150'],
            'skill_highlight.*' => ['nullable', 'string', 'max:50'],
            'skill_description.*' => ['nullable', 'string', 'max:800'],
            'skill_button_text.*' => ['nullable', 'string', 'max:50'],
            'skill_button_url' => ['nullable', 'string', 'max:255'],
            'skill_items' => ['nullable', 'array'],
            "skill_items.*.label.$default" => ['required', 'string', 'max:100'],
            'skill_items.*.label.*' => ['nullable', 'string', 'max:100'],
            'skill_items.*.percentage' => ['required', 'integer', 'between:0,100'],

            'about_image_1' => ['nullable', 'image', 'max:2048'],
            'about_image_2' => ['nullable', 'image', 'max:2048'],
            'about_image_3' => ['nullable', 'image', 'max:2048'],
            'about_tagline.*' => ['nullable', 'string', 'max:100'],
            'about_title.*' => ['nullable', 'string', 'max:150'],
            'about_highlight.*' => ['nullable', 'string', 'max:50'],
            'about_description.*' => ['nullable', 'string', 'max:500'],
            'about_quote.*' => ['nullable', 'string', 'max:300'],
            'about_button_text.*' => ['nullable', 'string', 'max:50'],
            'about_button_url' => ['nullable', 'string', 'max:255'],
            'about_badge_text.*' => ['nullable', 'string', 'max:100'],
            'about_badge_icon.source' => ['required', 'in:lucide,upload'],
            'about_badge_icon.value' => ['required', $this->iconValueRule()],
            'about_items' => ['nullable', 'array'],
            'about_items.*.icon.source' => ['required', 'in:lucide,upload'],
            'about_items.*.icon.value' => ['required', $this->iconValueRule()],
            "about_items.*.title.$default" => ['required', 'string', 'max:100'],
            'about_items.*.title.*' => ['nullable', 'string', 'max:100'],
            "about_items.*.description.$default" => ['required', 'string', 'max:255'],
            'about_items.*.description.*' => ['nullable', 'string', 'max:255'],

            'about_page_breadcrumb_image' => ['nullable', 'image', 'max:2048'],
            'about_page_breadcrumb_title.*' => ['nullable', 'string', 'max:150'],
            'about_page_seo_title.*' => ['nullable', 'string', 'max:150'],
            'about_page_seo_description.*' => ['nullable', 'string', 'max:500'],
            'about_page_seo_keywords.*' => ['nullable', 'string', 'max:255'],

            'chairman_photo' => ['nullable', 'image', 'max:2048'],
            'chairman_name.*' => ['nullable', 'string', 'max:150'],
            'chairman_designation.*' => ['nullable', 'string', 'max:100'],
            'chairman_message.*' => ['nullable', 'string', 'max:2000'],
            'chairman_page_breadcrumb_image' => ['nullable', 'image', 'max:2048'],
            'chairman_page_breadcrumb_title.*' => ['nullable', 'string', 'max:150'],
            'chairman_page_seo_title.*' => ['nullable', 'string', 'max:150'],
            'chairman_page_seo_description.*' => ['nullable', 'string', 'max:500'],
            'chairman_page_seo_keywords.*' => ['nullable', 'string', 'max:255'],

            'principal_photo' => ['nullable', 'image', 'max:2048'],
            'principal_name.*' => ['nullable', 'string', 'max:150'],
            'principal_designation.*' => ['nullable', 'string', 'max:100'],
            'principal_message.*' => ['nullable', 'string', 'max:2000'],
            'principal_page_breadcrumb_image' => ['nullable', 'image', 'max:2048'],
            'principal_page_breadcrumb_title.*' => ['nullable', 'string', 'max:150'],
            'principal_page_seo_title.*' => ['nullable', 'string', 'max:150'],
            'principal_page_seo_description.*' => ['nullable', 'string', 'max:500'],
            'principal_page_seo_keywords.*' => ['nullable', 'string', 'max:255'],

            'ex_principal_photo' => ['nullable', 'image', 'max:2048'],
            'ex_principal_name.*' => ['nullable', 'string', 'max:150'],
            'ex_principal_designation.*' => ['nullable', 'string', 'max:100'],
            'ex_principal_message.*' => ['nullable', 'string', 'max:2000'],
            'ex_principal_page_breadcrumb_image' => ['nullable', 'image', 'max:2048'],
            'ex_principal_page_breadcrumb_title.*' => ['nullable', 'string', 'max:150'],
            'ex_principal_page_seo_title.*' => ['nullable', 'string', 'max:150'],
            'ex_principal_page_seo_description.*' => ['nullable', 'string', 'max:500'],
            'ex_principal_page_seo_keywords.*' => ['nullable', 'string', 'max:255'],

            'student_list_page_breadcrumb_image' => ['nullable', 'image', 'max:2048'],
            'student_list_page_breadcrumb_title.*' => ['nullable', 'string', 'max:150'],
            'student_list_page_seo_title.*' => ['nullable', 'string', 'max:150'],
            'student_list_page_seo_description.*' => ['nullable', 'string', 'max:500'],
            'student_list_page_seo_keywords.*' => ['nullable', 'string', 'max:255'],

            'tuition_fee_page_breadcrumb_image' => ['nullable', 'image', 'max:2048'],
            'tuition_fee_page_breadcrumb_title.*' => ['nullable', 'string', 'max:150'],
            'tuition_fee_page_seo_title.*' => ['nullable', 'string', 'max:150'],
            'tuition_fee_page_seo_description.*' => ['nullable', 'string', 'max:500'],
            'tuition_fee_page_seo_keywords.*' => ['nullable', 'string', 'max:255'],
            'tuition_fee_page_content.*' => ['nullable', 'string'],

            'contact_address_label.*' => ['nullable', 'string', 'max:100'],
            'contact_address_value.*' => ['nullable', 'string', 'max:255'],
            'contact_phone_label.*' => ['nullable', 'string', 'max:100'],
            'contact_phone_value.*' => ['nullable', 'string', 'max:50'],
            'contact_email_label.*' => ['nullable', 'string', 'max:100'],
            'contact_email_value.*' => ['nullable', 'string', 'max:150'],
            'contact_open_time_label.*' => ['nullable', 'string', 'max:100'],
            'contact_open_time.*' => ['nullable', 'string', 'max:150'],
            'contact_form_title.*' => ['nullable', 'string', 'max:150'],
            'contact_form_description.*' => ['nullable', 'string', 'max:500'],
            'contact_image' => ['nullable', 'image', 'max:2048'],
            'contact_map_embed_url' => ['nullable', 'string', 'max:1000'],
            'contact_page_breadcrumb_image' => ['nullable', 'image', 'max:2048'],
            'contact_page_breadcrumb_title.*' => ['nullable', 'string', 'max:150'],
            'contact_page_seo_title.*' => ['nullable', 'string', 'max:150'],
            'contact_page_seo_description.*' => ['nullable', 'string', 'max:500'],
            'contact_page_seo_keywords.*' => ['nullable', 'string', 'max:255'],

            'sidebar_notice_show' => ['nullable', 'boolean'],
            'sidebar_notice_title.*' => ['nullable', 'string', 'max:150'],
            'sidebar_notice_limit' => ['nullable', 'integer', 'between:1,20'],

            'sidebar_minister_show' => ['nullable', 'boolean'],
            'sidebar_minister_title.*' => ['nullable', 'string', 'max:150'],
            'sidebar_minister_photo' => ['nullable', 'image', 'max:2048'],
            'sidebar_minister_name.*' => ['nullable', 'string', 'max:150'],
            'sidebar_minister_role.*' => ['nullable', 'string', 'max:150'],
            'sidebar_minister_button_text.*' => ['nullable', 'string', 'max:100'],
            'sidebar_minister_button_url' => ['nullable', 'string', 'max:255'],

            'sidebar_secretary_show' => ['nullable', 'boolean'],
            'sidebar_secretary_title.*' => ['nullable', 'string', 'max:150'],
            'sidebar_secretary_photo' => ['nullable', 'image', 'max:2048'],
            'sidebar_secretary_name.*' => ['nullable', 'string', 'max:150'],
            'sidebar_secretary_role.*' => ['nullable', 'string', 'max:150'],
            'sidebar_secretary_button_text.*' => ['nullable', 'string', 'max:100'],
            'sidebar_secretary_button_url' => ['nullable', 'string', 'max:255'],

            'sidebar_principal_show' => ['nullable', 'boolean'],
            'sidebar_principal_title.*' => ['nullable', 'string', 'max:150'],
            'sidebar_principal_button_text.*' => ['nullable', 'string', 'max:100'],

            'sidebar_vice_principal_show' => ['nullable', 'boolean'],
            'sidebar_vice_principal_title.*' => ['nullable', 'string', 'max:150'],
            'sidebar_vice_principal_photo' => ['nullable', 'image', 'max:2048'],
            'sidebar_vice_principal_name.*' => ['nullable', 'string', 'max:150'],
            'sidebar_vice_principal_role.*' => ['nullable', 'string', 'max:150'],
            'sidebar_vice_principal_button_text.*' => ['nullable', 'string', 'max:100'],
            'sidebar_vice_principal_button_url' => ['nullable', 'string', 'max:255'],

            'sidebar_calendar_show' => ['nullable', 'boolean'],
            'sidebar_calendar_title.*' => ['nullable', 'string', 'max:150'],
        ];
    }

    /**
     * Shared by cta_stats/choose_features `icon.value`: a Lucide icon name
     * (validated against the actually-installed icon set, so a bad name can
     * never reach the DB and blow up `svg()` on the public homepage) or an
     * uploaded/kept custom image — mirrors the file-or-string pattern used
     * for partner_logos.*.image, keyed off the sibling `icon.source` field.
     */
    protected function iconValueRule(): \Closure
    {
        return function (string $attribute, mixed $value, \Closure $fail) {
            $source = $this->input(preg_replace('/\.value$/', '.source', $attribute));

            if ($source === 'lucide') {
                if (! is_string($value) || ! preg_match('/^[a-z0-9]+(-[a-z0-9]+)*$/', $value)) {
                    $fail('Invalid icon.');
                } elseif (! is_file(base_path("vendor/mallardduck/blade-lucide-icons/resources/svg/{$value}.svg"))) {
                    $fail('Unknown icon.');
                }

                return;
            }

            if ($value instanceof UploadedFile) {
                if (! $value->isValid()) {
                    $fail('The icon failed to upload.');
                } elseif (! in_array(strtolower($value->getClientOriginalExtension()), ['jpg', 'jpeg', 'png', 'svg', 'webp'])) {
                    $fail('The icon must be a jpg, png, svg, or webp file.');
                } elseif ($value->getSize() > 2048 * 1024) {
                    $fail('The icon must not be greater than 2MB.');
                }
            } elseif (! is_string($value) || $value === '') {
                $fail('The icon is required.');
            }
        };
    }
}
