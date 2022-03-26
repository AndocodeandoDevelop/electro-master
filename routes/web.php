<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\ProductosController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('layouts.principal');
});

Route::get('/infoLaravel', function () {
    return view('welcome');
});

Route::get('/categorias', [CategoriasController::class, 'categoriasVista'])->name('categoria.vista');

Route::get('/productos', [ProductosController::class, 'productosVista'])->name('producto.vista');


