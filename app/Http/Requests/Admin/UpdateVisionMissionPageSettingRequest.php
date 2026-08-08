<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVisionMissionPageSettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // Vision rules
            'tagline' => ['nullable', 'array'],
            'tagline.*' => ['nullable', 'string', 'max:255'],
            'title' => ['nullable', 'array'],
            'title.*' => ['nullable', 'string', 'max:255'],
            'highlight' => ['nullable', 'array'],
            'highlight.*' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'array'],
            'description.*' => ['nullable', 'string', 'max:2000'],
            'experience_text' => ['nullable', 'array'],
            'experience_text.*' => ['nullable', 'string', 'max:255'],
            'image_1' => ['nullable', 'image', 'max:2048'],
            'image_2' => ['nullable', 'image', 'max:2048'],
            'image_3' => ['nullable', 'image', 'max:2048'],

            // Mission rules
            'mission_tagline' => ['nullable', 'array'],
            'mission_tagline.*' => ['nullable', 'string', 'max:255'],
            'mission_title' => ['nullable', 'array'],
            'mission_title.*' => ['nullable', 'string', 'max:255'],
            'mission_highlight' => ['nullable', 'array'],
            'mission_highlight.*' => ['nullable', 'string', 'max:255'],
            'mission_description' => ['nullable', 'array'],
            'mission_description.*' => ['nullable', 'string', 'max:2000'],
            'mission_experience_text' => ['nullable', 'array'],
            'mission_experience_text.*' => ['nullable', 'string', 'max:255'],
            'mission_image_1' => ['nullable', 'image', 'max:2048'],
            'mission_image_2' => ['nullable', 'image', 'max:2048'],
            'mission_image_3' => ['nullable', 'image', 'max:2048'],

            // Values rules
            'values_tagline' => ['nullable', 'array'],
            'values_tagline.*' => ['nullable', 'string', 'max:255'],
            'values_title' => ['nullable', 'array'],
            'values_title.*' => ['nullable', 'string', 'max:255'],
            'values_highlight' => ['nullable', 'array'],
            'values_highlight.*' => ['nullable', 'string', 'max:255'],
            'values_description' => ['nullable', 'array'],
            'values_description.*' => ['nullable', 'string', 'max:2000'],
            'values_experience_text' => ['nullable', 'array'],
            'values_experience_text.*' => ['nullable', 'string', 'max:255'],
            'values_image_1' => ['nullable', 'image', 'max:2048'],
            'values_image_2' => ['nullable', 'image', 'max:2048'],
            'values_image_3' => ['nullable', 'image', 'max:2048'],

            // Breadcrumb & SEO
            'breadcrumb_title' => ['nullable', 'array'],
            'breadcrumb_title.*' => ['nullable', 'string', 'max:255'],
            'breadcrumb_image' => ['nullable', 'image', 'max:2048'],
            'seo_title' => ['nullable', 'array'],
            'seo_title.*' => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'array'],
            'seo_description.*' => ['nullable', 'string', 'max:1000'],
            'seo_keywords' => ['nullable', 'array'],
            'seo_keywords.*' => ['nullable', 'string', 'max:255'],
        ];
    }
}
