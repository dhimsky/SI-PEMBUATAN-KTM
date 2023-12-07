@extends('layouts.main-layout')
@section('tittle', 'Jurusan')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Tabel Jurusan</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table id="example" class="display text-dark" style="min-width: 845px">
                    <thead>
                        <tr class="text-center">
                        <th>#</th>
                        <th>Id Jurusan</th>
                        <th>Nama Jurusan</th>
                        <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jurusan as $p)
                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $p->id_jurusan }}</td>
                            <td>{{ $p->nama_jurusan }}</td>
                            <td>
                                <a href="" class="fa fa-pencil btn btn-warning" data-toggle="modal" data-target=".editJurusan{{ $p->id_jurusan }}" title="Edit jurusan">
                                </a>
                                <a href="{{ route('jurusan.destroy', $p->id_jurusan) }}" class="fa fa-trash btn btn-danger" data-confirm-delete="true" title="Hapus jurusan">
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

<button class="fa fa-plus wa_btn whatsapp" data-toggle="modal" data-target=".tambahJurusan" title="Tambah jurusan"></button>

<div class="modal fade tambahJurusan" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah jurusan</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form action="{{ route('jurusan.store') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                <label class="required-label faded-label" for="nama_jurusan">Nama jurusan</label>
                <input type="text" name="nama_jurusan" class="form-control @error('nama_jurusan') is-invalid @enderror" value="{{ Session::get('nama_jurusan') }}" placeholder="Masukan Nama Jurusan">
                @error('nama_jurusan')
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

@foreach ($jurusan as $p)
<div class="modal fade editJurusan{{ $p->id_jurusan }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit jurusan</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('jurusan.update', $p->id_jurusan) }}" method="POST">
                @csrf
                @method('PUT')
                    <div class="form-group mb-3">
                        <label class="required-label faded-label" for="id_jurusan" >Id jurusan</label>
                        <input type="number" name="id_jurusan" class="form-control @error('id_jurusan') is-invalid @enderror" value="{{$p->id_jurusan}}" readonly>
                        @error('id_jurusan')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="required-label faded-label" for="nama_jurusan" >Nama jurusan</label>
                        <input type="text" name="nama_jurusan" class="form-control @error('nama_jurusan') is-invalid @enderror" value="{{$p->nama_jurusan}}" placeholder="Masukan Nama Jurusan">
                        @error('nama_jurusan')
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