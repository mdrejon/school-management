<?php

namespace App\Http\Requests\Admin;

use App\Models\Language;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePortfolioRequest extends FormRequest
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
        $portfolioId = $this->route('portfolio')?->id;

        return [
            'slug' => ['nullable', 'string', 'max:255', 'alpha_dash', 'unique:portfolios,slug,'.$portfolioId],
            'image' => ['nullable', 'image', 'max:4096'],

            "title.$default" => ['required', 'string', 'max:150'],
            'title.*' => ['nullable', 'string', 'max:150'],
            'category.*' => ['nullable', 'string', 'max:100'],

            "description.$default" => ['required', 'string', 'max:20000'],
            'description.*' => ['nullable', 'string', 'max:20000'],
            'gallery_image_1' => ['nullable', 'image', 'max:4096'],
            'gallery_image_2' => ['nullable', 'image', 'max:4096'],

            'highlight_title.*' => ['nullable', 'string', 'max:150'],
            'highlight_items' => ['nullable', 'array'],
            "highlight_items.*.text.$default" => ['required', 'string', 'max:500'],
            'highlight_items.*.text.*' => ['nullable', 'string', 'max:500'],

            'overview_title.*' => ['nullable', 'string', 'max:150'],
            'overview_description.*' => ['nullable', 'string', 'max:2000'],

            'client_name' => ['nullable', 'string', 'max:150'],
            'event_date' => ['nullable', 'date'],
            'cost' => ['nullable', 'string', 'max:100'],
            'manager_name' => ['nullable', 'string', 'max:150'],
            'location' => ['nullable', 'string', 'max:150'],
            'website_url' => ['nullable', 'string', 'max:255'],
            'rating' => ['nullable', 'integer', 'between:0,5'],

            'is_active' => ['boolean'],
        ];
    }
}
