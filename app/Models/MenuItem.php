<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Spatie\Translatable\HasTranslations;

class MenuItem extends Model
{
    use HasTranslations;

    public array $translatable = ['label'];

    protected $fillable = [
        'menu_id',
        'parent_id',
        'type',
        'label',
        'url',
        'route_name',
        'linkable_type',
        'linkable_id',
        'target',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    protected static function booted(): void
    {
        static::saved(function (MenuItem $item) {
            Cache::forget("menu_{$item->menu_id}_items_active_1");
            Cache::forget("menu_{$item->menu_id}_items_active_0");
        });
        static::deleted(function (MenuItem $item) {
            Cache::forget("menu_{$item->menu_id}_items_active_1");
            Cache::forget("menu_{$item->menu_id}_items_active_0");
        });
    }

    public function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    /**
     * The short keys a 'model' type item's `linkable_type` can hold, each
     * mapped to the Eloquent class, the field its title is stored under,
     * and the public "show" route used to build the link.
     *
     * @return array<string, array{label: string, model: class-string, titleField: string, route: string}>
     */
    public static function linkableTypes(): array
    {
        return [
            'course' => ['label' => 'Course', 'model' => Course::class, 'titleField' => 'title', 'route' => 'courses.show'],
            'teacher' => ['label' => 'Teacher', 'model' => Teacher::class, 'titleField' => 'name', 'route' => 'teachers.show'],
            'event' => ['label' => 'Event', 'model' => Event::class, 'titleField' => 'title', 'route' => 'events.show'],
            'department' => ['label' => 'Department', 'model' => Department::class, 'titleField' => 'title', 'route' => 'departments.show'],
            'notice' => ['label' => 'Notice', 'model' => Notice::class, 'titleField' => 'title', 'route' => 'notices.show'],
            'page' => ['label' => 'CMS Page', 'model' => Page::class, 'titleField' => 'title', 'route' => 'pages.show'],
        ];
    }

    /**
     * Built-in listing/static pages pickable for a 'route' type item.
     *
     * @return array<string, string>
     */
    public static function builtInRoutes(): array
    {
        return [
            'home' => 'Home',
            'courses.index' => 'Courses (list)',
            'teachers.index' => 'Teachers (list)',
            'events.index' => 'Events (list)',
            'departments.index' => 'Departments (list)',
            'notices.index' => 'Notices (list)',
            'gallery.index' => 'Gallery',
            'search' => 'Search page',
        ];
    }

    /**
     * The href this item should render with on the public site — resolved
     * per type, `null` if the underlying route/record no longer exists
     * (deleted record, renamed route) so the caller can skip rendering it
     * rather than link to a broken URL.
     */
    public function resolvedUrl(): ?string
    {
        return match ($this->type) {
            'custom' => $this->url,
            'route' => Route::has($this->route_name) ? route($this->route_name) : null,
            'model' => $this->resolveModelUrl(),
            default => null,
        };
    }

    protected function resolveModelUrl(): ?string
    {
        $config = static::linkableTypes()[$this->linkable_type] ?? null;

        if (! $config || ! $this->linkable_id) {
            return null;
        }

        $record = $config['model']::find($this->linkable_id);

        return $record ? route($config['route'], $record) : null;
    }
}
