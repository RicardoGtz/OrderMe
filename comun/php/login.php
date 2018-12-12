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
	//obtenerID($id);
	break;
	case 'administradorR':
	$_SESSION['user']='administradorR';
	//obtenerID($id);
	break;
	case 'cliente':
	$_SESSION['user']='cliente';
	//obtenerID($id);
	break;
	case 'empleado':
	$_SESSION['user']='empleado';
	//obtenerID($id);
	break;
	default:
	$id="";
	break;
}
mysqli_close($dbcon);
echo $_SESSION['user'];
