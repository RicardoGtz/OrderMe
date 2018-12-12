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
  echo $id;
?>
<body>
  <?php
  $query = "CALL verOrden();"; //Llamo al procedimiento almacenado para recuperar todo acerca de los platillos de un empleado que pertenece a una sucursal
  $resultado= mysqli_query($dbcon,$query); //Ejecuto la consulta
  $num = mysqli_num_rows($resultado); //Contar los resultados obtenidos
  if($num > 0) {
    while($row = mysqli_fetch_array($resultado, MYSQLI_NUM)) {
      echo '<div align="center">
            <h1>Órden: '.$row[0].'</h1>
            <h2>Fecha: '.$row[2].' Mesa: '.$row[3].' Estatus: '.$row[5].'</h2>
            <div align="center">

            </div>
            </div>';
    }
  }
  else {
    echo '<h1>No existen órdenes al momento</h1>';
  }
  $query2 = ""
  mysqli_close($dbcon);
  ?>
<?php
	include('includes/footer.html');
?>
</body>
</html>
