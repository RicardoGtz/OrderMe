<?php
$usuario = @$_SESSION['user'];
$id=@$_SESSION['usuario'];
?>
<body>
		<!-- Encabezado -->
        <div class="col-lg-10 col-md-10 col-sm-10 mx-auto text-left animated fadeIn espacio-arriba">
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
                Bienvenido: <?php echo $id; ?>
            </h2>
            <!-- Area 1 -->
            <div class=" mx-auto Negro">
                <!-- Linea divisora -->
                <hr style="color: #0056b2;"/>
                <!-- Articulos -->
                <div class="row espacio-derecha_1 espacio-izquieda_1 espacio-arriba_1">
                    <div class="col-md-6 col-sm-6 col-xs-6 mx-auto espacio-abajo_2">
                        <!-- Carrusel -->
                        <div class="text-center mx-auto">
                            <div class="carousel slide" data-ride="carousel" id="Siguiente">
                                <ol class="carousel-indicators">
                                    <li class="active" data-slide-to="0" data-target="#Siguiente">
                                    </li>
                                    <li data-slide-to="1" data-target="#Siguiente">
                                    </li>
                                    <li data-slide-to="2" data-target="#Siguiente">
                                    </li>
                                </ol>
                                <div class="carousel-inner CarouselImg">
                                    <div class="carousel-item active">
                                        <img alt="" class="d-block w-100" src="comun/img/general/1.jpg">
                                        </img>
                                    </div>
                                    <div class="carousel-item">
                                        <img alt="" class="d-block w-100" src="comun/img/general/1.jpg">
                                        </img>
                                    </div>
                                    <div class="carousel-item">
                                        <img alt="" class="d-block w-100" src="comun/img/general/1.jpg">
                                        </img>
                                    </div>
                                </div>
                                <a class="carousel-control-prev" data-slide="prev" href="#Siguiente" role="button">
                                    <span aria-hidden="true" class="carousel-control-prev-icon">
                                    </span>
                                    <span class="sr-only">
                                        Previous
                                    </span>
                                </a>
                                <a class="carousel-control-next" data-slide="next" href="#Siguiente" role="button">
                                    <span aria-hidden="true" class="carousel-control-next-icon">
                                    </span>
                                    <span class="sr-only">
                                        Next
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6 mx-auto">
                        <h2 class="text-center">
                            Te ofrecemos
                        </h2>
                        <p class="mediano ">Encuentra la comida que más te gusta de tus restaurantes locales y cadenas favoritas.Encuentra la comida que más te gusta de tus restaurantes locales y cadenas favoritas.Encuentra la comida que más te gusta de tus restaurantes locales y cadenas favoritas. </p>
                        <p class="mediano"><strong>Encuentra la comida que más te gusta de tus restaurantes locales y cadenas favoritas.</strong></p>
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

<!-- Cargar elementos -->
<script type="text/javascript">
    $(document).ready(function(){
    $('#menu').load("includes/menu/menu.php");
    $('#botones').load("includes/botones/botones.php");
  });
</script>