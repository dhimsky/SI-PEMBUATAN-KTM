<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlamatMhs extends Model
{
    use HasFactory;
    protected $table = 'alamat_mhs';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nim_id',
        'provinsi',
        'kabupaten',
        'kecamatan',
        'desa_kelurahan',
        'rt',
        'rw',
        'nama_jalan',
        'kode_pos',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim_id', 'nim');
    }
}
