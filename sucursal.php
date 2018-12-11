<!DOCTYPE html>
<html>
<head>
	<title>Sucursal - Administrador</title>
  <?php include('includes/links.php'); ?>
</head>
<?php
  error_reporting(0);
  include('connectmysql.php');
  if(isset($_GET['delete_id']))//Si esta puesto el get entonces se ejecuta, dice delete id pero realmente puede llevar cualquier valor, solo es renombrar la variable abajo en el boton
  {
    $suc=$_GET['delete_id'];//le doy el valor de los GET a variables ya que si lo hacia directo habia problemas con las comillas (cosas raras),
    $sql_query="call EliminarSucursal('$suc')";
    $r= @mysqli_query($dbcon,$sql_query);
    header("Location: sucursal.php");
  }
?>
<?php
  include('includes/global.php');
  crearHeaders();
?>

<body>
<div class="contenedor">
  <h1 class="courgete">Sucursales</h1>
  <p></p>
  <p class="centrado">A continuacion, se mostrara el catalogo de las sucursales que pertenecen a cada restaurante.</p>
    <?php
      if (@$_SESSION['user'] == 'administradorG'){
        echo "<div class='centrado'><input class='boto' type='button' name='insert' value='Insertar' onclick=location.href='sucinsert.php'></div>";
      }
    ?>
  <p></p>
  <div class="table-responsive">
    <table class="table table-striped">
        <thead>
          <tr>
            <th>Sucursal</th>
            <th>Nombre</th>
            <th>Ciudad/Estado</th>
            <th>Direccion</th>
            <th>Telefono</th>
            <th>Restaurante</th>
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
            if($_SESSION['user']=='administradorG')
              $sqldata= mysqli_query($dbcon,"call VerSucursal()");
            if($_SESSION['user']=='administradorL')
              $sqldata= mysqli_query($dbcon,"call VerSucursal()");

            while($row=mysqli_fetch_array($sqldata,MYSQLI_NUM)){
              echo "<tr><td>";
              echo utf8_encode($row[0]);
              echo "</td><td>";
              echo utf8_encode($row[1]);
              echo "</td><td>";
              echo utf8_encode($row[2]).', '.utf8_encode($row[3]);
              echo "</td><td>";
              echo utf8_encode($row[4]);
              echo "</td><td>";
              echo utf8_encode($row[7]);
              echo "</td><td>";
              echo utf8_encode($row[8]);
              echo "</td>";
              if (@$_SESSION['user'] == 'administradorG'){
                echo "<td><a href='sucinsert.php?id=$row[0]&p=$row[1]'><img src='comun/img/sistema/act2.png' class='img-rounded'></td>";
                echo "<td><a href='sucursal.php?delete_id=$row[0]' onclick='return confirm('sure to delete !');'><img src='comun/img/sistema/eli2.png' alt='Delete' class='img-rounded'/></a></td>";
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
