<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Str;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'role' => 'admin',
        	'first_name' => 'Admin',
            'last_name' => '',
        	'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);
        User::create([
            'role' => 'teacher',
        	'first_name' => 'Test',
            'last_name' => '',
        	'email' => 'teacher@shayona.com',
            'password' => bcrypt('teacher'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);
        User::create([
            'role' => 'student',
        	'first_name' => 'Test',
            'last_name' => '',
        	'email' => 'student@shayona.edu.com',
            'password' => bcrypt('nvpq123'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);
    }
}
