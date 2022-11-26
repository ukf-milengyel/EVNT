<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        for ($i = 1; $i <= 50; $i++) {
            DB::table('tag')->insert([
                'name' => $faker->unique()->word,
                'user_id' => User::all()->random(1)->first()->id,
            ]);
        }
    }
}
