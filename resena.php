<!DOCTYPE html>
<html>
<head>
	<title>Reseñas - Administrador</title>
  <?php include('includes/links.php'); ?>
</head>
<?php
  error_reporting(0);
  include('connectmysql.php');
  if(isset($_GET['delete_id']))//Si esta puesto el get entonces se ejecuta, dice delete id pero realmente puede llevar cualquier valor, solo es renombrar la variable abajo en el boton
  {
    $pla=$_GET['delete_id'];//le doy el valor de los GET a variables ya que si lo hacia directo habia problemas con las comillas (cosas raras),
    $usu=$_GET['usua'];
    $sql_query="call EliminarResena('$pla','$usu')";
    $r= @mysqli_query($dbcon,$sql_query);
    header("Location: resena.php");
  }
?>
<?php
  include('includes/global.php');
  crearHeaders();
?>

<body>
<div class="contenedor">
  <h1 class="courgete">Reseñas</h1>
  <p></p>
  <p class="centrado">A continuacion, se mostrarán las reseñas que los usuarios escriben sobre los platillos.</p>
  <p></p>
  <div class="table-responsive">
    <table class="table table-striped">
        <thead>
          <tr>
            <th>Platillo</th>
            <th>Usuario</th>
            <th>Calificacion</th>
            <th>Comentario</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $sqldata= mysqli_query($dbcon,"call VerResena()");

            while($row=mysqli_fetch_array($sqldata,MYSQLI_NUM)){
              echo "<tr><td>";
              echo utf8_encode($row[2]);
              echo "</td><td>";
              echo utf8_encode($row[3]);
              echo "</td><td>";
              echo utf8_encode($row[4]);
              echo "</td><td>";
              echo utf8_encode($row[5]);
              echo "</td>";
            }
          ?>
        </tbody>
      </table>
  </div>
  <?php include('includes/footer.html'); ?>
</div>
</body>
</html>
