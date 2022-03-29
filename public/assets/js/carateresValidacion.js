/* Funcion que solo permite escribir "letras" en los inputs */
function validaLetras(event) {
    if(event.charCode >= 65 && event.charCode <= 90){
        return true;
    }
    if(event.charCode >= 97 && event.charCode <= 122){
        return true;
    }
    if(event.charCode >= 160 && event.charCode <= 165){
        return true;
    }
    if(event.charCode == 32){
        return true;
    }
    return false;
}

/* Funcion que solo permite escribir "numeros" en los inputs */
function validaNumeros(event) {
    if(event.charCode >= 48 && event.charCode <= 57){
        return true;
    }
    return false;
}

/* Funcion que solo permite ingresar 2 numeros despues de un punto decimal */
function liminteDecimal(e, count) {
    if (e.target.value.indexOf('.') == -1) { return; }
    if ((e.target.value.length - e.target.value.indexOf('.')) > count) {
        e.target.value = parseFloat(e.target.value).toFixed(count);
    }
}
/* Funcion que valida que solo se escriba un numero en el input */
function validarNumeroDecimal(evt) {
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57))
        return false;

    return true;
}
