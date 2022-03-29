/* Permite limitar el tamaño de los campos de texto */
$(document).ready(function (){
    var input = document.getElementById('nombre');
    input.addEventListener('input', function () {
        if (this.value.length > 100)
            this.value = this.value.slice(0, 100);
    });
    var input = document.getElementById('descripcion');
    input.addEventListener('input', function () {
        if (this.value.length > 255)
            this.value = this.value.slice(0, 255);
    });
    var input = document.getElementById('slug');
    input.addEventListener('input', function () {
        if (this.value.length > 10)
            this.value = this.value.slice(0, 10);
    });

    var input = document.getElementById('nombreEditar');
    input.addEventListener('input', function () {
        if (this.value.length > 100)
            this.value = this.value.slice(0, 100);
    });
    var input = document.getElementById('descripcionEditar');
    input.addEventListener('input', function () {
        if (this.value.length > 255)
            this.value = this.value.slice(0, 255);
    });
    var input = document.getElementById('slugEditar');
    input.addEventListener('input', function () {
        if (this.value.length > 10)
            this.value = this.value.slice(0, 10);
    });
});

/* Funcion que verifica que los campos del formulario de agregar categorias esten llenos */
function verificarAgregarCategoria() {
    if($('#nombre').val() == '') {
        generarAlertaDatos('Nombre Vacio', 'El campo Nombre es obligatorio', 'warning', 0);
        return false;
    }
    if($('#descripcion').val() == '') {
        generarAlertaDatos('Descripcion Vacio', 'El campo Descripcion es obligatorio', 'warning', 0);
        return false;
    }
    if($('#slug').val() == '') {
        generarAlertaDatos('Nombre Slug', 'El campo Slug es obligatorio', 'warning', 0);
        return false;
    }
    $('#enviarFormAgregar').click();
}

/* Funcion que verifica que los campos del formulario de editar categorias esten llenos */
function verificarEditarCategoria() {
    if($('#nombreEditar').val() == '') {
        generarAlertaDatos('Nombre Vacio', 'El campo Nombre es obligatorio', 'warning', 0);
        return false;
    }
    if($('#descripcionEditar').val() == '') {
        generarAlertaDatos('Descripcion Vacio', 'El campo Descripcion es obligatorio', 'warning', 0);
        return false;
    }
    if($('#slugEditar').val() == '') {
        generarAlertaDatos('Nombre Slug', 'El campo Slug es obligatorio', 'warning', 0);
        return false;
    }
    $('#enviarFormEditar').click();
}
