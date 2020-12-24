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
        // return redirect(route('inicio'));
        return view('welcome');
    }
}
