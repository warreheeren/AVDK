<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameEvent extends Model
{
        protected $fillable = [
            'game_id',
            'team_id',
            'event_type',
            'minute',
            'player_name',
            'player_in_name',
            'player_out_name',
        ];
        public function game()
        {
            return $this->belongsTo(Game::class);
        }

        public function team()
        {
            return $this->belongsTo(Team::class);
        }

}