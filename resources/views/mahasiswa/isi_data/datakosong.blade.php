@extends('layouts.main-layout')
@section('tittle', 'Mahasiswa')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card mt-5">
                <div class="card-header">
                    <h3>Data Mahasiswa</h3>
                </div>
                <div class="card-body mt-3">
                    <div class="alert alert-warning text-center" style="color: black" role="alert">
                        Ups..! Data belum ada, silahkan isi data anda terlebih dahulu!
                    </div>
                    <div class="text-center">
                        <a href="{{route('mahasiswa.isi_data.step1')}}" class="btn btn-primary">Isi disini</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection