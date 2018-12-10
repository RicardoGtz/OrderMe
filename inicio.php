<!DOCTYPE html>
<html lang="es">
<head>
    <title>Inicio - OrderMe</title>
    <?php include('includes/links.php'); ?>
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
