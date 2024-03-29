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

    .textfield {
      position: relative;
      display: flex; /* Hacer que los elementos se alineen en línea */
      align-items: center; /* Centrar verticalmente los elementos */
    }

    .textfield input {
      padding-right: 35px; /* Ajuste para dejar espacio para los iconos */
      padding-left: 30px; /* Ajuste para dejar espacio para los iconos */
    }

    .textfield .icon {
      position: absolute;
      color: #aaa;
    }

    .icon-left {
      left: 5px; /* Posición del candado */
    }

    .icon-right {
      right: 5px; /* Posición del ojo */
      cursor: pointer;
      font-size: 24px; /* Tamaño del icono del ojo */
    }

    /* Estilo para el texto de la contraseña tachada */
    .password-hidden {
      text-decoration: line-through;
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
            <input type="email" name="email" id="form2Example18" class="form-control-lg" placeholder="Email">
            <span class="icon icon-left">&#128231;</span> <!-- Icono de sobre -->
          </div>
          <div class="textfield">
            <input type="password" name="password" id="form2Example28" class="form-control-lg" placeholder="Contraseña">
            <span class="icon icon-left">&#128274;</span> <!-- Icono de candado -->
            <span class="icon icon-right" onclick="togglePassword('form2Example28')">&#x1F441;</span> <!-- Icono de ojo -->
          </div>
          <div class="but" style="text-align: center;">
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

    function togglePassword(id) {
        var input = document.getElementById(id);
        var icon = document.querySelector('#form2Example28 + .icon-right');
        if (input.type === "password") {
            input.type = "text";
            icon.innerHTML = "&#x1F441;"; // Icono de ojo
        } else {
            input.type = "password";
            icon.innerHTML = "&#x1F441;&#x0336;"; // Icono de ojo tachado
        }
    }
  </script>
</body>
</html>
