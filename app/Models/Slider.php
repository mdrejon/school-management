<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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

    public function getImageUrlAttribute(): ?string
    {
        // Root-relative on purpose, not Storage::url() — that bakes in
        // config('app.url') at config-load time, which breaks whenever the
        // app is actually served from a different host/port than APP_URL
        // (e.g. `php artisan serve` on a port that doesn't match .env).
        return $this->image ? '/storage/'.ltrim($this->image, '/') : null;
    }

    public static function forHomepage()
    {
        return static::where('is_active', true)->orderBy('sort_order')->get();
    }
}
