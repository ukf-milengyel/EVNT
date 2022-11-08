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

        for ($i = 1; $i <= 5; $i++) {
            DB::table('group')->insert([
                'name' => $faker->name,
                'permissions' => 0,
                'color' => $faker->hexColor,
            ]);
        }
    }
}
