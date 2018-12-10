<!DOCTYPE html>
<html lang="es">
<head>
    <title>Inicio - OrderMe</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="comun/librerias/bootstrap/css/bootstrap.css">
  	<link rel="stylesheet" href="comun/css/estilos.css">
	<script src="comun/librerias/bootstrap/js/bootstrap.js"></script>
</head>
<?php
	include('includes/global.php');
	crearHeaders();
  $id=$_SESSION['usuario'];
  echo "$id";
?>
<body>

<?php
	include('includes/footer.html');
?>
</body>
</html>
