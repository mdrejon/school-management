<?php

namespace Modules\Academic\Http\Controllers\Admin;

use App\Models\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Modules\Academic\Models\Prayer;
use Illuminate\Support\Facades\Storage;

class PrayerController extends Controller
{
    public function index(Request $request)
    {
        $query = Prayer::with(['session', 'teacher'])->latest();
        
        if ($request->search) {
            $query->where('subject', 'like', '%' . $request->search . '%')
                  ->orWhere('note', 'like', '%' . $request->search . '%');
        }

        $perPage = $request->per_page ?: 10;
        $prayers = $query->paginate($perPage)->withQueryString();

        return Inertia::render('Admin/Academic/Prayer/Index', [
            'prayers' => $prayers,
            'filters' => $request->only('search', 'per_page'),

        ]);
    }

    public function create()
    {
        $teachers = User::role('staff')->get();
        return Inertia::render('Admin/Academic/Prayer/Create', [
            'teachers' => $teachers,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'subject' => 'required|string|max:255',
            'note' => 'nullable|string',
            'file' => 'nullable|file|max:20480', // 20MB max

        ]);

        $path = null;
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('prayers', 'public');
        }

        Prayer::create([
            'teacher_id' => $request->teacher_id ?? auth()->id(),
            'date' => $request->date,
            'subject' => $request->subject,
            'note' => $request->note,
            'file_path' => $path,

        ]);

        return redirect()->route('admin.academic.prayers.index')->with('success', 'Prayer created successfully.');
    }

    public function download(Prayer $prayer)
    {
        if ($prayer->file_path && Storage::disk('public')->exists($prayer->file_path)) {
            return Storage::disk('public')->download($prayer->file_path, basename($prayer->file_path));
        }

        return redirect()->back()->with('error', 'File not found.');
    }

    public function destroy(Prayer $prayer)
    {
        if ($prayer->file_path && Storage::disk('public')->exists($prayer->file_path)) {
            Storage::disk('public')->delete($prayer->file_path);
        }
        
        $prayer->delete();

        return redirect()->route('admin.academic.prayers.index')->with('success', 'Prayer deleted successfully.');
    }
}
