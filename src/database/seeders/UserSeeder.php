<?php

namespace Database\Seeders;

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
        $faker = Factory::create();
        for ($i = 1; $i <= 20; $i++) {
            DB::table('users')->insert([
                'name' => $faker->firstName,
                'email' => $faker->email,
                'password' => password_hash('testtesttesttesttesttesttesttesttest', null),
                'group_id' => rand(2,6),
            ]);
        }
    }
}
