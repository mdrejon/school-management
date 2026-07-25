<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreFacilityRequest;
use App\Http\Requests\Admin\UpdateFacilityRequest;
use App\Models\Facility;
use App\Models\FacilityPageSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class FacilityController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/Cms/Facilities', [
            'facilities' => Facility::orderBy('sort_order')->get(),
            'pageSettings' => FacilityPageSetting::current(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Admin/Cms/FacilityForm', [
            'facility' => null,
        ]);
    }

    public function edit(Facility $facility): Response
    {
        return Inertia::render('Admin/Cms/FacilityForm', [
            'facility' => $facility,
        ]);
    }

    public function store(StoreFacilityRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if (blank($data['slug'] ?? null)) {
            unset($data['slug']);
        }

        $data['image'] = $request->file('image')->store('facilities', 'public');

        foreach (['gallery_image_1', 'gallery_image_2'] as $field) {
            if ($request->hasFile($field)) {
                $data[$field] = $request->file($field)->store('facilities', 'public');
            } else {
                unset($data[$field]);
            }
        }

        $data['sort_order'] = (int) Facility::max('sort_order') + 1;
        $data['is_active'] = $request->boolean('is_active', true);

        Facility::create($data);

        return redirect()->route('admin.cms.facilities.index')->with('success', 'Facility added.');
    }

    public function update(UpdateFacilityRequest $request, Facility $facility): RedirectResponse
    {
        $data = $request->validated();

        if (blank($data['slug'] ?? null)) {
            unset($data['slug']);
        }

        if ($request->hasFile('image')) {
            if ($facility->image) {
                Storage::disk('public')->delete($facility->image);
            }
            $data['image'] = $request->file('image')->store('facilities', 'public');
        } else {
            unset($data['image']);
        }

        foreach (['gallery_image_1', 'gallery_image_2'] as $field) {
            if ($request->hasFile($field)) {
                if ($facility->{$field}) {
                    Storage::disk('public')->delete($facility->{$field});
                }
                $data[$field] = $request->file($field)->store('facilities', 'public');
            } else {
                unset($data[$field]);
            }
        }

        $data['is_active'] = $request->boolean('is_active', $facility->is_active);

        $facility->update($data);

        return redirect()->route('admin.cms.facilities.index')->with('success', 'Facility updated.');
    }

    public function toggleActive(Facility $facility): RedirectResponse
    {
        $facility->update(['is_active' => ! $facility->is_active]);

        return back()->with('success', $facility->is_active ? 'Facility activated.' : 'Facility deactivated.');
    }

    public function destroy(Facility $facility): RedirectResponse
    {
        foreach ([$facility->image, $facility->gallery_image_1, $facility->gallery_image_2] as $path) {
            if ($path) {
                Storage::disk('public')->delete($path);
            }
        }

        $facility->delete();

        return back()->with('success', 'Facility removed.');
    }

    public function moveUp(Facility $facility): RedirectResponse
    {
        $this->swapWithNeighbor($facility, 'up');

        return back();
    }

    public function moveDown(Facility $facility): RedirectResponse
    {
        $this->swapWithNeighbor($facility, 'down');

        return back();
    }

    protected function swapWithNeighbor(Facility $facility, string $direction): void
    {
        $neighbor = $direction === 'up'
            ? Facility::where('sort_order', '<', $facility->sort_order)->orderByDesc('sort_order')->first()
            : Facility::where('sort_order', '>', $facility->sort_order)->orderBy('sort_order')->first();

        if (! $neighbor) {
            return;
        }

        DB::transaction(function () use ($facility, $neighbor) {
            [$a, $b] = [$facility->sort_order, $neighbor->sort_order];
            $facility->update(['sort_order' => $b]);
            $neighbor->update(['sort_order' => $a]);
        });
    }
}
