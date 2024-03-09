<?php

namespace App\Http\Controllers;

use App\Models\Agama;
use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Prodi;
use App\Models\TahunAngkatan;
use App\Models\Wilayah;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MahasiswaDetailController extends Controller
{
    public function detail($nim)
    {
        $prodi = Prodi::all();
        $agama = Agama::all();
        $angkatan = TahunAngkatan::all();
        $mahasiswa = Mahasiswa::where('nim', $nim)->first();

        if (!$mahasiswa) {
            return redirect()->route('isi-data')->with('info', 'Data anda belum lengkap!, silahkan lengkapi data anda terlebih dahulu.');
        }

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

        $provinsi = DB::table('wilayah')
                ->orderBy('nama', 'asc')
                ->WhereRaw('LENGTH(kode) = 2')
                ->get();
        return view('mahasiswa.isi_data.detail', compact('agama','angkatan','ds','kec','kab','prov','mahasiswa','prodi','provinsi'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nik' => 'required|string|max:16',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string',
            'agama_id' => 'required|string',
            'email' => 'required|email',
            'nohp' => 'required|string',
            'pas_foto' => 'image|mimes:jpeg,png,jpg|max:2048',
            'provinsi' =>'required|string',
            'kabupaten' => 'required|string',
            'kecamatan' => 'required|string',
            'desa_kelurahan' => 'required|string',
            'rt' => 'required|string|max:3',
            'rw' => 'required|string|max:3',
            'alamat_jalan' => 'required|string',
            'nama_ayah' => 'required|string',
            'nik_ayah' => 'nullable|string|max:16',
            'tempat_lahir_ayah' => 'nullable|string',
            'tanggal_lahir_ayah' => 'nullable|date',
            'pendidikan_ayah' => 'nullable|string',
            'pekerjaan_ayah' => 'nullable|string',
            'penghasilan_ayah' => 'nullable|string',
            'nama_ibu' => 'required|string',
            'nik_ibu' => 'nullable|string|max:16',
            'tempat_lahir_ibu' => 'nullable|string',
            'tanggal_lahir_ibu' => 'nullable|date',
            'pendidikan_ibu' => 'nullable|string',
            'pekerjaan_ibu' => 'nullable|string',
            'penghasilan_ibu' => 'nullable|string',
            'nama_wali' => 'nullable|string',
            'alamat_wali' => 'nullable|string',
            'asal_sekolah' => 'required|string',
            'jurusan_asal_sekolah' => 'required|string',
            'pengalaman_organisasi' => 'nullable|string',
            'prodi_id' => 'required|string',
            'ukt' => 'required|string',
            'angkatan_id' => 'required|string',
            'jenis_tinggal_di_cilacap' => 'required|string',
            'alat_transportasi_ke_kampus' => 'required|string',
            'sumber_biaya_kuliah' => 'nullable|string',
            'penerima_kartu_prasejahtera' => 'required|string',
            'jumlah_tanggungan_keluarga_yang_masih_sekolah' => 'required|integer',
            'anak_ke' => 'required|integer',
        ],[
            'nik.required' => 'NIK wajib di isi!',
            'nik.max' => 'NIK maksimal 16 karakter',
            'tempat_lahir.required' => 'Tempat lahir wajib di isi!',
            'tanggal_lahir.required' => 'Tanggal lahir wajib di isi!',
            'jenis_kelamin.required' => 'Jenis kelamin wajib di isi!',
            'agama_id.required' => 'Agama wajib di isi!',
            'email.required' => 'Email wajib di isi!',
            'email.email' => 'Gunakan format email!',
            'nohp.required' => 'No.HP wajib di isi!',
            'pas_foto.image' => 'Pas foto wajib image!',
            'pas_foto.mimes' => 'Format foto harus .jpg/.jpeg/.png!',
            'pas_foto.max' => 'Maksimal foto 2048 Kb!',
            'provinsi.required' =>'Provinsi wajib di isi!',
            'kabupaten.required' => 'Kabupaten wajib di isi!',
            'kecamatan.required' => 'Kecamatan wajib di isi!',
            'desa_kelurahan.required' => 'Desa/ Kelurahan wajib di isi!',
            'rt.required' => 'RT wajib di isi!',
            'rt.max' => 'RT maksimal 3  karakter!',
            'rw.required' => 'RW wajib di isi!',
            'rw.max' => 'RW maksimal 3  karakter!',
            'alamat_jalan.required' => 'Jalan wajib di isi!',
            'nama_ayah.required' => 'Nama ayah wajib di isi!',
            'nik_ayah.max' => 'NIK ayah maksimal 16 karakter!',
            'nama_ibu.required' => 'Nama ibu wajib di isi!',
            'nik_ibu.max' => 'NIK ibu maksimal 16 karakter!',
            'asal_sekolah.required' => 'Asal sekolah wajib di isi!',
            'jurusan_asal_sekolah.required' => 'Jurusan wajib di isi!',
            'prodi_id.required' => 'Program studi wajib di isi!',
            'ukt.required' => 'UKT wajib di isi!',
            'angkatan_id.required' => 'Tahun Angkatan wajib di isi!',
            'jenis_tinggal_di_cilacap.required' => 'Jenis tinggal wajib di isi!',
            'alat_transportasi_ke_kampus.required' => 'Alat transportasi wajib di isi!',
            'penerima_kartu_prasejahtera.required' => 'Penerima kartu prasejahtera wajib di isi!',
            'jumlah_tanggungan_keluarga_yang_masih_sekolah.required' => 'Jumlah tanggungan wajib di isi!',
            'anak_ke.required' => 'Anak ke berapa wajib di isi!',
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
        $mahasiswa->agama_id = $request->input('agama_id');
        $mahasiswa->email = $request->input('email');
        $mahasiswa->nohp = $request->input('nohp');
        $mahasiswa->provinsi = $request->input('provinsi');
        $mahasiswa->kabupaten = $request->input('kabupaten');
        $mahasiswa->kecamatan = $request->input('kecamatan');
        $mahasiswa->desa_kelurahan = $request->input('desa_kelurahan');
        $mahasiswa->rt = $request->input('rt');
        $mahasiswa->rw = $request->input('rw');
        $mahasiswa->alamat_jalan = $request->input('alamat_jalan');
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
        $mahasiswa->angkatan_id = $request->input('angkatan_id');
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
        return redirect()->route('mahasiswa.detail',['nim' => Auth::user()->nim])->with('success', 'Data mahasiswa berhasil diupdate.');
    }
}