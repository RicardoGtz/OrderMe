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
		$errors = array();
		$errors=checarUsuario($errors);

		if (empty($errors)){
			$resp=insertarUsuario();

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
				<p>Estado:</p><input type="text" mane="estado" required maxlength="40" value=""><br>
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
