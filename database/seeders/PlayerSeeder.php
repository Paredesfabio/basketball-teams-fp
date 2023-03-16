<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlayerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('players')->delete();

        $teams = Team::all();
        $players = [];
        foreach ($teams as $team) {
            for ($i=0; $i < 5; $i++) {
                $newPlayer = array('team_id' => $team->id , 'first_name' => fake()->name(), 'last_name' => fake()->lastName(), 'role' => 1);
                array_push($players, $newPlayer);
            }
        }

		DB::table('players')->insert($players);
    }
}
