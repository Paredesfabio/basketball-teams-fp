<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Player;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('attributes')->delete();

        $iconPath = 'img/player_default.png';
        $position = ['F', 'G','C','C-F','F-G'];
        $height = ['7-0', '6-9','6-8','6-6','7-1','7-3','6-5','6-4','6-11', '6-10'];
        $country = Country::select('id')->where('code', 'US')->first();
        $players = Player::all();
        $attributes = [];
        foreach ($players as $player) {
            $newAttribute = array(
                'player_id' => $player->id,
                'country_id' => $country->id,
                'number' => rand(1,60),
                'position' => Arr::random($position),
                'birth_date' => fake()->dateTimeBetween('1990-01-01', '1998-12-31'),
                'draft_date' => fake()->dateTimeBetween('2012-12-31', '2023-02-27'),
                'height' => Arr::random($height),
                'weight' => rand(190,260),
                'school' => fake()->streetName(),
                'image' => $iconPath,
                'about_me' => fake()->paragraph());
            array_push($attributes, $newAttribute);
        }

		DB::table('attributes')->insert($attributes);
    }
}
