<?php

namespace App\Http\Controllers\Admin;

use App\Models\Agama;
use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Storage;
use App\Models\Prodi;
use App\Models\TahunAngkatan;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminDataMahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $mahasiswa = Mahasiswa::query()->latest();
        $agama = Agama::all();
        $prodi = Prodi::all();
        $angkatan = TahunAngkatan::all();

        if ($request->filled('angkatan_id')) {
            $angkatan_id = $request->input('angkatan_id');
            $mahasiswa->where('angkatan_id', $request->angkatan_id);
        }
        if ($request->filled('prodi_id')) {
            $prodi_id = $request->input('prodi_id');
            $mahasiswa->where('prodi_id', $request->prodi_id);
        }
        $mahasiswa = $mahasiswa->get();

        $title = 'Hapus Mahasiswa!';
        $text = "Yakin ingin menghapus data ini?";
        confirmDelete($title, $text);

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
        
        foreach ($mahasiswa as $m) {
            $kodeprovinsi = $m->provinsi;
            $provinsi = DB::table('wilayah')
                ->select('nama')
                ->where('kode', $kodeprovinsi)
                ->first(); // Menggunakan first() karena hanya ingin mengambil satu baris
            $prov = $provinsi->nama; // Mengambil nama provinsi dari objek $provinsi
            // dd($prov);
            $kodekabupaten = $m->kabupaten;
            $kabupaten = DB::table('wilayah')
                ->select('nama')
                ->where('kode', $kodekabupaten)
                ->first(); // Menggunakan first() karena hanya ingin mengambil satu baris
            // dd($kabupaten);
            $kab = $kabupaten->nama; // Mengambil nama kabupaten dari objek $kabupaten

            $kodekecamatan = $m->kecamatan;
            $kecamatan = DB::table('wilayah')
                ->select('nama')
                ->where('kode', $kodekecamatan)
                ->first(); // Menggunakan first() karena hanya ingin mengambil satu baris
            $kec = $kecamatan->nama; // Mengambil nama kecamatan dari objek $kecamatan

            $kodedesa_kelurahan = $m->desa_kelurahan;
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
        
        return view('admin.mahasiswa.index', compact('angkatan','agama','kodeprovinsi','provinsi','ds','kec','kab','prov','mahasiswa', 'prodi','provinsi','kabupaten','kecamatan'));
    }
    
    public function store(Request $request){
        $request->validate([
            'nim' => 'required|unique:mahasiswa,nim',
            'nama_lengkap' => 'required',
            'nik' => 'required|max:16',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'agama_id' => 'required',
            'email' => 'required|email|regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/',
            'nohp' => 'required',
            'pas_foto' => 'image|mimes:jpeg,png,jpg|max:2048',
            'provinsi' => 'required',
            'kecamatan' => 'required',
            'kabupaten' => 'required',
            'desa_kelurahan' => 'required',
            'alamat_jalan' => 'required',
            'rt' => 'required|max:3',
            'rw' => 'required|max:3',
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
            'angkatan_id' => 'required',
            'jenis_tinggal_di_cilacap' => 'required',
            'alat_transportasi_ke_kampus' => 'required',
            'sumber_biaya_kuliah' => 'nullable',
            'penerima_kartu_prasejahtera' => 'required',
            'jumlah_tanggungan_keluarga_yang_masih_sekolah' => 'required|integer',
            'anak_ke' => 'required|integer',
        ],[
            'nim.required' => 'Nama wajib diisi!',
            'nim.unique' =>'NIM sudah terdaftar!',
            'nama_lengkap' =>'Nama tidak boleh kosong!',
            'nik.required' => 'NIK tidak boleh kosong!',
            'nik.max' => 'NIK maksimal 16 karakter!',
            'nik.unique' => 'NIK sudah terdaftar!',
            'tempat_lahir.required' => 'Tempat lahir tidak boleh kosong!',
            'tanggal_lahir.required' => 'Tanggal lahir tidak boleh kosong!',
            'tanggal_lahir.date' => 'Gunakan format tanggal yang benar!',
            'jenis_kelamin.required' => 'Jenis kelamin tidak boleh kosong!',
            'agama_id.required' => 'Agama tidak boleh kosong!',
            'email.required' => 'Email tidak boleh kosong!',
            'email.email' => 'Gunakan format email yang benar!',
            'email.unique' => 'Email sudah terdaftar!',
            'email.regex' => 'Gunakan format email yang benar!',
            'nohp.required' => 'No.HP tidak boleh kosong!',
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
            'angkatan_id' => 'Tahun angkatan tidak boleh kosong!',
            'jenis_tinggal_di_cilacap.required' => 'Tempat tinggal tidak boleh kosong!',
            'alat_transportasi_ke_kampus.required' => 'Transportasi tidak boleh kosong',
            'penerima_kartu_prasejahtera.required' => 'Penerima kartu tidak boleh kosong!',

            'jumlah_tanggungan_keluarga_yang_masih_sekolah.required' => 'Jumlah tanggungan tidak boleh kosong!',
            'anak_ke.required' => 'Anak ke berapa tidak boleh kosong!',
        ]);

        $user = new User;
        $user->nim = $request->input('nim');
        $user->username = $request->input('nama_lengkap');
        $user->password = Hash::make('abcd1234');
        $user->role_id = 2;
        $user->save();

        $mahasiswa = new Mahasiswa;
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
        $mahasiswa->angkatan_id = $request->input('angkatan_id');
        $mahasiswa->jenis_tinggal_di_cilacap = $request->input('jenis_tinggal_di_cilacap');
        $mahasiswa->alat_transportasi_ke_kampus = $request->input('alat_transportasi_ke_kampus');
        $mahasiswa->sumber_biaya_kuliah = $request->input('sumber_biaya_kuliah');
        $mahasiswa->penerima_kartu_prasejahtera = $request->input('penerima_kartu_prasejahtera');
        $mahasiswa->jumlah_tanggungan_keluarga_yang_masih_sekolah = $request->input('jumlah_tanggungan_keluarga_yang_masih_sekolah');
        $mahasiswa->anak_ke = $request->input('anak_ke');
        $mahasiswa->status_mhs = 'Aktif';
        
        if ($request->hasFile('pas_foto')) {
            // if ($mahasiswa->pas_foto) {
            //     Storage::delete('public/pas_foto/' . $mahasiswa->pas_foto);
            // }
            $file = $request->file('pas_foto');
            $fileName = $mahasiswa->nim  . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/pas_foto', $fileName);
            $mahasiswa->pas_foto = $fileName;
        }
        $mahasiswa->save();
        activity()->causedBy(Auth::user())->log('User ' . auth()->user()->nim . ' menambah mahasiswa');

        return redirect()->route('data-mahasiswa.index')->with('success', 'Data mahasiswa berhasil ditambahkan.');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_lengkap' => 'required',
            'nik' => 'required|max:16',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'agama_id' => 'required',
            'email' => 'required|email|regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/',
            'nohp' => 'required',
            'pas_foto' => 'image|mimes:jpeg,png,jpg|max:2048',
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
            'angkatan_id' => 'required',
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
            'agama_id.required' => 'Agama tidak boleh kosong!',
            'email.required' => 'Email tidak boleh kosong!',
            'email.email' => 'Gunakan format email yang benar!',
            'email.unique' => 'Email sudah terdaftar!',
            'email.regex' => 'Gunakan format email yang benar!',
            'nohp.required' => 'No.HP tidak boleh kosong!',
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
            'angkatan_id' => 'Tahun angkatan tidak boleh kosong!',
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
        $mahasiswa->agama_id = $request->input('agama_id');
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
        $mahasiswa->angkatan_id = $request->input('angkatan_id');
        $mahasiswa->jenis_tinggal_di_cilacap = $request->input('jenis_tinggal_di_cilacap');
        $mahasiswa->alat_transportasi_ke_kampus = $request->input('alat_transportasi_ke_kampus');
        $mahasiswa->sumber_biaya_kuliah = $request->input('sumber_biaya_kuliah');
        $mahasiswa->penerima_kartu_prasejahtera = $request->input('penerima_kartu_prasejahtera');
        $mahasiswa->jumlah_tanggungan_keluarga_yang_masih_sekolah = $request->input('jumlah_tanggungan_keluarga_yang_masih_sekolah');
        $mahasiswa->anak_ke = $request->input('anak_ke');
        $mahasiswa->status_mhs = $request->input('status_mhs');

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
        $mahasiswa->save();
        activity()->causedBy(Auth::user())->log('User ' . auth()->user()->nim . ' mengubah tabel mahasiswa');

        return redirect()->route('data-mahasiswa.index')->with('success', 'Data mahasiswa berhasil diupdate.');
    }

    public function updateStatusMhs(Request $request)
    {
        $request->validate([
            'angkatan_id' => 'required',
            'prodi_id' => 'required',
            'status_mhs' => 'required',
        ], [
            'angkatan_id.required' => 'Pilih angkatan terlebih dahulu.',
            'prodi_id.required' => 'Pilih program studi terlebih dahulu.',
            'status_mhs.required' => 'Pilih status mahasiswa yang ingin diubah.',
        ]);
        
        // Periksa jika angkatan_id dan prodi_id tidak kosong
        if ($request->filled('angkatan_id') && $request->filled('prodi_id')) {
            $angkatan_id = $request->input('angkatan_id');
            $prodi_id = $request->input('prodi_id');
    
            // Periksa jika status_mhs dipilih
            if ($request->filled('status_mhs')) {
                $status_mhs = $request->input('status_mhs');
    
                // Ambil data mahasiswa berdasarkan angkatan_id dan prodi_id yang dipilih
                $mahasiswa = Mahasiswa::where('angkatan_id', $angkatan_id)
                                    ->where('prodi_id', $prodi_id)
                                    ->get();
    
                // Lakukan perubahan status_mhs
                foreach ($mahasiswa as $mhs) {
                    $mhs->update(['status_mhs' => $status_mhs]);
                }
                activity()->causedBy(Auth::user())->log('User ' . auth()->user()->nim . ' mengubah status mahasiswa');
                return redirect()->route('data-mahasiswa.index')->with('success', 'Status mahasiswa berhasil diubah.');
            } else {
                return redirect()->route('data-mahasiswa.index')->with('error', 'Pilih status mahasiswa yang ingin diubah.');
            }
        }
    }
    
    
    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::find($id);
        if ($mahasiswa) {
            $pathFoto = storage_path("app/public/pas_foto/{$mahasiswa->pas_foto}");
                if ($mahasiswa->pas_foto && file_exists($pathFoto)) {
                unlink($pathFoto);
            }
            $mahasiswa->delete();
            activity()->causedBy(Auth::user())->log('User ' . auth()->user()->nim . ' menghapus mahasiswa');
            return redirect()->route('data-mahasiswa.index')->with('success', 'Mahasiswa berhasil dihapus');
        }
            return redirect()->route('data-mahasiswa.index')->with('error', 'Gagal menghapus mahasiswa');
    }
}