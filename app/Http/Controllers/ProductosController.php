<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductosController extends Controller
{
    //
    public function productos_index(Request $request)
    {
        $usuario = $request->session()->get('usuario_activo');
        if ($usuario == NULL) {
            return redirect(route('login'));
        } else {
            $listaProductos = Producto::get();
            return view('app.productos.index', compact('usuario', 'listaProductos'));
        }
    }
    public function productos_new(Request $request)
    {
        $request->validate([
            'detalle_prod' => 'required|unique:productos,detalle_prod',
            'stock_prod' => 'numeric|integer|between:0,5000',
        ], [
            'detalle_prod.required' => 'Campo obligatorio',
            'detalle_prod.unique' => 'Ya existe un producto con la misma descripción',
            'stock_prod.numeric' => 'Este campo admite solo números',
            'stock_prod.integer' => 'Este campo admite solo números enteros',
            'stock_prod.between' => 'Cantidad minima 0 y máxima 5000'
        ]);
        $nuevoProducto = new Producto;
        $nuevoProducto->detalle_prod = $request->detalle_prod;
        if (is_null($request->stock_prod)) {
            $request->stock_prod = 0;
        }
        $nuevoProducto->stock_prod = $request->stock_prod;
        $nuevoProducto->save();
        return back()->with([
            'producto_creado' => TRUE,
        ]);
    }
    public function productos_detalles(Request $request, $id)
    {
        $usuario = $request->session()->get('usuario_activo');
        if ($usuario == NULL) {
            return redirect(route('login'));
        } else {
            $producto = Producto::findOrFail($id);
            return view('app.productos.detalles', compact('usuario', 'producto'));
        }
    }
    public function productos_detalles_update(Request $request, $id)
    {
        $productoUpdate = Producto::findOrFail($id);
        $request->validate([
            'detalle_prod' => 'required|unique:productos,detalle_prod,' . $productoUpdate->cod_prod . ',cod_prod',
            'stock_prod' => 'numeric|integer|between:0,5000',
        ], [
            'detalle_prod.required' => 'Campo obligatorio',
            'detalle_prod.unique' => 'Ya existe un producto con la misma descripción',
            'stock_prod.numeric' => 'Este campo admite solo números',
            'stock_prod.integer' => 'Este campo admite solo números enteros',
            'stock_prod.between' => 'Cantidad minima 0 y máxima 5000'
        ]);
        $productoUpdate->detalle_prod = $request->detalle_prod;
        $productoUpdate->stock_prod = $request->stock_prod;
        $productoUpdate->save();
        return back()->with([
            'mensaje_exito' => TRUE,
        ]);
    }
}
