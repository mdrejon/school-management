<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Language extends Model
{
    protected $fillable = [
        'code',
        'name',
        'native_name',
        'direction',
        'is_default',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_default' => 'boolean',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    protected static function booted(): void
    {
        static::saved(fn () => Cache::forget('languages.active'));
        static::deleted(fn () => Cache::forget('languages.active'));
    }

    protected static $memoizedActive = null;

    /**
     * Active languages, ordered for display. Cached until the next
     * create/update/delete so this can be read on every request cheaply.
     *
     * Cached as a plain array, not the Eloquent Collection/models — the
     * database cache driver (default here, over SQLite) can corrupt
     * serialized model objects into __PHP_Incomplete_Class on unserialize.
     * Plain arrays serialize/unserialize safely on every cache driver.
     */
    public static function active()
    {
        if (static::$memoizedActive !== null) {
            return static::$memoizedActive;
        }

        $rows = Cache::rememberForever(
            'languages.active',
            fn () => static::where('is_active', true)->orderBy('sort_order')->get()->toArray()
        );

        static::$memoizedActive = static::hydrate($rows);
        return static::$memoizedActive;
    }

    public static function defaultLanguage(): ?self
    {
        return static::active()->firstWhere('is_default', true);
    }
}
