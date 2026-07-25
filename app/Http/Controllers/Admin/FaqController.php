<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreFaqRequest;
use App\Http\Requests\Admin\UpdateFaqRequest;
use App\Models\Faq;
use App\Models\FaqPageSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;

class FaqController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/Cms/Faqs', [
            'faqs' => Faq::orderBy('sort_order')->get(),
            'pageSettings' => FaqPageSetting::current(),
        ]);
    }

    public function store(StoreFaqRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['sort_order'] = (int) Faq::max('sort_order') + 1;
        $data['is_active'] = $request->boolean('is_active', true);

        Faq::create($data);

        return back()->with('success', 'FAQ added.');
    }

    public function update(UpdateFaqRequest $request, Faq $faq): RedirectResponse
    {
        $data = $request->validated();
        $data['is_active'] = $request->boolean('is_active', $faq->is_active);

        $faq->update($data);

        return back()->with('success', 'FAQ updated.');
    }

    public function toggleActive(Faq $faq): RedirectResponse
    {
        $faq->update(['is_active' => ! $faq->is_active]);

        return back()->with('success', $faq->is_active ? 'FAQ activated.' : 'FAQ deactivated.');
    }

    public function destroy(Faq $faq): RedirectResponse
    {
        $faq->delete();

        return back()->with('success', 'FAQ removed.');
    }

    public function moveUp(Faq $faq): RedirectResponse
    {
        $this->swapWithNeighbor($faq, 'up');

        return back();
    }

    public function moveDown(Faq $faq): RedirectResponse
    {
        $this->swapWithNeighbor($faq, 'down');

        return back();
    }

    protected function swapWithNeighbor(Faq $faq, string $direction): void
    {
        $neighbor = $direction === 'up'
            ? Faq::where('sort_order', '<', $faq->sort_order)->orderByDesc('sort_order')->first()
            : Faq::where('sort_order', '>', $faq->sort_order)->orderBy('sort_order')->first();

        if (! $neighbor) {
            return;
        }

        DB::transaction(function () use ($faq, $neighbor) {
            [$a, $b] = [$faq->sort_order, $neighbor->sort_order];
            $faq->update(['sort_order' => $b]);
            $neighbor->update(['sort_order' => $a]);
        });
    }
}
