<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreVideoGalleryRequest;
use App\Http\Requests\Admin\UpdateVideoGalleryRequest;
use App\Models\VideoGallery;
use App\Models\VideoGalleryPageSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;

class VideoGalleryController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/Cms/VideoGallery', [
            'videos' => VideoGallery::orderBy('sort_order')->get(),
            'pageSettings' => VideoGalleryPageSetting::current(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Admin/Cms/VideoGalleryForm', [
            'videoGallery' => null,
        ]);
    }

    public function edit(VideoGallery $videoGallery): Response
    {
        return Inertia::render('Admin/Cms/VideoGalleryForm', [
            'videoGallery' => $videoGallery,
        ]);
    }

    public function store(StoreVideoGalleryRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['sort_order'] = (int) VideoGallery::max('sort_order') + 1;
        $data['is_active'] = $request->boolean('is_active', true);

        VideoGallery::create($data);

        return redirect()->route('admin.cms.video-gallery.index')->with('success', 'Video added.');
    }

    public function update(UpdateVideoGalleryRequest $request, VideoGallery $videoGallery): RedirectResponse
    {
        $data = $request->validated();
        $data['is_active'] = $request->boolean('is_active', $videoGallery->is_active);

        $videoGallery->update($data);

        return redirect()->route('admin.cms.video-gallery.index')->with('success', 'Video updated.');
    }

    public function toggleActive(VideoGallery $videoGallery): RedirectResponse
    {
        $videoGallery->update(['is_active' => ! $videoGallery->is_active]);

        return back()->with('success', $videoGallery->is_active ? 'Video activated.' : 'Video deactivated.');
    }

    public function destroy(VideoGallery $videoGallery): RedirectResponse
    {
        $videoGallery->delete();

        return back()->with('success', 'Video removed.');
    }

    public function moveUp(VideoGallery $videoGallery): RedirectResponse
    {
        $this->swapWithNeighbor($videoGallery, 'up');
        return back();
    }

    public function moveDown(VideoGallery $videoGallery): RedirectResponse
    {
        $this->swapWithNeighbor($videoGallery, 'down');
        return back();
    }

    protected function swapWithNeighbor(VideoGallery $videoGallery, string $direction): void
    {
        $neighbor = $direction === 'up'
            ? VideoGallery::where('sort_order', '<', $videoGallery->sort_order)->orderByDesc('sort_order')->first()
            : VideoGallery::where('sort_order', '>', $videoGallery->sort_order)->orderBy('sort_order')->first();

        if (! $neighbor) {
            return;
        }

        DB::transaction(function () use ($videoGallery, $neighbor) {
            [$a, $b] = [$videoGallery->sort_order, $neighbor->sort_order];
            $videoGallery->update(['sort_order' => $b]);
            $neighbor->update(['sort_order' => $a]);
        });
    }
}
