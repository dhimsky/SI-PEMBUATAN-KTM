<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Storage;
use App\Models\Prodi;
use Illuminate\Support\Facades\DB;

class AdminDataMahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::all();
        $prodi = Prodi::all();

        $title = 'Hapus Mahasiswa!';
        $text = "Yakin ingin menghapus data ini?";
        confirmDelete($title, $text);

        foreach ($mahasiswa as $mhs) {
            $kodeprovinsi = $mhs->provinsi;
            
            $provinsi = DB::table('wilayah')
                ->select('nama')
                ->where('kode', $kodeprovinsi)
                ->first(); // Menggunakan first() karena hanya ingin mengambil satu baris
            $prov = $provinsi->nama; // Mengambil nama provinsi dari objek $provinsi

            $kodekabupaten = $mhs->kabupaten;
            $kabupaten = DB::table('wilayah')
                ->select('nama')
                ->where('kode', $kodekabupaten)
                ->first(); // Menggunakan first() karena hanya ingin mengambil satu baris
            // dd($kabupaten);
            $kab = $kabupaten->nama; // Mengambil nama kabupaten dari objek $kabupaten

            $kodekecamatan = $mhs->kecamatan;
            $kecamatan = DB::table('wilayah')
                ->select('nama')
                ->where('kode', $kodekecamatan)
                ->first(); // Menggunakan first() karena hanya ingin mengambil satu baris
            $kec = $kecamatan->nama; // Mengambil nama kecamatan dari objek $kecamatan

            $kodedesa_kelurahan = $mhs->desa_kelurahan;
            $desa_kelurahan = DB::table('wilayah')
                ->select('nama')
                ->where('kode', $kodedesa_kelurahan)
                ->first(); // Menggunakan first() karena hanya ingin mengambil satu baris
            $ds = $desa_kelurahan->nama; // Mengambil nama desa_kelurahan dari objek $desa_kelurahan
        }
        
        $provinsi = DB::table('wilayah')
                ->orderBy('nama', 'asc')
                ->WhereRaw('LENGTH(kode) = 2')
                ->get();
        return view('admin.mahasiswa.index', compact('kodeprovinsi','provinsi','ds','kec','kab','prov','mahasiswa', 'prodi','provinsi','kabupaten','kecamatan'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_lengkap' => 'required',
            'nik' => 'required|max:16',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'email' => 'required|email',
            'nohp' => 'required',
            'pas_foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'alamat_jalan' => 'required',
            'rt' => 'required|max:3',
            'rw' => 'required|max:3',
            'desa_kelurahan' => 'required',
            'kecamatan' => 'required',
            'kabupaten' => 'required',
            'nama_ayah' => 'required',
            'nik_ayah' => 'nullable|max:16',
            'tempat_lahir_ayah' => 'nullable',
            'tanggal_lahir_ayah' => 'nullable|date',
            'pendidikan_ayah' => 'nullable',
            'pekerjaan_ayah' => 'nullable',
            'penghasilan_ayah' => 'nullable',
            'nama_ibu' => 'required',
            'nik_ibu' => 'nullable|max:16',
            'tempat_lahir_ibu' => 'nullable',
            'tanggal_lahir_ibu' => 'nullable|date',
            'pendidikan_ibu' => 'nullable',
            'pekerjaan_ibu' => 'nullable',
            'penghasilan_ibu' => 'nullable',
            'nama_wali' => 'nullable',
            'alamat_wali' => 'nullable',
            'asal_sekolah' => 'required',
            'jurusan_asal_sekolah' => 'required',
            'pengalaman_organisasi' => 'nullable',
            'prodi_id' => 'required',
            'ukt' => 'required',
            'jenis_tinggal_di_cilacap' => 'required',
            'alat_transportasi_ke_kampus' => 'required',
            'sumber_biaya_kuliah' => 'nullable',
            'penerima_kartu_prasejahtera' => 'required',
            'jumlah_tanggungan_keluarga_yang_masih_sekolah' => 'required|integer',
            'anak_ke' => 'required|integer',
        ],[
            'nama_lengkap' =>'Nama tidak boleh kosong!',
            'nik.required' => 'NIK tidak boleh kosong!',
            'nik.max' => 'NIK maksimal 16 karakter!',
            'nik.unique' => 'NIK sudah terdaftar!',
            'tempat_lahir.required' => 'Tempat lahir tidak boleh kosong!',
            'tanggal_lahir.required' => 'Tanggal lahir tidak boleh kosong!',
            'tanggal_lahir.date' => 'Gunakan format tanggal yang benar!',
            'jenis_kelamin.required' => 'Jenis kelamin tidak boleh kosong!',
            'agama.required' => 'Agama tidak boleh kosong!',
            'email.required' => 'Email tidak boleh kosong!',
            'email.email' => 'Gunakan format email yang benar!',
            'email.unique' => 'Email sudah terdaftar!',
            'nohp.required' => 'No.HP tidak boleh kosong!',
            'pas_foto.required' => 'Pas foto tidak boleh kosong!',
            'pas_foto.image' => 'Pas foto wajib image!',
            'pas_foto.mimes' => 'Format foto harus .jpg/.jpeg/.png!',
            'pas_foto.max' => 'Maksimal foto 2048 Kb!',

            'provinsi.required' => 'Provinsi tidak boleh kosong!',
            'kabupaten.required' => 'Kabupaten tidak boleh kosong!',
            'kecamatan.required' => 'Kecamatan tidak boleh kosong!',
            'rt.required' => 'RT tidak boleh kosong!',
            'rt.max' => 'RT maksimal 3 karakter!',
            'rw.required' => 'RW tidak boleh kosong!',
            'rw.max' => 'RW maksimal 3 karakter!',
            'alamat_jalan' => 'Jalan tidak boleh kosong!',

            'nama_ayah.required' => 'Nama ayah tidak boleh kosong!',
            'nama_ibu.required' => 'Nama ibu tidak boleh kosong!',

            'asal_sekolah.required' => 'Asal sekolah tidak boleh kosong!',
            'jurusan_asal_sekolah' => 'Jurusan asal tidak boleh kosong!',

            'prodi_id.required' => 'Prodi tidak boleh kosong!',
            'ukt.required' => 'UKT tidak boleh kosong!',
            'jenis_tinggal_di_cilacap.required' => 'Tempat tinggal tidak boleh kosong!',
            'alat_transportasi_ke_kampus.required' => 'Transportasi tidak boleh kosong',
            'penerima_kartu_prasejahtera.required' => 'Penerima kartu tidak boleh kosong!',

            'jumlah_tanggungan_keluarga_yang_masih_sekolah.required' => 'Jumlah tanggungan tidak boleh kosong!',
            'anak_ke.required' => 'Anak ke berapa tidak boleh kosong!',
        ]);

        // Cari data mahasiswa berdasarkan ID
        $mahasiswa = Mahasiswa::findOrFail($id);

        // Simpan data yang diupdate ke dalam variabel
        $mahasiswa->nim = $request->input('nim');
        $mahasiswa->nama_lengkap = $request->input('nama_lengkap');
        $mahasiswa->nik = $request->input('nik');
        $mahasiswa->tempat_lahir = $request->input('tempat_lahir');
        $mahasiswa->tanggal_lahir = $request->input('tanggal_lahir');
        $mahasiswa->jenis_kelamin = $request->input('jenis_kelamin');
        $mahasiswa->agama = $request->input('agama');
        $mahasiswa->email = $request->input('email');
        $mahasiswa->nohp = $request->input('nohp');
        $mahasiswa->provinsi = $request->input('provinsi');
        $mahasiswa->kabupaten = $request->input('kabupaten');
        $mahasiswa->kecamatan = $request->input('kecamatan');
        $mahasiswa->rt = $request->input('rt');
        $mahasiswa->rw = $request->input('rw');
        $mahasiswa->alamat_jalan = $request->input('alamat_jalan');
        $mahasiswa->desa_kelurahan = $request->input('desa_kelurahan');
        $mahasiswa->nama_ayah = $request->input('nama_ayah');
        $mahasiswa->nik_ayah = $request->input('nik_ayah');
        $mahasiswa->tempat_lahir_ayah = $request->input('tempat_lahir_ayah');
        $mahasiswa->tanggal_lahir_ayah = $request->input('tanggal_lahir_ayah');
        $mahasiswa->pendidikan_ayah = $request->input('pendidikan_ayah');
        $mahasiswa->pekerjaan_ayah = $request->input('pekerjaan_ayah');
        $mahasiswa->penghasilan_ayah = $request->input('penghasilan_ayah');
        $mahasiswa->nama_ibu = $request->input('nama_ibu');
        $mahasiswa->nik_ibu = $request->input('nik_ibu');
        $mahasiswa->tempat_lahir_ibu = $request->input('tempat_lahir_ibu');
        $mahasiswa->tanggal_lahir_ibu = $request->input('tanggal_lahir_ibu');
        $mahasiswa->pendidikan_ibu = $request->input('pendidikan_ibu');
        $mahasiswa->pekerjaan_ibu = $request->input('pekerjaan_ibu');
        $mahasiswa->penghasilan_ibu = $request->input('penghasilan_ibu');
        $mahasiswa->nama_wali = $request->input('nama_wali');
        $mahasiswa->alamat_wali = $request->input('alamat_wali');
        $mahasiswa->asal_sekolah = $request->input('asal_sekolah');
        $mahasiswa->jurusan_asal_sekolah = $request->input('jurusan_asal_sekolah');
        $mahasiswa->pengalaman_organisasi = $request->input('pengalaman_organisasi');
        $mahasiswa->prodi_id = $request->input('prodi_id');
        $mahasiswa->ukt = $request->input('ukt');
        $mahasiswa->jenis_tinggal_di_cilacap = $request->input('jenis_tinggal_di_cilacap');
        $mahasiswa->alat_transportasi_ke_kampus = $request->input('alat_transportasi_ke_kampus');
        $mahasiswa->sumber_biaya_kuliah = $request->input('sumber_biaya_kuliah');
        $mahasiswa->penerima_kartu_prasejahtera = $request->input('penerima_kartu_prasejahtera');
        $mahasiswa->jumlah_tanggungan_keluarga_yang_masih_sekolah = $request->input('jumlah_tanggungan_keluarga_yang_masih_sekolah');
        $mahasiswa->anak_ke = $request->input('anak_ke');

        // Cek apakah ada foto baru yang diunggah
        if ($request->hasFile('pas_foto')) {
            // Hapus foto lama jika ada
            if ($mahasiswa->pas_foto) {
                Storage::delete('public/pas_foto/' . $mahasiswa->pas_foto);
            }

            // Upload foto baru dengan nama file sesuai NIM
            $file = $request->file('pas_foto');
            $fileName = $mahasiswa->nim  . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/pas_foto', $fileName);

            // Simpan nama foto ke dalam database
            $mahasiswa->pas_foto = $fileName;
        }

        // Simpan data mahasiswa yang sudah diupdate
        $mahasiswa->save();

        // Redirect ke halaman tampilan data mahasiswa
        return redirect()->route('data-mahasiswa.index')->with('success', 'Data mahasiswa berhasil diupdate.');
    }
    
    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::find($id);
        $mahasiswa->delete();

        return redirect()->route('data-mahasiswa.index')->with('success', 'Mahasiswa berhasil di Hapus');
    }
}