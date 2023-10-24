@extends('layouts.main-layout')
@section('tittle', 'Daftar')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header mb-3">
                    <h3>Pendidikan Sebelumnya</h3>
                </div>

                <div class="card-body">
                    <form action="{{ route('mahasiswa.isi_data.step4.store') }}" method="POST">
                        @csrf

                        <!-- Add your form fields here for Step 2 (Alamat) -->
                        <div class="row text-dark">
                            <div class="form-group col-md-4 mb-3">
                                <label class="required-label faded-label" for="asal_sekolah" style="font-style: italic;">Asal Sekolah</label>
                                <input type="text" name="asal_sekolah" class="form-control @error('asal_sekolah') is-invalid @enderror" value="{{ old('asal_sekolah') }}" >
                                @error('asal_sekolah')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-3 mb-3">
                                <label class="required-label faded-label" for="jurusan_asal_sekolah" style="font-style: italic;">Jurusan</label>
                                <input type="text" name="jurusan_asal_sekolah" class="form-control @error('jurusan_asal_sekolah') is-invalid @enderror" value="{{ old('jurusan_asal_sekolah') }}" >
                                @error('jurusan_asal_sekolah')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-5 mb-3">
                                <label class="faded-label" for="pengalaman_organisasi" style="font-style: italic;">Pengalaman Organisasi</label>
                                <input type="text" name="pengalaman_organisasi" class="form-control @error('pengalaman_organisasi') is-invalid @enderror" value="{{ old('pengalaman_organisasi') }}" >
                                @error('pengalaman_organisasi')
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