<!DOCTYPE html>
<html lang="es">
<head>
	<title>Restaurante - Administrador</title>
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

		//Proceso de Insert
		if(!empty($_POST['restAnt'])){
			$restAnt = trim($_POST['restAnt']);
			$restAnt = mysqli_real_escape_string($dbcon, $restAnt);

			$restaurante = trim($_POST['restaurante']);
			$restaurante = mysqli_real_escape_string($dbcon, $restaurante);

			$nombre = trim($_POST['nombre']);
			$nombre = mysqli_real_escape_string($dbcon, $nombre);

			$query="select ActualizarRestaurante('$restAnt', '$restaurante', '$nombre') as resp";
			$res=@mysqli_query($dbcon,$query);
			$row=mysqli_fetch_assoc($res);
			$resp=$row['resp'];

			echo "$resp";
			if($resp==1){
				echo '<h1>Muchas gracias!</h1>
					<p>Los datos han sido actualizados en la base de datos!</p><p><br /></p>';
			}
			else{
				if($resp==2){
					echo '<h1>Atencion</h1>
						<p>El registro que intentas actualizar ya existe!</p><p><br /></p>';
				}
			}
		}

		else{
			if (empty($_POST['restaurante']))
				$errors[] = 'Olvido introducir la ID del Restaurante';
			else{
				$restaurante = trim($_POST['restaurante']);
				$restaurante = mysqli_real_escape_string($dbcon, $restaurante);
			}

			if (empty($_POST['nombre']))
				$errors[] = 'Olvido introducir el Nombre del Restaurante';
			else{
				$nombre = trim($_POST['nombre']);
				$nombre = mysqli_real_escape_string($dbcon, $nombre);
			}

			if (empty($errors)){
				$query="select InsertarRestaurante('$restaurante', '$nombre') as resp";
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
		}
		mysqli_close($dbcon);
	}// Fin de acciones cuando se envía el formulario
?>
<body>
	<div class="contenedor">
		<h1>Insertar Restaurante</h1>
		<p></p>
		<p class="centrado">Por favor asegurate de llenar todos los campos del formulario para poder agregar la informacion al sistema</p>
		<div class="contenedor col-md-3 center-block fondoazul">
			<form action="restauranteInsert.php" method="POST">
        <p>ID del restaurante:</p><input type="text" name="restaurante" required maxlength="7" value="<?php if (isset($_GET['id']))
          echo $_GET['id']; ?>"><br>
        <p>Nombre de Restaurante:</p><input type="text" name="nombre" required maxlength="40" value="<?php if (isset($_GET['p']))
          echo $_GET['p']; ?>"><br>
				<input type="submit" value="Registrar" class="btn btn-success btn-primary">
				<input type="hidden" name="restAnt" maxlength="40" value="<?php if (isset($_GET['id']))
          echo $_GET['id']; ?>">
			</form>
		</div>
	<p></p>
	</div>
	<?php include('includes/footer.html'); ?>
</body>
</html>
