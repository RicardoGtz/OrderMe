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
		$sqldata= mysqli_query($dbcon,"call VerResenaPlatillo('$id')");

            while($row=mysqli_fetch_array($sqldata,MYSQLI_NUM)){
              	echo '<table class="tabla">';
              	echo '<tr><th colspan="4" class="titulo">'.utf8_encode($row[0]).'</th></tr>';
              	echo '<tr><th class="enca">Usuario:</th><td>'.utf8_encode($row[1]).'</td>';
              	echo '<th class="enca">Calificacion:</th><td>'.utf8_encode($row[2]).'/5</td></tr>';
              	echo '<tr><td colspan="4">"'.utf8_encode($row[3]).'"</td></tr>';
              	echo '</table></br>';
            }
	}
	?>
<?php
	include('includes/footer.html');
?>
</body>
</html>
