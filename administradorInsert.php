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
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		include ('connectmysql.php');
		$errors = array();
		if (empty($_POST['id_administrador']))
			$errors[] = 'Olvido introducir el ID del Administrador';
		else{
			$administrador = trim($_POST['id_administrador']);
			$administrador = mysqli_real_escape_string($dbcon, $administrador);
		}

    if (empty($_POST['pass']))
			$errors[] = 'Olvido introducir la Contraseña';
		else{
			$contra = trim($_POST['pass']);
			$contra = mysqli_real_escape_string($dbcon, $contra);
		}

		if (empty($_POST['correo']))
			$errors[] = 'Olvido introducir el Correo del Empleado';
		else{
			$correo = trim($_POST['correo']);
			$correo = mysqli_real_escape_string($dbcon, $correo);
		}

		if (empty($_POST['telefono']))
			$errors[] = 'Olvido introducir el telefono';
		else{
			$telefono = trim($_POST['telefono']);
			$telefono = mysqli_real_escape_string($dbcon, $telefono);
		}

    if (empty($_POST['id_restaurante']))
			$errors[] = 'Olvido introducir el ID de la Sucursal';
		else{
			$restaurante = trim($_POST['id_restaurante']);
			$restaurante = mysqli_real_escape_string($dbcon, $restaurante);
		}

		if (empty($errors)){
			$query="select InsertarAdministrador('$administrador','$contra','$correo','$restaurante','$telefono') as resp";
			$res=@mysqli_query($dbcon,$query);
			$row=mysqli_fetch_assoc($res);
			$resp=$row['resp'];
			mysqli_close($dbcon);

      if($resp==1){
				echo '<h1>Muchas gracias!</h1>
							<p>Los datos han sido registrados en la base de datos!</p><p><br /></p>';
			}else	if($resp==2){
				echo '<h1>Atencion</h1>
							<p>Alguien ya es Administrador del Restaurante!</p><p><br /></p>';
			}else if($resp==3){
				echo '<h1>Atencion</h1>
							<p>No existe ese restaurante!</p><p><br /></p>';
			}else if($resp==0){
				echo '<h1>Atencion</h1>
							<p>Ya existe ese Administrador!</p><p><br /></p>';
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
			<form action="administradorInsert.php" method="POST">
				<p>ID del Administrador:</p><input type="text" name="id_administrador" required maxlength="7" value=""><br>
        <p>Password:</p><input type="text" name="pass" required maxlength="10" value=""><br>
				<p>Correo:</p><input type="text" name="correo" required maxlength="40" value=""><br>
				<p>Telefono:</p><input type="text" name="telefono" maxlength="10" required pattern="[0-9]+" value=""><br>
        <p>ID del Restaurante:</p><input type="text" name="id_restaurante" required maxlength="7" value=""><br>
				<input type="submit" value="Registrar" class="btn btn-success btn-primary">
			</form>
		</div>
	<p></p>
	</div>
	<?php include('includes/footer.html'); ?>
</body>
</html>
