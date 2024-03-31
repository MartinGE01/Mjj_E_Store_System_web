@extends('raiz.panel')

@section('content')
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table mr-1"></i>
            Actualizar Producto
        </div>
        <div class="card-body">
        <form method="POST" action="{{ route('productos.update', $producto['id']) }}" id="userForm">
                          
            
            @csrf
                @method('PUT')
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="small mb-1" for="nombre">Nombre</label>
                            <input class="form-control py-4" id="nombre" name="nombre" type="text" value="{{ $producto['nombre'] }}" required />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="small mb-1" for="descripcion">Descripción</label>
                            <input class="form-control py-4" id="descripcion" name="descripcion" type="text" value="{{ $producto['descripcion'] }}" required />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="small mb-1" for="precio">Precio</label>
                            <input class="form-control py-4" id="precio" name="precio" type="text" value="{{ $producto['precio'] }}" required />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="small mb-1" for="stock">Stock</label>
                            <input class="form-control py-4" id="stock" name="stock" type="text" value="{{ $producto['stock'] }}" required />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="small mb-1" for="estado">Estado</label>
                            <input class="form-control py-4" id="estado" name="estado" type="text" value="{{ $producto['estado'] }}" required />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="small mb-1" for="categoria_id">Categoría</label>
                            <input class="form-control py-4" id="categoria_id" name="categoria_id" type="text" value="{{ $producto['categoria_id'] }}" required />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="small mb-1" for="imagen">Imagen</label>
                            <input name="imagen" type="file" />
                        </div>
                    </div>
                </div>
                <div class="form-group mt-4 mb-0">
                    <button class="btn btn-primary btn-block" type="submit">Actualizar Producto</button>
                </div>
            </form>
        </div>
    </div>
    
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
