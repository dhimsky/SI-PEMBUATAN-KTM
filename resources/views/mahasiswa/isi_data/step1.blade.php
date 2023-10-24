@extends('layouts.main-layout')
@section('tittle', 'Mahasiswa')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header mb-3">
                    <h3>Data Pribadi</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('mahasiswa.isi_data.step1.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Add your form fields here for Step 1 (Data Pribadi) -->
                        <div class="row text-dark">
                            <div class="form-group col-md-3 mb-3">
                                <label class="required-label faded-label" for="nim" style="font-style: italic;">NIM</label>
                                <input type="number" name="nim" class="form-control @error('nim') is-invalid @enderror" value="{{ Auth::user()->nim }}" readonly>
                                @error('nim')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-3 mb-3">
                                <label class="required-label faded-label" for="nama_lengkap" style="font-style: italic;">Nama Lengkap</label>
                                <input type="text" name="nama_lengkap" class="form-control @error('nama_lengkap') is-invalid @enderror" value="{{ Auth::user()->username }}" readonly>
                                @error('nama_lengkap')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-3 mb-3">
                                <label class="required-label faded-label" for="nik" style="font-style: italic;">NIK</label>
                                <input type="number" name="nik" class="form-control @error('nik') is-invalid @enderror" value="{{ old('nik') }}" >
                                @error('nik')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-3 mb-3">
                                <label class="required-label faded-label" for="tempat_lahir" style="font-style: italic;">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror" value="{{ old('tempat_lahir') }}" >
                                @error('tempat_lahir')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-3 mb-3">
                                <label class="required-label faded-label" for="tanggal_lahir" style="font-style: italic;">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror" value="{{ old('tanggal_lahir') }}" >
                                @error('tanggal_lahir')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-3 mb-3">
                                <label class="required-label faded-label" for="jenis_kelamin" style="font-style: italic;">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror">
                                    <option disabled selected value="" style="font-style: italic;">-- Pilih Jenis Kelamin --</option>
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
                                <label class="required-label faded-label" for="agama" style="font-style: italic;">Agama</label>
                                <select name="agama" class="form-control @error('agama') is-invalid @enderror">
                                    <option disabled selected value="" style="font-style: italic;">-- Pilih Agama --</option>
                                    <option value="Islam" @if(old('agama') == 'Islam') selected @endif>Islam</option>
                                    <option value="Protestan" @if(old('agama') == 'Protestan') selected @endif>Protestan</option>
                                    <option value="Katolik" @if(old('agama') == 'Katolik') selected @endif>Katolik</option>
                                    <option value="Hindu" @if(old('agama') == 'Hindu') selected @endif>Hindu</option>
                                    <option value="Buddha" @if(old('agama') == 'Buddha') selected @endif>Buddha</option>
                                    <option value="Khonghucu" @if(old('agama') == 'Khonghucu') selected @endif>Khonghucu</option>
                                    <option value="Lainnya" @if(old('agama') == 'Lainnya') selected @endif>Lainnya</option>
                                </select>
                                @error('agama')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-3 mb-3">
                                <label class="required-label faded-label" for="email" style="font-style: italic;">Email</label>
                                <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" >
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-3 mb-3">
                                <label class="required-label faded-label" for="nohp" style="font-style: italic;">Nomor Hp</label>
                                <input type="number" name="nohp" class="form-control @error('nohp') is-invalid @enderror" value="{{ old('nohp') }}" >
                                @error('nohp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4 mb-3">
                                <label class="required-label faded-label" for="pas_foto" style="font-style: italic;">Pas Foto</label>
                                <div class="custom-file">
                                    <input type="file" name="pas_foto" class="custom-file-input @error('pas_foto') is-invalid @enderror" id="pas_foto">
                                    <label class="custom-file-label" for="pas_foto">Pilih file</label>
                                    @error('pas_foto')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="text-danger mt-3" style="font-style: italic">
                            <span>*Data yang dimasukan bisa anda ubah kembali setelah data dikirim!</span>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Selanjutnya</button>
                        </div>                    
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // Cek apakah ada file foto yang disimpan di session saat halaman dimuat
    document.addEventListener('DOMContentLoaded', function () {
        var fileName = "{{ session('foto_nama') }}";
        if (fileName) {
            var input = document.getElementById('pas_foto');
            var label = input.nextElementSibling;
            label.innerText = fileName;
        }
    });

    // Ubah label file ketika ada file yang dipilih
    document.getElementById('pas_foto').addEventListener('change', function (event) {
        var input = event.srcElement;
        var fileName = input.files[0].name;
        var label = input.nextElementSibling;
        label.innerText = fileName;

        // Simpan nama file foto ke session
        var formData = new FormData();
        formData.append('pas_foto', input.files[0]);
        fetch('/simpan-foto', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: formData
        });
    });
</script>
@endsection