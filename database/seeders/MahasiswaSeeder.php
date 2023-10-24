<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Mahasiswa;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mahasiswaData = [
            [
                'nim' => 210202031,
                'nama_lengkap' => 'Dhimas Afrisetiawan',
                'nik' => '1234567890123456',
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '1995-01-01',
                'jenis_kelamin' => 'Laki-laki',
                'agama' => 'Islam',
                'email' => 'dhimas@example.com',
                'nohp' => '081234567890',
                'provinsi' => '11',
                'kabupaten' => '11.02',
                'kecamatan' => '11.02.06',
                'desa_kelurahan' => '11.02.06.2002',
                'rt' => '001',
                'rw' => '002',
                'alamat_jalan' => 'Jl. Sudirman No. 123',
                'nama_ayah' => 'Dad Doe',
                'nik_ayah' => '1234567890123456',
                'tempat_lahir_ayah' => 'Jakarta',
                'tanggal_lahir_ayah' => '1965-01-01',
                'pendidikan_ayah' => 'SMA',
                'pekerjaan_ayah' => 'Wiraswasta',
                'penghasilan_ayah' => '5000000',
                'nama_ibu' => 'Mom Doe',
                'nik_ibu' => '1234567890123456',
                'tempat_lahir_ibu' => 'Jakarta',
                'tanggal_lahir_ibu' => '1970-01-01',
                'pendidikan_ibu' => 'SMA',
                'pekerjaan_ibu' => 'Ibu Rumah Tangga',
                'penghasilan_ibu' => '4000000',
                'nama_wali' => 'Guardian Doe',
                'alamat_wali' => 'Jl. Gatot Subroto No. 456',
                'asal_sekolah' => 'SMA Negeri 1 Jakarta',
                'jurusan_asal_sekolah' => 'IPA',
                'pengalaman_organisasi' => 'Anggota OSIS',
                'prodi_id' => 1, // ID Prodi untuk D-3 Teknik Elektronika
                'ukt' => '1500000',
                'jenis_tinggal_di_cilacap' => 'Kost',
                'alat_transportasi_ke_kampus' => 'Motor',
                'sumber_biaya_kuliah' => 'Beasiswa',
                'penerima_kartu_prasejahtera' => 'Ya',
                'jumlah_tanggungan_keluarga_yang_masih_sekolah' => 1,
                'anak_ke' => 2,
            ],[
                'nim' => 210202032,
                'nama_lengkap' => 'Ahmad Barzanah',
                'nik' => '1234567890123457',
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '1995-01-01',
                'jenis_kelamin' => 'Laki-laki',
                'agama' => 'Islam',
                'email' => 'ahmad@example.com',
                'nohp' => '081234567890',
                'provinsi' => '11',
                'kabupaten' => '11.02',
                'kecamatan' => '11.02.06',
                'desa_kelurahan' => '11.02.06.2002',
                'rt' => '001',
                'rw' => '002',
                'alamat_jalan' => 'Jl. Sudirman No. 123',
                'nama_ayah' => 'Dad Doe',
                'nik_ayah' => '1234567890123456',
                'tempat_lahir_ayah' => 'Jakarta',
                'tanggal_lahir_ayah' => '1965-01-01',
                'pendidikan_ayah' => 'SMA',
                'pekerjaan_ayah' => 'Wiraswasta',
                'penghasilan_ayah' => '5000000',
                'nama_ibu' => 'Mom Doe',
                'nik_ibu' => '1234567890123456',
                'tempat_lahir_ibu' => 'Jakarta',
                'tanggal_lahir_ibu' => '1970-01-01',
                'pendidikan_ibu' => 'SMA',
                'pekerjaan_ibu' => 'Ibu Rumah Tangga',
                'penghasilan_ibu' => '4000000',
                'nama_wali' => 'Guardian Doe',
                'alamat_wali' => 'Jl. Gatot Subroto No. 456',
                'asal_sekolah' => 'SMA Negeri 1 Jakarta',
                'jurusan_asal_sekolah' => 'IPA',
                'pengalaman_organisasi' => 'Anggota OSIS',
                'prodi_id' => 1, // ID Prodi untuk D-3 Teknik Elektronika
                'ukt' => '1500000',
                'jenis_tinggal_di_cilacap' => 'Kost',
                'alat_transportasi_ke_kampus' => 'Motor',
                'sumber_biaya_kuliah' => 'Beasiswa',
                'penerima_kartu_prasejahtera' => 'Ya',
                'jumlah_tanggungan_keluarga_yang_masih_sekolah' => 1,
                'anak_ke' => 2,
            ],[
                'nim' => 210202033,
                'nama_lengkap' => 'Suki Cahyo',
                'nik' => '1234567890123419',
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '1995-01-01',
                'jenis_kelamin' => 'Laki-laki',
                'agama' => 'Islam',
                'email' => 'suki@example.com',
                'nohp' => '081234567890',
                'provinsi' => '11',
                'kabupaten' => '11.02',
                'kecamatan' => '11.02.06',
                'desa_kelurahan' => '11.02.06.2002',
                'rt' => '001',
                'rw' => '002',
                'alamat_jalan' => 'Jl. Sudirman No. 123',
                'nama_ayah' => 'Dad Doe',
                'nik_ayah' => '1234567890123456',
                'tempat_lahir_ayah' => 'Jakarta',
                'tanggal_lahir_ayah' => '1965-01-01',
                'pendidikan_ayah' => 'SMA',
                'pekerjaan_ayah' => 'Wiraswasta',
                'penghasilan_ayah' => '5000000',
                'nama_ibu' => 'Mom Doe',
                'nik_ibu' => '1234567890123456',
                'tempat_lahir_ibu' => 'Jakarta',
                'tanggal_lahir_ibu' => '1970-01-01',
                'pendidikan_ibu' => 'SMA',
                'pekerjaan_ibu' => 'Ibu Rumah Tangga',
                'penghasilan_ibu' => '4000000',
                'nama_wali' => 'Guardian Doe',
                'alamat_wali' => 'Jl. Gatot Subroto No. 456',
                'asal_sekolah' => 'SMA Negeri 1 Jakarta',
                'jurusan_asal_sekolah' => 'IPA',
                'pengalaman_organisasi' => 'Anggota OSIS',
                'prodi_id' => 1, // ID Prodi untuk D-3 Teknik Elektronika
                'ukt' => '1500000',
                'jenis_tinggal_di_cilacap' => 'Kost',
                'alat_transportasi_ke_kampus' => 'Motor',
                'sumber_biaya_kuliah' => 'Beasiswa',
                'penerima_kartu_prasejahtera' => 'Ya',
                'jumlah_tanggungan_keluarga_yang_masih_sekolah' => 1,
                'anak_ke' => 2,
            ],[
                'nim' => 210202034,
                'nama_lengkap' => 'Farhan Kebab',
                'nik' => '1234567890123458',
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '1995-01-01',
                'jenis_kelamin' => 'Laki-laki',
                'agama' => 'Islam',
                'email' => 'farhan@example.com',
                'nohp' => '081234567890',
                'provinsi' => '11',
                'kabupaten' => '11.02',
                'kecamatan' => '11.02.06',
                'desa_kelurahan' => '11.02.06.2002',
                'rt' => '001',
                'rw' => '002',
                'alamat_jalan' => 'Jl. Sudirman No. 123',
                'nama_ayah' => 'Dad Doe',
                'nik_ayah' => '1234567890123456',
                'tempat_lahir_ayah' => 'Jakarta',
                'tanggal_lahir_ayah' => '1965-01-01',
                'pendidikan_ayah' => 'SMA',
                'pekerjaan_ayah' => 'Wiraswasta',
                'penghasilan_ayah' => '5000000',
                'nama_ibu' => 'Mom Doe',
                'nik_ibu' => '1234567890123456',
                'tempat_lahir_ibu' => 'Jakarta',
                'tanggal_lahir_ibu' => '1970-01-01',
                'pendidikan_ibu' => 'SMA',
                'pekerjaan_ibu' => 'Ibu Rumah Tangga',
                'penghasilan_ibu' => '4000000',
                'nama_wali' => 'Guardian Doe',
                'alamat_wali' => 'Jl. Gatot Subroto No. 456',
                'asal_sekolah' => 'SMA Negeri 1 Jakarta',
                'jurusan_asal_sekolah' => 'IPA',
                'pengalaman_organisasi' => 'Anggota OSIS',
                'prodi_id' => 1, // ID Prodi untuk D-3 Teknik Elektronika
                'ukt' => '1500000',
                'jenis_tinggal_di_cilacap' => 'Kost',
                'alat_transportasi_ke_kampus' => 'Motor',
                'sumber_biaya_kuliah' => 'Beasiswa',
                'penerima_kartu_prasejahtera' => 'Ya',
                'jumlah_tanggungan_keluarga_yang_masih_sekolah' => 1,
                'anak_ke' => 2,
            ],[
                'nim' => 210202035,
                'nama_lengkap' => 'Evos Galang',
                'nik' => '1234567890123459',
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '1995-01-01',
                'jenis_kelamin' => 'Laki-laki',
                'agama' => 'Islam',
                'email' => 'evos@example.com',
                'nohp' => '081234567890',
                'provinsi' => '11',
                'kabupaten' => '11.02',
                'kecamatan' => '11.02.06',
                'desa_kelurahan' => '11.02.06.2002',
                'rt' => '001',
                'rw' => '002',
                'alamat_jalan' => 'Jl. Sudirman No. 123',
                'nama_ayah' => 'Dad Doe',
                'nik_ayah' => '1234567890123456',
                'tempat_lahir_ayah' => 'Jakarta',
                'tanggal_lahir_ayah' => '1965-01-01',
                'pendidikan_ayah' => 'SMA',
                'pekerjaan_ayah' => 'Wiraswasta',
                'penghasilan_ayah' => '5000000',
                'nama_ibu' => 'Mom Doe',
                'nik_ibu' => '1234567890123456',
                'tempat_lahir_ibu' => 'Jakarta',
                'tanggal_lahir_ibu' => '1970-01-01',
                'pendidikan_ibu' => 'SMA',
                'pekerjaan_ibu' => 'Ibu Rumah Tangga',
                'penghasilan_ibu' => '4000000',
                'nama_wali' => 'Guardian Doe',
                'alamat_wali' => 'Jl. Gatot Subroto No. 456',
                'asal_sekolah' => 'SMA Negeri 1 Jakarta',
                'jurusan_asal_sekolah' => 'IPA',
                'pengalaman_organisasi' => 'Anggota OSIS',
                'prodi_id' => 1, // ID Prodi untuk D-3 Teknik Elektronika
                'ukt' => '1500000',
                'jenis_tinggal_di_cilacap' => 'Kost',
                'alat_transportasi_ke_kampus' => 'Motor',
                'sumber_biaya_kuliah' => 'Beasiswa',
                'penerima_kartu_prasejahtera' => 'Ya',
                'jumlah_tanggungan_keluarga_yang_masih_sekolah' => 1,
                'anak_ke' => 2,
            ],[
                'nim' => 210202036,
                'nama_lengkap' => 'Layla Exp',
                'nik' => '1234567890123410',
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '1995-01-01',
                'jenis_kelamin' => 'Laki-laki',
                'agama' => 'Islam',
                'email' => 'layla@example.com',
                'nohp' => '081234567890',
                'provinsi' => '11',
                'kabupaten' => '11.02',
                'kecamatan' => '11.02.06',
                'desa_kelurahan' => '11.02.06.2002',
                'rt' => '001',
                'rw' => '002',
                'alamat_jalan' => 'Jl. Sudirman No. 123',
                'nama_ayah' => 'Dad Doe',
                'nik_ayah' => '1234567890123456',
                'tempat_lahir_ayah' => 'Jakarta',
                'tanggal_lahir_ayah' => '1965-01-01',
                'pendidikan_ayah' => 'SMA',
                'pekerjaan_ayah' => 'Wiraswasta',
                'penghasilan_ayah' => '5000000',
                'nama_ibu' => 'Mom Doe',
                'nik_ibu' => '1234567890123456',
                'tempat_lahir_ibu' => 'Jakarta',
                'tanggal_lahir_ibu' => '1970-01-01',
                'pendidikan_ibu' => 'SMA',
                'pekerjaan_ibu' => 'Ibu Rumah Tangga',
                'penghasilan_ibu' => '4000000',
                'nama_wali' => 'Guardian Doe',
                'alamat_wali' => 'Jl. Gatot Subroto No. 456',
                'asal_sekolah' => 'SMA Negeri 1 Jakarta',
                'jurusan_asal_sekolah' => 'IPA',
                'pengalaman_organisasi' => 'Anggota OSIS',
                'prodi_id' => 1, // ID Prodi untuk D-3 Teknik Elektronika
                'ukt' => '1500000',
                'jenis_tinggal_di_cilacap' => 'Kost',
                'alat_transportasi_ke_kampus' => 'Motor',
                'sumber_biaya_kuliah' => 'Beasiswa',
                'penerima_kartu_prasejahtera' => 'Ya',
                'jumlah_tanggungan_keluarga_yang_masih_sekolah' => 1,
                'anak_ke' => 2,
            ],[
                'nim' => 210202037,
                'nama_lengkap' => 'Aldous Mid',
                'nik' => '1234567890123411',
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '1995-01-01',
                'jenis_kelamin' => 'Laki-laki',
                'agama' => 'Islam',
                'email' => 'aldous@example.com',
                'nohp' => '081234567890',
                'provinsi' => '11',
                'kabupaten' => '11.02',
                'kecamatan' => '11.02.06',
                'desa_kelurahan' => '11.02.06.2002',
                'rt' => '001',
                'rw' => '002',
                'alamat_jalan' => 'Jl. Sudirman No. 123',
                'nama_ayah' => 'Dad Doe',
                'nik_ayah' => '1234567890123456',
                'tempat_lahir_ayah' => 'Jakarta',
                'tanggal_lahir_ayah' => '1965-01-01',
                'pendidikan_ayah' => 'SMA',
                'pekerjaan_ayah' => 'Wiraswasta',
                'penghasilan_ayah' => '5000000',
                'nama_ibu' => 'Mom Doe',
                'nik_ibu' => '1234567890123456',
                'tempat_lahir_ibu' => 'Jakarta',
                'tanggal_lahir_ibu' => '1970-01-01',
                'pendidikan_ibu' => 'SMA',
                'pekerjaan_ibu' => 'Ibu Rumah Tangga',
                'penghasilan_ibu' => '4000000',
                'nama_wali' => 'Guardian Doe',
                'alamat_wali' => 'Jl. Gatot Subroto No. 456',
                'asal_sekolah' => 'SMA Negeri 1 Jakarta',
                'jurusan_asal_sekolah' => 'IPA',
                'pengalaman_organisasi' => 'Anggota OSIS',
                'prodi_id' => 1, // ID Prodi untuk D-3 Teknik Elektronika
                'ukt' => '1500000',
                'jenis_tinggal_di_cilacap' => 'Kost',
                'alat_transportasi_ke_kampus' => 'Motor',
                'sumber_biaya_kuliah' => 'Beasiswa',
                'penerima_kartu_prasejahtera' => 'Ya',
                'jumlah_tanggungan_keluarga_yang_masih_sekolah' => 1,
                'anak_ke' => 2,
            ],[
                'nim' => 210202038,
                'nama_lengkap' => 'Nana Jungler',
                'nik' => '1234567890123412',
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '1995-01-01',
                'jenis_kelamin' => 'Laki-laki',
                'agama' => 'Islam',
                'email' => 'nana@example.com',
                'nohp' => '081234567890',
                'provinsi' => '11',
                'kabupaten' => '11.02',
                'kecamatan' => '11.02.06',
                'desa_kelurahan' => '11.02.06.2002',
                'rt' => '001',
                'rw' => '002',
                'alamat_jalan' => 'Jl. Sudirman No. 123',
                'nama_ayah' => 'Dad Doe',
                'nik_ayah' => '1234567890123456',
                'tempat_lahir_ayah' => 'Jakarta',
                'tanggal_lahir_ayah' => '1965-01-01',
                'pendidikan_ayah' => 'SMA',
                'pekerjaan_ayah' => 'Wiraswasta',
                'penghasilan_ayah' => '5000000',
                'nama_ibu' => 'Mom Doe',
                'nik_ibu' => '1234567890123456',
                'tempat_lahir_ibu' => 'Jakarta',
                'tanggal_lahir_ibu' => '1970-01-01',
                'pendidikan_ibu' => 'SMA',
                'pekerjaan_ibu' => 'Ibu Rumah Tangga',
                'penghasilan_ibu' => '4000000',
                'nama_wali' => 'Guardian Doe',
                'alamat_wali' => 'Jl. Gatot Subroto No. 456',
                'asal_sekolah' => 'SMA Negeri 1 Jakarta',
                'jurusan_asal_sekolah' => 'IPA',
                'pengalaman_organisasi' => 'Anggota OSIS',
                'prodi_id' => 1, // ID Prodi untuk D-3 Teknik Elektronika
                'ukt' => '1500000',
                'jenis_tinggal_di_cilacap' => 'Kost',
                'alat_transportasi_ke_kampus' => 'Motor',
                'sumber_biaya_kuliah' => 'Beasiswa',
                'penerima_kartu_prasejahtera' => 'Ya',
                'jumlah_tanggungan_keluarga_yang_masih_sekolah' => 1,
                'anak_ke' => 2,
            ],[
                'nim' => 210202039,
                'nama_lengkap' => 'Miya Late',
                'nik' => '1234567890123413',
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '1995-01-01',
                'jenis_kelamin' => 'Laki-laki',
                'agama' => 'Islam',
                'email' => 'miya@example.com',
                'nohp' => '081234567890',
                'provinsi' => '11',
                'kabupaten' => '11.02',
                'kecamatan' => '11.02.06',
                'desa_kelurahan' => '11.02.06.2002',
                'rt' => '001',
                'rw' => '002',
                'alamat_jalan' => 'Jl. Sudirman No. 123',
                'nama_ayah' => 'Dad Doe',
                'nik_ayah' => '1234567890123456',
                'tempat_lahir_ayah' => 'Jakarta',
                'tanggal_lahir_ayah' => '1965-01-01',
                'pendidikan_ayah' => 'SMA',
                'pekerjaan_ayah' => 'Wiraswasta',
                'penghasilan_ayah' => '5000000',
                'nama_ibu' => 'Mom Doe',
                'nik_ibu' => '1234567890123456',
                'tempat_lahir_ibu' => 'Jakarta',
                'tanggal_lahir_ibu' => '1970-01-01',
                'pendidikan_ibu' => 'SMA',
                'pekerjaan_ibu' => 'Ibu Rumah Tangga',
                'penghasilan_ibu' => '4000000',
                'nama_wali' => 'Guardian Doe',
                'alamat_wali' => 'Jl. Gatot Subroto No. 456',
                'asal_sekolah' => 'SMA Negeri 1 Jakarta',
                'jurusan_asal_sekolah' => 'IPA',
                'pengalaman_organisasi' => 'Anggota OSIS',
                'prodi_id' => 1, // ID Prodi untuk D-3 Teknik Elektronika
                'ukt' => '1500000',
                'jenis_tinggal_di_cilacap' => 'Kost',
                'alat_transportasi_ke_kampus' => 'Motor',
                'sumber_biaya_kuliah' => 'Beasiswa',
                'penerima_kartu_prasejahtera' => 'Ya',
                'jumlah_tanggungan_keluarga_yang_masih_sekolah' => 1,
                'anak_ke' => 2,
            ],[
                'nim' => 210202040,
                'nama_lengkap' => 'Suhadi',
                'nik' => '1234567890123415',
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '1995-01-01',
                'jenis_kelamin' => 'Laki-laki',
                'agama' => 'Islam',
                'email' => 'suhadi@example.com',
                'nohp' => '081234567890',
                'provinsi' => '11',
                'kabupaten' => '11.02',
                'kecamatan' => '11.02.06',
                'desa_kelurahan' => '11.02.06.2002',
                'rt' => '001',
                'rw' => '002',
                'alamat_jalan' => 'Jl. Sudirman No. 123',
                'nama_ayah' => 'Dad Doe',
                'nik_ayah' => '1234567890123456',
                'tempat_lahir_ayah' => 'Jakarta',
                'tanggal_lahir_ayah' => '1965-01-01',
                'pendidikan_ayah' => 'SMA',
                'pekerjaan_ayah' => 'Wiraswasta',
                'penghasilan_ayah' => '5000000',
                'nama_ibu' => 'Mom Doe',
                'nik_ibu' => '1234567890123456',
                'tempat_lahir_ibu' => 'Jakarta',
                'tanggal_lahir_ibu' => '1970-01-01',
                'pendidikan_ibu' => 'SMA',
                'pekerjaan_ibu' => 'Ibu Rumah Tangga',
                'penghasilan_ibu' => '4000000',
                'nama_wali' => 'Guardian Doe',
                'alamat_wali' => 'Jl. Gatot Subroto No. 456',
                'asal_sekolah' => 'SMA Negeri 1 Jakarta',
                'jurusan_asal_sekolah' => 'IPA',
                'pengalaman_organisasi' => 'Anggota OSIS',
                'prodi_id' => 1, // ID Prodi untuk D-3 Teknik Elektronika
                'ukt' => '1500000',
                'jenis_tinggal_di_cilacap' => 'Kost',
                'alat_transportasi_ke_kampus' => 'Motor',
                'sumber_biaya_kuliah' => 'Beasiswa',
                'penerima_kartu_prasejahtera' => 'Ya',
                'jumlah_tanggungan_keluarga_yang_masih_sekolah' => 1,
                'anak_ke' => 2,
            ]
            
        ];

        foreach ($mahasiswaData as $data) {
            Mahasiswa::create($data);
        }
    }
}