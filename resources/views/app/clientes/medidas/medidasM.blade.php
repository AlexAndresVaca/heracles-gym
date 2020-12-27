@extends('plantilla') 
@section('gClientes_active')
 active 
@endsection 
@section('nav')
<nav aria-label="breadcrumb stu">
  <ol class="breadcrumb mb-1" >
    <li class="breadcrumb-item"><a href="{{route('inicio')}}"><i class="fa fa-home"></i> Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{route('clientes.index')}}">Clientes</a></li>
    <li class="breadcrumb-item active" aria-current="page"><a href="{{route('clientes.perfil',$perfilCliente->ci_cli)}}">Perfil</a></li>
    <li class="breadcrumb-item active" aria-current="page">Ver medida</li>
  </ol>
</nav>
@endsection
@section('main')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <!-- Cambiar Menu por nombre de la pagina donde se encuentre -->
        <h1 class="h1 mb-0 text-gray-800">Resultados</h1>
    </div>
    <!-- Content Row MAIN-->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold text-black">Fecha de registro <strong>{{$medida->created_at->isoFormat('dddd D \d\e MMMM \d\e\l YYYY')}}</strong> ({{$perfilCliente->apellido_cli}} {{$perfilCliente->nombre_cli}})</h5>
        </div>
        <div class="card-body">
            <form>
                <div class="form-row">
                    <span class="h3 col-md-3 mr-3 text-gray-800">Datos generales:</span>
                    <div class="col-lg-2 mb-3">
                        <label for="peso">Peso</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="peso" disabled value="{{$medida->peso_med}}">
                            <div class="input-group-append">
                                <span class="input-group-text">kg</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 mb-3">
                        <label for="talla">Talla</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="talla" disabled value="{{$medida->talla_med}}">
                            <div class="input-group-append">
                                <span class="input-group-text">m</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="dropdown-divider"></div>
                <div class="form-row">
                    <span class="h3 col-md-3 mr-3 text-gray-800">Parte superior: </span>
                    <div class="col-md-2 mb-3">
                        <label for="biceps">Biceps</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="biceps" disabled value="{{$medida->biceps_med}}">
                            <div class="input-group-append">
                                <span class="input-group-text">cm</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="triceps">Triceps</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="triceps" disabled value="{{$medida->triceps_med}}">
                            <div class="input-group-append">
                                <span class="input-group-text">cm</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="cintura">Cintura</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="cintura" disabled value="{{$medida->cintura_med}}">
                            <div class="input-group-append">
                                <span class="input-group-text">cm</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="torax">Tórax</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="torax" disabled value="{{$medida->toraxM_med}}">
                            <div class="input-group-append">
                                <span class="input-group-text">cm</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <span class="h3 col-md-3 mr-3 text-gray-800"></span>
                    <div class="col-md-2 mb-3">
                        <label for="cadera">Cadera</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="cadera" disabled value="{{$medida->caderaM_med}}">
                            <div class="input-group-append">
                                <span class="input-group-text">cm</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="dropdown-divider"></div>
                <div class="form-row">
                    <span class="h3 col-md-3 mr-3 text-gray-800">Parte Inferior: </span>
                    <div class="col-md-2 mb-3">
                        <label for="pantorrilla">Pantorrillas</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="pantorrilla" disabled value="{{$medida->pantorrillas_med}}">
                            <div class="input-group-append">
                                <span class="input-group-text">cm</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="muslo1">Muslo 1</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="muslo1" disabled value="{{$medida->muslo1_med}}">
                            <div class="input-group-append">
                                <span class="input-group-text">cm</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="muslo2">Muslo2</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="muslo2" disabled value="{{$medida->muslo2_med}}">
                            <div class="input-group-append">
                                <span class="input-group-text">cm</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="muslo3">Muslo 3</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="muslo3" disabled value="{{$medida->muslo3M_med}}">
                            <div class="input-group-append">
                                <span class="input-group-text">cm</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <span class="h3 col-md-3 mr-3 text-gray-800"></span>
                    <div class="col-md-2 mb-3">
                        <label for="gluteos">Gluteos</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="gluteos" disabled value="{{$medida->gluteosM_med}}">
                            <div class="input-group-append">
                                <span class="input-group-text">cm</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="dropdown-divider"></div>
                <div class="my-5">
                </div>
                <div class="form-row">
                    <div class="col d-flex justify-content-around">
                        <a href="{{route('clientes.perfil',$perfilCliente->ci_cli)}}"
                            class="btn btn-outline-secondary"><i class="fas fa-chevron-left"></i> Volver</a>
                        <button type="button" class="btn btn-danger" data-toggle="modal"
                            data-target="#confirmacionBorrar">Eliminar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('modal')
<div class="modal fade" id="confirmacionBorrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Desea borrar el registro?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">No podrá recuperar la información que almacena este registro.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                <form action="{{route('clientes.medidas.delete',$medida)}}" method="post">
                    @CSRF
                    <button class="btn btn-danger " type="submit">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection