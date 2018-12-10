<!DOCTYPE html>
<html lang="es">
<head>
    <title>Sucursales - OrderMe</title>
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
		include('includes/global.php');
		$getUsuario=$_SESSION['usuario'];
		$sqldata= mysqli_query($dbcon,"call VerOrdenUsuario('$getUsuario')");

        while($row=mysqli_fetch_array($sqldata,MYSQLI_NUM)){
          	echo '<table class="tabla">';
          	echo '<tr><th colspan="4" class="titulo">'.utf8_encode($row[0]).'</th></tr>';
          	echo '<tr><th class="enca">Sucursal:</th><td>'.utf8_encode($row[2]).'</td>';
          	echo '<th class="enca">Fecha:</th><td>'.utf8_encode($row[3]).'</td></tr>';
          	echo '<tr><th class="enca">Numero de Mesa:</th><td>'.utf8_encode($row[4]).'</td>';
          	echo '<th class="enca">Total:</th><td>$'.utf8_encode($row[5]).'</td></tr>';
          	echo '<tr><th class="enca">Estatus:</th><td>'.utf8_encode($row[6]).'</td></tr>';
          	echo '<tr><td class="enca">';
          	echo "<a href='pedido.php?orden=$row[0]'>Ver Detalles";
			echo '</td><tr>';
          	echo '</table></br>';
        }
	?>
<?php
	include('includes/footer.html');
?>
</body>
</html>