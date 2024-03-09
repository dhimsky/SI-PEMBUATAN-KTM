<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunAngkatan extends Model
{
    use HasFactory;
    protected $table = 'tahunangkatan';
    protected $primaryKey = 'id_angkatan';
    protected $fillable = ['id_angkatan',
                            'tahun_angkatan'
    ];
    protected $cast = [
        'id_angkatan' => 'string'
    ];

    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class, 'angkatan_id', 'id_angkatan');
    }
}