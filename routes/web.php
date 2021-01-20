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
// Login

Route::get('/', [PagesController::class, 'index'])->name('index');
Route::get('/login', [PagesController::class, 'login'])->name('login');
Route::POST('/login/', [PagesController::class, 'iniciarSesion'])->name('iniciarSesion');
Route::POST('/close', [PagesController::class, 'cerrarSesion'])->name('cerrarSesion');
Route::get('inicio', [PagesController::class, 'inicio'])->name('inicio');
// RUTAS CRUD CLIENTES
Route::get('inicio/clientes',[ClientesController::class, 'clientes_index'])->name('clientes.index');
Route::POST('inicio/clientes/',[ClientesController::class,'clientes_add'])->name('clientes.add');
Route::get('inicio/clientes/perfil/{id}',[ClientesController::class, 'clientes_perfil'])->name('clientes.perfil');
Route::PUT('inicio/clientes/perfil/{id}/',[ClientesController::class, 'clientes_update'])->name('clientes.update');
Route::POST('inicio/clientes/perfil/{id}/delete',[ClientesController::class, 'clientes_delete'])->name('clientes.delete');
// ACCESO CLIENTES
    # Ingresos
    Route::get('heracles/ingreso',[IngresoController::class,'ingreso'])->name('heracles.ingreso');
    Route::POST('heracles/ingreso/',[IngresoController::class,'ingreso_post'])->name('heracles.ingreso.post');
    Route::PUT('heracles/ingreso/cambiar-tipo/',[IngresoController::class,'cambiar_tipo'])->name('heracles.cambiar.tipo');
// MEDIDAS
Route::get('inicio/clientes/perfil/nueva-medidas/{id}',[MedidasController::class, 'clientes_medidas_nueva'])->name('clientes.medidas.registrar');
Route::POST('inicio/clientes/perfil/nueva-medidas/{id}/',[MedidasController::class, 'clientes_medidas_new'])->name('clientes.medidas.new');
Route::get('inicio/clientes/perfil/medidas/{id}',[MedidasController::class, 'clientes_medidas_ver'])->name('clientes.medidas');
Route::POST('inicio/clientes/perfil/medidas/{id}/delete',[MedidasController::class, 'clientes_medidas_delete'])->name('clientes.medidas.delete');
// ACCESO CLIENTES
    # Consulta
    Route::get('heracles/consulta',[IngresoController::class,'consulta'])->name('heracles.consulta');
    Route::POST('heracles/consulta/',[IngresoController::class,'consulta_post'])->name('heracles.consulta.post');
// REPORTES
Route::POST('inicio/reportes/diario/{id}/delete',[ReportesController::class ,'reportes_diario_delete'])->name('reportes.diario.delete');