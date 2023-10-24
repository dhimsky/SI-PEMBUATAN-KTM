@extends('layouts.main-layout')
@section('tittle', 'Mahasiswa')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header mb-3">
                    <h3>Alamat</h3>
                </div>

                <div class="card-body">
                    <form action="{{ route('mahasiswa.isi_data.step2.store') }}" method="POST">
                        @csrf

                        <!-- Add your form fields here for Step 2 (Alamat) -->
                        <div class="row text-dark">

                            <!-- Provinsi Dropdown -->
                            <div class="form-group col-md-3 mb-3">
                                <label class="required-label faded-label" for="provinsi" style="font-style: italic;">Provinsi</label>
                                <select class="form-control @error('provinsi') is-invalid @enderror" name="provinsi" id="provinsi">
                                    <option disabled selected value="">Pilih Provinsi</option>
                                    @foreach ($provinsi as $p)
                                        <option value="{{ $p->kode }}">{{ mb_convert_case($p->nama, MB_CASE_TITLE) }}</option>
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
                                <select class="form-control @error('kabupaten') is-invalid @enderror" aria-label="Default select example" name="kabupaten" id="kabupaten">
                                    <option disabled selected value="">Pilih Kabupaten/Kota</option>
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
                                <select class="form-control @error('kecamatan') is-invalid @enderror" aria-label="Default select example" name="kecamatan" id="kecamatan">
                                    <option disabled selected value="">Pilih Kecamatan</option>
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
                                <select class="form-control @error('desa_kelurahan') is-invalid @enderror" aria-label="Default select example" name="desa_kelurahan" id="desa_kelurahan">
                                    <option disabled selected value="">Pilih Desa/Kelurahan</option>
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
                                <input type="number" name="rt" class="form-control @error('rt') is-invalid @enderror" value="{{ old('rt') }}" >
                                @error('rt')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- RW Input -->
                            <div class="form-group col-md-2 mb-3">
                                <label class="required-label faded-label" for="rw" style="font-style: italic;">RW</label>
                                <input type="number" name="rw" class="form-control @error('rw') is-invalid @enderror" value="{{ old('rw') }}" >
                                @error('rw')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Alamat Jalan Input -->
                            <div class="form-group col-md-5 mb-3">
                                <label class="required-label faded-label" for="alamat_jalan" style="font-style: italic;">Jalan</label>
                                <input type="text" name="alamat_jalan" class="form-control @error('alamat_jalan') is-invalid @enderror" value="{{ old('alamat_jalan') }}" >
                                @error('alamat_jalan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>
                        <div class="text-danger mt-3" style="font-style: italic">
                            <span>*Data yang dimasukkan bisa Anda ubah kembali setelah data dikirim!</span>
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
