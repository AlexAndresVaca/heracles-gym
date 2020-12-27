@extends('plantilla')
@section('gClientes_active')
active
@endsection
@section('nav')
<nav aria-label="breadcrumb stu">
    <ol class="breadcrumb mb-1">
        <li class="breadcrumb-item"><a href="{{route('inicio')}}"><i class="fa fa-home"></i> Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{route('clientes.index')}}">Clientes</a></li>
        <li class="breadcrumb-item active" aria-current="page">Perfil</li>
    </ol>
</nav>
@endsection
@section('main')
<!-- ENCABEZADO GIGANTE -->
<div class="jumbotron jumbotron-fluid p-1">
    <div class="container">
        <div class="d-flex justify-content-end">
            <button class="btn btn-outline-dark btn-sm" data-toggle="modal" data-target="#editarClienteModal" type="bu">
                <i class="fas fa-edit"></i>
                Editar perfil
            </button>
        </div>
        <h1 class="display-4 text-gray-900">Perfil de usuario</h1>
        <p class="lead">
        <ul>
            <li><span class="font-weight-bold text-gray-900">CI: </span>{{$perfilCliente->ci_cli}}</li>
            <li><span class="font-weight-bold text-gray-900">Nombres: </span>{{$perfilCliente->apellido_cli}}
                {{$perfilCliente->nombre_cli}}</li>
            <!-- CALCULADO EN CONTROLADOR -->
            <li><span class="font-weight-bold text-gray-900">Tipo de suscripción: </span>{{$perfilCliente->tipo_cli}}
                @if($pagoExpirado??'' === TRUE AND $perfilCliente->tipo_cli == 'Mensual') (Pago Caducado) @endif
            </li>
            <li><span class="font-weight-bold text-gray-900">Celular: </span>
                @if($perfilCliente->celular_cli != NULL)
                <a href="https://api.whatsapp.com/send?phone=593{{$perfilCliente->celular_cli}}" target="_blank"
                    class="btn btn-light"><i class="fab fa-whatsapp" style="color:lawngreen;"></i>
                    0{{$perfilCliente->celular_cli}}
                </a>
                @else
                (Sin registro de número celular)
                @endif
            </li>
        </ul>
        </p>
        @if($pagoExpirado??'' === TRUE AND $perfilCliente->tipo_cli == 'Mensual')
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Pago expirado!</strong> Por favor, informe al cliente que su pago a caducado.
            @if($perfilCliente->celular_cli != NULL)
            <a href="https://wa.me/593{{$perfilCliente->celular_cli}}?text={{$aviso_wsp}}" target="_blank">Avisar por
                Whatsapp</a>
            @endif
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
    </div>
</div>
@if(session('exito'))
<div class="container">
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Datos actualizados!</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
@endif
@if(session('new_pago'))
<div class="container">
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Nuevo pago registrado!</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
@endif
@if(session('exito_medida') == TRUE)
<div class="container">
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Registro de medidas exitoso!</strong> puedes revisarlo ahora!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
@endif
@if(session('exito_medida_delete') == TRUE)
<div class="container">
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Registro de medidas eliminado!</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
@endif
@if(session('pago_delete') == TRUE)
<div class="container">
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Registro de pago eliminado!</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
@endif
<div class="container">
    <div class="row">
        <div class="col-md-auto col-lg-12">
            <div class="row">
                <div class="col d-flex justify-content-center">
                    <button class="btn btn-primary my-4" data-toggle="modal" data-target="#nuevoPagoModal">
                        <i class="fas fa-file-invoice"></i>
                        Nuevo Pago
                    </button>
                </div>
            </div>
            <!-- Content Row MAIN-->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-gray-900">Pagos</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-gym table-dark table-bordered" id="tablaPagos" width="100%"
                            cellspacing="0">
                            <thead>
                                <tr>
                                    <th>COD</th>
                                    <th>Fecha de expiración (ordenable)</th>
                                    <th>Fecha de pago</th>
                                    <th>Fecha de expiración</th>
                                    <th>Anotación</th>
                                    <th class="text-center w-75px"><i class="fa fa-cog"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($listaPagos??'')
                                @foreach($listaPagos as $item)
                                <tr>
                                    <td>{{$item->cod_pag}}</td>
                                    <td>{{$item->f_vencimiento_pag}}</td>
                                    <td>{{$item->created_at->isoFormat('dddd D \d\e MMMM \d\e\l YYYY')}}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->f_vencimiento_pag)->isoFormat('dddd D \d\e MMMM \d\e\l YYYY')}}
                                    </td>
                                    <td>{{$item->detalle_pag}}</td>
                                    <th class="text-center w-75px"><form action="{{route('pagos.delete',$item->cod_pag)}}" method="post">@CSRF <button type="submit" class="btn btn-outline-danger"><i class="fas fa-trash-alt"></button></form></i></th>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Content Row FIN MAIN-->


        </div>
    </div>
    <div class="row">
        <div class="col-md-auto col-lg-12">
            <div class="row">
                <div class="col d-flex justify-content-center">
                    <a href="{{route('clientes.medidas.registrar',$perfilCliente->ci_cli)}}"
                        class="btn btn-primary my-4 text-gray-100">
                        <i class="fas fa-weight"></i> Nuevo registro de medidas
                    </a>
                </div>
            </div>

            <!-- Content Row MAIN-->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-gray-900">Medidas</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-gym table-dark table-bordered" id="tablaMedidas" width="100%"
                            cellspacing="0">
                            <thead>
                                <tr>
                                    <th>COD</th>
                                    <th>Fecha de registro</th>
                                    <th class="w-75px text-center"><i class="fas fa-info-circle"></i> Info</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($listaMedidas as $item)
                                <tr>
                                    <td>{{$item->cod_med}}</td>
                                    <td>{{$item->created_at->isoFormat('dddd D \d\e MMMM \d\e\l YYYY')}}
                                        <strong>({{$item->created_at->diffForHumans()}})</strong>
                                    </td>
                                    <td class="text-center w-75px"><a href="{{route('clientes.medidas',$item)}}"
                                            class="btn btn-sm btn-primary">Ver</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Content Row FIN MAIN-->
        </div>
    </div>
    <div class="row justify-content-end">
        <form action="{{route('clientes.delete',$perfilCliente->ci_cli)}}" method="post">
            @csrf
            <button type="submit" class="btn btn-outline-danger">Eliminar Cliente</button>
        </form>
    </div>
</div>
@endsection
@section('modal')
<div class="modal fade" id="editarClienteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('clientes.update',$perfilCliente->ci_cli)}}" method="POST"
                    class="needs-validation" novalidate autocomplete="off">
                    @CSRF
                    @method('PUT')
                    <div class="row mb-2">
                        <div class="col">
                            <!-- AGREGAR (is-valid) 0 (is-invalid) para mostrar el estado de un input -->
                            <input type="text" maxlength="10" minlength="10"
                                class="form-control @if($errors->has('ci_cli'))is-invalid @endif" placeholder="CI"
                                disabled name="ci_cli" required value="{{$perfilCliente->ci_cli}}">
                            @if($errors->has('ci_cli'))
                            <div class="ml-1 text-danger">
                                {{$errors->first('ci_cli')}}
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col">
                            <input type="text"
                                class="form-control form-control @if($errors->has('apellido_cli'))is-invalid @endif"
                                required placeholder="Apellido" name="apellido_cli"
                                value="@if($errors->has('apellido_cli')){{old('apellido_cli')}}@else{{$perfilCliente->apellido_cli}}@endif">
                            @if($errors->has('apellido_cli'))
                            <div class="ml-1 text-danger">
                                {{$errors->first('apellido_cli')}}
                            </div>
                            @endif
                        </div>
                        <div class="col">
                            <input type="text"
                                class="form-control form-control @if($errors->has('nombre_cli'))is-invalid @endif"
                                required placeholder="Nombre" name="nombre_cli"
                                value="@if($errors->has('nombre_cli')){{old('nombre_cli')}}@else{{$perfilCliente->nombre_cli}}@endif"
                                id="nombre_cli">
                            @if($errors->has('nombre_cli'))
                            <div class="ml-1 text-danger">
                                {{$errors->first('nombre_cli')}}
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    +593</span>
                            </div>
                            <input type="text" class="form-control @if($errors->has('celular_cli'))is-invalid @endif"
                                placeholder="Número celular sin el 0" name="celular_cli" maxlength="9" minlength="9"
                                value="@if($errors->has('celular_cli')){{old('celular_cli')}}@else{{$perfilCliente->celular_cli}}@endif">
                            @if($errors->has('celular_cli'))
                            <div class="ml-1 text-danger">
                                {{$errors->first('celular_cli')}}
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col">
                            <label for="sexo_cli">Sexo</label>
                            <select name="sexo_cli" class="form-control" id="sexo_cli">
                                @if($perfilCliente->sexo_cli == 'Hombre')
                                <option value="Hombre" selected>Hombre</option>
                                <option value="Mujer">Mujer</option>
                                @elseif($perfilCliente->sexo_cli == 'Mujer')
                                <option value="Hombre">Hombre</option>
                                <option value="Mujer" selected>Mujer</option>
                                @endif
                            </select>
                        </div>
                        <div class="col"
                            title="Tenga en cuenta que si no tiene registros de pagos no puede cambiar a tipo mensual">
                            <label for="tipo_cli">Tipo de suscripción</label>
                            <select name="tipo_cli" class="form-control" id="tipo_cli">
                                @if($perfilCliente->tipo_cli == 'Diario')
                                <option value="Diario" selected>Diario</option>
                                <option value="Diario Especial">Diario Especial</option>
                                <option value="Mensual">Mensual</option>
                                @elseif($perfilCliente->tipo_cli == 'Diario Especial')
                                <option value="Diario">Diario</option>
                                <option value="Diario Especial" selected>Diario Especial</option>
                                <option value="Mensual">Mensual</option>
                                @elseif($perfilCliente->tipo_cli == 'Mensual')
                                <option value="Diario">Diario</option>
                                <option value="Diario Especial">Diario Especial</option>
                                <option value="Mensual" selected>Mensual</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="nuevoPagoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="h2 text-gray-900">Selecciona una suscripción</span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if($pagoActual??'' === TRUE)
                <div class="alert alert-warning" role="alert">
                    <h4 class="alert-heading">Atención!</h4>
                    <p>
                        El cliente <span class="font-weight-bold">{{$perfilCliente->apellido_cli}}
                            {{$perfilCliente->nombre_cli}}</span> actualmente consta con un pago
                        vigente hasta el <strong>{{$first->isoFormat('dddd D \d\e MMMM \d\e\l YYYY')}}</strong>.
                    </p>
                </div>
                @endif
                <form action="{{route('pagos.add',$perfilCliente->ci_cli)}}" method="POST">
                    @CSRF
                    <div class="row justify-content-center mb-2">
                        <article class="">
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="tiempo" id="1mes" value="1" checked>
                                <label class="h3 form-check-label " for="1mes">
                                    <span class=" badge badge-primary">1 mes</span> <br>
                                    <span class="text-gray-900 text-xs">
                                        <strong>Desde: </strong>{{$hoy->isoFormat('dddd D \d\e MMMM \d\e\l YYYY')}}
                                        |
                                        <strong>Hasta:
                                        </strong>{{$mes->isoFormat('dddd D \d\e MMMM \d\e\l YYYY')}}
                                    </span>
                                </label>
                            </div>
                            <hr>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="tiempo" id="2semanas" value="2">
                                <label class="h3 form-check-label " for="2semanas">
                                    <span class=" badge badge-success">2 Semanas</span><br>
                                    <span class="text-gray-900 text-xs">
                                        <strong>Desde: </strong>{{$hoy->isoFormat('dddd D \d\e MMMM \d\e\l YYYY')}}
                                        |
                                        <strong>Hasta:
                                        </strong>{{$semana2->isoFormat('dddd D \d\e MMMM \d\e\l YYYY')}}
                                    </span>
                                </label>
                            </div>
                            <hr>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="tiempo" id="1semana" value="3">
                                <label class="h3 form-check-label " for="1semana">
                                    <span class=" badge badge-danger">1 semana</span> <br>
                                    <span class="text-gray-900 text-xs">
                                        <strong>Desde: </strong>{{$hoy->isoFormat('dddd D \d\e MMMM \d\e\l YYYY')}}
                                        |
                                        <strong>Hasta:
                                        </strong>{{$semana->isoFormat('dddd D \d\e MMMM \d\e\l YYYY')}}
                                    </span>
                                </label>
                            </div>
                            <hr>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="tiempo" id="otro" value="4">
                                <label class="h3 form-check-label" for="otro">Otro</label>
                            </div>
                            <div class="d-flex justify-content-around">
                                <div>
                                    <label for="desde_pago">Desde</label><br>
                                    <input class="form-control" type="date" name="desde_pago" id="desde_pago" readonly
                                        value="@if($errors->has('desde_pago')){{old('desde_pago')}}@else{{$hoy->isoFormat('Y-M-D')}}@endif">
                                </div>
                                <div>
                                    <label for="hasta_pago">Hasta</label><br>
                                    <input class="form-control" type="date" name="hasta_pago" id="hasta_pago" readonly
                                        value="@if($errors->has('hasta_pago')){{old('hasta_pago')}}@else{{$mes->isoFormat('Y-M-D')}}@endif">
                                </div>
                            </div>
                            <hr>
                    </div>
                    </article>
                    <div class="row mb-2">
                        <div class="col">
                            <input type="text" class="form-control" name="detalle_pag"
                                placeholder="Anotación (opcional)">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Registrar</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<!-- SCRIPS MOSTRAR MODAL SI NO CUMPLE VALIDACIÓN -->
@if($errors->any())
<script>
$(document).ready(function() {
    $("#editarClienteModal").modal("show");
});
</script>
@endif
<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
    'use strict';
    window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();
$(document).ready(function() {
    $("input[name='tiempo']").click(function() {
        if ($(this).val() == 4) {
            // alert("La edad seleccionada es: " + $(this).val());
            $("#desde_pago").removeAttr("readonly");
            $("#hasta_pago").removeAttr("readonly");

        } else {
            // alert("La edad seleccionada es: " + $(this).val());
            $("#desde_pago").attr("readonly", true);
            $("#hasta_pago").attr("readonly", true);
        }
    });
});
</script>
@endsection