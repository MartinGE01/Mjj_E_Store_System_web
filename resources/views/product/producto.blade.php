@extends('raiz.panel')

@section('content')
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">

</head>
@livewire('filtro', ['productos' => $productosActivos])

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>


        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- Incluye SweetAlert -->

<script>
     document.addEventListener('DOMContentLoaded', function () {
    var productoDetalles; // Variable para almacenar los detalles del producto y la cantidad

    var btnComprar = document.querySelectorAll('.btn-comprar');

    btnComprar.forEach(function(btn) {
        btn.addEventListener('click', function () {
            Swal.fire({
                title: 'Ingrese la cantidad de productos',
                input: 'number',
                inputLabel: 'Cantidad',
                inputAttributes: {
                    min: '1',
                    step: '1'
                },
                showCancelButton: true,
                confirmButtonText: 'Comprar',
                cancelButtonText: 'Cancelar',
                showLoaderOnConfirm: true,
                preConfirm: (cantidad) => {
                    return cantidad;
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed) {
                    var cantidad = result.value;
                    var productoId = btn.dataset.id;

                    fetch(`/ruta/a/venta/${productoId}?cantidad=${cantidad}`, {
                        method: 'GET',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Calcular el total a pagar y agregarlo a productoDetalles
                        var totalPagar = data.data.precio * cantidad;
                        productoDetalles = { ...data, cantidad: cantidad, totalPagar: totalPagar };
                        mostrarDetallesProducto(productoDetalles);
                        
                        // Crear la venta utilizando los detalles del producto
                        crearVenta(productoDetalles);
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            title: 'Error',
                            text: 'No se pudo obtener la información del producto.',
                            icon: 'error'
                        });
                    });
                }
            });
        });
    });

    // Función para mostrar los detalles del producto
    function mostrarDetallesProducto(productoDetalles) {
        Swal.fire({
            title: 'Detalles del producto',
            html: `
            <p>CÓDIGO DEL PRODUCTO: ${productoDetalles.data.id}</p>
            <p>NOMBRE DEL PRODUCTO: ${productoDetalles.data.nombre}</p>
            <p>CATEGORÍA DEL PRODUCTO: ${productoDetalles.data.categoria_id}</p>
            <p>CANTIDAD: ${productoDetalles.cantidad}</p> 
            <p>PRECIO UNITARIO: ${productoDetalles.data.precio}</p>
            <p>TOTAL A PAGAR: ${productoDetalles.totalPagar}</p>
            `,
            icon: 'info'
        });
    }

    // Función para enviar los detalles del producto al controlador para crear la venta
    function crearVenta(productoDetalles) {
        fetch('/ruta/a/crear-venta', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                producto_id: productoDetalles.data.id,
                cantidad: productoDetalles.cantidad,
                total_pagar: productoDetalles.totalPagar,
                precio: productoDetalles.data.precio,
            })
        })
        .then(response => {
    if (!response.ok) {
        throw new Error('La solicitud falló con un código de estado ');
    }
    return response.json();
})

        .then(data => {
            // Manejar la respuesta del servidor si es necesario
            console.log('Respuesta del servidor:', data);
            // Aquí puedes mostrar un mensaje de éxito o redirigir a otra página
        })
        .catch(error => {
            console.error('Error:', error);
            // Aquí puedes mostrar un mensaje de error al usuario
        });
    }
});

</script>
@endsection