<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreSliderRequest;
use App\Http\Requests\Admin\UpdateSliderRequest;
use App\Models\Slider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class SliderController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/Cms/Sliders', [
            'sliders' => Slider::orderBy('sort_order')->get(),
        ]);
    }

    public function store(StoreSliderRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['image'] = $request->file('image')->store('sliders', 'public');
        $data['sort_order'] = (int) Slider::max('sort_order') + 1;
        $data['is_active'] = $request->boolean('is_active', true);

        Slider::create($data);

        return back()->with('success', 'Slide added.');
    }

    public function update(UpdateSliderRequest $request, Slider $slider): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($slider->image);
            $data['image'] = $request->file('image')->store('sliders', 'public');
        } else {
            unset($data['image']);
        }

        $data['is_active'] = $request->boolean('is_active', $slider->is_active);

        $slider->update($data);

        return back()->with('success', 'Slide updated.');
    }

    public function toggleActive(Slider $slider): RedirectResponse
    {
        $slider->update(['is_active' => ! $slider->is_active]);

        return back()->with('success', $slider->is_active ? 'Slide activated.' : 'Slide deactivated.');
    }

    public function destroy(Slider $slider): RedirectResponse
    {
        Storage::disk('public')->delete($slider->image);
        $slider->delete();

        return back()->with('success', 'Slide removed.');
    }

    public function moveUp(Slider $slider): RedirectResponse
    {
        $this->swapWithNeighbor($slider, 'up');

        return back();
    }

    public function moveDown(Slider $slider): RedirectResponse
    {
        $this->swapWithNeighbor($slider, 'down');

        return back();
    }

    protected function swapWithNeighbor(Slider $slider, string $direction): void
    {
        $neighbor = $direction === 'up'
            ? Slider::where('sort_order', '<', $slider->sort_order)->orderByDesc('sort_order')->first()
            : Slider::where('sort_order', '>', $slider->sort_order)->orderBy('sort_order')->first();

        if (! $neighbor) {
            return;
        }

        DB::transaction(function () use ($slider, $neighbor) {
            [$a, $b] = [$slider->sort_order, $neighbor->sort_order];
            $slider->update(['sort_order' => $b]);
            $neighbor->update(['sort_order' => $a]);
        });
    }
}
