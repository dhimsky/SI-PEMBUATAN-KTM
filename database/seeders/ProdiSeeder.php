<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Prodi;

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $prodiData = [
            [
                'id_prodi' => 'TE',
                'jurusan_id' => 'REMEK',
                'nama_prodi' => 'Teknik Elektronika',
                'jenjang' => 'D3',
            ],
            [
                'id_prodi' => 'TL',
                'jurusan_id' => 'REMEK',
                'nama_prodi' => 'Teknik Listrik',
                'jenjang' => 'D3',
            ],
            [
                'id_prodi' => 'TRM',
                'jurusan_id' => 'REMEK',
                'nama_prodi' => 'Teknologi Rekayasa Mekatronika',
                'jenjang' => 'D4',
            ],
            [
                'id_prodi' => 'TI',
                'jurusan_id' => 'KOBIS',
                'nama_prodi' => 'Teknik Informatika',
                'jenjang' => 'D3',
            ],
            [
                'id_prodi' => 'RKS',
                'jurusan_id' => 'KOBIS',
                'nama_prodi' => 'Rekayasa Keamanan Siber',
                'jenjang' => 'D4',
            ],
            [
                'id_prodi' => 'RM',
                'jurusan_id' => 'KOBIS',
                'nama_prodi' => 'Rekayasa Multimedia',
                'jenjang' => 'D4',
            ],
            [
                'id_prodi' => 'ALKS',
                'jurusan_id' => 'KOBIS',
                'nama_prodi' => 'Akutansi Lembaga Keuangan Syariah',
                'jenjang' => 'D4',
            ],
            [
                'id_prodi' => 'TM',
                'jurusan_id' => 'REMIP',
                'nama_prodi' => 'Teknik Mesin',
                'jenjang' => 'D3',
            ],
            [
                'id_prodi' => 'TPPL',
                'jurusan_id' => 'REMIP',
                'nama_prodi' => 'Teknik Pengendalian Pencemaran Lingkungan',
                'jenjang' => 'D4',
            ],
            [
                'id_prodi' => 'TPPA',
                'jurusan_id' => 'REMIP',
                'nama_prodi' => 'Teknik Pengembangan Produk Agroindustri',
                'jenjang' => 'D4',
            ],
        ];

        foreach ($prodiData as $prodi) {
            Prodi::create($prodi);
        }
    }
}