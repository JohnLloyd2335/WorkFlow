<?php

namespace Database\Factories;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employer>
 */
class EmployerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::select('id')->whereHas('role', function ($query) {
            $query->where('role', 2);
        })->inRandomOrder()->first();

        return [
            'user_id' => $user->id,
            'company_name' => fake()->company(),
            'company_description' => fake()->paragraph(1),
            'services' => fake()->randomElement(['Web and Mobile', 'Consultancy', 'Repair', 'Penetration Testing', 'Hosting'])
        ];
    }
}
