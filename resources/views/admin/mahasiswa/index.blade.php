@extends('layouts.main-layout')
@section('tittle', 'Data Mahasiswa')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Tabel Data Mahasiswa</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('data-mahasiswa.index') }}" method="GET">
                <div class="row mb-3">
                        <div class="col-md-3 mb-2">
                            <select id="angkatan_id" name="angkatan_id" class="form-control">
                                <option selected disabled value="" style="font-style: italic;">Semua Angkatan</option>
                                @foreach ($angkatan as $ta)
                                <option value="{{ $ta->id_angkatan }}">{{ $ta->tahun_angkatan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 mb-2">
                            <select id="prodi_id" name="prodi_id" class="form-control">
                                <option selected disabled value="" style="font-style: italic;">Semua Prodi</option>
                                @foreach ($prodi as $pr)
                                <option value="{{ $pr->id_prodi }}">{{ $pr->nama_prodi }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-1">
                            <button id="btnFilter" class="btn btn-whatsapp"><i class="fa fa-search"></i></button>
                        </div>
                        <div class="col-md-4 text-right mb-3">
                            <a href="" class="btn btn-whatsapp" data-toggle="modal" data-target=".modalExport">
                            <i class="fa fa-cloud-download"></i></a>
                        </div>
                    </div>
                </form>
                <div class="table-responsive">
                    <table id="example" class="display text-dark" style="min-width: 845px">
                        <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>Foto</th>
                                <th>NIM</th>
                                <th>Nama Lengkap</th>
                                <th>Prodi</th>
                                <th>Angkatan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="table-bordered">
                            @foreach ($mahasiswa as $m)
                            <tr class="text-center">
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    @if ($m->pas_foto)
                                    <a data-toggle="modal" data-target="#fotoMhs{{ $m->nim }}">
                                        <img src="{{ asset('storage/pas_foto/' . $m->pas_foto) }}" alt="Foto Mahasiswa" class="img-fluid img-3x4 rounded" style="max-width: 50px;">
                                    </a>
                                    @else
                                    Foto tidak tersedia
                                    @endif
                                </td>                            
                                <td>{{ $m->nim }}</td>
                                <td>{{ $m->nama_lengkap }}</td>
                                <td>{{ $m->prodi->nama_prodi }}</td>
                                <td>{{ $m->angkatan->tahun_angkatan }}</td>
                                <td>
                                    <a href="{{route('print-id', $m->nim)}}" target="_blank"
                                        class="btn btn-info" title="Cetak kartu">
                                    <i class="fa fa-print"></i></a>
                                    <a href="" class="btn btn-info" data-toggle="modal" data-target="#detailMahasiswa{{ $m->nim }}" title="Lihat detail">
                                        <i class="fa fa-info"></i>
                                    </a>
                                    @if (Auth::user()->role_id == '1')
                                    <a href="" class="btn btn-warning" data-toggle="modal" data-target="#editData{{ $m->nim }}" title="Edit data">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a href="{{ route('data-mahasiswa.destroy', $m->nim) }}" class="fa fa-trash btn btn-danger" data-confirm-delete="true" title="Hapus data"></a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </div>
                </table>
            </div>
        </div>
    </div>
</div>

@if (Auth::user()->role_id == '1')
<button class="fa fa-plus wa_btn whatsapp" data-toggle="modal" data-target="#tambahMahasiswa" title="Tambah mahasiswa"></button>
@endif

<div class="modal fade" id="tambahMahasiswa">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Mahasiswa</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('data-mahasiswa.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row mb-2 ml-2 mr-2">
                        <div class="col-md-3">
                            <img id="previewImg" src="{{ asset('/images/profile.jpeg') }}" alt="" class="img-fluid img-3x4 rounded">
                        </div>
                        <div class="col-md-9">
                            <div class="form-group row mb-2">
                                <div class="col-sm-4 d-flex align-items-center">
                                    <label for="nim" class="col-form-label faded-label required-label">NIM</label>
                                    <i class="fa fa-question-circle ml-1" tabindex="0" data-toggle="popover" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-title="Nomor Induk Mahasiswa"></i>
                                </div>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control @error('nim') is-invalid @enderror" id="nim" name="nim" placeholder="Masukan NIM" value="{{ old('nim') }}">
                                    @error('nim')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <div class="col-sm-4 d-flex align-items-center">
                                    <label for="nama_lengkap" class="col-form-label faded-label required-label" >Nama Lengkap</label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" id="nama_lengkap" name="nama_lengkap" placeholder="Masukan nama lengkap" value="{{ old('nama_lengkap') }}">
                                    @error('nama_lengkap')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <div class="col-sm-4 d-flex align-items-center">
                                    <label for="nik" class=" col-form-label faded-label required-label" >NIK</label>
                                    <i class="fa fa-question-circle ml-1" tabindex="0" data-toggle="popover" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-title="Sesuai KTP"></i>
                                </div>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control @error('nik') is-invalid @enderror" id="nik" name="nik" placeholder="Masukan NIK" value="{{ old('nik') }}">
                                    @error('nik')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <div class="col-sm-4 d-flex align-items-center">
                                    <label for="jenis_kelamin" class="col-form-label faded-label required-label" >Jenis Kelamin</label>
                                </div>
                                <div class="col-sm-8">
                                    <select class="form-control @error('jenis_kelamin') is-invalid @enderror" id="jenis_kelamin" name="jenis_kelamin">
                                        <option selected disabled value="" style="font-style: italic;">Pilih Jenis Kelamin</option>
                                        <option value="Laki-laki" @if(old('jenis_kelamin') == 'Laki-laki') selected @endif>Laki-laki</option>
                                        <option value="Perempuan" @if(old('jenis_kelamin') == 'Perempuan') selected @endif>Perempuan</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mb-2 ml-2 mr-2">
                        <div class="col-sm-4">
                            <div class="custom-file" onclick="triggerInputFile()">
                                <label class="custom-file-label" for="input_pas_foto" id="label_pas_foto">
                                        <p class="text-muted" id="uploaded-foto-label" style="display: none;"></p>
                                        <p class="text-muted" id="upload-foto-label">Upload Foto</p>
                                </label>
                                <input type="file" name="pas_foto" class="custom-file-input @error('pas_foto') is-invalid @enderror" id="input_pas_foto" onchange="updateLabel(this)">
                                @error('pas_foto')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mb-2 ml-2 mr-2">
                        <label for="tempat_lahir" class="col-sm-5 col-form-label faded-label required-label" >Tempat Lahir</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir" name="tempat_lahir" placeholder="Masukan tempat lahir" value="{{ old('tempat_lahir') }}">
                            @error('tempat_lahir')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2 mr-2 ml-2">
                        <label for="tanggal_lahir" class="col-sm-5 col-form-label faded-label required-label" >Tanggal Lahir</label>
                        <div class="col-sm-7">
                            <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
                            @error('tanggal_lahir')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2 mr-2 ml-2">
                        <label for="agama_id" class="col-sm-5 col-form-label faded-label required-label" >Agama</label>
                        <div class="col-sm-7">
                            <select class="form-control @error('agama_id') is-invalid @enderror" id="agama_id" name="agama_id" for="agama_id">
                                <option selected disabled value="" style="font-style: italic;">Pilih Agama</option>
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
                    </div>
                    <div class="form-group row mb-2 mr-2 ml-2">
                        <label for="email" class="col-sm-5 col-form-label faded-label required-label" >Email</label>
                        <div class="col-sm-7">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Masukan email" value="{{ old('email') }}">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2 mr-2 ml-2">
                        <label for="nohp" class="col-sm-5 col-form-label faded-label required-label" >Nomor HP</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control @error('nohp') is-invalid @enderror" id="nohp" name="nohp" placeholder="Masukan No. Hp" value="{{ old('nohp') }}">
                            @error('nohp')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2 mr-2 ml-2">
                        <label for="provinsi" class="col-sm-5 col-form-label faded-label required-label" >Provinsi</label>
                        <div class="col-sm-7">
                            <select class="form-control @error('provinsi') is-invalid @enderror" aria-label="Default select example" name="provinsi" id="provinsiadd" >
                                <option selected disabled value="" style="font-style: italic;">Pilih Provinsi</option>
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
                    </div>
                    <div class="form-group row mb-2 mr-2 ml-2">
                        <label for="kabupaten" class="col-sm-5 col-form-label faded-label required-label" >Kabupaten</label>
                        <div class="col-sm-7">
                            <select class="form-control @error('kabupaten') is-invalid @enderror" aria-label="Default select example" name="kabupaten" id="kabupatenadd" >
                                <option selected disabled value="" style="font-style: italic;">Pilih Kabupaten/Kota</option>
                                @if ($kab)
                                    <option value="{{ $m->kabupaten }}">{{ mb_convert_case($kab, MB_CASE_TITLE) }}</option>
                                @else
                                    <option disabled>Tidak ada data kabupaten</option>
                                @endif
                                {{-- <option value="{{ $m->kabupaten }}">{{ mb_convert_case($kab, MB_CASE_TITLE) }}</option> --}}
                            </select>                               
                            @error('kabupaten')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2 mr-2 ml-2">
                        <label for="kecamatan" class="col-sm-5 col-form-label faded-label required-label" >Kecamatan</label>
                        <div class="col-sm-7">
                            <select class="form-control @error('kecamatan') is-invalid @enderror" aria-label="Default select example" name="kecamatan" id="kecamatanadd" >
                                <option selected disabled value="" style="font-style: italic;">Pilih Kecamatan</option>
                                @if ($kec)
                                    <option value="{{ $m->kecamatan }}">{{ $kec }}</option>
                                @else
                                    <option disabled>Tidak ada data kabupaten</option>
                                @endif
                                {{-- <option value="{{ $m->kecamatan }}">{{ $kec }}</option> --}}
                            </select>                               
                            @error('kecamatan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2 mr-2 ml-2">
                        <label for="desa_kelurahan" class="col-sm-5 col-form-label faded-label required-label" >Desa/Kelurahan</label>
                        <div class="col-sm-7">
                            <select class="form-control @error('desa_kelurahan') is-invalid @enderror" aria-label="Default select example" name="desa_kelurahan" id="desa_kelurahanadd" >
                                <option selected disabled value="" style="font-style: italic;">Pilih Desa/Kelurahan</option>
                                @if ($ds)
                                    <option value="{{ $m->desa_kelurahan }}">{{ $ds }}</option>
                                @else
                                    <option disabled>Tidak ada data kabupaten</option>
                                @endif
                                {{-- <option value="{{ $m->desa_kelurahan }}">{{ $ds }}</option> --}}
                            </select>
                            @error('desa_kelurahan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2 mr-2 ml-2">
                        <label for="rt" class="col-sm-5 col-form-label faded-label required-label" >RT</label>
                        <div class="col-sm-7">
                            <input type="number" class="form-control @error('rt') is-invalid @enderror" id="rt" name="rt" placeholder="Masukan RT" value="{{ old('rt') }}">
                            @error('rt')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2 mr-2 ml-2">
                        <label for="rw" class="col-sm-5 col-form-label faded-label required-label" >RW</label>
                        <div class="col-sm-7">
                            <input type="number" class="form-control @error('rw') is-invalid @enderror" id="rw" name="rw" placeholder="Masukan RW" value="{{ old('rw') }}">
                            @error('rw')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2 mr-2 ml-2">
                        <div class="col-sm-5 d-flex align-items-center">
                            <label for="alamat_jalan" class=" col-form-label faded-label required-label" >Alamat Jalan</label>
                            <i class="fa fa-question-circle ml-1" tabindex="0" data-toggle="popover" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-title="Contoh: Jl. Melati No.3"></i>
                        </div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control @error('alamat_jalan') is-invalid @enderror" id="alamat_jalan" name="alamat_jalan" placeholder="Masukan jalan" value="{{ old('alamat_jalan') }}">
                            @error('alamat_jalan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2 mr-2 ml-2">
                        <label for="nama_ayah" class="col-sm-5 col-form-label faded-label required-label" >Nama Ayah</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control @error('nama_ayah') is-invalid @enderror" id="nama_ayah" name="nama_ayah" placeholder="Masukan nama ayah kandung" value="{{ old('nama_ayah') }}">
                            @error('nama_ayah')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2 mr-2 ml-2">
                        <div class="col-sm-5 d-flex align-items-center">
                            <label for="nik_ayah" class="col-form-label faded-label " >NIK Ayah</label>
                            <i class="fa fa-question-circle ml-1" tabindex="0" data-toggle="popover" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-title="Sesuai KTP ayah"></i>
                        </div>
                        <div class="col-sm-7">
                            <input type="number" class="form-control @error('nik_ayah') is-invalid @enderror" id="nik_ayah" name="nik_ayah" placeholder="Masukan NIK ayah" value="{{ old('nik_ayah') }}">
                            @error('nik_ayah')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2 mr-2 ml-2">
                        <label for="tempat_lahir_ayah" class="col-sm-5 col-form-label faded-label " >Tempat Lahir Ayah</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control @error('tempat_lahir_ayah') is-invalid @enderror" id="tempat_lahir_ayah" name="tempat_lahir_ayah" placeholder="Masukan tempat lahir ayah" value="{{ old('tempat_lahir_ayah') }}">
                            @error('tempat_lahir_ayah')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2 mr-2 ml-2">
                        <label for="tanggal_lahir_ayah" class="col-sm-5 col-form-label faded-label " >Tanggal Lahir Ayah</label>
                        <div class="col-sm-7">
                            <input type="date" class="form-control @error('tanggal_lahir_ayah') is-invalid @enderror" id="tanggal_lahir_ayah" name="tanggal_lahir_ayah" value="{{ old('tanggal_lahir_ayah') }}">
                            @error('tanggal_lahir_ayah')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2 mr-2 ml-2">
                        <div class="col-sm-5 d-flex align-items-center">
                            <label for="pendidikan_ayah" class="col-form-label faded-label " >Pendidikan Terakhir Ayah</label>
                            <i class="fa fa-question-circle ml-1" tabindex="0" data-toggle="popover" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-title="Contoh: SLTP, SLTA, D3, S1, dsb."></i>
                        </div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control @error('pendidikan_ayah') is-invalid @enderror" id="pendidikan_ayah" name="pendidikan_ayah" placeholder="Masukan pendidikan terakhir ayah" value="{{ old('pendidikan_ayah') }}">
                            @error('pendidikan_ayah')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2 mr-2 ml-2">
                        <label for="pekerjaan_ayah" class="col-sm-5 col-form-label faded-label " >Pekerjaan Ayah</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control @error('pekerjaan_ayah') is-invalid @enderror" id="pekerjaan_ayah" name="pekerjaan_ayah" placeholder="Masukan pekerjaan ayah" value="{{ old('pekerjaan_ayah') }}">
                            @error('pekerjaan_ayah')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2 mr-2 ml-2">
                        <label for="penghasilan_ayah" class="col-sm-5 col-form-label faded-label " >Penghasilan Ayah</label>
                        <div class="col-sm-7">
                            <select class="form-control @error('penghasilan_ayah') is-invalid @enderror" id="penghasilan_ayah" name="penghasilan_ayah">
                                <option selected disabled value="" style="font-style: italic;">Pilih Penghasilan</option>
                                <option value="< 1.000.000" >&lt; 1.000.000</option>
                                <option value="1.000.000 - 2.000.000" >1.000.000 - 2.000.000</option>
                                <option value="2.000.000 - 3.000.000" >2.000.000 - 3.000.000</option>
                                <option value="3.000.000 - 4.000.000" >3.000.000 - 4.000.000</option>
                                <option value=">5.000.000" >&gt; 5.000.000</option>
                            </select>
                            @error('penghasilan_ayah')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2 mr-2 ml-2">
                        <label for="nama_ibu" class="col-sm-5 col-form-label faded-label required-label" >Nama Ibu</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control @error('nama_ibu') is-invalid @enderror" id="nama_ibu" name="nama_ibu" placeholder="Masukan nama ibu kandung" value="{{ old('nama_ibu') }}">
                            @error('nama_ibu')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2 mr-2 ml-2">
                        <div class="col-sm-5 d-flex align-items-center">
                            <label for="nik_ibu" class="col-form-label faded-label" >NIK Ibu</label>
                            <i class="fa fa-question-circle ml-1" tabindex="0" data-toggle="popover" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-title="Sesuai KTP ibu"></i>
                        </div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control @error('nik_ibu') is-invalid @enderror" id="nik_ibu" name="nik_ibu" placeholder="Masukan NIK ibu" value="{{ old('nik_ibu') }}">
                            @error('nik_ibu')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2 mr-2 ml-2">
                        <label for="tempat_lahir_ibu" class="col-sm-5 col-form-label faded-label" >Tempat Lahir Ibu</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control @error('tempat_lahir_ibu') is-invalid @enderror" id="tempat_lahir_ibu" name="tempat_lahir_ibu" placeholder="Masukan tempat lahir ibu" value="{{ old('tempat_lahir_ibu') }}">
                            @error('tempat_lahir_ibu')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2 mr-2 ml-2">
                        <label for="tanggal_lahir_ibu" class="col-sm-5 col-form-label faded-label" >Tanggal Lahir Ibu</label>
                        <div class="col-sm-7">
                            <input type="date" class="form-control @error('tanggal_lahir_ibu') is-invalid @enderror" id="tanggal_lahir_ibu" name="tanggal_lahir_ibu" value="{{ old('tanggal_lahir_ibu') }}">
                            @error('tanggal_lahir_ibu')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2 mr-2 ml-2">
                        <div class="col-sm-5 d-flex align-items-center">
                            <label for="pendidikan_ibu" class="col-form-label faded-label" >Pendidikan Terakhir Ibu</label>
                            <i class="fa fa-question-circle ml-1" tabindex="0" data-toggle="popover" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-title="Contoh: SLTP, SLTA, D3, S1, dsb."></i>
                        </div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control @error('pendidikan_ibu') is-invalid @enderror" id="pendidikan_ibu" name="pendidikan_ibu" placeholder="Masukan pendidikan terakhir ibu" value="{{ old('pendidikan_ibu') }}">
                            @error('pendidikan_ibu')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2 mr-2 ml-2">
                        <label for="pekerjaan_ibu" class="col-sm-5 col-form-label faded-label" >Pekerjaan Ibu</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control @error('pekerjaan_ibu') is-invalid @enderror" id="pekerjaan_ibu" name="pekerjaan_ibu" placeholder="Masukan pekerjaan ibu" value="{{ old('pekerjaan_ibu') }}">
                            @error('pekerjaan_ibu')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2 mr-2 ml-2">
                        <label for="penghasilan_ibu" class="col-sm-5 col-form-label faded-label" >Penghasilan Ibu</label>
                        <div class="col-sm-7">
                            <select class="form-control @error('penghasilan_ibu') is-invalid @enderror" id="penghasilan_ibu" name="penghasilan_ibu">
                                <option selected disabled value="" style="font-style: italic;">Pilih Penghasilan</option>
                                <option value="< 1.000.000" >&lt; 1.000.000</option>
                                <option value="1.000.000 - 2.000.000" >1.000.000 - 2.000.000</option>
                                <option value="2.000.000 - 3.000.000">2.000.000 - 3.000.000</option>
                                <option value="3.000.000 - 4.000.000" >3.000.000 - 4.000.000</option>
                                <option value=">5.000.000"  >&gt; 5.000.000</option>
                            </select>
                            @error('penghasilan_ibu')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2 mr-2 ml-2">
                        <label for="nama_wali" class="col-sm-5 col-form-label faded-label" >Nama Wali</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control @error('nama_wali') is-invalid @enderror" id="nama_wali" name="nama_wali" placeholder="Masukan nama wali" value="{{ old('nama_wali') }}">
                            @error('nama_wali')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2 mr-2 ml-2">
                        <label for="alamat_wali" class="col-sm-5 col-form-label faded-label" >Alamat Wali</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control @error('alamat_wali') is-invalid @enderror" id="alamat_wali" name="alamat_wali" placeholder="Masukan alamat wali" value="{{ old('alamat_wali') }}">
                            @error('alamat_wali')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2 mr-2 ml-2">
                        <label for="asal_sekolah" class="col-sm-5 col-form-label faded-label required-label" >Asal Sekolah</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control @error('asal_sekolah') is-invalid @enderror" id="asal_sekolah" name="asal_sekolah" placeholder="Masukan asal sekolah mahasiswa" value="{{ old('asal_sekolah') }}">
                            @error('asal_sekolah')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2 mr-2 ml-2">
                        <div class="col-sm-5 d-flex align-items-center">
                            <label for="ukt" class="col-form-label faded-label required-label" >Jurusan Asal Sekolah</label>
                            <i class="fa fa-question-circle ml-1" tabindex="0" data-toggle="popover" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-title="Contoh: MIPA, IPS, TKJ, dsb."></i>
                        </div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control @error('jurusan_asal_sekolah') is-invalid @enderror" id="jurusan_asal_sekolah" name="jurusan_asal_sekolah" placeholder="Masukan jurusan asal sekolah" value="{{ old('jurusan_asal_sekolah') }}">
                            @error('jurusan_asal_sekolah')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2 mr-2 ml-2">
                        <div class="col-sm-5 d-flex align-items-center">
                            <label for="ukt" class="col-form-label faded-label" >Pengalaman Organisasi</label>
                            <i class="fa fa-question-circle ml-1" tabindex="0" data-toggle="popover" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-title="Contoh: OSIS, Pramuka, dsb."></i>
                        </div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control @error('pengalaman_organisasi') is-invalid @enderror" id="pengalaman_organisasi" name="pengalaman_organisasi" rows="3" placeholder="Masukan pengalaman organisasi" value="{{ old('pengalaman_organisasi') }}">
                            @error('pengalaman_organisasi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2 mr-2 ml-2">
                        <label for="prodi_id" class="col-sm-5 col-form-label faded-label required-label" >Program Studi</label>
                        <div class="col-sm-7">
                            <select class="form-control @error('prodi_id') is-invalid @enderror" id="prodi_id" name="prodi_id" for="prodi_id">
                                <option selected disabled value="" style="font-style: italic;">Pilih Prodi</option>
                                @foreach ($prodi as $programStudi)
                                    <option value="{{ $programStudi->id_prodi }}">{{ $programStudi->nama_prodi }}</option>
                                @endforeach
                            </select>          
                            @error('prodi_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2 mr-2 ml-2">
                        <div class="col-sm-5 d-flex align-items-center">
                            <label for="ukt" class="col-form-label faded-label required-label" >Uang Kuliah Tunggal</label>
                            <i class="fa fa-question-circle ml-1" tabindex="0" data-toggle="popover" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-title="Uang Kuliah Tunggal"></i>
                        </div>
                        <div class="col-sm-7">
                            <input type="number" step="0.01" class="form-control @error('ukt') is-invalid @enderror" id="ukt" name="ukt" placeholder="Masukan nominal UKT" value="{{ old('ukt') }}">
                            @error('ukt')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2 mr-2 ml-2">
                        <label for="angkatan_id" class="col-sm-5 col-form-label faded-label required-label" >Tahun Angkatan</label>
                        <div class="col-sm-7">
                            <select class="form-control @error('angkatan_id') is-invalid @enderror" id="angkatan_id" name="angkatan_id" for="angkatan_id">
                                <option selected disabled value="" style="font-style: italic;">Pilih Tahun Angkatan</option>
                                @foreach ($angkatan as $ta)
                                    <option value="{{ $ta->id_angkatan }}" >{{ $ta->tahun_angkatan }}</option>
                                @endforeach
                            </select>          
                            @error('angkatan_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2 mr-2 ml-2">
                        <label for="jenis_tinggal_di_cilacap" class="col-sm-5 col-form-label faded-label required-label" >Jenis Tinggal Di Cilacap</label>
                        <div class="col-sm-7">
                            <select class="form-control @error('jenis_tinggal_di_cilacap') is-invalid @enderror" id="jenis_tinggal_di_cilacap" name="jenis_tinggal_di_cilacap">
                                <option selected disabled value="" style="font-style: italic;">Pilih Jenis Tinggal</option>
                                <option value="Rumah Orang Tua" >Rumah Orang tua</option>
                                <option value="Wali" >Wali</option>
                                <option value="Kost" >Kost</option>
                                <option value="Panti Asuhan" >Panti Asuhan</option>
                                <option value="Asrama" >Asrama</option>
                                <option value="Lainnya" >Lainnya</option>
                            </select>
                            @error('jenis_tinggal_di_cilacap')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2 mr-2 ml-2">
                        <label for="alat_transportasi_ke_kampus" class="col-sm-5 col-form-label faded-label required-label" >Alat Transportasi ke Kampus</label>
                        <div class="col-sm-7">
                            <select class="form-control @error('alat_transportasi_ke_kampus') is-invalid @enderror" id="alat_transportasi_ke_kampus" name="alat_transportasi_ke_kampus">
                                <option selected disabled value="" style="font-style: italic;">Pilih Alat Transportasi</option>
                                <option value="Motor" >Motor</option>
                                <option value="Angkutan Umum" >Angkutan Umum</option>
                                <option value="Jalan Kaki" >Jalan Kaki</option>
                                <option value="Numpang Teman" >Numpang Teman</option>
                                <option value="Antar Jemput" >Antar Jemput</option>
                                <option value="Ojek" >Ojek</option>
                                <option value="Lainnya" >Lainnya</option>
                            </select>
                            @error('alat_transportasi_ke_kampus')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2 mr-2 ml-2">
                        <div class="col-sm-5 d-flex align-items-center">
                            <label for="sumber_biaya_kuliah" class="col-form-label faded-label" >Sumber Biaya Kuliah</label>
                            <i class="fa fa-question-circle ml-1" tabindex="0" data-toggle="popover" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-title="Contoh: Orang tua"></i>
                        </div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control @error('sumber_biaya_kuliah') is-invalid @enderror" id="sumber_biaya_kuliah" name="sumber_biaya_kuliah" placeholder="Masukan sumber biaya kuliah" value="{{ old('sumber_biaya_kuliah') }}">
                            @error('sumber_biaya_kuliah')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2 mr-2 ml-2">
                        <label for="penerima_kartu_prasejahtera" class="col-sm-5 col-form-label faded-label required-label" >Penerima Kartu Prasejahtera</label>
                        <div class="col-sm-7">
                            <select class="form-control @error('penerima_kartu_prasejahtera') is-invalid @enderror" id="penerima_kartu_prasejahtera" name="penerima_kartu_prasejahtera">
                                <option selected disabled value="" style="font-style: italic;">Pilih Penerima</option>
                                <option value="Ya" >Ya</option>
                                <option value="Tidak" >Tidak</option>
                            </select>
                            @error('penerima_kartu_prasejahtera')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-group row mb-2 mr-2 ml-2">
                        <label for="jumlah_tanggungan_keluarga_yang_masih_sekolah" class="col-sm-5 col-form-label faded-label required-label" >Jumlah Tanggungan Keluarga yang Masih Sekolah</label>
                        <div class="col-sm-7">
                            <input type="number" class="form-control @error('jumlah_tanggungan_keluarga_yang_masih_sekolah') is-invalid @enderror" id="jumlah_tanggungan_keluarga_yang_masih_sekolah" name="jumlah_tanggungan_keluarga_yang_masih_sekolah" placeholder="Masukan jumlah tanggungan" value="{{ old('jumlah_tanggungan_keluarga_yang_masih_sekolah') }}">
                            @error('jumlah_tanggungan_keluarga_yang_masih_sekolah')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-group row mb-2 mr-2 ml-2">
                        <label for="anak_ke" class="col-sm-5 col-form-label faded-label required-label" >Anak Ke</label>
                        <div class="col-sm-7">
                            <input type="number" class="form-control @error('anak_ke') is-invalid @enderror" id="anak_ke" name="anak_ke" placeholder="Masukan anak ke-berapa" value="{{ old('anak_ke') }}">
                            @error('anak_ke')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>  

@foreach ($mahasiswa as $m)
<div class="modal fade" id="fotoMhs{{ $m->nim }}">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                @if ($m->pas_foto)
                    <img src="{{ asset('storage/pas_foto/' . $m->pas_foto) }}" alt="Foto Mahasiswa" class="img-fluid img-6x8 rounded">
                @else
                <p>Foto tidak tersedia</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endforeach  

@foreach ($mahasiswa as $m)
<div class="modal fade" id="editData{{ $m->nim }}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data Mahasiswa</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('data-mahasiswa.update', $m->nim) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group row mb-2 ml-2 mr-2">
                        <div class="col-md-3">
                            @if ($m->pas_foto)
                            <a href="{{ asset('storage/pas_foto/' . $m->pas_foto) }}" target="_blank">
                                <img id="previewImg" src="{{ asset('storage/pas_foto/' . $m->pas_foto) }}" alt="Foto Mahasiswa" class="img-fluid img-3x4 rounded">
                            </a>
                            @else
                            <img id="previewImg" src="{{ asset('/images/profile.jpeg') }}" alt="" class="img-fluid img-3x4 rounded">
                            @endif
                        </div>
                        <div class="col-md-9">
                            <div class="form-group row mb-2">
                                <div class="col-sm-4 d-flex align-items-center">
                                    <label for="nim" class="col-form-label faded-label required-label">NIM</label>
                                    <i class="fa fa-question-circle ml-1" tabindex="0" data-toggle="popover" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-title="Nomor Induk Mahasiswa"></i>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control @error('nim') is-invalid @enderror " id="nim" name="nim" value="{{ $m->nim }}" readonly placeholder="Masukan NIM">
                                    @error('nim')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <div class="col-sm-4 d-flex align-items-center">
                                    <label for="nama_lengkap" class="col-form-label faded-label required-label" >Nama Lengkap</label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" id="nama_lengkap" name="nama_lengkap" value="{{ $m->nama_lengkap }}" placeholder="Masukan nama lengkap">
                                    @error('nama_lengkap')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <div class="col-sm-4 d-flex align-items-center">
                                    <label for="nik" class=" col-form-label faded-label required-label" >NIK</label>
                                    <i class="fa fa-question-circle ml-1" tabindex="0" data-toggle="popover" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-title="Sesuai KTP"></i>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control @error('nik') is-invalid @enderror" id="nik" name="nik" value="{{ $m->nik }}" placeholder="Masukan NIK">
                                    @error('nik')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <div class="col-sm-4 d-flex align-items-center">
                                    <label for="jenis_kelamin" class="col-form-label faded-label required-label" >Jenis Kelamin</label>
                                </div>
                                <div class="col-sm-8">
                                    <select class="form-control @error('jenis_kelamin') is-invalid @enderror" id="jenis_kelamin" name="jenis_kelamin">
                                        <option value="Laki-Laki" {{ $m->jenis_kelamin === 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                                        <option value="Perempuan" {{ $m->jenis_kelamin === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mb-2 ml-2 mr-2">
                        <div class="col-sm-4">
                            <div class="custom-file" onclick="triggerInputFile()">
                                <label class="custom-file-label" for="input_pas_foto" id="label_pas_foto">
                                    @if ($m->pas_foto)
                                        <p class="text-muted" id="uploaded-foto-label">{{ $m->pas_foto }}</p>
                                        <p class="text-muted" id="upload-foto-label" style="display: none;">Upload Foto</p>
                                    @else
                                        <p class="text-muted" id="uploaded-foto-label" style="display: none;"></p>
                                        <p class="text-muted" id="upload-foto-label">Upload Foto</p>
                                    @endif
                                </label>
                                <input type="file" name="pas_foto" class="custom-file-input @error('pas_foto') is-invalid @enderror" id="input_pas_foto" onchange="updateLabel(this)">
                                @error('pas_foto')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mb-2 ml-2 mr-2">
                        <label for="tempat_lahir" class="col-sm-5 col-form-label faded-label required-label" >Tempat Lahir</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir" name="tempat_lahir" value="{{ $m->tempat_lahir }}" placeholder="Masukan tempat lahir">
                            @error('tempat_lahir')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2 ml-2 mr-2">
                        <label for="tanggal_lahir" class="col-sm-5 col-form-label faded-label required-label" >Tanggal Lahir</label>
                        <div class="col-sm-7">
                            <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" name="tanggal_lahir" value="{{ $m->tanggal_lahir }}">
                            @error('tanggal_lahir')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2 ml-2 mr-2">
                        <label for="agama_id" class="col-sm-5 col-form-label faded-label required-label" >Agama</label>
                        <div class="col-sm-7">
                            <select class="form-control @error('agama_id') is-invalid @enderror" id="agama_id" name="agama_id" for="agama_id">
                                @foreach ($agama as $a)
                                    <option value="{{ $a->id_agama }}" {{ $a->id_agama === $m->agama_id ? 'selected' : '' }}>{{ $a->nama_agama }}</option>
                                @endforeach
                            </select>          
                            @error('agama_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2 ml-2 mr-2">
                        <label for="email" class="col-sm-5 col-form-label faded-label required-label" >Email</label>
                        <div class="col-sm-7">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $m->email }}" placeholder="Masukan email">
                            @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2 ml-2 mr-2">
                        <label for="nohp" class="col-sm-5 col-form-label faded-label required-label" >Nomor HP</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control @error('nohp') is-invalid @enderror" id="nohp" name="nohp" value="{{ $m->nohp }}" placeholder="Masukan No. Hp">
                            @error('nohp')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2 ml-2 mr-2">
                        <label for="provinsi" class="col-sm-5 col-form-label faded-label required-label" >Provinsi</label>
                        <div class="col-sm-7">
                            <select class="form-control" aria-label="Default select example" name="provinsi" id="provinsi{{ $m->nim }}" required>
                                {{-- <option value="{{ $kodeprovinsi }}">{{ mb_convert_case($prov, MB_CASE_TITLE) }}</option> --}}
                                <option value="{{ $m->provinsi }}">{{ DB::table('wilayah')->where('kode', $m->provinsi)->value('nama') }}</option>
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
                    </div>
                    <div class="form-group row mb-2 ml-2 mr-2">
                        <label for="kabupaten" class="col-sm-5 col-form-label faded-label required-label" >Kabupaten</label>
                        <div class="col-sm-7">
                            <select class="form-control" aria-label="Default select example" name="kabupaten" id="kabupaten{{$m->nim}}" >
                                @if ($kab)
                                    <option value="{{ $m->kabupaten }}">{{ mb_convert_case($kab, MB_CASE_TITLE) }}</option>
                                @else
                                    <option disabled>Tidak ada data kabupaten</option>
                                @endif
                                {{-- <option value="{{ $m->kabupaten }}">{{ mb_convert_case($kab, MB_CASE_TITLE) }}</option> --}}
                            </select>                               
                            @error('kabupaten')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2 ml-2 mr-2">
                        <label for="kecamatan" class="col-sm-5 col-form-label faded-label required-label" >Kecamatan</label>
                        <div class="col-sm-7">
                            <select class="form-control" aria-label="Default select example" name="kecamatan" id="kecamatan{{$m->nim}}" >
                                @if ($kec)
                                    <option value="{{ $m->kecamatan }}">{{ $kec }}</option>
                                @else
                                    <option disabled>Tidak ada data kabupaten</option>
                                @endif
                                {{-- <option value="{{ $m->kecamatan }}">{{ $kec }}</option> --}}
                            </select>                               
                            @error('kecamatan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2 ml-2 mr-2">
                        <label for="desa_kelurahan" class="col-sm-5 col-form-label faded-label required-label" >Desa/Kelurahan</label>
                        <div class="col-sm-7">
                            <select class="form-control" aria-label="Default select example" name="desa_kelurahan" id="desa_kelurahan{{$m->nim}}" >
                                @if ($ds)
                                    <option value="{{ $m->desa_kelurahan }}">{{ $ds }}</option>
                                @else
                                    <option disabled>Tidak ada data kabupaten</option>
                                @endif
                                {{-- <option value="{{ $m->desa_kelurahan }}">{{ $ds }}</option> --}}
                            </select>
                            @error('desa_kelurahan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2 ml-2 mr-2">
                        <label for="rt" class="col-sm-5 col-form-label faded-label required-label" >RT</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control @error('rt') is-invalid @enderror" id="rt" name="rt" value="{{ $m->rt }}" placeholder="Masukan RT">
                            @error('rt')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2 ml-2 mr-2">
                        <label for="rw" class="col-sm-5 col-form-label faded-label required-label" >RW</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control @error('rw') is-invalid @enderror" id="rw" name="rw" value="{{ $m->rw }}" placeholder="Masukan RW">
                            @error('rw')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2 ml-2 mr-2">
                        <div class="col-sm-5 d-flex align-items-center">
                            <label for="alamat_jalan" class=" col-form-label faded-label required-label" >Alamat Jalan</label>
                            <i class="fa fa-question-circle ml-1" tabindex="0" data-toggle="popover" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-title="Contoh: Jl. Melati No.3"></i>
                        </div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control @error('alamat_jalan') is-invalid @enderror" id="alamat_jalan" name="alamat_jalan" value="{{ $m->alamat_jalan }}" placeholder="Masukan jalan">
                            @error('alamat_jalan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2 ml-2 mr-2">
                        <label for="nama_ayah" class="col-sm-5 col-form-label faded-label required-label" >Nama Ayah</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control @error('nama_ayah') is-invalid @enderror" id="nama_ayah" name="nama_ayah" value="{{ $m->nama_ayah }}" placeholder="Masukan nama ayah kandung">
                            @error('nama_ayah')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2 ml-2 mr-2">
                        <div class="col-sm-5 d-flex align-items-center">
                            <label for="nik_ayah" class="col-form-label faded-label " >NIK Ayah</label>
                            <i class="fa fa-question-circle ml-1" tabindex="0" data-toggle="popover" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-title="Sesuai KTP ayah"></i>
                        </div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control @error('nik_ayah') is-invalid @enderror" id="nik_ayah" name="nik_ayah" value="{{ $m->nik_ayah }}" placeholder="Masukan NIK ayah">
                            @error('nik_ayah')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2 ml-2 mr-2">
                        <label for="tempat_lahir_ayah" class="col-sm-5 col-form-label faded-label " >Tempat Lahir Ayah</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control @error('tempat_lahir_ayah') is-invalid @enderror" id="tempat_lahir_ayah" name="tempat_lahir_ayah" value="{{ $m->tempat_lahir_ayah }}" placeholder="Masukan tempat lahir ayah">
                            @error('tempat_lahir_ayah')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2 ml-2 mr-2">
                        <label for="tanggal_lahir_ayah" class="col-sm-5 col-form-label faded-label " >Tanggal Lahir Ayah</label>
                        <div class="col-sm-7">
                            <input type="date" class="form-control @error('tanggal_lahir_ayah') is-invalid @enderror" id="tanggal_lahir_ayah" name="tanggal_lahir_ayah" value="{{ $m->tanggal_lahir_ayah }}">
                            @error('tanggal_lahir_ayah')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2 ml-2 mr-2">
                        <div class="col-sm-5 d-flex align-items-center">
                            <label for="pendidikan_ayah" class="col-form-label faded-label " >Pendidikan Terakhir Ayah</label>
                            <i class="fa fa-question-circle ml-1" tabindex="0" data-toggle="popover" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-title="Contoh: SLTP, SLTA, D3, S1, dsb."></i>
                        </div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control @error('pendidikan_ayah') is-invalid @enderror" id="pendidikan_ayah" name="pendidikan_ayah" value="{{ $m->pendidikan_ayah }}" placeholder="Masukan pendidikan terakhir ayah">
                            @error('pendidikan_ayah')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2 ml-2 mr-2">
                        <label for="pekerjaan_ayah" class="col-sm-5 col-form-label faded-label " >Pekerjaan Ayah</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control @error('pekerjaan_ayah') is-invalid @enderror" id="pekerjaan_ayah" name="pekerjaan_ayah" value="{{ $m->pekerjaan_ayah }}" placeholder="Masukan pekerjaan ayah">
                            @error('pekerjaan_ayah')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2 ml-2 mr-2">
                        <label for="penghasilan_ayah" class="col-sm-5 col-form-label faded-label " >Penghasilan Ayah</label>
                        <div class="col-sm-7">
                            <select class="form-control @error('penghasilan_ayah') is-invalid @enderror" id="penghasilan_ayah" name="penghasilan_ayah">
                                <option value="<1jt" {{ $m->penghasilan_ayah === '<1jt' ? 'selected' : '' }}>&lt; 1jt</option>
                                <option value="1jt - 2jt" {{ $m->penghasilan_ayah === '1jt - 2jt' ? 'selected' : '' }}>1jt - 2jt</option>
                                <option value="2jt - 3jt" {{ $m->penghasilan_ayah === '2jt - 3jt' ? 'selected' : '' }}>2jt - 3jt</option>
                                <option value="3jt - 4jt" {{ $m->penghasilan_ayah === '3jt - 4jt' ? 'selected' : '' }}>3jt - 4jt</option>
                                <option value=">5jt" {{ $m->penghasilan_ayah === '>5jt' ? 'selected' : '' }}>&gt; 5jt</option>
                            </select>
                            @error('penghasilan_ayah')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2 ml-2 mr-2">
                        <label for="nama_ibu" class="col-sm-5 col-form-label faded-label required-label" >Nama Ibu</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control @error('nama_ibu') is-invalid @enderror" id="nama_ibu" name="nama_ibu" value="{{ $m->nama_ibu }}" placeholder="Masukan nama ibu kandung">
                            @error('nama_ibu')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2 ml-2 mr-2">
                        <div class="col-sm-5 d-flex align-items-center">
                            <label for="nik_ibu" class="col-form-label faded-label" >NIK Ibu</label>
                            <i class="fa fa-question-circle ml-1" tabindex="0" data-toggle="popover" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-title="Sesuai KTP ibu"></i>
                        </div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control @error('nik_ibu') is-invalid @enderror" id="nik_ibu" name="nik_ibu" value="{{ $m->nik_ibu }}" placeholder="Masukan NIK ibu">
                            @error('nik_ibu')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2 ml-2 mr-2">
                        <label for="tempat_lahir_ibu" class="col-sm-5 col-form-label faded-label" >Tempat Lahir Ibu</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control @error('tempat_lahir_ibu') is-invalid @enderror" id="tempat_lahir_ibu" name="tempat_lahir_ibu" value="{{ $m->tempat_lahir_ibu }}" placeholder="Masukan tempat lahir ibu">
                            @error('tempat_lahir_ibu')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2 ml-2 mr-2">
                        <label for="tanggal_lahir_ibu" class="col-sm-5 col-form-label faded-label" >Tanggal Lahir Ibu</label>
                        <div class="col-sm-7">
                            <input type="date" class="form-control @error('tanggal_lahir_ibu') is-invalid @enderror" id="tanggal_lahir_ibu" name="tanggal_lahir_ibu" value="{{ $m->tanggal_lahir_ibu }}">
                            @error('tanggal_lahir_ibu')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2 ml-2 mr-2">
                        <div class="col-sm-5 d-flex align-items-center">
                            <label for="pendidikan_ibu" class="col-form-label faded-label" >Pendidikan Terakhir Ibu</label>
                            <i class="fa fa-question-circle ml-1" tabindex="0" data-toggle="popover" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-title="Contoh: SLTP, SLTA, D3, S1, dsb."></i>
                        </div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control @error('pendidikan_ibu') is-invalid @enderror" id="pendidikan_ibu" name="pendidikan_ibu" value="{{ $m->pendidikan_ibu }}" placeholder="Masukan pendidikan terakhir ibu">
                            @error('pendidikan_ibu')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2 ml-2 mr-2">
                        <label for="pekerjaan_ibu" class="col-sm-5 col-form-label faded-label" >Pekerjaan Ibu</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control @error('pekerjaan_ibu') is-invalid @enderror" id="pekerjaan_ibu" name="pekerjaan_ibu" value="{{ $m->pekerjaan_ibu }}" placeholder="Masukan pekerjaan ibu">
                            @error('pekerjaan_ibu')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2 ml-2 mr-2">
                        <label for="penghasilan_ibu" class="col-sm-5 col-form-label faded-label" >Penghasilan Ibu</label>
                        <div class="col-sm-7">
                            <select class="form-control @error('penghasilan_ibu') is-invalid @enderror" id="penghasilan_ibu" name="penghasilan_ibu">
                                <option value="<1jt" {{ $m->penghasilan_ibu === '<1jt' ? 'selected' : '' }}>&lt; 1jt</option>
                                <option value="1jt - 2jt" {{ $m->penghasilan_ibu === '1jt - 2jt' ? 'selected' : '' }}>1jt - 2jt</option>
                                <option value="2jt - 3jt" {{ $m->penghasilan_ibu === '2jt - 3jt' ? 'selected' : '' }}>2jt - 3jt</option>
                                <option value="3jt - 4jt" {{ $m->penghasilan_ibu === '3jt - 4jt' ? 'selected' : '' }}>3jt - 4jt</option>
                                <option value=">5jt" {{ $m->penghasilan_ibu === '>5jt' ? 'selected' : '' }}>&gt; 5jt</option>
                            </select>
                            @error('penghasilan_ibu')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2 ml-2 mr-2">
                        <label for="nama_wali" class="col-sm-5 col-form-label faded-label" >Nama Wali</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control @error('nama_wali') is-invalid @enderror" id="nama_wali" name="nama_wali" value="{{ $m->nama_wali }}" placeholder="Masukan nama wali">
                            @error('nama_wali')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2 ml-2 mr-2">
                        <label for="alamat_wali" class="col-sm-5 col-form-label faded-label" >Alamat Wali</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control @error('alamat_wali') is-invalid @enderror" id="alamat_wali" name="alamat_wali" value="{{ $m->alamat_wali }}" placeholder="Masukan alamat wali">
                            @error('alamat_wali')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2 ml-2 mr-2">
                        <label for="asal_sekolah" class="col-sm-5 col-form-label faded-label required-label" >Asal Sekolah</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control @error('asal_sekolah') is-invalid @enderror" id="asal_sekolah" name="asal_sekolah" value="{{ $m->asal_sekolah }}" placeholder="Masukan asal sekolah mahasiswa">
                            @error('asal_sekolah')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2 ml-2 mr-2">
                        <div class="col-sm-5 d-flex align-items-center">
                            <label for="ukt" class="col-form-label faded-label required-label" >Jurusan Asal Sekolah</label>
                            <i class="fa fa-question-circle ml-1" tabindex="0" data-toggle="popover" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-title="Contoh: MIPA, IPS, TKJ, dsb."></i>
                        </div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control @error('jurusan_asal_sekolah') is-invalid @enderror" id="jurusan_asal_sekolah" name="jurusan_asal_sekolah" value="{{ $m->jurusan_asal_sekolah }}" placeholder="Masukan jurusan asal sekolah">
                            @error('jurusan_asal_sekolah')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2 ml-2 mr-2">
                        <div class="col-sm-5 d-flex align-items-center">
                            <label for="ukt" class="col-form-label faded-label required-label" >Pengalaman Organisasi</label>
                            <i class="fa fa-question-circle ml-1" tabindex="0" data-toggle="popover" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-title="Contoh: OSIS, Pramuka, dsb."></i>
                        </div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control @error('pengalaman_organisasi') is-invalid @enderror" id="pengalaman_organisasi" name="pengalaman_organisasi" rows="3"  value="{{ $m->pengalaman_organisasi }}"  placeholder="Masukan pengalaman organisasi">
                            @error('pengalaman_organisasi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2 ml-2 mr-2">
                        <label for="prodi_id" class="col-sm-5 col-form-label faded-label required-label" >Program Studi</label>
                        <div class="col-sm-7">
                            <select class="form-control @error('prodi_id') is-invalid @enderror" id="prodi_id" name="prodi_id" for="prodi_id">
                                @foreach ($prodi as $programStudi)
                                    <option value="{{ $programStudi->id_prodi }}" {{ $programStudi->id_prodi === $m->prodi_id ? 'selected' : '' }}>{{ $programStudi->nama_prodi }}</option>
                                @endforeach
                            </select>          
                            @error('prodi_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2 ml-2 mr-2">
                        <div class="col-sm-5 d-flex align-items-center">
                            <label for="ukt" class="col-form-label faded-label required-label" >Uang Kuliah Tunggal</label>
                            <i class="fa fa-question-circle ml-1" tabindex="0" data-toggle="popover" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-title="Uang Kuliah Tunggal"></i>
                        </div>
                        <div class="col-sm-7">
                            <input type="number" step="0.01" class="form-control @error('ukt') is-invalid @enderror" id="ukt" name="ukt" value="{{ $m->ukt }}" placeholder="Masukan nominal UKT">
                            @error('ukt')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2 ml-2 mr-2">
                        <label for="angkatan_id" class="col-sm-5 col-form-label faded-label required-label" >Tahun Angkatan</label>
                        <div class="col-sm-7">
                            <select class="form-control @error('angkatan_id') is-invalid @enderror" id="angkatan_id" name="angkatan_id" for="angkatan_id">
                                @foreach ($angkatan as $ta)
                                    <option value="{{ $ta->id_angkatan }}" {{ $ta->id_angkatan === $m->angkatan_id ? 'selected' : '' }}>{{ $ta->tahun_angkatan }}</option>
                                @endforeach
                            </select>          
                            @error('angkatan_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2 ml-2 mr-2">
                        <label for="jenis_tinggal_di_cilacap" class="col-sm-5 col-form-label faded-label required-label" >Jenis Tinggal Di Cilacap</label>
                        <div class="col-sm-7">
                            <select class="form-control @error('jenis_tinggal_di_cilacap') is-invalid @enderror" id="jenis_tinggal_di_cilacap" name="jenis_tinggal_di_cilacap">
                                <option value="Rumah Orang Tua" {{ $m->jenis_tinggal_di_cilacap === 'Rumah Orang tua' ? 'selected' : '' }}>Rumah Orang tua</option>
                                <option value="Wali" {{ $m->jenis_tinggal_di_cilacap === 'Wali' ? 'selected' : '' }}>Wali</option>
                                <option value="Kost" {{ $m->jenis_tinggal_di_cilacap === 'Kost' ? 'selected' : '' }}>Kost</option>
                                <option value="Panti Asuhan" {{ $m->jenis_tinggal_di_cilacap === 'Panti Asuhan' ? 'selected' : '' }}>Panti Asuhan</option>
                                <option value="Asrama" {{ $m->jenis_tinggal_di_cilacap === 'Asrama' ? 'selected' : '' }}>Asrama</option>
                                <option value="Lainnya" {{ $m->jenis_tinggal_di_cilacap === 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            @error('jenis_tinggal_di_cilacap')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2 ml-2 mr-2">
                        <label for="alat_transportasi_ke_kampus" class="col-sm-5 col-form-label faded-label required-label" >Alat Transportasi ke Kampus</label>
                        <div class="col-sm-7">
                            <select class="form-control @error('alat_transportasi_ke_kampus') is-invalid @enderror" id="alat_transportasi_ke_kampus" name="alat_transportasi_ke_kampus">
                                <option value="Motor" {{ $m->alat_transportasi_ke_kampus === 'Motor' ? 'selected' : '' }}>Motor</option>
                                <option value="Angkutan Umum" {{ $m->alat_transportasi_ke_kampus === 'Angkutan Umum' ? 'selected' : '' }}>Angkutan Umum</option>
                                <option value="Jalan Kaki" {{ $m->alat_transportasi_ke_kampus === 'Jalan Kaki' ? 'selected' : '' }}>Jalan Kaki</option>
                                <option value="Numpang Teman" {{ $m->alat_transportasi_ke_kampus === 'Numpang Teman' ? 'selected' : '' }}>Numpang Teman</option>
                                <option value="Antar Jemput" {{ $m->alat_transportasi_ke_kampus === 'Antar Jemput' ? 'selected' : '' }}>Antar Jemput</option>
                                <option value="Ojek" {{ $m->alat_transportasi_ke_kampus === 'Ojek' ? 'selected' : '' }}>Ojek</option>
                                <option value="Lainnya" {{ $m->alat_transportasi_ke_kampus === 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            @error('alat_transportasi_ke_kampus')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2 ml-2 mr-2">
                        <div class="col-sm-5 d-flex align-items-center">
                            <label for="sumber_biaya_kuliah" class="col-form-label faded-label" >Sumber Biaya Kuliah</label>
                            <i class="fa fa-question-circle ml-1" tabindex="0" data-toggle="popover" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-title="Contoh: Orang tua"></i>
                        </div>                        <div class="col-sm-7">
                            <input type="text" class="form-control @error('sumber_biaya_kuliah') is-invalid @enderror" id="sumber_biaya_kuliah" name="sumber_biaya_kuliah" value="{{ $m->sumber_biaya_kuliah }}" placeholder="Masukan sumber biaya kuliah">
                            @error('sumber_biaya_kuliah')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2 ml-2 mr-2">
                        <label for="penerima_kartu_prasejahtera" class="col-sm-5 col-form-label faded-label required-label" >Penerima Kartu Prasejahtera</label>
                        <div class="col-sm-7">
                            <select class="form-control @error('penerima_kartu_prasejahtera') is-invalid @enderror" id="penerima_kartu_prasejahtera" name="penerima_kartu_prasejahtera">
                                <option value="Ya" {{ $m->penerima_kartu_prasejahtera === 'Ya' ? 'selected' : '' }}>Ya</option>
                                <option value="Tidak" {{ $m->penerima_kartu_prasejahtera === 'Tidak' ? 'selected' : '' }}>Tidak</option>
                            </select>
                            @error('penerima_kartu_prasejahtera')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2 ml-2 mr-2">
                        <label for="jumlah_tanggungan_keluarga_yang_masih_sekolah" class="col-sm-5 col-form-label faded-label required-label" >Jumlah Tanggungan Keluarga yang Masih Sekolah</label>
                        <div class="col-sm-7">
                            <input type="number" class="form-control @error('jumlah_tanggungan_keluarga_yang_masih_sekolah') is-invalid @enderror" id="jumlah_tanggungan_keluarga_yang_masih_sekolah" name="jumlah_tanggungan_keluarga_yang_masih_sekolah" value="{{ $m->jumlah_tanggungan_keluarga_yang_masih_sekolah }}" placeholder="Masukan jumlah tanggungan">
                            @error('jumlah_tanggungan_keluarga_yang_masih_sekolah')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2 ml-2 mr-2">
                        <label for="anak_ke" class="col-sm-5 col-form-label faded-label required-label" >Anak Ke</label>
                        <div class="col-sm-7">
                            <input type="number" class="form-control @error('anak_ke') is-invalid @enderror" id="anak_ke" name="anak_ke" value="{{ $m->anak_ke }}" placeholder="Masukan anak ke-berapa">
                            @error('anak_ke')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(function () {
    $('#provinsi{{$m->nim}}').on('change', function(){
        let id_provinsi = $(this).val(); // Menggunakan $(this) untuk mengambil nilai yang dipilih
        console.log(id_provinsi);
        $.ajax({
            type: 'POST',
            url: "{{route('getprovinsi')}}",
            data: {
                id_provinsi: id_provinsi,
            },
            cache: false,
            success: function (msg) {
                $('#kabupaten{{$m->nim}}').html(msg);
                $('#kecamatan{{$m->nim}}').empty(); // Mengosongkan opsi kecamatan setelah perubahan provinsi
                $('#desa_kelurahan{{$m->nim}}').empty(); // Mengosongkan opsi desa/kelurahan setelah perubahan provinsi
            },
            error: function(data){
                console.log('error', data);
            },
        })
    });

    $('#kabupaten{{$m->nim}}').on('change', function(){
        let id_kabupaten = $(this).val(); // Menggunakan $(this) untuk mengambil nilai yang dipilih
        $.ajax({
            type: 'POST',
            url: "{{route('getkabupaten')}}",
            data: {
                id_kabupaten: id_kabupaten,
            },
            cache: false,
            success: function (msg) {
                $('#kecamatan{{$m->nim}}').html(msg);
                $('#desa_kelurahan{{$m->nim}}').empty(); // Mengosongkan opsi desa/kelurahan setelah perubahan kabupaten
            },
            error: function(data){
                console.log('error', data);
            },
        })
    });

    $('#kecamatan{{$m->nim}}').on('change', function(){
        let id_kecamatan = $(this).val(); // Menggunakan $(this) untuk mengambil nilai yang dipilih
        $.ajax({
            type: 'POST',
            url: "{{route('getkecamatan')}}",
            data: {
                id_kecamatan: id_kecamatan,
            },
            cache: false,
            success: function (msg) {
                $('#desa_kelurahan{{$m->nim}}').html(msg);
            },
            error: function(data){
                console.log('error', data);
            },
        })
    });
});
</script>
@endforeach

@foreach ($mahasiswa as $m)
<div class="modal fade" id="detailMahasiswa{{ $m->nim }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Data Mahasiswa</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row mb-2 mt-2">
                    <div class="col-md-4">
                        @if ($m->pas_foto)
                        <a href="{{ asset('storage/pas_foto/' . $m->pas_foto) }}" target="_blank">
                            <img src="{{ asset('storage/pas_foto/' . $m->pas_foto) }}" alt="Foto Mahasiswa" class="img-fluid img-3x4 rounded">
                        </a>
                        @else
                        <img src="{{ asset('/images/profile.jpeg') }}" alt="" class="img-fluid img-3x4 rounded">
                        @endif
                    </div>                    
                    <div class="col-md-8">
                        <div class="form-group row mb-2">
                            <label for="nim" class="col-sm-5 col-form-label faded-label"
                                >NIM</label>
                            <div class="col-sm-7 text-dark">
                                : {{ $m->nim }}
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label for="nama_lengkap" class="col-sm-5 col-form-label faded-label"
                                >Nama Lengkap</label>
                            <div class="col-sm-7 text-dark">
                                : {{ $m->nama_lengkap }}
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label for="nik" class="col-sm-5 col-form-label faded-label"
                                >NIK</label>
                            <div class="col-sm-7 text-dark">
                                : {{ $m->nik }}
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label for="jenis_kelamin" class="col-sm-5 col-form-label faded-label" >Jenis Kelamin</label>
                            <div class="col-sm-7 text-dark">
                                : {{ $m->jenis_kelamin }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="tempat_lahir" class="col-sm-5 col-form-label faded-label" >Tempat Lahir</label>
                    <div class="col-sm-7 text-dark">
                        : {{ $m->tempat_lahir }}
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="tanggal_lahir" class="col-sm-5 col-form-label faded-label" >Tanggal Lahir</label>
                    <div class="col-sm-7 text-dark">
                        : {{ $m->tanggal_lahir }}
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="agama" class="col-sm-5 col-form-label faded-label" >Agama</label>
                    <div class="col-sm-7 text-dark">
                        : {{ $m->agama->nama_agama }}
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="email" class="col-sm-5 col-form-label faded-label" >Email</label>
                    <div class="col-sm-7 text-dark">
                        : {{ $m->email }}
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="nohp" class="col-sm-5 col-form-label faded-label" >Nomor HP</label>
                    <div class="col-sm-7 text-dark">
                        : {{ $m->nohp }}
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="alamat_jalan" class="col-sm-5 col-form-label faded-label" >Alamat Lengkap</label>
                    <div class="col-sm-7 text-dark">
                        : {{ $m->alamat_jalan }}, RT.{{ $m->rt }}/RW.{{ $m->rw }},
                        Desa {{ DB::table('wilayah')->where('kode', $m->desa_kelurahan)->value('nama') }},
                        Kec. {{ DB::table('wilayah')->where('kode', $m->kecamatan)->value('nama') }},
                        {{ mb_convert_case(DB::table('wilayah')->where('kode', $m->kabupaten)->value('nama'), MB_CASE_TITLE) }},
                        Prov. {{ mb_convert_case(DB::table('wilayah')->where('kode', $m->provinsi)->value('nama'), MB_CASE_TITLE) }}
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="nama_ayah" class="col-sm-5 col-form-label faded-label" >Nama Ayah</label>
                    <div class="col-sm-7 text-dark">
                        : {{ $m->nama_ayah }}
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="nik_ayah" class="col-sm-5 col-form-label faded-label" >NIK Ayah</label>
                    <div class="col-sm-7 text-dark">
                        : {{ $m->nik_ayah }}
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="tempat_lahir_ayah" class="col-sm-5 col-form-label faded-label" >Tempat Lahir Ayah</label>
                    <div class="col-sm-7 text-dark">
                        : {{ $m->tempat_lahir_ayah }}
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="tanggal_lahir_ayah" class="col-sm-5 col-form-label faded-label" >Tanggal Lahir Ayah</label>
                    <div class="col-sm-7 text-dark">
                        : {{ $m->tanggal_lahir_ayah }}
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="pendidikan_ayah" class="col-sm-5 col-form-label faded-label" >Pendidikan Ayah</label>
                    <div class="col-sm-7 text-dark">
                        : {{ $m->pendidikan_ayah }}
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="pekerjaan_ayah" class="col-sm-5 col-form-label faded-label" >Pekerjaan Ayah</label>
                    <div class="col-sm-7 text-dark">
                        : {{ $m->pekerjaan_ayah }}
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="penghasilan_ayah" class="col-sm-5 col-form-label faded-label" >Penghasilan Ayah</label>
                    <div class="col-sm-7 text-dark">
                        : {{ $m->penghasilan_ayah }}
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="nama_ibu" class="col-sm-5 col-form-label faded-label" >Nama Ibu</label>
                    <div class="col-sm-7 text-dark">
                        : {{ $m->nama_ibu }}
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="nik_ibu" class="col-sm-5 col-form-label faded-label" >NIK Ibu</label>
                    <div class="col-sm-7 text-dark">
                        : {{ $m->nik_ibu }}
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="tempat_lahir_ibu" class="col-sm-5 col-form-label faded-label" >Tempat Lahir Ibu</label>
                    <div class="col-sm-7 text-dark">
                        : {{ $m->tempat_lahir_ibu }}
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="tanggal_lahir_ibu" class="col-sm-5 col-form-label faded-label" >Tanggal Lahir Ibu</label>
                    <div class="col-sm-7 text-dark">
                        : {{ $m->tanggal_lahir_ibu }}
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="pendidikan_ibu" class="col-sm-5 col-form-label faded-label" >Pendidikan Ibu</label>
                    <div class="col-sm-7 text-dark">
                        : {{ $m->pendidikan_ibu }}
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="pekerjaan_ibu" class="col-sm-5 col-form-label faded-label" >Pekerjaan Ibu</label>
                    <div class="col-sm-7 text-dark">
                        : {{ $m->pekerjaan_ibu }}
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="penghasilan_ibu" class="col-sm-5 col-form-label faded-label" >Penghasilan Ibu</label>
                    <div class="col-sm-7 text-dark">
                        : {{ $m->penghasilan_ibu }}
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="nama_wali" class="col-sm-5 col-form-label faded-label" >Nama Wali</label>
                    <div class="col-sm-7 text-dark">
                        : {{ $m->nama_wali }}
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="alamat_wali" class="col-sm-5 col-form-label faded-label" >Alamat Wali</label>
                    <div class="col-sm-7 text-dark">
                        : {{ $m->alamat_wali }}
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="asal_sekolah" class="col-sm-5 col-form-label faded-label" >Asal Sekolah</label>
                    <div class="col-sm-7 text-dark">
                        : {{ $m->asal_sekolah }}
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="jurusan_asal_sekolah" class="col-sm-5 col-form-label faded-label" >Jurusan Asal Sekolah</label>
                    <div class="col-sm-7 text-dark">
                        : {{ $m->jurusan_asal_sekolah }}
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="pengalaman_organisasi" class="col-sm-5 col-form-label faded-label" >Pengalaman Organisasi</label>
                    <div class="col-sm-7 text-dark">
                        : {{ $m->pengalaman_organisasi }}
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="prodi_id" class="col-sm-5 col-form-label faded-label" >Program Studi</label>
                    <div class="col-sm-7 text-dark">
                        : {{ $m->prodi->nama_prodi }}
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="ukt" class="col-sm-5 col-form-label faded-label" >Uang Kuliah Tunggal</label>
                    <div class="col-sm-7 text-dark">
                        : {{ $m->ukt }}
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="tahun_angkatan" class="col-sm-5 col-form-label faded-label" >Tahun Angkatan</label>
                    <div class="col-sm-7 text-dark">
                        : {{ $m->angkatan->tahun_angkatan }}
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="jenis_tinggal_di_cilacap" class="col-sm-5 col-form-label faded-label" >Jenis Tinggal di Cilacap</label>
                    <div class="col-sm-7 text-dark">
                        : {{ $m->jenis_tinggal_di_cilacap }}
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="alat_transportasi_ke_kampus" class="col-sm-5 col-form-label faded-label" >Alat Transportasi ke Kampus</label>
                    <div class="col-sm-7 text-dark">
                        : {{ $m->alat_transportasi_ke_kampus }}
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="sumber_biaya_kuliah" class="col-sm-5 col-form-label faded-label" >Sumber Biaya Kuliah</label>
                    <div class="col-sm-7 text-dark">
                        : {{ $m->sumber_biaya_kuliah }}
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="penerima_kartu_prasejahtera" class="col-sm-5 col-form-label faded-label" >Penerima Kartu Prasejahtera</label>
                    <div class="col-sm-7 text-dark">
                        : {{ $m->penerima_kartu_prasejahtera }}
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="jumlah_tanggungan_keluarga_yang_masih_sekolah" class="col-sm-5 col-form-label faded-label" >Jumlah Tanggungan Keluarga yang Masih Sekolah</label>
                    <div class="col-sm-7 text-dark">
                        : {{ $m->jumlah_tanggungan_keluarga_yang_masih_sekolah }}
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="anak_ke" class="col-sm-5 col-form-label faded-label" >Anak Ke</label>
                    <div class="col-sm-7 text-dark">
                        : {{ $m->anak_ke }}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endforeach



<div class="modal fade modalExport" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">Export Data</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
        <div class="modal-body">
            <form id="exportForm" action="{{ route('exportdata.exportexcel') }}" method="post">
                @csrf
                <div class="form-group mb-3">
                    <label class="required-label faded-label" for="prodi_id" >Pilih Prodi</label>
                    <select class="form-control" name="prodi_id" id="prodi_id">
                        <option value="">Semua Prodi</option>
                        @foreach ($prodi as $programStudi)
                            <option value="{{ $programStudi->id_prodi }}">{{ $programStudi->nama_prodi }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label class="required-label faded-label" for="tahun_angkatan" >Pilih Angkatan</label>
                    <select class="form-control" name="tahun_angkatan" id="tahun_angkatan">
                        <option value="">Semua Angkatan</option>
                        @foreach ($angkatan as $a)
                            <option value="{{ $a->id_angkatan }}">{{ $a->tahun_angkatan }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" onclick="submitForm('{{ route('exportdata.exportexcel') }}')">Export Excel</button>
                    <button type="button" class="btn btn-primary" onclick="submitForm('{{ route('exportdata.exportimg') }}')">Export Foto</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .img-3x4 {
    width: 100%;
    height: auto;
    max-width: 150px;
    max-height: 200px;
    object-fit: cover;
}
</style>

<script>
    function submitForm(action) {
        document.getElementById('exportForm').action = action;
        document.getElementById('exportForm').submit();
    }
</script>

<script>
    document.addEventListener('change', function(event) {
        const target = event.target;
        if (target && target.id.startsWith('input_pas_foto')) {
            const fileName = target.files[0].name;
            const labelFoto = target.closest('.custom-file').querySelector('.custom-file-label');
            labelFoto.innerHTML = fileName;

            const previewImgId = target.id.replace('input_pas_foto', 'previewImg');
            const previewImg = document.getElementById(previewImgId);
            if (previewImg) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                }
                reader.readAsDataURL(target.files[0]);
            }
        }
    });
</script>
@endsection