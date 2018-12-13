<?php
session_start();
$usuario = @$_SESSION['user'];
echo $usuario;

error_reporting(0);
include('connectmysql.php');
  if(isset($_GET['delete_id']))//Si esta puesto el get entonces se ejecuta, dice delete id pero realmente puede llevar cualquier valor, solo es renombrar la variable abajo en el boton
  {
    $usu=$_GET['delete_id'];//le doy el valor de los GET a variables ya que si lo hacia directo habia problemas con las comillas (cosas raras),
    $sql_query="call EliminarUsuario('$usu')";
    $r= @mysqli_query($dbcon,$sql_query);
    header("Location: usuario.php");
  }
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
      Usuarios
    </h2>
    <!-- Area 1 -->
    <div class=" col-md-10 mx-auto Negro espacio-abajo">
      <!-- Linea divisora -->
      <hr style="color: #0056b2;"/>
      <!-- Articulos -->
      <p class="mediano text-center">A continuacion, se mostrarán los usuarios/clientes que han sigo registrados para la aplicación OrderMe.</p>
      <?php
      if (@$_SESSION['user'] == 'administradorG'){
        echo "<div class='centrado'><input class='boto' type='button' name='insert' value='Insertar' onclick=location.href='registro.php'></div>";
      }
      ?>
      <div class="col-lg-8 col-md-8 col-sm-8 mx-auto quitar-float espacio-arriba espacio-abajo text-left" id ="formulario">
       <table class="table table-striped">
        <thead>
          <tr>
            <th>Usuario</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Contraseña</th>
            <th>Telefono</th>
            <th>Numero de Tarjeta</th>
            <th>Mes/Año Vencimiento</th>
            <th>CVV</th>
            <th>Titular</th>
            <?php
            if (@$_SESSION['user'] == 'administradorG'){
              echo "<th>Editar</th>";
              echo "<th>Eliminar</th>";
            }
            ?>
          </tr>
        </thead>
        <tbody>
          <?php
          include('connectmysql.php');
          $sqldata= mysqli_query($dbcon,"call VerUsuario()");

          while($row=mysqli_fetch_array($sqldata,MYSQLI_NUM)){
            echo "<tr><td>";
            echo utf8_encode($row[0]);
            echo "</td><td>";
            echo utf8_encode($row[1]);
            echo "</td><td>";
            echo utf8_encode($row[2]);
            echo "</td><td>";
            echo utf8_encode($row[3]);
            echo "</td><td>";
            echo utf8_encode($row[4]);
            echo "</td><td>";
            echo utf8_encode($row[5]);
            echo "</td><td>";
            echo utf8_encode($row[6]).'/'.utf8_encode($row[7]);
            echo "</td><td>";
            echo utf8_encode($row[8]);
            echo "</td><td>";
            echo utf8_encode($row[9]);
            echo "</td>";
            if (@$_SESSION['user'] == 'administradorG'){
              echo "<td><a href='registro.php?id=$row[0]&p=$row[1]'><img src='comun/img/sistema/act2.png' class='img-rounded'></td>";
              echo "<td><a href='usuario.php?delete_id=$row[0]' onclick='return confirm('sure to delete !');'><img src='comun/img/sistema/eli2.png' alt='Delete' class='img-rounded'/></a></td>";
              echo "<tr>";
            }
          }
          ?>
        </tbody>
      </table>
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
</body>
</html>

<!-- Cargar elementos -->
<script type="text/javascript">
  $(document).ready(function(){
    $('#menu').load("includes/menu/menu.php");
    $('#botones').load("includes/botones/botones.php");
    $('#body').load("includes/body/body.php");

    $('#menu_desplegable_1').load("includes/lista/lista.php",
      {columna:'estado',
      sub_columna:'ciudad', 
      variable:'var4',
      sub_variable:'var5',
      etiqueta:'#menu_desplegable_2'});

  });
</script>
<!-- Modal para iniciar sesion-->
<div aria-labelledby="myModalLabel" class="modal fade" id="modalSesion" role="dialog" tabindex="-1">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">
          Iniciar Sesion
        </h4>
        <button aria-label="Close" tabindex="1" class="close" data-dismiss="modal" type="button">
          <span aria-hidden="true">
            ×
          </span>
        </button>
      </div>
      <div class="modal-body">
        <label>
          Usuario:
        </label>
        <input tabindex="2" aria-describedby="basic-addon2" aria-label="Usuario" class="form-control input-sm rounded" id="i_var1" maxlength="7" onkeypress="return soloLetras(event);" placeholder="Usuario" required="" type="text"/>
        <label>
          Contraseña:
        </label>
        <input tabindex="2" aria-describedby="basic-addon2" aria-label="Contraseña" class="form-control input-sm rounded" id="i_var2" maxlength="10" onkeypress="return soloLetras(event);" placeholder="Contraseña" required="" type="password"/>
      </div>
      <div class="modal-footer">
        <button tabindex="3" class="btn btn-info" data-dismiss="modal" id="iniciar" type="button">
          Ingresar
        </button>
      </div>
    </div>
  </div>
</div>
<!-- Modal para registrase-->
<div aria-labelledby="myModalLabel" class="modal fade" id="modalRegistrarse" role="dialog" tabindex="-1">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">
          Registrarse
        </h4>
        <button tabindex="1" aria-label="Close" class="close" data-dismiss="modal" type="button">
          <span aria-hidden="true">
            ×
          </span>
        </button>
      </div>
      <div class="modal-body">
        <label>
          Usuario:
        </label>
        <input tabindex="2" aria-describedby="basic-addon2" aria-label="Usuario" class="form-control input-sm rounded" id="r_var1" maxlength="7" onkeypress="return soloLetras(event);" placeholder="Usuario" required="" type="text"/>
        <label>
          Nombre:
        </label>
        <input tabindex="3" aria-describedby="basic-addon2" aria-label="Nombre" class="form-control input-sm rounded" id="r_var2" maxlength="40" onkeypress="return soloLetras(event);" placeholder="Nombre" required="" type="text"/>
        <label>
          Correo:
        </label>
        <input tabindex="4" aria-describedby="basic-addon2" aria-label="Correo" class="form-control input-sm rounded" id="r_var3" maxlength="40" placeholder="Correo@" required="" type="text"/>
        <label>
          Contraseña:
        </label>
        <input tabindex="5" aria-describedby="basic-addon2" aria-label="Contraseña" class="form-control input-sm rounded" id="r_var4" maxlength="10" onkeypress="return soloLetras(event);" placeholder="Contraseña" required="" type="password"/>
        <label>
          Telefono:
        </label>
        <input tabindex="6" aria-describedby="basic-addon2" aria-label="Telefono" class="form-control input-sm rounded" id="r_var5" maxlength="10" onkeypress="return soloNumeros(event);" placeholder="Telefono" required="" type="text"/>
        <!-- Linea divisora -->
        <hr style="color: #0056b2;"/>
        <label>
          Número de tarjeta:
        </label>
        <input  tabindex="7" aria-describedby="basic-addon2" aria-label="Numero de tarjeta" class="form-control input-sm rounded" id="r_var6" maxlength="16" onkeypress="return soloNumeros(event);" placeholder="0000-0000-0000-0000" required="" type="text"/>
        <label>
          Mes de vencimiento:
        </label>
        <input tabindex="8" aria-describedby="basic-addon2" aria-label="Mes de vencimiento" class="form-control input-sm rounded" id="r_var7" maxlength="2" onkeypress="return soloNumeros(event);" placeholder="Mes" required="" type="text"/>
        <label>
          Año de vencimiento:
        </label>
        <input tabindex="9" aria-describedby="basic-addon2" aria-label="Año de vencimiento" class="form-control input-sm rounded" id="r_var8" maxlength="2" onkeypress="return soloNumeros(event);" placeholder="Año" required="" type="text"/>
        <label>
          CVV:
        </label>
        <input tabindex="10" aria-describedby="basic-addon2" aria-label="cvv" class="form-control input-sm rounded" id="r_var9" maxlength="3" onkeypress="return soloNumeros(event);" placeholder="cvv" required="" type="text"/>
        <label>
          Titular:
        </label>
        <input tabindex="40" aria-describedby="basic-addon2" aria-label="Titular" class="form-control input-sm rounded" id="r_var10" maxlength="3" onkeypress="return soloLetras(event);" placeholder="Titular" required="" type="text"/>
      </div>
      <div class="modal-footer">
        <button tabindex="12" class="btn btn-info" data-dismiss="modal" id="registrar" type="button">
          Registrarse
        </button>
      </div>
    </div>
  </div>
</div>
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
        $('#registrar').click(function() {
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
            
            // Comenzamos con la insercion:
            tabla = 'Usuarios';
            operacion = 'agregar';
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

            alertify.success("Comienza el insert");   
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
              alertify.success("Comienza el insert");   
            agregar(cadena,tabla);
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
          $('#r_var1').val("");
          $('#r_var2').val("");
          $('#r_var3').val("");
          $('#r_var4').val("");
          $('#r_var5').val("");
          $('#r_var6').val("");
          $('#r_var7').val("");
          $('#r_var8').val("");
          $('#r_var9').val("");
          $('#r_var10').val("");
        });

        // Iniciar sesion:
        $('#iniciar').click(function() {
          var1 = $('#i_var1').val();
          var2 = $('#i_var2').val();
          cadena=
          "&var1="+var1+
          "&var2="+var2;
          if(var1 != "" && var2 != ""){ 
                //alertify.alert("Datos : ",cadena); 
                login(cadena);
              }
              else
              {
                cadena="Campos vacios = ";
                if(var1=="") cadena = cadena+"Usario |";  
                if(var2=="") cadena = cadena+"Contraseña |"; 
                alertify.alert("Datos incompletos: ",cadena);
                return false;
              }
              $('#i_var1').val("");
              $('#i_var2').val("");
            });
      });
    </script>
