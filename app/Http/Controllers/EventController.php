<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventPageSetting;
use Illuminate\View\View;

class EventController extends Controller
{
    public function index(): View
    {
        return view('frontend.events.index', [
            'events' => Event::where('is_active', true)->orderBy('sort_order')->paginate(9),
            'pageSettings' => EventPageSetting::current(),
        ]);
    }

    public function show(Event $event): View
    {
        abort_unless($event->is_active, 404);

        return view('frontend.events.show', [
            'event' => $event,
            'pageSettings' => EventPageSetting::current(),
        ]);
    }
}
