<?php

namespace App\Http\Requests\Admin;

use App\Models\Language;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateFounderRequest extends FormRequest
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
            "name.$default" => ['required', 'string', 'max:150'],
            'name.*' => ['nullable', 'string', 'max:150'],
            'designation.*' => ['nullable', 'string', 'max:150'],
            'year' => ['nullable', 'string', 'max:20'],
            'is_active' => ['boolean'],
        ];
    }
}
