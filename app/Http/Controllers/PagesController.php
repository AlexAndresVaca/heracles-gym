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
}
