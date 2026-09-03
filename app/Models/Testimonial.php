<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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

    public function getAuthorPhotoUrlAttribute(): ?string
    {
        return $this->author_photo ? asset('storage/'.ltrim($this->author_photo, '/')) : null;
    }

    public static function forHomepage(int $limit = 5)
    {
        return static::where('is_active', true)->orderBy('sort_order')->limit($limit)->get();
    }
}
