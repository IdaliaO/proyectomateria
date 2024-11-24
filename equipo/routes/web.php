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

//NECESITAN REVISAR BIEN 
// Rutas de búsqueda de vuelos y hoteles
Route::get('/resultados/vuelos', [VueloController::class, 'buscar'])->name('resultados.vuelos');
Route::get('/resultados/hoteles', [HotelController::class, 'buscar'])->name('hoteles.resultados');
// Rutas de vuelos y hoteles
Route::get('/buscar-vuelos', [VueloController::class, 'buscarVuelos'])->name('buscar.vuelos');
Route::get('/resultados-vuelos', [VueloController::class, 'resultadosVuelos'])->name('resultados.vuelos');
Route::get('/hoteles/buscar', [HotelController::class, 'buscarHoteles'])->name('hoteles.buscar');
Route::get('/hoteles/resultados', [HotelController::class, 'resultadosHoteles'])->name('hoteles.resultados');
Route::get('/hoteles/detalle/{id}', [HotelController::class, 'mostrarDetalle'])->name('hoteles.detalle');




// Rutas de administración funcionan con bd 
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
    // Gestión de hoteles
    Route::prefix('hoteles')->group(function () {
        Route::get('/', [AdministradorController::class, 'listarHoteles'])->name('admin.hoteles.index');
        Route::get('/crear', [AdministradorController::class, 'crearHotelFormulario'])->name('admin.hotel.crear');
        Route::post('/crear', [AdministradorController::class, 'crearHotel'])->name('admin.hotel.store');
        Route::get('/{id}/editar', [AdministradorController::class, 'editarHotelFormulario'])->name('admin.hotel.editar');
        Route::put('/{id}', [AdministradorController::class, 'actualizarHotel'])->name('admin.hotel.update');
        Route::delete('/{id}', [AdministradorController::class, 'eliminarHotel'])->name('admin.hotel.destroy');
        Route::get('/{id}/detalles', [AdministradorController::class, 'verDetallesHotel'])->name('admin.hotel.detalles');
    });
});







// Rutas para gestionar reservaciones
Route::get('reservaciones', [AdministradorController::class, 'listarReservaciones'])->name('admin.reservaciones.index');
Route::delete('reservacion/{id}', [AdministradorController::class, 'eliminarReservacion'])->name('admin.reservacion.destroy');

// Ruta para generar reportes
Route::get('reportes', [AdministradorController::class, 'generarReporte'])->name('admin.reportes');

// Rutas para reservaciones
Route::post('/reservar', [ReservacionController::class, 'agregarAlCarrito'])->name('reservar.agregar');
Route::get('/carrito', [ReservacionController::class, 'verCarrito'])->name('carrito');
Route::post('/confirmar', [ReservacionController::class, 'confirmarReservacion'])->name('reservar.confirmar');
