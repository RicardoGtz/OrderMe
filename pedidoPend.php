<!DOCTYPE html>
<html lang="es">
<head>
	<title>Pedidos Pendientes - OrderMe</title>
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
  $can=$_GET['cancela'];
  $p=$_GET['pla'];
  //$sql_query= "UPDATE orden SET estatus = 'Pendiente' WHERE orden.id_orden = '$can'";
  $r= @mysqli_query($dbcon,"update Pedido set estatus = 'Cancelado' WHERE orden.id_orden = '$can' and orden.id_platillo = '$p'");
  header("Location: ordenPend.php");
}

?>
<body>
	<div class="contenedor">
		<h1>Pedidos Pendientes</h1>
		<p></p>
		<p class="centrado">Los siguientes pedidos faltan por confirmar:</p>
		<div class="table-responsive">
    <table class="table table-striped">
        <thead>
          <tr>
            <th>Id Orden</th>
            <th>Id Platillo</th>
            <th>Nota</th>
            <th>Estatus</th>
            <th>Cancelar</th>
          </tr>
        </thead>
        <tbody>
          <?php
            include('connectmysql.php');
            $usuario=$_SESSION['usuario'];
            $pedido=$_GET['idor'];
            $sqldata= mysqli_query($dbcon,"call VerPedidoOrden('$pedido')");
            while($row=mysqli_fetch_array($sqldata,MYSQLI_NUM)){
              echo "<tr><td>";
              echo utf8_encode($row[0]);
              echo "</td><td>";
              echo utf8_encode($row[1]);
              echo "</td><td>";
              echo utf8_encode($row[2]);
              echo "</td><td>";
              echo utf8_encode($row[3]);
              echo "</td>";
              //echo "<td><a href='insertarEmp.php?id=$row[0]&nom=$row[1]&tel=$row[3]&cor=$row[4]&succc=$row[6]'><img src='comun/img/sistema/act2.png' class='img-rounded'></td>";
              echo "<td><a href='pedidoPend.php?cancela=$row[0]&pla=$row[1]'><img src='comun/img/sistema/eli2.png' class='img-rounded'/></a></td>";
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
