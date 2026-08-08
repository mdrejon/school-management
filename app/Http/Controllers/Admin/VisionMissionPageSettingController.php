<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateVisionMissionPageSettingRequest;
use App\Models\VisionMissionPageSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class VisionMissionPageSettingController extends Controller
{
    public function edit(): Response
    {
        return Inertia::render('Admin/Cms/VisionMissionSetting', [
            'pageSettings' => VisionMissionPageSetting::current(),
        ]);
    }

    public function update(UpdateVisionMissionPageSettingRequest $request): RedirectResponse
    {
        $settings = VisionMissionPageSetting::current();
        $data = $request->validated();

        $imageFields = [
            'image_1', 'image_2', 'image_3',
            'mission_image_1', 'mission_image_2', 'mission_image_3',
            'values_image_1', 'values_image_2', 'values_image_3',
            'breadcrumb_image',
        ];

        foreach ($imageFields as $field) {
            if ($request->hasFile($field)) {
                if ($settings->{$field}) {
                    Storage::disk('public')->delete($settings->{$field});
                }
                $data[$field] = $request->file($field)->store('site', 'public');
            } else {
                unset($data[$field]);
            }
        }

        $settings->update($data);

        return back()->with('success', 'Vision & Mission page settings updated.');
    }
}
