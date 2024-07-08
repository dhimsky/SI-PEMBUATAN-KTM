@extends('layouts.main-layout')
@section('tittle', 'Pengajuan')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Tabel Pengajuan KTM</h4>
            </div>
            <div class="card-body">
                <div class="col-md-12 text-right mb-3">
                    <a href="" class="btn btn-whatsapp" data-toggle="modal" data-target=".modalStatus">
                        Ubah status <i class="fa fa-check-circle"></i></a>
                    <a href="" data-toggle="modal" data-target=".modalExport" class="btn btn-whatsapp" title="Export Data">
                    Export data <i class="fa fa-cloud-download"></i></a>
                </div>
                <form action="{{ route('pengajuan.index') }}" method="GET">
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
                        </div>
                    </form>
                <div class="table-responsive">
                <table id="example" class="display text-dark" style="min-width: 845px">
                    <thead>
                        <tr class="text-center">
                            <th>ID PENGAJUAN</th>
                            <th>NIM</th>
                            <th>PRODI</th>
                            <th>ANGKATAN</th>
                            <th>STATUS <br>PEMBUATAN</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody class="table-bordered">
                        @foreach ($pengajuan as $p)
                        <tr class="text-center">                           
                            <td>{{ $p->id_pengajuan }}</td>
                            <td>{{ $p->nim_id }}</td>
                            <td>{{ $p->prodi->nama_prodi }}</td>
                            <td>{{ $p->angkatan->tahun_angkatan }}</td>
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
                                <a href="" class="btn btn-warning" data-toggle="modal" data-target=".editPengajuan{{ $p->id_pengajuan }}" title="Edit data">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                @if (Auth::user()->role_id == '1')
                                <a href="{{ route('pengajuan.destroy', $p->id_pengajuan) }}" class="fa fa-trash btn btn-danger" data-confirm-delete="true" title="Hapus data"></a>
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
<button class="fa fa-plus wa_btn whatsapp" data-toggle="modal" data-target=".tambahPengajuan" title="Tambah Pengajuan"></button>
@endif

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

<div class="modal fade tambahPengajuan" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Pengajuan</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form action="{{ route('pengajuan.store') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label class="required-label faded-label" for="nim_id" style="font-style: italic;">Nim</label>
                    <input type="text" name="nim_id" class="form-control @error('nim_id') is-invalid @enderror" value="{{ Session::get('nim_id') }}" placeholder="Masukan NIM">
                    @error('nim_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label class="faded-label" for="status" style="font-style: italic;">Status</label>
                        <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                            <option selected disabled value="" style="font-style: italic;">Pilih Status</option>
                            <option value="proses" @if(old('status') == 'proses') selected @endif>Proses</option>
                            <option value="pembuatan ulang" @if(old('status') == 'pembuatan ulang') selected @endif>Pembuatan Ulang</option>
                            <option value="selesai" @if(old('status') == 'selesai') selected @endif>Selesai</option>
                        </select>
                    @error('status')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
            </form>
        </div>
    </div>
</div>

@foreach ($pengajuan as $p)
<div class="modal fade editPengajuan{{ $p->id_pengajuan }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Pengajuan</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form action="{{ route('pengajuan.update', $p->id_pengajuan) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group mb-3">
                    <label class="required-label faded-label" for="nim_id" style="font-style: italic;">NIM</label>
                    <input type="text" name="nim_id" class="form-control @error('nim_id') is-invalid @enderror" value="{{ $p->nim_id }}" readonly>
                    @error('nim_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label class="faded-label" for="status" style="font-style: italic;">Status</label>
                    <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                        <option value="proses" {{ $p->status === 'proses' ? 'selected' : '' }}>Proses</option>
                        <option value="pembuatan ulang" {{ $p->status === 'pembuatan ulang' ? 'selected' : '' }}>Pembuatan Ulang</option>
                        <option value="selesai" {{ $p->status === 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                    @error('status')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
            </form>
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
                <form id="exportForm" action="{{ route('exportdata.exportpengajuan') }}" method="post">
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
                        <button type="button" class="btn btn-dark" onclick="submitForm('{{ route('exportdata.exportpengajuan') }}')">Export Excel</button>
                        <button type="button" class="btn btn-primary" onclick="submitForm('{{ route('exportdata.exportimgpengajuan') }}')">Export Foto</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modalStatus" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">Ubah Status Pengajuan</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('pengajuan.update-status') }}" method="post">
                    @csrf
                    <div class="form-group mb-3">
                        <label class="required-label faded-label" for="prodi_id" >Pilih Prodi</label>
                        <select class="form-control" name="prodi_id" id="prodi_id">
                            <option value="">-- Pilih Prodi --</option>
                            @foreach ($prodi as $programStudi)
                                <option value="{{ $programStudi->id_prodi }}">{{ $programStudi->nama_prodi }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label class="required-label faded-label" for="angkatan_id" >Pilih Angkatan</label>
                        <select class="form-control" name="angkatan_id" id="angkatan_id">
                            <option value="">-- Pilih Angkatan --</option>
                            @foreach ($angkatan as $a)
                                <option value="{{ $a->id_angkatan }}">{{ $a->tahun_angkatan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label class="required-label faded-label" for="status" >Pilih Status Mahasiswa</label>
                        <select class="form-control" name="status" id="status">
                            <option selected value="">-- Pilih Status --</option>
                            <option value="proses">Proses</option>
                            <option value="pembuatan ulang">Pembuatan Ulang</option>
                            <option value="selesai">Selesai</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-dark">Ubah status</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

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