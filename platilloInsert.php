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
		if (empty($_POST['id_platillo']))
			$errors[] = 'Olvido introducir el ID del Platillo';
		else{
			$platillo = trim($_POST['id_platillo']);
			$platillo = mysqli_real_escape_string($dbcon, $platillo);
		}

		if (empty($_POST['nombre']))
			$errors[] = 'Olvido introducir el Nombre del Platillo';
		else{
			$nombre = trim($_POST['nombre']);
			$nombre = mysqli_real_escape_string($dbcon, $nombre);
		}

		if (empty($_POST['descripcion']))
			$errors[] = 'Olvido introducir la Descripcion';
		else{
			$descripcion = trim($_POST['descripcion']);
			$descripcion = mysqli_real_escape_string($dbcon, $descripcion);
		}

		if (empty($_POST['precio']))
			$errors[] = 'Olvido introducir el Precio';
		else{
			$precio = trim($_POST['precio']);
			$precio = mysqli_real_escape_string($dbcon, $precio);
		}

		$rutaEnServidor='comun/img/platillo/';
		$rutaTemporal1=$_FILES['fotografia']['tmp_name'];
		$nombreImagen1=$_FILES['fotografia']['name'];
		$rutaCedula=$rutaEnServidor.$nombreImagen1;
		move_uploaded_file($rutaTemporal1,$rutaCedula);

		if (empty($errors)){
			$query="select InsertarPlatillo('$platillo','$nombre','$descripcion','$precio','$rutaCedula') as resp";
			$res=@mysqli_query($dbcon,$query);
			$row=mysqli_fetch_assoc($res);
			$resp=$row['resp'];
			mysqli_close($dbcon);

			if($resp==1){
				echo '<h1>Muchas gracias!</h1>
							<p>Los datos han sido registrados en la base de datos!</p><p><br /></p>';

			}else if($resp==0){
				echo '<h1>Atencion</h1>
							<p>Ya existe ese Platillo!</p><p><br /></p>';
				unlink("$rutaCedula");
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
			<form action="platilloInsert.php" method="POST" enctype="multipart/form-data">
        <p>ID del Platillo:</p><input type="text" name="id_platillo" required maxlength="7" value="<?php if (isset($_GET['id']))
	         echo $_GET['id']; ?>"><br>
        <p>Nombre del Platillo:</p><input type="text" name="nombre" required maxlength="40" value="<?php if (isset($_GET['nombre']))
	         echo $_GET['nombre']; ?>"><br>
        <p>Descripción:</p><input type="text" name="descripcion" required maxlength="200" value="<?php if (isset($_GET['desc']))
	         echo $_GET['desc']; ?>"><br>
        <p>Precio: $</p><input type="number" name="precio" step="0.01" required pattern="[0-9]{1,5}\.[0-9]{1,2}$|[0-9]{1,5}$" maxlength="99999.99" minlength="0" value="<?php if (isset($_GET['precio']))
	         echo $_GET['precio']; ?>"><br>
        <p>Fotografia:</p><input type="file" name="fotografia" required><br>
				<input type="submit" value="Registrar" class="btn btn-success btn-primary">
				<input type="hidden" name="platilloAnt" maxlength="40" value="<?php if (isset($_GET['id']))
	         echo $_GET['id']; ?>">
			</form>
		</div>
	<p></p>
	</div>
	<?php include('includes/footer.html'); ?>
</body>
</html>
