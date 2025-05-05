<?php

namespace Database\Seeders;

use App\Models\Division;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DivisionSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
    Division::create([
            'name' => 'Premier League'
        ]);

        Division::create([
            'name' => 'La Liga'
        ]);

        Division::create([
            'name' => 'Serie A'
        ]);

        Division::create([
            'name' => 'Bundesliga'
        ]);

        Division::create([
            'name' => 'Ligue 1'
        ]);
    }
}