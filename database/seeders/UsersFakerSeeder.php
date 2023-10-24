<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as FakerFactory;

class UsersFakerSeeder extends Seeder
{
    public function run()
    {
        $faker = FakerFactory::create();
        $data = [];

        // Buat 100 entri acak
        for ($i = 1; $i <= 50; $i++) {
            $nim = $faker->unique()->numerify('#########');
            $username = $faker->unique()->name;
            $data[] = [
                'nim' => $nim,
                'role_id' => 2,
                'username' => $username,
                'password' => Hash::make('123')
            ];
        }

        DB::table('users')->insert($data);
    }
}