<?php

use Illuminate\Support\Facades\Route;
use Carbon\Carbon;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ClientesController;

/*
|--------------------------------------------------------------------------
| Web 
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PagesController::class, 'index'])->name('index');
// RUTAS CRUD CLIENTES
Route::get('inicio/clientes',[ClientesController::class, 'clientes_index'])->name('clientes.index');
Route::POST('inicio/clientes/',[ClientesController::class,'clientes_add'])->name('clientes.add');
Route::get('inicio/clientes/perfil/{id}',[ClientesController::class, 'clientes_perfil'])->name('clientes.perfil');
Route::PUT('inicio/clientes/perfil/{id}/',[ClientesController::class, 'clientes_update'])->name('clientes.update');
Route::POST('inicio/clientes/perfil/{id}/delete',[ClientesController::class, 'clientes_delete'])->name('clientes.delete');