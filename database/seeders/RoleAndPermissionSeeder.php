<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

/**
 * Creates the fixed permission catalog from config/permissions.php and the
 * five roles documented in CLAUDE.md's Roles & Permissions section
 * (system_admin/admin/operator/teacher/student). `admin` gets every
 * permission by default; `operator`/`teacher`/`student` start with none —
 * a developer assigns permissions to them via the Roles admin page.
 * `system_admin` is assigned to every user that already exists when this
 * runs, since it's otherwise never exposed in any admin dropdown ("seeded
 * via console only") and this seeder is what wires permission enforcement
 * onto every admin route for the first time — without this, whoever is
 * already using this install would be locked out immediately.
 */
class RoleAndPermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = collect(config('permissions'))
            ->flatMap(fn (array $resource, string $key) => collect($resource['actions'])
                ->map(fn (string $action) => "{$key}.{$action}"))
            ->values();

        $permissions->each(fn (string $name) => Permission::findOrCreate($name, 'web'));

        $systemAdmin = Role::findOrCreate('system_admin', 'web');
        $admin = Role::findOrCreate('admin', 'web');
        Role::findOrCreate('operator', 'web');
        Role::findOrCreate('teacher', 'web');
        Role::findOrCreate('student', 'web');

        $admin->syncPermissions($permissions);

        User::all()->each(fn (User $user) => $user->assignRole($systemAdmin));
    }
}
