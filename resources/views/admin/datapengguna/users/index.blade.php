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
            <a href="" data-toggle="modal" data-target=".ImportData" class="btn btn-whatsapp" title="Import Excel">
            Import akun <i class="fa fa-cloud-upload"></i></a>
          </div>
          <div class="table-responsive">
          <table id="example" class="display text-dark" style="min-width: 845px">
              <thead>
                  <tr class="text-center">
                    <th>NIM</th>
                    <th>Role</th>
                    <th>Nama Lengkap</th>
                    <th>Aksi</th>
                  </tr>
              </thead>
              <tbody class="table-bordered">
                  @foreach ($users as $u)
                  <tr class="text-center">
                      <td>{{ $u->nim }}</td>
                      <td>{{ $u->role->level }}</td>
                      <td>{{ mb_convert_case($u->username, MB_CASE_TITLE) }}</td>
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
              <h5 class="modal-title">Tambah Akun</h5>
              <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
              </button>
          </div>
          <div class="modal-body">
            <form action="{{ route('account.store') }}" method="POST">
              @csrf
              <div class="form-group mb-3">
                <label class="required-label faded-label" for="nim" >NIM</label>
                <span><i class="fa fa-question-circle" tabindex="0" data-toggle="popover" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-title="Nomor Induk Mahasiswa"></i></span>
                <input type="number" name="nim" class="form-control @error('nim') is-invalid @enderror" placeholder="Masukan NIM">
                @error('nim')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              <div class="form-group mb-3">
                <label class="required-label faded-label" for="role_id" >Level</label>
                <select class="form-control select2" aria-label="Default select example" for="role_id" name="role_id" id="role_id">
                  <option selected disabled value="">Pilih Level</option>
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
                <label class="required-label faded-label" for="username" >Nama Lengkap</label>
                <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" placeholder="Masukan nama lengkap">
                @error('username')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              <small class="text-dark">Password default : abcd1234</small>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </form>
      </div>
  </div>
</div>

<div class="modal fade ImportData" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title">Import Akun</h5>
              <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
              </button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <a href="{{ asset('assets/files/format_import.xlsx') }}" style="text-decoration: underline">Download format</a>
            </div>
            <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
              @csrf
                <div class="custom-file mb-3">
                    <label class="custom-file-label" for="excel_file" id="file_label">Excel File</label>
                    <input type="file" class="form-control-file @error('excel_file') is-invalid @enderror" id="excel_file" name="excel_file" accept=".xls, .xlsx" onchange="updateLabel(this)">
                    @error('excel_file')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Import</button>
                </div>
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
                      <span><i class="fa fa-question-circle" tabindex="0" data-toggle="popover" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-title="Nomor Induk Mahasiswa"></i></span>
                      <input type="number" name="nim" class="form-control @error('nim') is-invalid @enderror" value="{{$u->nim}}" placeholder="Masukan NIM" readonly>
                      @error('nim')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                    <div class="form-group mb-3">
                      <label class="required-label faded-label" for="role_id" >Level</label>
                      <select class="form-control select2" aria-label="Default select example" for="role_id" name="role_id" id="role_id">
                        @foreach ($role as $r)
                          <option value="{{ $r->id }}" @if($u->role_id == $r->id) selected @endif>{{ $r->level }}</option>
                        @endforeach
                      </select>
                      @error('role_id')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                    <div class="form-group mb-3">
                      <label class="required-label faded-label" for="username" >Nama Lengkap</label>
                      <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{$u->username}}" placeholder="Masukan nama lengkap">
                      @error('username')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                    <div class="form-group mb-3">
                      <label class="required-label faded-label" for="password" >Ubah Password</label>
                      <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Masukan password baru">
                      <small class="text-muted">Kosongkan jika tidak ingin mengubah password.</small>
                      @error('password')
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

<script>
  function updateLabel(input) {
      var fileName = input.files[0].name;
      document.getElementById('file_label').innerText = fileName;
  }
</script>
@endsection
