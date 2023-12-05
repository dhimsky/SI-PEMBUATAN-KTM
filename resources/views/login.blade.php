<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Template Main CSS File -->
    <link href="{{ asset('/') }}css/style.css" rel="stylesheet" />
 </head>
 <body>
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
                                <div class="card-block">
                                    <div class="row m-b-20">
                                        <div class="col-md-12">
                                            <h3 class="text-center">Sign In</h3>
                                        </div>
                                    </div>
                                    <div class="form-group form-primary">
                                        <input type="text" name="nim" class="form-control @error('nim') is-invalid @enderror" required value="{{ Session::get('nim') }}">
                                        <span class="form-bar"></span>
                                        <label class="float-label">NIM</label>
                                    </div>
                                    @error('nim')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <div class="form-group form-primary">
                                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                                        <span class="form-bar"></span>
                                        <label class="float-label">Password</label>
                                    </div>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <div class="row m-t-30">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary btn-md btn-block waves-effect waves-light text-center m-b-20">Sign in</button>
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
