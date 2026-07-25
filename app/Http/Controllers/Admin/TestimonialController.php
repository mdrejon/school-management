<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTestimonialRequest;
use App\Http\Requests\Admin\UpdateTestimonialRequest;
use App\Models\Testimonial;
use App\Models\TestimonialPageSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class TestimonialController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/Cms/Testimonials', [
            'testimonials' => Testimonial::orderBy('sort_order')->get(),
            'pageSettings' => TestimonialPageSetting::current(),
        ]);
    }

    public function store(StoreTestimonialRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('author_photo')) {
            $data['author_photo'] = $request->file('author_photo')->store('testimonials', 'public');
        } else {
            unset($data['author_photo']);
        }

        $data['sort_order'] = (int) Testimonial::max('sort_order') + 1;
        $data['is_active'] = $request->boolean('is_active', true);

        Testimonial::create($data);

        return back()->with('success', 'Testimonial added.');
    }

    public function update(UpdateTestimonialRequest $request, Testimonial $testimonial): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('author_photo')) {
            if ($testimonial->author_photo) {
                Storage::disk('public')->delete($testimonial->author_photo);
            }
            $data['author_photo'] = $request->file('author_photo')->store('testimonials', 'public');
        } else {
            unset($data['author_photo']);
        }

        $data['is_active'] = $request->boolean('is_active', $testimonial->is_active);

        $testimonial->update($data);

        return back()->with('success', 'Testimonial updated.');
    }

    public function toggleActive(Testimonial $testimonial): RedirectResponse
    {
        $testimonial->update(['is_active' => ! $testimonial->is_active]);

        return back()->with('success', $testimonial->is_active ? 'Testimonial activated.' : 'Testimonial deactivated.');
    }

    public function destroy(Testimonial $testimonial): RedirectResponse
    {
        if ($testimonial->author_photo) {
            Storage::disk('public')->delete($testimonial->author_photo);
        }

        $testimonial->delete();

        return back()->with('success', 'Testimonial removed.');
    }

    public function moveUp(Testimonial $testimonial): RedirectResponse
    {
        $this->swapWithNeighbor($testimonial, 'up');

        return back();
    }

    public function moveDown(Testimonial $testimonial): RedirectResponse
    {
        $this->swapWithNeighbor($testimonial, 'down');

        return back();
    }

    protected function swapWithNeighbor(Testimonial $testimonial, string $direction): void
    {
        $neighbor = $direction === 'up'
            ? Testimonial::where('sort_order', '<', $testimonial->sort_order)->orderByDesc('sort_order')->first()
            : Testimonial::where('sort_order', '>', $testimonial->sort_order)->orderBy('sort_order')->first();

        if (! $neighbor) {
            return;
        }

        DB::transaction(function () use ($testimonial, $neighbor) {
            [$a, $b] = [$testimonial->sort_order, $neighbor->sort_order];
            $testimonial->update(['sort_order' => $b]);
            $neighbor->update(['sort_order' => $a]);
        });
    }
}
