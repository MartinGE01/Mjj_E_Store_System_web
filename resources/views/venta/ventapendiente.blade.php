@extends('raiz.panel')

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table mr-1"></i>
           Venta pendiente
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Codigo</th>
                            <th>Usuario</th>
                            <th>Nombre del Producto</th>
                            <th>Cantidad</th>
                            <th>Precio Unitario</th>
                            <th>Total de la Venta</th>
                            <th>Estado </th>
                            <th>Fecha</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($ventas as $venta)
                        <tr>
                            <td>{{ $venta['id'] }}</td>
                            <td>{{ $venta['nombre_usuario'] }}</td>
                            <td>{{ $venta['nombre_producto'] }}</td>
                            <td>{{ $venta['cantidad'] }}</td>
                            <td>${{ $venta['precio_unitario'] }}</td>
                            <td>${{ $venta['total_venta'] }}</td>
                            <td>{{ $venta['estado'] }}</td>
                            <td>{{ $venta['created_at'] }}</td>
                            <td>
                                <button class="btn btn-sm btn-info finalizar-venta-btn" data-id="{{ $venta['id'] }}">Finalizar Venta</button>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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
                    { targets: [8], orderable: false }
                ],
                dom: 'lBfrtip',
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'pdfHtml5',
                    'print'
                ]
            });

            // Delegar evento de clic para los botones de finalizar venta
            $('#dataTable').on('click', '.finalizar-venta-btn', function() {
                var ventaId = $(this).data('id');

                // Mostrar SweetAlert de confirmación
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "¿Quieres finalizar esta venta?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, finalizarla'
                }).then((result) => {
                    // Si el usuario confirma, enviar la solicitud de finalización de venta
                    if (result.isConfirmed) {
                        // Redirigir a la ruta de finalizar venta con el ID de la venta
                        window.location.href = "{{ url('ventas/finalizar') }}/" + ventaId;
                    }
                });
            });
        });
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
