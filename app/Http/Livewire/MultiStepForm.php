<?php

namespace App\Http\Livewire;

use App\Models\Mahasiswa;
use App\Models\Prodi;
use App\Models\Wilayah;
use Illuminate\Support\Facades\Auth;
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
    public $agama;
    public $email;
    public $nohp;
    public $pas_foto;
    public $provinsi;
    public $kabupaten;
    public $kecamatan;
    public $desa_kelurahan;
    public $rt;
    public $rw;
    public $alamat_jalan;
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
        $this->nim = Auth::user()->nim;
        $this->nama_lengkap = Auth::user()->username;
        $this->provinsi = Wilayah::where('kode', 'like', '__')->get();
        $this->kabupaten = $this->selectedProvinsi ?
            Wilayah::where('kode', 'like', $this->selectedProvinsi . '___')->get() : [];
        $this->kecamatan = $this->selectedKabupaten ?
            Wilayah::where('kode', 'like', $this->selectedKabupaten . '___')->get() : [];
        $this->desa_kelurahan = $this->selectedKecamatan ?
            Wilayah::where('kode', 'like', $this->selectedKecamatan . '_____')->get() : [];

        $prodi = Prodi::all();
        
        return view('livewire.multi-step-form', compact('prodi'));
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
                    'nik' => 'required|string|max:16|unique:mahasiswa,nik',
                    'tempat_lahir' => 'required|string',
                    'tanggal_lahir' => 'required|date',
                    'jenis_kelamin' => 'required|string',
                    'agama' => 'required|string',
                    'email' => 'required|email|unique:mahasiswa,email',
                    'nohp' => 'required|string',
                    'pas_foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                ], [
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
                'alamat_jalan' => 'required',
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
        }
        elseif($this->currentStep == 3){
            $this->validate([
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
        $mahasiswa->agama = $this->agama;
        $mahasiswa->email = $this->email;
        $mahasiswa->nohp = $this->nohp;
        $mahasiswa->pas_foto = $this->filename;
        $mahasiswa->provinsi = $this->selectedProvinsi;
        $mahasiswa->kabupaten = $this->selectedKabupaten;
        $mahasiswa->kecamatan = $this->selectedKecamatan;
        $mahasiswa->desa_kelurahan = $this->selectedDesa;
        $mahasiswa->rt = $this->rt;
        $mahasiswa->rw = $this->rw;
        $mahasiswa->alamat_jalan = $this->alamat_jalan;
        $mahasiswa->nama_ayah = $this->nama_ayah;
        $mahasiswa->nik_ayah = $this->nik_ayah;
        $mahasiswa->tempat_lahir_ayah = $this->tempat_lahir_ayah;
        $mahasiswa->tanggal_lahir_ayah = $this->tanggal_lahir_ayah;
        $mahasiswa->pendidikan_ayah = $this->pendidikan_ayah;
        $mahasiswa->pekerjaan_ayah = $this->pekerjaan_ayah;
        $mahasiswa->penghasilan_ayah = $this->penghasilan_ayah;
        $mahasiswa->nama_ibu = $this->nama_ibu;
        $mahasiswa->nik_ibu = $this->nik_ibu;
        $mahasiswa->tempat_lahir_ibu = $this->tempat_lahir_ibu;
        $mahasiswa->tanggal_lahir_ibu = $this->tanggal_lahir_ibu;
        $mahasiswa->pendidikan_ibu = $this->pendidikan_ibu;
        $mahasiswa->pekerjaan_ibu = $this->pekerjaan_ibu;
        $mahasiswa->penghasilan_ibu = $this->penghasilan_ibu;
        $mahasiswa->nama_wali = $this->nama_wali;
        $mahasiswa->alamat_wali = $this->alamat_wali;
        $mahasiswa->asal_sekolah = $this->asal_sekolah;
        $mahasiswa->jurusan_asal_sekolah = $this->jurusan_asal_sekolah;
        $mahasiswa->pengalaman_organisasi = $this->pengalaman_organisasi;
        $mahasiswa->prodi_id = $this->prodi_id;
        $mahasiswa->ukt = $this->ukt;
        $mahasiswa->jenis_tinggal_di_cilacap = $this->jenis_tinggal_di_cilacap;
        $mahasiswa->alat_transportasi_ke_kampus = $this->alat_transportasi_ke_kampus;
        $mahasiswa->sumber_biaya_kuliah = $this->sumber_biaya_kuliah;
        $mahasiswa->penerima_kartu_prasejahtera = $this->penerima_kartu_prasejahtera;
        $mahasiswa->jumlah_tanggungan_keluarga_yang_masih_sekolah = $this->jumlah_tanggungan_keluarga_yang_masih_sekolah;
        $mahasiswa->anak_ke = $this->anak_ke;
        
        $mahasiswa->save();
        
        return redirect()->route('mahasiswa.detail',['nim' => Auth::user()->nim])->with('success','Terimakasih telah mengisi data anda.');
    }
}