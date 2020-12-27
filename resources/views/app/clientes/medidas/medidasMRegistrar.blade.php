@extends('plantilla')
@section('gClientes_active')
active
@endsection
@section('nav')
<nav aria-label="breadcrumb stu">
    <ol class="breadcrumb mb-1">
        <li class="breadcrumb-item"><a href="{{route('inicio')}}"><i class="fa fa-home"></i> Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{route('clientes.index')}}">Clientes</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a
                href="{{route('clientes.perfil',$perfilCliente->ci_cli)}}">Perfil</a></li>
        <li class="breadcrumb-item active" aria-current="page">Nueva medida</li>
    </ol>
</nav>
@endsection
@section('main')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <!-- Cambiar Menu por nombre de la pagina donde se encuentre -->
        <h1 class="h1 mb-0 text-gray-800">Registro de medidas</h1>
    </div>
    <!-- Content Row MAIN-->
    @if($puedeCrear == FALSE)
    <!-- CAMBIAR POR OTRA ALERTA MAS GRANDE -->
    <div class="container-fluid px-0 mx-0 shadow">
    <div class="jumbotron bg-black">
        <h1 class="display-4 text-danger">Registro de medidas bloqueado!</h1>
        <p class="lead">Este cliente ya posee un registro del día de hoy!</p>
        <hr class="my-4 border-light">
        <p>Para volver a ingresar un registro regresa mañana o puedes eliminar el registro de hoy.</p>
        <a class="btn btn-outline-secondary btn-lg" href="{{route('clientes.perfil',$perfilCliente->ci_cli)}}" role="button"><i class="fas fa-chevron-left"></i> Volver</a>
    </div>
    </div>
    @elseif($puedeCrear == TRUE)
    <!--  -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-black">Nueva toma de medidas (Mujer)</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('clientes.medidas.new',$perfilCliente->ci_cli)}}" autocomplete="off">
                @CSRF
                <div class="form-row">
                    <span class="h3 col-md-3 mr-3 text-gray-800">Datos generales:</span>
                    <div class="col-lg-2 mb-3">
                        <label for="peso">Peso</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="peso" name="peso_med"
                                value="{{old('peso_med')}}" placeholder="0.0">
                            <div class="input-group-append">
                                <span class="input-group-text">kg</span>
                            </div>
                        </div>
                        @if($errors->has('peso_med'))
                        <div class="ml-1" style="color:red;">
                            {{$errors->first('peso_med')}}
                        </div>
                        @endif
                    </div>
                    <div class="col-lg-2 mb-3">
                        <label for="talla">Talla</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="talla" name="talla_med"
                                value="{{old('talla_med')}}" placeholder="0.0">
                            <div class="input-group-append">
                                <span class="input-group-text">m</span>
                            </div>
                        </div>
                        @if($errors->has('talla_med'))
                        <div class="ml-1" style="color:red;">
                            {{$errors->first('talla_med')}}
                        </div>
                        @endif
                    </div>
                </div>
                <div class="dropdown-divider"></div>
                <div class="form-row">
                    <span class="h3 col-md-3 mr-3 text-gray-800">Parte superior: </span>
                    <div class="col-md-2 mb-3">
                        <label for="biceps">Biceps</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="biceps" name="biceps_med"
                                value="{{old('biceps_med')}}" placeholder="0.0">
                            <div class="input-group-append">
                                <span class="input-group-text">cm</span>
                            </div>
                        </div>
                        @if($errors->has('biceps_med'))
                        <div class="ml-1" style="color:red;">
                            {{$errors->first('biceps_med')}}
                        </div>
                        @endif
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="triceps">Triceps</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="triceps" name="triceps_med"
                                value="{{old('triceps_med')}}" placeholder="0.0">
                            <div class="input-group-append">
                                <span class="input-group-text">cm</span>
                            </div>
                        </div>
                        @if($errors->has('triceps_med'))
                        <div class="ml-1" style="color:red;">
                            {{$errors->first('triceps_med')}}
                        </div>
                        @endif
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="cintura">Cintura</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="cintura" name="cintura_med"
                                value="{{old('cintura_med')}}" placeholder="0.0">
                            <div class="input-group-append">
                                <span class="input-group-text">cm</span>
                            </div>
                        </div>
                        @if($errors->has('cintura_med'))
                        <div class="ml-1" style="color:red;">
                            {{$errors->first('cintura_med')}}
                        </div>
                        @endif
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="torax">Tórax</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="torax" name="toraxM_med"
                                value="{{old('torax_med')}}" placeholder="0.0">
                            <div class="input-group-append">
                                <span class="input-group-text">cm</span>
                            </div>
                        </div>
                        @if($errors->has('toraxM_med'))
                        <div class="ml-1" style="color:red;">
                            {{$errors->first('toraxM_med')}}
                        </div>
                        @endif
                    </div>
                </div>
                <div class="form-row">
                    <span class="h3 col-md-3 mr-3 text-gray-800"></span>
                    <div class="col-md-2 mb-3">
                        <label for="cadera">Cadera</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="cadera" name="caderaM_med"
                                value="{{old('caderaM_med')}}" placeholder="0.0">
                            <div class="input-group-append">
                                <span class="input-group-text">cm</span>
                            </div>
                        </div>
                        @if($errors->has('caderaM_med'))
                        <div class="ml-1" style="color:red;">
                            {{$errors->first('caderaM_med')}}
                        </div>
                        @endif
                    </div>
                </div>
                <div class="dropdown-divider"></div>
                <div class="form-row">
                    <span class="h3 col-md-3 mr-3 text-gray-800">Parte Inferior: </span>
                    <div class="col-md-2 mb-3">
                        <label for="pantorrilla">Pantorrillas</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="pantorrilla" name="pantorrillas_med"
                                value="{{old('pantorrillas_med')}}" placeholder="0.0">
                            <div class="input-group-append">
                                <span class="input-group-text">cm</span>
                            </div>
                        </div>
                        @if($errors->has('pantorrillas_med'))
                        <div class="ml-1" style="color:red;">
                            {{$errors->first('pantorrillas_med')}}
                        </div>
                        @endif
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="muslo1">Muslo 1</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="muslo1" name="muslo1_med"
                                value="{{old('muslo1_med')}}" placeholder="0.0">
                            <div class="input-group-append">
                                <span class="input-group-text">cm</span>
                            </div>
                        </div>
                        @if($errors->has('muslo1_med'))
                        <div class="ml-1" style="color:red;">
                            {{$errors->first('muslo1_med')}}
                        </div>
                        @endif
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="muslo2">Muslo2</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="muslo2" name="muslo2_med"
                                value="{{old('muslo2_med')}}" placeholder="0.0">
                            <div class="input-group-append">
                                <span class="input-group-text">cm</span>
                            </div>
                        </div>
                        @if($errors->has('muslo2_med'))
                        <div class="ml-1" style="color:red;">
                            {{$errors->first('muslo2_med')}}
                        </div>
                        @endif
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="muslo3">Muslo 3</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="muslo3" name="muslo3M_med"
                                value="{{old('muslo3_med')}}" placeholder="0.0">
                            <div class="input-group-append">
                                <span class="input-group-text">cm</span>
                            </div>
                        </div>
                        @if($errors->has('muslo3M_med'))
                        <div class="ml-1" style="color:red;">
                            {{$errors->first('muslo3M_med')}}
                        </div>
                        @endif
                    </div>
                </div>
                <div class="form-row">
                    <span class="h3 col-md-3 mr-3 text-gray-800"></span>
                    <div class="col-md-2 mb-3">
                        <label for="gluteos">Glúteos</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="gluteos" name="gluteosM_med"
                                value="{{old('gluteosM_med')}}" placeholder="0.0">
                            <div class="input-group-append">
                                <span class="input-group-text">cm</span>
                            </div>
                        </div>
                        @if($errors->has('gluteosM_med'))
                        <div class="ml-1" style="color:red;">
                            {{$errors->first('gluteosM_med')}}
                        </div>
                        @endif
                    </div>
                </div>
                <div class="dropdown-divider"></div>
                <div class="my-5">
                </div>
                <div class="form-row">
                    <div class="col-6">
                        <a href="{{route('clientes.perfil',$perfilCliente->ci_cli)}}"
                            class="btn btn-outline-secondary"><i class="fas fa-chevron-left"></i> Volver</a>
                    </div>
                    <div class="col-6">
                        <button class="btn btn-primary" type="submit">Registrar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>
@endsection