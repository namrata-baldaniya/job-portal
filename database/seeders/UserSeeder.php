<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Employer User',
            'email' => 'employer@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'employer',
        ]);

        User::create([
            'name' => 'Job Seeker',
            'email' => 'jobseeker@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'jobseeker',
        ]);
    }
}
