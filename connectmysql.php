<?php

//DEFINE ('DB_USER','root');
//DEFINE ('DB_PSWD','');
DEFINE ('DB_USER','administradorG');
DEFINE ('DB_PSWD','123456');
DEFINE ('DB_HOST','localhost');
DEFINE ('DB_NAME','restauranteGPS');

$dbcon=mysqli_connect(DB_HOST,DB_USER,DB_PSWD,DB_NAME);

if(!$dbcon){
	die('error al conectar a la base de datos');
}

?>
