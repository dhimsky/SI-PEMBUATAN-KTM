@extends('layouts.main-layout')
@section('tittle', 'Kalender')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-intro-title">Calendar</h4>

                    <div class="">
                        <div id="external-events" class="my-3">
                            @foreach ($kalender as $kal)
                            <div class="external-event ui-draggable ui-draggable-handle" data-class="bg-primary" style="position: relative;"><i class="fa fa-move"></i>{{$kal->tanggal}} - {{$kal->prodi}} - {{$kal->kelas}}</div>
                            @endforeach
                        </div>
                        <a href="javascript:void()" data-toggle="modal" data-target=".tambahKalender" class="btn btn-primary btn-event w-100">
                            <span class="align-middle"><i class="ti-plus"></i></span> Create New
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div id="kalender"></div>
                </div>
            </div>
        </div>
        <!-- BEGIN MODAL -->
        <div class="modal fade none-border" id="event-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><strong>Add New Event</strong></h4>
                    </div>
                    <div class="modal-body"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success save-event waves-effect waves-light">Create
                            event</button>

                        <button type="button" class="btn btn-danger delete-event waves-effect waves-light" data-dismiss="modal">Delete</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Add Category -->
        <div class="modal fade tambahKalender" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah jurusan</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <form action="{{ route('kalender.store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label class="required-label faded-label" for="tanggal" style="font-style: italic;">Tanggal</label>
                            <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{ Session::get('tanggal') }}" >
                            @error('tanggal')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="required-label faded-label" for="jam" style="font-style: italic;">Jam</label>
                            <input type="time" name="jam" class="form-control @error('jam') is-invalid @enderror" value="{{ Session::get('jam') }}" >
                            @error('jam')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="required-label faded-label" for="prodi" style="font-style: italic;">Jurusan</label>
                            <select class="form-control" name="prodi" id="prodi">
                                <option value="">Pilih Prodi</option>
                                @foreach ($prodi as $prodi)
                                <option value="{{ $prodi->nama_prodi }}">{{ $prodi->nama_prodi }}</option>
                                @endforeach
                            </select>
                            @error('prodi')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="required-label faded-label" for="kelas" style="font-style: italic;">Kelas</label>
                            <input type="text" name="kelas" class="form-control @error('kelas') is-invalid @enderror" value="{{ Session::get('kelas') }}" >
                            @error('kelas')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="faded-label" for="detail" style="font-style: italic;">Detail</label>
                            <input type="text" name="detail" class="form-control @error('detail') is-invalid @enderror" value="{{ Session::get('detail') }}" >
                            @error('detail')
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
    </div>
</div>
@endsection

@push('script-alt')
<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>
<script>
    $(document).ready(function () {
            // page is now ready, initialize the calendar...
            jadwal={!! json_encode($jadwal) !!};
            $('#kalender').fullCalendar({
                // put your options and callbacks here
                events: jadwal
            });
        });
</script>
@endpush