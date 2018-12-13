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
    if(isset($_GET['delete_id']))//Si esta puesto el get entonces se ejecuta, dice delete id pero realmente puede llevar cualquier valor, solo es renombrar la variable abajo en el boton
    {
      $pla=$_GET['delete_id'];//le doy el valor de los GET a variables ya que si lo hacia directo habia problemas con las comillas (cosas raras),
      $usu=$_GET['usua'];
      $sql_query="call EliminarResena('$pla','$usu')";
      $r= @mysqli_query($dbcon,$sql_query);
      header("Location: resena.php");
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
    <div class="" id="contenido">
    </div>
</body>
</html>

<!-- Cargar elementos -->
<script type="text/javascript">
    $(document).ready(function(){
    $('#menu').load("includes/menu/menu.php");
    $('#botones').load("includes/botones/botones.php");
    $('#body').load("includes/body/body.php");
    $('#contenido').load("includes/contenido/contenido_resena.php");
  });
</script>

