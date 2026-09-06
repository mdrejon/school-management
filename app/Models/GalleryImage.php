<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Spatie\Translatable\HasTranslations;

class GalleryImage extends Model
{
    use HasTranslations;

    public array $translatable = [
        'caption',
    ];

    protected $fillable = [
        'image',
        'caption',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    protected $appends = ['image_url'];

    protected static function booted(): void
    {
        static::saved(fn () => Cache::forget('gallery_images_homepage_6'));
        static::deleted(fn () => Cache::forget('gallery_images_homepage_6'));
    }

    public function getImageUrlAttribute(): ?string
    {
        return $this->image ? asset('storage/'.ltrim($this->image, '/')) : null;
    }

    public static function forHomepage(int $limit = 6)
    {
        $itemsRaw = Cache::rememberForever('gallery_images_homepage_' . $limit, function () use ($limit) {
            return static::where('is_active', true)
                ->orderBy('sort_order')
                ->limit($limit)
                ->get()
                ->map(fn ($item) => $item->getAttributes())
                ->all();
        });

        return static::hydrate($itemsRaw);
    }
}
