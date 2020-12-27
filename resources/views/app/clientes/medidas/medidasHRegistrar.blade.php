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
        <hr class="my-4">
        <p>Para volver a ingresar un registro regresa mañana o puedes eliminar el registro de hoy.</p>
        <a class="btn btn-outline-secondary btn-lg" href="{{route('clientes.perfil',$perfilCliente->ci_cli)}}" role="button"><i class="fas fa-chevron-left"></i> Volver</a>
    </div>
    </div>
    @elseif($puedeCrear == TRUE)
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-black">Nueva toma de medidas (Hombre)</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('clientes.medidas.new',$perfilCliente->ci_cli)}}" autocomplete="off">
                @CSRF
                <div class="form-row">
                    <span class="h3 col-md-3 mr-3 text-gray-800">Datos generales:</span>
                    <div class="col-lg-2 mb-3">
                        <label for="peso">Peso</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="peso" value="{{old('peso_med')}}" placeholder="0.0" name="peso_med">
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
                            <input type="text" class="form-control" id="talla" value="{{old('talla_med')}}" placeholder="0.0" name="talla_med">
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
                            <input type="text" class="form-control" id="biceps" value="{{old('biceps_med')}}" placeholder="0.0" name="biceps_med">
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
                            <input type="text" class="form-control" id="triceps" value="{{old('triceps_med')}}" placeholder="0.0" name="triceps_med">
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
                            <input type="text" class="form-control" id="cintura" value="{{old('cintura_med')}}" placeholder="0.0" name="cintura_med">
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
                        <label for="espalda">Espalda</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="espalda" value="{{old('espaldaH_med')}}" placeholder="0.0" name="espaldaH_med">
                            <div class="input-group-append">
                                <span class="input-group-text">cm</span>
                            </div>
                        </div>
                        @if($errors->has('espaldaH_med'))
                        <div class="ml-1" style="color:red;">
                            {{$errors->first('espaldaH_med')}}
                        </div>
                        @endif
                    </div>
                </div>
                <div class="form-row">
                    <span class="h3 col-md-3 mr-3 text-gray-800"></span>
                    <div class="col-md-2 mb-3">
                        <label for="pectoral">Pectoral</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="pectoral" value="{{old('pectoralH_med')}}" placeholder="0.0" name="pectoralH_med">
                            <div class="input-group-append">
                                <span class="input-group-text">cm</span>
                            </div>
                        </div>
                        @if($errors->has('pectoralH_med'))
                        <div class="ml-1" style="color:red;">
                            {{$errors->first('pectoralH_med')}}
                        </div>
                        @endif
                    </div>
                </div>
                <div class="dropdown-divider"></div>
                <div class="form-row">
                    <span class="h3 col-md-3 mr-3 text-gray-800">Parte Inferior: </span>
                    <div class="col-md-2 mb-3">
                        <label for="muslo1">Muslo 1</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="muslo1" value="{{old('muslo1_med')}}" placeholder="0.0" name="muslo1_med">
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
                            <input type="text" class="form-control" id="muslo2" value="{{old('peso_med')}}" placeholder="0.0" name="muslo2_med">
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
                        <label for="pantorrilla">Pantorrillas</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="pantorrilla" value="{{old('pantorrillas_med')}}" placeholder="0.0" name="pantorrillas_med">
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
                </div>
                <div class="dropdown-divider"></div>
                <div class="my-5">
                </div>
                <div class="form-row">
                    <div class="col">
                        <a href="{{route('clientes.perfil',$perfilCliente->ci_cli)}}" class="btn btn-outline-secondary"><i class="fas fa-chevron-left"></i> Volver</a>
                    </div>
                    <div class="col">
                        <button class="btn btn-primary" type="submit">Registrar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endif
    <!-- Content Row FIN MAIN-->
</div>
@endsection