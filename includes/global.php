<?php
	function obtenerID($usu){
		if(!session_id()) session_start();
		$aux = 'nothing';
		if(!isset($_SESSION['usuario'])) {
			$_SESSION['usuario'] = $aux;
		}
		if(isset($_SESSION['usuario'])) {
			$aux=$usu;
		  $_SESSION['usuario'] = $aux;
		}
	}
?>

<?php
	function crearHeaders(){
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
	}
?>
