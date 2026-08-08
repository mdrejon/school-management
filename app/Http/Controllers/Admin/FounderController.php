<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreFounderRequest;
use App\Http\Requests\Admin\UpdateFounderRequest;
use App\Models\Donor;
use App\Models\Founder;
use App\Models\FounderDonorPageSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;

class FounderController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/Cms/FoundersDonors', [
            'founders' => Founder::orderBy('sort_order')->get(),
            'donors' => Donor::orderBy('sort_order')->get(),
            'pageSettings' => FounderDonorPageSetting::current(),
        ]);
    }

    public function store(StoreFounderRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['sort_order'] = (int) Founder::max('sort_order') + 1;
        $data['is_active'] = $request->boolean('is_active', true);

        Founder::create($data);

        return back()->with('success', 'Founder added.');
    }

    public function update(UpdateFounderRequest $request, Founder $founder): RedirectResponse
    {
        $data = $request->validated();
        $data['is_active'] = $request->boolean('is_active', $founder->is_active);

        $founder->update($data);

        return back()->with('success', 'Founder updated.');
    }

    public function toggleActive(Founder $founder): RedirectResponse
    {
        $founder->update(['is_active' => ! $founder->is_active]);

        return back()->with('success', $founder->is_active ? 'Founder activated.' : 'Founder deactivated.');
    }

    public function destroy(Founder $founder): RedirectResponse
    {
        $founder->delete();

        return back()->with('success', 'Founder removed.');
    }

    public function moveUp(Founder $founder): RedirectResponse
    {
        $this->swapWithNeighbor($founder, 'up');

        return back();
    }

    public function moveDown(Founder $founder): RedirectResponse
    {
        $this->swapWithNeighbor($founder, 'down');

        return back();
    }

    protected function swapWithNeighbor(Founder $founder, string $direction): void
    {
        $neighbor = $direction === 'up'
            ? Founder::where('sort_order', '<', $founder->sort_order)->orderByDesc('sort_order')->first()
            : Founder::where('sort_order', '>', $founder->sort_order)->orderBy('sort_order')->first();

        if (! $neighbor) {
            return;
        }

        DB::transaction(function () use ($founder, $neighbor) {
            [$a, $b] = [$founder->sort_order, $neighbor->sort_order];
            $founder->update(['sort_order' => $b]);
            $neighbor->update(['sort_order' => $a]);
        });
    }
}
