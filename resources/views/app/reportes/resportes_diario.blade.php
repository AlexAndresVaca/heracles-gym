@extends('plantilla')
@section('reportes_active')
active
@endsection
@section('nav')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('inicio')}}"><i class="fa fa-home"></i> Inicio</a></li>
        <li class="breadcrumb-item active" aria-current="page">Reporte diario</li>
    </ol>
</nav>
@endsection
@section('main')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <!-- DONDE SE ENCUENTRA -->
        <h1 class="h3 mb-0 text-gray-800">Reporte diario</h1>
    </div>
    <div class="row justify-content-center">
        <form action="{{route('reportes.diario.post')}}" class="form-inline" method="POST">
            @CSRF
            <div class="card">
                <div class="card-header">
                    <h6>Selecciona una fecha</h6>
                </div>
                <div class="card-body d-flex justify-content-center">
                    <input type="date" class="form-control mx-2" name="fecha"
                        value="@if($errors->has('fecha')){{old('fecha')}}@else{{$fecha->isoFormat('Y-M-D')}}@endif">
                    <button type="submit" class="btn btn-primary">Generar</button>
                </div>
                @if($errors->has('fecha'))
                <div class="card-footer is-invalid text-danger text-center ">
                    <span class="font-weight-bold">{{$errors->first('fecha')}}</span><span class="font-italic">
                        {{\Carbon\Carbon::parse(old('fecha'))->isoFormat('dddd D \d\e MMMM \d\e\l YYYY')}}</span>
                </div>
                @endif
            </div>
        </form>
    </div>
</div>
<hr>
@if(session('eliminarIngreso'))
<div class="container-fluid">
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Registro Eliminado!</strong> Se ha eliminado un registro correctamente.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
</div>
@endif
<hr>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between py-3">
            <h5 class="m-0 font-weight-bold text-danger">{{$fecha->isoFormat('dddd D \d\e MMMM \d\e\l YYYY')}}</h5>
                <a href="{{route('descargar.pdf.reporte-diario',$fecha)}}" class="btn btn-danger" target="blank">
                    <i class="far fa-file-pdf"></i>
                    Generar PDF
                </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-gym table-dark table-bordered" id="tablaReportesDiario" width="100%"
                    cellspacing="0">
                    <thead>
                        <tr>
                            <th>#CI</th>
                            <th>Apellido</th>
                            <th>Nombre</th>
                            <th>Tipo</th>
                            <th>Hora</th>
                            <th class="w-150px">Anotaciones</th>
                            <th class="w-25px text-center"><i class="fa fa-cog"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($listaIngresos as $item)
                        <tr
                            class="@if($item->anotacion_ing != '') bg-expirado @elseif($item->anotacion_ing == '' AND $item->tipo_cli == 'Mensual') bg-mensual @elseif($item->tipo_cli == 'Diario') bg-diario @endif">
                            <td>{{$item->ci_cli}}</td>
                            <td>{{$item->apellido_cli}}</td>
                            <td>{{$item->nombre_cli}}</td>
                            <td>{{$item->tipo_cli}}</td>
                            <td>{{\Carbon\Carbon::parse($item->hora_ingreso)->isoFormat('HH:mm')}}</td>
                            <td>{{$item->anotacion_ing}}</td>
                            <td class="d-flex"><form action="{{route('reportes.diario.delete',$item)}}" method="POST">@csrf<button type="submit" class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i></button></form></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="dropdown-divider"></div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Resumen productos</h1>
    </div>
    <div class="row">
        @foreach($listaVentas as $item)
        @if($item->descripcion_ven === 'Venta')
        <div class="col-xl-4 col-md-4 mb-4" title="{{$item->detalle_prod}}">
            <div class="card border-left-info shadow h-100 py-2 bg-black">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-lg font-weight-bold text-info text-truncate text-uppercase mb-1">
                                {{$item->detalle_prod}}</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-100">{{$item->suma_total}} /<span
                                    class="text-xs font-weight-lighter "> unidades vendidas.</span> </div>
                        </div>
                        <div class="col-auto">
                            <!-- <i class="fas fa-user fa-2x text-gray-300"></i> -->
                            <i class="fas fa-box-open fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @endforeach
        @foreach($listaVentas as $item)
        @if($item->descripcion_ven === 'Devolucion')
        <div class="col-xl-4 col-md-4 mb-4" title="{{$item->detalle_prod}}">
            <div class="card border-left-danger shadow h-100 py-2 bg-black">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-lg font-weight-bold text-danger text-truncate text-uppercase mb-1">
                                {{$item->detalle_prod}}</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-100">{{$item->suma_total}} /<span
                                    class="text-xs font-weight-lighter "> unidades devueltas.</span> </div>
                        </div>
                        <div class="col-auto">
                            <!-- <i class="fas fa-user fa-2x text-gray-300"></i> -->
                            <i class="fas fa-box fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>
</div>
@endsection