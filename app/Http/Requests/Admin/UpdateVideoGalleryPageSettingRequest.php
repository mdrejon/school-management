<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVideoGalleryPageSettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'section_tagline' => ['nullable', 'array'],
            'section_title' => ['nullable', 'array'],
            'section_highlight' => ['nullable', 'array'],
            'section_description' => ['nullable', 'array'],
            'breadcrumb_title' => ['nullable', 'array'],
            'breadcrumb_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            
            'seo_title' => ['nullable', 'array'],
            'seo_description' => ['nullable', 'array'],
            'seo_keywords' => ['nullable', 'array'],
        ];
    }
}
