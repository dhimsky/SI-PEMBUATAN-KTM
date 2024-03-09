<?php

namespace Database\Seeders;

use App\Models\TahunAngkatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TahunAngkatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $angkatanData = [
            [
                'id_angkatan' => '18',
                'tahun_angkatan' => '2018',
            ],
            [
                'id_angkatan' => '19',
                'tahun_angkatan' => '2019',
            ],
            [
                'id_angkatan' => '20',
                'tahun_angkatan' => '2020',
            ],
            [
                'id_angkatan' => '21',
                'tahun_angkatan' => '2021',
            ],
            [
                'id_angkatan' => '22',
                'tahun_angkatan' => '2022',
            ],
            [
                'id_angkatan' => '23',
                'tahun_angkatan' => '2023',
            ],
            [
                'id_angkatan' => '24',
                'tahun_angkatan' => '2024',
            ],
        ];

        foreach ($angkatanData as $angkatan) {
            TahunAngkatan::create($angkatan);
        }
    }
}