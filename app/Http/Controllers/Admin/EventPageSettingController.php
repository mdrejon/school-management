<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateEventPageSettingRequest;
use App\Models\EventPageSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class EventPageSettingController extends Controller
{
    public function update(UpdateEventPageSettingRequest $request): RedirectResponse
    {
        $settings = EventPageSetting::current();
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

        return back()->with('success', 'Event page settings updated.');
    }
}
