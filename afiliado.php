<!DOCTYPE html>
<html lang="es">
<head>
    <title>Restaurantes - OrderMe</title>
    <?php include('includes/links.php'); ?>
</head>
<?php
	include('includes/global.php');
	crearHeaders();
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
