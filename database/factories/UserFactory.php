<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'name' => fake()->name(),
            // 'email' => fake()->unique()->safeEmail(),
            // 'email_verified_at' => now(),
            // 'password' => static::$password ??= Hash::make('password'),
            // 'remember_token' => Str::random(10),

            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'role' => $this->faker->randomElement(['employer', 'candidate', 'admin']),
            'company_name' => $this->faker->company,
            'website' => $this->faker->url,
            'candidate_projects' => json_encode([
                'project1' => [
                    'title' => $this->faker->sentence,
                    'description' => $this->faker->paragraph,
                    'technologies' => $this->faker->randomElements(['PHP', 'Laravel', 'JavaScript', 'React', 'Vue.js'], 3),
                ],
                // Add more projects as needed
            ]),
            'candidate_skills' => json_encode([
                'skill1' => $this->faker->randomElement(['PHP', 'Laravel', 'JavaScript', 'React', 'Vue.js']),
                'skill2' => $this->faker->randomElement(['PHP', 'Laravel', 'JavaScript', 'React', 'Vue.js']),
                // Add more skills as needed
            ]),
            'candidate_job_title' => $this->faker->jobTitle,
            'candidate_job_description' => $this->faker->paragraph,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
