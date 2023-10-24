<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Prodi;
use App\Models\Wilayah;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MahasiswaController extends Controller
{
    // Step 1
    public function step1()
    {
        return view('mahasiswa.isi_data.step1');
    }

    public function step1Store(Request $request)
    {
        $validatedData = $request->validate([
            'nim' => 'required|numeric|unique:mahasiswa,nim',
            'nama_lengkap' => 'required|string',
            'nik' => 'required|string|max:16|unique:mahasiswa,nik',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string',
            'agama' => 'required|string',
            'email' => 'required|email|unique:mahasiswa,email',
            'nohp' => 'required|string',
            'pas_foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ],[
            'nim.unique' => 'NIM sudah terdaftar!',
            'nik.required' => 'NIK wajib di isi!',
            'nik.max' => 'NIK maksimal 16 karakter!',
            'nik.unique' => 'NIK sudah terdaftar!',
            'tempat_lahir.required' => 'Tempat lahir wajib di isi!',
            'tanggal_lahir.required' => 'Tanggal lahir wajib di isi!',
            'jenis_kelamin.required' => 'Jenis kelamin wajib di isi!',
            'agama.required' => 'Agama wajib di isi!',
            'email.required' => 'Email wajib di isi!',
            'email.email' => 'Gunakan format email yang benar!',
            'email.unique' => 'Email sudah terdaftar!',
            'nohp.required' => 'No.HP wajib di isi!',
            'pas_foto.required' => 'Pas foto wajib di isi!',
            'pas_foto.image' => 'Pas foto wajib image!',
            'pas_foto.mimes' => 'Format foto harus .jpg/.jpeg/.png!',
            'pas_foto.max' => 'Maksimal foto 2048 Kb!',
        ]);

        // Simpan foto dengan nama yang sesuai dengan nim
        $pasFoto = $request->file('pas_foto');
        if ($pasFoto) {
            $filename = $validatedData['nim'] . '.' . $pasFoto->getClientOriginalExtension();
            $pasFoto->storeAs('public/pas_foto', $filename);
            $validatedData['pas_foto'] = $filename;
        }
        // Simpan data ke session untuk digunakan pada langkah berikutnya
        $request->session()->put('step1_data', $validatedData);

        return redirect()->route('mahasiswa.isi_data.step2');
    }

    // Step 2
    public function step2()
    {  
        // return view('mahasiswa.isi_data.step2');
        $provinsi = DB::table('wilayah')
                ->orderBy('nama', 'asc')
                ->WhereRaw('LENGTH(kode) = 2')
                ->get();
 
        return view('mahasiswa.isi_data.step2',compact('provinsi'));
    }

    public function step2Store(Request $request)
    {
        $validatedData = $request->validate([
            'provinsi' =>'required|string',
            'kabupaten' => 'required|string',
            'kecamatan' => 'required|string',
            'desa_kelurahan' => 'required|string',
            'rt' => 'required|string|max:3',
            'rw' => 'required|string|max:3',
            'alamat_jalan' => 'required|string',
        ],[
            'provinsi.required' => 'Provinsi wajib di isi!',
            'kabupaten.required' => 'Kabupaten wajib di isi!',
            'kecamatan.required' => 'Kecamatan wajib di isi!',
            'rt.required' => 'RT wajib di isi!',
            'rt.max' => 'RT maksimal 3 karakter!',
            'rw.required' => 'RW wajib di isi!',
            'rw.max' => 'RW maksimal 3 karakter!',
            'alamat_jalan' => 'Jalan wajib di isi!',
        ]);

        // Gabungkan data dari session dengan data baru dari langkah ini
        $step1Data = $request->session()->get('step1_data');
        $data = array_merge($step1Data, $validatedData);

        // Simpan data ke session untuk digunakan pada langkah berikutnya
        $request->session()->put('step2_data', $data);


        return redirect()->route('mahasiswa.isi_data.step3');
    }

    // Step 3
    public function step3()
    {
        return view('mahasiswa.isi_data.step3');
    }

    public function step3Store(Request $request)
    {
        $validatedData = $request->validate([
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
        ],[
            'nama_ayah.required' => 'Nama ayah wajib di isi!',
            'nama_ibu.required' => 'Nama ibu wajib di isi!',
        ]);

        // Gabungkan data dari session dengan data baru dari langkah ini
        $step2Data = $request->session()->get('step2_data');
        $data = array_merge($step2Data, $validatedData);

        // Simpan data ke session untuk digunakan pada langkah berikutnya
        $request->session()->put('step3_data', $data);

        return redirect()->route('mahasiswa.isi_data.step4');
    }

    // Step 4
    public function step4()
    {
        return view('mahasiswa.isi_data.step4');
    }

    public function step4Store(Request $request)
    {
        $validatedData = $request->validate([
            'asal_sekolah' => 'required|string',
            'jurusan_asal_sekolah' => 'required|string',
            'pengalaman_organisasi' => 'nullable|string',
        ],[
            'asal_sekolah.required' => 'Asal sekolah wajib di isi!',
            'jurusan_asal_sekolah.required' => 'Jurusan asal wajib di isi!',
        ]);

        // Gabungkan data dari session dengan data baru dari langkah ini
        $step3Data = $request->session()->get('step3_data');
        $data = array_merge($step3Data, $validatedData);

        // Simpan data ke session untuk digunakan pada langkah berikutnya
        $request->session()->put('step4_data', $data);

        return redirect()->route('mahasiswa.isi_data.step5');
    }

    // Step 5
    public function step5()
    {
        $prodi = Prodi::all();
        return view('mahasiswa.isi_data.step5', compact('prodi'));
    }

    public function step5Store(Request $request)
    {
        $validatedData = $request->validate([
            'prodi_id' => 'required|string',
            'ukt' => 'required|string',
            'jenis_tinggal_di_cilacap' => 'required|string',
            'alat_transportasi_ke_kampus' => 'required|string',
            'sumber_biaya_kuliah' => 'nullable|string',
            'penerima_kartu_prasejahtera' => 'required|string',
        ],[
            'prodi_id.required' => 'Prodi wajib di isi!',
            'ukt.required' => 'UKT wajib di isi!',
            'jenis_tinggal_di_cilacap.required' => 'Tempat tinggal wajib di isi!',
            'alat_transportasi_ke_kampus.required' => 'Transportasi wajib di isi',
            'penerima_kartu_prasejahtera.required' => 'Penerima kartu wajib di isi!',
        ]);

        // Gabungkan data dari session dengan data baru dari langkah ini
        $step4Data = $request->session()->get('step4_data');
        $data = array_merge($step4Data, $validatedData);

        // Simpan data ke session untuk digunakan pada langkah berikutnya
        $request->session()->put('step5_data', $data);

        return redirect()->route('mahasiswa.isi_data.step6');
    }

    // Step 6
    public function step6()
    {
        return view('mahasiswa.isi_data.step6');
    }

    public function step6Store(Request $request)
    {
        $validatedData = $request->validate([
            'jumlah_tanggungan_keluarga_yang_masih_sekolah' => 'required|integer',
            'anak_ke' => 'required|integer',
        ],[
            'jumlah_tanggungan_keluarga_yang_masih_sekolah.required' => 'Jumlah tanggungan wajib di isi!',
            'anak_ke.required' => 'Anak ke berapa wajib di isi!'
        ]);
    
        // Pastikan step5_data ada di dalam session dan inisialisasi sebagai array kosong jika tidak ada
        $step5Data = $request->session()->get('step5_data', []);
    
        // Gabungkan data dari session dengan data baru dari langkah ini
        $data = array_merge($step5Data, $validatedData);
    
        // Lakukan penyimpanan ke database
        $mahasiswa = Mahasiswa::create($data);
    
        // Hapus data dari session setelah penyimpanan berhasil
        $request->session()->forget('step1_data');
        $request->session()->forget('step2_data');
        $request->session()->forget('step3_data');
        $request->session()->forget('step4_data');
        $request->session()->forget('step5_data');
    
        // Alihkan ke halaman detail dengan mengirimkan nim mahasiswa yang baru saja disimpan
        return redirect()->route('mahasiswa.detail', ['nim' => Auth::user()->nim]);
    }

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