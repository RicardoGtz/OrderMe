<!DOCTYPE html>
<html lang="es">
<head>
	<title>Empleados - OrderMe</title>
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
  $emp=$_GET['del_emp'];
  $sql_query="call EliminarEmpleado('$emp')";
  $r= @mysqli_query($dbcon,$sql_query);
  header("Location: verEmp.php");
}

?>
<body>
	<div class="contenedor">
		<h1>Empleados</h1>
		<p></p>
		<p class="centrado">Por favor asegurate de llenar todos los campos del formulario para poder agregar la informacion al sistema</p>
		<div class="table-responsive">
    <table class="table table-striped">
        <thead>
          <tr>
            <th>Id Empleado</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Telefono</th>
            <th>Sucursal</th>
            <th>Editar</th>
            <th>Eliminar</th>
          </tr>
        </thead>
        <tbody>
          <?php
            include('connectmysql.php');
            $usuario=$_SESSION['usuario'];
            $sqldata= mysqli_query($dbcon,"Select * from Empleado where id_sucursal in (select id_sucursal from Sucursal where id_restaurante in (select id_restaurante from Administrador where usuario='$usuario'))");
            while($row=mysqli_fetch_array($sqldata,MYSQLI_NUM)){
              echo "<tr><td>";
              echo utf8_encode($row[0]);
              echo "</td><td>";
              echo utf8_encode($row[1]);
              echo "</td><td>";
              echo utf8_encode($row[3]);
              echo "</td><td>";
              echo utf8_encode($row[4]);
              echo "</td><td>";
              echo utf8_encode($row[5]);
              echo "</td>";
              echo "<td><a href='insertarEmp.php?id=$row[0]&nom=$row[1]&tel=$row[3]&cor=$row[4]&succc=$row[6]'><img src='comun/img/sistema/act2.png' class='img-rounded'></td>";
              echo "<td><a href='verEmp.php?del_emp=$row[0]'><img src='comun/img/sistema/eli2.png' class='img-rounded'/></a></td>";
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
