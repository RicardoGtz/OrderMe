<!DOCTYPE html>
<html lang="es">
<head>
	<title>Registro - OrderMe</title>
	<?php include('includes/links.php'); ?>
</head>
<?php
	include('includes/global.php');
	crearHeaders();
?>
<?php
	//include('includes/global.php');
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		include ('connectmysql.php');
		$errors = array();
		if (empty($_POST['id_sucursal']))
			$errors[] = 'Olvido introducir el ID de la Sucursal';
		else{
			$sucursal = trim($_POST['id_sucursal']);
			$sucursal = mysqli_real_escape_string($dbcon, $sucursal);
		}

		if (empty($_POST['nombre']))
			$errors[] = 'Olvido introducir el Nombre de la Sucursal';
		else{
			$nombre = trim($_POST['nombre']);
			$nombre = mysqli_real_escape_string($dbcon, $nombre);
		}

		if (empty($_POST['estado']))
			$errors[] = 'Olvido introducir el Estado';
		else{
			$estado = trim($_POST['estado']);
			$estado = mysqli_real_escape_string($dbcon, $estado);
		}

		if (empty($_POST['ciudad']))
			$errors[] = 'Olvido introducir la Ciudad';
		else{
			$ciudad = trim($_POST['ciudad']);
			$ciudad = mysqli_real_escape_string($dbcon, $ciudad);
		}

		if (empty($_POST['direccion']))
			$errors[] = 'Olvido introducir la direccion';
		else{
			$direccion = trim($_POST['direccion']);
			$direccion = mysqli_real_escape_string($dbcon, $direccion);
		}

		if (empty($_POST['h_apertura']))
			$errors[] = 'Olvido introducir el horario de apertura';
		else{
			$apertura = trim($_POST['h_apertura']);
			$apertura = mysqli_real_escape_string($dbcon, $apertura);
		}

		if (empty($_POST['h_cierre']))
			$errors[] = 'Olvido introducir el horario de cierre';
		else{
			$cierre = trim($_POST['h_cierre']);
			$cierre = mysqli_real_escape_string($dbcon, $cierre);
		}

		if (empty($_POST['telefono']))
			$errors[] = 'Olvido introducir el nombre del usuario';
		else{
			$telefono = trim($_POST['telefono']);
			$telefono = mysqli_real_escape_string($dbcon, $telefono);
		}

		if (empty($_POST['id_restaurante']))
			$errors[] = 'Olvido introducir el nombre del usuario';
		else{
			$restaurante = trim($_POST['id_restaurante']);
			$restaurante = mysqli_real_escape_string($dbcon, $restaurante);
		}

		if (empty($errors)){
			$query="select InsertarSucursal('$sucursal','$nombre','$ciudad','$estado','$direccion','$apertura','$cierre','$telefono','$restaurante') as resp";
			$res=@mysqli_query($dbcon,$query);
			$row=mysqli_fetch_assoc($res);
			$resp=$row['resp'];
			mysqli_close($dbcon);

			if($resp==1){
				echo '<h1>Muchas gracias!</h1>
							<p>Los datos han sido registrados en la base de datos!</p><p><br /></p>';
			}else	if($resp==2){
				echo '<h1>Atencion</h1>
							<p>No existe es combinacion de Ciudad y Provincia!</p><p><br /></p>';
			}else if($resp==3){
				echo '<h1>Atencion</h1>
							<p>No existe ese restaurante!</p><p><br /></p>';
			}else if($resp==0){
				echo '<h1>Atencion</h1>
							<p>Ya existe esa sucursal!</p><p><br /></p>';
			}
		}
	}// Fin de acciones cuando se envía el formulario
?>
<body>
	<div class="contenedor">
		<h1>Registrate</h1>
		<p></p>
		<p class="centrado">Por favor asegurate de llenar todos los campos del formulario para poder agregar la informacion al sistema</p>
		<div class="contenedor col-md-3 center-block fondoazul">
			<form action="sucursalInsert.php" method="POST">
				<p>ID de la sucursal</p><input type="text" name="id_sucursal" required maxlength="7" value=""><br>
				<p>Nombre de la Sucursal</p><input type="text" name="nombre" required maxlength="40" value=""><br>
				<!-- AQUI DESPLEGAR LISTA DE CIUDADES Y ESTADOS -->
				<p>Estado:</p><input type="text" name="estado" required maxlength="40" value=""><br>
				<p>Ciudad:</p><input type="text" name="ciudad" required maxlength="40" value=""><br>
				<!-- ******************************** -->
				<p>Direccion:</p><input type="text" name="direccion" required maxlength="40" value=""><br>
				<p>Hora de apertura:</p><input type="text" name="h_apertura" required maxlength="10" value=""><br>
				<p>Hora de cierre:</p><input type="text" name="h_cierre" required maxlength="10" value=""><br>
				<p>Telefono:</p><input type="text" name="telefono" required maxlength="10" value=""><br>
				<!-- AQUI DESPLEGAR LISTA DE RESTAURANTES -->
				<p>ID del restaurante:</p><input type="text" name="id_restaurante" required maxlength="7" value=""><br>
				<!-- ******************************** -->
				<input type="submit" value="Registrar" class="btn btn-success btn-primary">
			</form>
		</div>
	<p></p>
	</div>
	<?php include('includes/footer.html'); ?>
</body>
</html>
