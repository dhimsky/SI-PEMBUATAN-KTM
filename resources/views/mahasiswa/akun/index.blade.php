@extends('layouts.main-layout')
@section('tittle', 'Users-Account')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card mt-5">
                <div class="card-header">
                    <h3>Akun Anda</h3>
                </div>
                <div class="card-body">
                    @foreach ($user as $u)
                    <div class="form-group row mb-2 mt-2">
                        <label for="nim" class="col-sm-4 col-form-label faded-label" style="font-style: italic;">NIM</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="nim" value="{{ $u->nim }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="nama_lengkap" class="col-sm-4 col-form-label faded-label" style="font-style: italic;">Nama Lengkap</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="nama_lengkap" value="{{ $u->username }}" readonly>
                        </div>
                    </div>
                    <div class="text-right">
                        <a href="" class="btn btn-secondary" data-toggle="modal" data-target=".akunSet{{ $u->nim }}">Ubah Password</a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
{{-- Akun --}}
@foreach ($user as $u)
<div class="modal fade akunSet{{ $u->nim }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Password</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('akun.gantiPassword', $u->nim) }}">
                    @csrf

                    <div class="form-group row text-dark">
                        <label for="current_password" class="col-md-4 col-form-label text-md-right">Password Lama</label>

                        <div class="col-md-6">
                            <input id="current_password" type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" autocomplete="current-password">

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
                            <input id="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" autocomplete="new-password">

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
                            <input id="new_password_confirmation" type="password" class="form-control @error('new_password_confirmation') is-invalid @enderror" name="new_password_confirmation" autocomplete="new-password">
                            @error('new_password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-secondary">
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
