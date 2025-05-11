<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'id' => (string) Str::uuid(),
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'), // Always hash passwords
            'roles' => 'admin', // if you added a 'roles' column
        ]);
        User::create([
            'id' => (string) Str::uuid(),
            'name' => 'Technician User',
            'email' => 'tech@gmail.com',
            'password' => Hash::make('password'),
            'roles' => 'technician',
        ]);

        User::create([
            'id' => (string) Str::uuid(),
            'name' => 'Ian Belarmino',
            'email' => '0322-2070@lspu.edu.ph',
            'password' => Hash::make('password'),
            'roles' => 'student',
        ]);
        User::create([
            'id' => (string) Str::uuid(),
            'name' => 'Sir Gideon',
            'email' => 'faculty@gmail.com',
            'password' => Hash::make('password'),
            'roles' => 'faculty/staff',
        ]);
    }
}
