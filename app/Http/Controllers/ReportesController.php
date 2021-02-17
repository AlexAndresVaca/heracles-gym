<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Ingreso;
use App\Models\Venta;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportesController extends Controller
{
    //
    public function reportes_diario(Request $request)
    {
        $usuario = $request->session()->get('usuario_activo');
        if ($usuario == NULL) {
            return redirect(route('login'));
        } else {
            $hoy = now();
            $listaIngresos = Ingreso::select('*', 'ingresos.created_at as hora_ingreso')
                ->join('clientes', 'clientes.ci_cli', '=', 'ingresos.fk_ci_cli_ing')
                ->whereDate('ingresos.created_at', $hoy)
                ->get();
            $listaVentas = Venta::select('productos.detalle_prod', 'ventas.descripcion_ven', Venta::raw('SUM(cantidad_ven) as suma_total'))
                ->join('productos', 'productos.cod_prod', '=', 'ventas.fk_cod_prod_ven')
                ->whereDate('ventas.created_at', $hoy)
                // ->where('ventas.descripcion_ven','Venta')
                ->groupBy('ventas.fk_cod_prod_ven', 'productos.detalle_prod', 'ventas.descripcion_ven')
                ->get();
            // Le decimos a la aplicacion que la fecha es de hoy 
            $fecha = $hoy;
            return view('app.reportes.reportes_diario', compact('usuario', 'fecha', 'listaIngresos', 'listaVentas'));
        }
    }
    public function reportes_diario_post(Request $request)
    {
        $usuario = $request->session()->get('usuario_activo');
        if ($usuario == NULL) {
            return redirect(route('login'));
        } else {
            // return $request->fecha;
            $hoy = now();

            $request->validate([
                'fecha' => 'required|date|before_or_equal:' . $hoy,
            ], [
                'fecha.required' => 'Debe ingresar una fecha',
                'fecha.date' => 'El valor ingresado no es una fecha',
                'fecha.before_or_equal' => 'No hay registros del:',
            ]);
            $fecha = Carbon::create($request->fecha);
            $listaIngresos = Ingreso::select('*', 'ingresos.created_at as hora_ingreso')
                ->join('clientes', 'clientes.ci_cli', '=', 'ingresos.fk_ci_cli_ing')
                ->whereDate('ingresos.created_at', $fecha)
                ->get();
            $listaVentas = Venta::select('productos.detalle_prod', 'ventas.descripcion_ven', Venta::raw('SUM(cantidad_ven) as suma_total'))
                ->join('productos', 'productos.cod_prod', '=', 'ventas.fk_cod_prod_ven')
                ->whereDate('ventas.created_at', $fecha)
                // ->where('ventas.descripcion_ven','Venta')
                ->groupBy('ventas.fk_cod_prod_ven', 'productos.detalle_prod', 'ventas.descripcion_ven')
                ->get();
            // 
            return view('app.reportes.reportes_diario', compact('usuario', 'fecha', 'listaIngresos', 'listaVentas'));
        }
    }
    public function reportes_diario_delete($id)
    {
        $ingresoEliminar = Ingreso::findOrFail($id);
        $ingresoEliminar->delete();
        return back()->with(['eliminarIngreso' => TRUE]);
    }
    public function reportes_mensual(Request $request)
    {
        $usuario = $request->session()->get('usuario_activo');
        if ($usuario == NULL) {
            return redirect(route('login'));
        } else {
            $fecha = now();
            $mesActual = now()->isoFormat('M');
            $anioActual = now()->isoFormat('Y');
            $listaIngresos = Ingreso::select('*', 'ingresos.created_at as dia_ingreso')
                ->join('clientes', 'clientes.ci_cli', '=', 'ingresos.fk_ci_cli_ing')
                ->whereMonth('ingresos.created_at', $mesActual)
                ->whereYear('ingresos.created_at', $anioActual)
                ->get();
            // return $listaIngresos;
            $listaVentas = Venta::select('productos.detalle_prod', 'ventas.descripcion_ven', Venta::raw('SUM(cantidad_ven) as suma_total'))
                ->join('productos', 'productos.cod_prod', '=', 'ventas.fk_cod_prod_ven')
                ->whereMonth('ventas.created_at', $mesActual)
                ->whereYear('ventas.created_at', $anioActual)
                // ->where('ventas.descripcion_ven','Venta')
                ->groupBy('ventas.fk_cod_prod_ven', 'productos.detalle_prod', 'ventas.descripcion_ven')
                ->get();
            // return $listaVentas;
            return view('app.reportes.reportes_mensual', compact('usuario', 'fecha', 'listaIngresos', 'listaVentas'));
        }
    }
    public function reportes_mensual_post(Request $request)
    {
        $usuario = $request->session()->get('usuario_activo');
        if ($usuario == NULL) {
            return redirect(route('login'));
        } else {
            $fecha = Carbon::create($request->fecha);
            $mes = now()->isoFormat('Y-MM');
            $request->validate([
                'fecha' => 'required|date|before_or_equal:' . $mes,
            ], [
                'fecha.required' => 'Debe ingresar una fecha',
                'fecha.date' => 'El valor ingresado no es una fecha',
                'fecha.before_or_equal' => 'No hay registros de:',
            ]);
            $mesActual = $fecha->isoFormat('M');
            $anioActual = $fecha->isoFormat('Y');
            $listaIngresos = Ingreso::select('*')
                ->join('clientes', 'clientes.ci_cli', '=', 'ingresos.fk_ci_cli_ing')
                ->whereMonth('ingresos.created_at', $mesActual)
                ->whereYear('ingresos.created_at', $anioActual)
                ->get();
            // return $listaIngresos;
            $listaVentas = Venta::select('productos.detalle_prod', 'ventas.descripcion_ven', Venta::raw('SUM(cantidad_ven) as suma_total'))
                ->join('productos', 'productos.cod_prod', '=', 'ventas.fk_cod_prod_ven')
                ->whereMonth('ventas.created_at', $mesActual)
                ->whereYear('ventas.created_at', $anioActual)
                // ->where('ventas.descripcion_ven','Venta')
                ->groupBy('ventas.fk_cod_prod_ven', 'productos.detalle_prod', 'ventas.descripcion_ven')
                ->get();
            // return $listaVentas;
            return view('app.reportes.reportes_mensual', compact('usuario', 'fecha', 'listaIngresos', 'listaVentas'));
        }
    }
}
