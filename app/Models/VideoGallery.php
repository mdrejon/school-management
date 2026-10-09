<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Spatie\Translatable\HasTranslations;

class VideoGallery extends Model
{
    use HasTranslations;

    public array $translatable = [
        'caption',
    ];

    protected $fillable = [
        'video_url',
        'caption',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    protected static function booted(): void
    {
        static::saved(fn () => Cache::forget('video_galleries_homepage_6'));
        static::deleted(fn () => Cache::forget('video_galleries_homepage_6'));
    }

    public static function forHomepage(int $limit = 6)
    {
        $itemsRaw = Cache::rememberForever('video_galleries_homepage_' . $limit, function () use ($limit) {
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
