<?php

use App\Http\Controllers\ClaseResiduoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReactivoController;
use App\Http\Controllers\FamiliaController;
use App\Http\Controllers\ItemMovimientoController;
use App\Http\Controllers\LaboratorioController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\MovimientoController;
use App\Http\Controllers\UnidadController;
use App\Http\Controllers\PaginasController;
use App\Http\Controllers\ResiduoController;
use App\Http\Controllers\ResiduoLaboratorioController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StockReactivoController;
use App\Http\Controllers\TipoMovimientoController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['role:admin']], function () {
    Route::resource('/users', UserController::class);
    Route::resource('movimientos', MovimientoController::class);
    Route::resource('tipo_movimiento', TipoMovimientoController::class);
    Route::resource('item_movimiento', ItemMovimientoController::class);
    Route::resource('stock_reactivos', StockReactivoController::class);

    Route::resource('reactivos', ReactivoController::class);
    Route::resource('familias', FamiliaController::class);
    Route::resource('laboratorios', LaboratorioController::class);
    Route::resource('marcas', MarcaController::class);
    Route::resource('unidads', UnidadController::class);

    //crud de roles
    Route::resource('roles', RoleController::class);

    Route::resource('movimientos', MovimientoController::class);
    Route::resource('tipo_movimiento', TipoMovimientoController::class);
    Route::resource('item_movimiento', ItemMovimientoController::class);
    Route::resource('stock_reactivos', StockReactivoController::class);
    Route::resource('clase-residuos', ClaseResiduoController::class);
    Route::resource('residuos', ResiduoController::class);
    Route::resource('residuo-laboratorios', ResiduoLaboratorioController::class);
    Route::get('/prestamos', [PaginasController::class, 'prestamos']);
});

Route::group(['middleware' => ['role:general']], function () {
    Route::get('/reactivos', [ReactivoController::class, 'index'])->name('reactivos.index');
    Route::get('/prestamos', [PaginasController::class, 'prestamos']);
});