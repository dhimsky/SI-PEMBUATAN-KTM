@extends('layouts.main-layout')
@section('tittle', 'Users-Role')
@section('content')
<div class="row">
  <div class="col-12">
      <div class="card">
          <div class="card-header">
              <h4 class="card-title">Tabel Role</h4>
          </div>
          <div class="card-body">
              <div class="table-responsive">
                  <table id="example" class="display text-dark" style="min-width: 845px">
                      <thead>
                          <tr class="text-center">
                            <th>Kode Role</th>
                            <th>Level</th>
                            <th>Aksi</th>
                          </tr>
                      </thead>
                      <tbody class="table-bordered">
                          @foreach ($role as $r)
                          <tr class="text-center">
                              <td>{{ $r->id }}</td>
                              <td>{{ $r->level }}</td>
                              <td>
                                  <a href="" class="btn btn-warning" data-toggle="modal" data-target=".modalEdit{{ $r->id }}" title="Edit role">
                                      <i class="fa fa-pencil"></i>
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

@foreach ($role as $r)
<div class="modal fade modalEdit{{ $r->id }}" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title">Edit Role</h5>
              <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
              </button>
          </div>
          <div class="modal-body">
            <form action="{{ route('role.update', $r->id) }}" method="POST">
              @csrf
              @method('PUT')
              <div class="form-group mb-3">
                <label class="required-label faded-label" for="id" >Id Role</label>
                <input type="number" name="id" class="form-control @error('id') is-invalid @enderror" value="{{ $r->id }}" readonly>
                @error('id')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              <div class="form-group mb-3">
                <label class="required-label faded-label" for="level" >Level Role</label>
                <span><i class="fa fa-question-circle" tabindex="0" data-toggle="popover" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-title="Nama dari role"></i></span>
                <input type="text" name="level" class="form-control @error('level') is-invalid @enderror" value="{{ $r->level }}" placeholder="Masukan nama role">
                @error('level')
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
