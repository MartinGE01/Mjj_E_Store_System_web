@extends('raiz.panel')

@section('content')

<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table mr-1"></i>
        Customers List
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Id del rol</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($usuarios as $usuario)
                    <tr>
                        <td>{{ $usuario['id'] }}</td>
                        <td>{{ $usuario['name'] }}</td>
                        <td>{{ $usuario['email'] }}</td>
                        <td>{{ $usuario['departamento_id'] }}</td>
                        <td>{{ $usuario['departamento'] }}</td>
                        <td>
                            <a href="#" class="btn btn-sm btn-info">Edit</a>
                            <form id="deleteForm{{ $usuario['id'] }}" action="{{ route('usuarios.destroy', $usuario['id']) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-danger delete-btn" data-id="{{ $usuario['id'] }}">Delete</button>
                            </form>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $('#dataTable').DataTable({
        columnDefs: [{
            bSortable: false,
            targets: [5]
        }],
        dom: 'lBfrtip',
        buttons: [{
                extend: 'copyHtml5',
                exportOptions: {
                    modifier: {
                        page: 'current'
                    },
                    columns: [0, ':visible']
                }
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    modifier: {
                        page: 'current'
                    },
                    columns: [0, ':visible']
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    modifier: {
                        page: 'current'
                    },
                    columns: [0, 1, 2, 5]
                }
            },
            'colvis'
        ],
    });

    // Función para manejar el clic del botón "Delete"
    $('.delete-btn').click(function() {
        var id = $(this).data('id');

        // Mostrar una alerta SweetAlert2 de confirmación
        Swal.fire({
            title: '¿Estás seguro que desea eliminar?',
            text: '¡No podrás revertir esto!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí, eliminarlo',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Si se confirma la eliminación, enviar el formulario de eliminación
                $('#deleteForm' + id).submit();
            }
        });
    });

    @if(session('success'))
    Swal.fire({
        title: 'Éxito',
        text: '{{ session('success') }}',
        icon: 'success'
    });
    @endif

    @if(session('error'))
    Swal.fire({
        title: 'Error',
        text: '{{ session('error') }}',
        icon: 'error'
    });
    @endif
</script>
@endsection
