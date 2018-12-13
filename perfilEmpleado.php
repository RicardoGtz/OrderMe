<!DOCTYPE html>
<html lang="es">
<head>
	<title>Registro - OrderMe</title>
	<?php include('includes/links.php'); ?>
</head>
<?php
	include('includes/global.php');
	crearHeaders();
    include('connectmysql.php');

    $id=@$_SESSION['usuario'];
    echo "El ID ".$id;

?>
<?php
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		//include ('connectmysql.php');
		$errors = array();
		if (empty($_POST['id_empleado']))
			$errors[] = 'Olvido introducir el ID del Usuario';
		else{
			$ni = trim($_POST['id_empleado']);
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

		if (empty($_POST['id_sucursal']))
			$errors[] = 'Olvido introducir el nombre del usuario';
		else{
			$ns = trim($_POST['id_sucursal']);
			$ns = mysqli_real_escape_string($dbcon, $ns);
		}

		if (empty($errors)){
			$query="select ActualizarEmpleado('$ni','$ni','$nn','$np','$nc','$nt','$ns') as resp";
			$res=@mysqli_query($dbcon,$query);
			$row=mysqli_fetch_assoc($res);
			$resp=$row['resp'];
			mysqli_close($dbcon);

			if($resp==1){
				echo '<h1>Muchas gracias!</h1>
				<p>Sus datos han sido actualizados en la base de datos!</p><p><br /></p>';
			}else if($resp==2){
				echo '<h1>Atencion</h1>
				<p>No existe esa sucursal!</p><p><br /></p>';
			}else if($resp==3) {
        echo '<h1>Atencion</h1>
				<p>El ID de empleado ya existe!</p><p><br /></p>';
      }else if($resp==0)
        echo '<h1>Atencion</h1>
        <p>No existe ese empleado</p><p><br /></p>';
		}else{
      echo $errors[0];
    }
    include('includes/footer.html');
    exit();
	}// Fin de acciones cuando se envía el formulario


?>
<body>
	<div class="contenedor">
		<h1>Registrate</h1>
		<p></p>
		<p class="centrado">Por favor asegurate de llenar todos los campos del formulario para poder agregar la informacion al sistema</p>
		<div class="contenedor col-md-3 center-block fondoazul">
        <?php
            //$id=$_GET['id'];
            $sqldata=mysqli_query($dbcon,"call VerEmpleadoEspecifico('$id')");
            $row=mysqli_fetch_array($sqldata,MYSQLI_NUM);

            echo '<form action="perfilEmpleado.php" method="POST">';
            echo '<p>ID del Empleado:</p><input type="text" name="id_empleado" required maxlength="7" value="'.utf8_encode($row[0]).'" readonly><br>';
            echo '<p>Nombre:</p><input type="text" name="nombre" required maxlength="40" value="'.utf8_encode($row[1]).'"><br>';
            echo '<p>Contraseña:</p><input type="password" name="pass" required maxlength="10" value="'.utf8_encode($row[2]).'"><br>';
            echo '<p>Correo:</p><input type="text" name="correo" required maxlength="40" value="'.utf8_encode($row[3]).'"><br>';
            echo '<p>Telefono:</p><input type="text" name="telefono" required maxlength="10" value="'.utf8_encode($row[4]).'"><br>';
            echo '<p>ID de sucursal:</p><input type="text" name="id_sucursal" required maxlength="7" value="'.utf8_encode($row[5]).' "readonly><br>';
            echo '<input type="submit" value="Actualizar" class="btn btn-success btn-primary">';
        ?>
			</form>
		</div>
	<p></p>
	</div>
	<?php include('includes/footer.html'); ?>
</body>
</html>
