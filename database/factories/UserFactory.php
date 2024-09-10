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
            'password' => Hash::make('password'),
            // 'remember_token' => Str::random(10),

            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'image' => 'https://picsum.photos/800/600?random=12965',
            'remember_token' => Str::random(10),
            'role' => $this->faker->randomElement(['employer', 'candidate', 'admin']),
            'company_name' => $this->faker->company,
            'website' => $this->faker->url,
            'candidate_projects' => ["https:\/\/github.com\/ahmedadelattya\/Career_Bazaar", "https:\/\/github.com\/ahmedadelattya\/Career_Bazaar"],
            'candidate_skills' => json_encode(['PHP', 'Laravel']),
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
