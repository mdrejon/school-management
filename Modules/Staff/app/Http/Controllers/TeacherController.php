<?php

namespace Modules\Staff\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use App\Models\Department;

class TeacherController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/Staff/Teachers/Index', [
            'teachers' => Teacher::with('department')->orderBy('sort_order')->get(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Admin/Staff/Teachers/Form', [
            'teacher' => null,
            'departments' => Department::all()->map(fn($d) => ['id' => $d->id, 'title' => $d->title]),
        ]);
    }

    public function store(Request $request)
    {
        $defaultLang = \App\Models\Language::defaultLanguage()?->code ?? 'en';

        $data = $request->validate([
            "name.$defaultLang" => 'required|string|max:255',
            'name.*' => 'nullable|string|max:255',
            'designation.*' => 'nullable|string|max:255',
            'department_id' => 'required|exists:departments,id',
            'gender' => 'nullable|string',
            'religion' => 'nullable|string',
            'blood_group' => 'nullable|string',
            'serial_no' => 'nullable|string',
            'joining_date' => 'nullable|date',
            'address.*' => 'nullable|string',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string',
            'password' => 'required|string|min:8|confirmed',
            'photo' => 'nullable|image|max:2048',
            'short_intro.*' => 'nullable|string|max:500',
            'biography.*' => 'nullable|string',
            'facebook_url' => 'nullable|string',
            'whatsapp_url' => 'nullable|string',
            'behance_url' => 'nullable|string',
            'pinterest_url' => 'nullable|string',
            'linkedin_url' => 'nullable|string',
            'skills' => 'nullable|array',
            'slug' => 'nullable|string',
        ]);

        if (blank($data['slug'] ?? null)) {
            unset($data['slug']);
        }

        $user = User::create([
            'name' => $data['name'][$defaultLang],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $user->assignRole('teacher');

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('teachers', 'public');
        }

        $data['user_id'] = $user->id;
        $data['is_active'] = $request->boolean('is_active', true);
        $data['sort_order'] = (int) Teacher::max('sort_order') + 1;

        Teacher::create($data);

        return redirect()->route('admin.staff.teachers.index')->with('success', 'Teacher added successfully.');
    }

    public function edit(Teacher $teacher): Response
    {
        $teacher->load('user');
        return Inertia::render('Admin/Staff/Teachers/Form', [
            'teacher' => $teacher,
            'departments' => Department::all()->map(fn($d) => ['id' => $d->id, 'title' => $d->title]),
        ]);
    }

    public function update(Request $request, Teacher $teacher)
    {
        $defaultLang = \App\Models\Language::defaultLanguage()?->code ?? 'en';

        $data = $request->validate([
            "name.$defaultLang" => 'required|string|max:255',
            'name.*' => 'nullable|string|max:255',
            'designation.*' => 'nullable|string|max:255',
            'department_id' => 'required|exists:departments,id',
            'gender' => 'nullable|string',
            'religion' => 'nullable|string',
            'blood_group' => 'nullable|string',
            'serial_no' => 'nullable|string',
            'joining_date' => 'nullable|date',
            'address.*' => 'nullable|string',
            'email' => ['required', 'email', Rule::unique('users')->ignore($teacher->user_id)],
            'phone' => 'nullable|string',
            'password' => 'nullable|string|min:8|confirmed',
            'photo' => 'nullable|image|max:2048',
            'short_intro.*' => 'nullable|string|max:500',
            'biography.*' => 'nullable|string',
            'facebook_url' => 'nullable|string',
            'whatsapp_url' => 'nullable|string',
            'behance_url' => 'nullable|string',
            'pinterest_url' => 'nullable|string',
            'linkedin_url' => 'nullable|string',
            'skills' => 'nullable|array',
            'slug' => 'nullable|string',
        ]);

        if (blank($data['slug'] ?? null)) {
            unset($data['slug']);
        }

        if ($teacher->user_id) {
            $user = User::find($teacher->user_id);
            $user->name = $data['name'][$defaultLang];
            $user->email = $data['email'];
            if (!empty($data['password'])) {
                $user->password = Hash::make($data['password']);
            }
            $user->save();
        } else {
            $user = User::create([
                'name' => $data['name'][$defaultLang],
                'email' => $data['email'],
                'password' => Hash::make($data['password'] ?? '12345678'),
            ]);
            $user->assignRole('teacher');
            $data['user_id'] = $user->id;
        }

        if ($request->hasFile('photo')) {
            if ($teacher->photo) {
                Storage::disk('public')->delete($teacher->photo);
            }
            $data['photo'] = $request->file('photo')->store('teachers', 'public');
        } else {
            unset($data['photo']);
        }

        $data['is_active'] = $request->boolean('is_active', $teacher->is_active);

        $teacher->update($data);

        return redirect()->route('admin.staff.teachers.index')->with('success', 'Teacher updated successfully.');
    }

    public function toggleActive(Teacher $teacher)
    {
        $teacher->update(['is_active' => ! $teacher->is_active]);
        return back()->with('success', $teacher->is_active ? 'Teacher activated.' : 'Teacher deactivated.');
    }

    public function destroy(Teacher $teacher)
    {
        if ($teacher->photo) {
            Storage::disk('public')->delete($teacher->photo);
        }
        
        if ($teacher->user_id) {
            User::where('id', $teacher->user_id)->delete();
        }

        $teacher->delete();
        return back()->with('success', 'Teacher removed.');
    }
}
