<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <title>SIPUTRA/@yield('tittle')</title>
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
    <style>
        ::placeholder {
            font-style: italic;
        }
    </style>
    @livewireStyles
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
            @if (Auth::check() && (Auth::user()->role_id == '1' || Auth::user()->role_id == '3'))
            <div class="nav-header">
                <a href="{{ route('dashboard') }}" class="brand-logo">
                    <img class="logo-abbr" src="{{ asset('/') }}images/logoPNC.png" alt="">
                    <img class="logo-compact" src="{{ asset('/') }}assets/images/eKTM.png" alt="">
                    <img class="brand-title" src="{{ asset('/') }}assets/images/eKTM.png" alt="">
                </a>
                <div class="nav-control">
                    <div class="hamburger">
                        <span class="line"></span><span class="line"></span><span class="line"></span>
                    </div>
                </div>
            </div>
            @endif
            @if (Auth::user()->role_id == '2')
            <div class="nav-header">
                <a href="{{ route('home') }}" class="brand-logo">
                    <img class="logo-abbr" src="{{ asset('/') }}images/logoPNC.png" alt="">
                    <img class="logo-compact" src="{{ asset('/') }}assets/images/eKTM.png" alt="">
                    <img class="brand-title" src="{{ asset('/') }}assets/images/eKTM.png" alt="">
                </a>
                <div class="nav-control">
                    <div class="hamburger">
                        <span class="line"></span><span class="line"></span><span class="line"></span>
                    </div>
                </div>
            </div>
            @endif
            @include('layouts.header')
            @include('layouts.side-item')
            <div class="content-body">
                <div class="container">
                    @yield('content')
                </div>
            </div>
        </div>
        <div class="footer">
            <div class="copyright">
                <p>Copyright © Designed &amp; Developed by <a href="#" target="_blank">Dhimas Afrisetiawan</a> 2023</p>
            </div>
        </div>
        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    </div>

    @livewireScripts

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
    
    {{-- <script>
        $(function () {
        $('#provinsi').on('change', function(){
            let id_provinsi = $(this).val(); // Menggunakan $(this) untuk mengambil nilai yang dipilih
            console.log(id_provinsi);
            $.ajax({
                type: 'POST',
                url: "{{route('getprovinsi')}}",
                data: {
                    id_provinsi: id_provinsi,
                },
                cache: false,
                success: function (msg) {
                    $('#kabupaten').html(msg);
                    $('#kecamatan').empty(); // Mengosongkan opsi kecamatan setelah perubahan provinsi
                    $('#desa_kelurahan').empty(); // Mengosongkan opsi desa/kelurahan setelah perubahan provinsi
                },
                error: function(data){
                    console.log('error', data);
                },
            })
        });
    
        $('#kabupaten').on('change', function(){
            let id_kabupaten = $(this).val(); // Menggunakan $(this) untuk mengambil nilai yang dipilih
            $.ajax({
                type: 'POST',
                url: "{{route('getkabupaten')}}",
                data: {
                    id_kabupaten: id_kabupaten,
                },
                cache: false,
                success: function (msg) {
                    $('#kecamatan').html(msg);
                    $('#desa_kelurahan').empty(); // Mengosongkan opsi desa/kelurahan setelah perubahan kabupaten
                },
                error: function(data){
                    console.log('error', data);
                },
            })
        });
    
        $('#kecamatan').on('change', function(){
            let id_kecamatan = $(this).val(); // Menggunakan $(this) untuk mengambil nilai yang dipilih
            $.ajax({
                type: 'POST',
                url: "{{route('getkecamatan')}}",
                data: {
                    id_kecamatan: id_kecamatan,
                },
                cache: false,
                success: function (msg) {
                    $('#desa_kelurahan').html(msg);
                },
                error: function(data){
                    console.log('error', data);
                },
            })
        });
    });
    </script> --}}
    
    <script>
        $(function () {
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });
            $(function () {
                $('#provinsiadd').on('change', function(){
                    let id_provinsi = $('#provinsiadd').val();
                    console.log(id_provinsi);
                    $.ajax({
                        type: 'POST',
                        url: "{{route('getprovinsi')}}",
                        data: {
                            id_provinsi : id_provinsi,
                        },
                        cache: false,
                        success: function (msg) {
                            $('#kabupatenadd').html(msg);
                        },
                        error: function(data){
                            console.log('error', data);
                        },
                    })
                })
                $('#kabupatenadd').on('change', function(){
                    let id_kabupaten = $('#kabupatenadd').val();
                    $.ajax({
                        type: 'POST',
                        url: "{{route('getkabupaten')}}",
                        data: {
                            id_kabupaten : id_kabupaten,
                        },
                        cache: false,
                        success: function (msg) {
                            $('#kecamatanadd').html(msg);
                        },
                        error: function(data){
                            console.log('error', data);
                        },
                    })
                })
                $('#kecamatanadd').on('change', function(){
                    let id_kecamatan = $('#kecamatanadd').val();
                    $.ajax({
                        type: 'POST',
                        url: "{{route('getkecamatan')}}",
                        data: {
                            id_kecamatan : id_kecamatan,
                        },
                        cache: false,
                        success: function (msg) {
                            $('#desa_kelurahanadd').html(msg);
                        },
                        error: function(data){
                            console.log('error', data);
                        },
                    })
                })
            })
        });
    </script>
    @include('sweetalert::alert')
    <script>
        @if(session('toast_success'))
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: '{{ session('toast_success') }}',
                showConfirmButton: false,
                timer: 2000
            });
        @endif
    </script>
    <script>
    // Inisialisasi popover
    $(function () {
        $('[data-toggle="popover"]').popover()
    })
    </script>
    </body>
</html>
@stack('script-alt')
<!-- <script src="{{ asset('backend/js/demo/chart-area-demo.js') }}"></script>
<script src="{{ asset('backend/js/demo/chart-pie-demo.js') }}"></script> -->