<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCampusTourPageSettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tagline' => ['nullable', 'array'],
            'tagline.*' => ['nullable', 'string', 'max:255'],
            'title' => ['nullable', 'array'],
            'title.*' => ['nullable', 'string', 'max:255'],
            'highlight' => ['nullable', 'array'],
            'highlight.*' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'array'],
            'description.*' => ['nullable', 'string', 'max:2000'],
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
