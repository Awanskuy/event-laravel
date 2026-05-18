<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Organizer
        User::create([
            'name' => 'Event Organizer',
            'email' => 'organizer@organizer.com',
            'password' => Hash::make('password'),
            'role' => 'organizer',
        ]);

        // Regular Users
        User::create([
            'name' => 'John Doe',
            'email' => 'user@user.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        User::create([
            'name' => 'Jane Smith',
            'email' => 'jane@user.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);
    }
}
