<?php

namespace Database\Seeders;

use App\Models\Division;
use App\Models\Game;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Roep de seeders aan om divisies en teams te genereren
        $this->call(DivisionSeeder::class);
        $this->call(TeamSeeder::class);

        // Haal alle divisies op met bijbehorende teams (ervan uitgaande dat er 5 divisies zijn)
        $divisions = Division::with('teams')->take(5)->get();

        foreach ($divisions as $division) {
            $teams = $division->teams;

            // Controleer of het aantal teams gelijk is aan 16
            if ($teams->count() !== 16) {
                continue;
            }

            $teams = $teams->values(); // Reset de indexen
            $teamCount = $teams->count();
            $rounds = $teamCount - 1; // 15 speeldagen voor 16 teams

            // Startdatum voor de speeldagen (uniform voor alle divisies)
            $startDate = Carbon::now()->subDays(90);

            // Array voor de wedstrijden
            $matchDays = [];

            // Genereer de eerste round-robin (heenduel)
            for ($round = 0; $round < $rounds; $round++) {
                $pairings = [];
                for ($i = 0; $i < $teamCount / 2; $i++) {
                    $home = $teams[$i];
                    $away = $teams[$teamCount - 1 - $i];
                    $pairings[] = [$home, $away];
                }
                $matchDays[] = $pairings;

                // Wissel de teams voor de volgende ronde (roteren)
                $fixed = $teams->shift();
                $last = $teams->pop();
                $teams->prepend($fixed);
                $teams->splice(1, 0, [$last]);
            }

            // Tweede ronde (terugwedstrijden)
            $returnMatchDays = array_map(function ($matches) {
                return array_map(function ($pair) {
                    return [$pair[1], $pair[0]]; // Omdraaien voor de terugwedstrijd
                }, $matches);
            }, $matchDays);

            // Combineer heen- en terugwedstrijden
            $fullSchedule = array_merge($matchDays, $returnMatchDays);

            // Totaal 30 speeldagen (15 heen + 15 terug)
            $totalMatchDays = 30;
            $matchesPerDay = 8; // 8 wedstrijden per speeldag
            $pastMatchDays = 25; // 25 speeldagen in het verleden
            $futureMatchDays = 5; // 5 speeldagen in de toekomst

            // Voor elke speeldag, voeg de wedstrijden toe
            foreach ($fullSchedule as $dayIndex => $matches) {
                // Stel de matchdatum in
                if ($dayIndex < $pastMatchDays) {
                    // Verleden: spreid over 90 dagen in het verleden
                    $matchDate = $startDate->copy()->subDays(($pastMatchDays - $dayIndex - 1) * 3);
                } else {
                    // Toekomst: spreid over 15 dagen in de toekomst
                    $futureOffset = ($dayIndex - $pastMatchDays) * 3;
                    $matchDate = Carbon::now()->addDays($futureOffset + 1);
                }

                // Zorg ervoor dat elke speeldag 8 wedstrijden bevat
                foreach ($matches as [$homeTeam, $awayTeam]) {
                    // Genereer de wedstrijd
                    Game::create([
                        'home_team_id' => $homeTeam->id,
                        'away_team_id' => $awayTeam->id,
                        'home_score' => $dayIndex < $pastMatchDays ? rand(0, 5) : null, // Scores voor verleden, null voor toekomst
                        'away_score' => $dayIndex < $pastMatchDays ? rand(0, 5) : null, // Scores voor verleden, null voor toekomst
                        'match_date' => $matchDate,
                        'location' => $homeTeam->address ?? 'Unknown',
                        'division_id' => $division->id,
                    ]);
                }

                // Stop als we 30 speeldagen hebben bereikt
                if ($dayIndex >= $totalMatchDays - 1) {
                    break;
                }
            }
        }
    }
}
