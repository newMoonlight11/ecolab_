<?php

use App\Http\Controllers\ClaseResiduoController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReactivoController;
use App\Http\Controllers\FamiliaController;
use App\Http\Controllers\ItemMovimientoController;
use App\Http\Controllers\LaboratorioController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\MovimientoController;
use App\Http\Controllers\PrestamoController;
use App\Http\Controllers\UnidadController;
use App\Http\Controllers\ResiduoController;
use App\Http\Controllers\ResiduoLaboratorioController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StockReactivoController;
use App\Http\Controllers\TipoMovimientoController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['role:admin']], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});
Route::middleware(['auth', 'can:gestionar_usuarios'])->group(function () {
    Route::resource('/users', UserController::class);
});
Route::middleware(['auth', 'can:gestionar_movimientos'])->group(function () {
    Route::resource('movimientos', MovimientoController::class);
});
Route::middleware(['auth', 'can:gestionar_tipos_movimiento'])->group(function () {
    Route::resource('tipo_movimiento', TipoMovimientoController::class);
});
Route::middleware(['auth', 'can:gestionar_items_movimiento'])->group(function () {
    Route::resource('item_movimiento', ItemMovimientoController::class);
});
Route::middleware(['auth', 'can:gestionar_stock_reactivos'])->group(function () {
    Route::resource('stock_reactivos', StockReactivoController::class);
});
Route::middleware(['auth', 'can:gestionar_reactivos'])->group(function () {
    Route::resource('reactivos', ReactivoController::class);
});
Route::middleware(['auth', 'can:gestionar_familias'])->group(function () {
    Route::resource('familias', FamiliaController::class);
});
Route::middleware(['auth', 'can:gestionar_laboratorios'])->group(function () {
    Route::resource('laboratorios', LaboratorioController::class);
});
Route::middleware(['auth', 'can:gestionar_marcas'])->group(function () {
    Route::resource('marcas', MarcaController::class);
});
Route::middleware(['auth', 'can:gestionar_unidades'])->group(function () {
    Route::resource('unidads', UnidadController::class);
});

//crud de roles
Route::middleware(['auth', 'can:gestionar_roles'])->group(function () {
    Route::resource('roles', RoleController::class);
});
Route::middleware(['auth', 'can:gestionar_clases_residuo'])->group(function () {
    Route::resource('clase-residuos', ClaseResiduoController::class);
});
Route::middleware(['auth', 'can:gestionar_residuos'])->group(function () {
    // Route::resource('residuos', ResiduoController::class);
    Route::get('residuos', [ResiduoController::class, 'index'])->name('residuos.index');
    Route::get('residuos/create', [ResiduoController::class, 'create'])->name('residuos.create');
    Route::get('residuos/{id}/edit', [ResiduoController::class, 'edit'])->name('residuos.edit');
    Route::post('residuos/store', [ResiduoController::class, 'store'])->name('residuos.store');
    Route::get('residuos/{id}', [ResiduoController::class, 'destroy'])->name('residuos.destroy');

});
Route::middleware(['auth', 'can:gestionar_stock_residuos'])->group(function () {
    Route::resource('residuo-laboratorios', ResiduoLaboratorioController::class);
});
Route::middleware(['auth', 'can:registrar_prestamo'])->group(function () {
    Route::get('prestamos/create', [PrestamoController::class, 'create'])->name('prestamos.create');
    Route::post('prestamos/store', [PrestamoController::class, 'store'])->name('prestamos.store');
});
Route::middleware(['auth', 'can:ver_prestamo'])->group(function () {
    Route::get('prestamos', [PrestamoController::class, 'index'])->name('prestamos.index');
});
Route::middleware(['auth', 'can:editar_prestamo'])->group(function () {
    Route::get('prestamos/{id}/edit', [PrestamoController::class, 'edit'])->name('prestamos.edit');
    Route::put('prestamos/{id}', [PrestamoController::class, 'update'])->name('prestamos.update');
});
Route::middleware(['auth', 'can:eliminar_prestamo'])->group(function () {
    Route::delete('prestamos/{id}', [PrestamoController::class, 'destroy'])->name('prestamos.destroy');
});

Route::get('send-email', [EmailController::class, 'sendTestEmail'])->name('sendEmail');
Route::post('/movimientos/{movimiento}/asignar', [MovimientoController::class, 'asignar'])->name('movimientos.asignar');
Route::post('/movimientos/asignarTodos', [MovimientoController::class, 'asignarTodosSinAsignar'])->name('movimientos.asignarTodos');

