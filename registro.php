<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Registro - OrderMe</title>
	<link rel="stylesheet" type="text/css" href="comun/librerias/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="comun/css/estilos.css">
	<script src="comun/librerias/bootstrap/js/bootstrap.js"></script>
</head>
<?php
	session_start();
	if(@$_SESSION['user'] == 'administradorG'){
		include("includes/headerGlobal.php"); 
		echo "Hola Adm Global";
	}
	elseif (@$_SESSION['user']=='administradorR'){
		include("includes/headerLocal.php");
		echo "Hola Adm Local";
	}
	elseif (@$_SESSION['user']=='empleado'){
		include('includes/headerCliente.php');
		echo "Hola Empleado";
	}
	elseif (@$_SESSION['user']=='cliente'){
		include('includes/headerCliente.php'); 
		echo "Hola Cliente";
	}
	elseif (@!$_SESSION['user']) {
		include('includes/headerInvitado.php');
		echo "Hola Invitado";
	}
?>
<?php
	include('includes/global.php');
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
				<p>ID del Usuario:</p><input type="text" name="id_usuario" required maxlength="7" value=""><br>
				<p>Nombre del Usuario:</p><input type="text" name="nombre" required maxlength="40" value=""><br>
				<p>Correo:</p><input type="text" name="correo" required maxlength="40" value=""><br>
				<p>Password:</p><input type="text" name="pass" required maxlength="10" value=""><br>
				<p>Telefono:</p><input type="text" name="telefono" maxlength="10" required pattern="[0-9]+" value=""><br>
				<p>Numero de Tarjeta:</p><input type="text" name="num_tarjeta" maxlength="16" required pattern="[0-9]+" value=""><br>
				<p>Mes de Vencimiento:</p><input type="text" name="mes" maxlength="2" required pattern="[0-9]+" value=""><br>
				<p>Año de Vencimiento:</p><input type="text" name="anio" maxlength="2" required pattern="[0-9]+" value=""><br>
				<p>CVV:</p><input type="text" name="cvv" maxlength="3" required pattern="[0-9]+" value=""><br>
				<p>Nombre del Titular:</p><input type="text" name="titular" required maxlength="40" value=""><br>
				<input type="submit" value="Registrar" class="btn btn-success btn-primary">
			</form>
		</div>
	<p></p>
	</div>
	<?php include('includes/footer.html'); ?>
</body>
</html>