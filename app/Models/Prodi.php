<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Jurusan;

class Prodi extends Model
{
    use HasFactory;
    protected $table = 'prodi';
    protected $primaryKey = 'id_prodi';
    protected $fillable = ['id_prodi',
                            'jurusan_id',
                            'nama_prodi',
                            'jenjang'];
    protected $casts = [
        'id_prodi' => 'string'
    ];
    // Relasi dengan tabel mahasiswa
    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class, 'prodi_id', 'id_prodi');
    }
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'jurusan_id', 'id_jurusan');
    }
}