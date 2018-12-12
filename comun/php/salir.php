<?php 
	session_start();
	require ('connectmysql.php');
	unset($_SESSION['user']);

	header("location:../../index.php");
	//echo "1";
 ?>