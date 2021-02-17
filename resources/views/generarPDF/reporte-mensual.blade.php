@extends('plantillaPDF')
@section('main')
<div class="text-center">
    <h3 style="font-size: 1.5em;">LISTA DE INGRESOS MENSUAL</h3>
    <p><strong>Fecha: </strong><span>{{$fecha->isoFormat('MMMM \d\e\l Y')}}</span></p>
</div>
<table class="tabla-main">
    <thead>
        <tr>
            <th>#CI</th>
            <th>Apellido</th>
            <th>Nombre</th>
            <th>Tipo</th>
            <th>Ingreso</th>
            <th>Anotaciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($listaIngresos as $item)
        <tr @if($item->anotacion_ing == "Ingresó con pago expirado") style="color:red;"@elseif($item->anotacion_ing == "Pago especial: 1$") style="color:blue;" @endif >
            <td>{{$item->ci_cli}}</td>
            <td>{{$item->apellido_cli}}</td>
            <td>{{$item->nombre_cli}}</td>
            <td>{{$item->tipo_cli}}</td>
            <td>{{\Carbon\Carbon::parse($item->fecha_ingreso)->isoFormat('D-MMM-Y')}}</td>
            <td>{{$item->anotacion_ing}}</td>
        </tr>
        @endforeach
        @if(count($listaIngresos) == 0)
        <tr>
            <td colspan="6"><h3>SIN INGRESOS REGISTRADOS</h3></td>
        </tr>
        @endif
    </tbody>
    <tfoot>
        <tr>
            <td class="table-footer-header text-center" colspan="6">Resumen</td>
        </tr>
        <tr>
            <td colspan="4" rowspan="5"></td>
            <td>N° Diarios</td>
            <td class="text-center">{{$numDiarios}}</td>
        </tr>
        <tr class="text-blue"> 
            <td>N° Especiales</td>
            <td class="text-center">{{$numEspeciales}}</td>
        </tr>
        <tr>
            <td>N° Mensuales</td>
            <td class="text-center">{{$numMensuales}}</td>
        </tr>
        <tr class="text-red">
            <td>N° Pago expirados</td>
            <td class="text-center">{{$numExpirados}}</td>
        </tr>
        <tr class="table-footer-header text-center">
            <td>Total</td>
            <td>{{$total}}</td>
        </tr>
    </tfoot>
</table>
@endsection