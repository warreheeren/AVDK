<?php

namespace App\Http\Controllers;

use App\Models\{Division, Game};
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        return Inertia::render('Home', [
            'divisions' => Division::with('teams')->get(),
            'matches' => Game::with(['homeTeam', 'awayTeam'])->orderBy('match_date', 'desc')->take(10)->get(),
        ]);
    }
}