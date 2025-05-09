<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{GameController, HomeController, TeamController, AuthController, EventController};
use Inertia\Inertia;
use App\Models\Game;
use App\Models\Team;

Route::get('/', [HomeController::class, 'index']);
Route::get('/teams/{team}', [TeamController::class, 'show']);
Route::get('/games/{game}', [GameController::class, 'show']);

Route::get('/admin', [GameController::class, 'showAdminPanel'])->middleware('auth');
Route::get('/login', function () {
    return Inertia::render('Login');
})->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::get('/add-event/{gameId}', [EventController::class, 'create'])->name('add-event');
Route::post('/add-event', [EventController::class, 'store'])->name('add-event.store');

Route::get('/games/{gameId}/events', [GameController::class, 'getEventsForPolling'])->name('games.events');
