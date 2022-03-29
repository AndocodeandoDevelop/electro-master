<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">
    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="/assets/plantilla/css/bootstrap.min.css"/>
    <!-- Slick -->
    <link type="text/css" rel="stylesheet" href="/assets/plantilla/css/slick.css"/>
    <link type="text/css" rel="stylesheet" href="/assets/plantilla/css/slick-theme.css"/>
    <!-- nouislider -->
    <link type="text/css" rel="stylesheet" href="/assets/plantilla/css/nouislider.min.css"/>
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="/assets/plantilla/css/font-awesome.min.css">
    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="/assets/plantilla/css/style.css"/>
    <style>
        #iconosPiePagina li a i{
            color: white;
        }
    </style>

    @yield('archivosCss')
    <link rel="icon" href="/assets/images/icono.ico">
    <title>@yield('titulo', 'Plantilla')</title>
</head>
<body>
    <!-- Cabecera -->
    @include('layouts.cabecera')
    <!-- /Cabecera -->

    <!-- Migas de Pan -->
    <div id="breadcrumb" class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @yield('migasPan')
                    <!--
                    <h3 class="breadcrumb-header">Regular Page</h3>
                    <ul class="breadcrumb-tree">
                        <li><a href="#">Home</a></li>
                        <li class="active">Blank</li>
                    </ul>
                    -->
                </div>
            </div>
        </div>
    </div>
    <!-- /Migas de Pan -->

    <!-- Seccion de Contenido -->
    <div class="section">
        <div class="container">
            <div class="row">
                @yield('contenido')
            </div>
        </div>
    </div>
    <!-- /Seccion de Contenido -->

    <!-- Boletin Informativo -->
    <div id="newsletter" class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="newsletter">
                        <p>Registrate para el <strong>Boletin Informativo</strong></p>
                        <form method="POST" action="{{route('archivos.correo')}}">
                            @csrf
                            <input class="input" type="text" placeholder="Ingresa tu correo" id="correo" name="correo">
                            <button class="newsletter-btn"><i class="fa fa-envelope"></i> Suscribirse</button>
                        </form>
                        <ul class="newsletter-follow">
                            <li>
                                <a href="#"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-pinterest"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Boletin Informativo -->

    <!-- Pie de Pagina -->
    @include('layouts.pieDePagina')
    <!-- /Pie de Pagina -->
</body>

<!-- Archivos JS -->
<script src="/assets/plantilla/js/jquery.min.js"></script>
<script src="/assets/plantilla/js/bootstrap.min.js"></script>
<script src="/assets/plantilla/js/slick.min.js"></script>
<script src="/assets/plantilla/js/nouislider.min.js"></script>
<script src="/assets/plantilla/js/jquery.zoom.min.js"></script>
<script src="/assets/plantilla/js/main.js"></script>
<script src="/assets/js/datatables.min.js"></script>
<script src="/assets/js/sweetalert/sweetalert.min.js"></script>
<script src="/assets/js/sweetAlertGenerar.js"></script>
<script src="/assets/js/carateresValidacion.js"></script>
<script>
    @if(Session::has('correoEnviado'))
        generarAlertaDatos('Correo Suscrito', '{{Session::get('correoEnviado')}}', 'success', 0);
        {{Session::forget('correoEnviado')}}
    @endif
    @if(Session::has('correoVacio'))
        generarAlertaDatos('Correo Vacio', '{{Session::get('correoVacio')}}', 'warning', 0);
        {{Session::forget('correoVacio')}}
    @endif
    @if(Session::has('correoInvalido'))
        generarAlertaDatos('Correo Invalido', '{{Session::get('correoInvalido')}}', 'warning', 0);
        {{Session::forget('correoInvalido')}}
    @endif
    @if(Session::has('correoExistente'))
        generarAlertaDatos('Correo Ya Suscrito', '{{Session::get('correoExistente')}}', 'warning', 0);
        {{Session::forget('correoExistente')}}
    @endif
    $(document).ready(function () {
        $('#opcionMenu').removeClass('active');
        $('#inicioCabecera').addClass('active');
    });
</script>
@yield('archivosJs')
</html>
