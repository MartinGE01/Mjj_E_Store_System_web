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
});

Route::post('/loginapi', [ApiController::class,'login'] );
    


// Ruta para mostrar el formulario de registro
Route::get('register', function () {
    return view('register');
});
// routes/web.php

// Ruta para mostrar el formulario de registro
Route::get('register', function () {
    return view('register');
})->name('register'); // Establecer un nombre para la ruta


Route::view('/bienvenido', 'bienvenido')->name('bienvenido');








