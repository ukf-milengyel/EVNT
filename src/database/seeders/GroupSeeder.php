<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for ($i = 1; $i <= 5; $i++) {
            DB::table('group')->insert([
                'name' => Str::random(10),
                'permissions' => Arr::random([1,2,4,8,16]),
                'color' => Arr::random(["#3498EB", "#FF5733", "#7EEB16"]),
            ]);
        }
    }
}
