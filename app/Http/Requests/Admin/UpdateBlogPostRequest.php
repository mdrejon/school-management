<?php

namespace App\Http\Requests\Admin;

use App\Models\Language;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBlogPostRequest extends FormRequest
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
        $postId = $this->route('blogPost')?->id;

        return [
            'slug' => ['nullable', 'string', 'max:255', 'alpha_dash', 'unique:blog_posts,slug,'.$postId],
            'image' => ['nullable', 'image', 'max:4096'],
            'published_at' => ['required', 'date'],

            "title.$default" => ['required', 'string', 'max:255'],
            'title.*' => ['nullable', 'string', 'max:255'],
            'short_description.*' => ['nullable', 'string', 'max:500'],
            'author_name.*' => ['nullable', 'string', 'max:150'],

            "description.$default" => ['required', 'string', 'max:20000'],
            'description.*' => ['nullable', 'string', 'max:20000'],
            'author_photo' => ['nullable', 'image', 'max:4096'],
            'author_bio.*' => ['nullable', 'string', 'max:1000'],
            'gallery_image_1' => ['nullable', 'image', 'max:4096'],
            'gallery_image_2' => ['nullable', 'image', 'max:4096'],

            'tags' => ['nullable', 'array'],
            "tags.*.tag.$default" => ['nullable', 'string', 'max:50'],
            'tags.*.tag.*' => ['nullable', 'string', 'max:50'],

            'is_active' => ['boolean'],
        ];
    }
}
