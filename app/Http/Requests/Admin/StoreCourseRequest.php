<?php

namespace App\Http\Requests\Admin;

use App\Models\Language;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;

class StoreCourseRequest extends FormRequest
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
            'slug' => ['nullable', 'string', 'max:255', 'alpha_dash', 'unique:courses,slug'],
            'thumbnail' => ['required', 'image', 'max:4096'],

            "title.$default" => ['required', 'string', 'max:255'],
            'title.*' => ['nullable', 'string', 'max:255'],
            'category.*' => ['nullable', 'string', 'max:100'],
            'short_description.*' => ['nullable', 'string', 'max:500'],
            'lessons_count' => ['nullable', 'integer', 'min:0'],
            'rating' => ['nullable', 'numeric', 'between:0,5'],
            'seats' => ['nullable', 'integer', 'min:0'],
            'duration.*' => ['nullable', 'string', 'max:50'],
            'price' => ['nullable', 'string', 'max:50'],

            "description.$default" => ['required', 'string', 'max:20000'],
            'description.*' => ['nullable', 'string', 'max:20000'],
            'gallery_image_1' => ['nullable', 'image', 'max:4096'],
            'gallery_image_2' => ['nullable', 'image', 'max:4096'],
            'instructor_name.*' => ['nullable', 'string', 'max:150'],
            'instructor_image' => ['nullable', 'image', 'max:4096'],
            'enrolled_text.*' => ['nullable', 'string', 'max:100'],

            'requirement_title.*' => ['nullable', 'string', 'max:150'],
            'requirement_items' => ['nullable', 'array'],
            "requirement_items.*.text.$default" => ['required', 'string', 'max:500'],
            'requirement_items.*.text.*' => ['nullable', 'string', 'max:500'],

            'experience_title.*' => ['nullable', 'string', 'max:150'],
            'experience_description.*' => ['nullable', 'string', 'max:2000'],

            'features' => ['nullable', 'array'],
            "features.*.label.$default" => ['required', 'string', 'max:100'],
            'features.*.label.*' => ['nullable', 'string', 'max:100'],
            "features.*.value.$default" => ['required', 'string', 'max:100'],
            'features.*.value.*' => ['nullable', 'string', 'max:100'],
            'features.*.icon.source' => ['required', 'in:lucide,upload'],
            'features.*.icon.value' => ['required', $this->iconValueRule()],

            'is_active' => ['boolean'],
        ];
    }

    /**
     * Same pattern as UpdateSiteSettingRequest::iconValueRule() — a Lucide
     * icon name validated against the actually-installed icon set, or an
     * uploaded/kept custom image.
     */
    protected function iconValueRule(): \Closure
    {
        return function (string $attribute, mixed $value, \Closure $fail) {
            $source = $this->input(preg_replace('/\.value$/', '.source', $attribute));

            if ($source === 'lucide') {
                if (! is_string($value) || ! preg_match('/^[a-z0-9]+(-[a-z0-9]+)*$/', $value)) {
                    $fail('Invalid icon.');
                } elseif (! is_file(base_path("vendor/mallardduck/blade-lucide-icons/resources/svg/{$value}.svg"))) {
                    $fail('Unknown icon.');
                }

                return;
            }

            if ($value instanceof UploadedFile) {
                if (! $value->isValid()) {
                    $fail('The icon failed to upload.');
                } elseif (! in_array(strtolower($value->getClientOriginalExtension()), ['jpg', 'jpeg', 'png', 'svg', 'webp'])) {
                    $fail('The icon must be a jpg, png, svg, or webp file.');
                } elseif ($value->getSize() > 2048 * 1024) {
                    $fail('The icon must not be greater than 2MB.');
                }
            } elseif (! is_string($value) || $value === '') {
                $fail('The icon is required.');
            }
        };
    }
}
