<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreClassScheduleRequest;
use App\Http\Requests\Admin\UpdateClassSchedulePageSettingRequest;
use App\Http\Requests\Admin\UpdateClassScheduleRequest;
use App\Models\ClassSchedule;
use App\Models\ClassSchedulePageSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class ClassScheduleController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/Cms/ClassSchedule', [
            'schedules' => ClassSchedule::orderBy('sort_order')->get(),
            'pageSettings' => ClassSchedulePageSetting::current(),
        ]);
    }

    public function store(StoreClassScheduleRequest $request): RedirectResponse
    {
        ClassSchedule::create($request->validated());

        return back()->with('success', 'Class schedule item created successfully.');
    }

    public function update(UpdateClassScheduleRequest $request, ClassSchedule $classSchedule): RedirectResponse
    {
        $classSchedule->update($request->validated());

        return back()->with('success', 'Class schedule item updated successfully.');
    }

    public function destroy(ClassSchedule $classSchedule): RedirectResponse
    {
        $classSchedule->delete();

        return back()->with('success', 'Class schedule item deleted successfully.');
    }

    public function toggleActive(ClassSchedule $classSchedule): RedirectResponse
    {
        $classSchedule->update(['is_active' => ! $classSchedule->is_active]);

        return back()->with('success', 'Class schedule status updated.');
    }

    public function updatePageSettings(UpdateClassSchedulePageSettingRequest $request): RedirectResponse
    {
        $settings = ClassSchedulePageSetting::current();
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

        return back()->with('success', 'Class schedule page settings updated.');
    }
}
