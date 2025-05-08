<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('game_events', function (Blueprint $table) {
        $table->id();
        $table->foreignId('game_id')->constrained()->onDelete('cascade');
        $table->foreignId('team_id')->constrained()->onDelete('cascade');
        $table->string('event_type');
        $table->integer('minute');
        $table->string('player_name')->nullable();
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_events');
    }
};
