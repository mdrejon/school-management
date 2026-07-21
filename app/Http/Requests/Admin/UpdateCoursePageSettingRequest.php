<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCoursePageSettingRequest extends FormRequest
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
        return [
            'section_tagline.*' => ['nullable', 'string', 'max:100'],
            'section_title.*' => ['nullable', 'string', 'max:150'],
            'section_highlight.*' => ['nullable', 'string', 'max:50'],
            'section_description.*' => ['nullable', 'string', 'max:500'],

            'breadcrumb_title.*' => ['nullable', 'string', 'max:150'],
            'breadcrumb_image' => ['nullable', 'image', 'max:4096'],

            'seo_title.*' => ['nullable', 'string', 'max:255'],
            'seo_description.*' => ['nullable', 'string', 'max:500'],
            'seo_keywords.*' => ['nullable', 'string', 'max:255'],
        ];
    }
}
