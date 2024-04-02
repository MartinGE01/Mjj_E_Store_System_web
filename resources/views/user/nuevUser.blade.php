@extends('raiz.panel')

@section('content')
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>
<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header"><h1 class="text-center font-weight-light my-4"><b>Agregar nuevo Usuario</b></h1></div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('usuarios.store')}}" enctype="multipart/form-data" id="userForm">
                            @csrf
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputFirstName">Nombre</label>
                                        <input class="form-control py-4" name="name" type="text" placeholder="" required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputEmail">Correo</label>
                                        <input class="form-control py-4" name="email" type="email" placeholder="" required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputLastName">Contraseña</label>
                                        <input class="form-control py-4" name="password" type="password" placeholder="" minlength="8" required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputRol">Rol</label>
                                        <select class="form-control" name="departamento_id" id="inputRol" required>
                                            <option value="">Seleccionar Rol</option>
                                            <option value="1">Admin</option>
                                            <option value="2">Cajero</option>
                                            <option value="3">Asesor de venta</option>
                                            <option value="4">Almacenero</option>
                                            <!-- Agrega más opciones según los roles disponibles -->
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mt-4 mb-0"><button class="btn btn-primary btn-block" type="submit">Registrar</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
   
</script>
@if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '{{ session('error') }}'
        });
    </script>
@endif
@if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Éxito',
            text: '{{ session('success') }}'
        });
    </script>
@endif
@endsection
