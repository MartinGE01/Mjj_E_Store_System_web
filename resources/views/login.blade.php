<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <title>Login</title>
  <style>
    /* Estilo para la alerta de error */
    .custom-alert {
        position: absolute;
        top: -30px;
        left: 50%;
        transform: translateX(-50%);
        background-color: #f8d7da;
        color: #721c24;
        padding: 10px 15px;
        border-radius: 5px;
        border: 1px solid #f5c6cb;
        font-size: 14px;
        display: none;
        z-index: 999; /* Asegura que la alerta esté por encima de otros elementos */
    }
  </style>
</head>
<body>
  <div class="main-login">
    <div class="left-login">
      <h1>Bienvenido<br>Mjj store</h1>
      <img src="{{ asset('images/per.svg') }}" class="left-login-image" alt="Pessoa trabalhando">
    </div>
    <div class="right-login">
      <div class="card-login">
        <h1>LOGIN</h1>
        <form action="{{ url('/loginapi') }}" method="POST" class="sign-in-form">
          @csrf <!-- Agregar CSRF token -->
          <div id="error-alert" class="custom-alert">
            @if ($errors->any())
              {{ $errors->first('message') }}
            @endif
          </div>
          <div class="textfield">
            <span class="icon"><i class="fas fa-envelope"></i></span>
            <input type="email" name="email" id="form2Example18" class="form-control-lg" placeholder="Email">
          </div>
          <div class="textfield">
            <span class="icon"><i class="fas fa-lock"></i></span>
            <input type="password" name="password" id="form2Example28" class="form-control-lg" placeholder="Contraseña">
            <span class="input-group-text bg-transparent border-0 eye-icon" onclick="togglePassword('form2Example28')">
              <i class="fas fa-eye"></i>
            </span>
          </div>
          <div class="pt-1 mb-4">
            <button type="submit" class="btn-login">Login</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
  <script>
    function showErrorAlert(message) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: message,
            showConfirmButton: false,
            timer: 3000
        });
    }

    var errorAlert = document.getElementById('error-alert');
    if (errorAlert && errorAlert.innerText.trim() !== '') {
        // Si hay un mensaje de error, mostramos la alerta
        showErrorAlert(errorAlert.innerText);
    }
  </script>
</body>
</html>
