<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agama extends Model
{
    use HasFactory;
    protected $table = 'agama';
    protected $primaryKey = 'id_agama';
    protected $fillable = ['id_agama',
                            'nama_agama'];
    protected $casts = [
        'id_agama' => 'string'
    ];
    public function mahsiswa()
    {
        return $this->hasMany(Mahasiswa::class, 'agama_id', 'id_agama');
    }
}