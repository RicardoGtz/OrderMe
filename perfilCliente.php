<!DOCTYPE html>
<html lang="es">
<head>
	<title>Registro - OrderMe</title>
	<?php include('includes/links.php'); ?>
</head>
<?php
	include('includes/global.php');
	crearHeaders();
?>
<body>
	<div class="contenedor">
		<h1>Registrate</h1>
		<p></p>
		<p class="centrado">Por favor asegurate de llenar todos los campos del formulario para poder agregar la informacion al sistema</p>
		<div class="contenedor col-md-3 center-block fondoazul">
			<form action="registro.php" method="POST">
        <?php
          include('connectmysql.php');
          //Aqui obtengo el ID de usuario pero no se
          if(isset($_GET['id'])){
            $id=$_GET['id'];
            $sqldata=mysqli_query($dbcon,"call VerUsuarioEspecifico('$id')");
            $row=mysqli_fetch_array($sqldata,MYSQLI_NUM);

            echo '<p>ID del Usuario:</p><input type="text" name="id_usuario" required maxlength="7" value="'.utf8_encode($row[0]).'" disabled><br>';
            echo '<p>Nombre:</p><input type="text" name="nombre" required maxlength="40" value="'.utf8_encode($row[1]).'" disabled><br>';
            echo '<p>Correo:</p><input type="text" name="correo" required maxlength="40" value="'.utf8_encode($row[2]).'" disabled><br>';
            echo '<p>Contraseña:</p><input type="password" name="contrasena" required maxlength="10" value="'.utf8_encode($row[3]).'" disabled><br>';
            echo '<p>Telefono:</p><input type="text" name="telefono" required maxlength="10" value="'.utf8_encode($row[4]).'" disabled><br>';
            echo '<p>Numero de Tarjeta:</p><input type="text" name="num_tarjeta" required maxlength="16" value="'.utf8_encode($row[5]).'" disabled><br>';
            echo '<p>Mes de vencimiento:</p><input type="text" name="mes_vencimiento" required maxlength="2" value="'.utf8_encode($row[6]).'" disabled><br>';
            echo '<p>Año de vencimineto:</p><input type="text" name="anio_vencimineto" required maxlength="2" value="'.utf8_encode($row[7]).'" disabled><br>';
            echo '<p>CCV:</p><input type="password" name="cvv" required maxlength="3" value="'.utf8_encode($row[8]).'" disabled><br>';
            echo '<p>Titular:</p><input type="text" name="titular" required maxlength="40" value="'.utf8_encode($row[9]).'" disabled><br>';
          }
        // Fin de acciones cuando se envía el formulario
        ?>
				<input type="submit" value="Registrar" class="btn btn-success btn-primary">
			</form>
		</div>
	<p></p>
	</div>
	<?php include('includes/footer.html'); ?>
</body>
</html>
