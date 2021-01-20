<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ResportesController extends Controller
{
    //
    public function reportes_diario_delete($id){
        $ingresoEliminar = Ingreso::findOrFail($id);
        $ingresoEliminar->delete();
        return back()->with(['eliminarIngreso'=>TRUE]);
    }
}
