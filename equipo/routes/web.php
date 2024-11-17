<?php

use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\VueloController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\ReservacionController;
use App\Http\Controllers\AdministradorController;
use Illuminate\Support\Facades\Route;

// Rutas de inicio
Route::get('/', [VueloController::class, 'inicio'])->name('inicio');

Route::get('/registro', [UsuarioController::class, 'mostrarRegistro'])->name('registro.mostrar');
Route::post('/registro/enviar', [UsuarioController::class, 'registrar'])->name('registro.enviar');
Route::get('/login', [UsuarioController::class, 'mostrarLogin'])->name('login.mostrar');
Route::post('/login', [UsuarioController::class, 'autenticar'])->name('login.enviar');
Route::post('/logout', [UsuarioController::class, 'logout'])->name('logout');



// Rutas de vuelos y hoteles
Route::get('/buscar-vuelos', [VueloController::class, 'mostrarFormularioBusqueda'])->name('buscar.vuelos');
Route::get('/resultados-vuelos', [VueloController::class, 'buscar'])->name('resultados.vuelos');
Route::get('/hoteles/buscar', [HotelController::class, 'mostrarFormularioBusqueda'])->name('hoteles.buscar');
Route::get('/hoteles/resultados', [HotelController::class, 'buscar'])->name('hoteles.resultados');
Route::get('/hoteles/detalle/{id}', [HotelController::class, 'mostrarDetalle'])->name('hoteles.detalle');

// Rutas de registro e inicio de sesión

Route::get('/clientes', [ClienteController::class, 'mostrar'])->name('clientes.mostrar');
Route::get('/login', [UsuarioController::class, 'mostrarLogin'])->name('login.mostrar');
Route::post('/login', [UsuarioController::class, 'autenticar'])->name('login.enviar');
Route::post('/logout', [UsuarioController::class, 'logout'])->name('logout');





// Recuperación de contraseña y doble autenticación
Route::get('/recuperar', [UsuarioController::class, 'mostrarRecuperar'])->name('recuperar');
Route::post('/recuperar', [UsuarioController::class, 'recuperar']);
Route::get('/doble-autenticacion', [UsuarioController::class, 'mostrarDobleAutenticacion'])->name('dobleAutenticacion');
Route::post('/doble-autenticacion', [UsuarioController::class, 'verificarDobleAutenticacion']);
Route::get('/confirmar-registro', [UsuarioController::class, 'confirmarRegistro'])->name('confirmar.registro');
Route::get('/resetear-contrasena', [UsuarioController::class, 'mostrarResetearContrasena'])->name('resetear.contrasena');
Route::post('/resetear-contrasena', [UsuarioController::class, 'resetearContrasena']);

// Rutas para reservaciones
Route::get('/reservaciones', [ReservacionController::class, 'index'])->name('reservaciones');
Route::middleware('auth')->group(function () {
Route::post('/reservar', [ReservacionController::class, 'agregarAlCarrito'])->name('reservar.agregar');
Route::get('/carrito', [ReservacionController::class, 'verCarrito'])->name('carrito');
Route::post('/confirmar', [ReservacionController::class, 'confirmarReservacion'])->name('reservar.confirmar');
});

// Rutas de administración (solo para administrar vuelos, hoteles, usuarios, etc.)
Route::prefix('admin')->group(function () {

    // Ruta para el dashboard principal del admin
    Route::get('/', [AdministradorController::class, 'dashboard'])->name('admin.dashboard'); // Ruta para el panel de administración principal

    // Rutas para gestionar usuarios
    Route::get('usuarios', [AdministradorController::class, 'listarUsuarios'])->name('admin.usuarios.index');
    Route::get('usuario/crear', [AdministradorController::class, 'crearUsuarioFormulario'])->name('admin.usuario.crear');
    Route::post('usuario/crear', [AdministradorController::class, 'crearUsuario'])->name('admin.usuario.store');
    Route::delete('usuario/{id}', [AdministradorController::class, 'eliminarUsuario'])->name('admin.usuario.destroy');
    
    // Rutas para gestionar vuelos
    Route::get('vuelos', [AdministradorController::class, 'listarVuelos'])->name('admin.vuelos.index');
    Route::get('vuelo/crear', [AdministradorController::class, 'crearVueloFormulario'])->name('admin.vuelo.crear');
    Route::post('vuelo/crear', [AdministradorController::class, 'crearVuelo'])->name('admin.vuelo.store');
    Route::delete('vuelo/{id}', [AdministradorController::class, 'eliminarVuelo'])->name('admin.vuelo.destroy');
    
    // Rutas para gestionar hoteles
    Route::get('hoteles', [AdministradorController::class, 'listarHoteles'])->name('admin.hoteles.index');
    Route::get('hotel/crear', [AdministradorController::class, 'crearHotelFormulario'])->name('admin.hotel.crear');
    Route::post('hotel/crear', [AdministradorController::class, 'crearHotel'])->name('admin.hotel.store');
    Route::delete('hotel/{id}', [AdministradorController::class, 'eliminarHotel'])->name('admin.hotel.destroy');
    
    // Rutas para gestionar reservaciones
    Route::get('reservaciones', [AdministradorController::class, 'listarReservaciones'])->name('admin.reservaciones.index');
    Route::delete('reservacion/{id}', [AdministradorController::class, 'eliminarReservacion'])->name('admin.reservacion.destroy');

    // Ruta para generar reportes
    Route::get('reportes', [AdministradorController::class, 'generarReporte'])->name('admin.reportes');
});
