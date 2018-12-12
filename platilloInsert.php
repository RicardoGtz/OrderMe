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
<?php
	//include('includes/global.php');
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$errors = array();
		$errors=checarUsuario($errors);

		if (empty($errors)){
			$resp=insertarUsuario();

			if($resp==1){
				echo '<h1>Muchas gracias!</h1>
					<p>El platillo han sido registrado en la base de datos!</p><p><br /></p>';
			}
			else if($resp==2){
				echo '<h1>Atencion</h1>
					    <p>No existe la combinacion de Ciudad y Estado!</p><p><br /></p>';
			}else if($resp==3){
        echo '<h1>Atencion</h1>
              <p>El restaurante no existe!</p><p><br /></p>';
      }else if($resp==0)
        echo '<h1>Atencion</h1>
              <p>El registro ya existe!</p><p><br /></p>';
		}
	}// Fin de acciones cuando se envía el formulario
?>
<body>
	<div class="contenedor">
		<h1>Registrate</h1>
		<p></p>
		<p class="centrado">Por favor asegurate de llenar todos los campos del formulario para poder agregar la informacion al sistema</p>
		<div class="contenedor col-md-3 center-block fondoazul">
			<form action="platilloInsert.php" method="POST">
        <p>ID del Platillo:</p><input type="text" name="id_platillo" required maxlength="7" value=""><br>
        <p>Nombre del Platillo:</p><input type="text" name="nombre" required maxlength="40" value=""><br>
        <p>Descripción:</p><input type="text" name="descripcion" required maxlength="200" value=""><br>
        <p>Precio: $</p><input type="number" name="precio" step="0.01" required pattern="[0-9]{1,5}\.[0-9]{1,2}$|[0-9]{1,5}$" maxlength="99999.99" minlength="0" value=""><br>
        <p>Fotografia:</p><input type="file" name="fotografia" required maxlength="40" value="" onchange="loadFile(event)"><br>
        <!-- Carga la foto -->
        <img id="output" width="200" height="200"/>
        <script>
          var loadFile = function(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
          };
        </script>
				<input type="submit" value="Registrar" class="btn btn-success btn-primary">
			</form>
		</div>
	<p></p>
	</div>
	<?php include('includes/footer.html'); ?>
</body>
</html>
