@extends('public/ingreso/plantillaIngreso')
@section('fixed')
    fixed-top
@endsection
@section('home')
    active
@endsection
@section('main')
<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="{{asset('sources/img/fondo.png')}}"  width="1080" height="800" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="{{asset('sources/img/fondo2.png')}}" width="1080" height="800"  alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="{{asset('sources/img/fondo3.png')}}" width="1080" height="800"  alt="Third slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>
<div class="container">
    <div class="row mb-5">
        <div class="col-lg-4 col-sm-12">
            <div class="card mx-auto" style="width: 19rem;">
                <img src="{{asset('sources/img/fondo2.png')}}" class="card-img-top" alt="...">
                <div class="card-header bg-diario">
                    <h6 class="h1 text-gray-100">Subscripción diaria</h6>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        <ul>
                        <strong>Inluye</strong>
                            <li>Uso de maquinas y pesas</li>
                            <li>Caminadora</li>
                            <li>Bicicleta</li>
                        </ul>
                    </p>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <span class="btn btn-lg bg-diario text-gray-100">$2.00 <span class="text-xs">diarios</span></span>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-12">
            <div class="card mx-auto" style="width: 19rem;">
                <img src="{{asset('sources/img/fondo2.png')}}" class="card-img-top" alt="...">
                <div class="card-header bg-diario">
                    <h6 class="h1 text-gray-100">Subscripción mensual</h6>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        <ul>
                        <strong>Inluye</strong>
                            <li>Uso de maquinas y pesas</li>
                            <li>Caminadora</li>
                            <li>Bicicleta</li>
                        </ul>
                    </p>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <span class="btn btn-lg bg-diario text-gray-100">$20.00 <span class="text-xs">al mes</span></span>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-12">
            <div class="card mx-auto" style="width: 19rem;">
                <img src="{{asset('sources/img/fondo2.png')}}" class="card-img-top" alt="...">
                <div class="card-header bg-diario">
                    <h6 class="h1 text-gray-100">Rehabilitación física</h6>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        <ul>
                        <strong>Inluye</strong>
                            <li>Uso de maquinas y pesas</li>
                            <li>Caminadora</li>
                            <li>Bicicleta</li>
                        </ul>
                    </p>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <span class="btn btn-lg bg-diario text-gray-100">$25.00 <span class="text-xs">al mes</span></span>
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection
@section('js')
<script>
      $(window).scroll(function() {
        if ($("#menu").offset().top > 50) {
            $("#menu").addClass("bg-black-b");
        } else {
            $("#menu").removeClass("bg-black-b");
        }
      });
</script>
@endsection