<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Translatable\HasTranslations;

class Event extends Model
{
    use HasTranslations;

    public array $translatable = [
        'title',
        'location',
        'short_description',
        'sidebar_intro',
        'button_text',
        'organizer_name',
        'organizer_bio',
    ];

    protected $fillable = [
        'slug',
        'title',
        'location',
        'image',
        'event_date',
        'event_time',
        'short_description',
        'content_blocks',
        'gallery_image_1',
        'gallery_image_2',
        'map_embed_url',
        'sidebar_intro',
        'cost',
        'button_text',
        'button_url',
        'organizer_name',
        'organizer_photo',
        'organizer_bio',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'content_blocks' => 'array',
        'event_date' => 'date',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    protected $appends = ['image_url', 'gallery_image_1_url', 'gallery_image_2_url', 'organizer_photo_url'];

    protected static function booted(): void
    {
        static::creating(function (Event $event) {
            if (blank($event->slug)) {
                $default = Language::defaultLanguage()?->code ?? config('app.fallback_locale');
                $event->slug = static::uniqueSlugFrom($event->getTranslation('title', $default) ?: 'event');
            }
        });
    }

    protected static function uniqueSlugFrom(string $source): string
    {
        $base = Str::slug($source) ?: 'event';
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
        return $this->image ? '/storage/'.ltrim($this->image, '/') : null;
    }

    public function getGalleryImage1UrlAttribute(): ?string
    {
        return $this->gallery_image_1 ? '/storage/'.ltrim($this->gallery_image_1, '/') : null;
    }

    public function getGalleryImage2UrlAttribute(): ?string
    {
        return $this->gallery_image_2 ? '/storage/'.ltrim($this->gallery_image_2, '/') : null;
    }

    public function getOrganizerPhotoUrlAttribute(): ?string
    {
        return $this->organizer_photo ? '/storage/'.ltrim($this->organizer_photo, '/') : null;
    }

    /**
     * "About/Where/Who" style content blocks resolved to plain strings for
     * the given locale — same shape/fallback as SiteSetting::aboutItems()
     * minus the icon.
     */
    public function contentBlocks(?string $locale = null): array
    {
        $locale ??= app()->getLocale();
        $default = Language::defaultLanguage()?->code ?? config('app.fallback_locale');

        return collect($this->content_blocks ?? [])
            ->map(fn (array $item) => [
                'title' => $item['title'][$locale] ?? $item['title'][$default] ?? '',
                'description' => $item['description'][$locale] ?? $item['description'][$default] ?? '',
            ])
            ->filter(fn (array $item) => $item['title'] !== '' || $item['description'] !== '')
            ->values()
            ->all();
    }

    public static function forHomepage(int $limit = 6)
    {
        return static::where('is_active', true)->orderBy('sort_order')->limit($limit)->get();
    }
}
