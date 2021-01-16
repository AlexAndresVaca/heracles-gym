<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Ingreso;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IngresoController extends Controller
{
    //
    public function ingreso()
    {
        return view('public.ingreso.ingreso');
    }
    public function consulta()
    {
        return view('public.ingreso.consulta');
    }
    public function ingreso_post(Request $request)
    {
        // Comprobar que campo esta lleno
        if ($request->info_cliente_ci != null) {
            $request->validate([
                'info_cliente_ci' => 'digits:10|exists:clientes,ci_cli',
            ], [
                'info_cliente_ci.digits' => 'Número de cédula no valido',
                'info_cliente_ci.exists' => 'Número de cédula no encontrado',
            ]);
            // Recuperar informacion del cliente
            $cliente = Cliente::where('clientes.ci_cli', '=', $request->info_cliente_ci)
                ->first();
        } elseif ($request->info_cliente_nombre != null and $request->info_cliente_apellido != null) {
            $request->validate([
                'info_cliente_nombre' => 'exists:clientes,nombre_cli',
                'info_cliente_apellido' => 'exists:clientes,apellido_cli',
            ], [
                'info_cliente_nombre.exists' => 'Este cliente no esta registrado',
                'info_cliente_apellido.exists' => 'Este cliente no esta registrado'
            ]);
            $cliente = Cliente::where('clientes.nombre_cli', '=', $request->info_cliente_nombre)
                ->where('clientes.apellido_cli', '=', $request->info_cliente_apellido)
                ->first();
            // Puede darse el caso de que no exista esa combinación
            if ($cliente == '') {
                // return "No se encontró cliente";
                return back()
                    ->withErrors([
                        'info_cliente_nombre' => 'Este cliente no esta registrado',
                        'info_cliente_apellido' => 'Este cliente no esta registrado',
                    ])
                    ->withInput();
            }
        } elseif ($request->info_cliente_nombre != null or $request->info_cliente_apellido != null) {
            return back()
                ->withErrors([
                    'info_cliente_nombre' => 'Debes ingresar un apellido y un nombre',
                    'info_cliente_apellido' => 'Debes ingresar un apellido y un nombre',
                ])
                ->withInput();
        } else {
            return back()->withErrors(['info_cliente_ci' => 'Debes ingresar un número de cédula o un nombre y un apellido'])->withInput();
        }
        // ==============================================================================================================================
        // Inicializamos las notificaciones
        $prox_expirar = FALSE;
        $registro_exito = FALSE;
        $registro_exito_dia = FALSE;
        $registro_exito_dia_esp = FALSE;
        $pago_expirado = FALSE;
        $ya_existe = FALSE;
        // CREAMOS EL NUEVO INGRESO
        $newIngreso = new Ingreso;
        # Ingresamos el numero de cédula
        $newIngreso->fk_ci_cli_ing = $cliente->ci_cli;
        # Ingresamos el tipo
        $newIngreso->estado_ing = $cliente->tipo_cli;
        // 
        // Recuperar datos de pagos 
        # Si esta diario no debe comprobar los pagos
        # Si esta mensual debe comprobar los estados de sus pagos
        if ($cliente->tipo_cli == 'Mensual') {
            # En anotaciones debe comprobar que su último pago si ya esta expirado o aun es válido 
            $clientePagos = Cliente::select('pagos.*')
                ->join('pagos', 'pagos.fk_ci_cli_pag', '=', 'clientes.ci_cli')
                ->where('clientes.ci_cli', '=', $cliente->ci_cli)
                ->orderBy('f_vencimiento_pag', 'desc')
                ->first();

            // Preparo para la comparación
            $hoy = now();
            $proxSemana = now()->addWeek();
            $f_vencimiento = Carbon::create($clientePagos->f_vencimiento_pag);

            if ($f_vencimiento->lessThanOrEqualTo($hoy)) {
                // return "Pago expirado";
                $pago_expirado = TRUE;
                $newIngreso->anotacion_ing = "Ingresó con pago expirado";
            } else {
                // return "Pago valido";
                $registro_exito = TRUE;
                # Se debe comparar si el pago caduca en una semana
                # Si la fecha de vencimiento es menor o igual a la proxima semana
                if ($f_vencimiento->lessThanOrEqualTo($proxSemana)) {
                    $prox_expirar = TRUE;
                }
            }
        } elseif ($cliente->tipo_cli == 'Diario') {
            $registro_exito_dia = TRUE;
            $f_vencimiento = null;
        } elseif ($cliente->tipo_cli == 'Diario Especial'){
            $registro_exito_dia_esp = TRUE;
            $f_vencimiento = null;
            $newIngreso->anotacion_ing = "Pago especial: 1$";
        }
        // Por ultimo debemos comprobar si ese cliente ya ingreso el dia de hoy
        $hoy = now()->isoFormat('Y-M-D');
        $comprobarHoy = Ingreso::where('fk_ci_cli_ing', '=', $cliente->ci_cli)
            ->where('created_at', 'LIKE', '%' . $hoy . '%')
            ->first();
        if ($comprobarHoy == '') {
            $newIngreso->save();
        } else {
            $prox_expirar = FALSE;
            $registro_exito = FALSE;
            $registro_exito_dia = FALSE;
            $registro_exito_dia_esp = FALSE;
            $pago_expirado = FALSE;
            $ya_existe = TRUE;
        }
        return back()->with([
            'prox_expirar' => $prox_expirar,
            'registro_exito' => $registro_exito,
            'registro_exito_dia' => $registro_exito_dia,
            'registro_exito_dia_esp' => $registro_exito_dia_esp,
            'pago_expirado' => $pago_expirado,
            'ya_existe' => $ya_existe,
            'cliente_ci' => $cliente->ci_cli,
            'cliente_apellido' => $cliente->apellido_cli,
            'cliente_nombre' => $cliente->nombre_cli,
            'f_vecimiento' => $f_vencimiento,
        ]);
    }
    public function cambiar_tipo(Request $request)
    {
        $cliente = Cliente::findOrFail($request->ci_cli);
        $cliente->tipo_cli = "Diario";
        $cliente->save();
        return back()->with([
            'cambiar_tipo' => TRUE,
            'cliente_apellido' => $cliente->apellido_cli,
            'cliente_nombre' => $cliente->nombre_cli,
        ]);
    }
    public function consulta_post(Request $request)
    {
        // Comprobar que campo esta lleno
        if ($request->info_cliente_ci != null) {
            $request->validate([
                'info_cliente_ci' => 'digits:10|exists:clientes,ci_cli',
            ], [
                'info_cliente_ci.digits' => 'Número de cédula no valido',
                'info_cliente_ci.exists' => 'Número de cédula no encontrado',
            ]);
            // Recuperar informacion del cliente
            $cliente = Cliente::where('clientes.ci_cli', '=', $request->info_cliente_ci)
                ->first();
        } elseif ($request->info_cliente_nombre != null and $request->info_cliente_apellido != null) {
            $request->validate([
                'info_cliente_nombre' => 'exists:clientes,nombre_cli',
                'info_cliente_apellido' => 'exists:clientes,apellido_cli',
            ], [
                'info_cliente_nombre.exists' => 'Este cliente no esta registrado',
                'info_cliente_apellido.exists' => 'Este cliente no esta registrado'
            ]);
            $cliente = Cliente::where('clientes.nombre_cli', '=', $request->info_cliente_nombre)
                ->where('clientes.apellido_cli', '=', $request->info_cliente_apellido)
                ->first();
            // Puede darse el caso de que no exista esa combinación
            if ($cliente == '') {
                // return "No se encontró cliente";
                return back()
                    ->withErrors([
                        'info_cliente_nombre' => 'Este cliente no esta registrado',
                        'info_cliente_apellido' => 'Este cliente no esta registrado',
                    ])
                    ->withInput();
            }
        } elseif ($request->info_cliente_nombre != null or $request->info_cliente_apellido != null) {
            return back()
                ->withErrors([
                    'info_cliente_nombre' => 'Debes ingresar un apellido y un nombre',
                    'info_cliente_apellido' => 'Debes ingresar un apellido y un nombre',
                ])
                ->withInput();
        } else {
            return back()->withErrors(['info_cliente_ci' => 'Debes ingresar un número de cédula o un nombre y un apellido'])->withInput();
        }
        // ==============================================================================================================================
        // Inicializamos las notificaciones
        $prox_expirar = FALSE;
        $tipo_mensual = FALSE;
        $tipo_diario = FALSE;
        $tipo_diario_especial = FALSE;
        $pago_expirado = FALSE;
     
        // Recuperar datos de pagos 
        # Si esta diario no debe comprobar los pagos
        # Si esta mensual debe comprobar los estados de sus pagos
        if ($cliente->tipo_cli == 'Mensual') {
            # En anotaciones debe comprobar que su último pago si ya esta expirado o aun es válido 
            $clientePagos = Cliente::select('pagos.*')
                ->join('pagos', 'pagos.fk_ci_cli_pag', '=', 'clientes.ci_cli')
                ->where('clientes.ci_cli', '=', $cliente->ci_cli)
                ->orderBy('f_vencimiento_pag', 'desc')
                ->first();

            // Preparo para la comparación
            $hoy = now();
            $proxSemana = now()->addWeek();
            $f_vencimiento = Carbon::create($clientePagos->f_vencimiento_pag);

            if ($f_vencimiento->lessThanOrEqualTo($hoy)) {
                // return "Pago expirado";
                $pago_expirado = TRUE;
            } else {
                // return "Pago valido";
                $tipo_mensual = TRUE;
                # Se debe comparar si el pago caduca en una semana
                # Si la fecha de vencimiento es menor o igual a la proxima semana
                if ($f_vencimiento->lessThanOrEqualTo($proxSemana)) {
                    $prox_expirar = TRUE;
                }
            }
        } elseif($cliente->tipo_cli == 'Diario') {
            $tipo_diario = TRUE;
            $f_vencimiento = null;
        }elseif($cliente->tipo_cli == 'Diario Especial'){
            $tipo_diario_especial = TRUE;
            $f_vencimiento = null;
        }

        return back()->with([
            'prox_expirar' => $prox_expirar,
            'tipo_mensual' => $tipo_mensual,
            'tipo_diario' => $tipo_diario,
            'tipo_diario_especial' => $tipo_diario_especial,
            'pago_expirado' => $pago_expirado,
            'cliente_ci' => $cliente->ci_cli,
            'cliente_apellido' => $cliente->apellido_cli,
            'cliente_nombre' => $cliente->nombre_cli,
            'f_vecimiento' => $f_vencimiento,
        ]);
    }
}
