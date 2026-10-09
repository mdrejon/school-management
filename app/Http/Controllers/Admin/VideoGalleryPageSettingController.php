<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateVideoGalleryPageSettingRequest;
use App\Models\VideoGalleryPageSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class VideoGalleryPageSettingController extends Controller
{
    public function edit(): Response
    {
        return Inertia::render('Admin/Cms/VideoGalleryPageSettings', [
            'settings' => VideoGalleryPageSetting::current(),
        ]);
    }

    public function update(UpdateVideoGalleryPageSettingRequest $request): RedirectResponse
    {
        $settings = VideoGalleryPageSetting::current();
        $data = $request->validated();

        if ($request->hasFile('breadcrumb_image')) {
            if ($settings->breadcrumb_image) {
                Storage::disk('public')->delete($settings->breadcrumb_image);
            }
            $data['breadcrumb_image'] = $request->file('breadcrumb_image')->store('page-settings', 'public');
        }

        $settings->update($data);

        return redirect()->route('admin.cms.video-gallery.index')->with('success', 'Page settings updated.');
    }
}
