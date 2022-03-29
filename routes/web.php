<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\ArchivosController;

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

/*
|--------------------------------------------------------------------------
| Ruta para eliminar Cache
|--------------------------------------------------------------------------
*/
Route::get('/limpiarCache', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    return "Cache Limpiado :D";
});

/*
|--------------------------------------------------------------------------
| Ruta de Inicio
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
   return redirect()->route('categoria.admin.vista');
});

/*
|--------------------------------------------------------------------------
| Ruta de Informacion de Laravel
|--------------------------------------------------------------------------
*/
Route::get('/infoLaravel', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Rutas de Categorias para Administrador
|--------------------------------------------------------------------------
|
|Aqui se encentran todas las rutas que son de Categorias
|
*/
Route::get('/categorias/admin', [CategoriasController::class, 'categoriasAdmin'])->name('categoria.admin.vista');
Route::post('/categorias/agregar', [CategoriasController::class, 'agregarCategoria'])->name('categoria.admin.agregar');
Route::get('/categorias/buscar/{id}', [CategoriasController::class, 'buscarCategoria'])->name('categoria.admin.buscar');
Route::post('/categorias/editar', [CategoriasController::class, 'editarCategoria'])->name('categoria.admin.editar');
Route::get('/categorias/eliminar/{id}', [CategoriasController::class, 'eliminarCategoria'])->name('categoria.admin.eliminar');

/*
|--------------------------------------------------------------------------
| Rutas de Productos para Administrador
|--------------------------------------------------------------------------
|
|Aqui se encentran todas las rutas que son de Productos
|
*/
Route::get('/productos/admin', [ProductosController::class, 'productosAdmin'])->name('producto.admin.vista');
Route::post('/productos/agregar', [ProductosController::class, 'agregarProducto'])->name('producto.admin.agregar');
Route::get('/productos/buscar/{id}', [ProductosController::class, 'buscarProducto'])->name('producto.admin.buscar');
Route::post('/productos/editar', [ProductosController::class, 'editarProducto'])->name('producto.admin.editar');
Route::get('/productos/eliminar/{id}', [ProductosController::class, 'eliminarProducto'])->name('producto.admin.eliminar');

/*
|--------------------------------------------------------------------------
| Rutas de Archivos (Correo, PDF, y Excel)
|--------------------------------------------------------------------------
|
|Aqui se encentran todas las rutas que son para generar un Correo, un PDF o un Excel
|
*/

Route::post('/enviarCorreo', [ArchivosController::class, 'enviarCorreo'])->name('archivos.correo');
Route::get('/verPDF/productos', [ArchivosController::class, 'verPDF'])->name('archivos.PDF.ver');
Route::get('/descargarPDF/productos', [ArchivosController::class, 'descargarPDF'])->name('archivos.PDF.descargar');
Route::get('/descargarExcel/productos', [ArchivosController::class, 'descargarExcel'])->name('archivos.excel.descargar');
