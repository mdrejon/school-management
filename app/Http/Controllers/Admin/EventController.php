<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreEventRequest;
use App\Http\Requests\Admin\UpdateEventRequest;
use App\Models\Event;
use App\Models\EventPageSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class EventController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/Cms/Events', [
            'events' => Event::orderBy('sort_order')->get(),
            'pageSettings' => EventPageSetting::current(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Admin/Cms/EventForm', [
            'event' => null,
        ]);
    }

    public function edit(Event $event): Response
    {
        return Inertia::render('Admin/Cms/EventForm', [
            'event' => $event,
        ]);
    }

    public function store(StoreEventRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if (blank($data['slug'] ?? null)) {
            unset($data['slug']);
        }

        $data['image'] = $request->file('image')->store('events', 'public');

        foreach (['gallery_image_1', 'gallery_image_2', 'organizer_photo'] as $field) {
            if ($request->hasFile($field)) {
                $data[$field] = $request->file($field)->store('events', 'public');
            } else {
                unset($data[$field]);
            }
        }

        $data['sort_order'] = (int) Event::max('sort_order') + 1;
        $data['is_active'] = $request->boolean('is_active', true);

        Event::create($data);

        return redirect()->route('admin.cms.events.index')->with('success', 'Event added.');
    }

    public function update(UpdateEventRequest $request, Event $event): RedirectResponse
    {
        $data = $request->validated();

        if (blank($data['slug'] ?? null)) {
            unset($data['slug']);
        }

        if ($request->hasFile('image')) {
            if ($event->image) {
                Storage::disk('public')->delete($event->image);
            }
            $data['image'] = $request->file('image')->store('events', 'public');
        } else {
            unset($data['image']);
        }

        foreach (['gallery_image_1', 'gallery_image_2', 'organizer_photo'] as $field) {
            if ($request->hasFile($field)) {
                if ($event->{$field}) {
                    Storage::disk('public')->delete($event->{$field});
                }
                $data[$field] = $request->file($field)->store('events', 'public');
            } else {
                unset($data[$field]);
            }
        }

        $data['is_active'] = $request->boolean('is_active', $event->is_active);

        $event->update($data);

        return redirect()->route('admin.cms.events.index')->with('success', 'Event updated.');
    }

    public function toggleActive(Event $event): RedirectResponse
    {
        $event->update(['is_active' => ! $event->is_active]);

        return back()->with('success', $event->is_active ? 'Event activated.' : 'Event deactivated.');
    }

    public function destroy(Event $event): RedirectResponse
    {
        foreach ([$event->image, $event->gallery_image_1, $event->gallery_image_2, $event->organizer_photo] as $path) {
            if ($path) {
                Storage::disk('public')->delete($path);
            }
        }

        $event->delete();

        return back()->with('success', 'Event removed.');
    }

    public function moveUp(Event $event): RedirectResponse
    {
        $this->swapWithNeighbor($event, 'up');

        return back();
    }

    public function moveDown(Event $event): RedirectResponse
    {
        $this->swapWithNeighbor($event, 'down');

        return back();
    }

    protected function swapWithNeighbor(Event $event, string $direction): void
    {
        $neighbor = $direction === 'up'
            ? Event::where('sort_order', '<', $event->sort_order)->orderByDesc('sort_order')->first()
            : Event::where('sort_order', '>', $event->sort_order)->orderBy('sort_order')->first();

        if (! $neighbor) {
            return;
        }

        DB::transaction(function () use ($event, $neighbor) {
            [$a, $b] = [$event->sort_order, $neighbor->sort_order];
            $event->update(['sort_order' => $b]);
            $neighbor->update(['sort_order' => $a]);
        });
    }
}
