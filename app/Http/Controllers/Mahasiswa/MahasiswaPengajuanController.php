<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Models\Agama;
use App\Models\Mahasiswa;
use App\Models\Pengajuan;
use App\Models\Prodi;
use App\Models\TahunAngkatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

class MahasiswaPengajuanController extends Controller
{
    public function index(){
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('nim', $user->no_identitas)->first();
        if (!$mahasiswa) {
            return redirect()->route('isi-data')->with('info', 'Data anda belum lengkap!, silahkan lengkapi data anda terlebih dahulu.');
        }
        if ($mahasiswa->status_mhs === 'Tidak aktif') {
            return redirect()->route('home')->with('info', 'Anda tidak lagi sebagai mahasiswa.');
        }
        $title = 'Hapus Pengajuan!';
        $text = "Yakin ingin menghapus data ini?";
        confirmDelete($title, $text);

        $user = Auth::user();
        $pengajuan = Pengajuan::where('nim_id', $user->no_identitas)->get();
        $agama = Agama::all();
        $prodi = Prodi::all();
        $angkatan = TahunAngkatan::all();

        $kodeprovinsi = null;
        $kodekabupaten = null;
        $kodekecamatan = null;
        $kodedesa_kelurahan = null;
        $prov = null;
        $kab = null;
        $kec = null;
        $ds = null;
        $kabupaten = null;
        $kecamatan = null;
        
        foreach ($pengajuan as $p) {
            $kodeprovinsi = $p->provinsi;
            
            $provinsi = DB::table('wilayah')
                ->select('nama')
                ->where('kode', $kodeprovinsi)
                ->first();
            $prov = $provinsi->nama;

            $kodekabupaten = $p->kabupaten;
            $kabupaten = DB::table('wilayah')
                ->select('nama')
                ->where('kode', $kodekabupaten)
                ->first();
            $kab = $kabupaten->nama;

            $kodekecamatan = $p->kecamatan;
            $kecamatan = DB::table('wilayah')
                ->select('nama')
                ->where('kode', $kodekecamatan)
                ->first();
            $kec = $kecamatan->nama;

            $kodedesa_kelurahan = $p->desa_kelurahan;
            $desa_kelurahan = DB::table('wilayah')
                ->select('nama')
                ->where('kode', $kodedesa_kelurahan)
                ->first();
            $ds = $desa_kelurahan->nama;
        }
        $provinsi = DB::table('wilayah')
                ->orderBy('nama', 'asc')
                ->WhereRaw('LENGTH(kode) = 2')
                ->get();
        return view('mahasiswa.pengajuan.index', compact('pengajuan','agama','prodi','angkatan','kodeprovinsi','provinsi','ds','kec','kab','prov','provinsi','kabupaten','kecamatan'));
    }
    public function store(){
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('nim', $user->no_identitas)->first();

        $existingPengajuan = Pengajuan::where('nim_id', $mahasiswa->nim)->count();

        if ($existingPengajuan >= 2) {
            return redirect()->route('pengajuanktm.index', ['nim' => Crypt::encryptString(Auth::user()->no_identitas)])->with('error', 'Anda sudah melakukan pengajuan KTM maksimal 2 kali.');
        }

        $pengajuan = new Pengajuan();

        $pengajuan->nim_id = $mahasiswa->nim;
        $pengajuan->status = 'pembuatan ulang';
        $pengajuan->nama_lengkap = $mahasiswa->nama_lengkap;
        $pengajuan->nik = $mahasiswa->nik;
        $pengajuan->tempat_lahir = $mahasiswa->tempat_lahir;
        $pengajuan->tanggal_lahir = $mahasiswa->tanggal_lahir;
        $pengajuan->jenis_kelamin = $mahasiswa->jenis_kelamin;
        $pengajuan->agama_id = $mahasiswa->agama_id;
        $pengajuan->email = $mahasiswa->email;
        $pengajuan->nohp = $mahasiswa->nohp;
        $pengajuan->pas_foto = $mahasiswa->pas_foto;

        $pengajuan->provinsi = $mahasiswa->alamat->provinsi;
        $pengajuan->kabupaten = $mahasiswa->alamat->kabupaten;
        $pengajuan->kecamatan = $mahasiswa->alamat->kecamatan;
        $pengajuan->rt = $mahasiswa->alamat->rt;
        $pengajuan->rw = $mahasiswa->alamat->rw;
        $pengajuan->nama_jalan = $mahasiswa->alamat->nama_jalan;
        $pengajuan->desa_kelurahan = $mahasiswa->alamat->desa_kelurahan;
        $pengajuan->kode_pos = $mahasiswa->alamat->kode_pos;

        $pengajuan->nama_ayah = $mahasiswa->keluarga->nama_ayah;
        $pengajuan->nama_ibu = $mahasiswa->keluarga->nama_ibu;

        $pengajuan->prodi_id = $mahasiswa->kuliah->prodi_id;
        $pengajuan->ukt = $mahasiswa->kuliah->ukt;
        $pengajuan->angkatan_id = $mahasiswa->kuliah->angkatan_id;
        $pengajuan->save();
        activity()->causedBy(Auth::user())->log('Mahasiswa ' . auth()->user()->no_identitas . ' melakukan pengajuan KTM');
        return redirect()->route('pengajuanktm.index', ['nim' => Crypt::encryptString(Auth::user()->no_identitas)])->with('success', 'Berhasil ditambahkan dalam pengajuan.');
    }

    public function terimaKTM(Request $request){
        // Validasi input
        $request->validate([
            'id_pengajuan' => 'exists:pengajuan,id_pengajuan',
        ]);

        // Temukan pengajuan berdasarkan ID
        $pengajuan = Pengajuan::findOrFail($request->id_pengajuan);

        // Update field status menjadi 'selesai'
        $pengajuan->status = 'selesai';
        $pengajuan->save();

        return redirect()->route('pengajuanktm.index', ['nim' => Crypt::encryptString(Auth::user()->no_identitas)])->with('success', 'Berhasil diperbarui.');
    }

    public function destroy($nim){
        $pengajuan = Pengajuan::find($nim);
        $pengajuan->delete();
        activity()->causedBy(Auth::user())->log('Mahasiswa ' . auth()->user()->no_identitas . ' menghapus pengajuan KTM');
        return redirect()->route('pengajuanktm.index', ['nim' => Crypt::encryptString(Auth::user()->no_identitas)])->with('success', 'Pengajuan berhasil dihapus.');
    }
}