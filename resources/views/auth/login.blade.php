<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UTCJ | Sustentable</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@4.0.0-beta3/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <div>
                    <img src="assets/img/utcj.png" alt="">
                </div>
                <a href="#" class="h1"><b>UTCJ</b> Sustentable</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Inicio de sesion</p>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="input-group mb-3">
                        <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email') }}" required autocomplete="email" autofocus
                            pattern="^[a-zA-Z0-9._%+-]+@utcj\.edu\.mx$"
                            title="Por favor ingresa un correo válido de la universidad (ejemplo@utcj.edu.mx)">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Login') }}
                            </button>
                        </div>
                    </div>
                </form>
                <p class="mb-1">
                    <a href="#"></a>
                </p>
                <p class="mb-0">
                    <a href="{{ route('register') }}" class="text-center">Registrar nuevo administrador</a>
                </p>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@4.0.0-beta3/plugins/jquery/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@4.0.0-beta3/dist/js/adminlte.min.js"></script>
</body>

</html>