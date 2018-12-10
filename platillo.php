<!DOCTYPE html>
<html lang="es">
<head>
    <title>Sucursales - OrderMe</title>
    <?php include('includes/links.php'); ?>
</head>
<?php
	include('includes/global.php');
	crearHeaders();
?>
<body>
	<?php
	include('connectmysql.php');
	if(isset($_GET['id']))
	{
		$id=$_GET['id'];
		$sqldata= mysqli_query($dbcon,"call VerTieneSucursal('$id')");

            while($row=mysqli_fetch_array($sqldata,MYSQLI_NUM)){
              	echo '<table class="tabla">';
              	echo '<tr><th colspan="4" class="titulo">'.utf8_encode($row[1]).'</th></tr>';
              	echo '<tr><td rowspan="4"><img src="comun/img/platillo/'.utf8_encode($row[4]).'" widht="150px" height="150px"></td>';
              	echo '<td>Nombre: '.utf8_encode($row[1]).'</td></tr>';
              	echo '<tr><td>Descripcion: '.utf8_encode($row[2]).'</td></tr>';
              	echo '<tr><td>Precio: $'.utf8_encode($row[3]).'</td></tr>';
              	echo '<tr><td class="enca">';
              	echo "<a href='resena.php?id=$row[0]'>Ver Reseñas";
				echo '</td><tr>';
              	echo '</table></br>';
            }
	}
	?>
<?php
	include('includes/footer.html');
?>
</body>
</html>
