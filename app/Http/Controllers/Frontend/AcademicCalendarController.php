<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AcademicCalendar;
use Illuminate\Http\Request;

class AcademicCalendarController extends Controller
{
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
