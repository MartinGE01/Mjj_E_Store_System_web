<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\AutVist;

// routes/web.php
// routes/web.php
Route::redirect('/', '/login');

// Ruta para mostrar el formulario de inicio de sesión
Route::get('login', function () {
    return view('login');
})->name('login'); // Establecer un nombre para la ruta

Route::post('/loginapi', [ApiController::class,'login']);
Route::get('auth/logout', [ApiController::class, 'logout'])->name('logout');

// Ruta para mostrar el formulario de registro
Route::get('register', function () {
    return view('register');
})->name('register'); // Establecer un nombre para la ruta

Route::middleware([AutVist::class])->group(function () {
    // Todas las rutas dentro de este grupo requerirán autenticación
   Route::get('/dashboard', function () {
    $totalProductos = app(\App\Http\Controllers\ProductoController::class)->totalProductos();
    $totalProductosActivos = app(\App\Http\Controllers\ProductoController::class)->totalProductosActivos();
    $totalventasRealizadas = app(\App\Http\Controllers\VentaController::class)->totalventasRealizadas();
    $totalventasPendientes = app(\App\Http\Controllers\VentaController::class)->totalventasPendientes();
    return view('dashboard', ['totalProductos' => $totalProductos, 'totalProductosActivos' => $totalProductosActivos, 'totalventasRealizadas' => $totalventasRealizadas, 'totalventasPendientes' => $totalventasPendientes]);
})->name('dashboard');

    Route::view('/NuevoUsuario', 'user.nuevUser')->name('NuevoUsuario');
    Route::view('/UsuariosDispon', 'user.usuario')->name('UsuariosDispon');
    /* ruta de la carptea user*/
    Route::get('/UsuariosDispon', [UserController::class, 'index'])->name('UsuariosDispon');
    Route::post('/usuarios', [UserController::class, 'store'])->name('usuarios.store');
    Route::delete('/usuarios/{id}', [UserController::class, 'destroy'])->name('usuarios.destroy');
    Route::get('/usuarios/{id}/edit', [UserController::class, 'edit'])->name('usuarios.edit');
    Route::put('/usuarios/{id}',[UserController::class, 'udateUser'])->name('usuarios.update');

    
    /*rutas de la carpeta product */
    Route::get('/reporte-producto', [ProductoController::class, 'index'])->name('reporteProducto');
    Route::get('/producto-disponible', [ProductoController::class, 'totalProductosDispon'])->name('productoDispon');
    Route::post('/productNuev', [ProductoController::class, 'store'])->name('producto.store');
    
    Route::view('/nuevoProducto', 'product.nuevProd')->name('nuevoProducto');
    Route::view('/producto', 'product.producto')->name('producto');

    Route::delete('/productos/{id}', [ProductoController::class, 'eliminarProducto'])->name('productos.eliminar');
    Route::get('/get-productos-por-categoria', [ProductoController::class, 'getProductosPorCategoria'])->name('productos.por.categoria');
    Route::get('/productos/{id}/edit', [ProductoController::class, 'edit'])->name('productos.edit');
    Route::put('/productos/{id}', [ProductoController::class, 'update'])->name('productos.update');

    /*venta*/
    Route::get('/ventas-pendientes', [VentaController::class, 'index'])->name('ventapendiente');
    Route::get('/ventas-realizadas', [VentaController::class, 'finalizado'])->name('ventafinalizada');
    Route::post('/ruta/a/crear-venta', [VentaController::class, 'store']);
    Route::get('ventas/finalizar/{id}', [VentaController::class, 'finalizarVenta'])->name('ventas.finalizar');
    Route::get('/ruta/a/venta/{id}', [VentaController::class, 'obtenerDetallesProducto']);
    Route::get('/venta-por-dia', [VentaController::class, 'VentasDiarias'])->name('venta.por.dia');
});



