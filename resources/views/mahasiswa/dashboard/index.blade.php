@extends('layouts.main-layout')
@section('tittle', 'Dashboard')
@section('content')
<section class="section dashboard">
    <div class="row">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card text-dark">
                        <div class="card-header">
                            Selamat Datang, {{ Auth::user()->username }}
                        </div>
                        <div class="card-body">
                            <p>Selamat datang di halaman Mahasiswa. Silakan kelola konten dan fitur yang tersedia
                                di sini.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection