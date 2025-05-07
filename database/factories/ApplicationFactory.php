<?php

namespace Database\Factories;

use App\Models\JobPost;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Application>
 */
class ApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'job_post_id' => JobPost::factory(),
            'user_id' => User::factory(),
            'cover_letter' => $this->faker->paragraphs(3, true),
            'status' => $this->faker->randomElement(['pending', 'accepted', 'rejected']),
            'feedback' => $this->faker->boolean(30) ? $this->faker->paragraph : null,
            'interview_date' => $this->faker->boolean(20) ? $this->faker->dateTimeBetween('+1 week', '+1 month') : null,
        ];
    }
}
