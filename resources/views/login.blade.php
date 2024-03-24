<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}"> <!-- Enlazar tu archivo CSS -->
    <link rel="stylesheet" href="{{ asset('css/stylosredes.css') }}">
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">
                <div class="card">
                    <form action="{{ url('/loginapi') }}" method="POST" class="sign-in-form">
                        @csrf
                        <h2 class="title">Inicio de sesión</h2>
                        @if ($errors->any())
                        <div id="error-alert" class="custom-alert">
                            {{ $errors->first('message') }}
                        </div>
                        @endif
                        <div class="input-field">
                            <i class="fas fa-user"></i>
                            <input type="email" name="email" placeholder="Email" required />
                        </div>
                        <div class="input-field">
                            <i class="fas fa-lock"></i>
                            <input type="password" name="password" id="password" placeholder="Password" required />
                            <i id="togglePassword" class="fas fa-eye" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;"></i>
                        </div>
                        <input type="submit" value="Login" class="btn solid" />
                    </form>
                </div>
                <div class="redes-sociales">
                    <p></p>
                    <ul>
                        <li><a href="https://www.facebook.com/"><i class="fab fa-facebook"></i></a></li>
                        <li><a href="https://www.tiktok.com/"><i class="fab fa-tiktok"></i></a></li>
                        <li><a href="https://www.youtube.com/"><i class="fab fa-youtube"></i></a></li>
                        <li><a href="https://twitter.com/"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>¡Sistema Mjj_E_Store_System!</h3>
                    <p>Descubre un mundo de posibilidades infinitas para tu negocio. Únete a nuestra comunidad hoy mismo y comienza tu viaje hacia el éxito. ¡No esperes más para hacer realidad tus sueños empresariales!</p>
                </div>
                <img src="{{ asset('images/log.png') }}" class="image" alt="">
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <h3></h3>
                    <p></p>
                </div>
                <img src="./img/register.svg" class="image" alt="">
            </div>
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('css/alerta.js') }}"></script>
    <script src="./app.js"></script>
    <script src="./alerta.js"></script>
    <script>
        var passwordInput = document.getElementById('password');
        var togglePassword = document.getElementById('togglePassword');

        togglePassword.addEventListener('click', function () {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                togglePassword.classList.remove('fa-eye');
                togglePassword.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                togglePassword.classList.remove('fa-eye-slash');
                togglePassword.classList.add('fa-eye');
            }
        });

        var errorAlert = document.getElementById('error-alert');
        if (errorAlert) {
            setTimeout(function () {
                errorAlert.style.display = 'none';
            }, 2000);
        }
    </script>
</body>

</html>

