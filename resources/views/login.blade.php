<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}"> <!-- Enlazar tu archivo CSS -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('css/alerta.js') }}"></script>
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
        
        <script>
            // Selecciona el elemento de la alerta
            var errorAlert = document.getElementById('error-alert');
            // Si la alerta existe, espera un segundo y luego la oculta
            if (errorAlert) {
                setTimeout(function() {
                    errorAlert.style.display = 'none';
                }, 2000); // 1000 milisegundos = 1 segundo
            }
        </script>

        <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="email" name="email" placeholder="Email" required />
        </div>
        <div class="input-field">
    <i class="fas fa-lock"></i>
    <input type="password" name="password" id="password" placeholder="Password" required />
    <input type="checkbox" id="togglePassword">
    <label for="togglePassword" style="font-size: smaller;">Mostrar contraseña</label>
</div>

<script>
    var togglePassword = document.getElementById('togglePassword');
    var passwordInput = document.getElementById('password');

    togglePassword.addEventListener('change', function() {
        if (togglePassword.checked) {
            passwordInput.type = 'text';
        } else {
            passwordInput.type = 'password';
        }
    });
</script>


        
        <input type="submit" value="Login" class="btn solid" />
    </form>
</div>

                
            </div>
        </div>
        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                <h3>¡Sistema Mjj_E_Store_System!</h3>
<p>Descubre un mundo de posibilidades infinitas para tu negocio. Únete a nuestra comunidad hoy mismo y comienza tu viaje hacia el éxito. ¡No esperes más para hacer realidad tus sueños empresariales!</p>

                   
<script>
    // Obtener el botón por su ID
    var signUpButton = document.getElementById('sign-up-btn');

    // Agregar un evento de clic al botón
    signUpButton.addEventListener('click', function() {
        // Redirigir a la página de registro
        window.location.href = "{{ route('register') }}";
    });
</script>

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
    <script src="./app.js"></script>
    <script src="./alerta.js"></script>
</body>
</html>
