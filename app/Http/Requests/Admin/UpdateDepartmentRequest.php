<?php

namespace App\Http\Requests\Admin;

use App\Models\Language;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;

class UpdateDepartmentRequest extends FormRequest
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
        $departmentId = $this->route('department')?->id;

        return [
            'slug' => ['nullable', 'string', 'max:255', 'alpha_dash', 'unique:departments,slug,'.$departmentId],
            'icon.source' => ['required', 'in:lucide,upload'],
            'icon.value' => ['required', $this->iconValueRule()],

            "title.$default" => ['required', 'string', 'max:150'],
            'title.*' => ['nullable', 'string', 'max:150'],
            'short_description.*' => ['nullable', 'string', 'max:500'],
            'image' => ['nullable', 'image', 'max:4096'],

            "description.$default" => ['required', 'string', 'max:20000'],
            'description.*' => ['nullable', 'string', 'max:20000'],
            'gallery_image_1' => ['nullable', 'image', 'max:4096'],
            'gallery_image_2' => ['nullable', 'image', 'max:4096'],

            'requirement_title.*' => ['nullable', 'string', 'max:150'],
            'requirement_items' => ['nullable', 'array'],
            "requirement_items.*.text.$default" => ['required', 'string', 'max:500'],
            'requirement_items.*.text.*' => ['nullable', 'string', 'max:500'],

            'downloads' => ['nullable', 'array'],
            "downloads.*.label.$default" => ['required', 'string', 'max:150'],
            'downloads.*.label.*' => ['nullable', 'string', 'max:150'],
            'downloads.*.file' => ['nullable', 'file', 'mimes:pdf,doc,docx,xls,xlsx,zip', 'max:10240'],

            'is_active' => ['boolean'],
        ];
    }

    /**
     * Same pattern as StoreCourseRequest::iconValueRule().
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
