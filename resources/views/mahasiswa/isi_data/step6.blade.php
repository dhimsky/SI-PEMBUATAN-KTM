@extends('layouts.main-layout')
@section('tittle', 'Daftar')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header mb-3">
                    <h3>Status Dalam Keluarga</h3>
                </div>

                <div class="card-body">
                    <form action="{{ route('mahasiswa.isi_data.step6.store') }}" method="POST">
                        @csrf
                        <!-- Add your form fields here for Step 2 (Alamat) -->
                        <div class="row text-dark">
                            <div class="form-group col-md-5 mb-3">
                                <label class="required-label faded-label" for="jumlah_tanggungan_keluarga_yang_masih_sekolah" style="font-style: italic;">Jumlah Tanggungan Keluarga Yang Masih Sekolah</label>
                                <input type="number" name="jumlah_tanggungan_keluarga_yang_masih_sekolah" class="form-control @error('jumlah_tanggungan_keluarga_yang_masih_sekolah') is-invalid @enderror" value="{{ old('jumlah_tanggungan_keluarga_yang_masih_sekolah') }}" >
                                @error('jumlah_tanggungan_keluarga_yang_masih_sekolah')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-3 mb-3">
                                <label class="required-label faded-label" for="anak_ke" style="font-style: italic;">Anak Ke-</label>
                                <input type="number" name="anak_ke" class="form-control @error('anak_ke') is-invalid @enderror" value="{{ old('anak_ke') }}" >
                                @error('anak_ke')
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
                            <button type="submit" class="btn btn-primary">Kirim</button>
                        </div>  
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection