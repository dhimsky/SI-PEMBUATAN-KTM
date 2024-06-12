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
                'tempat_lahir' => $faker->randomElement(['Cilacap', 'Bandung', 'Jakarta']),
                'tanggal_lahir' => $faker->date,
                'jenis_kelamin' => $faker->randomElement(['Laki-laki', 'Perempuan']),
                'agama_id' => $faker->randomElement(['IS', 'KR', 'KA', 'HI', 'BU', 'KH']),
                'email' => $user->nim . '@gmail.com',
                'nohp' => $faker->numerify('#############'),
                'provinsi' => $faker->numerify('33'),
                'kabupaten' => $faker->numerify('33.01'),
                'kecamatan' => $randomKecamatan,
                'desa_kelurahan' => $faker->numerify('33.01.21.1002'),
                'rt' => $faker->numerify('###'),
                'rw' => $faker->numerify('###'),
                'nama_jalan' => $faker->randomElement(['Melati N0.3', 'Gatot Subroto No.1', 'Protokol No.2']),
                'nama_ayah' => $faker->name,
                'nik_ayah' => $faker->unique()->numerify('################'),
                'tempat_lahir_ayah' => $faker->randomElement(['Cilacap', 'Bandung', 'Jakarta']),
                'tanggal_lahir_ayah' => $faker->date,
                'pendidikan_ayah' => $faker->randomElement(['SMA', 'D3', 'S1']),
                'pekerjaan_ayah' => $faker->randomElement(['Guru', 'Petani', 'Pengusaha', 'Pensiunan']),
                'penghasilan_ayah' => $faker->randomElement(['< 1.000.000', '1.000.000 - 2.000.000', '2.000.000 - 3.000.000', '3.000.000.000 - 4.000.000', '4.000.000 - 5.000.000', '> 5.000.000']),
                'nama_ibu' => $faker->name,
                'nik_ibu' => $faker->unique()->numerify('################'),
                'tempat_lahir_ibu' => $faker->randomElement(['Cilacap', 'Bandung', 'Jakarta']),
                'tanggal_lahir_ibu' => $faker->date,
                'pendidikan_ibu' => $faker->randomElement(['SMA', 'D3', 'S1']),
                'pekerjaan_ibu' => $faker->randomElement(['Guru', 'Petani', 'Pengusaha', 'Pensiunan']),
                'penghasilan_ibu' => $faker->randomElement(['< 1.000.000', '1.000.000 - 2.000.000', '2.000.000 - 3.000.000', '3.000.000.000 - 4.000.000', '4.000.000 - 5.000.000', '> 5.000.000']),
                'nama_wali' => $faker->name,
                'alamat_wali' => $faker->streetAddress,
                'asal_sekolah' => $faker->sentence(3),
                'jurusan_asal_sekolah' => $faker->sentence(2),
                'pengalaman_organisasi' => $faker->sentence(3),
                'prodi_id' => $faker->randomElement([ 'TE', 'TL', 'TRM', 'TI', 'RKS', 'RM', 'ALKS', 'TM', 'TPPL', 'TPPA' ]),
                'ukt' => $faker->numerify('#######'),
                'angkatan_id' => $faker->randomElement(['18', '19', '20', '21', '22', '23', '24']),
                'jenis_tinggal_di_cilacap' => $faker->randomElement(['Kost', 'Rumah Sendiri', 'Rumah Orang Tua']),
                'alat_transportasi_ke_kampus' => $faker->randomElement(['Motor', 'Mobil', 'Transportasi Umum']),
                'sumber_biaya_kuliah' => $faker->randomElement(['Beasiswa', 'Orang Tua', 'Kerja Paruh Waktu']),
                'penerima_kartu_prasejahtera' => $faker->randomElement(['Ya', 'Tidak']),
                'jumlah_tanggungan_keluarga_yang_masih_sekolah' => $faker->numberBetween(0, 5),
                'anak_ke' => $faker->numberBetween(1, 5),
                'status_mhs' => $faker->randomElement(['aktif']),
            ];
        }
        DB::table('mahasiswa')->insert($data);
    }
}