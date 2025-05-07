<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Division;
use Inertia\Inertia;

class GameController extends Controller
{
    public function show($gameId)
    {
        // Haal de specifieke game op met de bijbehorende teams en divisie
        $game = Game::with(['homeTeam', 'awayTeam', 'division'])->findOrFail($gameId);

        // Haal alle divisies op voor het tonen van divisie-informatie
        $divisions = Division::with('teams')->get();

        return Inertia::render('GameDetail', [
            'game' => $game,        // Specifieke game doorgeven
            'divisions' => $divisions, // Alle divisies doorgeven
        ]);
    }
}
