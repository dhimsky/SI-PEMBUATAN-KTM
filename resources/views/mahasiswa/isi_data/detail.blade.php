@extends('layouts.main-layout')
@section('tittle', 'Data Mahasiswa')
@section('content')
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
                            class="btn btn-secondary">
                        <i class="fa fa-id-card"></i></a>
                        <a href="" class="btn btn-secondary" data-toggle="modal" data-target="#editData">
                            <i class="fa fa-pencil"></i>
                        </a>
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
                                    >NIM</label>
                                <div class="col-sm-7 text-dark">
                                    : {{ $mahasiswa->nim }}
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="nama_lengkap" class="col-sm-5 col-form-label faded-label"
                                    >Nama Lengkap</label>
                                <div class="col-sm-7 text-dark">
                                    : {{ $mahasiswa->nama_lengkap }}
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="nik" class="col-sm-5 col-form-label faded-label"
                                    >NIK</label>
                                <div class="col-sm-7 text-dark">
                                    : {{ $mahasiswa->nik }}
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="jenis_kelamin" class="col-sm-5 col-form-label faded-label" >Jenis Kelamin</label>
                                <div class="col-sm-7 text-dark">
                                    : {{ $mahasiswa->jenis_kelamin }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="tempat_lahir" class="col-sm-5 col-form-label faded-label" >Tempat Lahir</label>
                        <div class="col-sm-7 text-dark">
                            : {{ $mahasiswa->tempat_lahir }}
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="tanggal_lahir" class="col-sm-5 col-form-label faded-label" >Tanggal Lahir</label>
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
                        <label for="agama" class="col-sm-5 col-form-label faded-label" >Agama</label>
                        <div class="col-sm-7 text-dark">
                            : {{ $mahasiswa->agama->nama_agama }}
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="email" class="col-sm-5 col-form-label faded-label" >Email</label>
                        <div class="col-sm-7 text-dark">
                            : {{ $mahasiswa->email }}
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="nohp" class="col-sm-5 col-form-label faded-label" >Nomor HP</label>
                        <div class="col-sm-7 text-dark">
                            : {{ $mahasiswa->nohp }}
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="provinsi" class="col-sm-5 col-form-label faded-label" >Provinsi</label>
                        <div class="col-sm-7 text-dark">
                            : {{ mb_convert_case($prov, MB_CASE_TITLE) }}
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="kabupaten" class="col-sm-5 col-form-label faded-label" >Kabupaten</label>
                        <div class="col-sm-7 text-dark">
                            : {{ mb_convert_case($kab, MB_CASE_TITLE) }}
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="kecamatan" class="col-sm-5 col-form-label faded-label" >Kecamatan</label>
                        <div class="col-sm-7 text-dark">
                            : {{ $kec }}
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="desa_kelurahan" class="col-sm-5 col-form-label faded-label" >Desa/Kelurahan</label>
                        <div class="col-sm-7 text-dark">
                            : {{ $ds }}
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="rt" class="col-sm-5 col-form-label faded-label" >RT</label>
                        <div class="col-sm-7 text-dark">
                            : {{ $mahasiswa->rt }}
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="rw" class="col-sm-5 col-form-label faded-label" >RW</label>
                        <div class="col-sm-7 text-dark">
                            : {{ $mahasiswa->rw }}
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="alamat_jalan" class="col-sm-5 col-form-label faded-label" >Alamat Jalan</label>
                        <div class="col-sm-7 text-dark">
                            : {{ $mahasiswa->alamat_jalan }}
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="nama_ayah" class="col-sm-5 col-form-label faded-label" >Nama Ayah</label>
                        <div class="col-sm-7 text-dark">
                            : {{ $mahasiswa->nama_ayah }}
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="nik_ayah" class="col-sm-5 col-form-label faded-label" >NIK Ayah</label>
                        <div class="col-sm-7 text-dark">
                            : {{ $mahasiswa->nik_ayah }}
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="tempat_lahir_ayah" class="col-sm-5 col-form-label faded-label" >Tempat Lahir Ayah</label>
                        <div class="col-sm-7 text-dark">
                            : {{ $mahasiswa->tempat_lahir_ayah }}
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="tanggal_lahir_ayah" class="col-sm-5 col-form-label faded-label" >Tanggal Lahir Ayah</label>
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
                        <label for="pendidikan_ayah" class="col-sm-5 col-form-label faded-label" >Pendidikan Ayah</label>
                        <div class="col-sm-7 text-dark">
                            : {{ $mahasiswa->pendidikan_ayah }}
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="pekerjaan_ayah" class="col-sm-5 col-form-label faded-label" >Pekerjaan Ayah</label>
                        <div class="col-sm-7 text-dark">
                            : {{ $mahasiswa->pekerjaan_ayah }}
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="penghasilan_ayah" class="col-sm-5 col-form-label faded-label" >Penghasilan Ayah</label>
                        <div class="col-sm-7 text-dark">
                            : {{ $mahasiswa->penghasilan_ayah }}
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="nama_ibu" class="col-sm-5 col-form-label faded-label" >Nama Ibu</label>
                        <div class="col-sm-7 text-dark">
                            : {{ $mahasiswa->nama_ibu }}
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="nik_ibu" class="col-sm-5 col-form-label faded-label" >NIK Ibu</label>
                        <div class="col-sm-7 text-dark">
                            : {{ $mahasiswa->nik_ibu }}
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="tempat_lahir_ibu" class="col-sm-5 col-form-label faded-label" >Tempat Lahir Ibu</label>
                        <div class="col-sm-7 text-dark">
                            : {{ $mahasiswa->tempat_lahir_ibu }}
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="tanggal_lahir_ibu" class="col-sm-5 col-form-label faded-label" >Tanggal Lahir Ibu</label>
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
                        <label for="pendidikan_ibu" class="col-sm-5 col-form-label faded-label" >Pendidikan Ibu</label>
                        <div class="col-sm-7 text-dark">
                            : {{ $mahasiswa->pendidikan_ibu }}
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="pekerjaan_ibu" class="col-sm-5 col-form-label faded-label" >Pekerjaan Ibu</label>
                        <div class="col-sm-7 text-dark">
                            : {{ $mahasiswa->pekerjaan_ibu }}
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="penghasilan_ibu" class="col-sm-5 col-form-label faded-label" >Penghasilan Ibu</label>
                        <div class="col-sm-7 text-dark">
                            : {{ $mahasiswa->penghasilan_ibu }}
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="nama_wali" class="col-sm-5 col-form-label faded-label" >Nama Wali</label>
                        <div class="col-sm-7 text-dark">
                            : {{ $mahasiswa->nama_wali }}
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="alamat_wali" class="col-sm-5 col-form-label faded-label" >Alamat Wali</label>
                        <div class="col-sm-7 text-dark">
                            : {{ $mahasiswa->alamat_wali }}
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="asal_sekolah" class="col-sm-5 col-form-label faded-label" >Asal Sekolah</label>
                        <div class="col-sm-7 text-dark">
                            : {{ $mahasiswa->asal_sekolah }}
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="jurusan_asal_sekolah" class="col-sm-5 col-form-label faded-label" >Jurusan Asal Sekolah</label>
                        <div class="col-sm-7 text-dark">
                            : {{ $mahasiswa->jurusan_asal_sekolah }}
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="pengalaman_organisasi" class="col-sm-5 col-form-label faded-label" >Pengalaman Organisasi</label>
                        <div class="col-sm-7 text-dark">
                            : {{ $mahasiswa->pengalaman_organisasi }}
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="prodi_id" class="col-sm-5 col-form-label faded-label" >Program Studi</label>
                        <div class="col-sm-7 text-dark">
                            : {{ $mahasiswa->prodi->nama_prodi }}
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="ukt" class="col-sm-5 col-form-label faded-label" >UKT</label>
                        <div class="col-sm-7 text-dark">
                            : {{ $mahasiswa->ukt }}
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="angkatan_id" class="col-sm-5 col-form-label faded-label" >Tahun Angkatan</label>
                        <div class="col-sm-7 text-dark">
                            : {{ $mahasiswa->angkatan->tahun_angkatan }}
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="jenis_tinggal_di_cilacap" class="col-sm-5 col-form-label faded-label" >Jenis Tinggal di Cilacap</label>
                        <div class="col-sm-7 text-dark">
                            : {{ $mahasiswa->jenis_tinggal_di_cilacap }}
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="alat_transportasi_ke_kampus" class="col-sm-5 col-form-label faded-label" >Alat Transportasi ke Kampus</label>
                        <div class="col-sm-7 text-dark">
                            : {{ $mahasiswa->alat_transportasi_ke_kampus }}
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="sumber_biaya_kuliah" class="col-sm-5 col-form-label faded-label" >Sumber Biaya Kuliah</label>
                        <div class="col-sm-7 text-dark">
                            : {{ $mahasiswa->sumber_biaya_kuliah }}
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="penerima_kartu_prasejahtera" class="col-sm-5 col-form-label faded-label" >Penerima Kartu Prasejahtera</label>
                        <div class="col-sm-7 text-dark">
                            : {{ $mahasiswa->penerima_kartu_prasejahtera }}
                        </div>
                    </div>
                
                    <div class="form-group row mb-2">
                        <label for="jumlah_tanggungan_keluarga_yang_masih_sekolah" class="col-sm-5 col-form-label faded-label" >Jumlah Tanggungan Keluarga yang Masih Sekolah</label>
                        <div class="col-sm-7 text-dark">
                            : {{ $mahasiswa->jumlah_tanggungan_keluarga_yang_masih_sekolah }}
                        </div>
                    </div>
                
                    <div class="form-group row mb-2">
                        <label for="anak_ke" class="col-sm-5 col-form-label faded-label" >Anak Ke</label>
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
                                <img id="previewImg" src="{{ asset('storage/pas_foto/' . $mahasiswa->pas_foto) }}" alt="Foto Mahasiswa" class="img-fluid img-3x4 rounded">
                            </a>
                            @else
                            <p>Foto tidak tersedia</p>
                            @endif
                        </div>                  
                        <div class="col-md-8">
                            <div class="form-group row mb-2">
                                <label for="nim" class="col-sm-5 col-form-label faded-label required-label" >NIM</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control @error('nim') is-invalid @enderror " id="nim" name="nim" value="{{ $mahasiswa->nim }}" readonly placeholder="Contoh: 210202098">
                                    @error('nim')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="nama_lengkap" class="col-sm-5 col-form-label faded-label required-label" >Nama Lengkap</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" id="nama_lengkap" name="nama_lengkap" value="{{ $mahasiswa->nama_lengkap }}" placeholder="Masukan nama lengkap">
                                    @error('nama_lengkap')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="nik" class="col-sm-5 col-form-label faded-label required-label" >NIK</label>
                                <div class="col-sm-7">
                                    <input type="number" class="form-control @error('nik') is-invalid @enderror" id="nik" name="nik" value="{{ $mahasiswa->nik }}" placeholder="Masukan sesuai KTP">
                                    @error('nik')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="jenis_kelamin" class="col-sm-5 col-form-label faded-label required-label" >Jenis Kelamin</label>
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
                                <input type="file" name="pas_foto" class="custom-file-input @error('pas_foto') is-invalid @enderror" id="input_pas_foto">
                                <label class="custom-file-label" for="input_pas_foto" id="label_pas_foto"> 
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
                        <label for="tempat_lahir" class="col-sm-5 col-form-label faded-label required-label" >Tempat Lahir</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir" name="tempat_lahir" value="{{ $mahasiswa->tempat_lahir }}" placeholder="Contoh: Cilacap">
                            @error('tempat_lahir')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="tanggal_lahir" class="col-sm-5 col-form-label faded-label required-label" >Tanggal Lahir</label>
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
                        <label for="agama_id" class="col-sm-5 col-form-label faded-label required-label" >Agama</label>
                        <div class="col-sm-7">
                            <select class="form-control @error('agama_id') is-invalid @enderror" id="agama_id" name="agama_id" for="agama_id">
                                @foreach ($agama as $a)
                                    <option value="{{ $a->id_agama }}" {{ $a->id_agama === $a->agama_id ? 'selected' : '' }}>{{ $a->nama_agama }}</option>
                                @endforeach
                            </select> 
                            @error('agama_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="email" class="col-sm-5 col-form-label faded-label required-label" >Email</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $mahasiswa->email }}" placeholder="Contoh: mahasiswa15@gmail.com">
                            @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="nohp" class="col-sm-5 col-form-label faded-label required-label" >Nomor HP</label>
                        <div class="col-sm-7">
                            <input type="number" class="form-control @error('nohp') is-invalid @enderror" id="nohp" name="nohp" value="{{ $mahasiswa->nohp }}" placeholder="Contoh: 08932628238">
                            @error('nohp')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="provinsi" class="col-sm-5 col-form-label faded-label required-label" >Provinsi</label>
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
                        <label for="kabupaten" class="col-sm-5 col-form-label faded-label required-label" >Kabupaten</label>
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
                        <label for="kecamatan" class="col-sm-5 col-form-label faded-label required-label" >Kecamatan</label>
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
                        <label for="desa_kelurahan" class="col-sm-5 col-form-label faded-label required-label" >Desa/Kelurahan</label>
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
                        <label for="rt" class="col-sm-5 col-form-label faded-label required-label" >RT</label>
                        <div class="col-sm-7">
                            <input type="number" class="form-control @error('rt') is-invalid @enderror" id="rt" name="rt" value="{{ $mahasiswa->rt }}" placeholder="Contoh: 003">
                            @error('rt')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="rw" class="col-sm-5 col-form-label faded-label required-label" >RW</label>
                        <div class="col-sm-7">
                            <input type="number" class="form-control @error('rw') is-invalid @enderror" id="rw" name="rw" value="{{ $mahasiswa->rw }}" placeholder="Contoh: 004">
                            @error('rw')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="alamat_jalan" class="col-sm-5 col-form-label faded-label required-label" >Alamat Jalan</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control @error('alamat_jalan') is-invalid @enderror" id="alamat_jalan" name="alamat_jalan" value="{{ $mahasiswa->alamat_jalan }}" placeholder="Contoh: Jl. Melati No.003">
                            @error('alamat_jalan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="nama_ayah" class="col-sm-5 col-form-label faded-label required-label" >Nama Ayah</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control @error('nama_ayah') is-invalid @enderror" id="nama_ayah" name="nama_ayah" value="{{ $mahasiswa->nama_ayah }}" placeholder="Masukan nama ayah kandung">
                            @error('nama_ayah')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="nik_ayah" class="col-sm-5 col-form-label faded-label " >NIK Ayah</label>
                        <div class="col-sm-7">
                            <input type="number" class="form-control @error('nik_ayah') is-invalid @enderror" id="nik_ayah" name="nik_ayah" value="{{ $mahasiswa->nik_ayah }}" placeholder="Masukan NIK ayah">
                            @error('nik_ayah')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="tempat_lahir_ayah" class="col-sm-5 col-form-label faded-label " >Tempat Lahir Ayah</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control @error('tempat_lahir_ayah') is-invalid @enderror" id="tempat_lahir_ayah" name="tempat_lahir_ayah" value="{{ $mahasiswa->tempat_lahir_ayah }}" placeholder="Contoh: Cilacap">
                            @error('tempat_lahir_ayah')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="tanggal_lahir_ayah" class="col-sm-5 col-form-label faded-label " >Tanggal Lahir Ayah</label>
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
                        <label for="pendidikan_ayah" class="col-sm-5 col-form-label faded-label " >Pendidikan Ayah</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control @error('pendidikan_ayah') is-invalid @enderror" id="pendidikan_ayah" name="pendidikan_ayah" value="{{ $mahasiswa->pendidikan_ayah }}" placeholder="Contoh: SMA, SLTA, S1, dsb.">
                            @error('pendidikan_ayah')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="pekerjaan_ayah" class="col-sm-5 col-form-label faded-label " >Pekerjaan Ayah</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control @error('pekerjaan_ayah') is-invalid @enderror" id="pekerjaan_ayah" name="pekerjaan_ayah" value="{{ $mahasiswa->pekerjaan_ayah }}" placeholder="Contoh: Guru, Petani, dsb.">
                            @error('pekerjaan_ayah')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="penghasilan_ayah" class="col-sm-5 col-form-label faded-label " >Penghasilan Ayah</label>
                        <div class="col-sm-7">
                            <select class="form-control @error('penghasilan_ayah') is-invalid @enderror" id="penghasilan_ayah" name="penghasilan_ayah">
                                <option value="<1jt" {{ $mahasiswa->penghasilan_ayah === '<1jt' ? 'selected' : '' }}>&lt; 1jt</option>
                                <option value="1jt - 2jt" {{ $mahasiswa->penghasilan_ayah === '1jt - 2jt' ? 'selected' : '' }}>1jt - 2jt</option>
                                <option value="2jt - 3jt" {{ $mahasiswa->penghasilan_ayah === '2jt - 3jt' ? 'selected' : '' }}>2jt - 3jt</option>
                                <option value="3jt - 4jt" {{ $mahasiswa->penghasilan_ayah === '3jt - 4jt' ? 'selected' : '' }}>3jt - 4jt</option>
                                <option value=">5jt" {{ $mahasiswa->penghasilan_ayah === '>5jt' ? 'selected' : '' }}>&gt; 5jt</option>
                            </select>
                            @error('penghasilan_ayah')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="nama_ibu" class="col-sm-5 col-form-label faded-label required-label" >Nama Ibu</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control @error('nama_ibu') is-invalid @enderror" id="nama_ibu" name="nama_ibu" value="{{ $mahasiswa->nama_ibu }}" placeholder="Masukan nama ibu kandung">
                            @error('nama_ibu')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="nik_ibu" class="col-sm-5 col-form-label faded-label" >NIK Ibu</label>
                        <div class="col-sm-7">
                            <input type="number" class="form-control @error('nik_ibu') is-invalid @enderror" id="nik_ibu" name="nik_ibu" value="{{ $mahasiswa->nik_ibu }}" placeholder="Masukan NIK ibu">
                            @error('nik_ibu')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="tempat_lahir_ibu" class="col-sm-5 col-form-label faded-label" >Tempat Lahir Ibu</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control @error('tempat_lahir_ibu') is-invalid @enderror" id="tempat_lahir_ibu" name="tempat_lahir_ibu" value="{{ $mahasiswa->tempat_lahir_ibu }}" placeholder="Contoh: Cilacap">
                            @error('tempat_lahir_ibu')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="tanggal_lahir_ibu" class="col-sm-5 col-form-label faded-label" >Tanggal Lahir Ibu</label>
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
                        <label for="pendidikan_ibu" class="col-sm-5 col-form-label faded-label" >Pendidikan Ibu</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control @error('pendidikan_ibu') is-invalid @enderror" id="pendidikan_ibu" name="pendidikan_ibu" value="{{ $mahasiswa->pendidikan_ibu }}" placeholder="Contoh: SMA, SLTA, S1, dsb.">
                            @error('pendidikan_ibu')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="pekerjaan_ibu" class="col-sm-5 col-form-label faded-label" >Pekerjaan Ibu</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control @error('pekerjaan_ibu') is-invalid @enderror" id="pekerjaan_ibu" name="pekerjaan_ibu" value="{{ $mahasiswa->pekerjaan_ibu }}" placeholder="Contoh: Guru, Ibu rumah tangga, dsb.">
                            @error('pekerjaan_ibu')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="penghasilan_ibu" class="col-sm-5 col-form-label faded-label" >Penghasilan Ibu</label>
                        <div class="col-sm-7">
                            <select class="form-control @error('penghasilan_ibu') is-invalid @enderror" id="penghasilan_ibu" name="penghasilan_ibu">
                                <option value="<1jt" {{ $mahasiswa->penghasilan_ibu === '<1jt' ? 'selected' : '' }}>&lt; 1jt</option>
                                <option value="1jt - 2jt" {{ $mahasiswa->penghasilan_ibu === '1jt - 2jt' ? 'selected' : '' }}>1jt - 2jt</option>
                                <option value="2jt - 3jt" {{ $mahasiswa->penghasilan_ibu === '2jt - 3jt' ? 'selected' : '' }}>2jt - 3jt</option>
                                <option value="3jt - 4jt" {{ $mahasiswa->penghasilan_ibu === '3jt - 4jt' ? 'selected' : '' }}>3jt - 4jt</option>
                                <option value=">5jt" {{ $mahasiswa->penghasilan_ibu === '>5jt' ? 'selected' : '' }}>&gt; 5jt</option>
                            </select>
                            @error('penghasilan_ibu')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="nama_wali" class="col-sm-5 col-form-label faded-label" >Nama Wali</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control @error('nama_wali') is-invalid @enderror" id="nama_wali" name="nama_wali" value="{{ $mahasiswa->nama_wali }}" placeholder="Masukan nama wali">
                            @error('nama_wali')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="alamat_wali" class="col-sm-5 col-form-label faded-label" >Alamat Wali</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control @error('alamat_wali') is-invalid @enderror" id="alamat_wali" name="alamat_wali" value="{{ $mahasiswa->alamat_wali }}" placeholder="Contoh: Jl. Melati, RT.003/RW.004 Ds. Wlahar, Kec. Adipala, Kab. Cilacap">
                            @error('alamat_wali')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="asal_sekolah" class="col-sm-5 col-form-label faded-label required-label" >Asal Sekolah</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control @error('asal_sekolah') is-invalid @enderror" id="asal_sekolah" name="asal_sekolah" value="{{ $mahasiswa->asal_sekolah }}" placeholder="Contoh: SMA Negeri 01 Kroya">
                            @error('asal_sekolah')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="jurusan_asal_sekolah" class="col-sm-5 col-form-label faded-label required-label" >Jurusan Asal Sekolah</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control @error('jurusan_asal_sekolah') is-invalid @enderror" id="jurusan_asal_sekolah" name="jurusan_asal_sekolah" value="{{ $mahasiswa->jurusan_asal_sekolah }}" placeholder="Contoh: MIPA, IPS, TKJ, dsb.">
                            @error('jurusan_asal_sekolah')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="pengalaman_organisasi" class="col-sm-5 col-form-label faded-label" >Pengalaman Organisasi</label>
                        <div class="col-sm-7">
                            <textarea class="form-control @error('pengalaman_organisasi') is-invalid @enderror" id="pengalaman_organisasi" name="pengalaman_organisasi" rows="3" placeholder="Contoh: Osis, Pramuka, dsb.">{{ $mahasiswa->pengalaman_organisasi }}</textarea>
                            @error('pengalaman_organisasi')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="prodi_id" class="col-sm-5 col-form-label faded-label required-label" >Program Studi</label>
                        <div class="col-sm-7">
                            <select class="form-control @error('prodi_id') is-invalid @enderror" id="prodi_id" name="prodi_id" for="prodi_id">
                                @foreach ($prodi as $programStudi)
                                    <option value="{{ $programStudi->id_prodi }}" {{ $programStudi->id_prodi === $programStudi->prodi_id ? 'selected' : '' }}>{{ $programStudi->nama_prodi }}</option>
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
                        <label for="ukt" class="col-sm-5 col-form-label faded-label required-label" >Uang Kuliah Tunggal</label>
                        <div class="col-sm-7">
                            <input type="number" step="0.01" class="form-control @error('ukt') is-invalid @enderror" id="ukt" name="ukt" value="{{ $mahasiswa->ukt }}" placeholder="Masukan nominal UKT anda">
                            @error('ukt')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="angkatan_id" class="col-sm-5 col-form-label faded-label required-label" >Program Studi</label>
                        <div class="col-sm-7">
                            <select class="form-control @error('angkatan_id') is-invalid @enderror" id="angkatan_id" name="angkatan_id" for="angkatan_id">
                                @foreach ($angkatan as $ta)
                                    <option value="{{ $ta->id_angkatan }}" {{ $ta->id_angkatan === $ta->angkatan_id ? 'selected' : '' }}>{{ $ta->tahun_angkatan }}</option>
                                @endforeach
                            </select>          
                            @error('angkatan_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="jenis_tinggal_di_cilacap" class="col-sm-5 col-form-label faded-label required-label" >Jenis Tinggal Di Cilacap</label>
                        <div class="col-sm-7">
                            <select class="form-control @error('jenis_tinggal_di_cilacap') is-invalid @enderror" id="jenis_tinggal_di_cilacap" name="jenis_tinggal_di_cilacap">
                                <option value="Rumah Orang Tua" {{ $mahasiswa->jenis_tinggal_di_cilacap === 'Rumah Orang tua' ? 'selected' : '' }}>Rumah Orang tua</option>
                                <option value="Wali" {{ $mahasiswa->jenis_tinggal_di_cilacap === 'Wali' ? 'selected' : '' }}>Wali</option>
                                <option value="Kost" {{ $mahasiswa->jenis_tinggal_di_cilacap === 'Kost' ? 'selected' : '' }}>Kost</option>
                                <option value="Panti Asuhan" {{ $mahasiswa->jenis_tinggal_di_cilacap === 'Panti Asuhan' ? 'selected' : '' }}>Panti Asuhan</option>
                                <option value="Asrama" {{ $mahasiswa->jenis_tinggal_di_cilacap === 'Asrama' ? 'selected' : '' }}>Asrama</option>
                                <option value="Lainnya" {{ $mahasiswa->jenis_tinggal_di_cilacap === 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            @error('jenis_tinggal_di_cilacap')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="alat_transportasi_ke_kampus" class="col-sm-5 col-form-label faded-label required-label" >Alat Transportasi ke Kampus</label>
                        <div class="col-sm-7">
                            <select class="form-control @error('alat_transportasi_ke_kampus') is-invalid @enderror" id="alat_transportasi_ke_kampus" name="alat_transportasi_ke_kampus">
                                <option value="Motor" {{ $mahasiswa->alat_transportasi_ke_kampus === 'Motor' ? 'selected' : '' }}>Motor</option>
                                <option value="Angkutan Umum" {{ $mahasiswa->alat_transportasi_ke_kampus === 'Angkutan Umum' ? 'selected' : '' }}>Angkutan Umum</option>
                                <option value="Jalan Kaki" {{ $mahasiswa->alat_transportasi_ke_kampus === 'Jalan Kaki' ? 'selected' : '' }}>Jalan Kaki</option>
                                <option value="Numpang Teman" {{ $mahasiswa->alat_transportasi_ke_kampus === 'Numpang Teman' ? 'selected' : '' }}>Numpang Teman</option>
                                <option value="Antar Jemput" {{ $mahasiswa->alat_transportasi_ke_kampus === 'Antar Jemput' ? 'selected' : '' }}>Antar Jemput</option>
                                <option value="Ojek" {{ $mahasiswa->alat_transportasi_ke_kampus === 'Ojek' ? 'selected' : '' }}>Ojek</option>
                                <option value="Lainnya" {{ $mahasiswa->alat_transportasi_ke_kampus === 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            @error('alat_transportasi_ke_kampus')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="sumber_biaya_kuliah" class="col-sm-5 col-form-label faded-label" >Sumber Biaya Kuliah</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control @error('sumber_biaya_kuliah') is-invalid @enderror" id="sumber_biaya_kuliah" name="sumber_biaya_kuliah" value="{{ $mahasiswa->sumber_biaya_kuliah }}" placeholder="Contoh: Orang tua">
                            @error('sumber_biaya_kuliah')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="penerima_kartu_prasejahtera" class="col-sm-5 col-form-label faded-label required-label" >Penerima Kartu Prasejahtera</label>
                        <div class="col-sm-7">
                            <select class="form-control @error('penerima_kartu_prasejahtera') is-invalid @enderror" id="penerima_kartu_prasejahtera" name="penerima_kartu_prasejahtera">
                                <option value="Ya" {{ $mahasiswa->penerima_kartu_prasejahtera === 'Ya' ? 'selected' : '' }}>Ya</option>
                                <option value="Tidak" {{ $mahasiswa->penerima_kartu_prasejahtera === 'Tidak' ? 'selected' : '' }}>Tidak</option>
                            </select>
                            @error('penerima_kartu_prasejahtera')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                        </div>
                    </div>
                    
                    <div class="form-group row mb-2">
                        <label for="jumlah_tanggungan_keluarga_yang_masih_sekolah" class="col-sm-5 col-form-label faded-label required-label" >Jumlah Tanggungan Keluarga yang Masih Sekolah</label>
                        <div class="col-sm-7">
                            <input type="number" class="form-control @error('jumlah_tanggungan_keluarga_yang_masih_sekolah') is-invalid @enderror" id="jumlah_tanggungan_keluarga_yang_masih_sekolah" name="jumlah_tanggungan_keluarga_yang_masih_sekolah" value="{{ $mahasiswa->jumlah_tanggungan_keluarga_yang_masih_sekolah }}" placeholder="Contoh: 3">
                            @error('jumlah_tanggungan_keluarga_yang_masih_sekolah')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                        </div>
                    </div>
                    
                    <div class="form-group row mb-2">
                        <label for="anak_ke" class="col-sm-5 col-form-label faded-label required-label" >Anak Ke</label>
                        <div class="col-sm-7">
                            <input type="number" class="form-control @error('anak_ke') is-invalid @enderror" id="anak_ke" name="anak_ke" value="{{ $mahasiswa->anak_ke }}" placeholder="Contoh: 2">
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
    max-width: 150px;
    max-height: 200px;
    object-fit: cover;
}
</style>
<script>
    const inputFoto = document.getElementById('input_pas_foto');
    const labelFoto = document.getElementById('label_pas_foto');
    const previewImg = document.getElementById('previewImg');

    inputFoto.addEventListener('change', function() {
        const fileName = inputFoto.files[0].name;
        labelFoto.innerHTML = fileName;
        const file = inputFoto.files[0];
        const reader = new FileReader();

        reader.onload = function(e) {
            previewImg.src = e.target.result;
        }

        reader.readAsDataURL(file);
    });
</script>

@endsection
