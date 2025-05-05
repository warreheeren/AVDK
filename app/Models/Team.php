<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;
    protected $fillable = [
        'division_id', 'name', 'logo', 'address', 'primary_color', 'secondary_color',
        'matches_played', 'goals_for', 'goals_against', 'wins', 'losses', 'draws'
    ];

    public function division() {
        return $this->belongsTo(Division::class);
    }

    public function homeMatches() {
        return $this->hasMany(Game::class, 'home_team_id');
    }

    public function awayMatches() {
        return $this->hasMany(Game::class, 'away_team_id');
    }

    public function allMatches() {
        return $this->homeMatches->merge($this->awayMatches);
    }
}