<?php

namespace App\Http\Requests\Admin;

use App\Models\Language;
use App\Models\MenuItem;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMenuItemRequest extends FormRequest
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
            'type' => ['required', Rule::in(['custom', 'route', 'model'])],

            "label.$default" => ['required', 'string', 'max:100'],
            'label.*' => ['nullable', 'string', 'max:100'],

            'url' => ['required_if:type,custom', 'nullable', 'string', 'max:500'],
            'route_name' => ['required_if:type,route', 'nullable', Rule::in(array_keys(MenuItem::builtInRoutes()))],
            'linkable_type' => ['required_if:type,model', 'nullable', Rule::in(array_keys(MenuItem::linkableTypes()))],
            'linkable_id' => ['required_if:type,model', 'nullable', 'integer'],

            'target' => ['nullable', Rule::in(['_self', '_blank'])],
            'is_active' => ['boolean'],
        ];
    }
}
