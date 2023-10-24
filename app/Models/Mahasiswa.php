<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';

    protected $primaryKey = 'nim';

    protected $fillable = [
        'nim',
        'nama_lengkap',
        'nik',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'email',
        'nohp',
        'pas_foto',
        'provinsi',
        'kabupaten',
        'kecamatan',
        'desa_kelurahan',
        'rt',
        'rw',
        'alamat_jalan',
        'nama_ayah',
        'nik_ayah',
        'tempat_lahir_ayah',
        'tanggal_lahir_ayah',
        'pendidikan_ayah',
        'pekerjaan_ayah',
        'penghasilan_ayah',
        'nama_ibu',
        'nik_ibu',
        'tempat_lahir_ibu',
        'tanggal_lahir_ibu',
        'pendidikan_ibu',
        'pekerjaan_ibu',
        'penghasilan_ibu',
        'nama_wali',
        'alamat_wali',
        'asal_sekolah',
        'jurusan_asal_sekolah',
        'pengalaman_organisasi',
        'prodi_id',
        'ukt',
        'jenis_tinggal_di_cilacap',
        'alat_transportasi_ke_kampus',
        'sumber_biaya_kuliah',
        'penerima_kartu_prasejahtera',
        'jumlah_tanggungan_keluarga_yang_masih_sekolah',
        'anak_ke',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'nim', 'nim');
    }
    // Relasi dengan tabel prodi
    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id', 'id_prodi');
    }
}