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
	include('includes/global.php');
	crearHeaders();
?>
<body>
	<?php
	include('connectmysql.php');
	if(isset($_GET['orden']))
	{
		$orden=$_GET['orden'];
		$sqldata= mysqli_query($dbcon,"call VerPedidoOrden('$orden')");

            while($row=mysqli_fetch_array($sqldata,MYSQLI_NUM)){
	          	echo '<table class="tabla">';
	          	echo '<tr><th colspan="4" class="titulo">'.utf8_encode($row[0]).'</th></tr>';
	          	echo '<tr><th class="enca">Sucursal:</th><td>'.utf8_encode($row[2]).'</td></tr>';
	          	echo '<tr><th class="enca">Nota:</th><td>'.utf8_encode($row[3]).'</td></tr>';
	          	echo '<tr><th class="enca">Estatus:</th><td>'.utf8_encode($row[4]).'</td></tr>';
	          	echo '</table></br>';
	        }
	}   
	?>
<?php
	include('includes/footer.html');
?>
</body>
</html>