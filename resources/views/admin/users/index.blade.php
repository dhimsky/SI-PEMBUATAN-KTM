@extends('layouts.main-layout')
@section('tittle', 'Users-Account')
@section('content')
<div class="row">
  <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Tabel Pengguna</h4>
        </div>
        <div class="card-body">
          <div class="col-md-12 text-right mb-3">
            
            </div>
          <div class="table-responsive">
          <table id="example" class="display text-dark" style="min-width: 845px">
              <thead>
                  <tr class="text-center">
                    <th>#</th>
                    <th>NIM</th>
                    <th>Role</th>
                    <th>Username</th>
                    <th>Aksi</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($users as $u)
                  <tr class="text-center">
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $u->nim }}</td>
                      <td>{{ $u->role->level }}</td>
                      <td>{{ $u->username }}</td>
                      <td>
                          <a href="" class="fa fa-pencil btn btn-warning" data-toggle="modal" data-target=".editUser{{ $u->nim }}" title="Edit pengguna">
                          </a>
                          <a href="{{ route('account.destroy', $u->nim) }}" class="fa fa-trash btn btn-danger" data-confirm-delete="true" title="Hapus pengguna">
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

<button class="fa fa-plus wa_btn whatsapp" data-toggle="modal" data-target=".tambahUser" title="Tambah pengguna"></button>

<div class="modal fade tambahUser" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title">Tambah Pengguna</h5>
              <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
              </button>
          </div>
          <div class="modal-body">
            <form action="{{ route('account.store') }}" method="POST">
              @csrf
              <div class="form-group mb-3">
                <label class="required-label faded-label" for="nim" >NIM</label>
                <input type="number" name="nim" class="form-control @error('nim') is-invalid @enderror" placeholder="Contoh: 210202098">
                @error('nim')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              <div class="form-group mb-3">
                <label class="required-label faded-label" for="role_id" >Level</label>
                <select class="form-control select2" aria-label="Default select example" for="role_id" name="role_id" id="role_id">
                  <option value="">Pilih Level</option>
                  @foreach ($role as $r)
                      <option value="{{ $r->id }}">{{ $r->level }}</option>
                  @endforeach
                </select>
                @error('role_id')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              <div class="form-group mb-3">
                <label class="required-label faded-label" for="username" >Username</label>
                <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" placeholder="Masukan username">
                @error('username')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              <div class="form-group mb-3">
                <label class="required-label faded-label" for="password" >Password</label>
                <input type="text" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Masukan password">
                @error('password')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </form>
      </div>
  </div>
</div>

@foreach ($users as $u)
<div class="modal fade editUser{{ $u->nim }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Pengguna</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <form action="{{ route('account.update', $u->nim) }}" method="POST">
                @csrf
                @method('PUT')
                    <div class="form-group mb-3">
                      <label class="required-label faded-label" for="nim" >NIM</label>
                      <input type="number" name="nim" class="form-control @error('nim') is-invalid @enderror" value="{{$u->nim}}" placeholder="Contoh: 210202098">
                      @error('nim')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                    <div class="form-group mb-3">
                      <label class="required-label faded-label" for="role_id" >Level</label>
                      <select class="form-control select2" aria-label="Default select example" for="role_id" name="role_id" id="role_id">
                        <option value="{{ $u->role_id }}">{{ $u->role->level }}</option>
                        @foreach ($role as $r)
                            <option value="{{ $r->id }}">{{ $r->level }}</option>
                        @endforeach
                      </select>
                      @error('role_id')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                    <div class="form-group mb-3">
                      <label class="required-label faded-label" for="username" >Username</label>
                      <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{$u->username}}" placeholder="Masukan username">
                      @error('username')
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
