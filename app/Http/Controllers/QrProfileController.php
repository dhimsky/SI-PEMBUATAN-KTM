<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\TahunAngkatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrProfileController extends Controller
{
    public function index($encryptedNim){
        try {
            $nim = Crypt::decrypt($encryptedNim);
            
            $mahasiswa = Mahasiswa::where('nim', $nim)->firstOrFail();
    
            return view('qrprofile.qrprofile', compact('mahasiswa'));
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            abort(404);
        }
    }
}