@extends('layouts.main-layout')
@section('tittle', 'Agama')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Tabel Agama</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table id="example" class="display text-dark" style="min-width: 845px">
                    <thead>
                        <tr class="text-center">
                        <th>Kode Agama</th>
                        <th>Agama</th>
                        <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-bordered">
                        @foreach ($agama as $a)
                        <tr class="text-center">
                            <td>{{ $a->id_agama }}</td>
                            <td>{{ $a->nama_agama }}</td>
                            <td>
                                <a href="" class="fa fa-pencil btn btn-warning" data-toggle="modal" data-target=".editAgama{{ $a->id_agama }}" title="Edit agama">
                                </a>
                                <a href="{{ route('agama.destroy', $a->id_agama) }}" class="fa fa-trash btn btn-danger" data-confirm-delete="true" title="Hapus agama">
                                </a>
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

<button class="fa fa-plus wa_btn whatsapp" data-toggle="modal" data-target=".tambahAgama" title="Tambah tahun angkatan"></button>

<div class="modal fade tambahAgama" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Agama</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form action="{{ route('agama.store') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label class="required-label faded-label" for="id_agama">Kode Agama</label>
                    <span><i class="fa fa-question-circle" tabindex="0" data-toggle="popover" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-title="Contoh: IS"></i></span>
                    <input type="text" name="id_agama" class="form-control @error('id_agama') is-invalid @enderror" value="{{ Session::get('id_agama') }}" placeholder="Masukan kode agama">
                    @error('id_agama')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label class="required-label faded-label" for="nama_agama">Nama Agama</label>
                    <input type="text" name="nama_agama" class="form-control @error('nama_agama') is-invalid @enderror" value="{{ Session::get('nama_agama') }}" placeholder="Masukan nama agama">
                    @error('nama_agama')
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

@foreach ($agama as $a)
<div class="modal fade editAgama{{ $a->id_agama }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Agama</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('agama.update', $a->id_agama) }}" method="POST">
                @csrf
                @method('PUT')
                    <div class="form-group mb-3">
                        <label class="required-label faded-label" for="id_agama" >Kode Agama</label>
                        <span><i class="fa fa-question-circle" tabindex="0" data-toggle="popover" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-title="Contoh: IS"></i></span>
                        <input type="text" name="id_agama" class="form-control @error('id_agama') is-invalid @enderror" value="{{$a->id_agama}}" placeholder="Masukan kode agama">
                        @error('id_agama')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="required-label faded-label" for="nama_agama" >Nama Agama</label>
                        <input type="text" name="nama_agama" class="form-control @error('nama_agama') is-invalid @enderror" value="{{$a->nama_agama}}" placeholder="Masukan nama agama">
                        @error('nama_agama')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection