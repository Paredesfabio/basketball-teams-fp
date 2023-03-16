<?php

namespace Database\Seeders;

use App\Models\Division;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teams')->delete();
        $iconPath = 'img/team_default.png';
        $divisions = Division::all();
        $teams = [];
        foreach ($divisions as $division) {
            for ($i=0; $i < 4; $i++) {
                $newTeam = array('division_id' => $division->id , 'name' => fake()->unique()->company(), 'icon' => $iconPath ,'about' => fake()->paragraph(), 'color' => fake()->hexColor() );
                array_push($teams, $newTeam);
            }
        }

		DB::table('teams')->insert($teams);
    }
}
