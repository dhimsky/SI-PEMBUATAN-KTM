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
                'jurusan_id' => 1,
                'nama_prodi' => 'Teknik Elektronika (D3)',
            ],
            [
                'jurusan_id' => 1,
                'nama_prodi' => 'Teknik Listrik (D3)',
            ],
            [
                'jurusan_id' => 1,
                'nama_prodi' => 'Teknologi Rekayasa Mekatronika (D4)',
            ],
            [
                'jurusan_id' => 2,
                'nama_prodi' => 'Teknik Informatika (D3)',
            ],
            [
                'jurusan_id' => 2,
                'nama_prodi' => 'Rekayasa Keamanan Siber (D4)',
            ],
            [
                'jurusan_id' => 2,
                'nama_prodi' => 'Rekayasa Multimedia (D4)',
            ],
            [
                'jurusan_id' => 2,
                'nama_prodi' => 'Akutansi Lembaga Keuangan Syariah (D4)',
            ],
            [
                'jurusan_id' => 3,
                'nama_prodi' => 'Teknik Mesin (D3)',
            ],
            [
                'jurusan_id' => 3,
                'nama_prodi' => 'Teknik Pengendalian Pencemaran Lingkungan (D4)',
            ],
            [
                'jurusan_id' => 3,
                'nama_prodi' => 'Pengembangan Produk Agroindustri (D4)',
            ],
        ];

        foreach ($prodiData as $prodi) {
            Prodi::create($prodi);
        }
    }
}