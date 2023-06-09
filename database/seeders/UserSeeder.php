<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        $users = array(
            array(  'name' => 'Administration',
                    'email' => 'admin@gmail.com',
                    'created_at' => now(),
                    'updated_at' => now(),
                    'password' => Hash::make(123456),
                )
        );

		DB::table('users')->insert($users);
    }
}
