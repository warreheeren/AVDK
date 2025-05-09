<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\GameEvent;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EventController extends Controller
{
    public function create($gameId)
    {
        $game = Game::findOrFail($gameId);

        $teams = [
            'home' => $game->homeTeam,
            'away' => $game->awayTeam,
        ];

        $addEventUrl = route('add-event.store');

        return Inertia::render('AddEvent', [
            'game' => $game,
            'teams' => $teams,
            'addEventUrl' => $addEventUrl,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'game_id' => 'required|exists:games,id',
            'team_id' => 'required|exists:teams,id',
            'event_type' => 'required|string|max:255',
            'minute' => 'required|integer',
            'player_name' => 'nullable|string|max:255',
            'player_in_name' => 'nullable|string|max:255',
            'player_out_name' => 'nullable|string|max:255',
        ]);

        $event = GameEvent::create([
            'game_id' => $request->game_id,
            'team_id' => $request->team_id,
            'event_type' => $request->event_type,
            'minute' => $request->minute,
            'player_name' => $request->player_name,
            'player_in_name' => $request->player_in_name,
            'player_out_name' => $request->player_out_name,
        ]);

        return redirect()->route('add-event', ['gameId' => $request->game_id]);
    }
}
