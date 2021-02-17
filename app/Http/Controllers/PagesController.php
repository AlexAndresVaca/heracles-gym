<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\Models\Producto;
use App\Models\Venta;
use App\Models\Ingreso;

class PagesController extends Controller
{
    //
    public function index()
    {
        return redirect(route('inicio'));
        // return view('welcome');
    }
    public function login(Request $request)
    {
        $usuario = $request->session()->get('usuario_activo');
        if ($usuario == NULL) {
            return view('public.login');
        } else {
            return redirect(route('inicio'));
        }
    }
    public function iniciarSesion(Request $request)
    {
        $request->validate([
            'nick' => 'required|exists:App\Models\Usuario,nick_usu',
        ], [
            'nick.required' => 'Este campo es obligatorio',
            'nick.exists' => 'Este nombre de usuario no existe',
        ]);
        $usuario = NULL;
        $ingreso = NULL;
        $login = App\Models\Usuario::where('nick_usu', '=', $request->nick)
            ->where('password_usu', '=', $request->pass)
            ->first();
        // 
        if ($login == '') {
            $ingreso = 'Datos erroneos';
            return back()->with([
                'ingreso' => $ingreso,
                'nick' => $request->nick
            ]);
        } else if ($login != '') {
            if ($login->nick_usu === $request->nick and $login->password_usu === $request->pass) {
                $request->session()->put(['usuario_activo' => $login->nick_usu]);
                $usuario = $request->session()->get('usuario_activo');
                return redirect(route('inicio'));
            } else {
                $ingreso = 'Revisa tus datos y vuelve a intentar';
                return back()->with([
                    'ingreso' => $ingreso,
                    'nick' => $request->nick
                ]);
            }
        }
    }
    public function cerrarSesion(Request $request)
    {
        $usuario = $request->session()->flush();
        // return "HOLA";
        return redirect(route('login'));
    }
    public function inicio(Request $request)
    {
        $usuario = $request->session()->get('usuario_activo');
        if ($usuario == NULL) {
            return redirect(route('login'));
        } else {
            // Inicializar variables ESTE DIA
            $numMensuales = 0;
            $numDiarios = 0;
            $numExpirados = 0;
            $numEspeciales = 0;
            // Fecha de hoy
            $hoy = now();
            // Consulta de los clientes
            $clientesMensuales = Ingreso::where('estado_ing','=','Mensual')->whereDate('created_at',$hoy)->get();
            $clientesDiarios = Ingreso::where('estado_ing','=','Diario')->whereDate('created_at',$hoy)->get();
            $clientesExpirados = Ingreso::where('anotacion_ing','Ingresó con pago expirado')->whereDate('created_at',$hoy)->get();
            $clientesEspeciales = Ingreso::where('anotacion_ing','Pago especial: 1$')->whereDate('created_at',$hoy)->get();
            // Conteo
            $numMensuales = count($clientesMensuales);
            $numDiarios = count($clientesDiarios);
            $numExpirados = count($clientesExpirados);
            $numEspeciales = count($clientesEspeciales);
            // Inicializar variables ESTE MES
            $numMensualesMes = 0;
            $numDiariosMes = 0;
            $numExpiradosMes = 0;
            $numEspecialesMes = 0;
            // Fecha de este mes
            $anioActual = now()->isoFormat('Y');
            $mesActual = now()->isoFormat('MM');
            // Consulta de los clientes de este MES
            $clientesMensualesMes = Ingreso::where('estado_ing','=','Mensual')->whereMonth('created_at',$mesActual)->whereYear('created_at',$anioActual)->get();
            $clientesDiariosMes = Ingreso::where('estado_ing','=','Diario')->whereMonth('created_at',$mesActual)->whereYear('created_at',$anioActual)->get();
            $clientesExpiradosMes = Ingreso::where('anotacion_ing','Ingresó con pago expirado')->whereMonth('created_at',$mesActual)->whereYear('created_at',$anioActual)->get();
            $clientesEspecialesMes = Ingreso::where('anotacion_ing','Pago especial: 1$')->whereMonth('created_at',$mesActual)->whereYear('created_at',$anioActual)->get();
            // Conteo Mensual
            $numMensualesMes = count($clientesMensualesMes);
            $numDiariosMes = count($clientesDiariosMes);
            $numExpiradosMes = count($clientesExpiradosMes);
            $numEspecialesMes = count($clientesEspecialesMes);
            // STOCK PRODUCTOS
            $productos = Producto::get();
            // Retorno
            // return 'Mensuales: '.$numMensuales.' Diarios: '.$numDiarios.' Expirados: '.$numExpirados;
            return view('app.inicio', compact('usuario','numMensuales','numDiarios','numExpirados','numEspeciales','numMensualesMes','numDiariosMes','numExpiradosMes','numEspecialesMes','productos'));
        }
    }

    public function tienda(Request $request)
    {
        $usuario = $request->session()->get('usuario_activo');
        if ($usuario == NULL) {
            return redirect(route('login'));
        } else {
            return view('app.tienda', compact('usuario'));
        }
    }
    public function autocompletar_productos(Request $request)
    {
        $term = $request->get('term');
        $querys = Producto::where('detalle_prod', 'LIKE', '%' . $term . '%')->get();
        // 
        $response = array();
        foreach ($querys as $productos) {
            $response[] = array("label" => $productos->detalle_prod, "value" => $productos->cod_prod);
        }
        return response()->json($response);
    }
    public function vender_productos(Request $request)
    {
        $request->validate([
            'detalle_prod_venta' => 'required|exists:productos,detalle_prod',
            'cantidad_prod_venta' => 'required|integer|between:0,999',
        ], [
            'detalle_prod_venta.required' => 'Campo obligatorio',
            'detalle_prod_venta.exists' => 'Producto no encontrado',
            'cantidad_prod_venta.required' => 'Campo obligatorio',
            'cantidad_prod_venta.integer' => 'Solo se acepta números enteros',
            'cantidad_prod_venta.between' => 'Puedes registrar cantidades entre 0 y 999',
        ]);
        // Crear la nueva venta
        $newVenta = new Venta;
        $newVenta->descripcion_ven = "Venta";
        $newVenta->cantidad_ven = $request->cantidad_prod_venta;
        $newVenta->fk_cod_prod_ven = $request->cod_prod_venta;
        // Actualizar stock
        #Encontrar producto
        $actualizarStock = Producto::findOrFail($request->cod_prod_venta);
        #Disminuir stock
        $actualizarStock->stock_prod = $actualizarStock->stock_prod - $request->cantidad_prod_venta;
        if ($actualizarStock->stock_prod > 0) {
            $actualizarStock->save();
            $newVenta->save();
            return back()->with([
                'venta_exito' => TRUE,
            ]);
        }
        else{
            return back()->with([
                'error_stock' => TRUE,
            ]);
        }
    }
    public function devolver_productos(Request $request)
    {
        $request->validate([
            'detalle_prod_devolucion' => 'required|exists:productos,detalle_prod',
            'cantidad_prod_devolucion' => 'required|integer|between:0,999',
        ], [
            'detalle_prod_devolucion.required' => 'Campo obligatorio',
            'detalle_prod_devolucion.exists' => 'Producto no encontrado',
            'cantidad_prod_devolucion.required' => 'Campo obligatorio',
            'cantidad_prod_devolucion.integer' => 'Solo se acepta números enteros',
            'cantidad_prod_devolucion.between' => 'Puedes registrar cantidades entre 0 y 999',
        ]);
        // Crear la nueva venta
        $newDevolucion = new Venta;
        $newDevolucion->descripcion_ven = "Devolucion";
        $newDevolucion->cantidad_ven = $request->cantidad_prod_devolucion;
        $newDevolucion->fk_cod_prod_ven = $request->cod_prod_devolucion;
        // Actualizar stock
        #Encontrar producto
        $actualizarStock = Producto::findOrFail($request->cod_prod_devolucion);
        #Disminuir stock
        $actualizarStock->stock_prod = $actualizarStock->stock_prod + $request->cantidad_prod_devolucion;
        $actualizarStock->save();
        $newDevolucion->save();
        return back()->with([
            'devolucion_exito' => TRUE,
        ]);
    }
    public function abastecer_productos(Request $request)
    {
        $request->validate([
            'detalle_prod_abastecer' => 'required|exists:productos,detalle_prod',
            'cantidad_prod_abastecer' => 'required|integer|between:0,999',
        ], [
            'detalle_prod_abastecer.required' => 'Campo obligatorio',
            'detalle_prod_abastecer.exists' => 'Producto no encontrado',
            'cantidad_prod_abastecer.required' => 'Campo obligatorio',
            'cantidad_prod_abastecer.integer' => 'Solo se acepta números enteros',
            'cantidad_prod_abastecer.between' => 'Puedes registrar cantidades entre 0 y 999',
        ]);
        // Crear la nueva venta
        $newAbastecer = new Venta;
        $newAbastecer->descripcion_ven = "Abastecimiento";
        $newAbastecer->cantidad_ven = $request->cantidad_prod_abastecer;
        $newAbastecer->fk_cod_prod_ven = $request->cod_prod_abastecer;
        // Actualizar stock
        #Encontrar producto
        $actualizarStock = Producto::findOrFail($request->cod_prod_abastecer);
        #Disminuir stock
        $actualizarStock->stock_prod = $actualizarStock->stock_prod + $request->cantidad_prod_abastecer;
        $actualizarStock->save();
        $newAbastecer->save();
        return back()->with([
            'abastecer_exito' => TRUE,
        ]);
    }
}
