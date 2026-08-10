<?php

namespace Modules\Academic\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Modules\Academic\Models\AcademicSession;

class AcademicSessionController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/Academic/Sessions/Index', [
            'sessions' => AcademicSession::latest()->get(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Admin/Academic/Sessions/Form', [
            'session' => null,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'year' => 'required|string|max:255',
            'is_active' => 'boolean',
        ]);

        if ($request->boolean('is_active')) {
            AcademicSession::query()->update(['is_active' => false]);
        }

        AcademicSession::create($data);

        return redirect()->route('admin.academic.sessions.index')->with('success', 'Session created successfully.');
    }

    public function edit(AcademicSession $session): Response
    {
        return Inertia::render('Admin/Academic/Sessions/Form', [
            'session' => $session,
        ]);
    }

    public function update(Request $request, AcademicSession $session)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'year' => 'required|string|max:255',
            'is_active' => 'boolean',
        ]);

        if ($request->boolean('is_active')) {
            AcademicSession::query()->update(['is_active' => false]);
        }

        $session->update($data);

        return redirect()->route('admin.academic.sessions.index')->with('success', 'Session updated successfully.');
    }

    public function destroy(AcademicSession $session)
    {
        $session->delete();
        return back()->with('success', 'Session deleted successfully.');
    }
}
