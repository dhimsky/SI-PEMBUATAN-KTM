<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\TahunAngkatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrProfileController extends Controller
{
    public function index($encryptedNim){
        try {
            $nim = Crypt::decrypt($encryptedNim);
            
            $mahasiswa = Mahasiswa::where('nim', $nim)->firstOrFail();

            $kodeprovinsi = $mahasiswa->provinsi;
        $provinsi = DB::table('wilayah')
            ->select('nama')
            ->where('kode', $kodeprovinsi)
            ->get();
        $prov = $provinsi[0]->nama;

        $kodekabupaten = $mahasiswa->kabupaten;
        $kabupaten = DB::table('wilayah')
            ->select('nama')
            ->where('kode', $kodekabupaten)
            ->get();
        $kab = $kabupaten[0]->nama;

        $kodekecamatan = $mahasiswa->kecamatan;
        $kecamatan = DB::table('wilayah')
            ->select('nama')
            ->where('kode', $kodekecamatan)
            ->get();
        $kec = $kecamatan[0]->nama;

        $kodedesa = $mahasiswa->desa_kelurahan;
        $desa_kelurahan = DB::table('wilayah')
            ->select('nama')
            ->where('kode', $kodedesa)
            ->get();
        $ds = $desa_kelurahan[0]->nama;
    
            return view('qrprofile.qrprofile', compact('mahasiswa','ds','kec','kab','prov'));
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            abort(404);
        }
    }
}