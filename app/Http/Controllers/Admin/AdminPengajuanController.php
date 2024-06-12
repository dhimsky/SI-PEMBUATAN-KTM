<?php

namespace App\Http\Controllers\Admin;

use App\Models\Mahasiswa;
use App\Models\Pengajuan;
use App\Models\Prodi;
use App\Models\TahunAngkatan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminPengajuanController extends Controller
{
    public function index(Request $request){
        $pengajuan = Pengajuan::query()->latest();
        $prodi = Prodi::all();
        $angkatan = TahunAngkatan::all();

        if ($request->filled('angkatan_id')) {
            $angkatan_id = $request->input('angkatan_id');
            $pengajuan->where('angkatan_id', $request->angkatan_id);
        }
        if ($request->filled('prodi_id')) {
            $prodi_id = $request->input('prodi_id');
            $pengajuan->where('prodi_id', $request->prodi_id);
        }
        $pengajuan = $pengajuan->get();

        $title = 'Hapus Pengajuan!';
        $text = "Yakin ingin menghapus data ini?";
        confirmDelete($title, $text);

        return view('admin.pengajuan.index', compact('pengajuan','prodi','angkatan'));
    }

    public function store(Request $request){
        $request->validate([
            'nim_id' => 'required|exists:mahasiswa,nim|unique:pengajuan,nim_id',
            'status' => 'required',
        ],[
            'nim_id.unique' => 'NIM sudah melakukan pengajuan!',
            'nim_id.required' => 'NIM wajib diisi!',
            'nim_id.exists' => 'NIM tidak ditemukan dalam tabel Mahasiswa!',
            'status.required' => 'Status wajib diisi!',
        ]);
        $mahasiswa = Mahasiswa::where('nim', $request->input('nim_id'))->first();

        Pengajuan::create([
            'nim_id' => $mahasiswa->nim,
            'status' => $request->input('status'),
            'nama_lengkap' => $mahasiswa->nama_lengkap,
            'nik' => $mahasiswa->nik,
            'tempat_lahir' => $mahasiswa->tempat_lahir,
            'tanggal_lahir' => $mahasiswa->tanggal_lahir,
            'jenis_kelamin' => $mahasiswa->jenis_kelamin,
            'agama_id' => $mahasiswa->agama_id,
            'email' => $mahasiswa->email,
            'nohp' => $mahasiswa->nohp,
            'nama_jalan' => $mahasiswa->nama_jalan,
            'rt' => $mahasiswa->rt,
            'rw' => $mahasiswa->rw,
            'desa_kelurahan' => $mahasiswa->desa_kelurahan,
            'kecamatan' => $mahasiswa->kecamatan,
            'kabupaten' => $mahasiswa->kabupaten,
            'provinsi' => $mahasiswa->provinsi,
            'nama_ayah' => $mahasiswa->nama_ayah,
            'nik_ayah' => $mahasiswa->nik_ayah,
            'tempat_lahir_ayah' => $mahasiswa->tempat_lahir_ayah,
            'tanggal_lahir_ayah' => $mahasiswa->tanggal_lahir_ayah,
            'pendidikan_ayah' => $mahasiswa->pendidikan_ayah,
            'pekerjaan_ayah' => $mahasiswa->pekerjaan_ayah,
            'penghasilan_ayah' => $mahasiswa->penghasilan_ayah,
            'nama_ibu' => $mahasiswa->nama_ibu,
            'nik_ibu' => $mahasiswa->nik_ibu,
            'tempat_lahir_ibu' => $mahasiswa->tempat_lahir_ibu,
            'tanggal_lahir_ibu' => $mahasiswa->tanggal_lahir_ibu,
            'pendidikan_ibu' => $mahasiswa->pendidikan_ibu,
            'pekerjaan_ibu' => $mahasiswa->pekerjaan_ibu,
            'penghasilan_ibu' => $mahasiswa->penghasilan_ibu,
            'nama_wali' => $mahasiswa->nama_wali,
            'alamat_wali' => $mahasiswa->alamat_wali,
            'asal_sekolah' => $mahasiswa->asal_sekolah,
            'jurusan_asal_sekolah' => $mahasiswa->jurusan_asal_sekolah,
            'pengalaman_organisasi' => $mahasiswa->pengalaman_organisasi,
            'prodi_id' => $mahasiswa->prodi_id,
            'ukt' => $mahasiswa->ukt,
            'angkatan_id' => $mahasiswa->angkatan_id,
            'jenis_tinggal_di_cilacap' => $mahasiswa->jenis_tinggal_di_cilacap,
            'alat_transportasi_ke_kampus' => $mahasiswa->alat_transportasi_ke_kampus,
            'sumber_biaya_kuliah' => $mahasiswa->sumber_biaya_kuliah,
            'penerima_kartu_prasejahtera' => $mahasiswa->penerima_kartu_prasejahtera,
            'jumlah_tanggungan_keluarga_yang_masih_sekolah' => $mahasiswa->jumlah_tanggungan_keluarga_yang_masih_sekolah,
            'anak_ke' => $mahasiswa->anak_ke
        ]);
        activity()->causedBy(Auth::user())->log('User ' . auth()->user()->nim . ' menambah pengajuan');
        return redirect()->route('pengajuan.index')->with('success', 'Berhasil ditambahkan dalam pengajuan.');
    }

    public function update(Request $request, $id){
        $request->validate([
            'nim_id' => 'required|exists:mahasiswa,nim',
            'status' => 'required',
        ],[
            'nim_id.required' => 'NIM wajib diisi!',
            'nim_id.exists' => 'NIM tidak ditemukan dalam tabel Mahasiswa!',
            'status.required' => 'Status wajib diisi!',
        ]);

        $pengajuan = Pengajuan::find($id);
        $pengajuan->nim_id = $request->input('nim_id');
        $pengajuan->status = $request->input('status');
        $pengajuan->save();

        activity()->causedBy(Auth::user())->log('User ' . auth()->user()->nim . ' mengubah tabel pengajuan');
        return redirect()->route('pengajuan.index')->with('success', 'Pengajuan berhasil di update.');
    }

    public function updateStatusPengajuan(Request $request)
    {
        $request->validate([
            'angkatan_id' => 'required',
            'prodi_id' => 'required',
            'status' => 'required',
        ], [
            'angkatan_id.required' => 'Pilih angkatan terlebih dahulu.',
            'prodi_id.required' => 'Pilih program studi terlebih dahulu.',
            'status.required' => 'Pilih status pengajuan yang ingin diubah.',
        ]);
        
        // Periksa jika angkatan_id dan prodi_id tidak kosong
        if ($request->filled('angkatan_id') && $request->filled('prodi_id')) {
            $angkatan_id = $request->input('angkatan_id');
            $prodi_id = $request->input('prodi_id');
    
            // Periksa jika status dipilih
            if ($request->filled('status')) {
                $status = $request->input('status');
    
                // Ambil data pengajuan berdasarkan angkatan_id dan prodi_id yang dipilih
                $pengajuan = Pengajuan::where('angkatan_id', $angkatan_id)
                                    ->where('prodi_id', $prodi_id)
                                    ->get();
    
                // Lakukan perubahan status
                foreach ($pengajuan as $mhs) {
                    $mhs->update(['status' => $status]);
                }
                activity()->causedBy(Auth::user())->log('User ' . auth()->user()->nim . ' mengubah status pengajuan');
                return redirect()->route('pengajuan.index')->with('success', 'Status pengajuan berhasil diubah.');
            } else {
                return redirect()->route('pengajuan.index')->with('error', 'Pilih status pengajuan yang ingin diubah.');
            }
        }
    }

    public function destroy($id){
        $pengajuan = Pengajuan::find($id);
        $pengajuan->delete();

        activity()->causedBy(Auth::user())->log('User ' . auth()->user()->nim . ' menghapus pengajuan');
        return redirect()->route('pengajuan.index')->with('success', 'Pengajuan berhasil dihapus.');
    }
}