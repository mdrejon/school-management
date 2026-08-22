<?php

namespace App\Http\Controllers\Admin\Cms;

use App\Http\Controllers\Controller;
use App\Models\AcademicCalendar;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Carbon;
use App\Models\Language;

class AcademicCalendarController extends Controller
{
    public function index(Request $request)
    {
        $year = $request->query('year', Carbon::now()->year);

        $events = AcademicCalendar::whereYear('date', $year)
            ->orderBy('date', 'asc')
            ->get();

        return Inertia::render('Admin/Cms/AcademicCalendar', [
            'events' => $events,
            'currentYear' => (int)$year,
        ]);
    }

    public function store(Request $request)
    {
        $default = Language::defaultLanguage()?->code ?? 'en';

        $request->validate([
            'date' => 'required|date',
            "title.$default" => 'required|string|max:255',
            'title.*' => 'nullable|string|max:255',
            'type' => 'required|string|max:50',
            'description.*' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        AcademicCalendar::create($request->all());

        return redirect()->back()->with('success', 'Event created successfully.');
    }

    public function update(Request $request, AcademicCalendar $academicCalendar)
    {
        $default = Language::defaultLanguage()?->code ?? 'en';

        $request->validate([
            'date' => 'required|date',
            "title.$default" => 'required|string|max:255',
            'title.*' => 'nullable|string|max:255',
            'type' => 'required|string|max:50',
            'description.*' => 'nullable|string',
        ]);

        $academicCalendar->update($request->all());

        return redirect()->back()->with('success', 'Event updated successfully.');
    }

    public function toggleActive(AcademicCalendar $academicCalendar)
    {
        $academicCalendar->update(['is_active' => !$academicCalendar->is_active]);

        return redirect()->back()->with('success', 'Event status updated.');
    }

    public function destroy(AcademicCalendar $academicCalendar)
    {
        $academicCalendar->delete();

        return redirect()->back()->with('success', 'Event deleted successfully.');
    }
}
