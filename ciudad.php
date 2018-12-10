<?php
  error_reporting(0);

  include('connectmysql.php');
if(isset($_GET['delete_id']))//Si esta puesto el get entonces se ejecuta, dice delete id pero realmente puede llevar cualquier valor, solo es renombrar la variable abajo en el boton
{
  $ciu=$_GET['delete_id'];//le doy el valor de los GET a variables ya que si lo hacia directo habia problemas con las comillas (cosas raras), 
  $pro=$_GET['provinc'];
  $sql_query="call EliminarCiudad('$ciu','$pro')";
  $r= @mysqli_query($dbcon,$sql_query);
  header("Location: ciudad.php");
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
	<title>Ciudad</title>
	<link rel="stylesheet" type="text/css" href="comun/librerias/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="comun/css/estilo.css">
	<script src="comun/librerias/bootstrap/js/bootstrap.js"></script>

</head>

<?php
  include('includes/global.php');
  crearHeaders();
?>

<body>
<div class="contenedor">
  <h1 class="courgete">Ciudades</h1>
  <p></p>
  <p class="centrado">A continuacion, se mostrara el catalogo de los las ciudades donde trabaja la empresa Farmacias "El Dorado"</p>
    <?php 
      if (@$_SESSION['user'] == 'administradorG'){
        echo "<div class='centrado'><input class='boto' type='button' name='insert' value='Insertar' onclick=location.href='cityinsert.php'></div>";
      }
    ?>  
  <p></p>
  <div class="table-responsive">
    <table class="table table-striped">
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Provincia</th>
            <?php 
            if (@$_SESSION['user'] == 'administradorG'){
              echo "<th>Editar</th>";
              echo "<th>Eliminar</th>";
            }
            ?>
          </tr>
        </thead>
        <tbody>
          <?php
            include('connectmysql.php');
            
            $sqldata= mysqli_query($dbcon,"call VerCiudad()");

            while($row=mysqli_fetch_array($sqldata,MYSQLI_NUM)){
              echo "<tr><td>";
              echo utf8_encode($row[0]);
              echo "</td><td>";
              echo utf8_encode($row[1]);
              echo "</td>";
              if (@$_SESSION['user'] == 'administradorG'){
                echo "<td><a href='cityinsert.php?id=$row[0]&p=$row[1]'><img src='comun/img/sistema/act2.png' class='img-rounded'></td>";
                echo "<td><a href='ciudad.php?delete_id=$row[0]&provinc=$row[1]' onclick='return confirm('sure to delete !');'><img src='comun/img/sistema/eli2.png' alt='Delete' class='img-rounded'/></a></td>";
                echo "<tr>";
              }
            }
          ?>
        </tbody>
      </table>
  </div>
  <?php include('includes/footer.html'); ?>
</div>
</body>
</html>