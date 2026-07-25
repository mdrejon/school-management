<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateModuleSettingsRequest extends FormRequest
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
            'modules' => ['required', 'array'],
            'modules.*.key' => ['required', 'string', Rule::in(array_keys(config('modules')))],
            'modules.*.is_enabled' => ['required', 'boolean'],
            'modules.*.show_on_homepage' => ['required', 'boolean'],
        ];
    }
}
