<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/Settings/Users', [
            'users' => User::with('roles')->orderBy('name')->get()->map(fn (User $user) => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->roles->first()?->name,
                'is_system_admin' => $user->hasRole('system_admin'),
            ]),
            // system_admin is deliberately excluded — hidden, console-only role.
            'roles' => Role::where('name', '!=', 'system_admin')->orderBy('name')->pluck('name'),
        ]);
    }

    public function store(StoreUserRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $user->assignRole($data['role']);

        return back()->with('success', 'User created.');
    }

    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $data = $request->validated();

        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            ...(! empty($data['password']) ? ['password' => Hash::make($data['password'])] : []),
        ]);

        // A system_admin's role assignment is untouchable from this form —
        // the role select is hidden client-side for them and the dropdown
        // never offers system_admin as a choice, so syncing here would
        // otherwise silently strip their system_admin role.
        if (! $user->hasRole('system_admin') && ! empty($data['role'])) {
            $user->syncRoles([$data['role']]);
        }

        return back()->with('success', 'User updated.');
    }

    public function destroy(User $user): RedirectResponse
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', "You can't delete your own account.");
        }

        if ($user->hasRole('system_admin') && User::role('system_admin')->count() <= 1) {
            return back()->with('error', 'At least one system administrator account is required.');
        }

        $user->delete();

        return back()->with('success', 'User removed.');
    }
}
