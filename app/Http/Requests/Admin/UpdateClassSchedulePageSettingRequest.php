<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClassSchedulePageSettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'section_title' => ['nullable', 'array'],
            'section_title.*' => ['nullable', 'string', 'max:255'],
            'section_description' => ['nullable', 'array'],
            'section_description.*' => ['nullable', 'string', 'max:1000'],
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
