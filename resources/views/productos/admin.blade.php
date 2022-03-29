@extends('layouts.principal')

@section('archivosCss')
@endsection

@section('titulo','Productos')

@section('tituloSeccion')
    <link rel="stylesheet" href="/assets/css/datatables.min.css">
@endsection

@section('migasPan')
    <h3 class="breadcrumb-header">Productos</h3>
    <ul class="breadcrumb-tree">
        <li><a href="#">Inicio</a></li>
        <li><a href="#">Productos</a></li>
        <li class="active">Administrador</li>
    </ul>
@endsection

@section('contenido')
    <div class="row d-flex justify-content-end">
        <!-- Boton Modal Agregar Cuento -->
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#agregarProductoModal" style="float: right">
            <i class="fa fa-plus"></i> Agregar Producto
        </button>
        <!-- #Boton Modal Agregar Cuento -->
    </div>
    <div class="row d-flex justify-content-end">
        <div class="header-search" style="float: right">
            <form>
                <select class="input-select" id="tipoArchivo">
                    <option value="1">Ver PDF</option>
                    <option value="2">Descargar PDF</option>
                    <option value="3">Descargar Excel</option>
                </select>
                <button class="search-btn" style="background-color: #1db101 !important;" onclick="generarArchivos()">Generar</button>
            </form>
        </div>
    </div>
    <table id="tablaCuentos" class="table table-striped table-bordered" style="width:100%">
        <thead>
        <tr class="text-center">
            <th>#</th>
            <th>Nombre</th>
            <th>Precio Compra</th>
            <th>Precio Venta</th>
            <th>Precio Oferta</th>
            <th>Categoria</th>
            <th>Cantidad</th>
            <th>Acciones</th>
        </tr>
        </thead>
        @foreach($productos as $producto)
            <tr>
                <td>{{$producto->id}}</td>
                <td>{{$producto->nombre}}</td>
                <td>{{$producto->precio_compra}}</td>
                <td>{{$producto->precio_venta}}</td>
                <td>
                    @if($producto->precio_oferta == null)
                        Sin Oferta
                    @else
                        {{$producto->precio_oferta}}
                    @endif
                </td>
                <td>{{$producto->categoria->nombre}}</td>
                <td class="text-center">{{$producto->cantidad}}</td>
                <td style="width: 27%">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modalEditar"
                            onclick="mostrarInformacion({{$producto}})"><i class="fa fa-info-circle"></i> Ver Mas</button>
                    <button class="btn btn-warning" data-toggle="modal" data-target="#modalEditar"
                            onclick="buscarProducto({{$producto->id}})"><i class="fa fa-edit"></i> Editar</button>
                    <button class="btn btn-danger" data-toggle="modal" data-target="#modalEliminar"
                            onclick="eliminarProducto({{$producto->id}})"><i class="fa fa-trash"></i> Eliminar</button>
                </td>
            </tr>
        @endforeach
        <tbody>
        </tbody>
    </table>
    <!-- #Boton Modal Agregar Cuento -->

    <!-- Modal Mostrar Mas Informacion Producto -->
    <div class="modal fade" id="mostrarInformacionModal" tabindex="-1" aria-labelledby=mostrarInformacionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mostrarInformacionModalLabel">Editar Categoria</h5>
                </div>
                <div class="modal-body">
                    <div class="row" style="margin-left: 1%; margin-right: 1%">
                        <h5>Descripcion:</h5>
                        <div class="text-justify" id="descripcionProducto"><!-- Descripcion del Producto --></div>
                        <h5>Imagen:</h5>
                        <div id="imagenProducto" style="align-content: center"><!-- Imagen del Producto --> </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" >Aceptar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- #Modal Mostrar Mas Informacion Producto -->

    <!-- Modal Agregar Producto -->
    <div class="modal fade" id="agregarProductoModal" tabindex="-1" aria-labelledby="agregarProductoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarProductoModalLabel">Agregar Producto</h5>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{route('producto.admin.agregar')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="nombre">Nombre <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" required
                                       onkeypress='return validaLetras(event)' placeholder="Nombre">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="categoria_id">Categoria <span class="text-danger">*</span></label>
                                    <select id="categoria_id" name="categoria_id" class="form-control">
                                        @foreach($categorias as $categoria)
                                            <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="cantidad">Cantidad <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="cantidad" name="cantidad" required
                                           onkeypress='return validaNumeros(event)' placeholder="Cantidad">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="foto">Foto <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" id="foto" name="foto" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="precio_compra">Precio de Compra <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="precio_compra" name="precio_compra" required
                                           oninput="liminteDecimal(event, 2)" onkeypress="return validarNumeroDecimal(event)"
                                           placeholder="Precio de Compra">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="precio_venta">Precio de Venta <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="precio_venta" name="precio_venta" required
                                           oninput="liminteDecimal(event, 2)" onkeypress="return validarNumeroDecimal(event)"
                                           placeholder="Precio de Venta">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="precio_oferta">Precio de Oferta </label>
                                    <input type="text" class="form-control" id="precio_oferta" name="precio_oferta"
                                           oninput="liminteDecimal(event, 2)" onkeypress="return validarNumeroDecimal(event)"
                                           placeholder="Precio de Oferta">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="descripcion">Descripcion <span class="text-danger">*</span></label>
                                    <textarea type="text" class="form-control" id="descripcion" name="descripcion" required
                                              placeholder="Descripcion" rows="4"></textarea>
                                </div>
                            </div>
                        </div>
                        <button type="submit" id="enviarFormAgregar" class="btn btn-primary" style="display: none">Enviar</button>
                    </form>
                </div>
                <div class="modal-footer" >
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="verificarAgregarProducto()">Agregar Producto</button>
                </div>
            </div>
        </div>
    </div>
    <!-- #Modal Agregar Producto -->

    <!-- Modal Editar Producto -->
    <div class="modal fade" id="editarProductoModal" tabindex="-1" aria-labelledby="editarProductoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editarProductoModalLabel">Editar Producto</h5>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{route('producto.admin.editar')}}" enctype="multipart/form-data">
                        @csrf
                        <input type="text" id="idEditar" name="idEditar" hidden>
                        <div class="row">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="nombreEditar">Nombre <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nombreEditar" name="nombreEditar" required
                                           onkeypress='return validaLetras(event)' placeholder="Nombre">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="categoria_idEditar">Categoria <span class="text-danger">*</span></label>
                                    <select id="categoria_idEditar" name="categoria_idEditar" class="form-control">
                                        @foreach($categorias as $categoria)
                                            <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="cantidadEditar">Cantidad <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="cantidadEditar" name="cantidadEditar" required
                                           onkeypress='return validaNumeros(event)' placeholder="Cantidad">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="fotoEditar">Foto</label>
                                    <input type="file" class="form-control" id="fotoEditar" name="fotoEditar">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="precio_compraEditar">Precio de Compra <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="precio_compraEditar" name="precio_compraEditar" required
                                           oninput="liminteDecimal(event, 2)" onkeypress="return validarNumeroDecimal(event)"
                                           placeholder="Precio de Compra">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="precio_ventaEditar">Precio de Venta <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="precio_ventaEditar" name="precio_ventaEditar" required
                                           oninput="liminteDecimal(event, 2)" onkeypress="return validarNumeroDecimal(event)"
                                           placeholder="Precio de Venta">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="precio_ofertaEditar">Precio de Oferta </label>
                                    <input type="text" class="form-control" id="precio_ofertaEditar" name="precio_ofertaEditar"
                                           oninput="liminteDecimal(event, 2)" onkeypress="return validarNumeroDecimal(event)"
                                           placeholder="Precio de Oferta">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="descripcionEditar">Descripcion <span class="text-danger">*</span></label>
                                    <textarea type="text" class="form-control" id="descripcionEditar" name="descripcionEditar" required
                                              placeholder="Descripcion" rows="4"></textarea>
                                </div>
                            </div>
                        </div>
                        <button type="submit" id="enviarFormEditar" class="btn btn-primary" style="display: none">Enviar</button>
                    </form>
                </div>
                <div class="modal-footer" >
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="verificarEditarProducto()">Editar Producto</button>
                </div>
            </div>
        </div>
    </div>
    <!-- #Modal Editar Producto -->
@endsection

@section('archivosJs')
    <script src="/assets/js/productos/verificarForms.js"></script>
    <script>
        $(document).ready(function () {
            $('#opcionMenu').removeClass('active');
            $('#productosAdminCabecera').addClass('active');
        });

        @if(Session::has('faltanDatos'))
            generarAlertaDatos('Aun Faltan Datos', '{{Session::get('faltanDatos')}}', 'warning', 0);
            {{Session::forget('faltanDatos')}}
        @endif
        @if(Session::has('extensionNoValida'))
            generarAlertaDatos('Extension de Foto No Valida', '{{Session::get('extensionNoValida')}}', 'warning', 0);
            {{Session::forget('extensionNoValida')}}
        @endif
        @if(Session::has('agregado'))
            generarAlertaDatos('Producto Agregado', '{{Session::get('agregado')}}', 'success', 0)
            {{Session::forget('agregado')}}
        @endif
        @if(Session::has('editado'))
            generarAlertaDatos('Producto Editado', '{{Session::get('editado')}}', 'success', 0);
            {{Session::forget('editado')}}
        @endif
        @if(Session::has('error'))
            generarAlertaDatos('Error', '{{Session::get('error')}}', 'error', 0);
            {{Session::forget('error')}}
        @endif
        @if(Session::has('sinProducto'))
            generarAlertaDatos('Producto No Encontrado', '{{Session::get('sinProducto')}}', 'warning', 1);
            {{Session::forget('sinProducto')}}
        @endif

        $('#tablaCuentos').DataTable(
            {
                "lengthMenu": [[10, 15, -1], [5, 10, 15, "All"]],
                "searching": true,
                destroy: true,
                language: {
                    "decimal": "",
                    "emptyTable": "No hay categorias registradas.",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Productos",
                    "infoEmpty": "Mostrando 0 to 0 of 0 Productos",
                    "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ Productos",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "Sin resultados encontrados",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                }
            }
        );

        function mostrarInformacion(producto){
            $('#mostrarInformacionModalLabel').text(producto['nombre']);
            $('#descripcionProducto').text(producto['descripcion']);
            $('#imagenProducto').html('<img class="img-fluid" src="'+producto['ruta_img']+'" style="width: 60%;' +
                'margin-left: auto; margin-right: auto; display: block;">');
            $('#mostrarInformacionModal').modal('show');
        }

        function buscarProducto(id){
            $.ajax({
                type: "get",
                url: "/productos/buscar/"+id,
                dataType: "json",
                success: function (response) {
                    if(response.estatus == 'encontrado'){
                        $('#idEditar').val(response.producto.id);
                        $('#nombreEditar').val(response.producto.nombre);
                        $('#descripcionEditar').val(response.producto.descripcion);
                        $('#cantidadEditar').val(response.producto.cantidad);
                        $('#precio_compraEditar').val(response.producto.precio_compra);
                        $('#precio_ventaEditar').val(response.producto.precio_venta);
                        $('#precio_ofertaEditar').val(response.producto.precio_oferta);

                        $('#editarProductoModal').modal('show');
                    }else if (response.estatus == 'sinProducto')
                        generarAlertaDatos('Producto No Encontrado', response.mensaje, 'warning', 1);
                    else
                        generarAlertaDatos('Error', response.mensaje, 'error', 1);
                }
            });
        }

        function eliminarProducto(id){
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás recuperar este Producto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Sí, eliminar!',
                cancelButtonText: '¡Cancelar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "get",
                        url: "/productos/eliminar/"+id,
                        dataType: "json",
                        success: function (response) {
                            console.log(response);
                            if(response.estatus == 'eliminado'){
                                generarAlertaDatos('Producto Eliminado', response.mensaje, 'success', 1);
                            }else if (response.estatus == 'sinProducto')
                                generarAlertaDatos('Producto No Encontrado', response.mensaje, 'warning', 1);
                            else
                                generarAlertaDatos('Error', response.mensaje, 'error', 1);
                        }
                    });
                }
            })
        }

        function generarArchivos(){
            tipo = $('#tipoArchivo').val();

            switch (tipo) {
                case "1":
                    window.open('/verPDF/productos', '_blank');
                    break;
                case "2":
                    window.open('/descargarPDF/productos');
                    break;
                case "3":
                    window.open('/descargarExcel/productos');
                break;
            }

        }
    </script>
@endsection
