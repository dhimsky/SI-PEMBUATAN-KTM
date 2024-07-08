<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css">

    <!-- Template Main CSS File -->
    <link href="{{ asset('/') }}css/style.css" rel="stylesheet" />
    <style>
        .wa_btn {
    position: fixed;
    right: 60px;
    overflow: hidden;
    width: 57px;
    height: 57px;
    border-radius: 100px;
    border: 0;
    z-index: 9999;
    transition: 0.2s;
    -webkit-border-radius: 100px;
    -moz-border-radius: 100px;
    -ms-border-radius: 100px;
    -o-border-radius: 100px;
    box-shadow: 0 0 7px rgba(253, 253, 253, 0.2);
}

.wa_btn.whatsapp {
    bottom: 20px;
    right: 15px;
    background-color: #f8f8f8;
    color: white;
}
.wa_btn.wa {
    bottom: 20px;
    right: 15px;
    background-color: #25D366;
    color: white;
}
    </style>
</head>
<body>
        <a href="https://wa.me/6285747928777?text=Halo%20admin,%20izin%20bertanya%20tentang%20KTM" target="_blank">
            <button class="bi bi-whatsapp wa_btn wa"></button>
        </a>
        @include('sweetalert::alert')
        <section class="login-block">
            <!-- Container-fluid starts -->
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <!-- Authentication card start -->
                        <form class="md-float-material form-material" action="/loginsession" method="post">
                            @csrf
                            <div class="text-center">
                                <img src="{{ asset('/') }}images/logoPNC.png" style="width: 3cm; height: 3.2cm;" alt="logo.png">
                            </div>
                            <div class="auth-box card">
                                <div class="row m-b-10 mt-3">
                                    <div class="col-md-12">
                                        <h3 class="text-center">eKTM</h3>
                                    </div>
                                </div>
                                <div class="card-block">
                                    <div class="form-group form-primary">
                                        <input type="text" name="no_identitas" class="form-control @error('no_identitas') is-invalid @enderror" required value="{{ Session::get('no_identitas') }}">
                                        <span class="form-bar"></span>
                                        <label class="float-label">NO. IDENTITAS/ NIM</label>
                                    </div>
                                    @error('no_identitas')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <div class="form-group form-primary">
                                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                                        <span class="form-bar"></span>
                                        <label class="float-label">PASSWORD</label>
                                    </div>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <div class="row m-t-30">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary btn-md btn-block waves-effect waves-light text-center m-b-20">Masuk</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
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
    </body>
</html>
