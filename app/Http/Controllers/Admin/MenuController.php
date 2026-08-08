<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ReorderMenuItemsRequest;
use App\Http\Requests\Admin\StoreMenuItemRequest;
use App\Http\Requests\Admin\UpdateMenuItemRequest;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\Page;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;

class MenuController extends Controller
{
    public function index(): Response
    {
        $menu = Menu::firstOrCreate(['slug' => 'header'], ['name' => 'Main Menu']);

        return Inertia::render('Admin/Cms/Menus', [
            'menu' => $menu,
            'items' => $menu->tree(onlyActive: false),
            'linkableTypes' => collect(MenuItem::linkableTypes())->map(fn ($config) => $config['label']),
            'builtInRoutes' => MenuItem::builtInRoutes(),
            'cmsPages' => Page::where('is_active', true)->get()->map(fn ($p) => [
                'id' => $p->id,
                'title' => $p->title,
                'slug' => $p->slug,
            ]),
        ]);
    }

    public function storeItem(StoreMenuItemRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $data['sort_order'] = (int) MenuItem::where('menu_id', $data['menu_id'])
            ->where('parent_id', $data['parent_id'] ?? null)
            ->max('sort_order') + 1;
        $data['is_active'] = $request->boolean('is_active', true);

        MenuItem::create($data);

        return back()->with('success', 'Menu item added.');
    }

    public function updateItem(UpdateMenuItemRequest $request, MenuItem $menuItem): RedirectResponse
    {
        $data = $request->validated();
        $data['is_active'] = $request->boolean('is_active', $menuItem->is_active);

        $menuItem->update($data);

        return back()->with('success', 'Menu item updated.');
    }

    public function destroyItem(MenuItem $menuItem): RedirectResponse
    {
        $menuItem->delete();

        return back()->with('success', 'Menu item removed.');
    }

    /**
     * Quick enable/disable straight from the tree row — a disabled item
     * (and its whole subtree, per Menu::nest()'s onlyActive filtering)
     * simply drops out of the public header, without needing to delete it
     * or open the full edit panel just to flip one field.
     */
    public function toggleItem(MenuItem $menuItem): RedirectResponse
    {
        $menuItem->update(['is_active' => ! $menuItem->is_active]);

        return back()->with('success', $menuItem->is_active ? 'Menu item enabled.' : 'Menu item disabled.');
    }

    /**
     * Persists the whole drag-and-drop tree in one go — the client
     * flattens its current state (every item's id/parent_id/sort_order)
     * and sends it after the admin clicks "Save Menu Structure".
     */
    public function reorder(ReorderMenuItemsRequest $request): RedirectResponse
    {
        DB::transaction(function () use ($request) {
            $createdIdsMap = [];

            foreach ($request->validated('items') as $item) {
                $parentId = $item['parent_id'] ?? null;
                if (is_string($parentId) && isset($createdIdsMap[$parentId])) {
                    $parentId = $createdIdsMap[$parentId];
                } elseif (is_string($parentId) && str_starts_with($parentId, 'new-')) {
                    $parentId = null;
                }

                if (! empty($item['is_new']) || (is_string($item['id']) && str_starts_with($item['id'], 'new-'))) {
                    $newItem = MenuItem::create([
                        'menu_id' => $item['menu_id'] ?? 1,
                        'parent_id' => $parentId,
                        'type' => $item['type'] ?? 'custom',
                        'label' => $item['label'] ?? ['en' => 'New Item'],
                        'url' => $item['url'] ?? null,
                        'route_name' => $item['route_name'] ?? null,
                        'linkable_type' => $item['linkable_type'] ?? null,
                        'linkable_id' => $item['linkable_id'] ?? null,
                        'target' => $item['target'] ?? '_self',
                        'sort_order' => (int) $item['sort_order'],
                        'is_active' => $item['is_active'] ?? true,
                    ]);
                    $createdIdsMap[$item['id']] = $newItem->id;
                } else {
                    MenuItem::whereKey($item['id'])->update([
                        'parent_id' => $parentId,
                        'sort_order' => (int) $item['sort_order'],
                    ]);
                }
            }
        });

        return back()->with('success', 'Menu structure saved.');
    }

    /**
     * Typeahead search backing the "add a module item" picker — plain JSON,
     * not an Inertia page visit, since it's called on every keystroke.
     */
    public function searchLinkables(Request $request): JsonResponse
    {
        $config = MenuItem::linkableTypes()[$request->string('type')->value()] ?? null;
        abort_if(! $config, 404);

        $query = $request->string('q')->trim()->value();
        $titleField = $config['titleField'];

        $records = $config['model']::query()
            ->where('is_active', true)
            // MySQL's `json` type has no text collation, so a plain LIKE
            // against it compares case-sensitively — cast to CHAR first.
            ->when($query !== '', fn ($q) => $q->whereRaw("CAST({$titleField} AS CHAR) LIKE ?", ['%'.$query.'%']))
            ->latest('id')
            ->limit(20)
            ->get();

        return response()->json($records->map(fn ($record) => [
            'id' => $record->id,
            'title' => $record->{$titleField},
        ])->values());
    }
}
