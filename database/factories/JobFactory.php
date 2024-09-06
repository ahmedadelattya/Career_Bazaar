<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'employer_id' => User::inRandomOrder()->where("role", '=', 'employer')->value('id'),
            'title' => $this->faker->jobTitle,
            'description' => $this->faker->paragraph,
            'category' => $this->faker->randomElement(['IT', 'Marketing', 'Sales', 'Design', 'Finance']),
            'location' => $this->faker->city,
            'salary_type' => $this->faker->randomElement(['fixed', 'hourly']),
            'fixed_salary' => $this->faker->numberBetween(5000, 10000),
            'hourly_rate' => $this->faker->numberBetween(20, 50),
            'skills' => json_encode([
                'skill1' => $this->faker->randomElement(['PHP', 'Laravel', 'JavaScript', 'React', 'Vue.js']),
                'skill2' => $this->faker->randomElement(['PHP', 'Laravel', 'JavaScript', 'React', 'Vue.js']),
            ]),
            'status' => $this->faker->randomElement(['pending', 'approved', 'declined']),

        ];
    }
}
