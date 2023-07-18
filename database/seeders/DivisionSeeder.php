<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('divisions')->delete();

        $faker = Faker::create();

		$divisions = array(
			array('name' => 'Atlantic', 'description' => $faker->paragraph()),
			array('name' => 'Central', 'description' => $faker->paragraph()),
			array('name' => 'Southeast', 'description' => $faker->paragraph()),
			array('name' => 'Northwest', 'description' => $faker->paragraph()),
			array('name' => 'Pacific', 'description' => $faker->paragraph()),
			array('name' => 'Southwest', 'description' => $faker->paragraph()),
            array('name' => 'Venezuela', 'description' => $faker->paragraph()),
            array('name' => 'Colombia', 'description' => $faker->paragraph()),
            array('name' => 'Chile', 'description' => $faker->paragraph()),
		);

		DB::table('divisions')->insert($divisions);
    }
}
