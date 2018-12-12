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
    if (@$_SESSION['user']){
    	crearHeaders();
    }
    else{
      header("Location:inicio.php");
    }
	
?>
<?php
include('connectmysql.php');
if(isset($_GET['cancela']))
{
  echo "hola";
  //$can=$_GET['cancela'];
  $can=trim($_POST['c']);
  //$sql_query= "UPDATE orden SET estatus = 'Pendiente' WHERE orden.id_orden = '$can'";
  $r= @mysqli_query($dbcon,"update Orden set estatus = 'Rechazada' WHERE orden.id_orden = '$can'");
  header("Location: ordenPend.php");
}

?>
<body>
	<div class="contenedor">
		<h1>Pedidos Pendientes</h1>
		<p></p>
		<p class="centrado">Por favor asegurate de llenar todos los campos del formulario para poder agregar la informacion al sistema</p>
		<div class="table-responsive">
    <table class="table table-striped">
        <thead>
          <tr>
            <th>Id Orden</th>
            <th>Id Sucursal</th>
            <th>Fecha</th>
            <th>Mesa</th>
            <th>Total($)</th>
            <th>Estatus</th>
            <th>Ver Pedidos</th>
            <th>Cancelar</th>
          </tr>
        </thead>
        <tbody>
          <?php
            include('connectmysql.php');
            $usuario=$_SESSION['usuario'];
            $sqldata= mysqli_query($dbcon,"Select Orden.id_orden, Orden.id_sucursal, Sucursal.nombre, Orden.fecha, Orden.num_mesa, Orden.total, Orden.estatus from Orden join Sucursal on Orden.id_sucursal=Sucursal.id_sucursal and Orden.id_usuario='usu0001' where Orden.estatus = 'Pendiente'");
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
              //echo "<td><a href='insertarEmp.php?id=$row[0]&nom=$row[1]&tel=$row[3]&cor=$row[4]&succc=$row[6]'><img src='comun/img/sistema/act2.png' class='img-rounded'></td>";
              echo "<td><a href='pedidoPend.php?idor=$row[0]'><img src='comun/img/sistema/eli2.png' class='img-rounded'/></a></td>";
              echo "<td><a href='ordenPend.php?cancela=$row[0]'><img src='comun/img/sistema/eli2.png' class='img-rounded'/></a></td>";
              echo "<tr>";
              
            }
          ?>
        </tbody>
      </table>
    </table>
    <input type="hidden" name="c" value="<?php echo $_GET['cancela']; ?>" />
  </div>
	<p></p>
	</div>
	<?php include('includes/footer.html'); ?>
</body>
</html>
