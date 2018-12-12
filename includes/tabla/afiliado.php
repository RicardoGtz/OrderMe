<?php
    include('../../connectmysql.php');
		$sqldata= mysqli_query($dbcon,"call VerRestaurante()");
            while($row=mysqli_fetch_array($sqldata,MYSQLI_NUM)){
              	echo '<table class="table table-striped">';
              	echo '<tr><th colspan="4" scope="col">'.utf8_encode($row[1]).'</th></tr scope="row">';
              	echo '<tr><td colspan="4">';
              	echo "<br/>";
              	echo "
              		<a href='sucursales.php?id=$row[0]&p=$row[1]' class='btn btn-secondary' role='button' aria-pressed='true'>Ver Sucursales</a>
              	";
              	echo "<br/>";
				echo '</td><tr>';
				echo "<br/>";
				echo '</table>';
            }
?>