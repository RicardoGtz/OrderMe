<!DOCTYPE html>
<html lang="es">
<head>
    <title>Restaurantes - OrderMe</title>
    <?php include('includes/links.php'); ?>
</head>
<?php
	include('includes/global.php');
	crearHeaders();
  $id=$_SESSION['usuario'];
  echo "$id";
  include('connectmysql.php');
  if(isset($_GET['orden']))//Si esta puesto el get entonces se ejecuta, dice delete id pero realmente puede llevar cualquier valor, solo es renombrar la variable abajo en el boton
  {
    $orden=$_GET['orden'];//le doy el valor de los GET a variables ya que si lo hacia directo habia problemas con las comillas (cosas raras),
    $sql_query="call EliminarOrden('$orden')";
    $r= @mysqli_query($dbcon,$sql_query);
    header("Location: pendientes.php");
  }
?>
<body>
	<?php
		$sqldata= mysqli_query($dbcon,"call VerOrdenPendiente('$id')");

    while($row=mysqli_fetch_array($sqldata,MYSQLI_NUM)){
        echo '<table class="tabla">';
        echo '<tr><th colspan="4" class="titulo">'.utf8_encode($row[0]).'</th></tr>';
        echo '<tr><th class="enca">Sucursal:</th><td>'.utf8_encode($row[2]).'</td>';
        echo '<th class="enca">Fecha:</th><td>'.utf8_encode($row[3]).'</td></tr>';
        echo '<tr><th class="enca">Numero de Mesa:</th><td>'.utf8_encode($row[4]).'</td>';
        echo '<th class="enca">Total:</th><td>$'.utf8_encode($row[5]).'</td></tr>';
        echo '<tr><th class="enca">Estatus:</th><td>'.utf8_encode($row[6]).'</td></tr>';
        echo '<tr><td class="enca">';
        echo "<a href='pendientes.php?orden=$row[0]'>Cancelar Orden";
  echo '</td></tr>';
        echo '</table></br>';
      }
	?>
<?php
	include('includes/footer.html');
?>
</body>
</html>
