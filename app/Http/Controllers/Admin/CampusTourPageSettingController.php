<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateCampusTourPageSettingRequest;
use App\Models\CampusTourPageSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class CampusTourPageSettingController extends Controller
{
    public function edit(): Response
    {
        return Inertia::render('Admin/Cms/CampusTourSetting', [
            'pageSettings' => CampusTourPageSetting::current(),
        ]);
    }

    public function update(UpdateCampusTourPageSettingRequest $request): RedirectResponse
    {
        $settings = CampusTourPageSetting::current();
        $data = $request->validated();

        if ($request->hasFile('breadcrumb_image')) {
            if ($settings->breadcrumb_image) {
                Storage::disk('public')->delete($settings->breadcrumb_image);
            }
            $data['breadcrumb_image'] = $request->file('breadcrumb_image')->store('site', 'public');
        } else {
            unset($data['breadcrumb_image']);
        }

        $settings->update($data);

        return back()->with('success', 'Campus Tour page settings updated.');
    }
}
