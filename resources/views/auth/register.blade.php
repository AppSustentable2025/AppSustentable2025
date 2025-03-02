<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>UTCJ | Sustentable</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@4.0.0-beta3/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="#" class="link-dark text-center">
          <div>
            <img src="assets/img/utcj.png" alt="">
          </div>
          <h1 class="mb-0"><b>UTCJ</b> Sustentable</h1>
        </a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Registrar nuevo admin</p>
        <form method="POST" action="{{ route('register') }}">
          @csrf
          <div class="input-group mb-3">
            <div class="form-floating">
              <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus>
              <label for="name">Nombre</label>
            </div>
            <div class="input-group-text"><span class="bi bi-person"></span></div>
            @error('name')
            <span class="invalid-feedback d-block" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="input-group mb-3">
            <div class="form-floating">
              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
              <label for="email">Correo</label>
            </div>
            <div class="input-group-text"><span class="bi bi-envelope"></span></div>
            @error('email')
            <span class="invalid-feedback d-block" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="input-group mb-3">
            <div class="form-floating">
              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
              <label for="password">Contraseña</label>
            </div>
            <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
            @error('password')
            <span class="invalid-feedback d-block" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="input-group mb-3">
            <div class="form-floating">
              <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
              <label for="password-confirm">Confirmar contraseña</label>
            </div>
            <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
          </div>
          <div class="row">
            <div class="col-8 d-inline-flex align-items-center">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="terms" required>
                <label class="form-check-label" for="terms">
                  Estoy de acuerdo con los <a href="#">términos</a>
                </label>
              </div>
            </div>
            <div class="col-4">
              <button type="submit" class="btn btn-primary w-100">Registrar</button>
            </div>
          </div>
        </form>
        <p class="mt-3 text-center">
          <a href="{{ route('login') }}" class="link-primary">Ya tengo una cuenta de usuario</a>
        </p>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script src="../../../dist/js/adminlte.js"></script>
</body>

</html>