<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateDepartmentPageSettingRequest;
use App\Models\DepartmentPageSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class DepartmentPageSettingController extends Controller
{
    public function update(UpdateDepartmentPageSettingRequest $request): RedirectResponse
    {
        $settings = DepartmentPageSetting::current();
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

        return back()->with('success', 'Department page settings updated.');
    }
}
