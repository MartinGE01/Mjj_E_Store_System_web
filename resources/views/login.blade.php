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
            background-color: #00;
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
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-6 text-black">
                <div class="px-5 ms-xl-4">
                <i class="fas fa-chart-line fa-2x me-3 pt-5 mt-xl-4" style="color: #709085;"></i>

                </div>

                <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">
                    <form action="{{ url('/loginapi') }}" method="POST" class="sign-in-form">
                        @csrf
                        @if ($errors->any())
                        <div id="error-alert" class="custom-alert">
                            {{ $errors->first('message') }}
                        </div>
                        @endif

                      <label class="formemail" for="form2Example18">Email</label>
                        <div class="form-outline mb-4">
                            <div class="input-group">
                                <span class="input-group-text bg-transparent border-0"><i class="fas fa-envelope"></i></span> <!-- Elimina el borde -->
                                <input type="email" name="email" id="form2Example18" class="form-control form-control-lg" style="color: black; border: 1px solid black; border-radius: 5px;" />

                            </div>
                        </div>
                        <label class="formpassword" for="form2Example28">Password</label>
                        <div class="form-outline mb-4">
                            <div class="input-group">
                                <span class="input-group-text bg-transparent border-0" onclick="togglePassword('form2Example28')"><i class="fas fa-lock"></i></span> <!-- Elimina el borde -->
                                <input type="password" name="password" id="form2Example28" class="form-control form-control-lg" style="color: black; border: 1px solid black; border-radius: 5px;" />

                                
                                <span class="input-group-text bg-transparent border-0" onclick="togglePassword('form2Example28')"><i class="fas fa-eye"></i></span> <!-- Elimina el borde -->
                            </div>
                        </div>
                        <div class="pt-1 mb-4">
                            <button class="btn btn-info btn-lg btn-block" type="submit">Login</button>
                        </div>
                       
                   
                    </form>
                </div>
            </div>
            <div class="col-sm-6 px-0 d-none d-sm-block text-center">
                <img src="{{ asset('images/log.png') }}" alt="Login image" class="img-fluid custom-img">
            </div>
        </div>
    </div>
</body>
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

    var errorAlert = document.getElementById('error-alert');
    if (errorAlert) {
        setTimeout(function () {
            errorAlert.style.display = 'none';
        }, 2000);
    }
</script>

</html>
