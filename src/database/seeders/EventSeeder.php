<?php

namespace Database\Seeders;

use App\Models\User;
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
        $count = 30;
        $faker = Factory::create();
        for ($i = 1; $i <= $count; $i++) {
            DB::table('event')->insert([
                'name' => $faker->word,
                'description' => $faker->text(1000),
                'user_id' => User::all()->random(1)->first()->id,
                'date' => $faker->dateTimeBetween('+1 week', '+1 month'),
                'organizer' => $faker->firstName,
                'location_name' => $faker->streetAddress,
                'location_address' => $faker->address,
                'image' => "0.jpg",
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

}
