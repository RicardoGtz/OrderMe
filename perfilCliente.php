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
			$query="select ActualizarUsuario('$ni','$ni','$nn','$nc','$np','$nt','$nta','$nm','$na','$ncvv','$nti') as resp";
			$res=@mysqli_query($dbcon,$query);
			$row=mysqli_fetch_assoc($res);
			$resp=$row['resp'];
			mysqli_close($dbcon);

			if($resp==1){
				echo '<h1>Muchas gracias!</h1>
				<p>Sus datos han sido actualizados en la base de datos!</p><p><br /></p>';
			}else if($resp==2){
				echo '<h1>Atencion</h1>
				<p>El ID actualizado ya existe!</p><p><br /></p>';
			}else if($resp==0) {
        echo '<h1>Muchas gracias!</h1>
				<p>Sus datos han sido actualizados en la base de datos!</p><p><br /></p>';
      }

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
            $sqldata=mysqli_query($dbcon,"call VerUsuarioEspecifico('$id')");
            $row=mysqli_fetch_array($sqldata,MYSQLI_NUM);

            echo '<form action="perfilCliente.php" method="POST">';
            echo '<p>ID del Usuario:</p><input type="text" name="id_usuario" required maxlength="7" value="'.utf8_encode($row[0]).'" readonly><br>';
            echo '<p>Nombre:</p><input type="text" name="nombre" required maxlength="40" value="'.utf8_encode($row[1]).'"><br>';
            echo '<p>Correo:</p><input type="text" name="correo" required maxlength="40" value="'.utf8_encode($row[2]).'"><br>';
            echo '<p>Contraseña:</p><input type="password" name="pass" required maxlength="10" value="'.utf8_encode($row[3]).'"><br>';
            echo '<p>Telefono:</p><input type="text" name="telefono" required maxlength="10" value="'.utf8_encode($row[4]).'"><br>';
            echo '<p>Numero de Tarjeta:</p><input type="text" name="num_tarjeta" required maxlength="16" value="'.utf8_encode($row[5]).'"><br>';
            echo '<p>Mes de vencimiento:</p><input type="text" name="mes" required maxlength="2" value="'.utf8_encode($row[6]).'"><br>';
            echo '<p>Año de vencimineto:</p><input type="text" name="anio" required maxlength="2" value="'.utf8_encode($row[7]).'"><br>';
            echo '<p>CCV:</p><input type="password" name="cvv" required maxlength="3" value="'.utf8_encode($row[8]).'"><br>';
            echo '<p>Titular:</p><input type="text" name="titular" required maxlength="40" value="'.utf8_encode($row[9]).'"><br>';
            echo '<input type="submit" value="Actualizar" class="btn btn-success btn-primary">';
        ?>
			</form>
		</div>
	<p></p>
	</div>
	<?php include('includes/footer.html'); ?>
</body>
</html>
