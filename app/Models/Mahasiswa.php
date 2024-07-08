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
        'agama_id',
        'email',
        'nohp',
        'pas_foto',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'nim', 'nim');
    }
    public function agama()
    {
        return $this->belongsTo(Agama::class, 'agama_id', 'id_agama');
    }
    public function alamat()
    {
        return $this->hasOne(AlamatMhs::class, 'nim_id', 'nim');
    }

    public function keluarga()
    {
        return $this->hasOne(KeluargaMhs::class, 'nim_id', 'nim');
    }

    public function kuliah()
    {
        return $this->hasOne(KuliahMhs::class, 'nim_id', 'nim');
    }
}