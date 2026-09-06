<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Spatie\Translatable\HasTranslations;

class Slider extends Model
{
    use HasTranslations;

    public array $translatable = [
        'sub_title',
        'title',
        'highlight',
        'description',
        'button_text',
        'button2_text',
    ];

    protected $fillable = [
        'image',
        'sub_title',
        'title',
        'highlight',
        'description',
        'button_text',
        'button_url',
        'button2_text',
        'button2_url',
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
        static::saved(fn () => Cache::forget('sliders_homepage'));
        static::deleted(fn () => Cache::forget('sliders_homepage'));
    }

    public function getImageUrlAttribute(): ?string
    {
        // Root-relative on purpose, not Storage::url() — that bakes in
        // config('app.url') at config-load time, which breaks whenever the
        // app is actually served from a different host/port than APP_URL
        // (e.g. `php artisan serve` on a port that doesn't match .env).
        return $this->image ? asset('storage/'.ltrim($this->image, '/')) : null;
    }

    public static function forHomepage()
    {
        $itemsRaw = Cache::rememberForever('sliders_homepage', function () {
            return static::where('is_active', true)
                ->orderBy('sort_order')
                ->get()
                ->map(fn ($item) => $item->getAttributes())
                ->all();
        });

        return static::hydrate($itemsRaw);
    }
}
