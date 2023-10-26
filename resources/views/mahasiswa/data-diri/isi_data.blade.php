@extends('layouts.main-layout')
@section('tittle', 'Mahasiswa')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                @livewire('multi-step-form')
            </div>
        </div>
    </div>
</div>
@endsection