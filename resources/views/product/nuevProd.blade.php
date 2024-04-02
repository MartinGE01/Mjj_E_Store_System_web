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
                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Nuevo Producto</h3></div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('producto.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputFirstName">Nombre</label>
                                        <input class="form-control py-4" name="nombre" type="text" placeholder="" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputFirstName">Descripcion</label>
                                        <input class="form-control py-4" name="descripcion" type="text" placeholder="" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputLastName">Precio</label>
                                        <input class="form-control py-4" name="precio" type="text" placeholder="" />
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputLastName">Stock</label>
                                        <input class="form-control py-4" name="stock" type="text" placeholder="" />
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputLastName">Estado</label>
                                        <input class="form-control py-4" name="estado" type="text" placeholder="" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputRol">Rol</label>
                                        <select class="form-control" name="categoria_id" id="inputRol" required>
                                            <option value="">Seleccionar Categoria</option>
                                            <option value="1">Móvil</option>
                                            <option value="2">Portátiles</option>
                                            <option value="3">Dispositivo Inteligente</option>
                                            <!-- Agrega más opciones según los roles disponibles -->
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputLastName">Imagen</label>
                                        <input name="imagen" type="file" />
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