@extends('layouts.main-layout')
@section('tittle', 'Pengajuan')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Tabel Data Mahasiswa</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table id="example" class="display text-dark" style="min-width: 845px">
                    <thead>
                        <tr class="text-center">
                            <th>ID PENGAJUAN</th>
                            <th>NIM</th>
                            <th>STATUS</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pengajuan as $p)
                        <tr class="text-center">                           
                            <td>{{ $p->id_pengajuan }}</td>
                            <td>{{ $p->nim_id }}</td>
                            <td>
                                <span class="
                                @if($p->status == 'proses')
                                    badge bg-info
                                @elseif($p->status == 'diterima')
                                    badge bg-success
                                @elseif($p->status == 'ditolak')
                                    badge bg-danger
                                @endif">
                                    {{ $p->status }}
                                </span>
                            </td>
                            <td>
                                @if (Auth::user()->role_id == '1')
                                <a href="" class="btn btn-warning" data-toggle="modal" data-target=".editPengajuan{{ $p->id_pengajuan }}" title="Edit data">
                                    <i class="fa fa-pencil"></i>
                                </a>
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
                    <input type="text" name="nim_id" class="form-control @error('nim_id') is-invalid @enderror" value="{{ Session::get('nim_id') }}" >
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
                            <option value="proses" @if(old('status') == 'proses') selected @endif>proses</option>
                            <option value="diterima" @if(old('status') == 'diterima') selected @endif>diterima</option>
                            <option value="ditolak" @if(old('status') == 'ditolak') selected @endif>ditolak</option>
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
                    <input type="text" name="nim_id" class="form-control @error('nim_id') is-invalid @enderror" value="{{ $p->nim_id }}" >
                    @error('nim_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label class="faded-label" for="status" style="font-style: italic;">Status</label>
                    <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                        <option value="proses" {{ $p->status === 'proses' ? 'selected' : '' }}>proses</option>
                        <option value="diterima" {{ $p->status === 'diterima' ? 'selected' : '' }}>diterima</option>
                        <option value="ditolak" {{ $p->status === 'ditolak' ? 'selected' : '' }}>ditolak</option>
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
@endsection