<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreLanguageRequest;
use App\Http\Requests\Admin\UpdateLanguageRequest;
use App\Models\Language;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;

class LanguageController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/Settings/Languages', [
            'allLanguages' => Language::orderBy('sort_order')->get(),
        ]);
    }

    public function store(StoreLanguageRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['sort_order'] = (int) Language::max('sort_order') + 1;
        $data['is_active'] = $request->boolean('is_active', true);

        Language::create($data);

        return back()->with('success', 'Language added.');
    }

    public function update(UpdateLanguageRequest $request, Language $language): RedirectResponse
    {
        $language->update($request->validated());

        return back()->with('success', 'Language updated.');
    }

    public function toggleActive(Language $language): RedirectResponse
    {
        if ($language->is_default) {
            return back()->with('error', 'The default language cannot be deactivated. Set another language as default first.');
        }

        $language->update(['is_active' => ! $language->is_active]);

        return back()->with('success', $language->is_active ? 'Language activated.' : 'Language deactivated.');
    }

    public function makeDefault(Language $language): RedirectResponse
    {
        DB::transaction(function () use ($language) {
            Language::where('is_default', true)->update(['is_default' => false]);
            $language->update(['is_default' => true, 'is_active' => true]);
        });

        return back()->with('success', "{$language->name} is now the default language.");
    }

    public function destroy(Language $language): RedirectResponse
    {
        if ($language->is_default) {
            return back()->with('error', 'The default language can\'t be deleted. Set another language as default first.');
        }

        if ($language->is_active && Language::where('is_active', true)->count() <= 1) {
            return back()->with('error', 'At least one active language is required.');
        }

        $language->delete();

        return back()->with('success', 'Language removed.');
    }

    public function moveUp(Language $language): RedirectResponse
    {
        $this->swapWithNeighbor($language, 'up');

        return back();
    }

    public function moveDown(Language $language): RedirectResponse
    {
        $this->swapWithNeighbor($language, 'down');

        return back();
    }

    protected function swapWithNeighbor(Language $language, string $direction): void
    {
        $neighbor = $direction === 'up'
            ? Language::where('sort_order', '<', $language->sort_order)->orderByDesc('sort_order')->first()
            : Language::where('sort_order', '>', $language->sort_order)->orderBy('sort_order')->first();

        if (! $neighbor) {
            return;
        }

        DB::transaction(function () use ($language, $neighbor) {
            [$a, $b] = [$language->sort_order, $neighbor->sort_order];
            $language->update(['sort_order' => $b]);
            $neighbor->update(['sort_order' => $a]);
        });
    }
}
