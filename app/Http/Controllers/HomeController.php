<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Game;
use App\Models\Team;
use Inertia\Inertia;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    public function index()
{
    $divisions = Division::with('teams')->get();
    $matches = Game::with(['homeTeam.division', 'awayTeam.division'])
    ->orderBy('match_date', 'desc')
    ->get();


    $standings = [];

    foreach ($divisions as $division) {
        $teams = $division->teams;
        $teamStats = [];

        foreach ($teams as $team) {
            $teamStats[$team->id] = [
                'id' => $team->id,
                'name' => $team->name,
                'logo' => $team->logo,
                'matches' => 0,
                'wins' => 0,
                'draws' => 0,
                'losses' => 0,
                'goal_difference' => 0,
                'points' => 0,
            ];
        }

        $games = Game::where('division_id', $division->id)->where('match_date', '<=', now())->get();

        foreach ($games as $game) {
            $homeTeamId = $game->home_team_id;
            $awayTeamId = $game->away_team_id;
            $homeGoals = $game->home_score;
            $awayGoals = $game->away_score;

            if (isset($teamStats[$homeTeamId])) {
                $teamStats[$homeTeamId]['matches'] += 1;
                $teamStats[$homeTeamId]['goal_difference'] += $homeGoals - $awayGoals;

                if ($homeGoals > $awayGoals) {
                    $teamStats[$homeTeamId]['wins'] += 1;
                    $teamStats[$homeTeamId]['points'] += 3;
                } elseif ($homeGoals === $awayGoals) {
                    $teamStats[$homeTeamId]['draws'] += 1;
                    $teamStats[$homeTeamId]['points'] += 1;
                } else {
                    $teamStats[$homeTeamId]['losses'] += 1;
                }
            }

            if (isset($teamStats[$awayTeamId])) {
                $teamStats[$awayTeamId]['matches'] += 1;
                $teamStats[$awayTeamId]['goal_difference'] += $awayGoals - $homeGoals;

                if ($awayGoals > $homeGoals) {
                    $teamStats[$awayTeamId]['wins'] += 1;
                    $teamStats[$awayTeamId]['points'] += 3;
                } elseif ($awayGoals === $homeGoals) {
                    $teamStats[$awayTeamId]['draws'] += 1;
                    $teamStats[$awayTeamId]['points'] += 1;
                } else {
                    $teamStats[$awayTeamId]['losses'] += 1;
                }
            }
        }

        $sorted = collect($teamStats)->sortByDesc(function ($team) {
            return [$team['points'], $team['goal_difference']];
        })->values();

        $standings[$division->id] = $sorted;
    }
    return Inertia::render('Home', [
        'divisions' => $divisions,
        'matches' => $matches,
        'standings' => $standings,
    ]);
}

}
