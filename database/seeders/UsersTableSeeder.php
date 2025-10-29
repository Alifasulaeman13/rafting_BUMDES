<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@rapting.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // Boatman
        User::create([
            'name' => 'Boatman 1',
            'email' => 'boatman1@rapting.com',
            'password' => Hash::make('boatman123'),
            'role' => 'boatman',
        ]);

        // Rescue
        User::create([
            'name' => 'Rescue 1',
            'email' => 'rescue1@rapting.com',
            'password' => Hash::make('rescue123'),
            'role' => 'rescue',
        ]);
    }
}