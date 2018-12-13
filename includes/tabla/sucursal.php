<?php
$id=$_REQUEST['id'];
$res=$_REQUEST['res'];
?>
<?php
                include('../../connectmysql.php');
                $sqldata= mysqli_query($dbcon,"call VerSucursalRestaurante('$id')");

                while($row=mysqli_fetch_array($sqldata,MYSQLI_NUM)){
                    echo '<table class="table ">';
                    echo '<thead class="thead-dark"><tr><th colspan="4">'.$res.' '.utf8_encode($row[1]).'</th></tr></thead>';
                    echo '<tr><th >Direccion:</th><td>'.utf8_encode($row[4]).'</td></tr>';
                    echo '<tr><th>Ciudad/Estado:</th><td>'.utf8_encode($row[2]).', '.utf8_encode($row[3]).'</td>';
                    echo '<th>Telefono:</th><td>'.utf8_encode($row[7]).'</td></tr>';
                    echo '<tr><th>Hora de Apertura:</th><td>'.utf8_encode($row[5]).'</td>';
                    echo '<th>Hora de Cierre:</th><td>'.utf8_encode($row[6]).'</td></tr>';
                    echo '<tr><td colspan="4">';
                    echo '</td><tr>';
                    echo '</table></br>';
                }
            ?>