<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ReactivoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/users', UserController::class);
Route::resource('reactivos', ReactivoController::class);
