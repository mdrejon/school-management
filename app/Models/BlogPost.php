<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Translatable\HasTranslations;

class BlogPost extends Model
{
    use HasTranslations;

    public array $translatable = [
        'title',
        'short_description',
        'author_name',
        'description',
        'author_bio',
    ];

    protected $fillable = [
        'slug',
        'title',
        'short_description',
        'image',
        'published_at',
        'author_name',
        'description',
        'author_photo',
        'author_bio',
        'gallery_image_1',
        'gallery_image_2',
        'tags',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'published_at' => 'date',
        'tags' => 'array',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    protected $appends = ['image_url', 'gallery_image_1_url', 'gallery_image_2_url', 'author_photo_url'];

    protected static function booted(): void
    {
        static::creating(function (BlogPost $post) {
            if (blank($post->slug)) {
                $default = Language::defaultLanguage()?->code ?? config('app.fallback_locale');
                $post->slug = static::uniqueSlugFrom($post->getTranslation('title', $default) ?: 'post');
            }
        });
    }

    protected static function uniqueSlugFrom(string $source): string
    {
        $base = Str::slug($source) ?: 'post';
        $slug = $base;
        $suffix = 2;

        while (static::where('slug', $slug)->exists()) {
            $slug = "{$base}-{$suffix}";
            $suffix++;
        }

        return $slug;
    }

    public function getImageUrlAttribute(): ?string
    {
        return $this->image ? asset('storage/'.ltrim($this->image, '/')) : null;
    }

    public function getGalleryImage1UrlAttribute(): ?string
    {
        return $this->gallery_image_1 ? asset('storage/'.ltrim($this->gallery_image_1, '/')) : null;
    }

    public function getGalleryImage2UrlAttribute(): ?string
    {
        return $this->gallery_image_2 ? asset('storage/'.ltrim($this->gallery_image_2, '/')) : null;
    }

    public function getAuthorPhotoUrlAttribute(): ?string
    {
        return $this->author_photo ? asset('storage/'.ltrim($this->author_photo, '/')) : null;
    }

    /**
     * Plain tag list resolved to plain strings for the given locale — same
     * pattern as Course::requirementItems().
     */
    public function tagItems(?string $locale = null): array
    {
        $locale ??= app()->getLocale();
        $default = Language::defaultLanguage()?->code ?? config('app.fallback_locale');

        return collect($this->tags ?? [])
            ->map(fn (array $item) => $item['tag'][$locale] ?? $item['tag'][$default] ?? '')
            ->filter(fn (string $tag) => $tag !== '')
            ->values()
            ->all();
    }

    public static function forHomepage(int $limit = 3)
    {
        return static::where('is_active', true)->orderBy('sort_order')->limit($limit)->get();
    }
}
