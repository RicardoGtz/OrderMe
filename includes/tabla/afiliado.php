<?php
    include('../../connectmysql.php');
		$sqldata= mysqli_query($dbcon,"call VerRestaurante()");
            while($row=mysqli_fetch_array($sqldata,MYSQLI_NUM)){
              	echo '<table class="table table-striped">';
                	echo '<tr>';
                    echo '';
                    echo '<td>'.utf8_encode($row[1]).'';
                    echo'</td>';
                    echo "<td>";
                    echo "<div class='text-right'>";
                    echo "
                    <a href='sucursales.php?id=$row[0]&p=$row[1]' class='btn btn-secondary ' role='button' aria-pressed='true'>Ver Sucursales</a>
                    ";
                    echo "</div>";
                    echo'</td>';
                  echo '</tr>';
  				        echo "<br/>";
				        echo '</table>';
            }
?>

