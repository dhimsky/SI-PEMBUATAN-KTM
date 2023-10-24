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
            @if (Auth::user()->role_id == '1')
            <div class="nav-header">
                <a href="{{ route('dashboard') }}" class="brand-logo">
                    <img class="logo-abbr" src="{{ asset('/') }}images/logoPNC.png" alt="">
                    <img class="logo-compact" src="{{ asset('/') }}assets/images/textlogo.png" alt="">
                    <img class="brand-title" src="{{ asset('/') }}assets/images/textlogo.png" alt="">
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
                    <img class="logo-compact" src="{{ asset('/') }}assets/images/textlogo.png" alt="">
                    <img class="brand-title" src="{{ asset('/') }}assets/images/textlogo.png" alt="">
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
            @include('sweetalert::alert')
            <div class="content-body">
                @yield('content')
            </div>
        </div>
        <div class="footer">
            <div class="copyright">
                <p>Copyright © Designed &amp; Developed by <a href="#" target="_blank">Dhimas Afrisetiawan</a> 2023</p>
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
    
    <script>
        $(function () {
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });
            $(function () {
                $('#provinsi').on('change', function(){
                    let id_provinsi = $('#provinsi').val();
                    console.log(id_provinsi);
                    $.ajax({
                        type: 'POST',
                        url: "{{route('getprovinsi')}}",
                        data: {
                            id_provinsi : id_provinsi,
                        },
                        cache: false,
                        success: function (msg) {
                            $('#kabupaten').html(msg);
                        },
                        error: function(data){
                            console.log('error', data);
                        },
                    })
                })
                $('#kabupaten').on('change', function(){
                    let id_kabupaten = $('#kabupaten').val();
                    $.ajax({
                        type: 'POST',
                        url: "{{route('getkabupaten')}}",
                        data: {
                            id_kabupaten : id_kabupaten,
                        },
                        cache: false,
                        success: function (msg) {
                            $('#kecamatan').html(msg);
                        },
                        error: function(data){
                            console.log('error', data);
                        },
                    })
                })
                $('#kecamatan').on('change', function(){
                    let id_kecamatan = $('#kecamatan').val();
                    $.ajax({
                        type: 'POST',
                        url: "{{route('getkecamatan')}}",
                        data: {
                            id_kecamatan : id_kecamatan,
                        },
                        cache: false,
                        success: function (msg) {
                            $('#desa_kelurahan').html(msg);
                        },
                        error: function(data){
                            console.log('error', data);
                        },
                    })
                })
            })
        });
    </script>
    </body>
</html>

{{-- Modal Logout--}}
<div class="modal fade" id="basicModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">LogOut</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Yakin Ingin LogOut?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <form action="{{ url('logout') }}" method="POST">
          @csrf
          <button type="submit" class="btn btn-primary">LogOut</button>
        </form>
      </div>
    </div>
  </div>
</div>

@stack('script-alt')
<!-- Page level custom scripts -->
<!-- <script src="{{ asset('backend/js/demo/chart-area-demo.js') }}"></script>
<script src="{{ asset('backend/js/demo/chart-pie-demo.js') }}"></script> -->