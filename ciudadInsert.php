<?php
session_start();
$usuario = @$_SESSION['user'];
echo $usuario;
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<title>
		Order Me
	</title>
	<link crossorigin="anonymous" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" rel="stylesheet">
	<link href="comun/librerias/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
	<script crossorigin="anonymous" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js">
	</script>
	<script crossorigin="anonymous" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" src="https://code.jquery.com/jquery-3.2.1.slim.min.js">
	</script>
	<script crossorigin="anonymous" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js">
	</script>

	<!-- Online -->
	<link href="https://fonts.googleapis.com/css?family=Josefin+Slab|Lobster|Raleway|Playball" rel="stylesheet"/>
	<link href="comun/librerias/icon/css/font-awesome.min.css" rel="stylesheet">

	<link href="comun/librerias/alertifyjs/css/alertify.css" rel="stylesheet" type="text/css"/>
	<link href="comun/librerias/alertifyjs/css/themes/default.css" rel="stylesheet" type="text/css"/>
	<link href="comun/librerias/select2/css/select2.css" rel="stylesheet" type="text/css"/>
	<link href="comun/css/main.css" rel="stylesheet"/>
	<link href="comun/css/animate.css" rel="stylesheet" type="text/css"/>
	<script src="comun/librerias/jquery-3.2.1.min.js">
	</script>
	<script src="comun/js/operaciones.js">
	</script>
	<script src="comun/librerias/bootstrap/js/bootstrap.js">
	</script>
	<script src="comun/librerias/alertifyjs/alertify.js">
	</script>
	<script src="comun/librerias/select2/js/select2.js">
	</script>
</link>
</link>
</meta>
</meta>
</head>
<?php
	//include('includes/global.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	include ('connectmysql.php');
	$errors = array();

		//Proceso de Update
	if(!empty($_POST['ciudadAnt'])){
		$ciudad = trim($_POST['ciudadAnt']);
		$ciudad = mysqli_real_escape_string($dbcon, $ciudad);

		$provincia = trim($_POST['provinciaAnt']);
		$provincia = mysqli_real_escape_string($dbcon, $provincia);

		$ciudadAct = trim($_POST['nombre']);
		$ciudadAct = mysqli_real_escape_string($dbcon, $ciudadAct);

		$provinciaAct = trim($_POST['provincia']);
		$provinciaAct = mysqli_real_escape_string($dbcon, $provinciaAct);

		$query="select ActualizarCiudad('$ciudad', '$provincia', '$ciudadAct', '$provinciaAct') as resp";
		$res=@mysqli_query($dbcon,$query);
		$row=mysqli_fetch_assoc($res);
		$resp=$row['resp'];

		echo "$resp";
		if($resp==1){
			echo '<h1>Muchas gracias!</h1>
			<p>Los datos han sido actualizados en la base de datos!</p><p><br /></p>';
		}
		else{
			if($resp==2){
				echo '<h1>Atencion</h1>
				<p>El registro que intentas actualizar ya existe!</p><p><br /></p>';
			}
		}
	}

		//Proceso de Insert
	else{
		if (empty($_POST['nombre']))
			$errors[] = 'Olvido introducir la Ciudad';
		else{
			$ciudad = trim($_POST['nombre']);
			$ciudad = mysqli_real_escape_string($dbcon, $ciudad);
		}

		if (empty($_POST['provincia']))
			$errors[] = 'Olvido introducir el Estado';
		else{
			$provincia = trim($_POST['provincia']);
			$provincia = mysqli_real_escape_string($dbcon, $provincia);
		}

		if (empty($errors)){
			$query="select InsertarCiudad('$ciudad', '$provincia') as resp";
			$res=@mysqli_query($dbcon,$query);
			$row=mysqli_fetch_assoc($res);
			$resp=$row['resp'];

			if($resp==1){
				echo '<h1>Muchas gracias!</h1>
				<p>Los datos han sido registrados en la base de datos!</p><p><br /></p>';
			}
			else{
				if($resp==0){
					echo '<h1>Atencion</h1>
					<p>El registro ya existe!</p><p><br /></p>';
				}
			}
		}

	}
	mysqli_close($dbcon);
	}// Fin de acciones cuando se envía el formulario
	?>
	<body>
		<!-- Encabezado -->
		<div class="col-lg-10 col-md-10 col-sm-10 mx-auto text-left espacio-arriba">
			<div class="row">
				<div class="col-md-4">
					<h1 class="Font_Playball mediano_4 Verde_logo animated fadeIn">
						Order Me
					</h1>
				</div>
				<!-- Boton -->
				<div id = "botones" class="col order-12 offset-md-1 offset-lg-5">
				</div>
			</div>

			<h2 class="Font_Raleway mediano animated fadeIn retraso-1 Gris espacio-abajo">
				Ordena comida sin meseros (owo)/
			</h2>
			<label for="">
			</label>
		</div>
		<!-- Menu -->
		<div class="" id="menu">
		</div>
		<!-- Contenido -->
		<div class="animated fadeIn retraso-2 mx-auto">
			<!-- Texto -->
			<h2 class="Font_Raleway Dorado mediano_2 text-center mx-auto col-md-10 espacio-arriba">
				Datos de la cuenta
			</h2>
			<!-- Area 1 -->
			<div class=" col-md-10 mx-auto Negro espacio-abajo">
				<!-- Linea divisora -->
				<hr style="color: #0056b2;"/>
				<!-- Articulos -->
				<p class="mediano text-center">Por favor asegurate de llenar todos los campos del formulario para poder agregar la informacion al sistema.</p>

				<div class="col-lg-8 col-md-8 col-sm-8 mx-auto quitar-float espacio-arriba espacio-abajo text-left" id ="formulario">
					<div class="modal-dialog modal-lg" role="document">
        				<div class="modal-content">
				            <div class="modal-body">
								<label>
									Insertar Ciudad
								</label>
								<div class="contenedor col-md-3 center-block fondoazul">
									<form action="ciudadInsert.php" method="POST">
										<p>Nombre de ciudad:</p><input type="text" name="nombre" required maxlength="40" value="<?php if (isset($_GET['ciudad']))
										echo $_GET['ciudad']; ?>"><br>
										<p>Provincia (Estado):</p><input type="text" name="provincia" required maxlength="40" value="<?php if (isset($_GET['provincia']))
										echo $_GET['provincia']; ?>"><br>
										<input type="submit" value="Registrar" class="btn btn-success btn-primary">
										<input type="hidden" name="ciudadAnt" maxlength="40" value="<?php if (isset($_GET['ciudad']))
										echo $_GET['ciudad']; ?>">
										<input type="hidden" name="provinciaAnt" maxlength="40" value="<?php if (isset($_GET['provincia']))
										echo $_GET['provincia']; ?>">
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div> 
			<!--- Footer -->
			<footer class="footer-bs">
				<div class="row">
					<div class="col-md-3 footer-brand animated fadeInLeft">
						<h2>
							Order Me
						</h2>
						<p>
							Equipo:
							Ana Victoria Cavazos Argot
							Andres Graciano López
							Ricardo Gutierrez Otero
							Jose Miguel Rodriguez Reyes
							Alan Francisco Zamora Barrera
						</p>
						<p>
							© 2018 All rights reserved
						</p>
					</div>
					<div class="col-md-4 footer-nav animated fadeInUp">
						<h4>
							Secciones
						</h4>
						<div class="col-md-6">
						</div>
						<div class="col-md-6">
							<ul class="list">
								<li>
									<a href="#">
										Inicio
									</a>
								</li>
								<li>
									<a href="#">
										Afiliados
									</a>
								</li>
							</ul>
						</div>
					</div>
					<div class="col-md-2 footer-social animated fadeInDown">
						<h4>
							Siguenos:
						</h4>
						<ul>
							<li>
								<a href="#">
									Facebook
								</a>
							</li>
							<li>
								<a href="#">
									Twitter
								</a>
							</li>
							<li>
								<a href="#">
									Instagram
								</a>
							</li>      
						</ul>
					</div>
					<div class="col-md-3 footer-ns animated fadeInRight">
						<h4>
							Novedades:
						</h4>
						<p>
							Los germinados son uno de los pocos alimentos que ingerimos cuando aún están vivos, lo cual aumenta enormemente su valor nutricional. Las semillas...
						</p>
					</div>
				</div>
			</footer>
		</div>>
	</body>
	</html>
	<!-- Cargar elementos -->
	<script type="text/javascript">
		$(document).ready(function(){
			$('#menu').load("includes/menu/menu.php");
			$('#botones').load("includes/botones/botones.php");
			$('#body').load("includes/body/body.php");
			$('#contenido').load("includes/contenido/contenido_afiliado.php");
		});
	</script>
	<!-- VALIDACION DE ESCRITURA -->
	<script>
		function soloLetras(e) {
			key = e.keyCode || e.which;
			tecla = String.fromCharCode(key).toString();
    letras = " áéíóúabcdefghijklmnñopqrstuvwxyzÁÉÍÓÚABCDEFGHIJKLMNÑOPQRSTUVWXYZ1234567890";//Se define todo el abecedario que se quiere que se muestre.
    especiales = [8, 46, 6,9]; //Es la validación del KeyCodes, que teclas recibe el campo de texto.

    tecla_especial = false
    for(var i in especiales) {
    	if(key == especiales[i]) {
    		tecla_especial = true;
    		break;
    	}
    }

    if(letras.indexOf(tecla) == -1 && !tecla_especial){
    	return false;
    }
}
</script>
<script>
	function soloNumeros(e) {
		key = e.keyCode || e.which;
		tecla = String.fromCharCode(key).toString();
    letras = ".1234567890";//Se define todo el abecedario que se quiere que se muestre.
    especiales = [8, 46, 6,9]; //Es la validación del KeyCodes, que teclas recibe el campo de texto.

    tecla_especial = false
    for(var i in especiales) {
    	if(key == especiales[i]) {
    		tecla_especial = true;
    		break;
    	}
    }

    if(letras.indexOf(tecla) == -1 && !tecla_especial){
    	return false;
    }
}
</script>
<!-- REALIZAR OPERACIONES -->
<script type="text/javascript">
	$(document).ready(function() {
        // Registro:
        $('#actualizar').click(function() {
            // Obtenemos los datos del formulario
            var1 = $('#r_var1').val();
            var2 = $('#r_var2').val();
            var3 = $('#r_var3').val();
            var4 = $('#r_var4').val();
            var5 = $('#r_var5').val();
            var6 = $('#r_var6').val();
            var7 = $('#r_var7').val();
            var8 = $('#r_var8').val();
            var9 = $('#r_var9').val();
            var10 = $('#r_var10').val();

            // Comenzamos con el update
            tabla = 'Usuarios';
            operacion = 'actualizar';
            cadena="tabla="+tabla+
            "&operacion="+operacion+
            "&var1="+var1+
            "&var2="+var2+
            "&var3="+var3+
            "&var4="+var4+
            "&var5="+var5+
            "&var6="+var6+
            "&var7="+var7+
            "&var8="+var8+
            "&var9="+var9+
            "&var10="+var10; 

            if(var1 != "" &&
            	var2 != "" &&
            	var3 != "" &&
            	var4 != "" &&
            	var5 != "" &&
            	var6 != "" &&
            	var7 != "" &&
            	var8 != "" &&
            	var9 != "" &&
            	var10 != ""){
            	alertify.confirm('Actualizar cambios', '¿Desea guardar los cambios?', function(){ actualizar_usuario(cadena,tabla); }
            		, function(){ window.location="perfilCliente.php";});   
        }
        else
        {        
        	cadena="Campos vacios = ";
        	if(var1=="") cadena = cadena+"Usario |"; 
        	if(var2=="") cadena = cadena+"Nombre |"; 
        	if(var3=="") cadena = cadena+"Correo |"; 
        	if(var4=="") cadena = cadena+"Contraseña |"; 
        	if(var5=="") cadena = cadena+"Telefono |"; 
        	if(var6=="") cadena = cadena+"Numero de tarjeta |"; 
        	if(var7=="") cadena = cadena+"Mes de vencimiento |"; 
        	if(var8=="") cadena = cadena+"Año de vencimiento |"; 
        	if(var9=="") cadena = cadena+"CVV |"; 
        	if(var10=="") cadena = cadena+"Titular"; 
        	alertify.alert("Datos incompletos: ",cadena);
        }          
    });
    });
</script>