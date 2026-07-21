<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCourseRequest;
use App\Http\Requests\Admin\UpdateCourseRequest;
use App\Models\Course;
use App\Models\CoursePageSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class CourseController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/Cms/Courses', [
            'courses' => Course::orderBy('sort_order')->get(),
            'pageSettings' => CoursePageSetting::current(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Admin/Cms/CourseForm', [
            'course' => null,
        ]);
    }

    public function edit(Course $course): Response
    {
        return Inertia::render('Admin/Cms/CourseForm', [
            'course' => $course,
        ]);
    }

    public function store(StoreCourseRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if (blank($data['slug'] ?? null)) {
            unset($data['slug']);
        }

        $data['thumbnail'] = $request->file('thumbnail')->store('courses', 'public');

        foreach (['gallery_image_1', 'gallery_image_2', 'instructor_image'] as $field) {
            if ($request->hasFile($field)) {
                $data[$field] = $request->file($field)->store('courses', 'public');
            } else {
                unset($data[$field]);
            }
        }

        if (array_key_exists('features', $data)) {
            $data['features'] = $this->resolveIconRepeater($data['features'], []);
        }

        $data['sort_order'] = (int) Course::max('sort_order') + 1;
        $data['is_active'] = $request->boolean('is_active', true);

        Course::create($data);

        return redirect()->route('admin.cms.courses.index')->with('success', 'Course added.');
    }

    public function update(UpdateCourseRequest $request, Course $course): RedirectResponse
    {
        $data = $request->validated();

        if (blank($data['slug'] ?? null)) {
            unset($data['slug']);
        }

        if ($request->hasFile('thumbnail')) {
            if ($course->thumbnail) {
                Storage::disk('public')->delete($course->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('courses', 'public');
        } else {
            unset($data['thumbnail']);
        }

        foreach (['gallery_image_1', 'gallery_image_2', 'instructor_image'] as $field) {
            if ($request->hasFile($field)) {
                if ($course->{$field}) {
                    Storage::disk('public')->delete($course->{$field});
                }
                $data[$field] = $request->file($field)->store('courses', 'public');
            } else {
                unset($data[$field]);
            }
        }

        if (array_key_exists('features', $data)) {
            $data['features'] = $this->resolveIconRepeater($data['features'], $course->features ?? []);
        }

        $data['is_active'] = $request->boolean('is_active', $course->is_active);

        $course->update($data);

        return redirect()->route('admin.cms.courses.index')->with('success', 'Course updated.');
    }

    public function toggleActive(Course $course): RedirectResponse
    {
        $course->update(['is_active' => ! $course->is_active]);

        return back()->with('success', $course->is_active ? 'Course activated.' : 'Course deactivated.');
    }

    public function destroy(Course $course): RedirectResponse
    {
        foreach ([$course->thumbnail, $course->gallery_image_1, $course->gallery_image_2, $course->instructor_image] as $path) {
            if ($path) {
                Storage::disk('public')->delete($path);
            }
        }

        $course->delete();

        return back()->with('success', 'Course removed.');
    }

    public function moveUp(Course $course): RedirectResponse
    {
        $this->swapWithNeighbor($course, 'up');

        return back();
    }

    public function moveDown(Course $course): RedirectResponse
    {
        $this->swapWithNeighbor($course, 'down');

        return back();
    }

    protected function swapWithNeighbor(Course $course, string $direction): void
    {
        $neighbor = $direction === 'up'
            ? Course::where('sort_order', '<', $course->sort_order)->orderByDesc('sort_order')->first()
            : Course::where('sort_order', '>', $course->sort_order)->orderBy('sort_order')->first();

        if (! $neighbor) {
            return;
        }

        DB::transaction(function () use ($course, $neighbor) {
            [$a, $b] = [$course->sort_order, $neighbor->sort_order];
            $course->update(['sort_order' => $b]);
            $neighbor->update(['sort_order' => $a]);
        });
    }

    /**
     * Same pattern as SiteSettingController::resolveIconRepeater() — each
     * row's `icon` is either `{source: 'lucide', value: <name>}` or
     * `{source: 'upload', value: <UploadedFile|path>}`. Uploaded icon files
     * no longer referenced after this save are cleaned up.
     *
     * @param  array<int, array{icon: array{source: string, value: mixed}}>  $submitted
     * @param  array<int, array{icon: array{source: string, value: mixed}}>  $previousItems
     */
    protected function resolveIconRepeater(array $submitted, array $previousItems): array
    {
        $resolved = collect($submitted)
            ->map(function (array $item) {
                $icon = $item['icon'];

                if ($icon['source'] === 'upload' && $icon['value'] instanceof UploadedFile) {
                    $icon['value'] = $icon['value']->store('courses/icons', 'public');
                }

                $item['icon'] = $icon;

                return $item;
            })
            ->values()
            ->all();

        $uploadPaths = fn (array $items) => collect($items)
            ->filter(fn (array $item) => ($item['icon']['source'] ?? null) === 'upload')
            ->pluck('icon.value')
            ->all();

        foreach (array_diff($uploadPaths($previousItems), $uploadPaths($resolved)) as $orphaned) {
            Storage::disk('public')->delete($orphaned);
        }

        return $resolved;
    }
}
