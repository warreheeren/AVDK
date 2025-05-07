<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Division;
use Inertia\Inertia;

class GameController extends Controller
{
    public function show($gameId)
    {
        $game = Game::with(['homeTeam', 'awayTeam', 'division'])->findOrFail($gameId);

        $divisions = Division::with('teams')->get();

        return Inertia::render('GameDetail', [
            'game' => $game,
            'divisions' => $divisions,
        ]);
    }
}
