<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Prodi;

class Jurusan extends Model
{
    use HasFactory;
    protected $table = 'jurusan';
    protected $primaryKey = 'id_jurusan';
    protected $fillable = ['nama_jurusan'];

    public function prodi()
    {
        return $this->hasMany(Prodi::class, 'jurusan_id', 'id_jurusan');
    }
}