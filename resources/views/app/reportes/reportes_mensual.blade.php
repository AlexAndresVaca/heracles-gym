@extends('plantilla')
@section('reportes_active')
active
@endsection
@section('nav')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('inicio')}}"><i class="fa fa-home"></i> Inicio</a></li>
        <li class="breadcrumb-item active" aria-current="page">Reporte mensual</li>
    </ol>
</nav>
@endsection
@section('main')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <!-- DONDE SE ENCUENTRA -->
        <h1 class="h3 mb-0 text-gray-800">Reporte mensual</h1>
    </div>
    <div class="row justify-content-center">
        <form action="{{route('reportes.mensual.post')}}" class="form-inline" method="POST">
            @CSRF
            <div class="card">
                <div class="card-header">
                    <h6>Selecciona un mes</h6>
                </div>
                <div class="card-body d-flex justify-content-center">
                    <input type="month" class="form-control mx-2" name="fecha"
                        value="@if($errors->has('fecha')){{old('fecha')}}@else{{$fecha->isoFormat('Y-MM')}}@endif">
                    <button type="submit" class="btn btn-primary">Generar</button>
                </div>
                @if($errors->has('fecha'))
                <div class="card-footer is-invalid text-danger text-center ">
                    <span class="font-weight-bold">{{$errors->first('fecha')}}</span><span class="font-italic">
                        {{\Carbon\Carbon::parse(old('fecha'))->isoFormat('MMMM \d\e\l YYYY')}}</span>
                </div>
                @endif
            </div>
        </form>
    </div>
</div>
<hr>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between py-3">
            <h5 class="m-0 font-weight-bold text-danger">{{$fecha->isoFormat('MMMM \d\e\l YYYY')}}</h5>
            <a href="{{route('descargar.pdf.reporte-mensual',$fecha)}}" class="btn btn-danger" target="blank">
                    <i class="far fa-file-pdf"></i>
                    Generar PDF
                </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-gym table-dark table-bordered" id="tablaReportesMensual" width="100%"
                    cellspacing="0">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>#CI</th>
                            <th>Apellido</th>
                            <th>Nombre</th>
                            <th>Tipo</th>
                            <th>Dia de ingreso</th>
                            <th class="w-150px">Anotaciones</th>
                        </tr>
                    </thead>
                    @foreach($listaIngresos as $item)
                    <tr>
                        <td>{{\Carbon\Carbon::parse($item->dia_ingreso)}}</td>
                        <td>{{$item->ci_cli}}</td>
                        <td>{{$item->apellido_cli}}</td>
                        <td>{{$item->nombre_cli}}</td>
                        <td>{{$item->tipo_cli}}</td>
                        <td>{{\Carbon\Carbon::parse($item->dia_ingreso)->isoFormat('dddd D \d\e MMMM \d\e\l YYYY')}}</td>
                        <td>{{$item->anotacion_ing}}</td>
                    </tr>
                    @endforeach
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