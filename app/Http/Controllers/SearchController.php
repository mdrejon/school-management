<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Department;
use App\Models\Event;
use App\Models\Notice;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SearchController extends Controller
{
    /**
     * One combined results page across every searchable public content
     * type — grouped by type, title/name matched, active records only.
     */
    public function index(Request $request): View
    {
        $query = $request->string('q')->trim()->value();

        $results = [
            'notices' => collect(),
            'courses' => collect(),
            'teachers' => collect(),
            'events' => collect(),
            'departments' => collect(),
        ];

        if ($query !== '') {
            // MySQL's `json` type has no text collation, so a plain LIKE
            // against it compares case-sensitively — cast to CHAR first so
            // this matches regardless of case, in any translated locale.
            $like = fn (string $column) => "CAST({$column} AS CHAR) LIKE ?";
            $needle = ['%'.$query.'%'];

            $results['notices'] = Notice::where('is_active', true)->whereRaw($like('title'), $needle)->limit(10)->get();
            $results['courses'] = Course::where('is_active', true)->whereRaw($like('title'), $needle)->limit(10)->get();
            $results['teachers'] = Teacher::where('is_active', true)->whereRaw($like('name'), $needle)->limit(10)->get();
            $results['events'] = Event::where('is_active', true)->whereRaw($like('title'), $needle)->limit(10)->get();
            $results['departments'] = Department::where('is_active', true)->whereRaw($like('title'), $needle)->limit(10)->get();
        }

        return view('frontend.search', [
            'query' => $query,
            'results' => $results,
            'totalCount' => collect($results)->sum(fn ($group) => $group->count()),
        ]);
    }
}
