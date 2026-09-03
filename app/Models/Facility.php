<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Translatable\HasTranslations;

class Facility extends Model
{
    use HasTranslations;

    public array $translatable = [
        'title',
        'short_description',
        'description',
    ];

    protected $fillable = [
        'slug',
        'title',
        'short_description',
        'image',
        'description',
        'gallery_image_1',
        'gallery_image_2',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    protected $appends = ['image_url', 'gallery_image_1_url', 'gallery_image_2_url'];

    protected static function booted(): void
    {
        static::creating(function (Facility $facility) {
            if (blank($facility->slug)) {
                $default = Language::defaultLanguage()?->code ?? config('app.fallback_locale');
                $facility->slug = static::uniqueSlugFrom($facility->getTranslation('title', $default) ?: 'facility');
            }
        });
    }

    protected static function uniqueSlugFrom(string $source): string
    {
        $base = Str::slug($source) ?: 'facility';
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
}
