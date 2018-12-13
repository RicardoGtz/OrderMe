<?php
session_start();
//require_once "../comun/php/conexion.php";
require ('connectmysql.php');
$var1 = $_POST['var1'];
$var2 = $_POST['var2'];
$sql  = "select RevisarLogin('$var1','$var2') as resp";

$res=@mysqli_query($dbcon,$sql);
$row=mysqli_fetch_assoc($res);

switch ($row['resp']) {
	case 'administradorG':
	$_SESSION['user']='administradorG';
	$_SESSION['usuario'] = $var1;
	break;
	case 'administradorR':
	$_SESSION['user']='administradorR';
	$_SESSION['usuario'] = $var1;
	break;
	case 'cliente':
	$_SESSION['user']='cliente';
	$_SESSION['usuario'] = $var1;
	break;
	case 'empleado':
	$_SESSION['user']='empleado';
	$_SESSION['usuario'] = $var1;
	break;
	default:
	$id="";
	break;
}
mysqli_close($dbcon);
?>
