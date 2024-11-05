<?php

use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\VueloController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\ReservacionController;
use App\Http\Controllers\AdministradorController;
use Illuminate\Support\Facades\Route;

// Página de inicio
Route::get('/', [VueloController::class, 'inicio'])->name('inicio');

// Redirecciona /home a la página de inicio principal
Route::get('/home', function () {
    return redirect()->route('inicio');
});


Route::get('/registro', [UsuarioController::class, 'mostrarRegistro'])->name('registro');
Route::post('/registro', [UsuarioController::class, 'registrar']);
Route::get('/login', [UsuarioController::class, 'mostrarLogin'])->name('login');
Route::post('/login', [UsuarioController::class, 'autenticar']);
Route::post('/logout', [UsuarioController::class, 'logout'])->name('logout');
Route::get('/recuperar', [UsuarioController::class, 'mostrarRecuperar'])->name('recuperar');
Route::post('/recuperar', [UsuarioController::class, 'recuperar']);
Route::get('/doble-autenticacion', [UsuarioController::class, 'mostrarDobleAutenticacion'])->name('dobleAutenticacion');
Route::post('/doble-autenticacion', [UsuarioController::class, 'verificarDobleAutenticacion']);
Route::get('/confirmar-registro', [UsuarioController::class, 'confirmarRegistro'])->name('confirmar.registro');
Route::get('/resetear-contrasena', [UsuarioController::class, 'mostrarResetearContrasena'])->name('resetear.contrasena');
Route::post('/resetear-contrasena', [UsuarioController::class, 'resetearContrasena']);

Route::get('/buscar-vuelos', [VueloController::class, 'mostrarFormularioBusqueda'])->name('buscar.vuelos');
Route::get('/resultados-vuelos', [VueloController::class, 'buscar'])->name('resultados.vuelos');

Route::get('/buscar-hoteles', [HotelController::class, 'mostrarFormularioBusqueda'])->name('buscar.hoteles');
Route::get('/resultados-hoteles', [HotelController::class, 'buscar'])->name('resultados.hoteles');


Route::middleware('auth')->group(function () {
Route::post('/reservar', [ReservacionController::class, 'agregarAlCarrito'])->name('reservar.agregar');
Route::get('/carrito', [ReservacionController::class, 'verCarrito'])->name('carrito');
    Route::post('/confirmar', [ReservacionController::class, 'confirmarReservacion'])->name('reservar.confirmar');
});

// Rutas de administración (solo para administradores)
Route::prefix('admin')->middleware('admin')->group(function () {
    Route::resource('vuelos', VueloController::class)->names('admin.vuelos');
    Route::resource('hoteles', HotelController::class)->names('admin.hoteles');
    Route::get('reportes', [AdministradorController::class, 'generarReporte'])->name('admin.reportes');
});
