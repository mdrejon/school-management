<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTeacherRequest;
use App\Http\Requests\Admin\UpdateTeacherRequest;
use App\Models\Teacher;
use App\Models\TeacherPageSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class TeacherController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/Cms/Teachers', [
            'teachers' => Teacher::orderBy('sort_order')->get(),
            'pageSettings' => TeacherPageSetting::current(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Admin/Cms/TeacherForm', [
            'teacher' => null,
        ]);
    }

    public function edit(Teacher $teacher): Response
    {
        return Inertia::render('Admin/Cms/TeacherForm', [
            'teacher' => $teacher,
        ]);
    }

    public function store(StoreTeacherRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if (blank($data['slug'] ?? null)) {
            unset($data['slug']);
        }

        $data['photo'] = $request->file('photo')->store('teachers', 'public');

        $data['sort_order'] = (int) Teacher::max('sort_order') + 1;
        $data['is_active'] = $request->boolean('is_active', true);

        Teacher::create($data);

        return redirect()->route('admin.cms.teachers.index')->with('success', 'Teacher added.');
    }

    public function update(UpdateTeacherRequest $request, Teacher $teacher): RedirectResponse
    {
        $data = $request->validated();

        if (blank($data['slug'] ?? null)) {
            unset($data['slug']);
        }

        if ($request->hasFile('photo')) {
            if ($teacher->photo) {
                Storage::disk('public')->delete($teacher->photo);
            }
            $data['photo'] = $request->file('photo')->store('teachers', 'public');
        } else {
            unset($data['photo']);
        }

        $data['is_active'] = $request->boolean('is_active', $teacher->is_active);

        $teacher->update($data);

        return redirect()->route('admin.cms.teachers.index')->with('success', 'Teacher updated.');
    }

    public function toggleActive(Teacher $teacher): RedirectResponse
    {
        $teacher->update(['is_active' => ! $teacher->is_active]);

        return back()->with('success', $teacher->is_active ? 'Teacher activated.' : 'Teacher deactivated.');
    }

    public function destroy(Teacher $teacher): RedirectResponse
    {
        if ($teacher->photo) {
            Storage::disk('public')->delete($teacher->photo);
        }

        $teacher->delete();

        return back()->with('success', 'Teacher removed.');
    }

    public function moveUp(Teacher $teacher): RedirectResponse
    {
        $this->swapWithNeighbor($teacher, 'up');

        return back();
    }

    public function moveDown(Teacher $teacher): RedirectResponse
    {
        $this->swapWithNeighbor($teacher, 'down');

        return back();
    }

    protected function swapWithNeighbor(Teacher $teacher, string $direction): void
    {
        $neighbor = $direction === 'up'
            ? Teacher::where('sort_order', '<', $teacher->sort_order)->orderByDesc('sort_order')->first()
            : Teacher::where('sort_order', '>', $teacher->sort_order)->orderBy('sort_order')->first();

        if (! $neighbor) {
            return;
        }

        DB::transaction(function () use ($teacher, $neighbor) {
            [$a, $b] = [$teacher->sort_order, $neighbor->sort_order];
            $teacher->update(['sort_order' => $b]);
            $neighbor->update(['sort_order' => $a]);
        });
    }
}
