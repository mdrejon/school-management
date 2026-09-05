<?php

namespace Modules\Staff\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Modules\Staff\Models\Staff;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use App\Models\Department;
use Spatie\Permission\Models\Role;

class StaffController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/Staff/Staffs/Index', [
            'staffs' => Staff::with('department')->latest()->get(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Admin/Staff/Staffs/Form', [
            'staff' => null,
            'departments' => Department::all()->map(fn($d) => ['id' => $d->id, 'title' => $d->title]),
            'roles' => Role::all(),
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
            'role' => 'required|string|exists:roles,name',
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
        ]);

        $user = User::create([
            'name' => $data['name'][$defaultLang],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $user->assignRole($data['role']);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('staffs', 'public');
        }

        $data['user_id'] = $user->id;
        $data['is_active'] = $request->boolean('is_active', true);

        Staff::create($data);

        return redirect()->route('admin.staff.staffs.index')->with('success', 'Staff added successfully.');
    }

    public function edit(Staff $staff): Response
    {
        $staff->load('user.roles');
        return Inertia::render('Admin/Staff/Staffs/Form', [
            'staff' => $staff,
            'departments' => Department::all()->map(fn($d) => ['id' => $d->id, 'title' => $d->title]),
            'roles' => Role::all(),
        ]);
    }

    public function update(Request $request, Staff $staff)
    {
        $defaultLang = \App\Models\Language::defaultLanguage()?->code ?? 'en';

        $data = $request->validate([
            "name.$defaultLang" => 'required|string|max:255',
            'name.*' => 'nullable|string|max:255',
            'designation.*' => 'nullable|string|max:255',
            'department_id' => 'required|exists:departments,id',
            'role' => 'required|string|exists:roles,name',
            'gender' => 'nullable|string',
            'religion' => 'nullable|string',
            'blood_group' => 'nullable|string',
            'serial_no' => 'nullable|string',
            'joining_date' => 'nullable|date',
            'address.*' => 'nullable|string',
            'email' => ['required', 'email', Rule::unique('users')->ignore($staff->user_id)],
            'phone' => 'nullable|string',
            'password' => 'nullable|string|min:8|confirmed',
            'photo' => 'nullable|image|max:2048',
        ]);

        if ($staff->user_id) {
            $user = User::find($staff->user_id);
            $user->name = $data['name'][$defaultLang];
            $user->email = $data['email'];
            if (!empty($data['password'])) {
                $user->password = Hash::make($data['password']);
            }
            $user->save();
            $user->syncRoles([$data['role']]);
        } else {
            $user = User::create([
                'name' => $data['name'][$defaultLang],
                'email' => $data['email'],
                'password' => Hash::make($data['password'] ?? '12345678'),
            ]);
            $user->assignRole($data['role']);
            $data['user_id'] = $user->id;
        }

        if ($request->hasFile('photo')) {
            if ($staff->photo) {
                Storage::disk('public')->delete($staff->photo);
            }
            $data['photo'] = $request->file('photo')->store('staffs', 'public');
        } else {
            unset($data['photo']);
        }

        $data['is_active'] = $request->boolean('is_active', $staff->is_active);

        $staff->update($data);

        return redirect()->route('admin.staff.staffs.index')->with('success', 'Staff updated successfully.');
    }

    public function destroy(Staff $staff)
    {
        if ($staff->photo) {
            Storage::disk('public')->delete($staff->photo);
        }
        
        if ($staff->user_id) {
            User::where('id', $staff->user_id)->delete();
        }

        $staff->delete();
        return back()->with('success', 'Staff removed.');
    }
}
