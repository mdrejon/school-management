<?php

namespace App\Http\Requests\Admin;

use App\Models\Language;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreTeacherRequest extends FormRequest
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
            'slug' => ['nullable', 'string', 'max:255', 'alpha_dash', 'unique:teachers,slug'],
            'photo' => ['required', 'image', 'max:4096'],

            "name.$default" => ['required', 'string', 'max:150'],
            'name.*' => ['nullable', 'string', 'max:150'],
            'designation.*' => ['nullable', 'string', 'max:150'],
            'short_intro.*' => ['nullable', 'string', 'max:500'],
            'address.*' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:150'],
            'phone' => ['nullable', 'string', 'max:50'],
            'facebook_url' => ['nullable', 'string', 'max:255'],
            'whatsapp_url' => ['nullable', 'string', 'max:255'],
            'behance_url' => ['nullable', 'string', 'max:255'],
            'pinterest_url' => ['nullable', 'string', 'max:255'],
            'linkedin_url' => ['nullable', 'string', 'max:255'],

            "biography.$default" => ['required', 'string', 'max:20000'],
            'biography.*' => ['nullable', 'string', 'max:20000'],

            'skills' => ['nullable', 'array'],
            "skills.*.label.$default" => ['required', 'string', 'max:100'],
            'skills.*.label.*' => ['nullable', 'string', 'max:100'],
            'skills.*.percentage' => ['required', 'integer', 'between:0,100'],

            'is_active' => ['boolean'],
        ];
    }
}
