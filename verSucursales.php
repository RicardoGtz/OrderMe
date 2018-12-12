<!DOCTYPE html>
<html lang="es">
<head>
	<title>Sucursales - OrderMe</title>
	<?php include('includes/links.php'); ?>
</head>
<?php
error_reporting(0);
	include('includes/global.php');
	session_start();
    if (@$_SESSION['user'] == 'administradorR'){
    	crearHeaders();
    }
    else{
      header("Location:inicio.php");
    }
	
?>
<?php
include('connectmysql.php');
if(isset($_GET['del_emp']))
{
  $succ=$_GET['del_suc'];
  $sql_query="call EliminarSucursal('$emp')";
  $r= @mysqli_query($dbcon,$sql_query);
  header("Location: verSucursales.php");
}

?>
<body>
	<div class="contenedor">
		<h1>Sucursales</h1>
		<p></p>
		<p class="centrado">Por favor asegurate de llenar todos los campos del formulario para poder agregar la informacion al sistema</p>
		<div class="table-responsive">
    <table class="table table-striped">
        <thead>
          <tr>
            <th>Id Sucursal</th>
            <th>Nombre</th>
            <th>Estado</th>
            <th>Ciudad</th>
            <th>Direccion</th>
            <th>Hora apertura</th>
            <th>Hora cierre</th>
            <th>Telefono</th>
            <th>Editar</th>
            <th>Eliminar</th>
          </tr>
        </thead>
        <tbody>
          <?php
            include('connectmysql.php');
            $usuario=$_SESSION['usuario'];
            $sqldata= mysqli_query($dbcon,"call VerSucursalRestaurante('$usuario')");
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
              echo "</td><td>";
              echo utf8_encode($row[6]);
              echo "</td><td>";
              echo utf8_encode($row[7]);

              echo "</td>";
              echo "<td><a href='insertarSucc.php?id=$row[0]&nom=$row[1]&est=$row[2]&ciu=$row[3]&dir=$row[4]&ha=$row[5]&hc=$row[6]&tel=$row[7]'><img src='comun/img/sistema/act2.png' class='img-rounded'></td>";
              echo "<td><a href='verSucursales.php?del_suc=$row[0]'><img src='comun/img/sistema/eli2.png' class='img-rounded'/></a></td>";
              echo "<tr>";
              
            }
          ?>
        </tbody>
      </table>
    </table>
  </div>
	<p></p>
	</div>
	<?php include('includes/footer.html'); ?>
</body>
</html>
