<?php

namespace App\Http\Requests\Admin;

use App\Models\Language;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreTestimonialRequest extends FormRequest
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
            "quote.$default" => ['required', 'string', 'max:500'],
            'quote.*' => ['nullable', 'string', 'max:500'],
            'rating' => ['required', 'integer', 'between:1,5'],
            "author_name.$default" => ['required', 'string', 'max:150'],
            'author_name.*' => ['nullable', 'string', 'max:150'],
            'author_role.*' => ['nullable', 'string', 'max:100'],
            'author_photo' => ['nullable', 'image', 'max:4096'],
            'is_active' => ['boolean'],
        ];
    }
}
