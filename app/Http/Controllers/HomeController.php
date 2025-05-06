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
            'matches' => Game::with(['homeTeam.division', 'awayTeam.division']) 
                ->where('match_date', '<=', now())
                ->orderBy('match_date', 'desc')
                ->take(50)
                ->get(),
        ]);
    }
}
