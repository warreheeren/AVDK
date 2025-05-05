<?php

namespace Database\Factories;

use App\Models\Game;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Game>
 */
class GameFactory extends Factory
{
    protected $model = Game::class;

    public function definition()
    {
        $home = Team::inRandomOrder()->first();
        $away = Team::where('id', '!=', $home->id)->inRandomOrder()->first();

        return [
            'home_team_id' => $home->id,
            'away_team_id' => $away->id,
            'home_score' => $this->faker->numberBetween(0, 6),
            'away_score' => $this->faker->numberBetween(0, 6),
            'match_date' => $this->faker->dateTimeBetween('-1 month', '+1 month'),
            'location' => $this->faker->city,
        ];
    }
}