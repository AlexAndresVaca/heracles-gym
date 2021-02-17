<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Ingreso;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GenerarPDF extends Controller
{
    public function generar_pdf_clientes()
    {
        // Inicializamos variables
        $fechaGenerado = now();
        // INFO PDF
        $nombre_pdf = 'lista de clientes';
        $pdf = app('dompdf.wrapper');
        // SQL
        $listaClientes = Cliente::orderBy('apellido_cli', 'asc')->get();
        // Cargamos al pdf una vista y sus datos
        $pdf->loadView('generarPDF.clientes', compact('listaClientes', 'nombre_pdf', 'fechaGenerado'));
        return $pdf->stream();
    }

    public function pdf_reporte_diario($fecha)
    {
        // Inicializamos variables
        $numDiarios = 0;
        $numMensuales = 0;
        $numEspeciales = 0;
        $numExpirados = 0;
        $total = 0;
        $fechaGenerado = now();
        // INFO PDF
        $pdf = app('dompdf.wrapper');
        $fecha = Carbon::create($fecha);
        $nombre_pdf = 'ingresos del día ' . $fecha->isoFormat('D-MM-Y');
        // SQL
        $listaIngresos = Ingreso::select('*', 'ingresos.created_at as hora_ingreso')
            ->join('clientes', 'clientes.ci_cli', '=', 'ingresos.fk_ci_cli_ing')
            ->whereDate('ingresos.created_at', $fecha)
            ->orderBy('hora_ingreso', 'asc')
            ->get();
        // return $listaIngresos;
        $total = count($listaIngresos);
        foreach ($listaIngresos as $item) {
            if ($item->estado_ing == "Mensual") {
                $numMensuales++;
            } elseif ($item->estado_ing == "Diario" and $item->anotacion_ing == NULL) {
                $numDiarios++;
            }
            if ($item->anotacion_ing == "Ingresó con pago expirado") {
                $numExpirados++;
            } elseif ($item->anotacion_ing == "Pago especial: 1$") {
                $numEspeciales++;
            }
        }
        // Cargamos al pdf una vista y sus datos
        $pdf->loadView('generarPDF.reporte-diario', compact('nombre_pdf', 'listaIngresos', 'fecha', 'fechaGenerado', 'total', 'numEspeciales',  'numDiarios', 'numMensuales', 'numExpirados'));
        return $pdf->stream();
    }

    public function pdf_reporte_mensual($fecha)
    {
        // Inicializo variables
        $numMensuales = 0;
        $numDiarios = 0;
        $numExpirados = 0;
        $numEspeciales = 0;
        $total = 0;
        $fecha = Carbon::create($fecha);
        $fechaGenerado = now();
        $mesActual = $fecha->isoFormat('M');
        $anioActual = $fecha->isoFormat('Y');
        // INFO PDF
        $pdf = app('dompdf.wrapper');
        $nombre_pdf = 'ingresos del mes ' . $fecha->isoFormat('MM-Y');
        // SQL
        $listaIngresos = Ingreso::select('*', 'ingresos.created_at as fecha_ingreso')
            ->join('clientes', 'clientes.ci_cli', '=', 'ingresos.fk_ci_cli_ing')
            ->whereMonth('ingresos.created_at', $mesActual)
            ->whereYear('ingresos.created_at', $anioActual)
            ->orderBy('ingresos.created_at', 'desc')
            ->get();
        // Calculamos cuantos clientes diarios, mensuales y expirados han ingresado en el mes
        $total = count($listaIngresos);
        foreach ($listaIngresos as $item) {
            if ($item->estado_ing == "Mensual") {
                $numMensuales++;
            } elseif ($item->estado_ing == "Diario" and $item->anotacion_ing == NULL) {
                $numDiarios++;
            }
            if ($item->anotacion_ing == "Ingresó con pago expirado") {
                $numExpirados++;
            } elseif ($item->anotacion_ing == "Pago especial: 1$") {
                $numEspeciales++;
            }
        }
        $pdf->loadView('generarPDF.reporte-mensual', compact('nombre_pdf', 'listaIngresos', 'fecha', 'fechaGenerado', 'total', 'numEspeciales',  'numDiarios', 'numMensuales', 'numExpirados'));
        return $pdf->stream();
    }
}
