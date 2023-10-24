<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <!-- Template Main CSS File -->
        <link href="{{ asset('/') }}assets/css/style.css" rel="stylesheet" />
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f9f9f9;
        }
        .login-container {
            max-width: 400px;
            margin: 100px auto;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 5px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .login-container h2 {
            text-align: center;
            margin-bottom: 30px;
        }
    </style>
</head>
    <body>
        <div class="container">
            <div class="login-container">
                <h2>Login</h2>
                <form action="/loginsession" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="nim">NIM:</label>
                        <input type="number" class="form-control @error('nim') is-invalid @enderror" id="nim" name="nim" placeholder="Masukkan NIM" value="{{ Session::get('nim') }}">
                    </div>
                    @error('nim')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Masukkan Password" >
                    </div>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                </form>
            </div>
        </div>
    </body>
</html>
