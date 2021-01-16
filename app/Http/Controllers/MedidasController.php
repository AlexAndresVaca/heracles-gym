<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Medidas;
use Carbon\Carbon;


class MedidasController extends Controller
{
    //
    public function clientes_medidas_nueva(Request $request, $id)
    {
        $usuario = $request->session()->get('usuario_activo');
        if ($usuario == NULL) {
            return redirect(route('login'));
        } else {
            $perfilCliente = Cliente::findOrFail($id);
            // Sacamos la fecha de hoy
            $fechaHoy = Carbon::now()->isoFormat('Y-M-DD');
            // return $fechaHoy;
            // Buscar si no ha hecho un registro hoy
            $registroHoy = Medidas::where('fk_ci_cli_med', '=', $id)
                ->where('medidas.created_at', 'LIKE', '%' . $fechaHoy . '%')
                ->get();

            $registroHoy = count($registroHoy);

            if ($registroHoy == 0) {
                // return 'Registros igual a 0';
                $puedeCrear = TRUE;
            } else {
                // return 'Ya tiene';
                $puedeCrear = FALSE;
            }

            if ($perfilCliente->sexo_cli == 'Hombre') {
                return view('app.clientes.medidas.medidasHRegistrar', compact('usuario', 'perfilCliente', 'puedeCrear'));
            }
            if ($perfilCliente->sexo_cli == 'Mujer') {
                return view('app.clientes.medidas.medidasMRegistrar', compact('usuario', 'perfilCliente', 'puedeCrear'));
            }
        }
    }
    public function clientes_medidas_new(Request $request, $id)
    {
        // Validaciones 
        $request->validate([
            'peso_med' => 'required|numeric|between:0,200',
            'talla_med' => 'required|numeric|between:0,200',
            'biceps_med' => 'nullable|numeric|between:0,200',
            'triceps_med' => 'nullable|numeric|between:0,200',
            'cintura_med' => 'nullable|numeric|between:0,200',
            'pantorrilla_med' => 'nullable|numeric|between:0,200',
            'muslo1_med' => 'nullable|numeric|between:0,200',
            'muslo2_med' => 'nullable|numeric|between:0,200',
            'espaldaH_med' => 'nullable|numeric|between:0,200',
            'pectoralH_med' => 'nullable|numeric|between:0,200',
            'toraxM_med' => 'nullable|numeric|between:0,200',
            'caderaM_med' => 'nullable|numeric|between:0,200',
            'muslo3M_med' => 'nullable|numeric|between:0,200',
            'gluteosM_med' => 'nullable|numeric|between:0,200',
        ], [
            'peso_med.required' => 'Campo obligatorio',
            'peso_med.numeric' => 'Solo datos numéricos, separador admitido punto (.) para decimales',
            'peso_med.between' => 'Debe ser un número entre 0 y 200',

            'talla_med.required' => 'Campo obligatorio',
            'talla_med.numeric' => 'Solo datos numéricos, separador admitido punto (.) para decimales',
            'talla_med.between' => 'Debe ser un número entre 0 y 200',

            'biceps_med.numeric' => 'Solo datos numéricos, separador admitido punto (.) para decimales',
            'biceps_med.between' => 'Debe ser un número entre 0 y 200',

            'triceps_med.numeric' => 'Solo datos numéricos, separador admitido punto (.) para decimales',
            'triceps_med.between' => 'Debe ser un número entre 0 y 200',

            'cintura_med.numeric' => 'Solo datos numéricos, separador admitido punto (.) para decimales',
            'cintura_med.between' => 'Debe ser un número entre 0 y 200',

            'pantorrillas_med.numeric' => 'Solo datos numéricos, separador admitido punto (.) para decimales',
            'pantorrillas_med.between' => 'Debe ser un número entre 0 y 200',

            'muslo1_med.numeric' => 'Solo datos numéricos, separador admitido punto (.) para decimales',
            'muslo1_med.between' => 'Debe ser un número entre 0 y 200',

            'muslo2_med.numeric' => 'Solo datos numéricos, separador admitido punto (.) para decimales',
            'muslo2_med.between' => 'Debe ser un número entre 0 y 200',

            'espaldaH_med.numeric' => 'Solo datos numéricos, separador admitido punto (.) para decimales',
            'espaldaH_med.between' => 'Debe ser un número entre 0 y 200',

            'pectoralH_med.numeric' => 'Solo datos numéricos, separador admitido punto (.) para decimales',
            'pectoralH_med.between' => 'Debe ser un número entre 0 y 200',

            'toraxM_med.numeric' => 'Solo datos numéricos, separador admitido punto (.) para decimales',
            'toraxM_med.between' => 'Debe ser un número entre 0 y 200',

            'caderaM_med.numeric' => 'Solo datos numéricos, separador admitido punto (.) para decimales',
            'caderaM_med.between' => 'Debe ser un número entre 0 y 200',

            'muslo3_med.numeric' => 'Solo datos numéricos, separador admitido punto (.) para decimales',
            'muslo3_med.between' => 'Debe ser un número entre 0 y 200',

            'gluteosM_med.numeric' => 'Solo datos numéricos, separador admitido punto (.) para decimales',
            'gluteosM_med.between' => 'Debe ser un número entre 0 y 200',
        ]);
        // VALIDACIÓN PARA NO PERMITIR MAS DE UN REGISTRO POR DIA
        $exito_medida = FALSE;
        // Sacamos la fecha de hoy
        $fechaHoy = Carbon::now()->isoFormat('Y-M-DD');
        // return $fechaHoy;
        // Buscar si no ha hecho un registro hoy
        $registroHoy = Medidas::where('fk_ci_cli_med', '=', $id)
            ->where('medidas.created_at', 'LIKE', '%' . $fechaHoy . '%')
            ->get();

        $registroHoy = count($registroHoy);

        if ($registroHoy == 0) {

            $medidasNew = new Medidas;
            $medidasNew->peso_med = is_numeric($request->peso_med ?? '') ? (float)$request->peso_med ?? '' : null;
            $medidasNew->talla_med = is_numeric($request->talla_med ?? '') ? (float)$request->talla_med ?? '' : null;
            $medidasNew->biceps_med = is_numeric($request->biceps_med ?? '') ? (float)$request->biceps_med ?? '' : null;
            $medidasNew->triceps_med = is_numeric($request->triceps_med ?? '') ? (float)$request->triceps_med ?? '' : null;
            $medidasNew->cintura_med = is_numeric($request->cintura_med ?? '') ? (float)$request->cintura_med ?? '' : null;
            $medidasNew->pantorrillas_med = is_numeric($request->pantorrillas_med ?? '') ? (float)$request->pantorrillas_med ?? '' : null;
            $medidasNew->muslo1_med = is_numeric($request->muslo1_med ?? '') ? (float)$request->muslo1_med ?? '' : null;
            $medidasNew->muslo2_med = is_numeric($request->muslo2_med ?? '') ? (float)$request->muslo2_med ?? '' : null;
            $medidasNew->espaldaH_med =  is_numeric($request->espaldaH_med ?? '') ? (float)$request->espaldaH_med ?? '' : null;
            $medidasNew->pectoralH_med = is_numeric($request->pectoralH_med ?? '') ? (float)$request->pectoralH_med ?? '' : null;
            $medidasNew->toraxM_med = is_numeric($request->toraxM_med ?? '') ? (float)$request->toraxM_med ?? '' : null;
            $medidasNew->caderaM_med = is_numeric($request->caderaM_med ?? '') ? (float)$request->caderaM_med ?? '' : null;
            $medidasNew->muslo3M_med = is_numeric($request->muslo3M_med ?? '') ? (float)$request->muslo3M_med ?? '' : null;
            $medidasNew->gluteosM_med = is_numeric($request->gluteosM_med ?? '') ? (float)$request->gluteosM_med ?? '' : null;
            $medidasNew->fk_ci_cli_med = $id;
            $medidasNew->save();
            $exito_medida = TRUE;
        }
        return redirect(route('clientes.perfil', $id))->with([
            'exito_medida' => $exito_medida,
        ]);
    }
}
