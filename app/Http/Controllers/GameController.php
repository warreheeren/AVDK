<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Division;
use App\Models\GameEvent;
use Inertia\Inertia;

class GameController extends Controller
{
    public function show($gameId)
    {
        $game = Game::with(['homeTeam', 'awayTeam', 'division', 'events'])->findOrFail($gameId);

        $divisions = Division::with('teams')->get();

        $events = GameEvent::where('game_id', $gameId)->orderBy('minute')->get();
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

            $games = Game::where('division_id', $division->id)->get();

            foreach ($games as $gameItem) {
                $homeTeamId = $gameItem->home_team_id;
                $awayTeamId = $gameItem->away_team_id;
                $homeGoals = $gameItem->home_score;
                $awayGoals = $gameItem->away_score;

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

        return Inertia::render('GameDetail', [
            'game' => $game,
            'divisions' => $divisions,
            'events' => $events,
            'standings' => $standings,
        ]);
    }
}
