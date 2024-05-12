@extends('layouts.main-layout')
@section('tittle', 'Tahun Angkatan')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Tabel Tahun Angkatan</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table id="example" class="display text-dark" style="min-width: 845px">
                    <thead>
                        <tr class="text-center">
                        <th>Kode Angkatan</th>
                        <th>Tahun Angkatan</th>
                        <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-bordered">
                        @foreach ($tahunangkatan as $t)
                        <tr class="text-center">
                            <td>{{ $t->id_angkatan }}</td>
                            <td>{{ $t->tahun_angkatan }}</td>
                            <td>
                                <a href="" class="fa fa-pencil btn btn-warning" data-toggle="modal" data-target=".editAngkatan{{ $t->id_angkatan }}" title="Edit tahunangkatan">
                                </a>
                                <a href="{{ route('tahunangkatan.destroy', $t->id_angkatan) }}" class="fa fa-trash btn btn-danger" data-confirm-delete="true" title="Hapus tahunangkatan">
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

<button class="fa fa-plus wa_btn whatsapp" data-toggle="modal" data-target=".tambahAngkatan" title="Tambah tahun angkatan"></button>

<div class="modal fade tambahAngkatan" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Tahun Angkatan</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form action="{{ route('tahunangkatan.store') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label class="required-label faded-label" for="id_angkatan">Kode Angkatan</label>
                    <span><i class="fa fa-question-circle" tabindex="0" data-toggle="popover" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-title="Contoh: 21"></i></span>
                    <input type="text" name="id_angkatan" class="form-control @error('id_angkatan') is-invalid @enderror" value="{{ Session::get('id_angkatan') }}" placeholder="Masukan kode angkatan">
                    @error('id_angkatan')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label class="required-label faded-label" for="tahun_angkatan">Tahun Angkatan</label>
                    <span><i class="fa fa-question-circle" tabindex="0" data-toggle="popover" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-title="Contoh: 2021"></i></span>
                    <input type="text" name="tahun_angkatan" class="form-control @error('tahun_angkatan') is-invalid @enderror" value="{{ Session::get('tahun_angkatan') }}" placeholder="Masukan tahun angkatan">
                    @error('tahun_angkatan')
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

@foreach ($tahunangkatan as $t)
<div class="modal fade editAngkatan{{ $t->id_angkatan }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Tahun Angkatan</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('tahunangkatan.update', $t->id_angkatan) }}" method="POST">
                @csrf
                @method('PUT')
                    <div class="form-group mb-3">
                        <label class="required-label faded-label" for="id_angkatan" >Kode Angkatan</label>
                        <span><i class="fa fa-question-circle" tabindex="0" data-toggle="popover" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-title="Contoh: 21"></i></span>
                        <input type="text" name="id_angkatan" class="form-control @error('id_angkatan') is-invalid @enderror" value="{{$t->id_angkatan}}" placeholder="Masukan kode angkatan">
                        @error('id_angkatan')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="required-label faded-label" for="tahun_angkatan" >Tahun Agkatan</label>
                        <span><i class="fa fa-question-circle" tabindex="0" data-toggle="popover" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-title="Contoh: 2021"></i></span>
                        <input type="text" name="tahun_angkatan" class="form-control @error('tahun_angkatan') is-invalid @enderror" value="{{$t->tahun_angkatan}}" placeholder="Masukan tahun angkatan">
                        @error('tahun_angkatan')
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