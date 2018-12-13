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
  error_reporting(0);
  include('connectmysql.php');
  if(isset($_GET['delete_id']))//Si esta puesto el get entonces se ejecutas, dice delete id pero realmente puede llevar cualquier valor, solo es renombrar la variable abajo en el boton
  {
    $ciu=$_GET['delete_id'];//le doy el valor de los GET a variables ya que si lo hacia directo habia problemas con las comillas (cosas raras),
    $pro=$_GET['provinc'];
    $sql_query="call EliminarCiudad('$ciu','$pro')";
    $r= @mysqli_query($dbcon,$sql_query);
    header("Location: ciudad.php");
  }
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
      Ciudades
    </h2>
    <!-- Area 1 -->
    <div class=" col-md-10 mx-auto Negro espacio-abajo">
      <!-- Linea divisora -->
      <hr style="color: #0056b2;"/>
      <!-- Articulos -->
      <p class="mediano text-center">A continuacion, se mostrara el catalogo de los las ciudades donde trabaja la aplicación OrderMe.</p>
      <?php
      if (@$_SESSION['user'] == 'administradorG'){
        echo "<div class='text-center'>
              <a href='ciudadinsert.php' class='btn btn-secondary ' role='button' aria-pressed='true'>Insertar</a>;
        </div>";
      }
      ?>
      <div class="col-lg-8 col-md-8 col-sm-8 mx-auto quitar-float espacio-arriba espacio-abajo text-left" id ="formulario">
       <table class="table table-striped">
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Provincia</th>
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
            $sqldata= mysqli_query($dbcon,"call VerCiudad()");

            while($row=mysqli_fetch_array($sqldata,MYSQLI_NUM)){
              echo "<tr><td>";
              echo utf8_encode($row[0]);
              echo "</td><td>";
              echo utf8_encode($row[1]);
              echo "</td>";
              if (@$_SESSION['user'] == 'administradorG'){
                echo "<td><a href='ciudadinsert.php?ciudad=$row[0]&provincia=$row[1]'><img src='comun/img/sistema/act2.png' class='img-rounded'></td>";
                echo "<td><a href='ciudad.php?delete_id=$row[0]&provinc=$row[1]' onclick='return confirm('sure to delete !');'><img src='comun/img/sistema/eli2.png' alt='Delete' class='img-rounded'/></a></td>";
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
        // insert:
        $('#insertar').click(function() {
            // Obtenemos los datos del formulario
            var1 = $('#var1').val();
            var2 = $('#var2').val();

            // Comenzamos con el update
            tabla = 'administradorG';
            operacion = 'insert';
            cadena="tabla="+tabla+
            "&operacion="+operacion+
            "&var1="+var1+
            "&var2="+var2; 
            
            if(var1 != "" &&
              var2 != "" ){
              agregar(cadena,tabla); 
          }
          else
          {        
            cadena="Campos vacios = ";
            if(var1=="") cadena = cadena+"Nombre |"; 
            if(var2=="") cadena = cadena+"Provincia |"; 
            alertify.alert("Datos incompletos: ",cadena);
          }          
        });
      });
    </script>

