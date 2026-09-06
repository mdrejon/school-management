<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class Menu extends Model
{
    protected $fillable = [
        'name',
        'slug',
    ];

    protected static function booted(): void
    {
        static::saved(function (Menu $menu) {
            Cache::forget("menu_{$menu->id}_items_active_1");
            Cache::forget("menu_{$menu->id}_items_active_0");
        });
        static::deleted(function (Menu $menu) {
            Cache::forget("menu_{$menu->id}_items_active_1");
            Cache::forget("menu_{$menu->id}_items_active_0");
        });
    }

    public function items(): HasMany
    {
        return $this->hasMany(MenuItem::class);
    }

    /**
     * The full item tree for this menu, nested via each item's `children`
     * relation (set in-memory, not a real eager-loaded relation) so both
     * the admin builder (every item) and the public header (active only)
     * can walk it the same way. One flat query + in-memory grouping avoids
     * both an N+1 and needing a recursive-CTE package for arbitrary depth.
     */
    public function tree(bool $onlyActive = true): Collection
    {
        $itemsRaw = Cache::rememberForever("menu_{$this->id}_items_active_" . (int)$onlyActive, function () use ($onlyActive) {
            return $this->items()
                ->when($onlyActive, fn ($query) => $query->where('is_active', true))
                ->orderBy('sort_order')
                ->get()
                ->map(fn ($item) => $item->getAttributes())
                ->all();
        });

        $items = MenuItem::hydrate($itemsRaw);

        return static::nest($items, null);
    }



    protected static function nest(Collection $items, ?int $parentId): Collection
    {
        return $items->where('parent_id', $parentId)->values()->map(function (MenuItem $item) use ($items) {
            $item->setRelation('children', static::nest($items, $item->id));

            return $item;
        })->values();
    }

    public static function header(): ?self
    {
        return static::where('slug', 'header')->first();
    }
}
