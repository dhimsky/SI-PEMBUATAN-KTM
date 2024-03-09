<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Agama;

class AgamaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $agamaData = [
            [
                'id_agama' => 'IS',
                'nama_agama' =>'Islam',
            ],
            [
                'id_agama' => 'KR',
                'nama_agama' => 'Kristen',
            ],
            [
                'id_agama' => 'KA',
                'nama_agama' => 'Katolik',
            ],
            [
                'id_agama' => 'HI',
                'nama_agama' => 'Hindu',
            ],
            [
                'id_agama' => 'BU',
                'nama_agama' => 'Buddha',
            ],
            [
                'id_agama' => 'KH',
                'nama_agama' => 'Khonghucu',
            ],
        ];

        foreach ($agamaData as $agama) {
            Agama::create($agama);
        }
    }
}