<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ReactivoController;
use App\Http\Controllers\FamiliaController;
use App\Http\Controllers\LaboratorioController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\UnidadController;
use App\Http\Controllers\PaginasController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/users', UserController::class);
Route::resource('reactivos', ReactivoController::class);
Route::resource('familias', FamiliaController::class);
Route::resource('laboratorios', LaboratorioController::class);
Route::resource('marcas', MarcaController::class);
Route::resource('unidads', UnidadController::class);

Route::get('/prestamos', [PaginasController::class, 'prestamos']);