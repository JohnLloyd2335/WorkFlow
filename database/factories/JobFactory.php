<?php

namespace Database\Factories;

use App\Models\Employer;
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
        $employer = Employer::inRandomOrder()->first();

        $work_type = fake()->randomElement(['Work from Home', 'Hybrid', 'Onsite']);

        $location = (in_array($work_type, ['Work from Home'])) ? 'Not Applicable' : fake()->address();

        return [
            'employer_id' => $employer->id,
            'title' => fake()->jobTitle(),
            'description' => fake()->paragraph(),
            'salary' => fake()->randomFloat(2, 15000, 100000),
            'work_type' => $work_type,
            'location' => $location
        ];
    }
}
