<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRoleRequest extends FormRequest
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
            // "system_admin" is reserved — hidden, console-only role.
            'name' => ['required', 'string', 'max:255', 'not_in:system_admin', 'unique:roles,name'],
            'permissions' => ['nullable', 'array'],
            'permissions.*' => ['string', Rule::in($this->allPermissionKeys())],
        ];
    }

    /**
     * @return array<int, string>
     */
    protected function allPermissionKeys(): array
    {
        return collect(config('permissions'))
            ->flatMap(fn (array $resource, string $key) => collect($resource['actions'])
                ->map(fn (string $action) => "{$key}.{$action}"))
            ->values()
            ->all();
    }
}
