<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PagosController extends Controller
{
    //
    public function pagos_add(Request $request,$id){
        // CREO LAS FECHAS
        $hoy = Carbon::now();
        $mes = Carbon::now()->addMonth();
        $semana2 = Carbon::now()->addWeeks(2);
        $semana = Carbon::now()->addWeek();

        // PREPARO PARA GUARDAR EN LA BDD
        $newPago = new App\Models\Pago;
        // DEPENDE de la selección del tipo de suscripción
        if($request->tiempo === '1'){
            $newPago->f_vencimiento_pag =  $mes;
        }
        elseif($request->tiempo === '2'){
            $newPago->f_vencimiento_pag = $semana2;
        }
        elseif($request->tiempo === '3'){
            $newPago->f_vencimiento_pag = $semana;
        }
        elseif($request->tiempo === '4'){
            $newPago->f_vencimiento_pag = $request->hasta_pago;
            $newPago->created_at = $request->desde_pago;
        }
        // Almaceno los datos
        $newPago->detalle_pag = $request->detalle_pag;
        $newPago->fk_ci_cli_pag = $id;
        // Cambio el estado de diario a mensual
        $cliente = App\Models\Cliente::findOrFail($id);
        $cliente->tipo_cli = 'Mensual';
        // GUARDO EN LA BASE DE DATOS
        $cliente->save();
        $newPago->save();
        // return $newPago;
        return back()->with([
                    'new_pago'=>TRUE,
        ]);
    }
}
