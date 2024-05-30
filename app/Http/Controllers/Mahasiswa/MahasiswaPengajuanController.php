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

class MahasiswaPengajuanController extends Controller
{
    public function index(){
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('nim', $user->nim)->first();
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
        $pengajuan = Pengajuan::where('nim_id', $user->nim)->get();
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
        $mahasiswa = Mahasiswa::where('nim', $user->nim)->first();

        $existingPengajuan = Pengajuan::where('nim_id', $mahasiswa->nim)->exists();

        if ($existingPengajuan) {
            return redirect()->route('pengajuanktm.index')->with('error', 'Anda sudah melakukan pengajuan KTM sebelumnya.');
        }

        $pengajuan = new Pengajuan();

        $pengajuan->nim_id = $mahasiswa->nim;
        $pengajuan->status = 'proses';
        $pengajuan->nama_lengkap = $mahasiswa->nama_lengkap;
        $pengajuan->nik = $mahasiswa->nik;
        $pengajuan->tempat_lahir = $mahasiswa->tempat_lahir;
        $pengajuan->tanggal_lahir = $mahasiswa->tanggal_lahir;
        $pengajuan->jenis_kelamin = $mahasiswa->jenis_kelamin;
        $pengajuan->agama_id = $mahasiswa->agama_id;
        $pengajuan->email = $mahasiswa->email;
        $pengajuan->nohp = $mahasiswa->nohp;
        $pengajuan->pas_foto = $mahasiswa->pas_foto;
        $pengajuan->provinsi = $mahasiswa->provinsi;
        $pengajuan->kabupaten = $mahasiswa->kabupaten;
        $pengajuan->kecamatan = $mahasiswa->kecamatan;
        $pengajuan->rt = $mahasiswa->rt;
        $pengajuan->rw = $mahasiswa->rw;
        $pengajuan->nama_jalan = $mahasiswa->nama_jalan;
        $pengajuan->desa_kelurahan = $mahasiswa->desa_kelurahan;
        $pengajuan->nama_ayah = $mahasiswa->nama_ayah;
        $pengajuan->nik_ayah = $mahasiswa->nik_ayah;
        $pengajuan->tempat_lahir_ayah = $mahasiswa->tempat_lahir_ayah;
        $pengajuan->tanggal_lahir_ayah = $mahasiswa->tanggal_lahir_ayah;
        $pengajuan->pendidikan_ayah = $mahasiswa->pendidikan_ayah;
        $pengajuan->pekerjaan_ayah = $mahasiswa->pekerjaan_ayah;
        $pengajuan->penghasilan_ayah = $mahasiswa->penghasilan_ayah;
        $pengajuan->nama_ibu = $mahasiswa->nama_ibu;
        $pengajuan->nik_ibu = $mahasiswa->nik_ibu;
        $pengajuan->tempat_lahir_ibu = $mahasiswa->tempat_lahir_ibu;
        $pengajuan->tanggal_lahir_ibu = $mahasiswa->tanggal_lahir_ibu;
        $pengajuan->pendidikan_ibu = $mahasiswa->pendidikan_ibu;
        $pengajuan->pekerjaan_ibu = $mahasiswa->pekerjaan_ibu;
        $pengajuan->penghasilan_ibu = $mahasiswa->penghasilan_ibu;
        $pengajuan->nama_wali = $mahasiswa->nama_wali;
        $pengajuan->alamat_wali = $mahasiswa->alamat_wali;
        $pengajuan->asal_sekolah = $mahasiswa->asal_sekolah;
        $pengajuan->jurusan_asal_sekolah = $mahasiswa->jurusan_asal_sekolah;
        $pengajuan->pengalaman_organisasi = $mahasiswa->pengalaman_organisasi;
        $pengajuan->prodi_id = $mahasiswa->prodi_id;
        $pengajuan->ukt = $mahasiswa->ukt;
        $pengajuan->angkatan_id = $mahasiswa->angkatan_id;
        $pengajuan->jenis_tinggal_di_cilacap = $mahasiswa->jenis_tinggal_di_cilacap;
        $pengajuan->alat_transportasi_ke_kampus = $mahasiswa->alat_transportasi_ke_kampus;
        $pengajuan->sumber_biaya_kuliah = $mahasiswa->sumber_biaya_kuliah;
        $pengajuan->penerima_kartu_prasejahtera = $mahasiswa->penerima_kartu_prasejahtera;
        $pengajuan->jumlah_tanggungan_keluarga_yang_masih_sekolah = $mahasiswa->jumlah_tanggungan_keluarga_yang_masih_sekolah;
        $pengajuan->anak_ke = $mahasiswa->anak_ke;
        $pengajuan->status_mhs = $mahasiswa->status_mhs;
        $pengajuan->save();
        activity()->causedBy(Auth::user())->log('Mahasiswa ' . auth()->user()->nim . ' melakukan pengajuan KTM');
        return redirect()->route('pengajuanktm.index')->with('success', 'Berhasil ditambahkan dalam pengajuan.');
    }
    public function destroy($id){
        $pengajuan = Pengajuan::find($id);
        $pengajuan->delete();
        activity()->causedBy(Auth::user())->log('Mahasiswa ' . auth()->user()->nim . ' menghapus pengajuan KTM');
        return redirect()->route('pengajuanktm.index')->with('success', 'Pengajuan berhasil dihapus.');
    }
}