<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Inertia\Inertia;

class GameController extends Controller
{
    public function show(Game $game)
    {
        $game->load(['homeTeam', 'awayTeam']);

        return Inertia::render('GameDetail', [
            'match' => $game,
        ]);
    }
}