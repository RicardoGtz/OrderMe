<!DOCTYPE html>
<html>
<head>
	<title>Orden - Administrador</title>
  <?php include('includes/links.php'); ?>
</head>
<?php
  error_reporting(0);
  include('connectmysql.php');
  if(isset($_GET['delete_id']))//Si esta puesto el get entonces se ejecuta, dice delete id pero realmente puede llevar cualquier valor, solo es renombrar la variable abajo en el boton
  {
    $ord=$_GET['delete_id'];//le doy el valor de los GET a variables ya que si lo hacia directo habia problemas con las comillas (cosas raras),
    $sql_query="call EliminarOrden('$ord')";
    $r= @mysqli_query($dbcon,$sql_query);
    header("Location: orden.php");
  }
?>
<?php
  include('includes/global.php');
  crearHeaders();
	$id=$_SESSION['usuario'];
  echo $id;
?>

<body>
<div class="contenedor">
  <h1 class="courgete">Ordenes</h1>
  <p></p>
  <p class="centrado">A continuacion, se mostrarán todas las ordenes creadas para ésta sucursal.</p>
    <?php
      if (@$_SESSION['user'] == 'administradorG'){
        echo "<div class='centrado'><input class='boto' type='button' name='insert' value='Insertar' onclick=location.href='ordinsert.php'></div>";
      }
    ?>
  <p></p>
  <div class="table-responsive">
    <table class="table table-striped">
        <thead>
          <tr>
            <th>Orden</th>
            <th>Sucursal</th>
            <th>Fecha</th>
            <th>Numero Mesa</th>
            <th>Total</th>
            <th>Estatus</th>
            <th>Usuario</th>
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
						$query = "CALL getOrdenesSuc('".$id."');";
            $sqldata= mysqli_query($dbcon,$query);

            while($row=mysqli_fetch_array($sqldata,MYSQLI_NUM)){
              echo "<tr><td>";
              echo $row[0];
              echo "</td><td>";
              echo $row[1];
              echo "</td><td>";
              echo $row[2];
              echo "</td><td>";
              echo $row[3];
              echo "</td><td>";
              echo $row[4];
              echo "</td><td>";
              echo $row[5];
              echo "</td><td>";
              echo $row[6];
              echo "</td>";
              if (@$_SESSION['user'] == 'administradorG'){
                echo "<td><a href='ordinsert.php?id=$row[0]&p=$row[1]'><img src='comun/img/sistema/act2.png' class='img-rounded'></td>";
                echo "<td><a href='orden.php?delete_id=$row[0]' onclick='return confirm('sure to delete !');'><img src='comun/img/sistema/eli2.png' alt='Delete' class='img-rounded'/></a></td>";
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
