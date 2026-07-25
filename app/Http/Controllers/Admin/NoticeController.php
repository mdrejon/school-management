<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreNoticeRequest;
use App\Http\Requests\Admin\UpdateNoticeRequest;
use App\Models\Notice;
use App\Models\NoticePageSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class NoticeController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/Cms/Notices', [
            'notices' => Notice::orderByDesc('published_at')->orderByDesc('id')->get(),
            'pageSettings' => NoticePageSetting::current(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Admin/Cms/NoticeForm', [
            'notice' => null,
        ]);
    }

    public function edit(Notice $notice): Response
    {
        return Inertia::render('Admin/Cms/NoticeForm', [
            'notice' => $notice,
        ]);
    }

    public function store(StoreNoticeRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if (blank($data['slug'] ?? null)) {
            unset($data['slug']);
        }

        if ($request->hasFile('pdf')) {
            $data['pdf'] = $request->file('pdf')->store('notices', 'public');
        } else {
            unset($data['pdf']);
        }

        $data['is_active'] = $request->boolean('is_active', true);

        Notice::create($data);

        return redirect()->route('admin.cms.notices.index')->with('success', 'Notice added.');
    }

    public function update(UpdateNoticeRequest $request, Notice $notice): RedirectResponse
    {
        $data = $request->validated();

        if (blank($data['slug'] ?? null)) {
            unset($data['slug']);
        }

        if ($request->hasFile('pdf')) {
            if ($notice->pdf) {
                Storage::disk('public')->delete($notice->pdf);
            }
            $data['pdf'] = $request->file('pdf')->store('notices', 'public');
        } else {
            unset($data['pdf']);
        }

        $data['is_active'] = $request->boolean('is_active', $notice->is_active);

        $notice->update($data);

        return redirect()->route('admin.cms.notices.index')->with('success', 'Notice updated.');
    }

    public function toggleActive(Notice $notice): RedirectResponse
    {
        $notice->update(['is_active' => ! $notice->is_active]);

        return back()->with('success', $notice->is_active ? 'Notice activated.' : 'Notice deactivated.');
    }

    public function destroy(Notice $notice): RedirectResponse
    {
        if ($notice->pdf) {
            Storage::disk('public')->delete($notice->pdf);
        }

        $notice->delete();

        return back()->with('success', 'Notice removed.');
    }
}
