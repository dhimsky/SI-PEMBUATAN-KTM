<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Jurusan;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jurusanData = [
            [
                'id_jurusan' => 'REMEK',
                'nama_jurusan' => 'Rekayasa Elektro dan Mekatronika',
            ],
            [
                'id_jurusan' => 'JKB',
                'nama_jurusan' => 'Komputer dan Bisnis',
            ],
            [
                'id_jurusan' => 'REMIP',
                'nama_jurusan' => 'Rekayasa Mesin dan Industri Pertanian',
            ],
        ];

        foreach ($jurusanData as $jurusan) {
            Jurusan::create($jurusan);
        }
    }
}