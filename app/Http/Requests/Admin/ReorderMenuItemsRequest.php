<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ReorderMenuItemsRequest extends FormRequest
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
     * The client flattens its current drag-and-drop tree into one array
     * covering every item in the menu (not just the ones that moved) —
     * simplest thing that's still correct after arbitrary drag operations.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'items' => ['required', 'array'],
            'items.*.id' => ['required'],
            'items.*.parent_id' => ['nullable'],
            'items.*.sort_order' => ['required', 'integer'],
            'items.*.menu_id' => ['nullable', 'integer'],
            'items.*.type' => ['nullable', 'string'],
            'items.*.label' => ['nullable', 'array'],
            'items.*.url' => ['nullable', 'string'],
            'items.*.route_name' => ['nullable', 'string'],
            'items.*.linkable_type' => ['nullable', 'string'],
            'items.*.linkable_id' => ['nullable'],
            'items.*.target' => ['nullable', 'string'],
            'items.*.is_active' => ['nullable', 'boolean'],
            'items.*.is_new' => ['nullable', 'boolean'],
        ];
    }
}
