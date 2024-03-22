<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\MahasiswaExport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use App\Exports\MahasiswaImagesExport;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class AdminExportDataController extends Controller
{
    public function exportexcel(Request $request){
        $prodiId = $request->input('prodi_id');
        $tahunAngkatan = $request->input('tahun_angkatan');

        $timestamp = Carbon::now()->format('dmY_His');

        if ($prodiId && $tahunAngkatan) {
            $exportFileName = 'data_mahasiswa_prodi_' . $prodiId . '_tahun_angkatan_' . $tahunAngkatan . '_' . $timestamp . '.xlsx';
            return Excel::download(new MahasiswaExport($prodiId, $tahunAngkatan), $exportFileName);
        } elseif ($prodiId) {
            $exportFileName = 'data_mahasiswa_prodi_' . $prodiId . '_' . $timestamp . '.xlsx';
            return Excel::download(new MahasiswaExport($prodiId), $exportFileName);
        } elseif ($tahunAngkatan) {
            $exportFileName = 'data_mahasiswa_tahun_angkatan_' . $tahunAngkatan . '_' . $timestamp . '.xlsx';
            return Excel::download(new MahasiswaExport(null, $tahunAngkatan), $exportFileName);
        } else {
            $exportFileName = 'data_mahasiswa_' . $timestamp . '.xlsx';
            return Excel::download(new MahasiswaExport(), $exportFileName);
        }
    }

    public function exportimg(Request $request)
    {
        $prodiId = $request->prodi_id ?? null;
        $tahunAngkatan = $request->tahun_angkatan ?? null;

        $export = new MahasiswaImagesExport($prodiId, $tahunAngkatan);
        $zipFilePath = $export->export();

        if (file_exists($zipFilePath)) {
            $fileName = 'mahasiswa_images_' . now()->format('Y-m-d_H-i-s');
            if ($prodiId) {
                $fileName .= '_prodi_' . $prodiId;
            }
            if ($tahunAngkatan) {
                $fileName .= '_angkatan_' . $tahunAngkatan;
            }
            $fileName .= '.zip';
            return response()->download($zipFilePath, $fileName)->deleteFileAfterSend(true);
        } else {
            return back()->with('error','Foto tidak ditemukan berdasarkan filter.');
        }
    }
}