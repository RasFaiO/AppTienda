<?php

use App\Http\Controllers\ArticuloController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IngresoController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\VentaController;
use App\Models\Categoria;
use Illuminate\Support\Facades\Route;
use Laravel\Jetstream\Rules\Role;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Rutas sin autenticar
Route::get('/', [DashboardController::class, 'index']);

// Rutas Autenticadas
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    // Categoria
    Route::get('/categoria', [CategoriaController::class, 'index'])->name('tienda.categoria.index');
    Route::get('/categoria/nuevo',[CategoriaController::class, 'create'])->name('categoria.crear');
    Route::post('/categoria',[CategoriaController::class,'store'])->name('categoria.store');
    Route::get('/categoria/{categoria}/edit',[CategoriaController::class,'edit'])->name('categoria.edit');
    Route::put('/categoria/{categoria}',[CategoriaController::class,'update'])->name('categoria.update');
    Route::delete('/categoria/{categoria}',[CategoriaController::class, 'destroy'])->name('categoria.destroy');

    // Tienda
    Route::get('/articulo', [ArticuloController::class, 'index'])->name('tienda.articulo.index');
    Route::get('/articulo/nuevo',[ArticuloController::class, 'create'])->name('articulo.crear');
    Route::post('/articulo',[ArticuloController::class,'store'])->name('articulo.store');
    Route::get('/articulo/{articulo}/edit',[ArticuloController::class,'edit'])->name('articulo.edit');
    Route::put('/articulo/{articulo}',[ArticuloController::class,'update'])->name('articulo.update');
    Route::delete('/articulo/{articulo}',[ArticuloController::class, 'destroy'])->name('articulo.destroy');

    // Cliente
    Route::get('/cliente', [ClienteController::class, 'index'])->name('persona.cliente');
    Route::get('/cliente/nuevo',[ClienteController::class, 'create'])->name('cliente.create');
    Route::post('/cliente',[ClienteController::class,'store'])->name('cliente.store');
    Route::get('/cliente/{cliente}/edit',[ClienteController::class,'edit'])->name('cliente.edit');
    Route::put('/cliente/{cliente}',[ClienteController::class,'update'])->name('cliente.update');
    Route::delete('/cliente/{cliente}',[ClienteController::class, 'destroy'])->name('cliente.destroy');

    Route::get('/categoria/{categoria}/edit', [CategoriaController::class, 'edit'])->name('categoria.edit');
    Route::get('/ingreso', [IngresoController::class, 'index'])->name('tienda.ingreso');
    Route::get('/persona', [PersonaController::class, 'index'])->name('tienda.persona');
    Route::get('/venta', [VentaController::class, 'index'])->name('tienda.venta');
});
