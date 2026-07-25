<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ReorderMenuItemsRequest;
use App\Http\Requests\Admin\StoreMenuItemRequest;
use App\Http\Requests\Admin\UpdateMenuItemRequest;
use App\Models\Menu;
use App\Models\MenuItem;
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
     * Persists the whole drag-and-drop tree in one go — the client
     * flattens its current state (every item's id/parent_id/sort_order)
     * and sends it after the admin clicks "Save Menu Structure".
     */
    public function reorder(ReorderMenuItemsRequest $request): RedirectResponse
    {
        DB::transaction(function () use ($request) {
            foreach ($request->validated('items') as $item) {
                MenuItem::whereKey($item['id'])->update([
                    'parent_id' => $item['parent_id'],
                    'sort_order' => $item['sort_order'],
                ]);
            }
        });

        return back()->with('success', 'Menu order saved.');
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
