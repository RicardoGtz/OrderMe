<?php
$id=$_REQUEST['id'];
?>

<!-- Contenido -->
<div class="animated fadeIn retraso-2 mx-auto">
    <!-- Texto -->
    <h2 class="Font_Raleway Dorado mediano_2 text-center mx-auto col-md-10 espacio-arriba">
    Platillos
    </h2>
    <!-- Area 1 -->
    <div class=" mx-auto Negro espacio-abajo">
        <!-- Linea divisora -->
        <hr style="color: #0056b2;"/>
        <!-- Articulos -->
        <div class="col-lg-4 col-md-6 col-sm-6 mx-auto quitar-float espacio-arriba espacio-abajo" id="tabla">
            <?php
              include('../../connectmysql.php');
                $sqldata= mysqli_query($dbcon,"call VerTieneSucursal('$id')");

                        while($row=mysqli_fetch_array($sqldata,MYSQLI_NUM)){
                            echo '<table class="table">';
                            echo '<thead class="thead-dark"><tr><th colspan="4" class="titulo">'.utf8_encode($row[1]).'</th></tr></thead>';
                            echo '<tr><td rowspan="4"><img src="comun/img/platillo/'.utf8_encode($row[4]).'" widht="150px" height="150px"></td>';
                            echo '<td>Nombre: '.utf8_encode($row[1]).'</td></tr>';
                            echo '<tr><td>Descripcion: '.utf8_encode($row[2]).'</td></tr>';
                            echo '<tr><td>Precio: $'.utf8_encode($row[3]).'</td></tr>';
                            echo '<tr><td class="enca">';
                            echo "<a href='resena.php?id=$row[0]' class='btn btn-secondary ' role='button' aria-pressed='true'>Ver Reseñas";
                    echo '</td><tr>';
                            echo '</table></br>';
                        }
              ?>
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