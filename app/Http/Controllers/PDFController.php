<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use PDF;

class PDFController extends Controller
{
    public function printId(Mahasiswa $mahasiswa)
    {
        $pdf = PDF::loadView('cetak_kartu', ["mahasiswas" => [$mahasiswa]]);
        $pdf->setPaper('A4', '');
        return $pdf->stream($mahasiswa->nama_lengkap . "-" . $mahasiswa->nim.'.pdf');
    }
    public function printIdBulk()
    {
        $pdf = PDF::loadView('cetak_kartu', ["mahasiswas" => Mahasiswa::all()]);
        $pdf->setPaper('A4', '');
        return $pdf->stream('all-diu-student-id.pdf');
    }
}