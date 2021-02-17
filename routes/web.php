<?php

use Illuminate\Support\Facades\Route;
use Carbon\Carbon;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\IngresoController;
use App\Http\Controllers\MedidasController;
use App\Http\Controllers\PagosController;
use App\Http\Controllers\ReportesController;

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

// TIENDA
Route::get('tienda', [PagesController::class, 'tienda'])->name('tienda');
Route::get('tienda/autocompletar', [PagesController::class, 'autocompletar_productos'])->name('tienda.autocompletar');

// Vender Devolver y Abastecer Productos
Route::POST('tienda/vender', [PagesController::class, 'vender_productos'])->name('tienda.vender.productos');
Route::POST('tienda/devolver', [PagesController::class, 'devolver_productos'])->name('tienda.devolver.productos');
Route::POST('tienda/abastecer', [PagesController::class, 'abastecer_productos'])->name('tienda.abastecer.productos');

// RUTAS CRUD CLIENTES
Route::get('inicio/clientes',[ClientesController::class, 'clientes_index'])->name('clientes.index');
Route::POST('inicio/clientes/',[ClientesController::class,'clientes_add'])->name('clientes.add');
Route::get('inicio/clientes/perfil/{id}',[ClientesController::class, 'clientes_perfil'])->name('clientes.perfil');
Route::PUT('inicio/clientes/perfil/{id}/',[ClientesController::class, 'clientes_update'])->name('clientes.update');
Route::POST('inicio/clientes/perfil/{id}/delete',[ClientesController::class, 'clientes_delete'])->name('clientes.delete');

// PAGOS
Route::POST('inicio/cliente/perfil/{id}/pagosAdd',[PagosController::class,'pagos_add'])->name('pagos.add');
Route::POST('inicio/cliente/perfil/{id}/pagosDelete/',[PagosController::class,'pagos_delete'])->name('pagos.delete');

// MEDIDAS
Route::get('inicio/clientes/perfil/nueva-medidas/{id}',[MedidasController::class, 'clientes_medidas_nueva'])->name('clientes.medidas.registrar');
Route::POST('inicio/clientes/perfil/nueva-medidas/{id}/',[MedidasController::class, 'clientes_medidas_new'])->name('clientes.medidas.new');
Route::get('inicio/clientes/perfil/medidas/{id}',[MedidasController::class, 'clientes_medidas_ver'])->name('clientes.medidas');
Route::POST('inicio/clientes/perfil/medidas/{id}/delete',[MedidasController::class, 'clientes_medidas_delete'])->name('clientes.medidas.delete');

// RUTAS CRUD PRODUCTOS
Route::get('inicio/productos',[ProductosController::class, 'productos_index'])->name('productos.index');
Route::POST('inicio/productos/',[ProductosController::class, 'productos_new'])->name('productos.new');
Route::get('inicio/productos/detalles/{id}',[ProductosController::class, 'productos_detalles'])->name('productos.detalles');
Route::POST('inicio/productos/detalles/{id}/update',[ProductosController::class, 'productos_detalles_update'])->name('productos.detalles.update');

// REPORTES
Route::get('inicio/reportes/diario',[ReportesController::class ,'reportes_diario'])->name('reportes.diario');
Route::POST('inicio/reportes/diario/{id}/delete',[ReportesController::class ,'reportes_diario_delete'])->name('reportes.diario.delete');
Route::POST('inicio/reportes/diario/',[ReportesController::class ,'reportes_diario_post'])->name('reportes.diario.post');
Route::get('inicio/reportes/mensual',[ReportesController::class ,'reportes_mensual'])->name('reportes.mensual');
Route::POST('inicio/reportes/mensual',[ReportesController::class ,'reportes_mensual_post'])->name('reportes.mensual.post');

// ACCESO CLIENTES
    # Ingresos
    Route::get('heracles/ingreso',[IngresoController::class,'ingreso'])->name('heracles.ingreso');
    Route::POST('heracles/ingreso/',[IngresoController::class,'ingreso_post'])->name('heracles.ingreso.post');
    Route::PUT('heracles/ingreso/cambiar-tipo/',[IngresoController::class,'cambiar_tipo'])->name('heracles.cambiar.tipo');

// ACCESO CLIENTES
    # Consulta
    Route::get('heracles/consulta',[IngresoController::class,'consulta'])->name('heracles.consulta');
    Route::POST('heracles/consulta/',[IngresoController::class,'consulta_post'])->name('heracles.consulta.post');

// PDF
Route::get('descargarPDF/clientes',[GenerarPDF::class,'generar_pdf_clientes'])->name('descargar.pdf.clientes');
Route::get('descargarPDF/reporte-diario/{fecha}',[GenerarPDF::class,'pdf_reporte_diario'])->name('descargar.pdf.reporte-diario');
Route::get('descargarPDF/reporte-mensual/{fecha}',[GenerarPDF::class,'pdf_reporte_mensual'])->name('descargar.pdf.reporte-mensual');