<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;
use Illuminate\Support\Facades\DB;

class MahasiswaFakerSeeder extends Seeder
{
    public function run()
    {
        $faker = FakerFactory::create();

        $users = DB::table('users')->get();

        $data = [];

        $kecamatans = [
            '33.01.01', '33.01.02', '33.01.03', '33.01.04', '33.01.05',
            '33.01.06', '33.01.07', '33.01.08', '33.01.09', '33.01.10',
            '33.01.11', '33.01.12', '33.01.13', '33.01.14', '33.01.15',
            '33.01.16', '33.01.17', '33.01.18', '33.01.19', '33.01.20',
            '33.01.21', '33.01.22', '33.01.23', '33.01.24',
        ];

        foreach ($users as $user) {
            $randomKecamatan = $faker->randomElement($kecamatans);

            $data[] = [
                'nim' => $user->nim,
                'nama_lengkap' => $user->username,
                'nik' => $faker->unique()->numerify('################'),
                'tempat_lahir' => $faker->city,
                'tanggal_lahir' => $faker->date,
                'jenis_kelamin' => $faker->randomElement(['Laki-laki', 'Perempuan']),
                'agama' => $faker->randomElement(['Islam', 'Kristen', 'Hindu', 'Buddha', 'Konghucu']),
                'email' => $faker->unique()->safeEmail,
                'nohp' => $faker->phoneNumber,
                'provinsi' => $faker->numerify('11'),
                'kabupaten' => $faker->numerify('11.02'),
                'kecamatan' => $randomKecamatan,
                'desa_kelurahan' => $faker->numerify('11.02.06.2002'),
                'rt' => $faker->numerify('###'),
                'rw' => $faker->numerify('###'),
                'alamat_jalan' => $faker->streetAddress,
                'nama_ayah' => $faker->name,
                'nik_ayah' => $faker->unique()->numerify('################'),
                'tempat_lahir_ayah' => $faker->city,
                'tanggal_lahir_ayah' => $faker->date,
                'pendidikan_ayah' => $faker->randomElement(['SMA', 'D3', 'S1']),
                'pekerjaan_ayah' => $faker->jobTitle,
                'penghasilan_ayah' => $faker->numerify('#######'),
                'nama_ibu' => $faker->name,
                'nik_ibu' => $faker->unique()->numerify('################'),
                'tempat_lahir_ibu' => $faker->city,
                'tanggal_lahir_ibu' => $faker->date,
                'pendidikan_ibu' => $faker->randomElement(['SMA', 'D3', 'S1']),
                'pekerjaan_ibu' => $faker->jobTitle,
                'penghasilan_ibu' => $faker->numerify('#######'),
                'nama_wali' => $faker->name,
                'alamat_wali' => $faker->streetAddress,
                'asal_sekolah' => $faker->sentence(3),
                'jurusan_asal_sekolah' => $faker->sentence(2),
                'pengalaman_organisasi' => $faker->sentence(3),
                'prodi_id' => $faker->randomElement([ 'TE', 'TL', 'TRM', 'TI', 'RKS', 'RM', 'ALKS', 'TM', 'TPPL', 'TPPA' ]),
                'ukt' => $faker->numerify('#######'),
                'jenis_tinggal_di_cilacap' => $faker->randomElement(['Kost', 'Rumah Sendiri', 'Rumah Orang Tua']),
                'alat_transportasi_ke_kampus' => $faker->randomElement(['Motor', 'Mobil', 'Transportasi Umum']),
                'sumber_biaya_kuliah' => $faker->randomElement(['Beasiswa', 'Orang Tua', 'Kerja Paruh Waktu']),
                'penerima_kartu_prasejahtera' => $faker->randomElement(['Ya', 'Tidak']),
                'jumlah_tanggungan_keluarga_yang_masih_sekolah' => $faker->numberBetween(0, 5),
                'anak_ke' => $faker->numberBetween(1, 5),
            ];
        }
        DB::table('mahasiswa')->insert($data);
    }
}