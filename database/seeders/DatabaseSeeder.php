<?php

namespace Database\Seeders;

use App\Models\Division;
use App\Models\Game;
use App\Models\GameEvent;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(DivisionSeeder::class);
        $this->call(TeamSeeder::class);
        $this->call(AdminSeeder::class);

        $divisions = Division::with('teams')->take(5)->get();

        foreach ($divisions as $division) {
            $teams = $division->teams;

            if ($teams->count() !== 16) {
                continue;
            }

            $teams = $teams->values();
            $teamCount = $teams->count();
            $rounds = $teamCount - 1;

            $startDate = Carbon::now()->subDays(90);
            $matchDays = [];

            for ($round = 0; $round < $rounds; $round++) {
                $pairings = [];
                for ($i = 0; $i < $teamCount / 2; $i++) {
                    $home = $teams[$i];
                    $away = $teams[$teamCount - 1 - $i];
                    $pairings[] = [$home, $away];
                }
                $matchDays[] = $pairings;

                $fixed = $teams->shift();
                $last = $teams->pop();
                $teams->prepend($fixed);
                $teams->splice(1, 0, [$last]);
            }

            $returnMatchDays = array_map(function ($matches) {
                return array_map(function ($pair) {
                    return [$pair[1], $pair[0]];
                }, $matches);
            }, $matchDays);

            $fullSchedule = array_merge($matchDays, $returnMatchDays);

            $totalMatchDays = 30;
            $matchesPerDay = 8;
            $pastMatchDays = 25;
            $futureMatchDays = 5;

            foreach ($fullSchedule as $dayIndex => $matches) {
                if ($dayIndex < $pastMatchDays) {
                    $matchDate = $startDate->copy()->subDays(($pastMatchDays - $dayIndex - 1) * 3);
                } else {
                    $futureOffset = ($dayIndex - $pastMatchDays) * 3;
                    $matchDate = Carbon::now()->addDays($futureOffset + 1);
                }

                foreach ($matches as [$homeTeam, $awayTeam]) {
                    $homeScore = $dayIndex < $pastMatchDays ? rand(0, 5) : null;
                    $awayScore = $dayIndex < $pastMatchDays ? rand(0, 5) : null;

                    $game = Game::create([
                        'home_team_id' => $homeTeam->id,
                        'away_team_id' => $awayTeam->id,
                        'home_score' => $homeScore,
                        'away_score' => $awayScore,
                        'match_date' => $matchDate,
                        'location' => $homeTeam->address ?? 'Unknown',
                        'division_id' => $division->id,
                    ]);

                    GameEvent::create([
                        'game_id' => $game->id,
                        'team_id' => $homeTeam->id,
                        'event_type' => 'Half-Time',
                        'minute' => 45,
                    ]);

                    if ($dayIndex < $pastMatchDays) {
                        // Goals
                        $homePlayers = range(1, 11);
                        $awayPlayers = range(1, 11);
                        $minutes = range(1, 90);
                        shuffle($homePlayers);
                        shuffle($awayPlayers);
                        shuffle($minutes);

                        for ($i = 0; $i < $homeScore; $i++) {
                            GameEvent::create([
                                'game_id' => $game->id,
                                'team_id' => $homeTeam->id,
                                'event_type' => 'goal',
                                'minute' => $minutes[$i % count($minutes)],
                                'player_name' => 'Speler ' . $homePlayers[$i % count($homePlayers)],
                            ]);
                        }

                        for ($i = 0; $i < $awayScore; $i++) {
                            GameEvent::create([
                                'game_id' => $game->id,
                                'team_id' => $awayTeam->id,
                                'event_type' => 'goal',
                                'minute' => $minutes[($i + $homeScore) % count($minutes)],
                                'player_name' => 'Speler ' . $awayPlayers[$i % count($awayPlayers)],
                            ]);
                        }
                        // Yellow cards
                        foreach (range(1, rand(0, 3)) as $i) {
                            GameEvent::create([
                                'game_id' => $game->id,
                                'team_id' => [$homeTeam->id, $awayTeam->id][rand(0, 1)],
                                'event_type' => 'yellow_card',
                                'minute' => rand(1, 90),
                                'player_name' => 'Speler ' . rand(1, 11),
                            ]);
                        }

                        // Red card (optional)
                        if (rand(0, 10) > 8) {
                            GameEvent::create([
                                'game_id' => $game->id,
                                'team_id' => [$homeTeam->id, $awayTeam->id][rand(0, 1)],
                                'event_type' => 'red_card',
                                'minute' => rand(1, 90),
                                'player_name' => 'Speler ' . rand(1, 11),
                            ]);
                        }

                        // Substitutions
                        foreach (range(1, rand(1, 3)) as $i) {
                            GameEvent::create([
                                'game_id' => $game->id,
                                'team_id' => [$homeTeam->id, $awayTeam->id][rand(0, 1)],
                                'event_type' => 'sub',
                                'minute' => rand(1, 90),
                                'player_in_name' => 'Speler ' . rand(12, 18),
                                'player_out_name' => 'Speler ' . rand(1, 11),
                            ]);
                        }
                    }
                }

                if ($dayIndex >= $totalMatchDays - 1) {
                    break;
                }
            }
        }
    }
}
