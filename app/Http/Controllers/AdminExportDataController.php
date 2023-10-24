<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\MahasiswaExport;
use Maatwebsite\Excel\Facades\Excel;

class AdminExportDataController extends Controller
{
    public function exportexcel(){
        return Excel::download(new MahasiswaExport, 'data_mahasiswa.xlsx');
    }
}