<!DOCTYPE html>
<html>
<head>
	<title>Empleado - Administrador</title>
  <?php include('includes/links.php'); ?>
</head>
<?php
  error_reporting(0);
  include('connectmysql.php');
  if(isset($_GET['delete_id']))//Si esta puesto el get entonces se ejecuta, dice delete id pero realmente puede llevar cualquier valor, solo es renombrar la variable abajo en el boton
  {
    $emp=$_GET['delete_id'];//le doy el valor de los GET a variables ya que si lo hacia directo habia problemas con las comillas (cosas raras),
    $sql_query="call EliminarEmpleado('$emp')";
    $r= @mysqli_query($dbcon,$sql_query);
    header("Location: empleado.php");
  }
?>
<?php
  include('includes/global.php');
  crearHeaders();
?>

<body>
<div class="contenedor">
  <h1 class="courgete">Empleados</h1>
  <p></p>
  <p class="centrado">A continuacion, se mostrara el catalogo de los empleados registrados por los restaurantes y asignados a sucursales.</p>
    <?php
      if (@$_SESSION['user'] == 'administradorG'){
        echo "<div class='centrado'><input class='boto' type='button' name='insert' value='Insertar' onclick=location.href='empleadoInsert.php'></div>";
      }
    ?>
  <p></p>
  <div class="table-responsive">
    <table class="table table-striped">
        <thead>
          <tr>
            <th>Empleado</th>
            <th>Nombre</th>
            <th>Contraseña</th>
            <th>Correo</th>
            <th>Telefono</th>
            <th>Sucursal</th>
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
            $sqldata= mysqli_query($dbcon,"call VerEmpleado()");

            while($row=mysqli_fetch_array($sqldata,MYSQLI_NUM)){
              echo "<tr><td>";
              echo utf8_encode($row[0]);
              echo "</td><td>";
              echo utf8_encode($row[1]);
              echo "</td><td>";
              echo utf8_encode($row[2]);
              echo "</td><td>";
              echo utf8_encode($row[3]);
              echo "</td><td>";
              echo utf8_encode($row[4]);
              echo "</td><td>";
              echo utf8_encode($row[5]);
              echo "</td>";
              if (@$_SESSION['user'] == 'administradorG'){
                echo "<td><a href='empleadoInsert.php?id=$row[0]'><img src='comun/img/sistema/act2.png' class='img-rounded'></td>";
                echo "<td><a href='empleado.php?delete_id=$row[0]' onclick='return confirm('sure to delete !');'><img src='comun/img/sistema/eli2.png' alt='Delete' class='img-rounded'/></a></td>";
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
