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
        $game = Game::with(['homeTeam', 'awayTeam', 'division','events'])->findOrFail($gameId);

        $divisions = Division::with('teams')->get();

        $events = GameEvent::where('game_id', $gameId)
        ->orderBy('minute')
        ->get();
        return Inertia::render('GameDetail', [
            'game' => $game,
            'divisions' => $divisions,
            'events' => $events,
        ]);
    }
}