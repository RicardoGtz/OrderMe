<!-- Contenido -->
<div class="animated fadeIn retraso-2 mx-auto">
    <!-- Texto -->
    <h2 class="Font_Raleway Dorado mediano_2 text-center mx-auto col-md-10 espacio-arriba">
    Restaurantes afiliados con nosotros
    </h2>
    <!-- Area 1 -->
    <div class=" mx-auto Negro espacio-abajo">
        <!-- Linea divisora -->
        <hr style="color: #0056b2;"/>
        <!-- Articulos -->
        <div class="col-md-5 mx-auto quitar-float espacio-arriba espacio-abajo" id="tabla"></div>
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

<!-- Cargar elementos -->
<script type="text/javascript">
    $(document).ready(function(){
    $('#tabla').load("includes/tabla/afiliado.php");
  });
</script>