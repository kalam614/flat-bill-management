<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Create Super Admin
        User::create([
            'name' => 'System Administrator',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        // Create House Owners
        User::create([
            'name' => 'Kalam Ahmed',
            'email' => 'owner1@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'house_owner',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Imran Ahmed',
            'email' => 'owner2@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'house_owner',
            'email_verified_at' => now(),
        ]);
    }
}
