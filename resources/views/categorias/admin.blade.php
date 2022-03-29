@extends('layouts.principal')

@section('archivosCss')
@endsection

@section('titulo','Categorias')

@section('tituloSeccion')
    <link rel="stylesheet" href="/assets/css/datatables.min.css">
@endsection

@section('migasPan')
    <h3 class="breadcrumb-header">Categorias</h3>
    <ul class="breadcrumb-tree">
        <li><a href="#">Inicio</a></li>
        <li><a href="#">Categorias</a></li>
        <li class="active">Administrador</li>
    </ul>
@endsection

@section('contenido')
    <div class="d-flex justify-content-end">
        <!-- Boton Modal Agregar Cuento -->
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#agregarCategoriaModal" style="float: right">
            <i class="fa fa-plus"></i> Agregar Categoria
        </button>
        <!-- #Boton Modal Agregar Cuento -->
    </div>
    <table id="tablaCuentos" class="table table-striped table-bordered" style="width:100%">
        <thead>
        <tr class="text-center">
            <th>#</th>
            <th>Nombre</th>
            <th>Descripcion</th>
            <th>Slug</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
            @foreach($categorias as $categoria)
                <tr>
                    <td>{{$categoria->id}}</td>
                    <td>{{$categoria->nombre}}</td>
                    <td>{{$categoria->descripcion}}</td>
                    <td>{{$categoria->slug}}</td>
                    <td style="width: 18%">
                        <button class="btn btn-warning" data-toggle="modal" data-target="#modalEditar"
                                onclick="buscarCategoria({{$categoria->id}})"><i class="fa fa-edit"></i> Editar</button>
                        <button class="btn btn-danger" data-toggle="modal" data-target="#modalEliminar"
                                onclick="eliminarCategoria({{$categoria->id}})"><i class="fa fa-trash"></i> Eliminar</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal Agregar Categoria -->
    <div class="modal fade" id="agregarCategoriaModal" tabindex="-1" aria-labelledby="agregarCategoriaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarCategoriaModalLabel">Agregar Categoria</h5>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{route('categoria.admin.agregar')}}">
                        @csrf
                        <div class="form-group row">
                            <label for="nombre" class="col-sm-2 col-form-label">Nombre <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nombre" name="nombre" required
                                       onkeypress='return validaLetras(event)' placeholder="Nombre">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="descripcion" class="col-sm-2 col-form-label">Descripción  <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="descripcion" name="descripcion" required
                                       onkeypress='return validaLetras(event)' placeholder="Descripcion">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="slug" class="col-sm-2 col-form-label">Slug  <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="slug" name="slug" required
                                       onkeypress='return validaLetras(event)' placeholder="Slug">
                            </div>
                        </div>
                        <button type="submit" id="enviarFormAgregar" class="btn btn-primary" style="display: none">Enviar</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="verificarAgregarCategoria()">Agregar Categoria</button>
                </div>
            </div>
        </div>
    </div>
    <!-- #Modal Agregar Categoria -->

    <!-- Modal Editar Categoria -->
    <div class="modal fade" id="editarCategoriaModal" tabindex="-1" aria-labelledby="editarCategoriaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editarCategoriaModalLabel">Editar Categoria</h5>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{route('categoria.admin.editar')}}">
                        @csrf
                        <input type="text" id="idEditar" name="idEditar" hidden>
                        <div class="form-group row">
                            <label for="nombreEditar" class="col-sm-2 col-form-label">Nombre <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nombreEditar" name="nombreEditar" required
                                       onkeypress='return validaLetras(event)' placeholder="Nombre">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="descripcionEditar" class="col-sm-2 col-form-label">Descripción  <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="descripcionEditar" name="descripcionEditar" required
                                       onkeypress='return validaLetras(event)' placeholder="Descripcion">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="slugEditar" class="col-sm-2 col-form-label">Slug  <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="slugEditar" name="slugEditar" required
                                       onkeypress='return validaLetras(event)' placeholder="Slug">
                            </div>
                        </div>
                        <button type="submit" id="enviarFormEditar" class="btn btn-primary" style="display: none">Enviar</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="verificarEditarCategoria()">Editar Categoria</button>
                </div>
            </div>
        </div>
    </div>
    <!-- #Modal Editar Categoria -->
@endsection


@section('archivosJs')
    <script src="/assets/js/categorias/verificarForms.js"></script>
    <script>
        $(document).ready(function () {
            $('#opcionMenu').removeClass('active');
            $('#categoriasAdminCabecera').addClass('active');
        });
        @if(Session::has('faltanDatos'))
            generarAlertaDatos('Aun Faltan Datos', '{{Session::get('faltanDatos')}}', 'warning', 0);
            {{Session::forget('faltanDatos')}}
        @endif
        @if(Session::has('slugExistente'))
            generarAlertaDatos('Slug Existente', '{{Session::get('slugExistente')}}', 'warning', 0)
            {{Session::forget('slugExistente')}}
        @endif
        @if(Session::has('agregado'))
            generarAlertaDatos('Categoria Agregada', '{{Session::get('agregado')}}', 'success', 0)
            {{Session::forget('agregado')}}
        @endif
        @if(Session::has('editado'))
            generarAlertaDatos('Categoria Editada', '{{Session::get('editado')}}', 'success', 0);
            {{Session::forget('editado')}}
        @endif
        @if(Session::has('error'))
            generarAlertaDatos('Error', '{{Session::get('error')}}', 'error', 0);
            {{Session::forget('error')}}
        @endif

        $('#tablaCuentos').DataTable(
            {
                "lengthMenu": [[10, 15, -1], [5, 10, 15, "All"]],
                "searching": true,
                destroy: true,
                language: {
                    "decimal": "",
                    "emptyTable": "No hay categorias registradas.",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Categorias",
                    "infoEmpty": "Mostrando 0 to 0 of 0 Categorias",
                    "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ Categorias",
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

        function buscarCategoria(id){
            $.ajax({
                type: "get",
                url: "/categorias/buscar/"+id,
                dataType: "json",
                success: function (response) {
                    if(response.estatus == 'encontrado'){
                        $('#idEditar').val(response.categoria.id);
                        $('#nombreEditar').val(response.categoria.nombre);
                        $('#descripcionEditar').val(response.categoria.descripcion);
                        $('#slugEditar').val(response.categoria.slug);
                        $('#editarCategoriaModal').modal('show');
                    }else if (response.estatus == 'sinCategoria')
                        generarAlertaDatos('Categoria No Encontrada', response.mensaje, 'warning', 1);
                    else
                        generarAlertaDatos('Error', response.mensaje, 'error', 1);
                }
            });
        }

        function eliminarCategoria(id){
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás recuperar esta Categoria!",
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
                        url: "/categorias/eliminar/"+id,
                        dataType: "json",
                        success: function (response) {
                            console.log(response);
                            if(response.estatus == 'eliminado'){
                                generarAlertaDatos('Categoria Eliminada', response.mensaje, 'success', 1);
                            }else if (response.estatus == 'sinCategoria')
                                generarAlertaDatos('Categoria No Encontrada', response.mensaje, 'warning', 1);
                            else
                                generarAlertaDatos('Error', response.mensaje, 'error', 1);
                        }
                    });
                }
            })
        }
    </script>
@endsection
