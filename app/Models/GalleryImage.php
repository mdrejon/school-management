<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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

    public function getImageUrlAttribute(): ?string
    {
        return $this->image ? '/storage/'.ltrim($this->image, '/') : null;
    }

    public static function forHomepage(int $limit = 6)
    {
        return static::where('is_active', true)->orderBy('sort_order')->limit($limit)->get();
    }
}
