<?php

namespace App\Http\Controllers\Mahasiswa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MahasiswaDashboardController extends Controller
{
    public function index () {
        return view('mahasiswa.dashboard.index');
    }
}