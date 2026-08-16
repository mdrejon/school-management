<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

/**
 * Developer-facing "Site Configuration" — a coarser, module-level on/off
 * switch than the (not yet implemented) admin/operator/teacher/student
 * roles & permissions system. This is meant for a developer deploying this
 * CMS for a specific client to fully strip out a module the client wasn't
 * given (e.g. Courses), not for day-to-day content permissions.
 *
 * The catalog of *which* modules exist (config/modules.php) is fixed and
 * code-defined — the DB table only stores the two mutable toggles per key,
 * lazily created with sane defaults the first time a key is touched, the
 * same spirit as SiteSetting::current() but for many rows instead of one.
 */
class ModuleSetting extends Model
{
    protected $fillable = [
        'key',
        'is_enabled',
        'show_on_homepage',
    ];

    protected $casts = [
        'is_enabled' => 'boolean',
        'show_on_homepage' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::saved(fn () => Cache::forget('module_settings.all'));
        static::deleted(fn () => Cache::forget('module_settings.all'));
    }

    /**
     * The fixed, code-defined list of every configurable module.
     *
     * @return array<string, array{label: string, section: bool, route: bool}>
     */
    public static function catalog(): array
    {
        return config('site_modules');
    }

    /**
     * Every module's current DB state, keyed by module key — creates a
     * default (`is_enabled: true, show_on_homepage: true`) row for any
     * catalog key that doesn't have one yet (e.g. right after adding a new
     * module to config/modules.php), so callers never have to null-check.
     *
     * Caches raw attribute arrays and re-hydrates rather than caching the
     * Eloquent Collection itself — same reason as SiteSetting::current():
     * the "database" cache driver serializes/unserializes across requests,
     * and a freshly-unserialized model can come back as an
     * __PHP_Incomplete_Class depending on autoload timing. Plain arrays
     * round-trip safely.
     *
     * @return Collection<string, self>
     */
    public static function allKeyed(): Collection
    {
        $rows = Cache::rememberForever('module_settings.all', function () {
            $existingKeys = static::query()->pluck('key')->all();
            $missingKeys = array_diff(array_keys(static::catalog()), $existingKeys);

            foreach ($missingKeys as $key) {
                static::create(['key' => $key]);
            }

            return static::query()->get()->map(fn (self $model) => $model->getAttributes())->all();
        });

        return collect($rows)
            ->map(fn (array $attributes) => (new static())->forceFill($attributes)->syncOriginal())
            ->keyBy('key');
    }

    public static function isEnabled(string $key): bool
    {
        return (bool) (static::allKeyed()->get($key)?->is_enabled ?? true);
    }

    /**
     * Whether a module's homepage teaser section should render — false if
     * the module is fully disabled (regardless of its own homepage flag)
     * or if the homepage flag itself is off.
     */
    public static function showOnHomepage(string $key): bool
    {
        $setting = static::allKeyed()->get($key);

        if (! $setting) {
            return true;
        }

        return $setting->is_enabled && $setting->show_on_homepage;
    }

    /**
     * Module keys whose admin sidebar entry / Website Options tab should be
     * visible — i.e. every enabled module (disabled ones are hidden from
     * the admin entirely, not just the public site, per the "developer
     * strips a feature for a client" use case this exists for).
     *
     * @return array<int, string>
     */
    public static function enabledKeys(): array
    {
        return static::allKeyed()->filter->is_enabled->keys()->all();
    }
}
