<!DOCTYPE html>
<html lang="es">
<head>
	<title>Login - OrderMe</title>
	<?php include('includes/links.php'); ?>
</head>
<?php
  error_reporting(0);
  session_start();
  include('includes/global.php');
    if (@$_SESSION['user']){
      header("Location:inicio.php");
    }
    elseif (@!$_SESSION['user']) {
      $page_title = 'Inicia Sesión';
      include('includes/headerInvitado.php');
    }
?>
<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		require ('connectmysql.php');
		$errors = array();

		if (empty($_POST['id']))
			$errors[] = 'Olvido introducir su usuario.';
		else{
			$id = trim($_POST['id']);
			$id= mysqli_real_escape_string($dbcon, $id);
		}

		if (empty($_POST['pass']))
			$errors[] = 'Olvido introducir su password.';
		else{
			$pass = trim($_POST['pass']);
			$pass = mysqli_real_escape_string($dbcon, $pass);
		}
		if(empty($errores)){
			session_start();
			$query = "select RevisarLogin('$id','$pass') as resp";
			$resultado = mysqli_query($dbcon, $query);
			$row = mysqli_fetch_assoc($resultado);
			switch ($row['resp']) {
				case 'administradorG':
					$_SESSION['user']='administradorG';
					obtenerID($id);
					echo '<script>alert("BIENVENIDO ADMINISTRADOR")</script>';
				break;
				case 'administradorR':
					$_SESSION['user']='administradorR';
					obtenerID($id);
					echo '<script>alert($id)</script>';
					echo '<script>alert("BIENVENIDO ADMINISTRADOR DE RESTAURANTE")</script>';
				break;
				case 'cliente':
					$_SESSION['user']='cliente';
					obtenerID($id);
					echo '<script>alert("BIENVENIDO USUARIO")</script>';
				break;
				case 'empleado':
					$_SESSION['user']='empleado';
					obtenerID($id);
					echo '<script>alert("BIENVENIDO EMPLEADO")</script>';
					header("location:inicio.php");
				break;
				default:
					echo '<script>alert("Los datos no coinciden")</script>';
				break;
			}
			mysqli_close($dbcon);
		}
		else {
			echo '<h1>Error!</h1>
			<p class="error">Ocurrieron los siguientes errores:<br />';
			foreach ($errors as $msg) {
				echo " - $msg <br />\n";
			}
			echo '</p>
			<p>Por favor intente nuevamente.</p>';
			mysqli_close($dbcon);
		}
	}

?>
<body>
	<div class="contenedor">
			<h1 class="courgete">Iniciar sesion</h1>
			<p></p>
			<p class="centrado">Por favor asegurate de que tus datos esten correctos y que todos los campos del formulario esten llenos</p>
			<p></p>
			<div class="contenedor col-md-3 center-block fondoazul">
				<form action="login.php" method="POST">
					<p class="letrablanca">Id de Usuario:</p><input type="text" name="id" maxlength="7" value=""><br>
					<p class="letrablanca">Password:</p><input type="password" name="pass" maxlength="10" value=""><br>
					<br>
					<input type="submit" value="Aceptar" class="btn btn-success btn-primary">
				</form>
			</div>
			<p></p>
<?php include('includes/footer.html'); ?>
	</div>
</body>
</html>
