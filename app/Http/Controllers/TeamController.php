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
        ->values();

    return Inertia::render('TeamDetail', [
        'team' => $team,
        'matches' => $matches,
    ]);
}

}
