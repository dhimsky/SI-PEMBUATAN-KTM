@extends('layouts.main-layout')
@section('tittle', 'Daftar')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header mb-3">
                    <h3>Perkuliahan</h3>
                </div>

                <div class="card-body">
                    <form action="{{ route('mahasiswa.isi_data.step5.store') }}" method="POST">
                        @csrf

                        <!-- Add your form fields here for Step 2 (Alamat) -->
                        <div class="row text-dark">
                            <div class="form-group col-md-3 mb-3">
                                <label class="required-label faded-label" for="prodi_id" style="font-style: italic;">Program Studi</label>
                                <select class="form-control @error('prodi_id') is-invalid @enderror" aria-label="Default select example" for="prodi_id" name="prodi_id" id="prodi_id" >
                                    <option disabled selected value="" style="font-style: italic;">-- Pilih Prodi --</option>
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
                                <label class="required-label faded-label" for="ukt" style="font-style: italic;">Uang Kuliah Tunggal (UKT)</label>
                                <input type="number" name="ukt" class="form-control @error('ukt') is-invalid @enderror" value="{{ old('ukt') }}" >
                                @error('ukt')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-3 mb-3">
                                <label class="required-label faded-label" for="jenis_tinggal_di_cilacap" style="font-style: italic;">Jenis Tinggal di Cilacap</label>
                                <select name="jenis_tinggal_di_cilacap" class="form-control @error('jenis_tinggal_di_cilacap') is-invalid @enderror">
                                    <option disabled selected value="" style="font-style: italic;">-- Pilih Jenis Tinggal --</option>
                                    <option value="Rumah Orangtua" @if(old('jenis_tinggal_di_cilacap') == 'Rumah Orangtua') selected @endif>Rumah Orangtua</option>
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
                                <select name="alat_transportasi_ke_kampus" class="form-control @error('alat_transportasi_ke_kampus') is-invalid @enderror">
                                    <option disabled selected value="" style="font-style: italic;">-- Pilih Alat Transportasi --</option>
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
                                <input type="text" name="sumber_biaya_kuliah" class="form-control @error('sumber_biaya_kuliah') is-invalid @enderror" value="{{ old('sumber_biaya_kuliah') }}" >
                                @error('sumber_biaya_kuliah')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-3 mb-3">
                                <label class="required-label faded-label" for="penerima_kartu_prasejahtera" style="font-style: italic;">Penerima Kartu Prasejahtera</label>
                                <select name="penerima_kartu_prasejahtera" class="form-control @error('penerima_kartu_prasejahtera') is-invalid @enderror">
                                    <option disabled selected value="" style="font-style: italic;">-- Pilih Status --</option>
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