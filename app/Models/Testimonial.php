<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Spatie\Translatable\HasTranslations;

class Testimonial extends Model
{
    use HasTranslations;

    public array $translatable = [
        'quote',
        'author_name',
        'author_role',
    ];

    protected $fillable = [
        'quote',
        'rating',
        'author_name',
        'author_role',
        'author_photo',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'rating' => 'integer',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    protected $appends = ['author_photo_url'];

    protected static function booted(): void
    {
        static::saved(fn () => Cache::forget('testimonials_homepage_5'));
        static::deleted(fn () => Cache::forget('testimonials_homepage_5'));
    }

    public function getAuthorPhotoUrlAttribute(): ?string
    {
        return $this->author_photo ? asset('storage/'.ltrim($this->author_photo, '/')) : null;
    }

    public static function forHomepage(int $limit = 5)
    {
        $itemsRaw = Cache::rememberForever('testimonials_homepage_' . $limit, function () use ($limit) {
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
