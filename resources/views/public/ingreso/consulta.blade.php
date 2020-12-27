@extends('public/ingreso/plantillaIngreso')
@section('bg')
bg-black-b
@endsection
@section('consulta')
active
@endsection
@section('main')

<div class="jumbotron jumbotron-fluid bg-secondary text-gray-100">
    <div class="container">
        <h1 class="display-4 text text-uppercase">
            <i class="fas fa-dumbbell rotate-n-15 "></i>
            Consulta de subscripción
        </h1>
        <p class="lead">Para verificar cuando expira tu subscripción mensual debes estar registrado en <strong
                class="text-uppercase">&copy; Heracles GYM System 2020</strong>.</p>
        <p class="lead">
        <ul>
            <li>Puedes registrarte ya seas de <strong>pago mensual</strong> o de <strong>pago diario</strong>.</li>
        </ul>
        </p>
    </div>
</div>
<div class="container">
    @if(session('tipo_mensual')==TRUE)
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <p class="display-4 mb-0">
            <strong>Resultados de la consulta:</strong><br>
            Cliente <strong>({{session('cliente_apellido')}} {{session('cliente_nombre')}})</strong> tu pago expira el día <strong>{{session('f_vecimiento')->isoFormat('dddd D \d\e MMMM \d\e\l YYYY')}}</strong>.
        </p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    @if(session('prox_expirar')==TRUE)
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <p class="display-4 mb-0">
            <strong>Su pago esta próximo a expirar {{session('f_vecimiento')->diffForHumans()}}!</strong>
        </p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    @if(session('tipo_diario')==TRUE)
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <p class="display-4 mb-0">
            <strong>Resultados de la consulta:</strong><br>
            Cliente <strong>({{session('cliente_apellido')}} {{session('cliente_nombre')}})</strong> suscripción diaria.
        </p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    @if(session('tipo_diario_especial')==TRUE)
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <p class="display-4 mb-0">
            <strong>Resultados de la consulta:</strong><br>
            Cliente <strong>({{session('cliente_apellido')}} {{session('cliente_nombre')}})</strong> suscripción diario especial.
        </p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    @if(session('pago_expirado')==TRUE)
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <p class="display-4 mb-0">
            <strong>Tu suscripción ha caducado!</strong><br>
            Cliente <strong>({{session('cliente_apellido')}} {{session('cliente_nombre')}})</strong> tu pago expiró el día <strong>{{session('f_vecimiento')->isoFormat('dddd D \d\e MMMM \d\e\l YYYY')}}</strong>.
        </p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <form action="{{route('heracles.consulta.post')}}" method="POST" class="py-3 mb-5" autocomplete="off">
        @CSRF
        <div class="form-group row">
            <label for="colFormLabelLg" class="col-sm-2 col-form-label text-gray-900 col-form-label-lg">Datos
                personales</label>
            <div class="col-sm-10">
                <div class="form-group row">
                    <input type="text" name="info_cliente_ci"
                        class="form-control form-control-lg @if($errors->has('info_cliente_ci')) is-invalid @endif"
                        id="colFormLabelLg" placeholder="Cédula de Identidad (Sin guiones)" value="{{old('info_cliente_ci')}}" autofocus>
                    @if($errors->has('info_cliente_ci'))
                    <div class="invalid-feedback">
                        <h6 class="ml-2 h5">{{$errors->first('info_cliente_ci')}}</h6>
                    </div>
                    @endif
                </div>
                <div class="form-group row justify-content-center text-uppercase">
                    o también puedes consultar mediante:
                </div>
                <div class="form-group row justify-content-around">
                    <input type="text" name="info_cliente_apellido"
                        class="col-5 form-control form-control-lg @if($errors->has('info_cliente_apellido')) is-invalid @endif"
                        id="colFormLabelLg" placeholder="Apellido" value="{{old('info_cliente_apellido')}}">
                    <input type="text" name="info_cliente_nombre"
                        class="col-5 form-control form-control-lg @if($errors->has('info_cliente_nombre')) is-invalid @endif"
                        id="colFormLabelLg" placeholder="Nombre" value="{{old('info_cliente_nombre')}}">
                </div>
                @if($errors->has('info_cliente_apellido') AND $errors->has('info_cliente_nombre'))
                <div class="form-group row justify-content-around text-danger">
                    <span class="h5">{{$errors->first('info_cliente_apellido')}}</span>
                </div>
                @elseif($errors->has('info_cliente_apellido'))
                <div class="form-group row justify-content-around text-danger">
                    <span class="h5">{{$errors->first('info_cliente_apellido')}}</span>
                </div>
                @elseif($errors->has('info_cliente_nombre'))
                <div class="form-group row justify-content-around text-danger">
                    <span class="h5">{{$errors->first('info_cliente_nombre')}}</span>
                </div>
                @endif
            </div>
        </div>

        <button type="submit" class="mx-auto col-6 btn btn-info btn-lg btn-block">Consultar</button>
        <a href="{{route('heracles.consulta')}}" class="mx-auto col-6 btn btn-secondary btn-lg btn-block">Volver</a>
    </form>
</div>
@endsection