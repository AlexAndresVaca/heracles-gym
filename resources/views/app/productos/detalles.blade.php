@extends('plantilla')
@section('gProductos_active')
active
@endsection
@section('nav')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('inicio')}}"><i class="fa fa-home"></i> Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{route('productos.index')}}">Productos</a></li>
        <li class="breadcrumb-item active" aria-current="page">Detalles</li>
    </ol>
</nav>
@endsection
@section('main')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <!-- DONDE SE ENCUENTRA -->
        <h1 class="h3 mb-0 text-gray-800">Detalles de producto: <strong
                class="text-gray-900 text-uppercase">{{$producto->detalle_prod}}</strong>
            <span class="text-xs">P00-{{$producto->cod_prod}}</span>
        </h1>
    </div>
    @if(session('mensaje_exito')==TRUE)
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Datos de producto actualizados!</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <div class="card">
        <div class="card-header">
            <h6>Editar información</h6>
        </div>
        <form method="POST" class="needs-validation" action="{{route('productos.detalles.update',$producto)}}"
            novalidate>
            @CSRF
            <div class="card-body">
                <div class="form-row">
                    <div class="col-md-9 mb-3">
                        <label for="detalle_prod">Descripción</label>
                        <!-- AGREGAR is-valid si no tiene errores o is-invalid si tiene errores !!Si tiene errores automaticamente carga el feedback -->
                        <input type="text" class="form-control @if($errors->has('detalle_prod')) is-invalid @endif"
                            id="detalle_prod" name="detalle_prod" value="{{$producto->detalle_prod}}" required>
                        @if($errors->has('detalle_prod'))
                        <div class="invalid-feedback">
                            <!-- CARGAR AQUI LOS ERRORES DE VALIDACION -->
                            {{$errors->first('detalle_prod')}}
                        </div>
                        @endif
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="stock_prod">Stock</label>
                        <input type="number" class="form-control  @if($errors->has('stock_prod')) is-invalid @endif"
                            id="stock_prod" name="stock_prod" value="{{$producto->stock_prod}}" required>
                        @if($errors->has('stock_prod'))
                        <div class="invalid-feedback">
                            <!-- CARGAR AQUI LOS ERRORES DE VALIDACION -->
                            {{$errors->first('stock_prod')}}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-around card-footer ">
                <a href="{{route('productos.index')}}"><button type="button" class="btn btn-outline-secondary"><i
                            class="fas fa-chevron-left"></i> Volver</button></a>
                <button class="btn btn-primary" type="submit">Guardar cambios</button>
            </div>
        </form>
    </div>
</div>
@endsection
@section('js')
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