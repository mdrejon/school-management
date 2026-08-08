<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClassScheduleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'array'],
            'title.*' => ['nullable', 'string', 'max:255'],
            'time_info' => ['required', 'array'],
            'time_info.*' => ['nullable', 'string', 'max:255'],
            'is_bullet' => ['boolean'],
            'sort_order' => ['integer'],
            'is_active' => ['boolean'],
        ];
    }
}
