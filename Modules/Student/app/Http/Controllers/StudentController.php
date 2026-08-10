<?php

namespace Modules\Student\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Student\Models\Student;
use App\Models\User;
use Modules\Student\Http\Requests\StoreStudentRequest;
use Modules\Student\Http\Requests\UpdateStudentRequest;
use Inertia\Inertia;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::with('user')->latest()->paginate(10);
        return Inertia::render('Admin/Student/StudentList', [
            'students' => $students
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Student/StudentCreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request)
    {
        DB::transaction(function () use ($request) {
            $user = User::create([
                'name' => $request->first_name . ' ' . $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
            ]);
            
            // Assign student role if it exists (using spatie/laravel-permission)
            if (\Spatie\Permission\Models\Role::where('name', 'student')->exists()) {
                $user->assignRole('student');
            }

            $data = $request->except(['email', 'password', 'password_confirmation', 'phone', 'picture']);
            $data['user_id'] = $user->id;

            if ($request->hasFile('picture')) {
                $data['picture'] = $request->file('picture')->store('students', 'public');
            }

            Student::create($data);
        });

        return redirect()->route('admin.students.index')->with('success', 'Student created successfully.');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $student = Student::with('user')->findOrFail($id);
        return Inertia::render('Admin/Student/StudentShow', [
            'student' => $student
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $student = Student::with('user')->findOrFail($id);
        return Inertia::render('Admin/Student/StudentEdit', [
            'student' => $student
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, $id)
    {
        $student = Student::findOrFail($id);

        DB::transaction(function () use ($request, $student) {
            $user = $student->user;
            
            $userData = [
                'name' => $request->first_name . ' ' . $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
            ];
            
            if ($request->filled('password')) {
                $userData['password'] = Hash::make($request->password);
            }
            
            $user->update($userData);

            $data = $request->except(['email', 'password', 'password_confirmation', 'phone', 'picture']);

            if ($request->hasFile('picture')) {
                $data['picture'] = $request->file('picture')->store('students', 'public');
            }

            $student->update($data);
        });

        return redirect()->route('admin.students.index')->with('success', 'Student updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        
        // This will also delete the user because of cascadeOnDelete in migration
        $student->user()->delete(); 
        // Or if cascade doesn't work $student->delete() first depending on constraint direction
        // Let's just delete the user, it will cascade down to the student record
        
        return redirect()->route('admin.students.index')->with('success', 'Student deleted successfully.');
    }
}
