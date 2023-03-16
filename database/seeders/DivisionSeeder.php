<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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

		$divisions = array(
			array('name' => 'Atlantic', 'description' => fake()->paragraph()),
			array('name' => 'Central', 'description' => fake()->paragraph()),
			array('name' => 'Southeast', 'description' => fake()->paragraph()),
			array('name' => 'Northwest', 'description' => fake()->paragraph()),
			array('name' => 'Pacific', 'description' => fake()->paragraph()),
			array('name' => 'Southwest', 'description' => fake()->paragraph()),
		);

		DB::table('divisions')->insert($divisions);
    }
}
