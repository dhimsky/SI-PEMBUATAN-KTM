<?php

namespace Database\Seeders;

use App\Models\Agama;
use App\Models\Jurusan;
use App\Models\Prodi;
use App\Models\Roles;
use App\Models\TahunAngkatan;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Roles::create([
            'level' => 'Admin',
        ]);

        Roles::create([
            'level' => 'Mahasiswa',
        ]);

        Roles::create([
            'level' => 'Pegawai Bank',
        ]);

        $user = [
            [
                'no_identitas' => '123',
                'role_id' => 1,
                'nama_lengkap' => 'Staff BAAK',
                'password' => bcrypt('abcd1234')
            ],
            [
                'no_identitas' => '321',
                'role_id' => 3,
                'nama_lengkap' => 'Insan Ahmad',
                'password' => bcrypt('abcd1234')
            ],
            [
                'no_identitas' => '111',
                'role_id' => 2,
                'nama_lengkap' => 'Dhimas Afrisetiawan',
                'password' => bcrypt('abcd1234')
            ],
        ];
        foreach($user as $key => $value){
            User::create($value);
        }

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
                'jurusan_id' => 'JKB',
                'nama_prodi' => 'Teknik Informatika',
                'jenjang' => 'D3',
            ],
            [
                'id_prodi' => 'RKS',
                'jurusan_id' => 'JKB',
                'nama_prodi' => 'Rekayasa Keamanan Siber',
                'jenjang' => 'D4',
            ],
            [
                'id_prodi' => 'RM',
                'jurusan_id' => 'JKB',
                'nama_prodi' => 'Rekayasa Multimedia',
                'jenjang' => 'D4',
            ],
            [
                'id_prodi' => 'ALKS',
                'jurusan_id' => 'JKB',
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
            [
                'id_prodi' => 'TRET',
                'jurusan_id' => 'REMIP',
                'nama_prodi' => 'Teknologi Rekayasa Energi Terbarukan',
                'jenjang' => 'D4',
            ],
        ];

        foreach ($prodiData as $prodi) {
            Prodi::create($prodi);
        }

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