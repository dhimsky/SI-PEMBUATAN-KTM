<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use Illuminate\Contracts\Encryption\DecryptException;
use PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Crypt;


class PDFController extends Controller
{
    // public function printId(Mahasiswa $mahasiswa)
    // {
    //     $qrCode = QrCode::size(300) // Ukuran QR code (px)
    //                 ->generate($mahasiswa->nim);
    //     $pdf = PDF::loadView('cetak_kartu', ["mahasiswas" => [$mahasiswa],
    //     "qrCode" => $qrCode,]);
    //     $pdf->setPaper('A4', '');
    //     return $pdf->stream($mahasiswa->nama_lengkap . "-" . $mahasiswa->nim.'.pdf');
    // }
    // public function printIdBulk()
    // {
    //     $pdf = PDF::loadView('cetak_kartu', ["mahasiswas" => Mahasiswa::all()]);
    //     $pdf->setPaper('A4', '');
    //     return $pdf->stream('all-diu-student-id.pdf');
    // }
    public function printIdEncrypted($encryptedNim)
{
    try {
        $nim = Crypt::decrypt($encryptedNim); // Mendekripsi NIM
        $mahasiswa = Mahasiswa::where('nim', $nim)->firstOrFail(); // Dapatkan data mahasiswa berdasarkan NIM

        $url = url('/mahasiswa/profile/' . $encryptedNim);
        // Generate QR code
        $qrCode = QrCode::size(300)->generate($url);

        // Load view PDF dengan menyertakan data mahasiswa dan QR code
        $pdf = PDF::loadView('cetak_kartu', [
            "mahasiswas" => [$mahasiswa],
            "qrCode" => $qrCode,
        ]);

        // Set paper size
        $pdf->setPaper('A4', '');

        // Stream PDF sebagai respons
        return $pdf->stream($mahasiswa->nama_lengkap . "-" . $mahasiswa->nim . '.pdf');
    } catch (DecryptException $e) {
        abort(404); // Jika dekripsi gagal, tampilkan halaman 404
    }
}
}