<?php

namespace App\Http\Requests\Admin;

use App\Models\Language;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateFacilityRequest extends FormRequest
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
        $facilityId = $this->route('facility')?->id;

        return [
            'slug' => ['nullable', 'string', 'max:255', 'alpha_dash', 'unique:facilities,slug,'.$facilityId],
            'image' => ['nullable', 'image', 'max:4096'],

            "title.$default" => ['required', 'string', 'max:150'],
            'title.*' => ['nullable', 'string', 'max:150'],
            'short_description.*' => ['nullable', 'string', 'max:500'],

            "description.$default" => ['required', 'string', 'max:20000'],
            'description.*' => ['nullable', 'string', 'max:20000'],
            'gallery_image_1' => ['nullable', 'image', 'max:4096'],
            'gallery_image_2' => ['nullable', 'image', 'max:4096'],

            'is_active' => ['boolean'],
        ];
    }
}
