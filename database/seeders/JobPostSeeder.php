<?php

namespace Database\Seeders;

use App\Models\JobPost;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employers = User::where('role', 'employer')->get();

        foreach ($employers as $employer) {
            JobPost::factory()->count(3)->create([
                'user_id' => $employer->id,
                'status' => 'approved'
            ]);
        }
    }
}
