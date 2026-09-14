<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AcademicCalendar;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AcademicCalendarController extends Controller
{
    public function index(): View
    {
        $pageSettings = Page::where('slug', 'academic-calendar')->first();
        return view('frontend.academic-calendar', compact('pageSettings'));
    }

    public function events(Request $request)
    {
        $year = $request->query('year', date('Y'));
        $month = $request->query('month');

        $query = AcademicCalendar::where('is_active', true)
            ->whereYear('date', $year);

        if ($month) {
            $query->whereMonth('date', $month);
        }

        $events = $query->get()->map(function ($event) {
            // we will need the translated title and description
            return [
                'id' => $event->id,
                'date' => $event->date->format('Y-m-d'),
                'title' => $event->title,
                'type' => $event->type,
                'description' => $event->description,
            ];
        });

        return response()->json($events);
    }
}
