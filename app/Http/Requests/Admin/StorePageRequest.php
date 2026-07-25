<?php

namespace App\Http\Requests\Admin;

use App\Models\Language;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePageRequest extends FormRequest
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
     * `content` (the page body) isn't submitted through this form at all —
     * it's edited and saved separately by the Vvveb.js visual builder (see
     * Admin\PageVisualBuilderController), one HTML string per language.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $default = Language::defaultLanguage()?->code ?? 'en';

        return [
            'slug' => ['nullable', 'string', 'max:255', 'alpha_dash', 'unique:pages,slug'],

            "title.$default" => ['required', 'string', 'max:150'],
            'title.*' => ['nullable', 'string', 'max:150'],

            'custom_css' => ['nullable', 'string', 'max:20000'],
            'breadcrumb_image' => ['nullable', 'image', 'max:4096'],

            'seo_title.*' => ['nullable', 'string', 'max:150'],
            'seo_description.*' => ['nullable', 'string', 'max:500'],
            'seo_keywords.*' => ['nullable', 'string', 'max:255'],

            'is_active' => ['boolean'],
        ];
    }
}
