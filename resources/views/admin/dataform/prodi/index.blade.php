@extends('layouts.main-layout')
@section('tittle', 'Prodi')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Tabel Program Studi</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="display text-dark" style="min-width: 845px">
                        <thead>
                            <tr class="text-center">
                            <th>Kode Prodi</th>
                            <th>Nama Prodi</th>
                            <th>Jenjang</th>
                            <th>Nama Jurusan</th>
                            <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="table-bordered">
                            @foreach ($prodi as $p)
                            <tr class="text-center">
                                <td>{{ $p->id_prodi }}</td>
                                <td>{{ $p->nama_prodi }}</td>
                                <td>{{ $p->jenjang }}</td>
                                <td>{{ $p->jurusan->nama_jurusan }}</td>
                                <td>
                                    <a href="" class="btn btn-warning" data-toggle="modal" data-target=".editProdi{{ $p->id_prodi }}" title="Edit prodi">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a href="{{ route('prodi.destroy', $p->id_prodi) }}" class="fa fa-trash btn btn-danger" data-confirm-delete="true" title="Hapus prodi">
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<button class="fa fa-plus wa_btn whatsapp" data-toggle="modal" data-target=".tambahProdi" title="Tambah prodi"></button>

<div class="modal fade tambahProdi" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Prodi</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('prodi.store') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label class="required-label faded-label" for="id_prodi" >Kode Prodi</label>
                        <span><i class="fa fa-question-circle" tabindex="0" data-toggle="popover" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-title="Contoh: TI"></i></span>
                        <input type="text" name="id_prodi" class="form-control @error('id_prodi') is-invalid @enderror" value="{{ Session::get('id_prodi') }}" placeholder="Masukan kode prodi">
                        @error('id_prodi')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="required-label faded-label" for="nama_prodi" >Nama Prodi</label>
                        <input type="text" name="nama_prodi" class="form-control @error('nama_prodi') is-invalid @enderror" value="{{ Session::get('nama_prodi') }}" placeholder="Masukan nama prodi">
                        @error('nama_prodi')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="required-label faded-label" for="jurusan_id" >Jurusan</label>
                        <select class="form-control" name="jurusan_id" id="jurusan_id">
                            <option selected disabled value="">Pilih Jurusan</option>
                            @foreach ($jurusan as $j)
                            <option value="{{ $j->id_jurusan }}">{{ $j->nama_jurusan }}</option>
                            @endforeach
                        </select>
                        @error('jurusan_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="required-label faded-label" for="jenjang" >Jenjang</label>
                        <select class="form-control" name="jenjang" id="jenjang">
                            <option selected disabled value="">Pilih Jenjang</option>
                            <option value="D3">D3</option>
                            <option value="D4">D4</option>
                        </select>
                        @error('jenjang')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
            </form>
        </div>
    </div>
</div>

@foreach ($prodi as $p)
<div class="modal fade editProdi{{ $p->id_prodi }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Prodi</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('prodi.update', $p->id_prodi) }}" method="POST">
                @csrf
                @method('PUT')
                    <div class="form-group mb-3">
                        <label class="required-label faded-label" for="id_prodi" >Kode Prodi</label>
                        <span><i class="fa fa-question-circle" tabindex="0" data-toggle="popover" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-title="Contoh: TI"></i></span>
                        <input type="text" name="id_prodi" class="form-control @error('id_prodi') is-invalid @enderror" value="{{$p->id_prodi}}" placeholder="Masukan kode prodi" readonly>
                        @error('id_prodi')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="required-label faded-label" for="nama_prodi" >Nama Prodi</label>
                        <input type="text" name="nama_prodi" class="form-control @error('nama_prodi') is-invalid @enderror" value="{{$p->nama_prodi}}" placeholder="Masukan nama prodi">
                        @error('nama_prodi')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="required-label faded-label" for="jurusan_id" >Jurusan</label>
                        <select class="form-control" name="jurusan_id" id="jurusan_id">
                            @foreach ($jurusan as $j)
                                <option value="{{ $j->id_jurusan }}" @if($j->id_jurusan == $p->jurusan_id) selected @endif>{{ $j->nama_jurusan }}</option>
                            @endforeach
                        </select>
                        @error('jurusan_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="required-label faded-label" for="jenjang" >Jenjang</label>
                        <select class="form-control" name="jenjang" id="jenjang">
                            <option value="D3" {{ $p->jenjang === 'D3' ? 'selected' : '' }}>D3</option>
                            <option value="D4" {{ $p->jenjang === 'D4' ? 'selected' : '' }}>D4</option>
                        </select>
                        @error('jenjang')
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

