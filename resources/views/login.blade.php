<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <!-- Enlazar tu archivo CSS -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #ffffff;
        }

        .form-outline {
            border: none; /* Elimina el borde */
        }

        .form-label {
            color: #495057;
        }

        .input-group-text {
            border: none; /* Elimina el borde */
        }

        .input-group-text i {
            pointer-events: none; /* Evita que el icono sea clickeable */
        }

        /* Estilo para la línea inferior de los inputs */
        .form-control {
            border-top: none;
            border-right: none;
            border-left: none;
            border-radius: 0;
            border-bottom: 1px solid #ced4da; /* Color de la línea */
            box-shadow: none;
            padding-right: 40px; /* Espacio para el ícono */
            position: relative;
        }

        /* Estilo para el formulario */
        .sign-in-form {
            padding: 20px;
            border: 1px solid #ced4da;
            border-radius: 10px;
            background-color: #f8f9fa;
            margin-top: 20px;
        }

        /* Estilo para el ícono de ojo */
        .eye-icon {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            pointer-events: all; /* Permite que el ícono sea clickeable */
        }

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

        @media (min-width: 576px) {
            .sign-in-form {
                padding: 50px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-6 text-black">
        

                <div class="d-flex flex-column align-items-center h-custom-2 px-5 ms-xl-4 mt-4 pt-4 pt-md-0">
                    <form action="{{ url('/loginapi') }}" method="POST" class="sign-in-form">
                        @if ($errors->any())
                        <div id="error-alert" class="custom-alert">
                            {{ $errors->first('message') }}
                        </div>
                        @endif
                        @csrf
                        <div class="form-outline mb-4">
                        <div class="d-flex justify-content-center align-items-center">
    <img src="{{ asset('images/log.png') }}" alt="Imagen" style="width: 85px; height: auto;">
</div>


                            <div class="input-group">
                                <span class="input-group-text bg-transparent border-0">
                                    <i class="fas fa-envelope"></i>
                                </span>
                                <input type="email" name="email" id="form2Example18" class=" form-control-lg"
                                    placeholder="Email">
                            </div>
                        </div>

                        <div class="form-outline mb-4">
                            <div class="input-group">
                                <span class="input-group-text bg-transparent border-0">
                                    <i class="fas fa-lock"></i>
                                </span>
                                <input type="password" name="password" id="form2Example28"
                                    class=" form-control-lg" placeholder="Contraseña">
                                <span class="input-group-text bg-transparent border-0 eye-icon"
                                    onclick="togglePassword('form2Example28')">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                        </div>
                        <div class="pt-1 mb-4">
                            <button class="btn btn-info btn-lg btn-block" type="submit">Login</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 px-0 d-none d-md-block text-center">
                <img src="{{ asset('images/log.png') }}" alt="Login image" class="img-fluid custom-img">
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function togglePassword(inputId) {
        var passwordInput = document.getElementById(inputId);
        var eyeIcon = passwordInput.nextElementSibling.querySelector("i");
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            eyeIcon.classList.remove("fa-eye");
            eyeIcon.classList.add("fa-eye-slash");
        } else {
            passwordInput.type = "password";
            eyeIcon.classList.remove("fa-eye-slash");
            eyeIcon.classList.add("fa-eye");
        }
    }

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

</html>
