<?php

namespace Database\Seeders;

use App\Models\Division;
use App\Models\Team;
use App\Models\Game;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(DivisionSeeder::class);

        $this->call(TeamSeeder::class);

        $divisions = Division::with('teams')->get();

      foreach ($divisions as $division) {
    $teams = $division->teams->shuffle(); // willekeurige volgorde per divisie
    $teamCount = $teams->count();

    // Als oneven aantal, voeg dummy team toe (bye week)
    $hasBye = false;
    if ($teamCount % 2 !== 0) {
        $teams->push(null); // null = bye
        $teamCount++;
        $hasBye = true;
    }

    $half = $teamCount / 2;
    $rounds = $teamCount - 1;
    $matchDays = [];

    for ($round = 0; $round < $rounds; $round++) {
        $dayMatches = [];

        for ($i = 0; $i < $half; $i++) {
            $home = $teams[$i];
            $away = $teams[$teamCount - 1 - $i];

            if ($home === null || $away === null) {
                continue; // skip if bye
            }

            // Om-en-om thuis/uit per speeldag
            if ($round % 2 === 0) {
                $dayMatches[] = [$home, $away];
            } else {
                $dayMatches[] = [$away, $home];
            }
        }

        $matchDays[] = $dayMatches;

        // Rotate teams (behalve eerste)
        $fixed = $teams->shift(); // 1e team blijft op plek
        $moved = $teams->pop();   // laatste naar tweede plek
        $teams->prepend($fixed);
        $teams->splice(1, 0, [$moved]);
    }

    // Maak wedstrijden aan op speeldagen
    foreach ($matchDays as $index => $matches) {
        foreach ($matches as [$homeTeam, $awayTeam]) {
            Game::create([
                'home_team_id' => $homeTeam->id,
                'away_team_id' => $awayTeam->id,
                'home_score' => rand(0, 5),
                'away_score' => rand(0, 5),
                'match_date' => now()->subDays(21 - $index * 3),
                'location' => $homeTeam->address,
            ]);
        }
    }
}


    }
}
