<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Ensure the admin role exists
        $adminRole = Role::firstOrCreate(['name' => 'admin']);

        // Check if the admin user already exists
        $admin = User::where('email', 'admin@gmail.com')->first();

        if (!$admin) {
            // Create the admin user
            $admin = User::create([
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password123'), // use a secure password
            ]);
        }

        // Assign the admin role to the user
        if (!$admin->hasRole('admin')) {
            $admin->assignRole($adminRole);
        }
    }
}
