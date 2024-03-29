@extends('raiz.panel')

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table mr-1"></i>
            Reporte de productos
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Codigo</th>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>precio</th>
                            <th>Stock</th>
                            <th>Imagen</th>
                            <th>Estado</th>
                            <th>Categoria</th>
                            <th>Funciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($productos as $producto)
                        <tr>
                            <td>{{ $producto['id'] }}</td>
                            <td>{{ $producto['nombre'] }}</td>
                            <td>{{ $producto['descripcion'] }}</td>
                            <td>{{ $producto['precio'] }}</td>
                            <td>{{ $producto['stock'] }}</td>
                            <td><img src="https://prub.colegiohessen.edu.pe/{{ $producto['imagen'] }}" style="max-width: 100px;"></td>
                            <td>{{ $producto['estado'] }}</td>
                            <td>{{ $producto['categoria'] }}</td>
                            <td>
                                <a href="#" class="btn btn-sm btn-info">Edit</a>
                                <a href="#" class="btn btn-sm btn-danger">Delete</a>
                                {{-- Botón Purchase --}}
                                <a href="#" class="btn btn-sm btn-info">Purchase</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    {{-- DataTables Buttons --}}
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                columnDefs: [
                    { targets: [6], orderable: false } // Desactivar la ordenación en la columna de acciones
                ],
                dom: 'lBfrtip',
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'pdfHtml5',
                    'print'
                ]
            });
        });
    </script>
@endsection
