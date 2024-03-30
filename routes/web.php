<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\ProductoController;
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
    return view('dashboard', ['totalProductos' => $totalProductos, 'totalProductosActivos' => $totalProductosActivos]);
})->name('dashboard');

    Route::view('/NuevoUsuario', 'user.nuevUser')->name('NuevoUsuario');
    Route::view('/UsuariosDispon', 'user.usuario')->name('UsuariosDispon');
    /* ruta de la carptea user*/
    Route::get('/UsuariosDispon', [UserController::class, 'index'])->name('UsuariosDispon');
    Route::post('/usuarios', [UserController::class, 'store'])->name('usuarios.store');
    
    Route::delete('/usuarios/{id}', [UserController::class, 'destroy'])->name('usuarios.destroy');

    
    /*rutas de la carpeta product */
    Route::get('/reporte-producto', [ProductoController::class, 'index'])->name('reporteProducto');
    
    Route::view('/nuevoProducto', 'product.nuevProd')->name('nuevoProducto');
    Route::view('/producto', 'product.producto')->name('producto');

});

