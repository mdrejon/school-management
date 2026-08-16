<?php

namespace Modules\Staff\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Staff\Models\Staff;
use App\Models\User;
use App\Models\Department; // Check if there is an HR department or use academic department
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StaffDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = Department::all();

        // Seed Staff
        for ($i = 1; $i <= 5; $i++) {
            $email = "staff{$i}@example.com";
            
            $user = User::firstOrCreate([
                'email' => $email,
            ], [
                'name' => "Staff Name {$i}",
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
            ]);

            // Assign role
            if (!$user->hasRole('staff')) {
                $role = \Spatie\Permission\Models\Role::where('name', 'staff')->first();
                if ($role) {
                    $user->assignRole($role);
                }
            }

            Staff::firstOrCreate([
                'user_id' => $user->id,
            ], [
                'department_id' => $departments->count() ? $departments->random()->id : null,
                'name' => "Staff Name {$i}",
                'designation' => "Administrative Assistant",
                'email' => $email,
                'phone' => "018000000" . sprintf('%02d', $i),
                'gender' => 'Male',
                'religion' => 'Islam',
                'blood_group' => 'O+',
                'serial_no' => $i,
                'joining_date' => now()->subYears(2),
                'address' => "Staff Address {$i}",
                'is_active' => true,
            ]);
        }
    }
}
