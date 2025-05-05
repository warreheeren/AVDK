<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{GameController, HomeController, TeamController};

Route::get('/', [HomeController::class, 'index']);
Route::get('/teams/{team}', [TeamController::class, 'show']);
Route::get('/games/{game}', [GameController::class, 'show']);