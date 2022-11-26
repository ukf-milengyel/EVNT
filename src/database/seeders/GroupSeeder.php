<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        for ($i = 1; $i <= 20; $i++) {
            DB::table('group')->insert([
                'name' => $faker->unique()->word,
                'permissions' => rand(0, 15) * 2,
                'color' => $faker->hexColor,
            ]);
        }
    }
}
