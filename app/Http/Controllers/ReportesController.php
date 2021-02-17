<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Ingreso;
use Illuminate\Http\Request;

class ReportesController extends Controller
{
    //
    public function reportes_diario_delete($id){
        $ingresoEliminar = Ingreso::findOrFail($id);
        $ingresoEliminar->delete();
        return back()->with(['eliminarIngreso'=>TRUE]);
    }
}
