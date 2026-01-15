<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create roles
        $adminRole = Role::firstOrCreate(
            ['role_name' => 'admin'],
            ['role_description' => 'Administrator']
        );

        $userRole = Role::firstOrCreate(
            ['role_name' => 'user'],
            ['role_description' => 'Regular User']
        );

        // Create default admin user
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'], // ensure uniqueness
            [
                'first_name' => 'Admin',
                'middle_name' => null,
                'last_name' => 'User',
                'username' => 'admin',
                'password' => Hash::make('password123'),
                'role_id' => $adminRole->id,
            ]
        );

        // Optional: create a regular user
        $user = User::firstOrCreate(
            ['email' => 'user@example.com'],
            [
                'first_name' => 'Regular',
                'middle_name' => null,
                'last_name' => 'User',
                'username' => 'user1',
                'password' => Hash::make('password123'),
                'role_id' => $userRole->id,
            ]
        );
    }
}
