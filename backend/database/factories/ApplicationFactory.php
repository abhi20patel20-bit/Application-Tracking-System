<?php

namespace Database\Factories;

use App\Models\Application;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Application>
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
            'company_name' => fake()->company(),
            'job_title' => fake()->jobTitle(),
            'status' => fake()->randomElement([
                'applied',
                'interview',
                'offer',
                'rejected'
            ]),
            'applied_date' => fake()->date(),
            'notes' => fake()->sentence(),
            'job_link' => fake()->url(),
        ];
    }
}
