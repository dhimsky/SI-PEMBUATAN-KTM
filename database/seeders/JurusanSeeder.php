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
            'Rekayasa Elektro dan Mekatronika',
            'Komputer dan Bisnis',
            'Rekayasa Mesin dan Industri Pertanian',
        ];

        foreach ($jurusanData as $jurusan) {
            Jurusan::create(['nama_jurusan' => $jurusan]);
        }
    }
}