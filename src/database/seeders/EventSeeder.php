<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()

    {
        for ($i = 1; $i <= 30; $i++) {
            $int= rand(1262055681,1262055681);
            $date = date("Y-m-d H:i:s",$int);
            DB::table('event')->insert([
                'name' => Str::random(10),
                'description' => Str::random(10),
                'user_id' => rand(1,21),
                'date' => $date,
                'organizer' => Str::random(20),
                'location_name' => Arr::random(["Nitra", "Bratislava", "Košice"]),
                'location_address' => Arr::random(["Ulica 1", "Ulica 2", "Ulica 3"]),
                'image' => "1.jpg",
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),

            ]);
        }
    }

}
