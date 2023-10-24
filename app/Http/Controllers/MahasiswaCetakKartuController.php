<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MahasiswaCetakKartuController extends Controller
{
    public function index(){
        return view('cetak_kartu');
    }
}