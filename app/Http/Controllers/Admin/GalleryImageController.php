<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreGalleryImageRequest;
use App\Http\Requests\Admin\UpdateGalleryImageRequest;
use App\Models\GalleryImage;
use App\Models\GalleryPageSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class GalleryImageController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/Cms/Gallery', [
            'images' => GalleryImage::orderBy('sort_order')->get(),
            'pageSettings' => GalleryPageSetting::current(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Admin/Cms/GalleryImageForm', [
            'galleryImage' => null,
        ]);
    }

    public function edit(GalleryImage $galleryImage): Response
    {
        return Inertia::render('Admin/Cms/GalleryImageForm', [
            'galleryImage' => $galleryImage,
        ]);
    }

    public function store(StoreGalleryImageRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $data['image'] = $request->file('image')->store('gallery', 'public');
        $data['sort_order'] = (int) GalleryImage::max('sort_order') + 1;
        $data['is_active'] = $request->boolean('is_active', true);

        GalleryImage::create($data);

        return redirect()->route('admin.cms.gallery.index')->with('success', 'Image added.');
    }

    public function update(UpdateGalleryImageRequest $request, GalleryImage $galleryImage): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($galleryImage->image) {
                Storage::disk('public')->delete($galleryImage->image);
            }
            $data['image'] = $request->file('image')->store('gallery', 'public');
        } else {
            unset($data['image']);
        }

        $data['is_active'] = $request->boolean('is_active', $galleryImage->is_active);

        $galleryImage->update($data);

        return redirect()->route('admin.cms.gallery.index')->with('success', 'Image updated.');
    }

    public function toggleActive(GalleryImage $galleryImage): RedirectResponse
    {
        $galleryImage->update(['is_active' => ! $galleryImage->is_active]);

        return back()->with('success', $galleryImage->is_active ? 'Image activated.' : 'Image deactivated.');
    }

    public function destroy(GalleryImage $galleryImage): RedirectResponse
    {
        if ($galleryImage->image) {
            Storage::disk('public')->delete($galleryImage->image);
        }

        $galleryImage->delete();

        return back()->with('success', 'Image removed.');
    }

    public function moveUp(GalleryImage $galleryImage): RedirectResponse
    {
        $this->swapWithNeighbor($galleryImage, 'up');

        return back();
    }

    public function moveDown(GalleryImage $galleryImage): RedirectResponse
    {
        $this->swapWithNeighbor($galleryImage, 'down');

        return back();
    }

    protected function swapWithNeighbor(GalleryImage $galleryImage, string $direction): void
    {
        $neighbor = $direction === 'up'
            ? GalleryImage::where('sort_order', '<', $galleryImage->sort_order)->orderByDesc('sort_order')->first()
            : GalleryImage::where('sort_order', '>', $galleryImage->sort_order)->orderBy('sort_order')->first();

        if (! $neighbor) {
            return;
        }

        DB::transaction(function () use ($galleryImage, $neighbor) {
            [$a, $b] = [$galleryImage->sort_order, $neighbor->sort_order];
            $galleryImage->update(['sort_order' => $b]);
            $neighbor->update(['sort_order' => $a]);
        });
    }
}
