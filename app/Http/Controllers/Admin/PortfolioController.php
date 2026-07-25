<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePortfolioRequest;
use App\Http\Requests\Admin\UpdatePortfolioRequest;
use App\Models\Portfolio;
use App\Models\PortfolioPageSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class PortfolioController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/Cms/Portfolios', [
            'portfolios' => Portfolio::orderBy('sort_order')->get(),
            'pageSettings' => PortfolioPageSetting::current(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Admin/Cms/PortfolioForm', [
            'portfolio' => null,
        ]);
    }

    public function edit(Portfolio $portfolio): Response
    {
        return Inertia::render('Admin/Cms/PortfolioForm', [
            'portfolio' => $portfolio,
        ]);
    }

    public function store(StorePortfolioRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if (blank($data['slug'] ?? null)) {
            unset($data['slug']);
        }

        $data['image'] = $request->file('image')->store('portfolios', 'public');

        foreach (['gallery_image_1', 'gallery_image_2'] as $field) {
            if ($request->hasFile($field)) {
                $data[$field] = $request->file($field)->store('portfolios', 'public');
            } else {
                unset($data[$field]);
            }
        }

        $data['sort_order'] = (int) Portfolio::max('sort_order') + 1;
        $data['is_active'] = $request->boolean('is_active', true);

        Portfolio::create($data);

        return redirect()->route('admin.cms.portfolios.index')->with('success', 'Portfolio added.');
    }

    public function update(UpdatePortfolioRequest $request, Portfolio $portfolio): RedirectResponse
    {
        $data = $request->validated();

        if (blank($data['slug'] ?? null)) {
            unset($data['slug']);
        }

        if ($request->hasFile('image')) {
            if ($portfolio->image) {
                Storage::disk('public')->delete($portfolio->image);
            }
            $data['image'] = $request->file('image')->store('portfolios', 'public');
        } else {
            unset($data['image']);
        }

        foreach (['gallery_image_1', 'gallery_image_2'] as $field) {
            if ($request->hasFile($field)) {
                if ($portfolio->{$field}) {
                    Storage::disk('public')->delete($portfolio->{$field});
                }
                $data[$field] = $request->file($field)->store('portfolios', 'public');
            } else {
                unset($data[$field]);
            }
        }

        $data['is_active'] = $request->boolean('is_active', $portfolio->is_active);

        $portfolio->update($data);

        return redirect()->route('admin.cms.portfolios.index')->with('success', 'Portfolio updated.');
    }

    public function toggleActive(Portfolio $portfolio): RedirectResponse
    {
        $portfolio->update(['is_active' => ! $portfolio->is_active]);

        return back()->with('success', $portfolio->is_active ? 'Portfolio activated.' : 'Portfolio deactivated.');
    }

    public function destroy(Portfolio $portfolio): RedirectResponse
    {
        foreach ([$portfolio->image, $portfolio->gallery_image_1, $portfolio->gallery_image_2] as $path) {
            if ($path) {
                Storage::disk('public')->delete($path);
            }
        }

        $portfolio->delete();

        return back()->with('success', 'Portfolio removed.');
    }

    public function moveUp(Portfolio $portfolio): RedirectResponse
    {
        $this->swapWithNeighbor($portfolio, 'up');

        return back();
    }

    public function moveDown(Portfolio $portfolio): RedirectResponse
    {
        $this->swapWithNeighbor($portfolio, 'down');

        return back();
    }

    protected function swapWithNeighbor(Portfolio $portfolio, string $direction): void
    {
        $neighbor = $direction === 'up'
            ? Portfolio::where('sort_order', '<', $portfolio->sort_order)->orderByDesc('sort_order')->first()
            : Portfolio::where('sort_order', '>', $portfolio->sort_order)->orderBy('sort_order')->first();

        if (! $neighbor) {
            return;
        }

        DB::transaction(function () use ($portfolio, $neighbor) {
            [$a, $b] = [$portfolio->sort_order, $neighbor->sort_order];
            $portfolio->update(['sort_order' => $b]);
            $neighbor->update(['sort_order' => $a]);
        });
    }
}
