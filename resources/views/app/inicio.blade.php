@extends('plantilla')
@section('nav')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page"><a><i class="fa fa-home"></i> Inicio</a></li>
    </ol>
</nav>
@endsection
@section('home_active')
active
@endsection
@section('main')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <!-- Cambiar Menu por nombre de la pagina donde se encuentre -->
        <h1 class="h3 mb-0 text-gray-800">Resumen diario</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example | Tarjeta de clientes mensuales -->
        <div class="col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2 bg-black">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-lg font-weight-bold text-info text-uppercase mb-1">Clientes mensuales
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-100">{{$numMensuales}} <span
                                    class="text-xs font-weight-lighter ">/ personas.</span> </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example  | Tarjeta de clientes diarios-->
        <div class="col-md-6 mb-4">
            <div class="card border-left-success bg-black shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-lg font-weight-bold text-success text-uppercase mb-1">Clientes diarios
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-200 ">{{$numDiarios}} <span
                                    class="text-xs font-weight-lighter ">/ personas.</span></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Pending Requests Card Example  | Tarjeta de clientes con pago expirado -->
        <div class="col-md-6 mb-4">
            <div class="card border-left-danger bg-black shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-lg font-weight-bold text-danger text-uppercase mb-1">Clientes pago
                                expirado</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-100">{{$numExpirados}} <span
                                    class="text-xs font-weight-lighter ">/ personas.</span> </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Pending Requests Card Example  | Tarjeta de clientes Diario Especial -->
        <div class="col-md-6 mb-4">
            <div class="card border-left-warning bg-black shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-lg font-weight-bold text-warning text-uppercase mb-1">Clientes pago
                                especial</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-100">{{$numEspeciales}} <span
                                    class="text-xs font-weight-lighter ">/ personas.</span> </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="container">
        <div class="row justify-content-center">
            <a href="{{route('reportes.diario')}}">
                <button type="button" class="btn btn-danger">Ver detalles</button>
            </a>
        </div>
    </div>

    <!-- Content Row -->


</div>
<div class="dropdown-divider"></div>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <!-- Cambiar Menu por nombre de la pagina donde se encuentre -->
        <h1 class="h3 mb-0 text-gray-800">Resumen mensual</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example | Tarjeta de clientes mensuales -->
        <div class="col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2 bg-black">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-lg font-weight-bold text-info text-uppercase mb-1">Clientes mensuales
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-100">{{$numMensualesMes}} <span
                                    class="text-xs font-weight-lighter ">/ personas.</span> </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example  | Tarjeta de clientes diarios-->
        <div class="col-md-6 mb-4">
            <div class="card border-left-success bg-black shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-lg font-weight-bold text-success text-uppercase mb-1">Clientes diarios
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-200 ">{{$numDiariosMes}} <span
                                    class="text-xs font-weight-lighter ">/ personas.</span></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Pending Requests Card Example  | Tarjeta de clientes con pago expirado -->
        <div class="col-md-6 mb-4">
            <div class="card border-left-danger bg-black shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-lg font-weight-bold text-danger text-uppercase mb-1">Clientes pago
                                expirado</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-100">{{$numExpiradosMes}} <span
                                    class="text-xs font-weight-lighter ">/ personas.</span></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Pending Requests Card Example  | Tarjeta de clientes Diario Especial -->
        <div class="col-md-6 mb-4">
            <div class="card border-left-warning bg-black shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-lg font-weight-bold text-warning text-uppercase mb-1">Clientes pago
                                especial</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-100">{{$numEspecialesMes}} <span
                                    class="text-xs font-weight-lighter ">/ personas.</span> </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <div class="container">
        <div class="row justify-content-center">
            <a href="{{route('reportes.mensual')}}">
                <button type="button" class="btn btn-danger">Ver detalles</button>
            </a>
        </div>
    </div>

    <!-- Content Row -->

</div>
<div class="dropdown-divider"></div>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <!-- Cambiar Menu por nombre de la pagina donde se encuentre -->
        <h1 class="h3 mb-0 text-gray-800">Resumen de productos en stock</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example | Tarjeta de clientes mensuales -->
        @foreach($productos as $item)
        <div class="col-md-4 mb-4" title="{{$item->detalle_prod}}">
            <div class="card border-left-info shadow h-100 py-2 bg-black">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-lg font-weight-bold text-info text-truncate text-uppercase mb-1">{{$item->detalle_prod}}
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-100">{{$item->stock_prod}} <span
                                    class="text-xs font-weight-lighter ">/ productos en stock.</span> </div>
                        </div>
                        <div class="col-auto">
                            <!-- <i class="fas fa-user fa-2x text-gray-300"></i> -->
                            <i class="fas fa-boxes fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection