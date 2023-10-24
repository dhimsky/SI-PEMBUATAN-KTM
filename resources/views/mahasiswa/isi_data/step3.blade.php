@extends('layouts.main-layout')
@section('tittle', 'Mahasiswa')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header mb-3">
                    <h3>Orangtua Kandung & Wali</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('mahasiswa.isi_data.step3.store') }}" method="POST">
                        @csrf

                        <!-- Add your form fields here for Step 2 (Alamat) -->
                        <div class="row text-dark">
                            <div class="form-group col-md-3 mb-3">
                                <label class="required-label faded-label" for="nama_ayah" style="font-style: italic;">Nama Ayah</label>
                                <input type="text" name="nama_ayah" class="form-control @error('nama_ayah') is-invalid @enderror" value="{{ old('nama_ayah') }}" >
                                @error('nama_ayah')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-3 mb-3">
                                <label class="faded-label" for="nik_ayah" style="font-style: italic;">NIK Ayah</label>
                                <input type="number" name="nik_ayah" class="form-control @error('nik_ayah') is-invalid @enderror" value="{{ old('nik_ayah') }}" >
                                @error('nik_ayah')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-3 mb-3">
                                <label class="faded-label" for="tempat_lahir_ayah" style="font-style: italic;">Tempat Lahir Ayah</label>
                                <input type="text" name="tempat_lahir_ayah" class="form-control @error('tempat_lahir_ayah') is-invalid @enderror" value="{{ old('tempat_lahir_ayah') }}" >
                                @error('tempat_lahir_ayah')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-3 mb-3">
                                <label class="faded-label" for="tanggal_lahir_ayah" style="font-style: italic;">Tanggal Lahir Ayah</label>
                                <input type="date" name="tanggal_lahir_ayah" class="form-control @error('tanggal_lahir_ayah') is-invalid @enderror" value="{{ old('tanggal_lahir_ayah') }}" >
                                @error('tanggal_lahir_ayah')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-3 mb-3">
                                <label class="faded-label" for="pendidikan_ayah" style="font-style: italic;">Pendidikan Ayah</label>
                                <input type="text" name="pendidikan_ayah" class="form-control @error('pendidikan_ayah') is-invalid @enderror" value="{{ old('pendidikan_ayah') }}" >
                                @error('pendidikan_ayah')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-3 mb-3">
                                <label class="faded-label" for="pekerjaan_ayah" style="font-style: italic;">Pekerjaan Ayah</label>
                                <input type="text" name="pekerjaan_ayah" class="form-control @error('pekerjaan_ayah') is-invalid @enderror" value="{{ old('pekerjaan_ayah') }}" >
                                @error('pekerjaan_ayah')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-3 mb-3">
                                <label class="faded-label" for="penghasilan_ayah" style="font-style: italic;">Penghasilan Ayah</label>
                                <input type="number" name="penghasilan_ayah" class="form-control @error('penghasilan_ayah') is-invalid @enderror" value="{{ old('penghasilan_ayah') }}" >
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
                                <label class="required-label faded-label" for="nama_ibu" style="font-style: italic;">Nama ibu</label>
                                <input type="text" name="nama_ibu" class="form-control @error('nama_ibu') is-invalid @enderror" value="{{ old('nama_ibu') }}" >
                                @error('nama_ibu')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-3 mb-3">
                                <label class="faded-label" for="nik_ibu" style="font-style: italic;">NIK ibu</label>
                                <input type="number" name="nik_ibu" class="form-control @error('nik_ibu') is-invalid @enderror" value="{{ old('nik_ibu') }}" >
                                @error('nik_ibu')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-3 mb-3">
                                <label class="faded-label" for="tempat_lahir_ibu" style="font-style: italic;">Tempat Lahir ibu</label>
                                <input type="text" name="tempat_lahir_ibu" class="form-control @error('tempat_lahir_ibu') is-invalid @enderror" value="{{ old('tempat_lahir_ibu') }}" >
                                @error('tempat_lahir_ibu')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-3 mb-3">
                                <label class="faded-label" for="tanggal_lahir_ibu" style="font-style: italic;">Tanggal Lahir ibu</label>
                                <input type="date" name="tanggal_lahir_ibu" class="form-control @error('tanggal_lahir_ibu') is-invalid @enderror" value="{{ old('tanggal_lahir_ibu') }}" >
                                @error('tanggal_lahir_ibu')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-3 mb-3">
                                <label class="faded-label" for="pendidikan_ibu" style="font-style: italic;">Pendidikan ibu</label>
                                <input type="text" name="pendidikan_ibu" class="form-control @error('pendidikan_ibu') is-invalid @enderror" value="{{ old('pendidikan_ibu') }}" >
                                @error('pendidikan_ibu')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-3 mb-3">
                                <label class="faded-label" for="pekerjaan_ibu" style="font-style: italic;">Pekerjaan ibu</label>
                                <input type="text" name="pekerjaan_ibu" class="form-control @error('pekerjaan_ibu') is-invalid @enderror" value="{{ old('pekerjaan_ibu') }}" >
                                @error('pekerjaan_ibu')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-3 mb-3">
                                <label class="faded-label" for="penghasilan_ibu" style="font-style: italic;">Penghasilan ibu</label>
                                <input type="number" name="penghasilan_ibu" class="form-control @error('penghasilan_ibu') is-invalid @enderror" value="{{ old('penghasilan_ibu') }}" >
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
                                <input type="text" name="nama_wali" class="form-control @error('nama_wali') is-invalid @enderror" value="{{ old('nama_wali') }}" >
                                @error('nama_wali')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-8 mb-3 mt-3">
                                <label class="faded-label" for="alamat_wali" style="font-style: italic;">Alamat Wali</label>
                                <input type="text" name="alamat_wali" class="form-control @error('alamat_wali') is-invalid @enderror" value="{{ old('alamat_wali') }}" >
                                @error('alamat_wali')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="text-danger mt-3" style="font-style: italic">
                            <span>*Data yang dimasukan bisa anda ubah kembali setelah data dikirim!</span>
                        </div>
                        <!-- Add other form fields for Step 2 -->
                        {{-- <a class="btn btn-secondary" onclick="window.history.back()">Back</a> --}}
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Selanjutnya</button>
                        </div>  
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection