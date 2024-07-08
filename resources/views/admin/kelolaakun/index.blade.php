@extends('layouts.main-layout')
@section('tittle', 'Profile')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card mt-5">
                <div class="card-header">
                    <h3>Akun Anda</h3>
                </div>
                <form action="{{ route('kelolaakun.gantinama') }}" method="post">
                    @csrf
                    <div class="card-body">
                        @foreach ($user as $u)
                        <div class="form-group row mb-2 mt-2">
                            <label for="no_identitas" class="col-sm-4 col-form-label faded-label" style="font-style: italic;">No. Identitas</label>
                            <div class="col-sm-8">
                                <input type="text" name="no_identitas" class="form-control" id="no_identitas" value="{{ $u->no_identitas }}" readonly>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label for="nama_lengkap" class="col-sm-4 col-form-label faded-label" style="font-style: italic;">Nama Lengkap</label>
                            <div class="col-sm-8">
                                <input type="text" name="nama_lengkap" class="form-control" id="nama_lengkap" value="{{ $u->nama_lengkap }}">
                            </div>
                        </div>
                        <div class="text-right">
                            <a href="" class="btn btn-secondary" data-toggle="modal" data-target=".akunSet{{ $u->no_identitas }}">Ubah Password</a>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                        @endforeach
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- Akun --}}
@foreach ($user as $u)
<div class="modal fade akunSet{{ $u->no_identitas }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Password</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('kelolaakun.gantipw', $u->no_identitas) }}">
                    @csrf

                    <div class="form-group row text-dark">
                        <label for="current_password" class="col-md-4 col-form-label text-md-right">Password Lama</label>

                        <div class="col-md-6">
                            <input id="current_password" type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" autocomplete="current-password" placeholder="Masukan password lama">

                            @error('current_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row text-dark">
                        <label for="new_password" class="col-md-4 col-form-label text-md-right">Password Baru</label>

                        <div class="col-md-6">
                            <input id="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" autocomplete="new-password" placeholder="Masukan password baru">

                            @error('new_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row text-dark">
                        <label for="new_password_confirmation" class="col-md-4 col-form-label text-md-right">Konfirmasi Password Baru</label>

                        <div class="col-md-6">
                            <input id="new_password_confirmation" type="password" class="form-control @error('new_password_confirmation') is-invalid @enderror" name="new_password_confirmation" autocomplete="new-password" placeholder="Masukan password baru">
                            @error('new_password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                Simpan
                            </button>
                        </div>
                    </div>
                </form>
        </div>
    </div>
</div>
@endforeach
@endsection