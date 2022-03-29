<header>
    <!-- Cabecera de Informacion -->
    <div id="top-header">
        <div class="container">
            <ul class="header-links pull-left">
                <li><a href="#"><i class="fa fa-phone"></i> +55-5896-6985</a></li>
                <li><a href="#"><i class="fa fa-envelope-o"></i> electromaster123@gmail.com</a></li>
                <li><a href="#"><i class="fa fa-map-marker"></i> Av. 5 de Mayo, Tecamac</a></li>
            </ul>
            <ul class="header-links pull-right">
                <li><a href="#"><i class="fa fa-dollar"></i> MNX</a></li>
                <li><a href="#"><i class="fa fa-user-o"></i> Mi cuenta</a></li>
            </ul>
        </div>
    </div>
    <!-- /Cabecera de Informacion -->

    <!-- Cabecera Principal -->
    <div id="header">
        <div class="container">
            <div class="row">
                <!-- Logo -->
                <div class="col-md-3">
                    <div class="header-logo">
                        <a href="#" class="logo">
                            <img src="/assets/plantilla/img/logo.png" alt="">
                        </a>
                    </div>
                </div>
                <!-- /Logo -->

                <!-- Barra Buscadora -->
                <div class="col-md-6">
                    <div class="header-search">
                        <form>
                            <select class="input-select">
                                <option value="0">Categorias</option>
                                @foreach(\App\Models\Categoria::all() as $categoria)
                                    <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                                @endforeach
                            </select>
                            <input class="input" placeholder="Buscar...">
                            <button class="search-btn">Buscar</button>
                        </form>
                    </div>
                </div>
                <!-- /Barra Buscadora -->
            </div>
        </div>
    </div>
    <!-- /Cabecera Principal -->
</header>

<!-- Barra de Navegacion -->
<nav id="navigation">
    <div class="container">
        <div id="responsive-nav">
            <!-- Menu -->
            <ul class="main-nav nav navbar-nav" id="clasesMenuCabecera">
                <li class="opcionMenu" id="categoriasAdminCabecera"><a href="{{route('categoria.admin.vista')}}">Administrar Categorias</a></li>
                <li class="opcionMenu" id="productosAdminCabecera"><a href="{{route('producto.admin.vista')}}">Administrar Productos</a></li>
            </ul>
            <!-- /Menu -->
        </div>
    </div>

</nav>
<!-- /Barra de Navegacion -->
