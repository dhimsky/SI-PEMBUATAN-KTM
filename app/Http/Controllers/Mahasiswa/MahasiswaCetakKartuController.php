<?php

namespace App\Http\Controllers\Mahasiswa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MahasiswaCetakKartuController extends Controller
{
    public function index(){
        return view('cetak_kartu');
    }
}