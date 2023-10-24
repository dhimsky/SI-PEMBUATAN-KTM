<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kalender extends Model
{
    use HasFactory;
    protected $table = 'kalender';
    protected $primaryKey = 'id_kalender';
    protected $fillable = ['tanggal',
                            'jam',
                            'prodi',
                            'kelas',
                            'detail',
                        ];
}