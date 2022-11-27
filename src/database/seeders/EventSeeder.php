<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Tag;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

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
            $event = new Event();
            $event->name = $faker->unique()->word;
            $event->description = $faker->text(1000);
            $event->user_id = User::all()->random(1)->first()->id;
            $event->date = $faker->dateTimeBetween('+1 week', '+1 month');
            $event->organizer = $faker->firstName;
            $event->location_name = $faker->streetAddress;
            $event->location_address = $faker->address;
            $event->image = "0.jpg";
            $event->created_at = now();
            $event->updated_at = now();
            $event->save();

            // add random tags
            $rand = rand(0, 10);
            for ($j = 0; $j < $rand; $j++){
                $event->tag()->attach(Tag::all()->random(1)->first()->id);
            }

            // add random attendants
            $rand = rand(0, 20);
            for ($j = 0; $j < $rand; $j++){
                $event->user_a()->attach(User::all()->random(1)->first()->id);
            }
        }
    }

}
