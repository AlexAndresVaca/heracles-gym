@extends('plantilla')
@section('tienda_active')
active
@endsection
@section('nav')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page"><a><i class="fa fa-store"></i> Tienda</a></li>
    </ol>
</nav>
@endsection
@section('main')
<div class="dropdown-divider"></div>
<div class="container-fluid">
    <div class="card my-4">
        <h5 class="card-header ">Vender un producto</h5>
        <div class="card-body">
            @if(session('venta_exito')== TRUE)
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Venta registrada!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            @if(session('error_stock')== TRUE)
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>No tienes el stock suficiente para realizar la venta!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            @if(session('devolucion_exito')==TRUE)
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <strong>Se devolvió un producto!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <form method="POST" action="{{route('tienda.vender.productos')}}" class="needs-validation" novalidate>
                @CSRF
                <div class="row">
                    <div class="col-lg-4 my-2 col-sm-12">
                        <input type="text" id="autocompleteID" name="cod_prod_venta" hidden>
                        <input type="text"
                            class="form-control @if($errors->has('detalle_prod_venta')) is-invalid @endif"
                            name="detalle_prod_venta" id="autocomplete" placeholder="Producto"
                            value="{{old('detalle_prod_venta')}}">
                        @if($errors->has('detalle_prod_venta'))
                        <div class="invalid-feedback">
                            <!-- CARGAR AQUI LOS ERRORES DE VALIDACION -->
                            <h6 class="ml-2">{{$errors->first('detalle_prod_venta')}}</h6>
                        </div>
                        @endif
                    </div>
                    <div class="col-lg-4 my-2 col-sm-12">
                        <input type="number"
                            class="form-control col-lg-5 @if($errors->has('cantidad_prod_venta')) is-invalid @endif"
                            name="cantidad_prod_venta" placeholder="Cant" value="{{old('cantidad_prod_venta')}}">
                        @if($errors->has('cantidad_prod_venta'))
                        <div class="invalid-feedback">
                            <!-- CARGAR AQUI LOS ERRORES DE VALIDACION -->
                            <h6 class="">{{$errors->first('cantidad_prod_venta')}}</h6>
                        </div>
                        @endif
                    </div>
                    <div class="col-lg-4 my-2 col-sm-12">
                        <button type="submit" class="btn btn-success btn-block">
                            <i class="fas fa-cash-register"></i> Vender
                        </button>
                    </div>
                </div>
            </form>
            <form method="POST" action="{{route('tienda.devolver.productos')}}">
                @CSRF
                <div class="row">
                    <div class="col-lg-4 my-2 col-sm-12">
                        <input type="text" id="autocomplete2ID" name="cod_prod_devolucion"
                            value="{{old('cod_prod_devolucion')}}" hidden>
                        <input type="text"
                            class="form-control @if($errors->has('detalle_prod_devolucion')) is-invalid @endif"
                            id="autocomplete2" placeholder="Producto" name="detalle_prod_devolucion"
                            value="{{old('detalle_prod_devolucion')}}">
                        @if($errors->has('detalle_prod_devolucion'))
                        <div class="invalid-feedback">
                            <!-- CARGAR AQUI LOS ERRORES DE VALIDACION -->
                            <h6 class="ml-2">{{$errors->first('detalle_prod_devolucion')}}</h6>
                        </div>
                        @endif
                    </div>
                    <div class="col-lg-4 my-2 col-sm-12">
                        <input type="number"
                            class="form-control col-lg-5 @if($errors->has('cantidad_prod_devolucion')) is-invalid @endif"
                            name="cantidad_prod_devolucion" placeholder="Cant"
                            value="{{old('cantidad_prod_devolucion')}}">
                        @if($errors->has('cantidad_prod_devolucion'))
                        <div class="invalid-feedback">
                            <!-- CARGAR AQUI LOS ERRORES DE VALIDACION -->
                            <h6 class="ml-2">{{$errors->first('cantidad_prod_devolucion')}}</h6>
                        </div>
                        @endif
                    </div>
                    <div class="col-lg-4 my-2 col-sm-12">
                        <button type="submit" class="btn btn-danger btn-block">
                            <i class="fas fa-cash-register"></i> Devolver
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card my-4">
        <h5 class="card-header">Abastecer productos</h5>
        <div class="card-body">
            @if(session('abastecer_exito')==TRUE)
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <strong>Se abasteció con éxito el producto!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <form method="POST" action="{{route('tienda.abastecer.productos')}}">
                @CSRF
                <div class="row">
                    <div class="col-lg-4 my-2 col-sm-12">
                        <input type="text" id="autocomplete3ID" name="cod_prod_abastecer" readonly hidden>
                        <input type="text"
                            class="form-control @if($errors->has('detalle_prod_abastecer')) is-invalid @endif"
                            name="detalle_prod_abastecer" id="autocomplete3" placeholder="Producto" value="{{old('detalle_prod_abastecer')}}">
                        @if($errors->has('detalle_prod_abastecer'))
                        <div class="invalid-feedback">
                            <!-- CARGAR AQUI LOS ERRORES DE VALIDACION -->
                            <h6 class="ml-2">{{$errors->first('detalle_prod_abastecer')}}</h6>
                        </div>
                        @endif
                    </div>
                    <div class="col-lg-4 my-2 col-sm-12">
                        <input type="number"
                            name="cantidad_prod_abastecer"
                            class="form-control col-lg-5 @if($errors->has('cantidad_prod_abastecer')) is-invalid @endif"
                            placeholder="Cant" value="{{old('cantidad_prod_abastecer')}}">
                        @if($errors->has('cantidad_prod_abastecer'))
                        <div class="invalid-feedback">
                            <!-- CARGAR AQUI LOS ERRORES DE VALIDACION -->
                            <h6 class="ml-2">{{$errors->first('cantidad_prod_abastecer')}}</h6>
                        </div>
                        @endif
                    </div>
                    <div class="col-lg-4 my-2 col-sm-12">
                        <button type="submit" class="btn btn-info btn-block">
                            <i class="fas fa-store"></i> Abastecer
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
$('#autocomplete').autocomplete({
    // Sugiere el primer elemento en azul
    autoFocus: true,
    // Recupera la informacion mediante una solicitud ajax
    source: function(request, response) {
        $.ajax({
            url: "{{route('tienda.autocompletar')}}",
            dataType: 'json',
            data: {
                term: request.term
            },
            success: function(data) {
                response(data);
            }
        });
    },
    // Evita que el valor cambie con la tecla arriba y abajo
    focus: function(e, ui) {
        return false;
    },
    // A menos que elija una opción tendrá valor caso contrario sera null
    change: function(event, ui) {
        if (!ui.item) {
            $("#autocomplete").val(null);
            $("#autocompleteID").val(null);
        }
    },
    // Coloca los valores obtenidos en la consulta (Hay que ocultar el campo ID)
    select: function(event, ui) {
        $('#autocomplete').val(ui.item.label);
        $('#autocompleteID').val(ui.item.value);
        return false;
    }
});
$('#autocomplete2').autocomplete({
    // Sugiere el primer elemento en azul
    autoFocus: true,
    // Recupera la informacion mediante una solicitud ajax
    source: function(request, response) {
        $.ajax({
            url: "{{route('tienda.autocompletar')}}",
            dataType: 'json',
            data: {
                term: request.term
            },
            success: function(data) {
                response(data);
            }
        });
    },
    // Evita que el valor cambie con la tecla arriba y abajo
    focus: function(e, ui) {
        return false;
    },
    // A menos que elija una opción tendrá valor caso contrario sera null
    change: function(event, ui) {
        if (!ui.item) {
            $("#autocomplete2").val(null);
            $("#autocomplete2ID").val(null);
        }
    },
    // Coloca los valores obtenidos en la consulta (Hay que ocultar el campo ID)
    select: function(event, ui) {
        $('#autocomplete2').val(ui.item.label);
        $('#autocomplete2ID').val(ui.item.value);
        return false;
    }
});
$('#autocomplete3').autocomplete({
    // Sugiere el primer elemento en azul
    autoFocus: true,
    // Recupera la informacion mediante una solicitud ajax
    source: function(request, response) {
        $.ajax({
            url: "{{route('tienda.autocompletar')}}",
            dataType: 'json',
            data: {
                term: request.term
            },
            success: function(data) {
                response(data);
            }
        });
    },
    // Evita que el valor cambie con la tecla arriba y abajo
    focus: function(e, ui) {
        return false;
    },
    // A menos que elija una opción tendrá valor caso contrario sera null
    change: function(event, ui) {
        if (!ui.item) {
            $("#autocomplete3").val(null);
            $("#autocomplete3ID").val(null);
        }
    },
    // Coloca los valores obtenidos en la consulta (Hay que ocultar el campo ID)
    select: function(event, ui) {
        $('#autocomplete3').val(ui.item.label);
        $('#autocomplete3ID').val(ui.item.value);
        return false;
    }
});
</script>
@endsection