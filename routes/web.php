<?php

use App\Http\Controllers\ArticuloController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IngresoController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\VentaController;
use Illuminate\Support\Facades\Route;
use Laravel\Jetstream\Rules\Role;

// Rutas sin autenticar
Route::get('/', [DashboardController::class, 'index']);

// Rutas Autenticadas
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    // Route::get('/categoria/nuevo',[CategoriaController::class, 'create'])->name('categoria.crear');
    // Route::post('/categoria',[CategoriaController::class,'store'])->name('categoria.store');
    // Route::get('/categoria/{categoria}/edit',[CategoriaController::class,'edit'])->name('categoria.edit');
    // Route::put('/categoria/{categoria}',[CategoriaController::class,'update'])->name('categoria.update');
    // Route::delete('/categoria/{categoria}',[CategoriaController::class, 'destroy'])->name('categoria.destroy');

    // Categoria
    Route::resource('/categoria', CategoriaController::class);
    // Tienda
    Route::resource('/articulo', ArticuloController::class);
    // Cliente
    Route::resource('/cliente', ClienteController::class);
    // Provedores
    Route::resource('/proveedor', ProveedorController::class);
    // Ingreso
    Route::resource('/ingreso', IngresoController::class);
    // Venta
    Route::resource('/venta', VentaController::class);
    //
    Route::resource('/usuario', UsuarioController::class);
});
