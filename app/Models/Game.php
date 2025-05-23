<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;
     protected $fillable = [
        'home_team_id', 'away_team_id', 'home_score', 'away_score', 'match_date', 'location', 'result'
    ];

    public function homeTeam() {
        return $this->belongsTo(Team::class, 'home_team_id');
    }

    public function awayTeam() {
        return $this->belongsTo(Team::class, 'away_team_id');
    }
    public function division()
    {
        return $this->belongsTo(Division::class);
    }
    public function events()
    {
        return $this->hasMany(GameEvent::class,'game_id');
    }

}
