<!DOCTYPE html>
<html lang="es">
<meta charset="utf-8">
<head>
    <title>Platillos de Sucursal - OrderMe</title>
    <?php include('includes/links.php'); ?>
</head>
<?php
	include('includes/global.php');
  require('connectmysql.php');
	crearHeaders();
  $id=$_SESSION['usuario'];
  //echo "el id: $id";
  echo '<h2>Platillos que maneja ésta sucursal</h2>';
  //Comienza consulta a BD
  $query = "CALL getPlatillos('".$id."')"; //Llamo al procedimiento almacenado para recuperar todo acerca de los platillos de un empleado que pertenece a una sucursal
  $resultado= mysqli_query($dbcon,$query); //Ejecuto la consulta
  $num = mysqli_num_rows($resultado); //Contar los resultados obtenidos

  if($num > 0) {
    while($row = mysqli_fetch_array($resultado, MYSQLI_NUM)) {
      echo '<table class="tabla" align="center">';
      /*echo '<tr><th colspan="4" class="titulo">Nombre</th><th colspan="4" class="titulo">dfd</th></tr>';
      echo '<td>jbhb</td><td>ddfdfs</td>';*/
      echo '<tr>';
      echo '<th class="titulo">Nombre</th>';
      echo '<th class="titulo">Descripcion</th>';
      echo '<th class="titulo">Precio</th>';
      echo '</tr>';

      echo '<tr>';
      echo '<td>'.$row[0].'</td>';
      echo '<td>'.$row[1].'</td>';
      echo '<td>'.$row[2].'</td>';
      echo '</tr>';

      echo '</table>';
    }
  }
  else {
    //echo '<script>alert("No existen platillos actualmente")</script>';
  }

?>
<body>

<?php
	include('includes/footer.html');
?>
</body>
</html>
