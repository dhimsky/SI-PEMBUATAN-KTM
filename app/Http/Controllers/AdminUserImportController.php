<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\UserImport;

class AdminUserImportController extends Controller
{
    public function import(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|file|mimes:xlsx,xls',
        ],[
            'excel_file.required' => 'Anda belum memilih file!',
            'excel_file.mimes' => 'File harus berformat XLSX atau XLS!',
        ]);

        // Impor file Excel
        $file = $request->file('excel_file');
        Excel::import(new UserImport(), $file);
        return redirect()->back()->with('success', 'Data berhasil diimpor.');
    }
}