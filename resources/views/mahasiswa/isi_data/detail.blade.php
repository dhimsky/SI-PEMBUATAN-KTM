@extends('layouts.main-layout')
@section('tittle', 'Data Mahasiswa')

@section('content')
@if (session('success'))
<div class="row justify-content-end">
    <div class="alert alert-success alert-dismissible fade show col-md-3 ml-auto">
        <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
        </button>
        <strong>Berhasil!</strong> {{ session('success') }}.
    </div>
</div>
@endif
@if ($errors->any())
    <div class="row justify-content-end">
        <div class="alert alert-danger alert-dismissible fade show col-md-4 ml-auto">
            <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close">
                <span><i class="mdi mdi-close"></i></span>
            </button>
            <strong>Error!</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif


<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card mt-5">
                <div class="row">
                    <div class="col-md-10 col-8">
                        <div class="card-header">
                            <h3>Data Mahasiswa</h3>
                        </div>
                    </div>
                    <div class="col-md-2 col-4 mt-md-0 mt-3 text-md-right">
                        <a href="{{route('print-id', $mahasiswa->nim)}}" target="_blank"
                            class="btn btn-warning">
                        <i class="fa fa-print"></i></a>
                        <a href="" class="btn btn-secondary" data-toggle="modal" data-target="#editData">
                            <i class="fa fa-pencil"></i>
                        </a>
                        {{-- @foreach ($mahasiswas as $mahasiswa)
                        <a href="{{route('print-id', $mahasiswa->nim)}}" target="_blank"
                            class="text-indigo-600 hover:text-indigo-900 mx-2">Print</a>
                        @endforeach --}}
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group row mb-2 mt-2">
                        <div class="col-md-4">
                            @if ($mahasiswa->pas_foto)
                            <a href="{{ asset('storage/pas_foto/' . $mahasiswa->pas_foto) }}" target="_blank">
                                <img src="{{ asset('storage/pas_foto/' . $mahasiswa->pas_foto) }}" alt="Foto Mahasiswa" class="img-fluid img-3x4 rounded">
                            </a>
                            @else
                            <p>Foto tidak tersedia</p>
                            @endif
                        </div>                    
                        <div class="col-md-8">
                            <div class="form-group row mb-2">
                                <label for="nim" class="col-sm-5 col-form-label faded-label"
                                    style="font-style: italic;">NIM</label>
                                <div class="col-sm-7 text-dark">
                                    : {{ $mahasiswa->nim }}
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="nama_lengkap" class="col-sm-5 col-form-label faded-label"
                                    style="font-style: italic;">Nama Lengkap</label>
                                <div class="col-sm-7 text-dark">
                                    : {{ $mahasiswa->nama_lengkap }}
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="nik" class="col-sm-5 col-form-label faded-label"
                                    style="font-style: italic;">NIK</label>
                                <div class="col-sm-7 text-dark">
                                    : {{ $mahasiswa->nik }}
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="jenis_kelamin" class="col-sm-5 col-form-label faded-label" style="font-style: italic;">Jenis Kelamin</label>
                                <div class="col-sm-7 text-dark">
                                    : {{ $mahasiswa->jenis_kelamin }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="tempat_lahir" class="col-sm-5 col-form-label faded-label" style="font-style: italic;">Tempat Lahir</label>
                        <div class="col-sm-7 text-dark">
                            : {{ $mahasiswa->tempat_lahir }}
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="tanggal_lahir" class="col-sm-5 col-form-label faded-label" style="font-style: italic;">Tanggal Lahir</label>
                        <div class="col-sm-7 text-dark">
                            : 
                            <?php
                                // Array untuk mengonversi bulan dalam bahasa Inggris ke bahasa Indonesia
                                $bulan = [
                                    'January'   => 'Januari',
                                    'February'  => 'Februari',
                                    'March'     => 'Maret',
                                    'April'     => 'April',
                                    'May'       => 'Mei',
                                    'June'      => 'Juni',
                                    'July'      => 'Juli',
                                    'August'    => 'Agustus',
                                    'September' => 'September',
                                    'October'   => 'Oktober',
                                    'November'  => 'November',
                                    'December'  => 'Desember'
                                ];
                                
                                // Ubah format tanggal dari "YYYY-MM-DD" menjadi "DD NamaBulan YYYY" dalam bahasa Indonesia
                                $tanggal_lahir = date('d', strtotime($mahasiswa->tanggal_lahir)) . ' ' . $bulan[date('F', strtotime($mahasiswa->tanggal_lahir))] . ' ' . date('Y', strtotime($mahasiswa->tanggal_lahir));
                                
                                echo $tanggal_lahir;
                            ?>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="agama" class="col-sm-5 col-form-label faded-label" style="font-style: italic;">Agama</label>
                        <div class="col-sm-7 text-dark">
                            : {{ $mahasiswa->agama }}
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="email" class="col-sm-5 col-form-label faded-label" style="font-style: italic;">Email</label>
                        <div class="col-sm-7 text-dark">
                            : {{ $mahasiswa->email }}
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="nohp" class="col-sm-5 col-form-label faded-label" style="font-style: italic;">Nomor HP</label>
                        <div class="col-sm-7 text-dark">
                            : {{ $mahasiswa->nohp }}
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="provinsi" class="col-sm-5 col-form-label faded-label" style="font-style: italic;">Provinsi</label>
                        <div class="col-sm-7 text-dark">
                            : {{ mb_convert_case($prov, MB_CASE_TITLE) }}
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="kabupaten" class="col-sm-5 col-form-label faded-label" style="font-style: italic;">Kabupaten</label>
                        <div class="col-sm-7 text-dark">
                            : {{ mb_convert_case($kab, MB_CASE_TITLE) }}
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="kecamatan" class="col-sm-5 col-form-label faded-label" style="font-style: italic;">Kecamatan</label>
                        <div class="col-sm-7 text-dark">
                            : {{ $kec }}
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="desa_kelurahan" class="col-sm-5 col-form-label faded-label" style="font-style: italic;">Desa/Kelurahan</label>
                        <div class="col-sm-7 text-dark">
                            : {{ $ds }}
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="rt" class="col-sm-5 col-form-label faded-label" style="font-style: italic;">RT</label>
                        <div class="col-sm-7 text-dark">
                            : {{ $mahasiswa->rt }}
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="rw" class="col-sm-5 col-form-label faded-label" style="font-style: italic;">RW</label>
                        <div class="col-sm-7 text-dark">
                            : {{ $mahasiswa->rw }}
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="alamat_jalan" class="col-sm-5 col-form-label faded-label" style="font-style: italic;">Alamat Jalan</label>
                        <div class="col-sm-7 text-dark">
                            : {{ $mahasiswa->alamat_jalan }}
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="nama_ayah" class="col-sm-5 col-form-label faded-label" style="font-style: italic;">Nama Ayah</label>
                        <div class="col-sm-7 text-dark">
                            : {{ $mahasiswa->nama_ayah }}
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="nik_ayah" class="col-sm-5 col-form-label faded-label" style="font-style: italic;">NIK Ayah</label>
                        <div class="col-sm-7 text-dark">
                            : {{ $mahasiswa->nik_ayah }}
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="tempat_lahir_ayah" class="col-sm-5 col-form-label faded-label" style="font-style: italic;">Tempat Lahir Ayah</label>
                        <div class="col-sm-7 text-dark">
                            : {{ $mahasiswa->tempat_lahir_ayah }}
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="tanggal_lahir_ayah" class="col-sm-5 col-form-label faded-label" style="font-style: italic;">Tanggal Lahir Ayah</label>
                        <div class="col-sm-7 text-dark">
                            : 
                            <?php
                                // Array untuk mengonversi bulan dalam bahasa Inggris ke bahasa Indonesia
                                $bulan = [
                                    'January'   => 'Januari',
                                    'February'  => 'Februari',
                                    'March'     => 'Maret',
                                    'April'     => 'April',
                                    'May'       => 'Mei',
                                    'June'      => 'Juni',
                                    'July'      => 'Juli',
                                    'August'    => 'Agustus',
                                    'September' => 'September',
                                    'October'   => 'Oktober',
                                    'November'  => 'November',
                                    'December'  => 'Desember'
                                ];
                                
                                // Ubah format tanggal dari "YYYY-MM-DD" menjadi "DD NamaBulan YYYY" dalam bahasa Indonesia
                                $tanggal_lahir_ayah = date('d', strtotime($mahasiswa->tanggal_lahir_ayah)) . ' ' . $bulan[date('F', strtotime($mahasiswa->tanggal_lahir_ayah))] . ' ' . date('Y', strtotime($mahasiswa->tanggal_lahir_ayah));
                                
                                echo $tanggal_lahir_ayah;
                            ?>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="pendidikan_ayah" class="col-sm-5 col-form-label faded-label" style="font-style: italic;">Pendidikan Ayah</label>
                        <div class="col-sm-7 text-dark">
                            : {{ $mahasiswa->pendidikan_ayah }}
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="pekerjaan_ayah" class="col-sm-5 col-form-label faded-label" style="font-style: italic;">Pekerjaan Ayah</label>
                        <div class="col-sm-7 text-dark">
                            : {{ $mahasiswa->pekerjaan_ayah }}
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="penghasilan_ayah" class="col-sm-5 col-form-label faded-label" style="font-style: italic;">Penghasilan Ayah</label>
                        <div class="col-sm-7 text-dark">
                            : {{ $mahasiswa->penghasilan_ayah }}
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="nama_ibu" class="col-sm-5 col-form-label faded-label" style="font-style: italic;">Nama Ibu</label>
                        <div class="col-sm-7 text-dark">
                            : {{ $mahasiswa->nama_ibu }}
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="nik_ibu" class="col-sm-5 col-form-label faded-label" style="font-style: italic;">NIK Ibu</label>
                        <div class="col-sm-7 text-dark">
                            : {{ $mahasiswa->nik_ibu }}
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="tempat_lahir_ibu" class="col-sm-5 col-form-label faded-label" style="font-style: italic;">Tempat Lahir Ibu</label>
                        <div class="col-sm-7 text-dark">
                            : {{ $mahasiswa->tempat_lahir_ibu }}
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="tanggal_lahir_ibu" class="col-sm-5 col-form-label faded-label" style="font-style: italic;">Tanggal Lahir Ibu</label>
                        <div class="col-sm-7 text-dark">
                            : 
                            <?php
                                // Array untuk mengonversi bulan dalam bahasa Inggris ke bahasa Indonesia
                                $bulan = [
                                    'January'   => 'Januari',
                                    'February'  => 'Februari',
                                    'March'     => 'Maret',
                                    'April'     => 'April',
                                    'May'       => 'Mei',
                                    'June'      => 'Juni',
                                    'July'      => 'Juli',
                                    'August'    => 'Agustus',
                                    'September' => 'September',
                                    'October'   => 'Oktober',
                                    'November'  => 'November',
                                    'December'  => 'Desember'
                                ];
                                
                                // Ubah format tanggal dari "YYYY-MM-DD" menjadi "DD NamaBulan YYYY" dalam bahasa Indonesia
                                $tanggal_lahir_ibu = date('d', strtotime($mahasiswa->tanggal_lahir_ibu)) . ' ' . $bulan[date('F', strtotime($mahasiswa->tanggal_lahir_ibu))] . ' ' . date('Y', strtotime($mahasiswa->tanggal_lahir_ibu));
                                
                                echo $tanggal_lahir_ibu;
                            ?>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="pendidikan_ibu" class="col-sm-5 col-form-label faded-label" style="font-style: italic;">Pendidikan Ibu</label>
                        <div class="col-sm-7 text-dark">
                            : {{ $mahasiswa->pendidikan_ibu }}
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="pekerjaan_ibu" class="col-sm-5 col-form-label faded-label" style="font-style: italic;">Pekerjaan Ibu</label>
                        <div class="col-sm-7 text-dark">
                            : {{ $mahasiswa->pekerjaan_ibu }}
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="penghasilan_ibu" class="col-sm-5 col-form-label faded-label" style="font-style: italic;">Penghasilan Ibu</label>
                        <div class="col-sm-7 text-dark">
                            : {{ $mahasiswa->penghasilan_ibu }}
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="nama_wali" class="col-sm-5 col-form-label faded-label" style="font-style: italic;">Nama Wali</label>
                        <div class="col-sm-7 text-dark">
                            : {{ $mahasiswa->nama_wali }}
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="alamat_wali" class="col-sm-5 col-form-label faded-label" style="font-style: italic;">Alamat Wali</label>
                        <div class="col-sm-7 text-dark">
                            : {{ $mahasiswa->alamat_wali }}
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="asal_sekolah" class="col-sm-5 col-form-label faded-label" style="font-style: italic;">Asal Sekolah</label>
                        <div class="col-sm-7 text-dark">
                            : {{ $mahasiswa->asal_sekolah }}
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="jurusan_asal_sekolah" class="col-sm-5 col-form-label faded-label" style="font-style: italic;">Jurusan Asal Sekolah</label>
                        <div class="col-sm-7 text-dark">
                            : {{ $mahasiswa->jurusan_asal_sekolah }}
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="pengalaman_organisasi" class="col-sm-5 col-form-label faded-label" style="font-style: italic;">Pengalaman Organisasi</label>
                        <div class="col-sm-7 text-dark">
                            : {{ $mahasiswa->pengalaman_organisasi }}
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="prodi_id" class="col-sm-5 col-form-label faded-label" style="font-style: italic;">Program Studi</label>
                        <div class="col-sm-7 text-dark">
                            : {{ $mahasiswa->prodi->nama_prodi }}
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="ukt" class="col-sm-5 col-form-label faded-label" style="font-style: italic;">UKT</label>
                        <div class="col-sm-7 text-dark">
                            : {{ $mahasiswa->ukt }}
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="jenis_tinggal_di_cilacap" class="col-sm-5 col-form-label faded-label" style="font-style: italic;">Jenis Tinggal di Cilacap</label>
                        <div class="col-sm-7 text-dark">
                            : {{ $mahasiswa->jenis_tinggal_di_cilacap }}
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="alat_transportasi_ke_kampus" class="col-sm-5 col-form-label faded-label" style="font-style: italic;">Alat Transportasi ke Kampus</label>
                        <div class="col-sm-7 text-dark">
                            : {{ $mahasiswa->alat_transportasi_ke_kampus }}
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="sumber_biaya_kuliah" class="col-sm-5 col-form-label faded-label" style="font-style: italic;">Sumber Biaya Kuliah</label>
                        <div class="col-sm-7 text-dark">
                            : {{ $mahasiswa->sumber_biaya_kuliah }}
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="penerima_kartu_prasejahtera" class="col-sm-5 col-form-label faded-label" style="font-style: italic;">Penerima Kartu Prasejahtera</label>
                        <div class="col-sm-7 text-dark">
                            : {{ $mahasiswa->penerima_kartu_prasejahtera }}
                        </div>
                    </div>
                
                    <div class="form-group row mb-2">
                        <label for="jumlah_tanggungan_keluarga_yang_masih_sekolah" class="col-sm-5 col-form-label faded-label" style="font-style: italic;">Jumlah Tanggungan Keluarga yang Masih Sekolah</label>
                        <div class="col-sm-7 text-dark">
                            : {{ $mahasiswa->jumlah_tanggungan_keluarga_yang_masih_sekolah }}
                        </div>
                    </div>
                
                    <div class="form-group row mb-2">
                        <label for="anak_ke" class="col-sm-5 col-form-label faded-label" style="font-style: italic;">Anak Ke</label>
                        <div class="col-sm-7 text-dark">
                            : {{ $mahasiswa->anak_ke }}
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editData">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Data Mahasiswa</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('mahasiswa.update', $mahasiswa->nim) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group row mb-2">
                        <div class="col-md-4">
                            @if ($mahasiswa->pas_foto)
                            <a href="{{ asset('storage/pas_foto/' . $mahasiswa->pas_foto) }}" target="_blank">
                                <img src="{{ asset('storage/pas_foto/' . $mahasiswa->pas_foto) }}" alt="Foto Mahasiswa" class="img-fluid img-3x4 rounded">
                            </a>
                            @else
                            <p>Foto tidak tersedia</p>
                            @endif
                        </div>                    
                        <div class="col-md-8">
                            <div class="form-group row mb-2">
                                <label for="nim" class="col-sm-5 col-form-label faded-label required-label" style="font-style: italic;">NIM</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control @error('nim') is-invalid @enderror " id="nim" name="nim" value="{{ $mahasiswa->nim }}" readonly>
                                    @error('nim')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="nama_lengkap" class="col-sm-5 col-form-label faded-label required-label" style="font-style: italic;">Nama Lengkap</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" id="nama_lengkap" name="nama_lengkap" value="{{ $mahasiswa->nama_lengkap }}">
                                    @error('nama_lengkap')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="nik" class="col-sm-5 col-form-label faded-label required-label" style="font-style: italic;">NIK</label>
                                <div class="col-sm-7">
                                    <input type="number" class="form-control @error('nik') is-invalid @enderror" id="nik" name="nik" value="{{ $mahasiswa->nik }}">
                                    @error('nik')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="jenis_kelamin" class="col-sm-5 col-form-label faded-label required-label" style="font-style: italic;">Jenis Kelamin</label>
                                <div class="col-sm-7">
                                    <select class="form-control @error('jenis_kelamin') is-invalid @enderror" id="jenis_kelamin" name="jenis_kelamin">
                                        <option value="Laki-Laki" {{ $mahasiswa->jenis_kelamin === 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                                        <option value="Perempuan" {{ $mahasiswa->jenis_kelamin === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <div class="col-sm-7">
                            <div class="custom-file">
                                <input type="file" name="pas_foto" class="custom-file-input @error('pas_foto') is-invalid @enderror" id="input_pas_foto"> <!-- Ganti id menjadi input_pas_foto -->
                                <label class="custom-file-label" for="input_pas_foto" id="label_pas_foto"> <!-- Ganti id menjadi label_pas_foto -->
                                    @if ($mahasiswa->pas_foto)
                                        <p class="text-muted">{{ $mahasiswa->pas_foto }}</p>
                                    @else
                                        <p class="text-muted">Tidak ada foto yang diunggah</p>
                                    @endif
                                </label>
                                @error('pas_foto')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>                            
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="tempat_lahir" class="col-sm-5 col-form-label faded-label required-label" style="font-style: italic;">Tempat Lahir</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir" name="tempat_lahir" value="{{ $mahasiswa->tempat_lahir }}">
                            @error('tempat_lahir')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="tanggal_lahir" class="col-sm-5 col-form-label faded-label required-label" style="font-style: italic;">Tanggal Lahir</label>
                        <div class="col-sm-7">
                            <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" name="tanggal_lahir" value="{{ $mahasiswa->tanggal_lahir }}">
                            @error('tanggal_lahir')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="agama" class="col-sm-5 col-form-label faded-label required-label" style="font-style: italic;">Agama</label>
                        <div class="col-sm-7">
                            <select name="agama" class="form-control @error('agama') is-invalid @enderror">
                                <option value="Islam" {{ $mahasiswa->agama === 'Islam' ? 'selected' : '' }}>Islam</option>
                                <option value="Protestan" {{ $mahasiswa->agama === 'Protestan' ? 'selected' : '' }}>Protestan</option>
                                <option value="Katolik" {{ $mahasiswa->agama === 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                <option value="Hindu" {{ $mahasiswa->agama === 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                <option value="Buddha" {{ $mahasiswa->agama === 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                <option value="Khonghucu" {{ $mahasiswa->agama === 'Khonghucu' ? 'selected' : '' }}>Khonghucu</option>
                                <option value="Lainnya" {{ $mahasiswa->agama === 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            @error('agama')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="email" class="col-sm-5 col-form-label faded-label required-label" style="font-style: italic;">Email</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $mahasiswa->email }}">
                            @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="nohp" class="col-sm-5 col-form-label faded-label required-label" style="font-style: italic;">Nomor HP</label>
                        <div class="col-sm-7">
                            <input type="number" class="form-control @error('nohp') is-invalid @enderror" id="nohp" name="nohp" value="{{ $mahasiswa->nohp }}">
                            @error('nohp')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="provinsi" class="col-sm-5 col-form-label faded-label required-label" style="font-style: italic;">Provinsi</label>
                        <div class="col-sm-7">
                            <select class="form-control" aria-label="Default select example" name="provinsi" id="provinsi">
                                <option value="{{ $mahasiswa->provinsi }}">{{ mb_convert_case($prov, MB_CASE_TITLE) }}</option>
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
                    <div class="form-group row mb-2">
                        <label for="kabupaten" class="col-sm-5 col-form-label faded-label required-label" style="font-style: italic;">Kabupaten</label>
                        <div class="col-sm-7">
                            <select class="form-control" aria-label="Default select example" name="kabupaten" id="kabupaten">
                                <option value="{{ $mahasiswa->kabupaten }}">{{ mb_convert_case($kab, MB_CASE_TITLE) }}</option>   
                            </select>                
                            @error('kabupaten')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="kecamatan" class="col-sm-5 col-form-label faded-label required-label" style="font-style: italic;">Kecamatan</label>
                        <div class="col-sm-7">
                            <select class="form-control" aria-label="Default select example" name="kecamatan" id="kecamatan">
                                <option value="{{ $mahasiswa->kecamatan }}">{{ $kec }}</option>
                            </select>                               
                            @error('kecamatan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="desa_kelurahan" class="col-sm-5 col-form-label faded-label required-label" style="font-style: italic;">Desa/Kelurahan</label>
                        <div class="col-sm-7">
                            <select class="form-control" aria-label="Default select example" name="desa_kelurahan" id="desa_kelurahan">
                                <option value="{{ $mahasiswa->desa_kelurahan }}">{{ $ds }}</option>
                            </select>   
                            @error('desa_kelurahan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="rt" class="col-sm-5 col-form-label faded-label required-label" style="font-style: italic;">RT</label>
                        <div class="col-sm-7">
                            <input type="number" class="form-control @error('rt') is-invalid @enderror" id="rt" name="rt" value="{{ $mahasiswa->rt }}">
                            @error('rt')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="rw" class="col-sm-5 col-form-label faded-label required-label" style="font-style: italic;">RW</label>
                        <div class="col-sm-7">
                            <input type="number" class="form-control @error('rw') is-invalid @enderror" id="rw" name="rw" value="{{ $mahasiswa->rw }}">
                            @error('rw')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="alamat_jalan" class="col-sm-5 col-form-label faded-label required-label" style="font-style: italic;">Alamat Jalan</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control @error('alamat_jalan') is-invalid @enderror" id="alamat_jalan" name="alamat_jalan" value="{{ $mahasiswa->alamat_jalan }}">
                            @error('alamat_jalan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="nama_ayah" class="col-sm-5 col-form-label faded-label required-label" style="font-style: italic;">Nama Ayah</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control @error('nama_ayah') is-invalid @enderror" id="nama_ayah" name="nama_ayah" value="{{ $mahasiswa->nama_ayah }}">
                            @error('nama_ayah')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="nik_ayah" class="col-sm-5 col-form-label faded-label " style="font-style: italic;">NIK Ayah</label>
                        <div class="col-sm-7">
                            <input type="number" class="form-control @error('nik_ayah') is-invalid @enderror" id="nik_ayah" name="nik_ayah" value="{{ $mahasiswa->nik_ayah }}">
                            @error('nik_ayah')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="tempat_lahir_ayah" class="col-sm-5 col-form-label faded-label " style="font-style: italic;">Tempat Lahir Ayah</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control @error('tempat_lahir_ayah') is-invalid @enderror" id="tempat_lahir_ayah" name="tempat_lahir_ayah" value="{{ $mahasiswa->tempat_lahir_ayah }}">
                            @error('tempat_lahir_ayah')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="tanggal_lahir_ayah" class="col-sm-5 col-form-label faded-label " style="font-style: italic;">Tanggal Lahir Ayah</label>
                        <div class="col-sm-7">
                            <input type="date" class="form-control @error('tanggal_lahir_ayah') is-invalid @enderror" id="tanggal_lahir_ayah" name="tanggal_lahir_ayah" value="{{ $mahasiswa->tanggal_lahir_ayah }}">
                            @error('tanggal_lahir_ayah')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="pendidikan_ayah" class="col-sm-5 col-form-label faded-label " style="font-style: italic;">Pendidikan Ayah</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control @error('pendidikan_ayah') is-invalid @enderror" id="pendidikan_ayah" name="pendidikan_ayah" value="{{ $mahasiswa->pendidikan_ayah }}">
                            @error('pendidikan_ayah')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="pekerjaan_ayah" class="col-sm-5 col-form-label faded-label " style="font-style: italic;">Pekerjaan Ayah</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control @error('pekerjaan_ayah') is-invalid @enderror" id="pekerjaan_ayah" name="pekerjaan_ayah" value="{{ $mahasiswa->pekerjaan_ayah }}">
                            @error('pekerjaan_ayah')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="penghasilan_ayah" class="col-sm-5 col-form-label faded-label " style="font-style: italic;">Penghasilan Ayah</label>
                        <div class="col-sm-7">
                            <input type="number" class="form-control @error('penghasilan_ayah') is-invalid @enderror" id="penghasilan_ayah" name="penghasilan_ayah" value="{{ $mahasiswa->penghasilan_ayah }}">
                            @error('penghasilan_ayah')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="nama_ibu" class="col-sm-5 col-form-label faded-label required-label" style="font-style: italic;">Nama Ibu</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control @error('nama_ibu') is-invalid @enderror" id="nama_ibu" name="nama_ibu" value="{{ $mahasiswa->nama_ibu }}">
                            @error('nama_ibu')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="nik_ibu" class="col-sm-5 col-form-label faded-label" style="font-style: italic;">NIK Ibu</label>
                        <div class="col-sm-7">
                            <input type="number" class="form-control @error('nik_ibu') is-invalid @enderror" id="nik_ibu" name="nik_ibu" value="{{ $mahasiswa->nik_ibu }}">
                            @error('nik_ibu')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="tempat_lahir_ibu" class="col-sm-5 col-form-label faded-label" style="font-style: italic;">Tempat Lahir Ibu</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control @error('tempat_lahir_ibu') is-invalid @enderror" id="tempat_lahir_ibu" name="tempat_lahir_ibu" value="{{ $mahasiswa->tempat_lahir_ibu }}">
                            @error('tempat_lahir_ibu')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="tanggal_lahir_ibu" class="col-sm-5 col-form-label faded-label" style="font-style: italic;">Tanggal Lahir Ibu</label>
                        <div class="col-sm-7">
                            <input type="date" class="form-control @error('tanggal_lahir_ibu') is-invalid @enderror" id="tanggal_lahir_ibu" name="tanggal_lahir_ibu" value="{{ $mahasiswa->tanggal_lahir_ibu }}">
                            @error('tanggal_lahir_ibu')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="pendidikan_ibu" class="col-sm-5 col-form-label faded-label" style="font-style: italic;">Pendidikan Ibu</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control @error('pendidikan_ibu') is-invalid @enderror" id="pendidikan_ibu" name="pendidikan_ibu" value="{{ $mahasiswa->pendidikan_ibu }}">
                            @error('pendidikan_ibu')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="pekerjaan_ibu" class="col-sm-5 col-form-label faded-label" style="font-style: italic;">Pekerjaan Ibu</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control @error('pekerjaan_ibu') is-invalid @enderror" id="pekerjaan_ibu" name="pekerjaan_ibu" value="{{ $mahasiswa->pekerjaan_ibu }}">
                            @error('pekerjaan_ibu')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="penghasilan_ibu" class="col-sm-5 col-form-label faded-label" style="font-style: italic;">Penghasilan Ibu</label>
                        <div class="col-sm-7">
                            <input type="number" class="form-control @error('penghasilan_ibu') is-invalid @enderror" id="penghasilan_ibu" name="penghasilan_ibu" value="{{ $mahasiswa->penghasilan_ibu }}">
                            @error('penghasilan_ibu')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="nama_wali" class="col-sm-5 col-form-label faded-label" style="font-style: italic;">Nama Wali</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control @error('nama_wali') is-invalid @enderror" id="nama_wali" name="nama_wali" value="{{ $mahasiswa->nama_wali }}">
                            @error('nama_wali')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="alamat_wali" class="col-sm-5 col-form-label faded-label" style="font-style: italic;">Alamat Wali</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control @error('alamat_wali') is-invalid @enderror" id="alamat_wali" name="alamat_wali" value="{{ $mahasiswa->alamat_wali }}">
                            @error('alamat_wali')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="asal_sekolah" class="col-sm-5 col-form-label faded-label required-label" style="font-style: italic;">Asal Sekolah</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control @error('asal_sekolah') is-invalid @enderror" id="asal_sekolah" name="asal_sekolah" value="{{ $mahasiswa->asal_sekolah }}">
                            @error('asal_sekolah')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="jurusan_asal_sekolah" class="col-sm-5 col-form-label faded-label required-label" style="font-style: italic;">Jurusan Asal Sekolah</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control @error('jurusan_asal_sekolah') is-invalid @enderror" id="jurusan_asal_sekolah" name="jurusan_asal_sekolah" value="{{ $mahasiswa->jurusan_asal_sekolah }}">
                            @error('jurusan_asal_sekolah')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="pengalaman_organisasi" class="col-sm-5 col-form-label faded-label" style="font-style: italic;">Pengalaman Organisasi</label>
                        <div class="col-sm-7">
                            <textarea class="form-control @error('pengalaman_organisasi') is-invalid @enderror" id="pengalaman_organisasi" name="pengalaman_organisasi" rows="3">{{ $mahasiswa->pengalaman_organisasi }}</textarea>
                            @error('pengalaman_organisasi')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="prodi_id" class="col-sm-5 col-form-label faded-label required-label" style="font-style: italic;">Program Studi</label>
                        <div class="col-sm-7">

                            <select class="form-control @error('prodi_id') is-invalid @enderror" id="prodi_id" name="prodi_id" for="prodi_id">
                                <option value="{{ $mahasiswa->prodi_id }}">{{ $mahasiswa->prodi->nama_prodi }}</option>
                                @foreach ($prodi as $programStudi)
                                    <option value="{{ $programStudi->id_prodi }}" >{{ $programStudi->nama_prodi }}</option>
                                @endforeach
                            </select>          

                            @error('prodi_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="ukt" class="col-sm-5 col-form-label faded-label required-label" style="font-style: italic;">UKT</label>
                        <div class="col-sm-7">
                            <input type="number" step="0.01" class="form-control @error('ukt') is-invalid @enderror" id="ukt" name="ukt" value="{{ $mahasiswa->ukt }}">
                            @error('ukt')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="jenis_tinggal_di_cilacap" class="col-sm-5 col-form-label faded-label required-label" style="font-style: italic;">Jenis Tinggal Di Cilacap</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control @error('jenis_tinggal_di_cilacap') is-invalid @enderror" id="jenis_tinggal_di_cilacap" name="jenis_tinggal_di_cilacap" value="{{ $mahasiswa->jenis_tinggal_di_cilacap }}">
                            @error('jenis_tinggal_di_cilacap')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="alat_transportasi_ke_kampus" class="col-sm-5 col-form-label faded-label required-label" style="font-style: italic;">Alat Transportasi ke Kampus</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control @error('alat_transportasi_ke_kampus') is-invalid @enderror" id="alat_transportasi_ke_kampus" name="alat_transportasi_ke_kampus" value="{{ $mahasiswa->alat_transportasi_ke_kampus }}">
                            @error('alat_transportasi_ke_kampus')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="sumber_biaya_kuliah" class="col-sm-5 col-form-label faded-label" style="font-style: italic;">Sumber Biaya Kuliah</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control @error('sumber_biaya_kuliah') is-invalid @enderror" id="sumber_biaya_kuliah" name="sumber_biaya_kuliah" value="{{ $mahasiswa->sumber_biaya_kuliah }}">
                            @error('sumber_biaya_kuliah')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="penerima_kartu_prasejahtera" class="col-sm-5 col-form-label faded-label required-label" style="font-style: italic;">Penerima Kartu Prasejahtera</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control @error('penerima_kartu_prasejahtera') is-invalid @enderror" id="penerima_kartu_prasejahtera" name="penerima_kartu_prasejahtera" value="{{ $mahasiswa->penerima_kartu_prasejahtera }}">
                            @error('penerima_kartu_prasejahtera')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                        </div>
                    </div>
                    
                    <div class="form-group row mb-2">
                        <label for="jumlah_tanggungan_keluarga_yang_masih_sekolah" class="col-sm-5 col-form-label faded-label required-label" style="font-style: italic;">Jumlah Tanggungan Keluarga yang Masih Sekolah</label>
                        <div class="col-sm-7">
                            <input type="number" class="form-control @error('jumlah_tanggungan_keluarga_yang_masih_sekolah') is-invalid @enderror" id="jumlah_tanggungan_keluarga_yang_masih_sekolah" name="jumlah_tanggungan_keluarga_yang_masih_sekolah" value="{{ $mahasiswa->jumlah_tanggungan_keluarga_yang_masih_sekolah }}">
                            @error('jumlah_tanggungan_keluarga_yang_masih_sekolah')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                        </div>
                    </div>
                    
                    <div class="form-group row mb-2">
                        <label for="anak_ke" class="col-sm-5 col-form-label faded-label required-label" style="font-style: italic;">Anak Ke</label>
                        <div class="col-sm-7">
                            <input type="number" class="form-control @error('anak_ke') is-invalid @enderror" id="anak_ke" name="anak_ke" value="{{ $mahasiswa->anak_ke }}">
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

<style>
    .img-3x4 {
    width: 100%;
    height: auto;
    max-width: 150px; /* Atur lebar maksimum sesuai kebutuhan */
    max-height: 200px; /* Atur tinggi maksimum sesuai kebutuhan */
    object-fit: cover;
}
</style>
<script>
    // Ambil elemen input file dan label
    const inputFoto = document.getElementById('input_pas_foto'); // Ganti id menjadi input_pas_foto
    const labelFoto = document.getElementById('label_pas_foto'); // Ganti id menjadi label_pas_foto

    // Tambahkan event listener ketika ada file yang dipilih
    inputFoto.addEventListener('change', function() {
        const fileName = inputFoto.files[0].name;
        labelFoto.innerHTML = fileName;
    });
</script>

@endsection
