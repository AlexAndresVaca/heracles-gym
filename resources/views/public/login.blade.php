<!DOCTYPE html>
<html lang="es_EC">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Heracles GYM - Login</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('sources/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('sources/css/sb-admin-2.min.css')}}" rel="stylesheet">
    <link href="{{asset('sources/css/custom.css')}}" rel="stylesheet">

</head>

<body class="bg-gradient-black-2 sin-cursor">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row bg-gradient-black">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h1 text-gray-200 mb-5">Bienvenido!</h1>
                                    </div>
                                    <form action="{{route('iniciarSesion')}}" class="user" autocomplete="off" method="POST">
                                        @CSRF
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" name="nick" placeholder="Nombre de usuario" @if($errors->has('nick')) value="{{old('nick')}}" @endif @if (session('nick')) value="{{ session('nick')}}"@endif >
                                            @if ($errors->has('nick')) 
                                            <div class="ml-4 text-danger" >
                                                {{ $errors->first('nick') }}
                                            </div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"  name="pass" placeholder="Contraseña">
                                            @if (session('ingreso')) 
                                            <div class="ml-4 text-danger" >
                                                {{ session('ingreso') }}
                                            </div>
                                            @endif
                                        </div>
                                        <input type="submit" class="btn bg-darkred text-gray-100 text-lg btn-user btn-block" value="Iniciar Sesión">
                                        <a href="https://www.google.com" class="btn btn-user btn-block bg-primary text-gray-100 text-lg mt-1">
                                            <i class="fas fa-store"></i> Visitar nuestra tienda
                                        </a>
                                        <a href="{{route('login')}}" class="btn btn-user btn-block bg-success text-gray-100 text-lg mt-1">
                                            <i class="fas fa-user"></i> Acceso Cliente
                                        </a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
    <footer class="sticky-footer bg-black-2">
        <div class="container my-auto">
            <div class="copyright text-gray-100 text-center my-auto">
                <span>Copyright &copy; HERACLES GYM 2020</span>
            </div>
        </div>
    </footer>


</body>

</html>