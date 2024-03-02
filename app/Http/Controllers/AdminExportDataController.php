<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\MahasiswaExport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class AdminExportDataController extends Controller
{
    public function exportexcel(){
        $timestamp = Carbon::now()->format('dmY_His');
        return Excel::download(new MahasiswaExport, 'data_mahasiswa_' . $timestamp . '.xlsx');
    }
}