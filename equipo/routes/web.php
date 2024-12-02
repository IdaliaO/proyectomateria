<?php
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\VueloController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\ReservacionController;
use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\ComentarioController;

use Illuminate\Support\Facades\Route;

Route::get('/', [UsuarioController::class, 'inicio'])->name('inicio');

// Rutas de registro y login de usuarios(funcionan completamente con db)FALTA IMPLEMENTAR LO DE LA CONFIRMACION
Route::get('/registro', [UsuarioController::class, 'mostrarRegistro'])->name('registro.mostrar');
Route::post('/registro/enviar', [UsuarioController::class, 'registrar'])->name('registro.enviar');



//NO MODIFICAR solo es login
Route::get('/login', [UsuarioController::class, 'mostrarLogin'])->name('login');
Route::post('/login', [UsuarioController::class, 'autenticar'])->name('login.enviar');
Route::post('/logout', [UsuarioController::class, 'logout'])->name('logout');


// Rutas para hoteles NO MODIFICAR
Route::get('/hoteles/buscar', [HotelController::class, 'buscarHoteles'])->name('hoteles.buscar');
Route::get('/hoteles/resultados', [HotelController::class, 'resultadosHoteles'])->name('hoteles.resultados');
Route::get('/hoteles/detalle/{id}', [HotelController::class, 'mostrarDetalle'])->name('hoteles.detalle');
Route::post('/comentarios', [ComentarioController::class, 'guardar'])->name('comentarios.guardar');
// Rutas para vuelos NO MODIFICAR
Route::get('/vuelos/buscar', [VueloController::class, 'buscarVuelos'])->name('vuelos.buscar');
Route::get('/vuelos/resultados', [VueloController::class, 'resultadosVuelos'])->name('vuelos.resultados');

// RESERVACION HOTEL NO MODIFICAR

Route::get('/reservacion/{hotel_id}', [ReservacionController::class, 'mostrarFormularioReservacion'])->name('reservaciones.formulario');
Route::post('/reservacion/{hotel_id}/confirmar', [ReservacionController::class, 'confirmarReservacion'])->name('reservaciones.confirmar');
Route::get('/carrito', [ReservacionController::class, 'mostrarCarrito'])->name('carrito');
Route::post('/reservaciones/{id}/cancelar', [ReservacionController::class, 'cancelar'])->name('reservaciones.cancelar');
Route::post('/reservaciones/{id}/confirmar-pago', [ReservacionController::class, 'confirmarPago'])->name('reservaciones.confirmarPago');



// Rutas de administración funcionan con bd NO MODIFICAR
Route::prefix('admin')->group(function () {
// Dashboard
Route::get('/', [AdministradorController::class, 'dashboard'])->name('admin.dashboard');
// Autenticación
Route::get('/login', [AdministradorController::class, 'mostrarLogin'])->name('admin.login');
Route::post('/login', [AdministradorController::class, 'autenticar'])->name('admin.autenticar');
Route::post('/logout', [AdministradorController::class, 'logout'])->name('admin.logout');
// Registro de administradores
Route::get('/registro', [AdministradorController::class, 'mostrarRegistro'])->name('admin.registro');
Route::post('/registro/enviar', [AdministradorController::class, 'registrar'])->name('admin.registro.enviar');
Route::get('/administradores', [AdministradorController::class, 'listarAdministradores'])->name('admin.administradores.index');
Route::delete('/administradores/{id}', [AdministradorController::class, 'eliminarAdministrador'])->name('admin.administradores.destroy');
// Gestión de usuarios
Route::get('usuarios', [AdministradorController::class, 'listarUsuarios'])->name('admin.usuarios.index');
Route::get('usuarios/registro', [AdministradorController::class, 'crearUsuarioFormulario'])->name('admin.usuario.crear');
Route::post('usuarios/enviar', [AdministradorController::class, 'crearUsuario'])->name('admin.usuario.store');
Route::delete('/{id}', [AdministradorController::class, 'eliminarUsuario'])->name('admin.usuario.destroy');
// Gestión de vuelos
Route::prefix('vuelos')->group(function () {
Route::get('/', [AdministradorController::class, 'listarVuelos'])->name('admin.vuelos.index');
Route::get('/crear', [AdministradorController::class, 'crearVueloFormulario'])->name('admin.vuelos.crear');
Route::post('/', [AdministradorController::class, 'crearVuelo'])->name('admin.vuelos.store');
Route::get('/{id}/editar', [AdministradorController::class, 'editarVueloFormulario'])->name('admin.vuelos.edit');
Route::put('/{id}', [AdministradorController::class, 'actualizarVuelo'])->name('admin.vuelos.update');
Route::delete('/{id}', [AdministradorController::class, 'eliminarVuelo'])->name('admin.vuelos.destroy');
});
// Gestión de hoteles NO MODIFICAR
Route::prefix('hoteles')->group(function () {
Route::get('/', [AdministradorController::class, 'listarHoteles'])->name('admin.hoteles.index');
Route::get('/crear', [AdministradorController::class, 'crearHotelFormulario'])->name('admin.hotel.crear');
Route::post('/crear', [AdministradorController::class, 'crearHotel'])->name('admin.hotel.store');
Route::get('/{id}/editar', [AdministradorController::class, 'editarHotelFormulario'])->name('admin.hotel.editar');
Route::put('/{id}', [AdministradorController::class, 'actualizarHotel'])->name('admin.hotel.update');
Route::delete('/{id}', [AdministradorController::class, 'destroy'])->name('admin.hotel.destroy');
Route::get('/{id}/detalles', [AdministradorController::class, 'verDetallesHotel'])->name('admin.hotel.detalles');

//X REVISAR
Route::get('/reservaciones', [AdministradorController::class, 'listarReservaciones'])->name('admin.reservaciones.index');
Route::delete('/reservacion/{id}', [AdministradorController::class, 'eliminarReservacion'])->name('admin.reservacion.destroy');
});
});







// Rutas para gestionar reservaciones (para administradores)




// Ruta para generar reportes
Route::get('reportes', [AdministradorController::class, 'generarReporte'])->name('admin.reportes');

