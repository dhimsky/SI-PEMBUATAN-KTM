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
        'nim_id',
        'status',
    ];

    public function nim_id()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim_id', 'nim');
    }
}