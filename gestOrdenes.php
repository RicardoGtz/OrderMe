<!DOCTYPE html>
<html lang="es">
<meta charset="utf-8">
<head>
    <title>Órdenes y Pedidos - OrderMe</title>
    <?php include('includes/links.php'); ?>
</head>
<?php
	include('includes/global.php');
  require('connectmysql.php');
	crearHeaders();
  $id=$_SESSION['usuario'];
  //$id = "emp0001";
  echo $id;

?>
<body>
  <?php
  $query = "CALL getPendientes('".$id."');"; //Llamo al procedimiento almacenado para recuperar todo acerca de los platillos de un empleado que pertenece a una sucursal
  $resultado= mysqli_query($dbcon,$query); //Ejecuto la consulta
  $num = mysqli_num_fields($resultado); //Contar los resultados obtenidos
  if($num > 0) {
    while($raw = mysqli_fetch_array($resultado, MYSQLI_NUM)) {

      echo '
        <h1 align="center">Orden: '.$raw[0].'</h1>
        <h2>Fecha: '.$raw[1].' Mesa: '.$raw[2].' Estado: '.$raw[3].'</h2>
                <table class="tabla" align="center">
                  <tr>
                    <th class="titulo">Nombre Platillo</th>
                    <th class="titulo">Nota</th>
                    <th class="titulo">Estatus</th>
                    <th class="titulo"></th>
                    <th class="titulo"></th>
                  </tr>
                  <tr>
                    <td>'.$raw[4].'</td>
                    <td>'.$raw[5].'</td>
                    <td>'.$raw[6].'</td>
                    <td><button id="aprobar" type="button" onclick="apruebaPlatillo()">Aprobar</button></td>
                    <td><button type="button" onclick="rechazaPlatillo()">Rechazar</button></td>
                  </tr>
                </table>
              </div>
              <div align="center">
              <form action="http://google.com">
                  <input type="submit" value="Go to Google" />
              </form>
              <form action="http://yahoo.com">
                  <input type="submit" value="Go to Google" />
              </form>
            </div>'
            ;
    }
    echo $num.' resultados';
    mysqli_free_result($resultado);
    mysqli_close($dbcon);
  }
  else {
    echo '<h1>No existen órdenes al momento</h1>';
  }


  ?>
<?php
	include('includes/footer.html');
    //mysqli_close($dbcon);
?>
</body>
</html>
