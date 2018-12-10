<!DOCTYPE html>
<html lang="es">
<head>
    <title>Inicio - OrderMe</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="comun/librerias/bootstrap/css/bootstrap.css">
  	<link rel="stylesheet" href="comun/css/estilos.css">
	<script src="comun/librerias/bootstrap/js/bootstrap.js"></script>
</head>
<?php
	session_start();
	if(@$_SESSION['user'] == 'administradorG'){
		include("includes/headerGlobal.php"); 
		echo "Hola Adm Global";
	}
	elseif (@$_SESSION['user']=='administradorR'){
		include("includes/headerLocal.php");
		echo "Hola Adm Local";
	}
	elseif (@$_SESSION['user']=='empleado'){
		include('includes/headerCliente.php');
		echo "Hola Empleado";
	}
	elseif (@$_SESSION['user']=='cliente'){
		include('includes/headerCliente.php'); 
		echo "Hola Cliente";
	}
	elseif (@!$_SESSION['user']) {
		include('includes/headerInvitado.php');
		echo "Hola Invitado";
	}
?>
<body>

<?php
	include('includes/footer.html');
?>
</body>
</html>