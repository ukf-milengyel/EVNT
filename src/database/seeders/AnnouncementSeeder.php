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

        for ($i = 1; $i <= 100; $i++) {
            DB::table('announcement')->insert([
                'body' => $faker->text(255),
                'image' => rand(0,1) == 0 ? "0.jpg" : null,
                'event_id' => Event::all()->random(1)->first()->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

    }
}
