<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Prodi;
use App\Models\Wilayah;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WilayahController extends Controller
{
    public function getprovinsi(Request $request)
    {
        $kodeProvinsi = $request->id_provinsi;
        $provinsi = Wilayah::where('kode', 'like', '%' . $kodeProvinsi . '%')
            ->WhereRaw('Length(kode) = 5')
            ->get();
            echo "<option disabled selected value=''>Pilih Kabupaten/Kota</option>";
        foreach ($provinsi as $prov) {
            $namaProv = mb_convert_case($prov->nama, MB_CASE_TITLE);
            echo "<option value='$prov->kode'>$namaProv</option>";
        }
    }

    public function getkabupaten(Request $request)
    {
        $kodekabupaten = $request->id_kabupaten;
        $kabupaten = Wilayah::where('kode', 'like', '%' . $kodekabupaten . '%')
            ->WhereRaw('Length(kode) = 8')
            ->get();
            echo "<option disabled selected value=''>Pilih Kecamatan</option>";
            foreach ($kabupaten as $kab) {
            echo "<option value='$kab->kode'>$kab->nama</option>";
        }
    }

    public function getkecamatan(Request $request)
    {
        $kodekecamatan = $request->id_kecamatan;
        $kecamatan = Wilayah::where('kode', 'like', '%' . $kodekecamatan . '%')
            ->WhereRaw('Length(kode) = 13')
            ->get();
            echo "<option disabled selected value=''>Pilih Desa/Kelurahan</option>";
        foreach ($kecamatan as $kec) {
            echo "<option value='$kec->kode'>$kec->nama</option>";
        }
    }
}