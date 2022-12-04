<?php

namespace Database\Seeders;

use App\Models\Event;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnnouncementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        for ($i = 1; $i <= 10; $i++) {
            DB::table('announcement')->insert([
                'body' => $faker->text(255),
                'image' => "0.jpg",
                'event_id' => Event::all()->random(1)->first()->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

    }
}
