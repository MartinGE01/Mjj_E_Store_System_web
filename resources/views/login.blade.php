<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

  <link rel="stylesheet" href="{{ asset('css/styles.css') }}"> 
  <!-- Custom styles -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>
<style>
        body {
            background-color: black;
            color: white; /* Cambiar el color del texto a blanco para que sea legible */
        }
    </style>
<section class="vh-100">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-9 col-lg-6 col-xl-5">
      <img src="{{ asset('images/log.png') }}" alt="Logo">

      </div>
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
      <form action="{{ url('/loginapi') }}" method="POST">
    @csrf
    <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
        <p class="lead fw-normal mb-0 me-3">Inicio de Sesion</p>
       
    </div>

    <div class="divider d-flex align-items-center my-4">
       
    </div>
    @if ($errors->any())
    <div id="error-alert" class="custom-alert">
        {{ $errors->first('message') }}
    </div>
@endif

    <!-- Email input -->
    <div class="form-outline mb-4">
    <p class="text-center fw-bold mx-3 mb-0">Gmail</p>
        <input type="email" id="form3Example3" name="email" class="form-control form-control-lg"
            placeholder="Ingrese tu Gmail" required />
        <label class="form-label" for="form3Example3"></label>
    </div>

    <!-- Password input -->
    <div class="form-outline mb-3">
    <p class="text-center fw-bold mx-3 mb-0">Contraseña</p>
        <input type="password" id="form3Example4" name="password" class="form-control form-control-lg"
            placeholder="Enter password" required />
        <input type="checkbox" id="showPassword">
        <label for="showPassword">Ver contraseña</label>
    </div>

    <div class="d-flex justify-content-between align-items-center">
        <!-- Checkbox -->
       
       
    </div>

    <div class="text-center text-lg-start mt-4 pt-2">
        <button type="submit" class="btn btn-primary btn-lg"
            style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
        <p class="small fw-bold mt-2 pt-1 mb-0"><a href="#!"
                class="link-danger"></a></p>
    </div>
</form>

<script>
    var showPassword = document.getElementById('showPassword');
    var passwordInput = document.getElementById('form3Example4');

    showPassword.addEventListener('change', function() {
        if (showPassword.checked) {
            passwordInput.type = 'text';
        } else {
            passwordInput.type = 'password';
        }
    });
</script>

      </div>
    </div>
  </div>
  <div
    class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary">
    <!-- Copyright -->
    <div class="text-white mb-3 mb-md-0">
      Copyright © 2024. All rights reserved .
    </div>
    <!-- Copyright -->

    <!-- Right -->
    <div>
      <a href="#!" class="text-white me-4">
        <i class="fab fa-facebook-f"></i>
      </a>
      <a href="#!" class="text-white me-4">
        <i class="fab fa-twitter"></i>
      </a>
      <a href="#!" class="text-white me-4">
        <i class="fab fa-google"></i>
      </a>
      <a href="#!" class="text-white">
        <i class="fab fa-linkedin-in"></i>
      </a>
    </div>
    <!-- Right -->
  </div>
</section>
</body>
</html>