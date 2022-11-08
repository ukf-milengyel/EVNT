<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        for ($i = 1; $i <= 30; $i++) {
            DB::table('event')->insert([
                'name' => $faker->word,
                'description' => $faker->text(200),
                'user_id' => rand(1,21),
                'date' => $faker->dateTime,
                'organizer' => $faker->firstName,
                'location_name' => $faker->streetAddress,
                'location_address' => $faker->address,
                'image' => "1.jpg",
            ]);
        }
    }

}
