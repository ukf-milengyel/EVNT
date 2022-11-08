<?php

namespace Database\Seeders;

use App\Models\Group;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = 20;
        $faker = Factory::create();
        for ($i = 0; $i < $count; $i++) {
            DB::table('users')->insert([
                'name' => $faker->firstName,
                'email' => $faker->email,
                'password' => password_hash('testtesttesttesttesttesttesttesttest', null),
                'group_id' => Group::all()->random(1)->first()->id,
            ]);
        }
    }
}
