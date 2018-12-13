<?php
	include('../../connectmysql.php');
	//if(isset($_GET['id']))
	//{
		$id=$_REQUEST['id'];
    $res=$_REQUEST['res'];

		$sqldata= mysqli_query($dbcon,"call VerSucursalRestaurante('$id')");

            while($row=mysqli_fetch_array($sqldata,MYSQLI_NUM)){
              	echo '<table class="tabla">';
              	echo '<tr><th colspan="4" class="titulo">'.$res.' '.utf8_encode($row[1]).'</th></tr>';
              	echo '<tr><th class="enca">Direccion:</th><td>'.utf8_encode($row[4]).'</td></tr>';
              	echo '<tr><th class="enca">Ciudad/Estado:</th><td>'.utf8_encode($row[2]).', '.utf8_encode($row[3]).'</td>';
              	echo '<th>Telefono:</th><td>'.utf8_encode($row[7]).'</td></tr>';
              	echo '<tr><th class="enca">Hora de Apertura:</th><td>'.utf8_encode($row[5]).'</td>';
              	echo '<th>Hora de Cierre:</th><td>'.utf8_encode($row[6]).'</td></tr>';
              	echo '<tr><td colspan="4" class="enca">';
              	echo "<a href='platillos.php?id=$row[0]'>Ver Platillos";
				echo '</td><tr>';
              	echo '</table></br>';
            }
	//}
	?>

