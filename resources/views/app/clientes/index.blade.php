@extends('plantilla')
@section('gClientes_active')
active
@endsection
@section('nav')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('inicio')}}"> <i class="fa fa-home"></i> Inicio</a></li>
        <li class="breadcrumb-item active" aria-current="page">Clientes</li>
    </ol>
</nav>
@endsection
@section('main')
<div class="container-fluid">
    <!-- DONDE SE ENCUENTRA -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Gestión Clientes</h1>
    </div>
    <!-- AGREGAR -->
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            <button type="button" class="btn btn-primary my-4" data-toggle="modal" data-target="#registrarClienteModal"
                id="myBtn">
                <i class="fas fa-user-plus"></i>
                Nuevo Cliente
            </button>
        </div>
    </div>
    @if(session('exito'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Registro realizado!</strong> se ha agregado un cliente de manera exitosa. <strong><a
                href="{{route('clientes.perfil',session('new_cliente'))}}">Ver perfil</a></strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    @if(session('clienteDelete'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Cliente eliminado!</strong> se ha eliminado un cliente de manera exitosa.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <!-- TABLA -->
    <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between py-3">
            <h5 class="m-0 font-weight-bold text-danger">Registro de clientes</h5>
            <a href="{{route('descargar.pdf.clientes')}}" class="btn btn-danger" target="blank">
                <i class="far fa-file-pdf"></i>
                Generar PDF
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-gym table-dark table-bordered" id="clientesTable" width="100%"
                    cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th class="w-150px">CI</th>
                            <th>Apellido</th>
                            <th>Nombre</th>
                            <th>Tipo</th>
                            <th class="w-150px"><i class="fas fa-info-circle"></i> Info</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($lista_clientes as $item)
                        <tr>
                            <td>{{$item->ci_cli}}</td>
                            <td>{{$item->apellido_cli}}</td>
                            <td>{{$item->nombre_cli}}</td>
                            <td>{{$item->tipo_cli}}</td>
                            <td class="w-150px d-flex justify-content-center"><a
                                    href="{{route('clientes.perfil',$item->ci_cli)}}"
                                    class="btn btn-sm btn-primary w-75px">Perfil</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('modal')
<div class="modal fade" id="registrarClienteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('clientes.add')}}" method="POST" class="needs-validation" novalidate
                    autocomplete="off">
                    @CSRF
                    <div class="row mb-2">
                        <div class="col">
                            <!-- AGREGAR (is-valid) 0 (is-invalid) para mostrar el estado de un input -->
                            <input type="text" maxlength="10" minlength="10"
                                class="form-control @if($errors->has('ci_cli'))is-invalid @endif" placeholder="CI"
                                name="ci_cli" required value="{{old('ci_cli')}}">
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
                                required placeholder="Apellido" name="apellido_cli" value="{{old('apellido_cli')}}">
                            @if($errors->has('apellido_cli'))
                            <div class="ml-1 text-danger">
                                {{$errors->first('apellido_cli')}}
                            </div>
                            @endif
                        </div>
                        <div class="col">
                            <input type="text"
                                class="form-control form-control @if($errors->has('nombre_cli'))is-invalid @endif"
                                required placeholder="Nombre" name="nombre_cli" value="{{old('nombre_cli')}}"
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
                                value="{{old('celular_cli')}}">
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
                                <option value="Hombre">Hombre</option>
                                <option value="Mujer">Mujer</option>
                            </select>
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
<!-- SCRIPS MOSTRAR MODAL SI NO CUMPLE VALIDACION -->
@if($errors->any())
<script>
$(document).ready(function() {
    $("#registrarClienteModal").modal("show");
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
</script>
@endsection
@section('nombre_cli')

@endsection

<!-- https://api.whatsapp.com/send?phone=593999999239&text=Hola PARA enviar mensaje a wsp -->