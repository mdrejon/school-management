<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Translatable\HasTranslations;

class Teacher extends Model
{
    use HasTranslations;

    public array $translatable = [
        'name',
        'designation',
        'short_intro',
        'address',
        'biography',
    ];

    protected $fillable = [
        'slug',
        'name',
        'designation',
        'photo',
        'short_intro',
        'address',
        'email',
        'phone',
        'facebook_url',
        'whatsapp_url',
        'behance_url',
        'pinterest_url',
        'linkedin_url',
        'biography',
        'skills',
        'is_active',
        'sort_order',
        // HR fields
        'user_id',
        'department_id',
        'gender',
        'religion',
        'blood_group',
        'serial_no',
        'joining_date',
    ];

    protected $casts = [
        'skills' => 'array',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
        'joining_date' => 'date',
    ];

    protected $appends = ['photo_url'];

    protected static function booted(): void
    {
        static::creating(function (Teacher $teacher) {
            if (blank($teacher->slug)) {
                $default = Language::defaultLanguage()?->code ?? config('app.fallback_locale');
                $teacher->slug = static::uniqueSlugFrom($teacher->getTranslation('name', $default) ?: 'teacher');
            }
        });
    }

    protected static function uniqueSlugFrom(string $source): string
    {
        $base = Str::slug($source) ?: 'teacher';
        $slug = $base;
        $suffix = 2;

        while (static::where('slug', $slug)->exists()) {
            $slug = "{$base}-{$suffix}";
            $suffix++;
        }

        return $slug;
    }

    public function getPhotoUrlAttribute(): ?string
    {
        return $this->photo ? asset('storage/'.ltrim($this->photo, '/')) : null;
    }

    /**
     * "Professional Skills" progress bars resolved to plain strings for the
     * given locale — same shape/fallback as SiteSetting::skillItems().
     */
    public function skillItems(?string $locale = null): array
    {
        $locale ??= app()->getLocale();
        $default = Language::defaultLanguage()?->code ?? config('app.fallback_locale');

        return collect($this->skills ?? [])
            ->map(fn (array $item) => [
                'label' => $item['label'][$locale] ?? $item['label'][$default] ?? '',
                'percentage' => $item['percentage'] ?? '',
            ])
            ->filter(fn (array $item) => $item['label'] !== '')
            ->values()
            ->all();
    }

    public static function forHomepage(int $limit = 4)
    {
        return static::where('is_active', true)->orderBy('sort_order')->limit($limit)->get();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
