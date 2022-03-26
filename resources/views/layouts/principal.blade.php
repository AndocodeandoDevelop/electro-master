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

    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

    <!-- Boletin Informativo -->
    <div id="newsletter" class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="newsletter">
                        <p>Registrate para el <strong>Boletin Informativo</strong></p>
                        <form>
                            <input class="input" type="email" placeholder="Ingresa tu correo">
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
@yield('archivosJs')
</html>