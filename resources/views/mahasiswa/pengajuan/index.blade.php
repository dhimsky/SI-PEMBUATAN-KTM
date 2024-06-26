@extends('layouts.main-layout')
@section('tittle', 'Pengajuan KTM')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Tabel Pengajuan KTM</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div class="text-md-right mb-3">
                        <a href="" class="btn btn-whatsapp" data-toggle="modal" data-target=".ulang">
                            <i class="fa fa-cloud-upload"></i> Ajukan Ulang KTM
                        </a>
                    </div>
                <table id="example" class="display text-dark" style="min-width: 845px">
                    <thead>
                        <tr class="text-center">
                            <th>NIM</th>
                            <th>NAMA LENGKAP</th>
                            <th>NIK</th>
                            <th>STATUS</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pengajuan as $p)
                        <tr class="text-center">                           
                            <td>{{ $p->nim_id }}</td>
                            <td>{{ $p->nama_lengkap }}</td>
                            <td>{{ $p->nik }}</td>
                            <td>
                                <span class="
                                @if($p->status == 'proses')
                                    badge bg-info
                                @elseif($p->status == 'pembuatan ulang')
                                    badge bg-dark text-light
                                @elseif($p->status == 'selesai')
                                    badge bg-success
                                @endif">
                                    {{ $p->status }}
                                </span>
                            </td>
                            <td>
                                <a href="" class="btn btn-info" data-toggle="modal" data-target="#detailPengajuan{{ $p->id_pengajuan }}" title="Lihat detail">
                                    <i class="fa fa-info"></i>
                                </a>
                                @if ($p->status !== 'selesai')
                                <a href="" class="btn btn-whatsapp" data-toggle="modal" data-target=".terima{{ $p->id_pengajuan }}" title="Sudah menerima">
                                    <i class="fa fa-check"></i>
                                </a>
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

@foreach ($pengajuan as $p)
<div class="modal fade" id="detailPengajuan{{ $p->id_pengajuan }}">
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
                    <label for="provinsi" class="col-sm-5 col-form-label faded-label" >Alamat Lengkap</label>
                    <div class="col-sm-7 text-dark">
                        : Jalan {{ $p->nama_jalan }}, RT.{{ $p->rt }}/RW.{{ $p->rw }},
                        Desa {{ DB::table('wilayah')->where('kode', $p->desa_kelurahan)->value('nama') }},
                        Kec. {{ DB::table('wilayah')->where('kode', $p->kecamatan)->value('nama') }},
                        {{ mb_convert_case(DB::table('wilayah')->where('kode', $p->kabupaten)->value('nama'), MB_CASE_TITLE) }},
                        Prov. {{ mb_convert_case(DB::table('wilayah')->where('kode', $p->provinsi)->value('nama'), MB_CASE_TITLE) }}, {{ $p->kode_pos }}
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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endforeach

@foreach ($pengajuan as $p)
<div class="modal fade terima{{ $p->id_pengajuan }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Terima KTM</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body text-dark">Yakin anda sudah menerima KTM?</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal">Batal</button>
                <form action="{{ route('pengajuanktm.selesai') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id_pengajuan" value="{{ $p->id_pengajuan }}">
                    <button type="submit" class="btn btn-primary">Ya, sudah</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

<div class="modal fade ulang" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Pengajuan Ulang KTM</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body text-dark">Yakin ingin mengajukan ulang KTM?</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal">Batal</button>
                <form action="{{ route('pengajuanktm.store') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">Ya, yakin</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection