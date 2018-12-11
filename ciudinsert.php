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
					<p>Sus datos han sido registrados en la base de datos!</p><p><br /></p>';
			}
			else{
				if($resp==0){
					echo '<h1>Atencion</h1>
						<p>El registro ya existe!</p><p><br /></p>';
				}
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
			<form action="registro.php" method="POST">
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
