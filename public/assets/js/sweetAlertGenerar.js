/* Esta funcion permite generar alertas de sweet alert pasando un nombre de alerta, un mensaje, un icono, y
* eligiendo si se recargara la pagina o no (0 para no, 1 para si) */

function generarAlertaDatos(nombre, mensaje, icono, recargar){
    if(recargar == 0){
        Swal.fire(
            nombre,
            mensaje,
            icono
        )
    }else{
        Swal.fire(
            nombre,
            mensaje,
            icono
        ).then((result) => {
            location.reload();
        });
    }
}
