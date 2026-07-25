<?php

namespace App\Http\Requests\Admin;

use App\Models\Language;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateNoticeRequest extends FormRequest
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
        $noticeId = $this->route('notice')?->id;

        return [
            'slug' => ['nullable', 'string', 'max:255', 'alpha_dash', 'unique:notices,slug,'.$noticeId],

            "title.$default" => ['required', 'string', 'max:255'],
            'title.*' => ['nullable', 'string', 'max:255'],

            "description.$default" => ['required', 'string', 'max:20000'],
            'description.*' => ['nullable', 'string', 'max:20000'],

            'pdf' => ['nullable', 'file', 'mimes:pdf', 'max:10240'],
            'published_at' => ['required', 'date'],

            'is_active' => ['boolean'],
        ];
    }
}
