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

/// AGREGAR ///
function actualizar_usuario(cadena, t) {
    $.ajax({
        type: "POST",
        url: "comun/php/operaciones.php",
        data: cadena,
        success: function(r) {
            alertify.success(r);
            if(r==1){
                alertify.alert("Muchas gracias!","Sus datos han sido actualizados en la base de datos!").set('onok', function(closeEvent){ window.location="perfilCliente.php";} );
            }else if(r==2){
                alertify.alert("Atencion!","El ID actualizado ya existe!");
            }else if(r==0) {
                alertify.alert("Muchas gracias!","Sus datos han sido actualizados en la base de datos!");
            }
        }
    });
}

function actualizar_empleado(cadena, t) {
    $.ajax({
        type: "POST",
        url: "comun/php/operaciones.php",
        data: cadena,
        success: function(r) {
            alertify.success(r);
            if(r==1){
                alertify.alert("Muchas gracias!","Sus datos han sido actualizados en la base de datos!").set('onok', function(closeEvent){ window.location="perfilEmpleado.php";} );
            }else if(r==2){
                alertify.alert("Atencion!","El ID actualizado ya existe!");
            }else if(r==0) {
                alertify.alert("Muchas gracias!","Sus datos han sido actualizados en la base de datos!");
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
