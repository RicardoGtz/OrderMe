<!DOCTYPE html>
<html lang="es">
<head>
    <title>Restaurantes - OrderMe</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="comun/librerias/bootstrap/css/bootstrap.css">
  	<link rel="stylesheet" href="comun/css/estilo.css">
	<script src="comun/librerias/bootstrap/js/bootstrap.js"></script>
	<link rel="stylesheet" href="comun/css/estilos.css" />
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
	include('connectmysql.php');
		$sqldata= mysqli_query($dbcon,"call VerRestaurante()");

            while($row=mysqli_fetch_array($sqldata,MYSQLI_NUM)){
              	echo '<table class="tabla">';
              	echo '<tr><th colspan="4" class="titulo">'.utf8_encode($row[1]).'</th></tr>';
              	echo '<tr><td colspan="4" class="enca">';
              	echo "<a href='sucursales.php?id=$row[0]&p=$row[1]'>Ver Sucursales";
				echo '</td><tr>';
				echo '</table>';
            }
	?>
<?php
	include('includes/footer.html');
?>
</body>
</html>