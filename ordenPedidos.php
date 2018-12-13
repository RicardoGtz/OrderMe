<?php
include('includes/global.php');
	session_start();
    if (@$_SESSION['user']='cliente'){
    	crearHeaders();
    	echo $_SESSION['usuario'];
    	if(isset($_GET['id'])){
    		$_SESSION['idsuc']=$_GET['id'];
    	}

    }
    else{
      header("Location:inicio.php");
    }
	include('includes/producto.php');
	include('includes/carrito.php');
	$product = new Product();
	$cart = new Cart();
	if(isset($_GET['action'])){
		switch ($_GET['action']){
			case 'add':
				$cart->add_item($_GET['code'], $_GET['amount']);
			break;
			case 'remove':
				$cart->remove_item($_GET['code']);
			break;
		}
	}
	//$idsucursal=$_GET['id'];
	//echo $idsucursal;
echo $_SESSION["cart"];
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$c=$_SESSION["cart"];
		include ('connectmysql.php');
		//$idorden->generar();
		$query="select InsertarOrden('".$_SESSION['idsuc']."','".getdate()."','9','".$SESSION['cart']."','Pendiente','".$_SESSION['usuario']."'') as resp";
		$res=@mysqli_query($dbcon,$query[0]);
		//select para idorden
		$query2="select id_orden from Orden where id_sucursal = '".$_SESSION['idsuc']."', fecha = '".getdate()."', num_mesa = '9', total = '".$c['amount']."', estatus = 'Pendiente', id_usuario ='".$_SESSION['idsuc']."'";
		$res2=@mysqli_query($dbcon,$query2);

		foreach($_SESSION["cart"] as $c){
		$query3 = "select InsertarPedido('".$query2."','".$c['id_platillo']."','','Procesada')as resp";
		$res3=@mysqli_query($dbcon,$query3);
		}
		unset($_SESSION["cart"]);
		$res=@mysqli_query($dbcon,$query);
      	$row=mysqli_fetch_assoc($res);

	    if($row['resp']==1)
	    {
	      echo '<h1>Muchas gracias!</h1>
	           <p>Sus datos han sido registrados en la base de datos!</p><p><br /></p>';
	    }
	    else
	    {
	      if($row['resp']==-3)
	      {
	        echo '<h1>Atencion</h1>
	              <p>Error en las llaves foraneas</p><p><br /></p>';
	      }

	      if($row['resp']==-2)
	      {
	        echo '<h1>Atencion</h1>
	              <p>La llave primaria a actualizar ya existe!</p><p><br /></p>';
	      }

	      if($row['resp']==-1)
	      {
	        echo '<h1>Atencion</h1>
	              <p>El registro que deseas modificar no existe!</p><p><br /></p>';
	      }
	    }
	  // Cerrar la conexión a la base de datos
	    mysqli_close($dbcon);
	  }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Haz tu Orden</title>
	<script type="text/javascript" src="comun/js/functions.js"></script>
	<link rel="stylesheet" type="text/css" href="comun/css/styles.css">
	<?php include('includes/links.php'); ?>
</head>
<body>
	<div class="content">
		<!--<form action="ordenPedidos.php" method="POST">-->
		<table border="1px" cellpadding="5px" width="100%">
			<thead class="cartHeader" display="off">
				<tr>
					<th colspan="6">MI ORDEN</th>

				</tr>
				<tr>
					<th colspan="3">Total a pagar: <?=$cart->get_total_payment();?></th>
					<th colspan="3">Total de platillos: <?=$cart->get_total_items();?></th>
				</tr>
			</thead>
			<tbody class="cartBody">
				<tr>
					<th>Codigo</th>
					<th>Platillo</th>
					<th>Precio</th>
					<th>Cantidad</th>
					<th>Subtotal</th>
					<th>Opcion</th>
				</tr>
				<?=$cart->get_items();?>
				<form action="ordenPedidos.php" method="POST">
				<th colspan="6"><input type="submit" value="Confirmar" class="btn btn-success btn-primary"></th>
				</form>
			</tbody>
		</table>
		
		<br><br>
		<table border="1px" cellpadding="5px" width="100%">
			<thead class="productsHeader">
				<tr>
					<th colspan="6">LISTA DE PLATILLOS</th>
				</tr>
				<tr>
					<th>Codigo</th>
					<th>Platillo</th>
					<th>Descripcion</th>
					<th>Precio</th>
					<th>Cantidad</th>
					<th>Opcion</th>
				</tr>
			</thead>
			<tbody class="productsBody">
				<?=$product->get_products();?>
			</tbody>
		</table>
		<input type="hidden" name="idsuc" value="<?php echo $_GET['id'];?>"/>
	</div>
	<?php include('includes/footer.html'); ?>
</body>
</html>
