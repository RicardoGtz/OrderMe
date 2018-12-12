<!DOCTYPE html>
<html>
<head>
	<title>Platillo - Administrador</title>
  <?php include('includes/links.php'); ?>
</head>
<?php
  error_reporting(0);
  include('connectmysql.php');
  if(isset($_GET['delete_id']))//Si esta puesto el get entonces se ejecuta, dice delete id pero realmente puede llevar cualquier valor, solo es renombrar la variable abajo en el boton
  {
    $pla=$_GET['delete_id'];//le doy el valor de los GET a variables ya que si lo hacia directo habia problemas con las comillas (cosas raras),
    $sql_query="call EliminarPlatillo('$pla')";
    $r= @mysqli_query($dbcon,$sql_query);
    header("Location: platillo.php");
  }
?>
<?php
  include('includes/global.php');
  crearHeaders();
?>

<body>
<div class="contenedor">
  <h1 class="courgete">Platillos</h1>
  <p></p>
  <p class="centrado">A continuacion, se mostrara el catalogo de todos los platillos registrados para la aplicación OrderMe."</p>
    <?php
      if (@$_SESSION['user'] == 'administradorG'){
        echo "<div class='centrado'><input class='boto' type='button' name='insert' value='Insertar' onclick=location.href='platilloInsert.php'></div>";
      }
    ?>
  <p></p>
  <div class="table-responsive">
    <table class="table table-striped">
        <thead>
          <tr>
            <th>Platillo</th>
            <th>Nombre</th>
            <th>Descripcion</th>
            <th>Precio</th>
            <th>Fotografia</th>
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
            $sqldata= mysqli_query($dbcon,"call VerPlatillo()");

            while($row=mysqli_fetch_array($sqldata,MYSQLI_NUM)){
              echo "<tr><td>";
              echo utf8_encode($row[0]);
              echo "</td><td>";
              echo utf8_encode($row[1]);
              echo "</td><td>";
              echo utf8_encode($row[2]);
              echo "</td><td>";
              echo '$'.utf8_encode($row[3]);
              echo "</td><td>";
              echo utf8_encode($row[4]);
              echo "</td>";
              if (@$_SESSION['user'] == 'administradorG'){
                echo "<td><a href='plainsert.php?id=$row[0]'><img src='comun/img/sistema/act2.png' class='img-rounded'></td>";
                echo "<td><a href='platillo.php?delete_id=$row[0]' onclick='return confirm('sure to delete !');'><img src='comun/img/sistema/eli2.png' alt='Delete' class='img-rounded'/></a></td>";
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
