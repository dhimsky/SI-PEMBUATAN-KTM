@extends('layouts.main-layout')
@section('tittle', 'Kalender')
@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-intro-title">Tabel Acara</h4>
                <div class="table-responsive">
                    <table class="table table-responsive-sm text-dark">
                        <thead>
                            <tr>
                                <th>Hari</th>
                                <th>Jam</th>
                                <th>Kelas</th>
                                <th>Keterangan</th>
                                @if (Auth::user()->role_id == '1' && '3')
                                <th>Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="table-bordered">
                            @foreach ($kalender as $k)
                            <tr>
                                <td>
                                    {{ hariIndonesia(\Carbon\Carbon::parse($k->tanggal)->format('l')) }}, 
                                    {{ \Carbon\Carbon::parse($k->tanggal)->format('d/m') }} 
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($k->jam)->format('H:i') }} 
                                </td>
                                <td>
                                    {{ $k->prodi->nama_prodi }} - {{ $k->kelas }}
                                </td>
                                <td>
                                    {{ $k->detail }}
                                </td>
                                @if (Auth::user()->role_id == '1' && '3')
                                <td>
                                    <a href="" class="fa fa-pencil color-muted" data-toggle="modal" data-target=".editKalender{{ $k->id_kalender }}" title="Edit prodi">
                                    </a>
                                    <a href="{{ route('kalender.destroy', $k->id_kalender) }}" class="fa fa-close color-danger" data-confirm-delete="true" title="Hapus prodi">
                                    </a>
                                </td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <div id="kalender"></div>
            </div>
        </div>
    </div>
</div>
</div>
@if (Auth::user()->role_id == '1' || '3')
<button class="fa fa-plus wa_btn whatsapp" data-toggle="modal" data-target=".tambahKalender" title="Tambah prodi"></button>
@endif

<div class="modal fade tambahKalender" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Acara</h5>
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
                    <label class="required-label faded-label" for="prodi_id" style="font-style: italic;">Prodi</label>
                    <select class="form-control" name="prodi_id" id="prodi_id">
                        <option value="">Pilih Prodi</option>
                        @foreach ($prodi as $prodi)
                        <option value="{{ $prodi->id_prodi }}">{{ $prodi->nama_prodi }}</option>
                        @endforeach
                    </select>
                    @error('prodi_id')
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

@foreach ($kalender as $k)
<div class="modal fade editKalender{{ $k->id_kalender }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Acara</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form action="{{ route('kalender.update', $k->id_kalender) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group mb-3">
                    <label class="required-label faded-label" for="tanggal" style="font-style: italic;">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{ $k->tanggal }}" >
                    @error('tanggal')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label class="required-label faded-label" for="jam" style="font-style: italic;">Jam</label>
                    <input type="time" name="jam" class="form-control @error('jam') is-invalid @enderror" value="{{ $k->jam }}" >
                    @error('jam')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label class="required-label faded-label" for="prodi_id" style="font-style: italic;">Prodi</label>
                    <select class="form-control" name="prodi_id" id="prodi_id">
                        @foreach ($prodi2 as $d)
                            <option value="{{ $d->id_prodi }}" @if ($d->id_prodi === $k->prodi_id) selected @endif>{{ $d->nama_prodi }}</option>
                        @endforeach
                    </select>
                    @error('prodi_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label class="required-label faded-label" for="kelas" style="font-style: italic;">Kelas</label>
                    <input type="text" name="kelas" class="form-control @error('kelas') is-invalid @enderror" value="{{ $k->kelas }}" >
                    @error('kelas')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label class="faded-label" for="detail" style="font-style: italic;">Detail</label>
                    <input type="text" name="detail" class="form-control @error('detail') is-invalid @enderror" value="{{ $k->detail }}" >
                    @error('detail')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endforeach
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
@php
    function hariIndonesia($day) {
        $days = [
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu',
            'Sunday' => 'Minggu',
        ];

        return $days[$day];
    }
@endphp
@endpush