<?php

namespace App\Http\Requests\Admin;

use App\Models\Language;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSliderRequest extends FormRequest
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
            'image' => ['nullable', 'image', 'max:4096'],
            "title.$default" => ['required', 'string', 'max:255'],
            'title.*' => ['nullable', 'string', 'max:255'],
            'sub_title.*' => ['nullable', 'string', 'max:255'],
            'highlight.*' => ['nullable', 'string', 'max:100'],
            'description.*' => ['nullable', 'string', 'max:1000'],
            'button_text.*' => ['nullable', 'string', 'max:100'],
            'button_url' => ['nullable', 'string', 'max:255'],
            'button2_text.*' => ['nullable', 'string', 'max:100'],
            'button2_url' => ['nullable', 'string', 'max:255'],
            'is_active' => ['boolean'],
        ];
    }
}
