<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDepartmentRequest;
use App\Http\Requests\Admin\UpdateDepartmentRequest;
use App\Models\Department;
use App\Models\DepartmentPageSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class DepartmentController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/Cms/Departments', [
            'departments' => Department::orderBy('sort_order')->get(),
            'pageSettings' => DepartmentPageSetting::current(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Admin/Cms/DepartmentForm', [
            'department' => null,
        ]);
    }

    public function edit(Department $department): Response
    {
        return Inertia::render('Admin/Cms/DepartmentForm', [
            'department' => $department,
        ]);
    }

    public function store(StoreDepartmentRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if (blank($data['slug'] ?? null)) {
            unset($data['slug']);
        }

        $icon = $data['icon'];
        if ($icon['source'] === 'upload' && $icon['value'] instanceof UploadedFile) {
            $icon['value'] = $icon['value']->store('departments/icons', 'public');
        }
        $data['icon'] = $icon;

        foreach (['image', 'gallery_image_1', 'gallery_image_2'] as $field) {
            if ($request->hasFile($field)) {
                $data[$field] = $request->file($field)->store('departments', 'public');
            } else {
                unset($data[$field]);
            }
        }

        if (array_key_exists('downloads', $data)) {
            $data['downloads'] = $this->resolveDownloads($data['downloads'], []);
        }

        $data['sort_order'] = (int) Department::max('sort_order') + 1;
        $data['is_active'] = $request->boolean('is_active', true);

        Department::create($data);

        return redirect()->route('admin.cms.departments.index')->with('success', 'Department added.');
    }

    public function update(UpdateDepartmentRequest $request, Department $department): RedirectResponse
    {
        $data = $request->validated();

        if (blank($data['slug'] ?? null)) {
            unset($data['slug']);
        }

        $icon = $data['icon'];
        if ($icon['source'] === 'upload' && $icon['value'] instanceof UploadedFile) {
            $icon['value'] = $icon['value']->store('departments/icons', 'public');
        }
        $data['icon'] = $icon;

        foreach (['image', 'gallery_image_1', 'gallery_image_2'] as $field) {
            if ($request->hasFile($field)) {
                if ($department->{$field}) {
                    Storage::disk('public')->delete($department->{$field});
                }
                $data[$field] = $request->file($field)->store('departments', 'public');
            } else {
                unset($data[$field]);
            }
        }

        if (array_key_exists('downloads', $data)) {
            $data['downloads'] = $this->resolveDownloads($data['downloads'], $department->downloads ?? []);
        }

        $data['is_active'] = $request->boolean('is_active', $department->is_active);

        $department->update($data);

        return redirect()->route('admin.cms.departments.index')->with('success', 'Department updated.');
    }

    public function toggleActive(Department $department): RedirectResponse
    {
        $department->update(['is_active' => ! $department->is_active]);

        return back()->with('success', $department->is_active ? 'Department activated.' : 'Department deactivated.');
    }

    public function destroy(Department $department): RedirectResponse
    {
        foreach ([$department->image, $department->gallery_image_1, $department->gallery_image_2] as $path) {
            if ($path) {
                Storage::disk('public')->delete($path);
            }
        }

        foreach ($department->downloads ?? [] as $download) {
            if (! empty($download['file'])) {
                Storage::disk('public')->delete($download['file']);
            }
        }

        $department->delete();

        return back()->with('success', 'Department removed.');
    }

    public function moveUp(Department $department): RedirectResponse
    {
        $this->swapWithNeighbor($department, 'up');

        return back();
    }

    public function moveDown(Department $department): RedirectResponse
    {
        $this->swapWithNeighbor($department, 'down');

        return back();
    }

    protected function swapWithNeighbor(Department $department, string $direction): void
    {
        $neighbor = $direction === 'up'
            ? Department::where('sort_order', '<', $department->sort_order)->orderByDesc('sort_order')->first()
            : Department::where('sort_order', '>', $department->sort_order)->orderBy('sort_order')->first();

        if (! $neighbor) {
            return;
        }

        DB::transaction(function () use ($department, $neighbor) {
            [$a, $b] = [$department->sort_order, $neighbor->sort_order];
            $department->update(['sort_order' => $b]);
            $neighbor->update(['sort_order' => $a]);
        });
    }

    /**
     * Each row's `file` is either an UploadedFile (new upload) or a kept
     * storage path (string) from the previous save. Files no longer
     * referenced after this save are cleaned up — same orphan-cleanup
     * pattern as CourseController::resolveIconRepeater().
     *
     * @param  array<int, array{label: array, file: mixed}>  $submitted
     * @param  array<int, array{label: array, file: ?string}>  $previousItems
     */
    protected function resolveDownloads(array $submitted, array $previousItems): array
    {
        $resolved = collect($submitted)
            ->map(function (array $item) {
                if (($item['file'] ?? null) instanceof UploadedFile) {
                    $item['file'] = $item['file']->store('departments/downloads', 'public');
                } elseif (! is_string($item['file'] ?? null)) {
                    $item['file'] = null;
                }

                return $item;
            })
            ->filter(fn (array $item) => filled($item['file']))
            ->values()
            ->all();

        $paths = fn (array $items) => collect($items)->pluck('file')->filter()->all();

        foreach (array_diff($paths($previousItems), $paths($resolved)) as $orphaned) {
            Storage::disk('public')->delete($orphaned);
        }

        return $resolved;
    }
}
