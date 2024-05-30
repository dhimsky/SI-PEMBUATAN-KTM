@extends('layouts.main-layout')
@section('tittle', 'Pengajuan KTM')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Tabel Data Mahasiswa</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div class="text-md-right mb-3">
                        <form action="{{ route('pengajuanktm.store') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-secondary"><i class="fa fa-cloud-upload"></i> Ajukan KTM</button>
                        </form>
                    </div>
                <table id="example" class="display text-dark" style="min-width: 845px">
                    <thead>
                        <tr class="text-center">
                            <th>NIM</th>
                            <th>STATUS</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pengajuan as $p)
                        <tr class="text-center">                           
                            <td>{{ $p->nim_id }}</td>
                            <td>
                                <span class="
                                @if($p->status == 'proses')
                                    badge bg-info
                                @elseif($p->status == 'selesai')
                                    badge bg-success
                                @endif">
                                    {{ $p->status }}
                                </span>
                            </td>
                            <td>
                                <a href="" class="btn btn-info" data-toggle="modal" data-target="#detailMahasiswa{{ $p->nim }}" title="Lihat detail">
                                    <i class="fa fa-info"></i>
                                </a>
                                <a href="{{ route('pengajuanktm.destroy', $p->id_pengajuan) }}" class="fa fa-trash btn btn-danger" data-confirm-delete="true" title="Hapus data"></a>
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

@foreach ($pengajuan as $p)
<div class="modal fade" id="detailMahasiswa{{ $p->nim }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Pengajuan KTM</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row mb-2 mt-2">
                    <div class="col-md-4">
                        @if ($p->pas_foto)
                        <a href="{{ asset('storage/pas_foto/' . $p->pas_foto) }}" target="_blank">
                            <img src="{{ asset('storage/pas_foto/' . $p->pas_foto) }}" alt="Foto Mahasiswa" class="img-fluid img-3x4 rounded">
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
                                : {{ $p->nim_id }}
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label for="nama_lengkap" class="col-sm-5 col-form-label faded-label"
                                >Nama Lengkap</label>
                            <div class="col-sm-7 text-dark">
                                : {{ $p->nama_lengkap }}
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label for="nik" class="col-sm-5 col-form-label faded-label"
                                >NIK</label>
                            <div class="col-sm-7 text-dark">
                                : {{ $p->nik }}
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label for="jenis_kelamin" class="col-sm-5 col-form-label faded-label" >Jenis Kelamin</label>
                            <div class="col-sm-7 text-dark">
                                : {{ $p->jenis_kelamin }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="tempat_lahir" class="col-sm-5 col-form-label faded-label" >Tempat Lahir</label>
                    <div class="col-sm-7 text-dark">
                        : {{ $p->tempat_lahir }}
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="tanggal_lahir" class="col-sm-5 col-form-label faded-label" >Tanggal Lahir</label>
                    <div class="col-sm-7 text-dark">
                        : {{ $p->tanggal_lahir }}
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="agama" class="col-sm-5 col-form-label faded-label" >Agama</label>
                    <div class="col-sm-7 text-dark">
                        : {{ $p->agama->nama_agama }}
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="email" class="col-sm-5 col-form-label faded-label" >Email</label>
                    <div class="col-sm-7 text-dark">
                        : {{ $p->email }}
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="nohp" class="col-sm-5 col-form-label faded-label" >Nomor HP</label>
                    <div class="col-sm-7 text-dark">
                        : {{ $p->nohp }}
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="provinsi" class="col-sm-5 col-form-label faded-label" >Provinsi</label>
                    <div class="col-sm-7 text-dark">
                        : {{ $prov }}
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="kabupaten" class="col-sm-5 col-form-label faded-label" >Kabupaten</label>
                    <div class="col-sm-7 text-dark">
                        : {{ $kab }}
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
                        : {{ $p->rt }}
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="rw" class="col-sm-5 col-form-label faded-label" >RW</label>
                    <div class="col-sm-7 text-dark">
                        : {{ $p->rw }}
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="nama_jalan" class="col-sm-5 col-form-label faded-label" >Nama Jalan</label>
                    <div class="col-sm-7 text-dark">
                        : {{ $p->nama_jalan }}
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="nama_ayah" class="col-sm-5 col-form-label faded-label" >Nama Ayah</label>
                    <div class="col-sm-7 text-dark">
                        : {{ $p->nama_ayah }}
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="nik_ayah" class="col-sm-5 col-form-label faded-label" >NIK Ayah</label>
                    <div class="col-sm-7 text-dark">
                        : {{ $p->nik_ayah }}
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="tempat_lahir_ayah" class="col-sm-5 col-form-label faded-label" >Tempat Lahir Ayah</label>
                    <div class="col-sm-7 text-dark">
                        : {{ $p->tempat_lahir_ayah }}
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="tanggal_lahir_ayah" class="col-sm-5 col-form-label faded-label" >Tanggal Lahir Ayah</label>
                    <div class="col-sm-7 text-dark">
                        : {{ $p->tanggal_lahir_ayah }}
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="pendidikan_ayah" class="col-sm-5 col-form-label faded-label" >Pendidikan Ayah</label>
                    <div class="col-sm-7 text-dark">
                        : {{ $p->pendidikan_ayah }}
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="pekerjaan_ayah" class="col-sm-5 col-form-label faded-label" >Pekerjaan Ayah</label>
                    <div class="col-sm-7 text-dark">
                        : {{ $p->pekerjaan_ayah }}
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="penghasilan_ayah" class="col-sm-5 col-form-label faded-label" >Penghasilan Ayah</label>
                    <div class="col-sm-7 text-dark">
                        : {{ $p->penghasilan_ayah }}
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="nama_ibu" class="col-sm-5 col-form-label faded-label" >Nama Ibu</label>
                    <div class="col-sm-7 text-dark">
                        : {{ $p->nama_ibu }}
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="nik_ibu" class="col-sm-5 col-form-label faded-label" >NIK Ibu</label>
                    <div class="col-sm-7 text-dark">
                        : {{ $p->nik_ibu }}
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="tempat_lahir_ibu" class="col-sm-5 col-form-label faded-label" >Tempat Lahir Ibu</label>
                    <div class="col-sm-7 text-dark">
                        : {{ $p->tempat_lahir_ibu }}
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="tanggal_lahir_ibu" class="col-sm-5 col-form-label faded-label" >Tanggal Lahir Ibu</label>
                    <div class="col-sm-7 text-dark">
                        : {{ $p->tanggal_lahir_ibu }}
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="pendidikan_ibu" class="col-sm-5 col-form-label faded-label" >Pendidikan Ibu</label>
                    <div class="col-sm-7 text-dark">
                        : {{ $p->pendidikan_ibu }}
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="pekerjaan_ibu" class="col-sm-5 col-form-label faded-label" >Pekerjaan Ibu</label>
                    <div class="col-sm-7 text-dark">
                        : {{ $p->pekerjaan_ibu }}
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="penghasilan_ibu" class="col-sm-5 col-form-label faded-label" >Penghasilan Ibu</label>
                    <div class="col-sm-7 text-dark">
                        : {{ $p->penghasilan_ibu }}
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="nama_wali" class="col-sm-5 col-form-label faded-label" >Nama Wali</label>
                    <div class="col-sm-7 text-dark">
                        : {{ $p->nama_wali }}
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="alamat_wali" class="col-sm-5 col-form-label faded-label" >Alamat Wali</label>
                    <div class="col-sm-7 text-dark">
                        : {{ $p->alamat_wali }}
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="asal_sekolah" class="col-sm-5 col-form-label faded-label" >Asal Sekolah</label>
                    <div class="col-sm-7 text-dark">
                        : {{ $p->asal_sekolah }}
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="jurusan_asal_sekolah" class="col-sm-5 col-form-label faded-label" >Jurusan Asal Sekolah</label>
                    <div class="col-sm-7 text-dark">
                        : {{ $p->jurusan_asal_sekolah }}
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="pengalaman_organisasi" class="col-sm-5 col-form-label faded-label" >Pengalaman Organisasi</label>
                    <div class="col-sm-7 text-dark">
                        : {{ $p->pengalaman_organisasi }}
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="prodi_id" class="col-sm-5 col-form-label faded-label" >Program Studi</label>
                    <div class="col-sm-7 text-dark">
                        : {{ $p->prodi->nama_prodi }}
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="ukt" class="col-sm-5 col-form-label faded-label" >Uang Kuliah Tunggal</label>
                    <div class="col-sm-7 text-dark">
                        : {{ $p->ukt }}
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="tahun_angkatan" class="col-sm-5 col-form-label faded-label" >Tahun Angkatan</label>
                    <div class="col-sm-7 text-dark">
                        : {{ $p->angkatan->tahun_angkatan }}
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="jenis_tinggal_di_cilacap" class="col-sm-5 col-form-label faded-label" >Jenis Tinggal di Cilacap</label>
                    <div class="col-sm-7 text-dark">
                        : {{ $p->jenis_tinggal_di_cilacap }}
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="alat_transportasi_ke_kampus" class="col-sm-5 col-form-label faded-label" >Alat Transportasi ke Kampus</label>
                    <div class="col-sm-7 text-dark">
                        : {{ $p->alat_transportasi_ke_kampus }}
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="sumber_biaya_kuliah" class="col-sm-5 col-form-label faded-label" >Sumber Biaya Kuliah</label>
                    <div class="col-sm-7 text-dark">
                        : {{ $p->sumber_biaya_kuliah }}
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="penerima_kartu_prasejahtera" class="col-sm-5 col-form-label faded-label" >Penerima Kartu Prasejahtera</label>
                    <div class="col-sm-7 text-dark">
                        : {{ $p->penerima_kartu_prasejahtera }}
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="jumlah_tanggungan_keluarga_yang_masih_sekolah" class="col-sm-5 col-form-label faded-label" >Jumlah Tanggungan Keluarga yang Masih Sekolah</label>
                    <div class="col-sm-7 text-dark">
                        : {{ $p->jumlah_tanggungan_keluarga_yang_masih_sekolah }}
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="anak_ke" class="col-sm-5 col-form-label faded-label" >Anak Ke</label>
                    <div class="col-sm-7 text-dark">
                        : {{ $p->anak_ke }}
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
@endsection