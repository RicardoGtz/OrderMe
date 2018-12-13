<?php
session_start();
include('connectmysql.php');
$usuario = @$_SESSION['user'];
$id=@$_SESSION['usuario'];
?>

<!DOCTYPE html>
<html lang="es">
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
      Seleccion de Sucursal
    </h2>
    <!-- Area 1 -->
    <div class=" col-md-10 mx-auto Negro espacio-abajo">
      <!-- Linea divisora -->
      <hr style="color: #0056b2;"/>
      <!-- Articulos -->
      <p class="mediano text-center">Por favor selecciona la sucursal que prefieras en base a tu localización.</p>
      <div class="col-lg-8 col-md-8 col-sm-8 mx-auto quitar-float espacio-arriba espacio-abajo text-left" id ="formulario">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-body">
              <label>
                    Estado
                </label>
                <div id="menu_desplegable_1">
                    <select class="custom-select" id="var1">
                        <option value="">Selecciona un estado</option>
                    </select>
                </div>
                <label>
                    Ciudad
                </label>
                <div id="menu_desplegable_2">
                    <select class="custom-select" id="var2">
                        <option value="">Selecciona un Estado primero</option>
                    </select>
                </div>
                <label>
                    Restaurantes
                </label>
                <div id="menu_desplegable_3">
                    <select class="custom-select" id="var3">
                        <option value="">Selecciona una Ciudad primero</option>
                    </select>
                </div>
                <label>
                    Sucursales
                </label>
                <div id="menu_desplegable_4">
                    <select class="custom-select" id="var4">
                        <option value="">Selecciona una Ciudad primero</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
              <button tabindex="12" class="btn btn-info" data-dismiss="modal" id="insertar" type="button">
                Seleccionar
              </button>
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
  </div>
</body>
</html>

<!-- Cargar elementos -->
<script type="text/javascript">
    $(document).ready(function(){
    $('#menu').load("includes/menu/menu.php");
    $('#botones').load("includes/botones/botones.php");

    $('#menu_desplegable_1').load("includes/lista/lista.php",
    {columna:'estado',
    sub_columna:'ciudad', 
    sub_columna2:'restaurante',
    sub_columna3:'sucursal',
    variable:'var1',
    sub_variable:'var2',
    sub_variable2:'var3',
    sub_variable3:'var4',
    etiqueta:'#menu_desplegable_2',
    etiqueta2:'#menu_desplegable_3',
    etiqueta3:'#menu_desplegable_4'});
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
        $('#insertar').click(function() {
            // Obtenemos los datos del formulario
            var1 = $('#var1').val();
            var2 = $('#var2').val();
            var3 = $('#var3').val();
            var4 = $('#var4').val();
            alertify.success(var1 + "|" + var2 + "|" + var3 + "|" + var4);
            // Comenzamos con el update
            tabla = 'Usuarios';
            operacion = 'ordenar';
            cadena="tabla="+tabla+
            "&operacion="+operacion+
            "&var1="+var1+
            "&var2="+var2+
            "&var3="+var3+
            "&var4="+var4; 
             
            if(var1 != "" &&
                var2 != "" &&
                var3 != "" &&
                var4 != "" ){
              alertify.success(var1 + "|" + var2 + "|" + var3 + "|" + var4);
              alertify.confirm('Seleccionar sucursal', '¿Desea seleccionar esa sucursal?', function(){ window.location="ordenInsert.php";}
               ,function(){ window.location="#";});   
            }
            else
            {        
                cadena="Campos vacios = ";
                if(var1=="") cadena = cadena+"Usario |"; 
                if(var2=="") cadena = cadena+"Nombre |"; 
                if(var3=="") cadena = cadena+"Correo |"; 
                if(var4=="") cadena = cadena+"Contraseña |"; 
                alertify.alert("Datos incompletos: ",cadena);
            }          
        });
  });
</script>