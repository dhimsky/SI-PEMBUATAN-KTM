<div>
    <form wire:submit.prevent='isi_data' enctype="multipart/form-data">
        

        @if ($currentStep == 1)
        {{-- Step 1 --}}
        <div class="card-header text-white" style="background-color: #3D4465">
            <h4 class="text-white">STEP 1/6 - Data Pribadi</h4>
        </div>
        <div class="card-body">
            <div class="step-one">
                <div class="row text-dark">
                    <div class="form-group col-md-3 mb-3">
                        <label class="required-label faded-label" for="nim" style="font-style: italic;">NIM</label>
                        <input type="number" name="nim" class="form-control @error('nim') is-invalid @enderror" readonly wire:model="nim">
                        @error('nim')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        <label class="required-label faded-label" for="nama_lengkap" style="font-style: italic;">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" class="form-control @error('nama_lengkap') is-invalid @enderror" readonly wire:model="nama_lengkap">
                        @error('nama_lengkap')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        <label class="required-label faded-label" for="nik" style="font-style: italic;">NIK</label>
                        <input type="number" name="nik" class="form-control @error('nik') is-invalid @enderror" value="{{ old('nik') }}" wire:model="nik">
                        @error('nik')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        <label class="required-label faded-label" for="tempat_lahir" style="font-style: italic;">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror" value="{{ old('tempat_lahir') }}" wire:model="tempat_lahir">
                        @error('tempat_lahir')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        <label class="required-label faded-label" for="tanggal_lahir" style="font-style: italic;">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror" value="{{ old('tanggal_lahir') }}" wire:model="tanggal_lahir">
                        @error('tanggal_lahir')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        <label class="required-label faded-label" for="jenis_kelamin" style="font-style: italic;">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror" wire:model="jenis_kelamin">
                            <option selected value="" style="font-style: italic;">-- Pilih Jenis Kelamin --</option>
                            <option value="Laki-laki" @if(old('jenis_kelamin') == 'Laki-laki') selected @endif>Laki-laki</option>
                            <option value="Perempuan" @if(old('jenis_kelamin') == 'Perempuan') selected @endif>Perempuan</option>
                        </select>
                        @error('jenis_kelamin')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        <label class="required-label faded-label" for="agama_id" style="font-style: italic;">Agama</label>
                        <select class="form-control @error('agama_id') is-invalid @enderror" aria-label="Default select example" for="agama_id" name="agama_id" id="agama_id" wire:model="agama_id">
                            <option selected value="" style="font-style: italic;">-- Pilih Agama --</option>
                            @foreach ($agama as $a)
                                <option value="{{ $a->id_agama }}">{{ $a->nama_agama }}</option>
                            @endforeach
                        </select>  
                        @error('agama_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        <label class="required-label faded-label" for="email" style="font-style: italic;">Email</label>
                        <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" wire:model="email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        <label class="required-label faded-label" for="nohp" style="font-style: italic;">Nomor Hp</label>
                        <input type="number" name="nohp" class="form-control @error('nohp') is-invalid @enderror" value="{{ old('nohp') }}" wire:model="nohp">
                        @error('nohp')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        <label class="required-label faded-label" for="pas_foto" style="font-style: italic;">Pas Foto</label>
                        <div class="custom-file">
                            <input type="file" name="pas_foto" class="custom-file-input @error('pas_foto') is-invalid @enderror" id="input_pas_foto" wire:model="pas_foto" accept=".jpg, .jpeg, .png">
                            <label class="custom-file-label" id="label_pas_foto" for="input_pas_foto">
                                @if($pas_foto && !is_string($pas_foto))
                                    Foto Terpilih
                                @else
                                    Upload Foto
                                @endif
                            </label>
                            @error('pas_foto')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group col-md-4 mb-3">
                        <img src="{{ $pas_foto ? $pas_foto->temporaryUrl() : asset('/images/profile.jpeg') }}" id="img" height="100" alt="">
                    </div>
                    <script>
                        document.addEventListener('livewire:load', function () {
                            Livewire.on('updateFileName', function (fileName) {
                                const labelFoto = document.getElementById('label_pas_foto');
                                labelFoto.innerHTML = 'File Terpilih';
                            });
                        });
                    </script>
                </div>                  
            </div>
        </div>
        @endif

        @if ($currentStep == 2)
        {{-- Step 2 --}}
        <div class="card-header text-white" style="background-color: #3D4465">
            <h4 class="text-white"> STEP 2/6 - Alamat</h4>
        </div>
        <div class="card-body">
            <div class="step-two">
                <div class="row text-dark">
    
                    <!-- Provinsi Dropdown -->
                    <div class="form-group col-md-3 mb-3">
                        <label class="required-label faded-label" for="provinsi" style="font-style: italic;">Provinsi</label>
                        <select class="form-control @error('provinsi') is-invalid @enderror" name="provinsi" id="provinsi" wire:model="selectedProvinsi">
                            <option selected value="">Pilih Provinsi</option>
                                @foreach ($provinsi as $provinsi)
                                    <option value="{{ $provinsi->kode }}">{{ mb_convert_case($provinsi->nama, MB_CASE_TITLE) }}</option>
                                @endforeach
                        </select>
                            @error('provinsi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                    </div>
    
                    <!-- Kabupaten/Kota Dropdown -->
                    <div class="form-group col-md-3 mb-3">
                        <label class="required-label faded-label" for="kabupaten" style="font-style: italic;">Kabupaten/Kota</label>
                        <select class="form-control @error('kabupaten') is-invalid @enderror" aria-label="Default select example" name="kabupaten" id="kabupaten" wire:model="selectedKabupaten" >
                            <option selected value="">Pilih Kabupaten/Kota</option>
                            @foreach ($kabupaten as $kabupaten)
                                <option value="{{ $kabupaten->kode }}">{{ mb_convert_case($kabupaten->nama, MB_CASE_TITLE) }}</option>
                            @endforeach
                        </select>
                            @error('kabupaten')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
    
                    <!-- Kecamatan Dropdown -->
                    <div class="form-group col-md-3 mb-3">
                        <label class="required-label faded-label" for="kecamatan" style="font-style: italic;">Kecamatan</label>
                        <select class="form-control @error('kecamatan') is-invalid @enderror" aria-label="Default select example" name="kecamatan" id="kecamatan" wire:model="selectedKecamatan" >
                            <option selected value="">Pilih Kecamatan</option>
                            @foreach ($kecamatan as $kecamatan)
                                <option value="{{ $kecamatan->kode }}">{{ $kecamatan->nama }}</option>
                            @endforeach
                        </select>
                            @error('kecamatan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
    
                    <!-- Desa/Kelurahan Input -->
                    <div class="form-group col-md-3 mb-3">
                        <label class="required-label faded-label" for="desa_kelurahan" style="font-style: italic;">Desa/Kelurahan</label>
                        <select class="form-control @error('desa_kelurahan') is-invalid @enderror" aria-label="Default select example" name="desa_kelurahan" id="desa_kelurahan"  wire:model="selectedDesa">
                            <option selected value="">Pilih Desa/Kelurahan</option>
                            @foreach ($desa_kelurahan as $desa)
                                <option value="{{ $desa->kode }}">{{ $desa->nama }}</option>
                            @endforeach
                        </select>
                            @error('desa_kelurahan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
    
                    <!-- RT Input -->
                    <div class="form-group col-md-2 mb-3">
                        <label class="required-label faded-label" for="rt" style="font-style: italic;">RT</label>
                        <input type="number" name="rt" class="form-control @error('rt') is-invalid @enderror" value="{{ old('rt') }}" wire:model="rt">
                        @error('rt')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
    
                    <!-- RW Input -->
                    <div class="form-group col-md-2 mb-3">
                        <label class="required-label faded-label" for="rw" style="font-style: italic;">RW</label>
                        <input type="number" name="rw" class="form-control @error('rw') is-invalid @enderror" value="{{ old('rw') }}" wire:model="rw">
                        @error('rw')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
    
                    <!-- Alamat Jalan Input -->
                    <div class="form-group col-md-5 mb-3">
                        <label class="required-label faded-label" for="alamat_jalan" style="font-style: italic;">Nama Jalan</label>
                        <input type="text" name="alamat_jalan" class="form-control @error('alamat_jalan') is-invalid @enderror" value="{{ old('alamat_jalan') }}" wire:model="alamat_jalan" placeholder="Contoh: Melati No.3">
                        @error('alamat_jalan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        @endif

        @if ($currentStep == 3)
        {{-- Step 3 --}}
        <div class="card-header text-white" style="background-color: #3D4465">
            <h4 class="text-white">STEP 3/6 - Orangtua Kandung & Wali</h4>
        </div>
        <div class="card-body">
            <div class="step-three">
                <div class="row text-dark">
                    <div class="form-group col-md-3 mb-3">
                        <label class="required-label faded-label" for="nama_ayah" style="font-style: italic;">Nama Ayah</label>
                        <input type="text" name="nama_ayah" class="form-control @error('nama_ayah') is-invalid @enderror" value="{{ old('nama_ayah') }}" wire:model="nama_ayah">
                        @error('nama_ayah')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        <label class="faded-label" for="nik_ayah" style="font-style: italic;">NIK Ayah</label>
                        <input type="number" name="nik_ayah" class="form-control @error('nik_ayah') is-invalid @enderror" value="{{ old('nik_ayah') }}" wire:model="nik_ayah">
                        @error('nik_ayah')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        <label class="faded-label" for="tempat_lahir_ayah" style="font-style: italic;">Tempat Lahir Ayah</label>
                        <input type="text" name="tempat_lahir_ayah" class="form-control @error('tempat_lahir_ayah') is-invalid @enderror" value="{{ old('tempat_lahir_ayah') }}" wire:model="tempat_lahir_ayah">
                        @error('tempat_lahir_ayah')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        <label class="faded-label" for="tanggal_lahir_ayah" style="font-style: italic;">Tanggal Lahir Ayah</label>
                        <input type="date" name="tanggal_lahir_ayah" class="form-control @error('tanggal_lahir_ayah') is-invalid @enderror" value="{{ old('tanggal_lahir_ayah') }}" wire:model="tanggal_lahir_ayah">
                        @error('tanggal_lahir_ayah')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
    
                    <div class="form-group col-md-3 mb-3">
                        <label class="faded-label" for="pendidikan_ayah" style="font-style: italic;">Pendidikan Terakhir Ayah</label>
                        <select name="pendidikan_ayah" class="form-control @error('pendidikan_ayah') is-invalid @enderror" wire:model="pendidikan_ayah">
                            <option selected value="" style="font-style: italic;">-- Pilih Pendidikan Terakhir --</option>
                            <option value="SD" @if(old('pendidikan_ayah') == 'SD') selected @endif>SD</option>
                            <option value="SLTP" @if(old('pendidikan_ayah') == 'SLTP') selected @endif>SLTP</option>
                            <option value="SLTA" @if(old('pendidikan_ayah') == 'SLTA') selected @endif>SLTA</option>
                            <option value="D1" @if(old('pendidikan_ayah') == 'D1') selected @endif>D1</option>
                            <option value="D2" @if(old('pendidikan_ayah') == 'D2') selected @endif>D2</option>
                            <option value="D3" @if(old('pendidikan_ayah') == 'D3') selected @endif>D3</option>
                            <option value="S1" @if(old('pendidikan_ayah') == 'S1') selected @endif>S1</option>
                            <option value="S2" @if(old('pendidikan_ayah') == 'S2') selected @endif>S2</option>
                            <option value="S3" @if(old('pendidikan_ayah') == 'S3') selected @endif>S3</option>
                        </select>
                        @error('pendidikan_ayah')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    {{-- <div class="form-group col-md-3 mb-3">
                        <label class="faded-label" for="pendidikan_ayah" style="font-style: italic;">Pendidikan Terakhir Ayah</label>
                        <input type="text" name="pendidikan_ayah" class="form-control @error('pendidikan_ayah') is-invalid @enderror" value="{{ old('pendidikan_ayah') }}" wire:model="pendidikan_ayah">
                        @error('pendidikan_ayah')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div> --}}
                    <div class="form-group col-md-3 mb-3">
                        <label class="faded-label" for="pekerjaan_ayah" style="font-style: italic;">Pekerjaan Ayah</label>
                        <input type="text" name="pekerjaan_ayah" class="form-control @error('pekerjaan_ayah') is-invalid @enderror" value="{{ old('pekerjaan_ayah') }}" wire:model="pekerjaan_ayah">
                        @error('pekerjaan_ayah')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        <label class="faded-label" for="penghasilan_ayah" style="font-style: italic;">Penghasilan Ayah</label>
                        <input type="number" name="penghasilan_ayah" class="form-control @error('penghasilan_ayah') is-invalid @enderror" value="{{ old('penghasilan_ayah') }}" wire:model="penghasilan_ayah">
                        @error('penghasilan_ayah')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <hr style="border: 0.2px solid">
                <div class="row mt-3">
                    <div class="form-group col-md-3 mb-3">
                        <label class="required-label faded-label" for="nama_ibu" style="font-style: italic;">Nama Ibu</label>
                        <input type="text" name="nama_ibu" class="form-control @error('nama_ibu') is-invalid @enderror" value="{{ old('nama_ibu') }}" wire:model="nama_ibu">
                        @error('nama_ibu')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        <label class="faded-label" for="nik_ibu" style="font-style: italic;">NIK Ibu</label>
                        <input type="number" name="nik_ibu" class="form-control @error('nik_ibu') is-invalid @enderror" value="{{ old('nik_ibu') }}" wire:model="nik_ibu">
                        @error('nik_ibu')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        <label class="faded-label" for="tempat_lahir_ibu" style="font-style: italic;">Tempat Lahir Ibu</label>
                        <input type="text" name="tempat_lahir_ibu" class="form-control @error('tempat_lahir_ibu') is-invalid @enderror" value="{{ old('tempat_lahir_ibu') }}" wire:model="tempat_lahir_ibu">
                        @error('tempat_lahir_ibu')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        <label class="faded-label" for="tanggal_lahir_ibu" style="font-style: italic;">Tanggal Lahir Ibu</label>
                        <input type="date" name="tanggal_lahir_ibu" class="form-control @error('tanggal_lahir_ibu') is-invalid @enderror" value="{{ old('tanggal_lahir_ibu') }}" wire:model="tanggal_lahir_ibu">
                        @error('tanggal_lahir_ibu')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
    
                    <div class="form-group col-md-3 mb-3">
                        <label class="faded-label" for="pendidikan_ibu" style="font-style: italic;">Pendidikan Terakhir Ibu</label>
                        <select name="pendidikan_ibu" class="form-control @error('pendidikan_ibu') is-invalid @enderror" wire:model="pendidikan_ibu">
                            <option selected value="" style="font-style: italic;">-- Pilih Pendidikan Terakhir --</option>
                            <option value="SD" @if(old('pendidikan_ibu') == 'SD') selected @endif>SD</option>
                            <option value="SLTP" @if(old('pendidikan_ibu') == 'SLTP') selected @endif>SLTP</option>
                            <option value="SLTA" @if(old('pendidikan_ibu') == 'SLTA') selected @endif>SLTA</option>
                            <option value="D1" @if(old('pendidikan_ibu') == 'D1') selected @endif>D1</option>
                            <option value="D2" @if(old('pendidikan_ibu') == 'D2') selected @endif>D2</option>
                            <option value="D3" @if(old('pendidikan_ibu') == 'D3') selected @endif>D3</option>
                            <option value="S1" @if(old('pendidikan_ibu') == 'S1') selected @endif>S1</option>
                            <option value="S2" @if(old('pendidikan_ibu') == 'S2') selected @endif>S2</option>
                            <option value="S3" @if(old('pendidikan_ibu') == 'S3') selected @endif>S3</option>
                        </select>
                        @error('pendidikan_ibu')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    {{-- <div class="form-group col-md-3 mb-3">
                        <label class="faded-label" for="pendidikan_ibu" style="font-style: italic;">Pendidikan Terakhir Ibu</label>
                        <input type="text" name="pendidikan_ibu" class="form-control @error('pendidikan_ibu') is-invalid @enderror" value="{{ old('pendidikan_ibu') }}" wire:model="pendidikan_ibu">
                        @error('pendidikan_ibu')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div> --}}
                    <div class="form-group col-md-3 mb-3">
                        <label class="faded-label" for="pekerjaan_ibu" style="font-style: italic;">Pekerjaan Ibu</label>
                        <input type="text" name="pekerjaan_ibu" class="form-control @error('pekerjaan_ibu') is-invalid @enderror" value="{{ old('pekerjaan_ibu') }}" wire:model="pekerjaan_ibu">
                        @error('pekerjaan_ibu')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        <label class="faded-label" for="penghasilan_ibu" style="font-style: italic;">Penghasilan Ibu</label>
                        <input type="number" name="penghasilan_ibu" class="form-control @error('penghasilan_ibu') is-invalid @enderror" value="{{ old('penghasilan_ibu') }}" wire:model="penghasilan_ibu">
                        @error('penghasilan_ibu')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <hr style="border: 0.2px solid">
                <div class="row">
                    <div class="form-group col-md-4 mb-3 mt-3">
                        <label class="faded-label" for="nama_wali" style="font-style: italic;">Nama Wali (Bila tidak ada orangtua)</label>
                        <input type="text" name="nama_wali" class="form-control @error('nama_wali') is-invalid @enderror" value="{{ old('nama_wali') }}" wire:model="nama_wali">
                        @error('nama_wali')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-8 mb-3 mt-3">
                        <label class="faded-label" for="alamat_wali" style="font-style: italic;">Alamat Wali</label>
                        <input type="text" name="alamat_wali" class="form-control @error('alamat_wali') is-invalid @enderror" value="{{ old('alamat_wali') }}" wire:model="alamat_wali">
                        @error('alamat_wali')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        @endif

        @if ($currentStep == 4)
        {{-- Step 4 --}}
        <div class="card-header text-white" style="background-color: #3D4465">
            <h4 class="text-white">STEP 4/6 - Riwayat Pendidikan</h4>
        </div>
        <div class="card-body">
            <div class="step-four">
                <div class="row text-dark">
                    <div class="form-group col-md-4 mb-3">
                        <label class="required-label faded-label" for="asal_sekolah" style="font-style: italic;">Asal Sekolah</label>
                        <input type="text" name="asal_sekolah" class="form-control @error('asal_sekolah') is-invalid @enderror" value="{{ old('asal_sekolah') }}" wire:model="asal_sekolah">
                        @error('asal_sekolah')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        <label class="required-label faded-label" for="jurusan_asal_sekolah" style="font-style: italic;">Jurusan</label>
                        <input type="text" name="jurusan_asal_sekolah" class="form-control @error('jurusan_asal_sekolah') is-invalid @enderror" value="{{ old('jurusan_asal_sekolah') }}" wire:model="jurusan_asal_sekolah">
                        @error('jurusan_asal_sekolah')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-5 mb-3">
                        <label class="faded-label" for="pengalaman_organisasi" style="font-style: italic;">Pengalaman Organisasi</label>
                        <input type="text" name="pengalaman_organisasi" class="form-control @error('pengalaman_organisasi') is-invalid @enderror" value="{{ old('pengalaman_organisasi') }}" wire:model="pengalaman_organisasi">
                        @error('pengalaman_organisasi')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        @endif

        @if ($currentStep == 5)
        {{-- Step 5 --}}
        <div class="card-header text-white" style="background-color: #3D4465">
            <h4 class="text-white">STEP 5/6 - Informasi Perkuliahan</h4>
        </div>
        <div class="card-body">
            <div class="step-five">
                <div class="row text-dark">
                    <div class="form-group col-md-3 mb-3">
                        <label class="required-label faded-label" for="prodi_id" style="font-style: italic;">Program Studi</label>
                            <select class="form-control @error('prodi_id') is-invalid @enderror" aria-label="Default select example" for="prodi_id" name="prodi_id" id="prodi_id" wire:model="prodi_id">
                                <option selected value="" style="font-style: italic;">-- Pilih Prodi --</option>
                                @foreach ($prodi as $p)
                                    <option value="{{ $p->id_prodi }}">{{ $p->nama_prodi }}</option>
                                @endforeach
                            </select>                               
                        @error('prodi_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        <label class="required-label faded-label" for="ukt" style="font-style: italic;">Uang Kuliah Tunggal</label>
                        <input type="number" name="ukt" class="form-control @error('ukt') is-invalid @enderror" value="{{ old('ukt') }}" wire:model="ukt">
                        @error('ukt')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        <label class="required-label faded-label" for="angkatan_id" style="font-style: italic;">Tahun Angkatan</label>
                            <select class="form-control @error('angkatan_id') is-invalid @enderror" aria-label="Default select example" for="angkatan_id" name="angkatan_id" id="angkatan_id" wire:model="angkatan_id">
                                <option selected value="" style="font-style: italic;">-- Pilih Tahun Angkatan --</option>
                                @foreach ($angkatan as $ta)
                                    <option value="{{ $ta->id_angkatan }}">{{ $ta->tahun_angkatan }}</option>
                                @endforeach
                            </select>                               
                        @error('angkatan_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        <label class="required-label faded-label" for="jenis_tinggal_di_cilacap" style="font-style: italic;">Jenis Tinggal di Cilacap</label>
                        <select name="jenis_tinggal_di_cilacap" class="form-control @error('jenis_tinggal_di_cilacap') is-invalid @enderror" wire:model="jenis_tinggal_di_cilacap">
                            <option selected value="" style="font-style: italic;">-- Pilih Jenis Tinggal --</option>
                            <option value="Rumah Orang Tua" @if(old('jenis_tinggal_di_cilacap') == 'Rumah Orangtua') selected @endif>Rumah Orangtua</option>
                            <option value="Wali" @if(old('jenis_tinggal_di_cilacap') == 'Wali') selected @endif>Wali</option>
                            <option value="Kost" @if(old('jenis_tinggal_di_cilacap') == 'Kost') selected @endif>Kost</option>
                            <option value="Panti Asuhan" @if(old('jenis_tinggal_di_cilacap') == 'Panti Asuhan') selected @endif>Panti Asuhan</option>
                            <option value="Asrama" @if(old('jenis_tinggal_di_cilacap') == 'Asrama') selected @endif>Asrama</option>
                            <option value="Lainnya" @if(old('jenis_tinggal_di_cilacap') == 'Lainnya') selected @endif>Lainnya</option>
                        </select>                                  
                        @error('jenis_tinggal_di_cilacap')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        <label class="required-label faded-label" for="alat_transportasi_ke_kampus" style="font-style: italic;">Alat Transportasi ke Kampus</label>
                        <select name="alat_transportasi_ke_kampus" class="form-control @error('alat_transportasi_ke_kampus') is-invalid @enderror" wire:model="alat_transportasi_ke_kampus">
                            <option selected value="" style="font-style: italic;">-- Pilih Alat Transportasi --</option>
                            <option value="Motor" @if(old('alat_transportasi_ke_kampus') == 'Motor') selected @endif>Motor</option>
                            <option value="Angkutan Umum" @if(old('alat_transportasi_ke_kampus') == 'Angkutan Umum') selected @endif>Angkutan Umum</option>
                            <option value="Jalan Kaki" @if(old('alat_transportasi_ke_kampus') == 'Jalan Kaki') selected @endif>Jalan Kaki</option>
                            <option value="Numpang Teman" @if(old('alat_transportasi_ke_kampus') == 'Numpang Teman') selected @endif>Numpang Teman</option>
                            <option value="Antar Jemput" @if(old('alat_transportasi_ke_kampus') == 'Antar Jemput') selected @endif>Antar Jemput</option>
                            <option value="Ojek" @if(old('alat_transportasi_ke_kampus') == 'Ojek') selected @endif>Ojek</option>
                            <option value="Lainnya" @if(old('alat_transportasi_ke_kampus') == 'Lainnya') selected @endif>Lainnya</option>
                        </select>                                  
                        @error('alat_transportasi_ke_kampus')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        <label class="faded-label" for="sumber_biaya_kuliah" style="font-style: italic;">Sumber Biaya Kuliah</label>
                        <input type="text" name="sumber_biaya_kuliah" class="form-control @error('sumber_biaya_kuliah') is-invalid @enderror" value="{{ old('sumber_biaya_kuliah') }}" wire:model="sumber_biaya_kuliah">
                        @error('sumber_biaya_kuliah')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        <label class="required-label faded-label" for="penerima_kartu_prasejahtera" style="font-style: italic;">Penerima Kartu Prasejahtera</label>
                        <select name="penerima_kartu_prasejahtera" class="form-control @error('penerima_kartu_prasejahtera') is-invalid @enderror" wire:model="penerima_kartu_prasejahtera">
                            <option selected value="" style="font-style: italic;">-- Pilih Status --</option>
                            <option value="Ya" @if(old('penerima_kartu_prasejahtera') == 'Ya') selected @endif>Ya</option>
                            <option value="Tidak" @if(old('penerima_kartu_prasejahtera') == 'Tidak') selected @endif>Tidak</option>
                        </select> 
                        @error('penerima_kartu_prasejahtera')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        @endif

        @if ($currentStep == 6)
        {{-- Step 6 --}}
        <div class="card-header text-white" style="background-color: #3D4465">
            <h4 class="text-white">STEP 6/6 - Status Dalam Keluarga</h4>
        </div>
        <div class="card-body">
            <div class="step-six">
                <div class="row text-dark">
                    <div class="form-group col-md-5 mb-3">
                        <label class="required-label faded-label" for="jumlah_tanggungan_keluarga_yang_masih_sekolah" style="font-style: italic;">Jumlah Tanggungan Keluarga Yang Masih Sekolah</label>
                        <input type="number" name="jumlah_tanggungan_keluarga_yang_masih_sekolah" class="form-control @error('jumlah_tanggungan_keluarga_yang_masih_sekolah') is-invalid @enderror" value="{{ old('jumlah_tanggungan_keluarga_yang_masih_sekolah') }}" wire:model="jumlah_tanggungan_keluarga_yang_masih_sekolah">
                        @error('jumlah_tanggungan_keluarga_yang_masih_sekolah')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        <label class="required-label faded-label" for="anak_ke" style="font-style: italic;">Anak Ke-</label>
                        <input type="number" name="anak_ke" class="form-control @error('anak_ke') is-invalid @enderror" value="{{ old('anak_ke') }}" wire:model="anak_ke">
                        @error('anak_ke')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        @endif

        <div class="action-button d-flex justify-content-between bg-white pt-2 pb-2">

        @if ($currentStep == 1)
        <div></div>
        @endif

        @if ($currentStep == 2 || $currentStep == 3 || $currentStep == 4 || $currentStep == 5 || $currentStep == 6)
        <button type="button" class="btn btn-md btn-secondary ml-4" wire:click="decreaseStep()">Kembali</button>
        @endif

        @if ($currentStep == 1 || $currentStep == 2 || $currentStep == 3 || $currentStep == 4 || $currentStep == 5)
        <button type="button" class="btn btn-md btn-success mr-4" wire:click="increaseStep()">Selanjutnya</button>
        @endif
        
        @if ($currentStep == 6)
        <button type="submit" class="btn btn-md btn-primary mr-4">Submit</button>
        @endif
        </div> 
    </form>
</div>