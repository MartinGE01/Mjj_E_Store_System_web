<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\AuthController;



// routes/web.php
// routes/web.php




Route::redirect('/', '/login');

// Ruta para mostrar el formulario de inicio de sesión
Route::get('login', function () {
    return view('login');
})->name('login'); // Establecer un nombre para la ruta


Route::post('/loginapi', [ApiController::class,'login'] );
Route::get('auth/logout', [ApiController::class, 'logout'])->name('logout');


// Ruta para mostrar el formulario de registro
Route::get('register', function () {
    return view('register');
});
// routes/web.php

// Ruta para mostrar el formulario de registro
Route::get('register', function () {
    return view('register');
})->name('register'); // Establecer un nombre para la ruta

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::view('/NuevoUsuario', 'user.nuevUser')->name('NuevoUsuario');
Route::view('/UsuariosDispon', 'user.usuario')->name('UsuariosDispon');
Route::view('/reporteProducto', 'product.reportProd')->name('reporteProducto');
Route::view('/nuevoProducto', 'product.nuevProd')->name('nuevoProducto');
Route::view('/producto', 'product.producto')->name('producto');







