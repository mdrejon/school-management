<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePageRequest;
use App\Http\Requests\Admin\UpdatePageRequest;
use App\Models\Page;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class PageController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/Cms/Pages', [
            'pages' => Page::orderByDesc('id')->get(['id', 'slug', 'title', 'is_active']),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Admin/Cms/PageForm', [
            'page' => null,
        ]);
    }

    public function edit(Page $page): Response
    {
        return Inertia::render('Admin/Cms/PageForm', [
            'page' => $page,
        ]);
    }

    public function store(StorePageRequest $request): SymfonyResponse
    {
        $data = $request->validated();

        if (blank($data['slug'] ?? null)) {
            unset($data['slug']);
        }

        if ($request->hasFile('breadcrumb_image')) {
            $data['breadcrumb_image'] = $request->file('breadcrumb_image')->store('pages', 'public');
        } else {
            unset($data['breadcrumb_image']);
        }

        $data['is_active'] = $request->boolean('is_active', true);

        $page = Page::create($data);

        // Inertia::location() (not a plain redirect()) — the visual builder
        // is a normal Blade view, not an Inertia page, so its response
        // never carries the X-Inertia header Inertia's client expects.
        // A plain redirect()->route() here would land there with a stale
        // X-Inertia request header still attached (redirects preserve
        // headers same-origin) and Inertia would treat the resulting 200
        // HTML as an "invalid response", showing its raw-HTML error modal
        // instead of actually navigating. Inertia::location() instead
        // returns a 409 + X-Inertia-Location, which Inertia's client
        // specifically detects and turns into a real window.location visit.
        return Inertia::location(route('admin.cms.pages.builder.edit', $page));
    }

    public function update(UpdatePageRequest $request, Page $page): RedirectResponse
    {
        $data = $request->validated();

        if (blank($data['slug'] ?? null)) {
            unset($data['slug']);
        }

        if ($request->hasFile('breadcrumb_image')) {
            if ($page->breadcrumb_image) {
                Storage::disk('public')->delete($page->breadcrumb_image);
            }
            $data['breadcrumb_image'] = $request->file('breadcrumb_image')->store('pages', 'public');
        } else {
            unset($data['breadcrumb_image']);
        }

        $data['is_active'] = $request->boolean('is_active', $page->is_active);

        $page->update($data);

        return redirect()->route('admin.cms.pages.index')->with('success', 'Page updated.');
    }

    public function toggleActive(Page $page): RedirectResponse
    {
        $page->update(['is_active' => ! $page->is_active]);

        return back()->with('success', $page->is_active ? 'Page activated.' : 'Page deactivated.');
    }

    public function destroy(Page $page): RedirectResponse
    {
        if ($page->breadcrumb_image) {
            Storage::disk('public')->delete($page->breadcrumb_image);
        }

        $page->delete();

        return back()->with('success', 'Page removed.');
    }
}
