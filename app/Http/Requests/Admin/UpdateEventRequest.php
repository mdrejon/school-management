<?php

namespace App\Http\Requests\Admin;

use App\Models\Language;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateEventRequest extends FormRequest
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
        $eventId = $this->route('event')?->id;

        return [
            'slug' => ['nullable', 'string', 'max:255', 'alpha_dash', 'unique:events,slug,'.$eventId],
            'image' => ['nullable', 'image', 'max:4096'],

            "title.$default" => ['required', 'string', 'max:150'],
            'title.*' => ['nullable', 'string', 'max:150'],
            'location.*' => ['nullable', 'string', 'max:150'],
            'event_date' => ['nullable', 'date'],
            'event_time' => ['nullable', 'string', 'max:50'],
            'short_description.*' => ['nullable', 'string', 'max:500'],

            'content_blocks' => ['nullable', 'array'],
            "content_blocks.*.title.$default" => ['nullable', 'string', 'max:150'],
            'content_blocks.*.title.*' => ['nullable', 'string', 'max:150'],
            'content_blocks.*.description.*' => ['nullable', 'string', 'max:2000'],

            'gallery_image_1' => ['nullable', 'image', 'max:4096'],
            'gallery_image_2' => ['nullable', 'image', 'max:4096'],
            'map_embed_url' => ['nullable', 'string', 'max:2000'],

            'sidebar_intro.*' => ['nullable', 'string', 'max:500'],
            'cost' => ['nullable', 'string', 'max:100'],
            'button_text.*' => ['nullable', 'string', 'max:100'],
            'button_url' => ['nullable', 'string', 'max:255'],

            'organizer_name.*' => ['nullable', 'string', 'max:150'],
            'organizer_photo' => ['nullable', 'image', 'max:4096'],
            'organizer_bio.*' => ['nullable', 'string', 'max:1000'],

            'is_active' => ['boolean'],
        ];
    }
}
