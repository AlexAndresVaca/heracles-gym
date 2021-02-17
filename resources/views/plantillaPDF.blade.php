<!DOCTYPE html>
<html lang="es_EC">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>HERACLES GYM - Inicio</title>
    <!-- Custom fonts for this template-->
    <link href="{{asset('sources/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="{{asset('sources/css/sb-admin-2.min.css')}}" rel="stylesheet">
    <link href="{{asset('sources/css/custom.css')}}" rel="stylesheet">
    <!-- CSS AUTO-COMPLETAR -->
    <link rel="stylesheet" href="{{asset('sources/css/jquery-ui.css')}}">
    <!-- CSS TABLAS -->
    <link href="{{asset('sources/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    @yield('css')
</head>
<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper" class="sidebar-toggled">
        <!-- Sidebar Menu Lateral -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('inicio')}}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-dumbbell"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Heracles GYM</div>
            </a>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <!-- Nav Item - Dashboard -->
            <li class="nav-item @yield('home_active') ">
                <a class="nav-link" href="{{route('inicio')}}">
                    <i class="fas fa-home"></i>
                    <span>Inicio</span></a>
            </li>
            <!-- <hr class="sidebar-divider my-0"> -->
            <li class="nav-item @yield('tienda_active') ">
                <!-- <a class="nav-link" href="{{route('tienda')}}">
                    <i class="fas fa-store"></i>
                    <span>Tienda</span></a> -->
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Sección Clientes -->
            <div class="sidebar-heading">
                Clientes
            </div>
            <li class="nav-item @yield('gClientes_active')">
                <a class="nav-link" href="{{route('clientes.index')}}">
                    <i class="fas fa-book-reader"></i>
                    <span>Gestión de Clientes</span></a>
            </li>
            <!-- Fin Sección Clientes -->
            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Divider -->
            <!-- Heading LISTA DESPLEGABLE-->
            <div class="sidebar-heading">
                Estadísticas
            </div>
            <!-- Nav Item - Pages Collapse Menu Lista del menu desplegable -->
            <li class="nav-item @yield('reportes_active')">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#listaReportes" aria-expanded="true" aria-controls="listaReportes">
                    <i class="fas fa-chart-bar"></i>
                    <span>Reportes</span>
                </a>
                <div id="listaReportes" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Tipo de reporte</h6>
                        <a class="collapse-item" href="{{route('reportes.diario')}}">Reporte diario</a>
                        <a class="collapse-item" href="{{route('reportes.mensual')}}">Reporte mensual</a>
                    </div>
                </div>
            </li>
            <!-- <hr class="sidebar-divider"> -->
            <!-- Heading -->
            <!-- <div class="sidebar-heading">
                Productos
            </div> -->
            <!-- Nav Item - Charts -->
            <!-- <li class="nav-item @yield('gProductos_active')">
                <a href="{{route('productos.index')}}" class="nav-link">
                    <i class="fa fa-box-open rotate-n-15" aria-hidden="true"></i>
                    <span>Gestión de productos</span>
                </a>
            </li> -->
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
            <!-- Heading -->
            <div class="sidebar-heading">
                Asistencias
            </div>
            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a href="{{route('heracles.ingreso')}}" class="nav-link">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <span>Acceso Clientes</span>
                </a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-black topbar relative-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Divisor antes de llegar a información del usuario-->
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <!-- Nav Item - User Information | Información usuario -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline small text-uppercase">{{$usuario}}</span>
                                <!-- Cambiar por imagen Heracles -->
                                <img class="img-profile rounded-circle" src="{{asset('sources/img/avatar.svg')}}" sizes="60x60">
                            </a>
                            <!-- Dropdown - User Information Menu desplegado opciones de usuario -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i> Perfil
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Cerrar sesión
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->
                @yield('nav')
                @yield('main')
            </div>
            <!-- End of Main Content -->
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; HERACLES GYM 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    @yield('modal')
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Deseas cerrar sesión?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Selecciona el botón cerrar sesión para salir.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <form action="{{route('cerrarSesion')}}" method="post">
                        @CSRF
                        <button class="btn btn-danger" type="submit">Cerrar Sesión</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('sources/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('sources/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- Core plugin JavaScript-->
    <script src="{{asset('sources/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
    <!-- Custom scripts for all pages-->
    <script src="{{asset('sources/js/sb-admin-2.min.js')}}"></script>
    <!-- AUTO-COMPLETAR SCRIP -->
    <script src="{{asset('sources/js/jquery-ui.min.js')}}"></script>
    <!--  -->
    <!-- Page level plugins -->
    <script src="{{asset('sources/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('sources/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <!-- Page level custom scripts -->
    <script src="{{asset('sources/js/demo/datatables-demo.js')}}"></script>
    <!--  -->
    <script>
    if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
        // estamos desde un movil o tablet
        $("#accordionSidebar").addClass("toggled");
    }
    </script>
    @yield('js')
</body>
</html>
















