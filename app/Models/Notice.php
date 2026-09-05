<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Translatable\HasTranslations;

class Notice extends Model
{
    use HasTranslations;

    public array $translatable = [
        'title',
        'description',
    ];

    protected $fillable = [
        'slug',
        'title',
        'description',
        'pdf',
        'published_at',
        'is_active',
    ];

    protected $casts = [
        'published_at' => 'date',
        'is_active' => 'boolean',
    ];

    protected $appends = ['pdf_url'];

    protected static function booted(): void
    {

        static::creating(function (Notice $notice) {
            if (blank($notice->slug)) {
                $default = Language::defaultLanguage()?->code ?? config('app.fallback_locale');
                $notice->slug = static::uniqueSlugFrom($notice->getTranslation('title', $default) ?: 'notice');
            }
        });
    }

    protected static function uniqueSlugFrom(string $source): string
    {
        $base = Str::slug($source) ?: 'notice';
        $slug = $base;
        $suffix = 2;

        while (static::where('slug', $slug)->exists()) {
            $slug = "{$base}-{$suffix}";
            $suffix++;
        }

        return $slug;
    }

    public function getPdfUrlAttribute(): ?string
    {
        return $this->pdf ? asset('storage/'.ltrim($this->pdf, '/')) : null;
    }

    public static function forList(int $perPage = 10, ?string $search = null)
    {
        return static::where('is_active', true)
            // MySQL's `json` type has no text collation, so a plain LIKE
            // against it compares case-sensitively — cast to CHAR first so
            // this matches regardless of case, in any translated locale.
            ->when($search, fn ($query) => $query->whereRaw('CAST(title AS CHAR) LIKE ?', ['%'.$search.'%']))
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->paginate($perPage)
            ->withQueryString();
    }

    /**
     * Latest active notices for the site-wide header marquee ticker.
     */
    public static function forMarquee(int $limit = 8)
    {
        return static::where('is_active', true)
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->limit($limit)
            ->get();
    }
}
