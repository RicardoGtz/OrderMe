<?php
	session_start();
	require ('connectmysql.php');
	unset($_SESSION['user']);
	unset($_SESSION['usuario']);

	header("location:../../inicio.php");
	//echo "1";
 ?>
