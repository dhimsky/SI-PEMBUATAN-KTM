<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KuliahMhs extends Model
{
    use HasFactory;
    protected $table = 'kuliah_mhs';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nim_id',
        'asal_sekolah',
        'jurusan_asal_sekolah',
        'pengalaman_organisasi',
        'prodi_id',
        'ukt',
        'id_angkatan',
        'jenis_tinggal_di_cilacap',
        'alat_transportasi_ke_kampus',
        'sumber_biaya_kuliah',
        'penerima_kartu_prasejahtera',
        'status_mhs',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim_id', 'nim');
    }
    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id', 'id_prodi');
    }
    public function angkatan()
    {
        return $this->belongsTo(TahunAngkatan::class, 'angkatan_id', 'id_angkatan');
    }
}