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
		if (empty($_POST['id_usuario']))
			$errors[] = 'Olvido introducir el ID del Usuario';
		else{
			$ni = trim($_POST['id_usuario']);
			$ni = mysqli_real_escape_string($dbcon, $ni);
		}

		if (empty($_POST['nombre']))
			$errors[] = 'Olvido introducir el Nombre del Usuario';
		else{
			$nn = trim($_POST['nombre']);
			$nn = mysqli_real_escape_string($dbcon, $nn);
		}

		if (empty($_POST['correo']))
			$errors[] = 'Olvido introducir el Correo del Usuario';
		else{
			$nc = trim($_POST['correo']);
			$nc = mysqli_real_escape_string($dbcon, $nc);
		}

		if (empty($_POST['pass']))
			$errors[] = 'Olvido introducir la Contraseña';
		else{
			$np = trim($_POST['pass']);
			$np = mysqli_real_escape_string($dbcon, $np);
		}

		if (empty($_POST['telefono']))
			$errors[] = 'Olvido introducir el nombre del usuario';
		else{
			$nt = trim($_POST['telefono']);
			$nt = mysqli_real_escape_string($dbcon, $nt);
		}

		if (empty($_POST['num_tarjeta']))
			$errors[] = 'Olvido introducir el nombre del usuario';
		else{
			$nta = trim($_POST['num_tarjeta']);
			$nta = mysqli_real_escape_string($dbcon, $nta);
		}

		if (empty($_POST['mes']))
			$errors[] = 'Olvido introducir el nombre del usuario';
		else{
			$nm = trim($_POST['mes']);
			$nm = mysqli_real_escape_string($dbcon, $nm);
		}

		if (empty($_POST['anio']))
			$errors[] = 'Olvido introducir el nombre del usuario';
		else{
			$na = trim($_POST['anio']);
			$na = mysqli_real_escape_string($dbcon, $na);
		}

		if (empty($_POST['cvv']))
			$errors[] = 'Olvido introducir el nombre del usuario';
		else{
			$ncvv = trim($_POST['cvv']);
			$ncvv = mysqli_real_escape_string($dbcon, $ncvv);
		}

		if (empty($_POST['titular']))
			$errors[] = 'Olvido introducir el nombre del usuario';
		else{
			$nti = trim($_POST['titular']);
			$nti = mysqli_real_escape_string($dbcon, $nti);
		}

		if (empty($errors)){
			$query="select InsertarUsuario('$ni','$nn','$nc','$np','$nt','$nta','$nm','$na','$ncvv','$nti') as resp";
			$res=@mysqli_query($dbcon,$query);
			$row=mysqli_fetch_assoc($res);
			$resp=$row['resp'];
			mysqli_close($dbcon);

			if($resp==1){
				echo '<h1>Muchas gracias!</h1>
				<p>Sus datos han sido registrados en la base de datos!</p><p><br /></p>';
			}else if($resp==2){
        echo '<h1>Atencion</h1>
        <p>El usuario no existe!</p><p><br /></p>';
			}else if($resp==3){
        echo '<h1>Atencion</h1>
        <p>La Sucursal no existe!</p><p><br /></p>';
      }else if($resp==0){
        echo '<h1>Atencion</h1>
        <p>La orden ya existe!</p><p><br /></p>';
      }

		}
	}// Fin de acciones cuando se envía el formulario
?>
<body>
	<div class="contenedor">
		<h1>Inser Orden</h1>
		<p></p>
		<p class="centrado">Por favor asegurate de llenar todos los campos del formulario para poder agregar la informacion al sistema</p>
		<div class="contenedor col-md-3 center-block fondoazul">
			<form action="ordenInsert.php" method="POST">
        <p>ID de Orden:</p><input type="text" name="id_orden" required maxlength="7" value=""><br>
        <p>ID de Sucursal:</p><input type="text" name="id_sucursal" required maxlength="7" value=""><br>
        <!-- Aqui cambiar la fecha -->
        <p>Fecha:</p><input type="date" name="fecha" required value=""><br>
        <p>Numero de mesa:</p><input type="text" name="num_mesa" required maxlength="2" value=""><br>
        <p>Total:</p><input type="number" name=""

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
