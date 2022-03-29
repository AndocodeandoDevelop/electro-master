$(document).ready(function (){
    var input = document.getElementById('nombre');
    input.addEventListener('input', function () {
        if (this.value.length > 100)
            this.value = this.value.slice(0, 100);
    });
    var input = document.getElementById('precio_compra');
    input.addEventListener('input', function () {
        if (this.value.length > 9)
            this.value = this.value.slice(0, 9);
    });
    var input = document.getElementById('precio_venta');
    input.addEventListener('input', function () {
        if (this.value.length > 9)
            this.value = this.value.slice(0, 9);
    });
    var input = document.getElementById('precio_oferta');
    input.addEventListener('input', function () {
        if (this.value.length > 9)
            this.value = this.value.slice(0, 9);
    });
    var input = document.getElementById('cantidad');
    input.addEventListener('input', function () {
        if (this.value.length > 11)
            this.value = this.value.slice(0, 11);
    });

    var input = document.getElementById('nombreEditar');
    input.addEventListener('input', function () {
        if (this.value.length > 100)
            this.value = this.value.slice(0, 100);
    });
    var input = document.getElementById('precio_compraEditar');
    input.addEventListener('input', function () {
        if (this.value.length > 9)
            this.value = this.value.slice(0, 9);
    });
    var input = document.getElementById('precio_ventaEditar');
    input.addEventListener('input', function () {
        if (this.value.length > 9)
            this.value = this.value.slice(0, 9);
    });
    var input = document.getElementById('precio_ofertaEditar');
    input.addEventListener('input', function () {
        if (this.value.length > 9)
            this.value = this.value.slice(0, 9);
    });
    var input = document.getElementById('cantidadEditar');
    input.addEventListener('input', function () {
        if (this.value.length > 11)
            this.value = this.value.slice(0, 11);
    });
});

function verificarAgregarProducto() {
    if($('#nombre').val() == '') {
        generarAlertaDatos('Nombre Vacio', 'El campo Nombre es obligatorio', 'warning', 0);
        return false;
    }
    if($('#cantidad').val() == '') {
        generarAlertaDatos('Cantidad Vacia', 'El campo Cantidad es obligatorio', 'warning', 0);
        return false;
    }
    if($('#foto').val() == '') {
        generarAlertaDatos('Foto Vacia', 'El campo Foto es obligatorio', 'warning', 0);
        return false;
    }
    if($('#precio_compra').val() == '') {
        generarAlertaDatos('Precio Compra Vacio', 'El campo Precio Compra es obligatorio', 'warning', 0);
        return false;
    }
    if($('#precio_venta').val() == '') {
        generarAlertaDatos('Precio Venta Vacio', 'El campo Precio Venta es obligatorio', 'warning', 0);
        return false;
    }
    if($('#descripcion').val() == '') {
        generarAlertaDatos('Descripcion Vacio', 'El campo Descripcion a es obligatorio', 'warning', 0);
        return false;
    }

    $('#enviarFormAgregar').click();
}

function verificarEditarProducto() {
    if($('#nombreEditar').val() == '') {
        generarAlertaDatos('Nombre Vacio', 'El campo Nombre es obligatorio', 'warning', 0);
        return false;
    }
    if($('#cantidadEditar').val() == '') {
        generarAlertaDatos('Cantidad Vacia', 'El campo Cantidad es obligatorio', 'warning', 0);
        return false;
    }
    if($('#precio_compraEditar').val() == '') {
        generarAlertaDatos('Precio Compra Vacio', 'El campo Precio Compra es obligatorio', 'warning', 0);
        return false;
    }
    if($('#precio_ventaEditar').val() == '') {
        generarAlertaDatos('Precio Venta Vacio', 'El campo Precio Venta es obligatorio', 'warning', 0);
        return false;
    }
    if($('#descripcionEditar').val() == '') {
        generarAlertaDatos('Descripcion Vacio', 'El campo Descripcion a es obligatorio', 'warning', 0);
        return false;
    }

    $('#enviarFormEditar').click();
}
