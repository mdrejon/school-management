<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateTeacherPageSettingRequest;
use App\Models\TeacherPageSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class TeacherPageSettingController extends Controller
{
    public function update(UpdateTeacherPageSettingRequest $request): RedirectResponse
    {
        $settings = TeacherPageSetting::current();
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

        return back()->with('success', 'Teacher page settings updated.');
    }
}
