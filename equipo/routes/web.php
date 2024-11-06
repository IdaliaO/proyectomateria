<?php

use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\VueloController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\ReservacionController;
use App\Http\Controllers\AdministradorController;
use Illuminate\Support\Facades\Route;


//inicio
Route::get('/', [VueloController::class, 'inicio'])->name('inicio');
//vuelos y hoteles
Route::get('/buscar-vuelos', [VueloController::class, 'mostrarFormularioBusqueda'])->name('buscar.vuelos');
Route::get('/resultados-vuelos', [VueloController::class, 'buscar'])->name('resultados.vuelos');
Route::get('/hoteles/buscar', [HotelController::class, 'mostrarFormularioBusqueda'])->name('hoteles.buscar');
Route::get('/hoteles/resultados', [HotelController::class, 'buscar'])->name('hoteles.resultados');
Route::get('/hoteles/detalle/{id}', [HotelController::class, 'mostrarDetalle'])->name('hoteles.detalle');


//registro e inicio de sesion
Route::get('/registro', [UsuarioController::class, 'mostrarRegistro'])->name('registro.mostrar');
Route::post('/registro', [UsuarioController::class, 'registrar'])->name('registro.enviar');
Route::get('/clientes', [ClienteController::class, 'mostrar'])->name('clientes.mostrar');
Route::get('/login', [UsuarioController::class, 'mostrarLogin'])->name('login.mostrar');
Route::post('/login', [UsuarioController::class, 'autenticar'])->name('login.enviar');
Route::post('/logout', [UsuarioController::class, 'logout'])->name('logout');




Route::get('/recuperar', [UsuarioController::class, 'mostrarRecuperar'])->name('recuperar');
Route::post('/recuperar', [UsuarioController::class, 'recuperar']);
Route::get('/doble-autenticacion', [UsuarioController::class, 'mostrarDobleAutenticacion'])->name('dobleAutenticacion');
Route::post('/doble-autenticacion', [UsuarioController::class, 'verificarDobleAutenticacion']);
Route::get('/confirmar-registro', [UsuarioController::class, 'confirmarRegistro'])->name('confirmar.registro');
Route::get('/resetear-contrasena', [UsuarioController::class, 'mostrarResetearContrasena'])->name('resetear.contrasena');
Route::post('/resetear-contrasena', [UsuarioController::class, 'resetearContrasena']);
Route::get('/reservaciones', [ReservacionController::class, 'index'])->name('reservaciones');





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
