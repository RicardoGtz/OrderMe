<!DOCTYPE html>
<html lang="es">
<head>
	<title>Tiene - Administrador</title>
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
		if (empty($_POST['platillo']))
			$errors[] = 'Olvido introducir la ID del Platillo';
		else{
			$platillo = trim($_POST['platillo']);
			$platillo = mysqli_real_escape_string($dbcon, $platillo);
		}

		if (empty($_POST['sucursal']))
			$errors[] = 'Olvido introducir el Estado';
		else{
			$sucursal = trim($_POST['sucursal']);
			$sucursal = mysqli_real_escape_string($dbcon, $sucursal);
		}

		if (empty($errors)){
			$query="select InsertarTiene('$platillo', '$sucursal') as resp";
			$res=@mysqli_query($dbcon,$query);
			$row=mysqli_fetch_assoc($res);
			$resp=$row['resp'];

			if($resp==1){
				echo '<h1>Muchas gracias!</h1>
					<p>Los datos han sido registrados en la base de datos!</p><p><br /></p>';
			}
			else{
				if($resp==0){
					echo '<h1>Atencion</h1>
						<p>El registro ya existe!</p><p><br /></p>';
				}
			}
		}
		mysqli_close($dbcon);
	}// Fin de acciones cuando se envía el formulario
?>
<body>
	<div class="contenedor">
		<h1>Insertar Ciudad</h1>
		<p></p>
		<p class="centrado">Por favor asegurate de llenar todos los campos del formulario para poder agregar la informacion al sistema</p>
		<div class="contenedor col-md-3 center-block fondoazul">
			<form action="tieneInsert.php" method="POST">
        <p>ID del Platillo:</p><input type="text" name="platillo" required maxlength="40" value=""><br>
        <p>ID de la Sucursal:</p><input type="text" name="sucursal" required maxlength="40" value=""><br>
				<input type="submit" value="Registrar" class="btn btn-success btn-primary">
			</form>
		</div>
	<p></p>
	</div>
	<?php include('includes/footer.html'); ?>
</body>
</html>
