/// OPERACIONES ////
/// AGREGAR ///
function agregar(cadena, t) {
    $.ajax({
        type: "POST",
        url: "comun/php/operaciones.php",
        data: cadena,
        success: function(r) {
            //alertify.success(r);
            if (r == 1) {
                alertify.success("Se agrego con exito el registro");
            } else {
                alertify.error("Surgio un error, intente denuevo");
            }
        }
    });
}

function login(cadena) {
    $.ajax({
        type: "POST",
        url: "comun/php/login.php",
        data: cadena,
        success: function(r) {
            window.location="inicio.php";
        }
    });
}

function cerrar_sesion() {
    $.ajax({
        type: "POST",
        url: "comun/php/salir.php",
        success: function(r) {
        }
    });
}
