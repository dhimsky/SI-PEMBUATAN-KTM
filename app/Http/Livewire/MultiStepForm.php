<?php

namespace App\Http\Livewire;

use App\Models\Agama;
use App\Models\AlamatMhs;
use App\Models\KeluargaMhs;
use App\Models\KuliahMhs;
use App\Models\Mahasiswa;
use App\Models\Pengajuan;
use App\Models\Prodi;
use App\Models\TahunAngkatan;
use App\Models\Wilayah;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class MultiStepForm extends Component
{
    use WithFileUploads;
    public $nim;
    public $nama_lengkap;
    public $nik;
    public $tempat_lahir;
    public $tanggal_lahir;
    public $jenis_kelamin;
    public $agama_id;
    public $email;
    public $nohp;
    public $pas_foto;
    public $provinsi;
    public $kabupaten;
    public $kecamatan;
    public $desa_kelurahan;
    public $rt;
    public $rw;
    public $nama_jalan;
    public $kode_pos;
    public $nama_ayah;
    public $nik_ayah;
    public $tempat_lahir_ayah;
    public $tanggal_lahir_ayah;
    public $pendidikan_ayah;
    public $pekerjaan_ayah;
    public $penghasilan_ayah;
    public $nama_ibu;
    public $nik_ibu;
    public $tempat_lahir_ibu;
    public $tanggal_lahir_ibu;
    public $pendidikan_ibu;
    public $pekerjaan_ibu;
    public $penghasilan_ibu;
    public $nama_wali;
    public $alamat_wali;
    public $asal_sekolah;
    public $jurusan_asal_sekolah;
    public $pengalaman_organisasi;
    public $prodi_id;
    public $ukt;
    public $angkatan_id;
    public $jenis_tinggal_di_cilacap;
    public $alat_transportasi_ke_kampus;
    public $sumber_biaya_kuliah;
    public $penerima_kartu_prasejahtera;
    public $jumlah_tanggungan_keluarga_yang_masih_sekolah;
    public $anak_ke;

    public $totalSteps = 6;
    public $currentStep = 1;

    public $selectedProvinsi = null;
    public $selectedKabupaten = null;
    public $selectedKecamatan = null;
    public $selectedDesa = null;
    public $filename;

    public function mount(){
        $this->currentStep = 1;
    }
    
    public function render()
    {
        $this->nim = Auth::user()->no_identitas;
        $this->nama_lengkap = Auth::user()->nama_lengkap;
        $this->provinsi = Wilayah::where('kode', 'like', '__')->get();
        $this->kabupaten = $this->selectedProvinsi ?
            Wilayah::where('kode', 'like', $this->selectedProvinsi . '___')->get() : [];
        $this->kecamatan = $this->selectedKabupaten ?
            Wilayah::where('kode', 'like', $this->selectedKabupaten . '___')->get() : [];
        $this->desa_kelurahan = $this->selectedKecamatan ?
            Wilayah::where('kode', 'like', $this->selectedKecamatan . '_____')->get() : [];

        $prodi = Prodi::all();
        $agama = Agama::all();
        $angkatan = TahunAngkatan::all();
        
        return view('livewire.multi-step-form', compact('prodi','agama','angkatan'));
    }

    public function increaseStep(){
        $this->resetErrorBag();
        $this->validateData();
        $this->currentStep++;
        if($this->currentStep > $this->totalSteps){
            $this->currentStep = $this->totalSteps;
        }
    }

    public function decreaseStep(){
        $this->resetErrorBag();
        $this->currentStep--;
        if($this->currentStep < 1){
            $this->currentStep = 1;
        }
    }

    public function updatedPasFoto()
    {
        $this->emit('updateFileName', $this->pas_foto->getClientOriginalName());
    }

    public function validateData(){
        if ($this->currentStep == 1) {
                $this->validate([
                    'nik' => 'required|string|max:16|min:16|unique:mahasiswa,nik',
                    'tempat_lahir' => 'required|string',
                    'tanggal_lahir' => 'required|date',
                    'jenis_kelamin' => 'required|string',
                    'agama_id' => 'required|string',
                    'email' => 'required|email|regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/|unique:mahasiswa,email',
                    'nohp' => 'required|string',
                    'pas_foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                ], [
                    'nik.required' => 'NIK wajib di isi!',
                    'nik.max' => 'NIK maksimal 16 karakter!',
                    'nik.min' => 'NIK minimal 16 karakter!',
                    'nik.unique' => 'NIK sudah terdaftar!',
                    'tempat_lahir.required' => 'Tempat lahir wajib di isi!',
                    'tanggal_lahir.required' => 'Tanggal lahir wajib di isi!',
                    'jenis_kelamin.required' => 'Jenis kelamin wajib di isi!',
                    'agama_id.required' => 'Agama wajib di isi!',
                    'email.required' => 'Email wajib di isi!',
                    'email.email' => 'Gunakan format email yang benar!',
                    'email.unique' => 'Email sudah terdaftar!',
                    'email.regex' => 'Gunakan format email yang benar!',
                    'nohp.required' => 'No.HP wajib di isi!',
                    'pas_foto.required' => 'Pas foto wajib di isi!',
                    'pas_foto.image' => 'Pas foto wajib image!',
                    'pas_foto.mimes' => 'Format foto harus .jpg/.jpeg/.png!',
                    'pas_foto.max' => 'Maksimal foto 2048 Kb!',
                ]);
                // if ($this->pas_foto) {
                //     $this->filename = $this->nim . '.' . $this->pas_foto->getClientOriginalExtension();
                //     $this->pas_foto->storeAs('public/pas_foto', $this->filename);
                //     $this->pas_foto = $this->filename;
                // }  
                if (is_string($this->pas_foto)) {
                    $this->filename = $this->nim . '.' . pathinfo($this->pas_foto, PATHINFO_EXTENSION);
                } elseif ($this->pas_foto instanceof \Illuminate\Http\UploadedFile) {
                    $this->filename = $this->nim . '.' . $this->pas_foto->getClientOriginalExtension();
                    $this->pas_foto->storeAs('public/pas_foto', $this->filename);
                }                         
        }
        elseif($this->currentStep == 2){
            $this->validate([
                'provinsi' =>'required',
                'kabupaten' => 'required',
                'kecamatan' => 'required',
                'desa_kelurahan' => 'required',
                'rt' => 'required|max:3',
                'rw' => 'required|max:3',
                'nama_jalan' => 'required',
                'kode_pos' => 'required',
            ],[
                'provinsi.required' => 'Provinsi wajib di isi!',
                'kabupaten.required' => 'Kabupaten wajib di isi!',
                'kecamatan.required' => 'Kecamatan wajib di isi!',
                'rt.required' => 'RT wajib di isi!',
                'rt.max' => 'RT maksimal 3 karakter!',
                'rw.required' => 'RW wajib di isi!',
                'rw.max' => 'RW maksimal 3 karakter!',
                'nama_jalan.required' => 'Jalan wajib di isi!',
                'kode_pos.required' => 'Kode pos wajib di isi!',
            ]);
        }
        elseif($this->currentStep == 3){
            $this->validate([
                'nama_ayah' => 'required|string',
                'nik_ayah' => 'nullable|string|max:16|min:16',
                'tempat_lahir_ayah' => 'nullable|string',
                'tanggal_lahir_ayah' => 'nullable|date',
                'pendidikan_ayah' => 'nullable|string',
                'pekerjaan_ayah' => 'nullable|string',
                'penghasilan_ayah' => 'nullable|string',
                'nama_ibu' => 'required|string',
                'nik_ibu' => 'nullable|string|max:16|min:16',
                'tempat_lahir_ibu' => 'nullable|string',
                'tanggal_lahir_ibu' => 'nullable|date',
                'pendidikan_ibu' => 'nullable|string',
                'pekerjaan_ibu' => 'nullable|string',
                'penghasilan_ibu' => 'nullable|string',
                'nama_wali' => 'nullable|string',
                'alamat_wali' => 'nullable|string',
            ],[
                'nik_ayah.max' => 'Nik maksimal 16 karakter!',
                'nik_ibu.max' => 'Nik maksimal 16 karakter!',
                'nik_ayah.min' => 'Nik minimal 16 karakter!',
                'nik_ibu.min' => 'Nik minimal 16 karakter!',
                'nama_ayah.required' => 'Nama ayah wajib di isi!',
                'nama_ibu.required' => 'Nama ibu wajib di isi!',
            ]);
        }
        elseif($this->currentStep == 4){
            $this->validate([
                'asal_sekolah' => 'required|string',
                'jurusan_asal_sekolah' => 'required|string',
                'pengalaman_organisasi' => 'nullable|string',
            ],[
                'asal_sekolah.required' => 'Asal sekolah wajib di isi!',
                'jurusan_asal_sekolah.required' => 'Jurusan asal wajib di isi!',
            ]);
        }
        elseif($this->currentStep == 5){
            $this->validate([
                'prodi_id' => 'required|string',
                'ukt' => 'required|string',
                'angkatan_id' => 'required|string',
                'jenis_tinggal_di_cilacap' => 'required|string',
                'alat_transportasi_ke_kampus' => 'required|string',
                'sumber_biaya_kuliah' => 'nullable|string',
                'penerima_kartu_prasejahtera' => 'required|string',
            ],[
                'prodi_id.required' => 'Prodi wajib di isi!',
                'ukt.required' => 'UKT wajib di isi!',
                'angkatan_id.required' => 'Tahun Angkatan wajib di isi!',
                'jenis_tinggal_di_cilacap.required' => 'Tempat tinggal wajib di isi!',
                'alat_transportasi_ke_kampus.required' => 'Transportasi wajib di isi',
                'penerima_kartu_prasejahtera.required' => 'Penerima kartu wajib di isi!',
            ]);
        }
        elseif($this->currentStep == 4){
            $this->validate([
                'asal_sekolah' => 'required|string',
                'jurusan_asal_sekolah' => 'required|string',
                'pengalaman_organisasi' => 'nullable|string',
            ],[
                'asal_sekolah.required' => 'Asal sekolah wajib di isi!',
                'jurusan_asal_sekolah.required' => 'Jurusan asal wajib di isi!',
            ]);
        }
    }

    public function isi_data(){
        $this->resetErrorBag();
        if($this->currentStep == 6){
            $this->validate([
                'jumlah_tanggungan_keluarga_yang_masih_sekolah' => 'required|integer',
                'anak_ke' => 'required|integer',
            ],[
                'jumlah_tanggungan_keluarga_yang_masih_sekolah.required' => 'Jumlah tanggungan wajib di isi!',
                'anak_ke.required' => 'Anak ke berapa wajib di isi!',
            ]);
        }

        $mahasiswa = new Mahasiswa();
        $mahasiswa->nim = $this->nim;
        $mahasiswa->nama_lengkap = $this->nama_lengkap;
        $mahasiswa->nik = $this->nik;
        $mahasiswa->tempat_lahir = $this->tempat_lahir;
        $mahasiswa->tanggal_lahir = $this->tanggal_lahir;
        $mahasiswa->jenis_kelamin = $this->jenis_kelamin;
        $mahasiswa->agama_id = $this->agama_id;
        $mahasiswa->email = $this->email;
        $mahasiswa->nohp = $this->nohp;
        $mahasiswa->pas_foto = $this->filename;
        $mahasiswa->save();

        $alamat = new AlamatMhs();
        $alamat->nim_id = $this->nim;
        $alamat->provinsi = $this->selectedProvinsi;
        $alamat->kabupaten = $this->selectedKabupaten;
        $alamat->kecamatan = $this->selectedKecamatan;
        $alamat->desa_kelurahan = $this->selectedDesa;
        $alamat->rt = $this->rt;
        $alamat->rw = $this->rw;
        $alamat->nama_jalan = $this->nama_jalan;
        $alamat->kode_pos = $this->kode_pos;
        $alamat->save();

        $keluarga = new KeluargaMhs();
        $keluarga->nim_id = $this->nim;
        $keluarga->nama_ayah = $this->nama_ayah;
        $keluarga->nik_ayah = $this->nik_ayah;
        $keluarga->tempat_lahir_ayah = $this->tempat_lahir_ayah;
        $keluarga->tanggal_lahir_ayah = $this->tanggal_lahir_ayah;
        $keluarga->pendidikan_ayah = $this->pendidikan_ayah;
        $keluarga->pekerjaan_ayah = $this->pekerjaan_ayah;
        $keluarga->penghasilan_ayah = $this->penghasilan_ayah;
        $keluarga->nama_ibu = $this->nama_ibu;
        $keluarga->nik_ibu = $this->nik_ibu;
        $keluarga->tempat_lahir_ibu = $this->tempat_lahir_ibu;
        $keluarga->tanggal_lahir_ibu = $this->tanggal_lahir_ibu;
        $keluarga->pendidikan_ibu = $this->pendidikan_ibu;
        $keluarga->pekerjaan_ibu = $this->pekerjaan_ibu;
        $keluarga->penghasilan_ibu = $this->penghasilan_ibu;
        $keluarga->nama_wali = $this->nama_wali;
        $keluarga->alamat_wali = $this->alamat_wali;
        $keluarga->jumlah_tanggungan_keluarga_yang_masih_sekolah = $this->jumlah_tanggungan_keluarga_yang_masih_sekolah;
        $keluarga->anak_ke = $this->anak_ke;
        $keluarga->save();

        $kuliah = new KuliahMhs();
        $kuliah->nim_id = $this->nim;
        $kuliah->asal_sekolah = $this->asal_sekolah;
        $kuliah->jurusan_asal_sekolah = $this->jurusan_asal_sekolah;
        $kuliah->pengalaman_organisasi = $this->pengalaman_organisasi;
        $kuliah->prodi_id = $this->prodi_id;
        $kuliah->ukt = $this->ukt;
        $kuliah->angkatan_id = $this->angkatan_id;
        $kuliah->jenis_tinggal_di_cilacap = $this->jenis_tinggal_di_cilacap;
        $kuliah->alat_transportasi_ke_kampus = $this->alat_transportasi_ke_kampus;
        $kuliah->sumber_biaya_kuliah = $this->sumber_biaya_kuliah;
        $kuliah->penerima_kartu_prasejahtera = $this->penerima_kartu_prasejahtera;
        $kuliah->status_mhs = 'Aktif';
        $kuliah->save();

        $pengajuan = new Pengajuan();
        $pengajuan->nim_id = $this->nim;
        $pengajuan->nama_lengkap = $this->nama_lengkap;
        $pengajuan->nik = $this->nik;
        $pengajuan->tempat_lahir = $this->tempat_lahir;
        $pengajuan->tanggal_lahir = $this->tanggal_lahir;
        $pengajuan->jenis_kelamin = $this->jenis_kelamin;
        $pengajuan->agama_id = $this->agama_id;
        $pengajuan->email = $this->email;
        $pengajuan->nohp = $this->nohp;
        $pengajuan->pas_foto = $this->filename;
        $pengajuan->provinsi = $this->selectedProvinsi;
        $pengajuan->kabupaten = $this->selectedKabupaten;
        $pengajuan->kecamatan = $this->selectedKecamatan;
        $pengajuan->desa_kelurahan = $this->selectedDesa;
        $pengajuan->rt = $this->rt;
        $pengajuan->rw = $this->rw;
        $pengajuan->nama_jalan = $this->nama_jalan;
        $pengajuan->kode_pos = $this->kode_pos;
        $pengajuan->nama_ayah = $this->nama_ayah;
        $pengajuan->nama_ibu = $this->nama_ibu;
        $pengajuan->prodi_id = $this->prodi_id;
        $pengajuan->ukt = $this->ukt;
        $pengajuan->angkatan_id = $this->angkatan_id;
        $pengajuan->status = 'proses';
        $pengajuan->save();
        
        return redirect()->route('mahasiswa.detail',['nim' => Crypt::encryptString(Auth::user()->no_identitas)])->with('success','Terimakasih telah mengisi data anda.');
    }
}