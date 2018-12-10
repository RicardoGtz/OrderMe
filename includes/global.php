<?php
if(!session_id()) session_start();
$aux = "nothing";
if(!isset($_SESSION['usuario'])) {
    $_SESSION['usuario'] = $aux;
}
?>

<?php
	$ni=""; $nn=""; $nc=""; $np=""; $nt=""; $nta=""; $nm=""; $na=""; $ncvv=""; $nti="";
	function checarUsuario($errors){
		require ('connectmysql.php');
		global $ni, $nn, $nc, $np, $nt, $nta, $nm, $na, $ncvv, $nti;
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
		mysqli_close($dbcon);
		return $errors;
	}

	function insertarUsuario(){
		global $ni, $nn, $nc, $np, $nt, $nta, $nm, $na, $ncvv, $nti;
		require ('connectmysql.php');
		$query="select InsertarUsuario('$ni','$nn','$nc','$np','$nt','$nta','$nm','$na','$ncvv','$nti') as resp";
		$res=@mysqli_query($dbcon,$query);
		$row=mysqli_fetch_assoc($res);
		mysqli_close($dbcon);
		return $row['resp'];
	}
?>