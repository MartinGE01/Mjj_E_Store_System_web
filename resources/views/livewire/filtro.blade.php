<div class="container-fluid fruite py-5">
            <div class="container py-5">
                <div class="tab-class text-center">
                    <div class="row g-4">
                        <div class="col-lg-4 text-start">
                            <h1>Productos disponibles</h1>
                        </div>
                        <div class="col-lg-8 text-end">
                            <ul class="nav nav-pills d-inline-flex text-center mb-5">
                                <li class="nav-item">
                                    <button wire:click="todos" class="d-flex m-2 py-2 bg-light rounded-pill active" data-bs-toggle="pill" href="#tab-1">
                                        <span class="text-dark" style="width: 130px;">Todos los productos</span>
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <button wire:click="filtrar('Móvil')" class="d-flex py-2 m-2 bg-light rounded-pill" data-bs-toggle="pill" href="#tab-2">
                                        <span class="text-dark" style="width: 130px;">moviles y accesorios</span>
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <button wire:click="filtrar('Portátiles')" class="d-flex m-2 py-2 bg-light rounded-pill" data-bs-toggle="pill" href="#tab-3">
                                        <span class="text-dark" style="width: 130px;">Portatiles y accesrios</span>
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <button wire:click="filtrar('Dispositivo Inteligente')" class="d-flex m-2 py-2 bg-light rounded-pill" data-bs-toggle="pill" href="#tab-4">
                                        <span class="text-dark" style="width: 130px;">Dispositivos inteligente</span>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane fade show p-0 active">
                            <div class="row g-4">
                                <div class="col-lg-12">
                                    <div class="row g-4">
                                    @foreach($productosActivos as $producto)
                                        <div class="col-md-6 col-lg-4 col-xl-3">
                                            <div class="rounded position-relative fruite-item">
                                                <div class="fruite-img">
                                                    <img src="https://prub.colegiohessen.edu.pe/{{ $producto['imagen'] }}" class="img-fluid w-100 rounded-top" alt="">
                                                </div>
                                                <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">{{ $producto['categoria'] }}</div>
                                                <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                           
                                                    <h4>{{ $producto['nombre'] }}</h4>
                                                    <p>{{ $producto['descripcion'] }}</p>
                                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                                        <p class="text-dark fs-5 fw-bold mb-0">${{ $producto['precio'] }}</p>
                                                        
                                                        <a href="#" data-id="{{ $producto['id'] }}" class="btn border border-secondary rounded-pill px-3 text-primary  btn-comprar"><i class="fa fa-shopping-bag me-2 text-primary"></i> Comprar</a>

                                                                                
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>      
            </div>
        </div>