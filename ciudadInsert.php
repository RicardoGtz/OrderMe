<!DOCTYPE html>
<html lang="es">
<head>
	<title>Ciudad - OrderMe</title>
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
		if (empty($_POST['nombre']))
			$errors[] = 'Olvido introducir la Ciudad';
		else{
			$ciudad = trim($_POST['nombre']);
			$ciudad = mysqli_real_escape_string($dbcon, $ciudad);
		}

		if (empty($_POST['provincia']))
			$errors[] = 'Olvido introducir el Estado';
		else{
			$provincia = trim($_POST['provincia']);
			$provincia = mysqli_real_escape_string($dbcon, $provincia);
		}

		if (empty($errors)){
			$query="select InsertarCiudad('$ciudad', '$provincia') as resp";
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
			<form action="ciudadInsert.php" method="POST">
        <p>Nombre de ciudad:</p><input type="text" name="nombre" required maxlength="40" value=""><br>
        <p>Provincia (Estado):</p><input type="text" name="provincia" required maxlength="40" value=""><br>
				<input type="submit" value="Registrar" class="btn btn-success btn-primary">
			</form>
		</div>
	<p></p>
	</div>
	<?php include('includes/footer.html'); ?>
</body>
</html>
