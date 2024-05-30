<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <title>Mahasiswa Profile</title>
    <meta content="" name="description" />
    <meta content="" name="keywords" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/') }}images/logoPNC.png">
    <!-- Datatable -->
    <link href="{{ asset('/') }}assets/vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- Custom Stylesheet -->
    <link href="{{ asset('/') }}assets/css/style.css" rel="stylesheet">
    {{-- Wizard --}}
    <link href="{{ asset('/') }}assets/vendor/jquery-steps/css/jquery.steps.css" rel="stylesheet">
    {{-- Kalender --}}
    <link href="{{ asset('/') }}assets/vendor/fullcalendar/css/fullcalendar.min.css" rel="stylesheet">
    </head>

    <body>
        <div id="preloader">
            <div class="sk-three-bounce">
                <div class="sk-child sk-bounce1"></div>
                <div class="sk-child sk-bounce2"></div>
                <div class="sk-child sk-bounce3"></div>
            </div>
        </div>
        <div id="main-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <div class="card mt-5">
                            <div class="row">
                                <div class="col-md-6 col-8">
                                    <div class="card-header">
                                        <h3>Profile Mahasiswa</h3>
                                    </div>
                                </div>
                            </div>
                                <div class="card-body">
                                    <div class="form-group row mb-2">
                                        <label for="nama_lengkap" class="col-sm-5 col-form-label faded-label" >Nama Lengkap</label>
                                        <div class="col-sm-7 text-dark">
                                            : {{ $mahasiswa->nama_lengkap }}
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label for="jenis_kelamin" class="col-sm-5 col-form-label faded-label" >Jenis Kelamin</label>
                                        <div class="col-sm-7 text-dark">
                                            : {{ $mahasiswa->jenis_kelamin }}
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label for="alamat" class="col-sm-5 col-form-label faded-label" >Alamat</label>
                                        <div class="col-sm-7 text-dark">
                                            : Jalan {{ $mahasiswa->nama_jalan}}, RT.{{ $mahasiswa->rt}}/RW.{{ $mahasiswa->rw}}, {{ $ds}}, {{ $kec}}, {{ mb_convert_case($kab, MB_CASE_TITLE) }}, {{ mb_convert_case($prov, MB_CASE_TITLE) }}
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label for="nohp" class="col-sm-5 col-form-label faded-label" >Perguruan Tinggi</label>
                                        <div class="col-sm-7 text-dark">
                                            : Politeknik Negeri Cilacap
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label for="prodi" class="col-sm-5 col-form-label faded-label" >Program Studi</label>
                                        <div class="col-sm-7 text-dark">
                                            : {{ $mahasiswa->prodi->nama_prodi }}
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label for="nim" class="col-sm-5 col-form-label faded-label" >Nomor Induk Mahasiswa</label>
                                        <div class="col-sm-7 text-dark">
                                            : {{ $mahasiswa->nim }}
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label for="angkatan" class="col-sm-5 col-form-label faded-label" >Tahun Angkatan</label>
                                        <div class="col-sm-7 text-dark">
                                            : {{ $mahasiswa->angkatan->tahun_angkatan }}
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label for="angkatan" class="col-sm-5 col-form-label faded-label" >Status Mahasiswa</label>
                                        <div class="col-sm-7 text-dark">
                                            : {{ $mahasiswa->status_mhs }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    </div>

    <!-- Required vendors -->
    <script src="{{ asset('/') }}assets/vendor/global/global.min.js"></script>
    <script src="{{ asset('/') }}assets/js/quixnav-init.js"></script>
    <script src="{{ asset('/') }}assets/js/custom.min.js"></script>

    <!-- Datatable -->
    <script src="{{ asset('/') }}assets/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('/') }}assets/js/plugins-init/datatables.init.js"></script>
    {{-- Wizard --}}
    <script src="{{ asset('/') }}assets/vendor/jquery-steps/build/jquery.steps.min.js"></script>
    <script src="{{ asset('/') }}assets/vendor/jquery-validation/jquery.validate.min.js"></script>
    <!-- Form validate init -->
    <script src="{{ asset('/') }}assets/js/plugins-init/jquery.validate-init.js"></script>
    <!-- Form step init -->
    <script src="{{ asset('/') }}assets/js/plugins-init/jquery-steps-init.js"></script>

    <script src="{{ asset('/') }}assets/js/styleSwitcher.js"></script>
    <script src="{{ asset('/') }}assets/vendor/jqueryui/js/jquery-ui.min.js"></script>
    <script src="{{ asset('/') }}assets/vendor/moment/moment.min.js"></script>
    <script src="{{ asset('/') }}assets/vendor/fullcalendar/js/fullcalendar.min.js"></script>
    <script src="{{ asset('/') }}assets/js/plugins-init/fullcalendar-init.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </body>
</html>