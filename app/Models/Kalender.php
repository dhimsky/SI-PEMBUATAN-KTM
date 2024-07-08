<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kalender extends Model
{
    use HasFactory;
    protected $table = 'kalender';
    protected $primaryKey = 'id_kalender';
    protected $fillable = [
        'tanggal',
        'jam',
        'prodi_id',
        'kelas',
        'detail',
    ];

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id', 'id_prodi');
    }
}