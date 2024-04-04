@extends('raiz.panel')

@section('content')


    <script src="{{ asset('backend') }}/js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        
        <script src="{{ asset('js/chart-bar-demo.js') }}"></script>

        <script src="{{ asset('js/chart-area-demo.js') }}"></script>
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Panel de control</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Panel de control</li>
        </ol>
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body d-flex justify-content-between">
                        <span>Total de productos</span>
                        <span>{{ $totalProductos }}</span>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                    @if(session('departamento') == 'Admin' || session('departamento') == 'Almacenero')
                        <a class="small text-white stretched-link" href="{{ route('reporteProducto') }}">Ver Detalles</a>
                        @endif
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body d-flex justify-content-between">
                        <span>Productos vendidos</span>
                        <span>{{ $totalventasRealizadas }}</span>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                    @if(session('departamento') == 'Admin' || session('departamento') == 'Cajero')
                        <a class="small text-white stretched-link" href="{{ route('ventafinalizada') }} ">Ver Detalles</a>
                        @endif
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body d-flex justify-content-between">
                        <span>Productos Disponibles</span>
                        <span>{{ $totalProductosActivos }}</span>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{ route('productoDispon') }}">Ver Detalles</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body d-flex justify-content-between">
                        <span>Ordenes Pendientes</span>
                        <span>{{ $totalventasPendientes }}</span>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                    @if(session('departamento') == 'Admin' || session('departamento') == 'Cajero')
                        <a class="small text-white stretched-link" href="{{ route('ventapendiente') }}">Ver Detalles</a>
                        @endif
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-area mr-1"></i>
                        Cantidad de Productos Vendidos por Dia
                    </div>
                    <div class="card-body"><canvas id="myLineChart" width="100%" height="40"></canvas></div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-bar mr-1"></i>
                        Productos por Categoria
                    </div>
                    <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                </div>
            </div>
        </div>
       
    </div>
</main>
@endsection 