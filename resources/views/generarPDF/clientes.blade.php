@extends('plantillaPDF')
@section('main')
<div class="text-center">
    <h3 style="font-size: 1.5em;">LISTA DE CLIENTES</h3>
</div>
<table class="tabla-main">
    <thead>
        <tr>
            <th>#CI</th>
            <th>Apellido</th>
            <th>Nombre</th>
            <th>Tipo</th>
            <th>Celular</th>
        </tr>
    </thead>
    <tbody>
        @foreach($listaClientes as $item)
        <tr>
            <td>{{$item->ci_cli}}</td>
            <td>{{$item->apellido_cli}}</td>
            <td>{{$item->nombre_cli}}</td>
            <td>{{$item->tipo_cli}}</td>
            @if($item->celular_cli != NULL)
            <td>0{{$item->celular_cli}}</td>
            @else
            <td style="color:gray;">-</td>
            @endif
        </tr>
        @endforeach
    </tbody>
</table>
@endsection