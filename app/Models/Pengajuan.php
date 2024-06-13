<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;
    protected $table = 'pengajuan';
    protected $primaryKey = 'id_pengajuan';
    protected $fillable = [
        'id_pengajuan',
        'status',
        'nim_id',
        'nama_lengkap',
        'nik',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama_id',
        'email',
        'nohp',
        'pas_foto',
        'provinsi',
        'kabupaten',
        'kecamatan',
        'desa_kelurahan',
        'rt',
        'rw',
        'nama_jalan',
        'kode_pos',
        'nama_ayah',
        'nik_ayah',
        'nama_ibu',
        'nik_ibu',
        'prodi_id',
        'ukt',
        'angkatan_id',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim_id', 'nim');
    }
    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id', 'id_prodi');
    }
    public function agama()
    {
        return $this->belongsTo(Agama::class, 'agama_id', 'id_agama');
    }
    public function angkatan()
    {
        return $this->belongsTo(TahunAngkatan::class, 'angkatan_id', 'id_angkatan');
    }
}