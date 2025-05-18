<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Inertia\Inertia;

class TeamController extends Controller
{
    public function show(Team $team)
    {
        $team->load(['division', 'homeMatches.homeTeam', 'homeMatches.awayTeam', 'awayMatches.homeTeam', 'awayMatches.awayTeam']);

        $matches = $team->homeMatches->merge($team->awayMatches)
        ->sortByDesc('match_date')
        ->where('match_date', '<=', now())
        ->map(function ($match) use ($team) {
            $isHome = $match->home_team_id === $team->id;
            $goalsFor = $isHome ? $match->home_score : $match->away_score;
            $goalsAgainst = $isHome ? $match->away_score : $match->home_score;

            if ($goalsFor > $goalsAgainst) $result = 'win';
            elseif ($goalsFor === $goalsAgainst) $result = 'draw';
            else $result = 'loss';

            $match->result = $result;
            return $match;
        })
        ->values();


        return Inertia::render('TeamDetail', [
            'team' => $team,
            'matches' => $matches,
            'division' => $team->division,
        ]);
    }

}
