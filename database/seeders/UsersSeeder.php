<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    // public function run()
    // {
    //     $faker = Faker::create();

    //     for ($i = 0; $i < 50; $i++) {
    //         User::create([
    //             'nim' => $faker->unique()->numerify('#########'),
    //             'role_id' => 2,
    //             'username' => $faker->userName,
    //             'password' => Hash::make($faker->password)
    //         ]);
    //     }
    // }
    public function run()
    {
        $user = [
            [
                'nim' => '123',
                'role_id' => 1,
                'username' => 'Admin123',
                'password' => bcrypt(123)
            ],
            [
                'nim' => '321',
                'role_id' => 3,
                'username' => 'Pegawai Bank',
                'password' => bcrypt(123)
            ],
        ];
        foreach($user as $key => $value){
            User::create($value);
        }
    }
}