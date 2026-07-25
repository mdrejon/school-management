<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRoleRequest;
use App\Http\Requests\Admin\UpdateRoleRequest;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(): Response
    {
        // system_admin is deliberately excluded — hidden, console-only role,
        // never shown in any role list/dropdown (see CLAUDE.md).
        //
        // Not ->withCount(['permissions', 'users']): Spatie's Role::users()
        // relation is built from the model's own `guard_name` attribute
        // (via getModelForGuard()), but withCount() resolves relations
        // against a fresh, unhydrated model instance where that attribute
        // isn't set yet — it passes null as the related class and blows up
        // with "Class name must be a valid object or a string". Counting
        // per already-hydrated row instead sidesteps that entirely.
        $roles = Role::where('name', '!=', 'system_admin')
            ->orderBy('name')
            ->get()
            ->map(fn (Role $role) => [
                'id' => $role->id,
                'name' => $role->name,
                'permissions_count' => $role->permissions()->count(),
                'users_count' => $role->users()->count(),
            ]);

        return Inertia::render('Admin/Settings/Roles', [
            'roles' => $roles,
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Admin/Settings/RoleForm', [
            'role' => null,
            'catalog' => $this->catalogWithSelected(),
        ]);
    }

    public function edit(Role $role): Response
    {
        abort_if($role->name === 'system_admin', 404);

        return Inertia::render('Admin/Settings/RoleForm', [
            'role' => [
                'id' => $role->id,
                'name' => $role->name,
            ],
            'catalog' => $this->catalogWithSelected($role),
        ]);
    }

    public function store(StoreRoleRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $role = Role::create(['name' => $data['name'], 'guard_name' => 'web']);
        $role->syncPermissions($data['permissions'] ?? []);

        return redirect()->route('admin.settings.permissions.index')->with('success', 'Role created.');
    }

    public function update(UpdateRoleRequest $request, Role $role): RedirectResponse
    {
        abort_if($role->name === 'system_admin', 404);

        $data = $request->validated();

        $role->update(['name' => $data['name']]);
        $role->syncPermissions($data['permissions'] ?? []);

        return redirect()->route('admin.settings.permissions.index')->with('success', 'Role updated.');
    }

    public function destroy(Role $role): RedirectResponse
    {
        abort_if($role->name === 'system_admin', 404);

        if ($role->users()->count() > 0) {
            return back()->with('error', "Can't delete a role that's still assigned to a user. Reassign those users first.");
        }

        $role->delete();

        return back()->with('success', 'Role removed.');
    }

    /**
     * The full resource/action catalog from config/permissions.php, each
     * action flagged with whether the given role (or no role, for the
     * create form) currently has that permission — what RoleForm.vue's
     * matrix checkboxes bind to.
     */
    protected function catalogWithSelected(?Role $role = null): array
    {
        $granted = $role
            ? $role->permissions()->pluck('name')->all()
            : [];

        return collect(config('permissions'))
            ->map(function (array $resource, string $key) use ($granted) {
                return [
                    'key' => $key,
                    'label' => $resource['label'],
                    'actions' => collect($resource['actions'])->map(fn (string $action) => [
                        'action' => $action,
                        'permission' => "{$key}.{$action}",
                        'granted' => in_array("{$key}.{$action}", $granted, true),
                    ])->values(),
                ];
            })
            ->values()
            ->all();
    }
}
