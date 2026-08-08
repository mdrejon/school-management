<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDonorRequest;
use App\Http\Requests\Admin\UpdateDonorRequest;
use App\Models\Donor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

/**
 * No index() here — Admin\FounderController::index() renders the combined
 * Inertia page (Admin/Cms/FoundersDonors.vue) with both founders and donors;
 * this controller only handles Donor's own CRUD actions.
 */
class DonorController extends Controller
{
    public function store(StoreDonorRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['sort_order'] = (int) Donor::max('sort_order') + 1;
        $data['is_active'] = $request->boolean('is_active', true);

        Donor::create($data);

        return back()->with('success', 'Donor added.');
    }

    public function update(UpdateDonorRequest $request, Donor $donor): RedirectResponse
    {
        $data = $request->validated();
        $data['is_active'] = $request->boolean('is_active', $donor->is_active);

        $donor->update($data);

        return back()->with('success', 'Donor updated.');
    }

    public function toggleActive(Donor $donor): RedirectResponse
    {
        $donor->update(['is_active' => ! $donor->is_active]);

        return back()->with('success', $donor->is_active ? 'Donor activated.' : 'Donor deactivated.');
    }

    public function destroy(Donor $donor): RedirectResponse
    {
        $donor->delete();

        return back()->with('success', 'Donor removed.');
    }

    public function moveUp(Donor $donor): RedirectResponse
    {
        $this->swapWithNeighbor($donor, 'up');

        return back();
    }

    public function moveDown(Donor $donor): RedirectResponse
    {
        $this->swapWithNeighbor($donor, 'down');

        return back();
    }

    protected function swapWithNeighbor(Donor $donor, string $direction): void
    {
        $neighbor = $direction === 'up'
            ? Donor::where('sort_order', '<', $donor->sort_order)->orderByDesc('sort_order')->first()
            : Donor::where('sort_order', '>', $donor->sort_order)->orderBy('sort_order')->first();

        if (! $neighbor) {
            return;
        }

        DB::transaction(function () use ($donor, $neighbor) {
            [$a, $b] = [$donor->sort_order, $neighbor->sort_order];
            $donor->update(['sort_order' => $b]);
            $neighbor->update(['sort_order' => $a]);
        });
    }
}
