<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EducationLevelPageSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EducationLevelPageSettingController extends Controller
{
    public function update(Request $request)
    {
        $validated = $request->validate([
            'breadcrumb_title' => 'nullable|array',
            'breadcrumb_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'seo_title' => 'nullable|array',
            'seo_description' => 'nullable|array',
            'seo_keywords' => 'nullable|array',
        ]);

        $settings = EducationLevelPageSetting::current();

        if ($request->hasFile('breadcrumb_image')) {
            if ($settings->breadcrumb_image) {
                Storage::disk('public')->delete($settings->breadcrumb_image);
            }
            $validated['breadcrumb_image'] = $request->file('breadcrumb_image')->store('page-settings', 'public');
        } elseif ($request->boolean('remove_breadcrumb_image')) {
            if ($settings->breadcrumb_image) {
                Storage::disk('public')->delete($settings->breadcrumb_image);
            }
            $validated['breadcrumb_image'] = null;
        } else {
            unset($validated['breadcrumb_image']);
        }

        $settings->update($validated);

        return redirect()->back()->with('success', 'Page settings updated successfully.');
    }
}
