<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Team>
 */
class TeamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'division_id' => 1, // overschreven in seeder
            'name' => $this->faker->city . ' FC',
            'logo' => 'https://via.placeholder.com/100x100.png?text=Logo',
            'address' => $this->faker->address,
            'primary_color' => $this->faker->safeColorName(),
            'secondary_color' => $this->faker->safeColorName(),
            'matches_played' => $this->faker->numberBetween(20),
            'goals_for' => $this->faker->numberBetween(0, 60),
            'goals_against' => $this->faker->numberBetween(0, 60),
            'wins' => $this->faker->numberBetween(0, 20),
            'losses' => $this->faker->numberBetween(0, 20),
            'draws' => $this->faker->numberBetween(0, 10),
        ];
    }
}