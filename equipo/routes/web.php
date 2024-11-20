<?php
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\VueloController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\ReservacionController;
use App\Http\Controllers\AdministradorController;
use Illuminate\Support\Facades\Route;

Route::get('/', [UsuarioController::class, 'inicio'])->name('inicio');

// Rutas de registro y login de usuarios(funcionan completamente con db)
Route::get('/registro', [UsuarioController::class, 'mostrarRegistro'])->name('registro.mostrar');
Route::post('/registro/enviar', [UsuarioController::class, 'registrar'])->name('registro.enviar');
Route::get('/login', [UsuarioController::class, 'mostrarLogin'])->name('login.mostrar');
Route::post('/login', [UsuarioController::class, 'autenticar'])->name('login.enviar');
Route::post('/logout', [UsuarioController::class, 'logout'])->name('logout');

//aun no se comprueba funcionamiento no conectado con db
// Rutas de búsqueda de vuelos y hoteles
Route::get('/resultados/vuelos', [VueloController::class, 'buscar'])->name('resultados.vuelos');
Route::get('/resultados/hoteles', [HotelController::class, 'buscar'])->name('hoteles.resultados');
// Rutas de vuelos y hoteles
Route::get('/buscar-vuelos', [VueloController::class, 'buscarVuelos'])->name('buscar.vuelos');
Route::get('/resultados-vuelos', [VueloController::class, 'resultadosVuelos'])->name('resultados.vuelos');
Route::get('/hoteles/buscar', [HotelController::class, 'mostrarFormularioBusqueda'])->name('hoteles.buscar');
Route::get('/hoteles/resultados', [HotelController::class, 'buscar'])->name('hoteles.resultados');
Route::get('/hoteles/detalle/{id}', [HotelController::class, 'mostrarDetalle'])->name('hoteles.detalle');




// Rutas de administración (funcionan completamente con bd)
Route::prefix('admin')->group(function () {
Route::get('/', [AdministradorController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/registro', [AdministradorController::class, 'mostrarRegistro'])->name('admin.registro');
Route::post('/admin/registro/enviar', [AdministradorController::class, 'registrar'])->name('admin.registro.enviar');
Route::get('/login', [AdministradorController::class, 'mostrarLogin'])->name('admin.login');
Route::post('/login', [AdministradorController::class, 'autenticar'])->name('admin.autenticar');
Route::post('/logout', [AdministradorController::class, 'logout'])->name('admin.logout');
Route::get('usuarios', [AdministradorController::class, 'listarUsuarios'])->name('admin.usuarios.index');
Route::get('usuario/crear', [AdministradorController::class, 'crearUsuarioFormulario'])->name('admin.usuario.crear');
Route::post('usuario/crear', [AdministradorController::class, 'crearUsuario'])->name('admin.usuario.store');
Route::delete('usuario/{id}', [AdministradorController::class, 'eliminarUsuario'])->name('admin.usuario.destroy');

// vuelos(funcionan completamente con bd)
Route::prefix('admin/vuelos')->middleware('web')->group(function () {
Route::get('/', [AdministradorController::class, 'listarVuelos'])->name('admin.vuelos.index');
Route::get('/crear', [AdministradorController::class, 'crearVueloFormulario'])->name('admin.vuelos.crear');
Route::post('/', [AdministradorController::class, 'crearVuelo'])->name('admin.vuelos.store');
Route::delete('/{id}', [AdministradorController::class, 'eliminarVuelo'])->name('admin.vuelos.destroy');
Route::get('/{id}/editar', [AdministradorController::class, 'editarVueloFormulario'])->name('admin.vuelos.edit');
Route::put('/{id}', [AdministradorController::class, 'actualizarVuelo'])->name('admin.vuelos.update');
});

//hoteles (funcion)
Route::get('admin/hoteles', [AdministradorController::class, 'listarHoteles'])->name('admin.hoteles.index');
Route::get('hoteles', [AdministradorController::class, 'listarHoteles'])->name('admin.hoteles.index');
Route::get('hotel/crear', [AdministradorController::class, 'crearHotelFormulario'])->name('admin.hotel.crear');
Route::post('hotel/crear', [AdministradorController::class, 'crearHotel'])->name('admin.hotel.store');
Route::delete('hotel/{id}', [AdministradorController::class, 'eliminarHotel'])->name('admin.hotel.destroy');
Route::get('hotel/{id}/editar', [AdministradorController::class, 'editarHotelFormulario'])->name('admin.hotel.editar');
Route::put('hotel/{id}', [AdministradorController::class, 'actualizarHotel'])->name('admin.hotel.update');
Route::get('admin/hotel/{id}/editar', [AdministradorController::class, 'editarHotelFormulario'])->name('admin.hotel.editar');
Route::get('hotel/{id}/detalles', [AdministradorController::class, 'verDetallesHotel'])->name('admin.hotel.detalles');
Route::get('hotel/crear', [AdministradorController::class, 'crearHotelFormulario'])->name('admin.hotel.crear');








// Rutas para gestionar reservaciones
Route::get('reservaciones', [AdministradorController::class, 'listarReservaciones'])->name('admin.reservaciones.index');
Route::delete('reservacion/{id}', [AdministradorController::class, 'eliminarReservacion'])->name('admin.reservacion.destroy');

// Ruta para generar reportes
Route::get('reportes', [AdministradorController::class, 'generarReporte'])->name('admin.reportes');
});

// Rutas para reservaciones
Route::post('/reservar', [ReservacionController::class, 'agregarAlCarrito'])->name('reservar.agregar');
Route::get('/carrito', [ReservacionController::class, 'verCarrito'])->name('carrito');
Route::post('/confirmar', [ReservacionController::class, 'confirmarReservacion'])->name('reservar.confirmar');
