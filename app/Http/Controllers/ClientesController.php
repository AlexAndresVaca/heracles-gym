<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Pago;
use App\Models\Medidas;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    //
    public function clientes_index(Request $request)
    {
        $usuario = $request->session()->get('usuario_activo');
        if ($usuario == NULL) {
            return redirect(route('login'));
        } else {
            $lista_clientes = Cliente::all();
            // TODOS LOS QUE NO TENGAN REGISTROS SE PONDRÁN EN DIARIO
            // Esto se realizo para que ningún cliente QUE NO TENGA PAGOS sea mensual
            // NINGÚN MENSUAL PUEDE NO TENER PAGOS
            foreach ($lista_clientes as $item) {
                // FILTRO a los que sean mensuales
                if ($item->tipo_cli == 'Mensual') {
                    $comprobar = Pago::where('fk_ci_cli_pag', '=', $item->ci_cli)->get();
                    if (count($comprobar) == 0) {
                        $item->tipo_cli = 'Diario';
                        $item->save();
                    }
                }
            }
            // Vuelvo a generar la consulta actualizada
            $lista_clientes = Cliente::all();
            return view('app.clientes.index', compact('usuario', 'lista_clientes'));
        }
    }
    public function clientes_perfil(Request $request, $id)
    {
        $usuario = $request->session()->get('usuario_activo');
        if ($usuario == NULL) {
            return redirect(route('login'));
        } else {
            // Ingresando fechas
            $hoy = Carbon::now();
            $mes = Carbon::now()->addMonth();
            $semana2 = Carbon::now()->addWeeks(2);
            $semana = Carbon::now()->addWeek();
            // Recuperar información del cliente
            $perfilCliente = Cliente::findOrFail($id);
            // Recuperar información de pagos
            $pagoActual = Pago::select('pagos.*', 'clientes.ci_cli')
                ->orderBy('pagos.f_vencimiento_pag', 'DESC')
                ->join('clientes', 'clientes.ci_cli', '=', 'pagos.fk_ci_cli_pag')
                ->where('clientes.ci_cli', '=', $id)
                ->first();
            // Recuperar información de medidas
            $listaMedidas = Medidas::select('medidas.*', 'clientes.ci_cli')
                ->join('clientes', 'clientes.ci_cli', '=', 'medidas.fk_ci_cli_med')
                ->where('clientes.ci_cli', '=', $id)
                ->get();
            // LÓGICA
            if ($pagoActual != '') {
                // Traer toda la lista de pagos
                $listaPagos = Pago::select('pagos.*', 'clientes.ci_cli')
                    ->join('clientes', 'clientes.ci_cli', '=', 'pagos.fk_ci_cli_pag')
                    ->where('clientes.ci_cli', '=', $id)
                    ->get();
                $first = Carbon::create($pagoActual->f_vencimiento_pag);
                // COMPROBAR SI AUN ES VALIDO EL PAGO ANTES DE REGISTRAR OTRO
                // Devuelve TRUE si es mayor al dia actual CASO contrario enviá FALSE
                if ($first->greaterThan($hoy)) {
                    $pagoActual = TRUE;
                } else {
                    $pagoActual = FALSE;
                }
                // Si HOY es mayor que FECHA_VENCIMIENTO significa que ya caducó
                if ($hoy->greaterThan($first)) {
                    $pagoExpirado = TRUE;
                } else {
                    $pagoExpirado = FALSE;
                    $perfilCliente->tipo_cli = 'Mensual';
                }
                // Guardar cambios
                $perfilCliente->save();
                // PREPARAR mensaje de WSP
                $aviso_wsp = urlencode('*HeraclesGYM te saluda!* Cliente: *' . $perfilCliente->apellido_cli . ' ' . $perfilCliente->nombre_cli . '* le recordamos que su suscripción ha caducado ' . $first->diffForHumans() . ' *( ' . $first->isoFormat('dddd D \d\e MMMM \d\e\l YYYY') . ')*');
                return view('app.clientes.perfiles.index', compact('usuario', 'perfilCliente', 'hoy', 'mes', 'semana', 'semana2', 'pagoActual', 'pagoExpirado', 'aviso_wsp', 'listaPagos', 'first', 'listaMedidas'));
            } else {
                if ($pagoActual == '' and $perfilCliente->tipo_cli == 'Mensual') {
                    $perfilCliente->tipo_cli = 'Diario';
                }
                $perfilCliente->save();
            }

            return view('app.clientes.perfiles.index', compact('usuario', 'perfilCliente', 'hoy', 'mes', 'semana', 'semana2', 'listaMedidas'));
        }
    }
    public function clientes_add(Request $request)
    {
        $request->validate([
            'ci_cli' => 'required|digits:10|unique:clientes,ci_cli',
            'apellido_cli' => 'required|not_regex:/[0-9]/|not_regex:/[!"#$%&()+]/',
            'nombre_cli' => 'required|not_regex:/[0-9]/|not_regex:/[!"#$%&()+]/',
            'celular_cli' => 'nullable|digits:9|unique:clientes,celular_cli',
        ], [
            'ci_cli.required' => 'Campo obligatorio',
            'ci_cli.digits' => 'Solo debe ingresar números',
            'ci_cli.unique' => 'Este numero de cédula ya esta registrado',
            'nombre_cli.required' => 'Este campo es obligatorio',
            'nombre_cli.exists' => 'Este nombre de usuario no existe',
            'nombre_cli.not_regex' => 'No debes ingresar caracteres especiales ni números',
            'apellido_cli.required' => 'Este campo es obligatorio',
            'apellido_cli.exists' => 'Este nombre de usuario no existe',
            'apellido_cli.not_regex' => 'No debes ingresar caracteres especiales ni números',
            'celular_cli.digits' => 'Solo debe ingresar números',
            'celular_cli.unique' => 'Este numero ya esta registrado',
        ]);
        $newCliente = new Cliente;

        $newCliente->ci_cli = $request->ci_cli;
        $newCliente->apellido_cli = Str::title($request->apellido_cli);
        $newCliente->nombre_cli = Str::title($request->nombre_cli);
        $newCliente->celular_cli = $request->celular_cli;
        // POR DEFAULT 
        // $newCliente->tipo_cli = Str::title('Diario');
        $newCliente->sexo_cli = Str::title($request->sexo_cli);

        $newCliente->save();
        return back()->with([
            'exito' => TRUE,
            'new_cliente' => $newCliente->ci_cli
        ]);
    }
    public function clientes_update(Request $request, $id)
    {
        $updateCliente = Cliente::findOrFail($id);
        $request->validate([
            'apellido_cli' => 'required|not_regex:/[0-9]/|not_regex:/[!"#$%&()+]/',
            'nombre_cli' => 'required|not_regex:/[0-9]/|not_regex:/[!"#$%&()+]/',
            'celular_cli' => 'nullable|digits:9|unique:clientes,celular_cli,' . $updateCliente->ci_cli . ',ci_cli',
        ], [
            'nombre_cli.required' => 'Este campo es obligatorio',
            'nombre_cli.exists' => 'Este nombre de usuario no existe',
            'nombre_cli.not_regex' => 'No debes ingresar caracteres especiales ni números',
            'apellido_cli.required' => 'Este campo es obligatorio',
            'apellido_cli.exists' => 'Este nombre de usuario no existe',
            'apellido_cli.not_regex' => 'No debes ingresar caracteres espaciales ni números',
            'celular_cli.digits' => 'Solo debe ingresar números',
            'celular_cli.unique' => 'Este numero ya esta registrado',
        ]);

        $updateCliente->apellido_cli = Str::title($request->apellido_cli);
        $updateCliente->nombre_cli = Str::title($request->nombre_cli);
        $updateCliente->celular_cli = $request->celular_cli;
        $updateCliente->tipo_cli = Str::title($request->tipo_cli);
        $updateCliente->sexo_cli = Str::title($request->sexo_cli);

        $updateCliente->save();
        return back()->with([
            'exito' => TRUE,
        ]);
    }
    
}
