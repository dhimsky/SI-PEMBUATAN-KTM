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
            [
                'nim' => '210202031',
                'role_id' => 2,
                'username' => 'Dhimas Afrisetiawan',
                'password' => bcrypt(123)
            ],            [
                'nim' => '210202032',
                'role_id' => 2,
                'username' => 'Ahmad Barzanah',
                'password' => bcrypt(123)
            ],            [
                'nim' => '210202033',
                'role_id' => 2,
                'username' => 'Suki Cahyo',
                'password' => bcrypt(123)
            ],            [
                'nim' => '210202034',
                'role_id' => 2,
                'username' => 'Farhan Kebab',
                'password' => bcrypt(123)
            ],            [
                'nim' => '210202035',
                'role_id' => 2,
                'username' => 'Evos Galang',
                'password' => bcrypt(123)
            ],            [
                'nim' => '210202036',
                'role_id' => 2,
                'username' => 'Layla Exp',
                'password' => bcrypt(123)
            ],            [
                'nim' => '210202037',
                'role_id' => 2,
                'username' => 'Aldous Mid',
                'password' => bcrypt(123)
            ],            [
                'nim' => '210202038',
                'role_id' => 2,
                'username' => 'Nana Jungler',
                'password' => bcrypt(123)
            ],            [
                'nim' => '210202039',
                'role_id' => 2,
                'username' => 'Miya Late',
                'password' => bcrypt(123)
            ],            [
                'nim' => '210202040',
                'role_id' => 2,
                'username' => 'Suhadi',
                'password' => bcrypt(123)
            ]
        ];
        foreach($user as $key => $value){
            User::create($value);
        }
    }
}