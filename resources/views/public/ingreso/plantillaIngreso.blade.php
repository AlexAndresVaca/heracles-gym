<!DOCTYPE html>
<html lang="es_EC">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>HERACLES GYM</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('sources/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('sources/css/sb-admin-2.min.css')}}" rel="stylesheet">
    <link href="{{asset('sources/css/custom.css')}}" rel="stylesheet">
    <!-- CSS AUTOCOMPLETAR -->
    <link rel="stylesheet" href="{{asset('sources/css/jquery-ui.css')}}">
    <!-- CSS TABLAS -->
    <link href="{{asset('sources/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    @yield('css')
</head>

<body id="page-top">
    <div class="container-fluid @yield('bg')">
        <div class="container">
            <nav class="navbar @yield('fixed') navbar-expand-lg navbar-dark" id="menu">
                <a class="navbar-brand" href="#">
                    <img src="{{asset('sources/img/logo3.png')}}" width="250" height="80"
                        class="d-inline-block align-top" alt="" loading="lazy">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
                    aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="row justify-content-end collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item @yield('ingreso')">
                            <a class="nav-link" href="{{route('heracles.ingreso')}}">Ingreso</a>
                        </li>
                        <li class="nav-item @yield('consulta')">
                            <a class="nav-link" href="{{route('heracles.consulta')}}">Consulta de subcripcion</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
    <div class="container-fluid  bg-light p-0">
        @yield('main')
        <footer class="sticky-footer bg-black">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; <a class="text-gray-600" href="{{route('inicio')}}">HERACLES GYM 2020</a></span>
                </div>
            </div>
        </footer>
    </div>


    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('sources/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('sources/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('sources/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('sources/js/sb-admin-2.min.js')}}"></script>

    <!-- AUTOCOMPLETAR SCRIP -->
    <script src="{{asset('sources/js/jquery-ui.min.js')}}"></script>
    <!--  -->
    <!-- Page level plugins -->
    <script src="{{asset('sources/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('sources/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('sources/js/demo/datatables-demo.js')}}"></script>
    @yield('js')
   
</body>

</html>