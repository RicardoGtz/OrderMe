<!-- Contenido -->
<div class="animated fadeIn retraso-2 mx-auto">
    <!-- Texto -->
    <h2 class="Font_Raleway Dorado mediano_2 text-center mx-auto col-md-10 espacio-arriba">
    Reseñas
    </h2>
    <!-- Area 1 -->
    <div class=" col-md-10 mx-auto Negro espacio-abajo">
        <!-- Linea divisora -->
        <hr style="color: #0056b2;"/>
        <!-- Articulos -->
        <p class="mediano text-center">A continuacion, se mostrarán las reseñas que los usuarios escriben sobre los platillos.</p>
        <?php
          if (@$_SESSION['user'] == 'administradorG'){
            echo "<div class='centrado'><input class='boto' type='button' name='insert' value='Insertar' onclick=location.href='resenainsert.php'></div>";
          }
        ?>
        <div class="col-lg-4 col-md-6 col-sm-6 mx-auto quitar-float espacio-arriba espacio-abajo" id="tabla">
            <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Platillo</th>
                    <th>Usuario</th>
                    <th>Calificacion</th>
                    <th>Comentario</th>
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
                    include('../../connectmysql.php');
                    $sqldata= mysqli_query($dbcon,"call VerResena()");

                    while($row=mysqli_fetch_array($sqldata,MYSQLI_NUM)){
                      echo "<tr><td>";
                      echo utf8_encode($row[2]);
                      echo "</td><td>";
                      echo utf8_encode($row[3]);
                      echo "</td><td>";
                      echo utf8_encode($row[4]);
                      echo "</td><td>";
                      echo utf8_encode($row[5]);
                      echo "</td>";
                      if (@$_SESSION['user'] == 'administradorG'){
                        echo "<td><a href='resenainsert.php?id=$row[0]&p=$row[1]'><img src='comun/img/sistema/act2.png' class='img-rounded'></td>";
                        echo "<td><a href='resena.php?delete_id=$row[0]&usua=$row[1]' onclick='return confirm('sure to delete !');'><img src='comun/img/sistema/eli2.png' alt='Delete' class='img-rounded'/></a></td>";
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
</div>

<div class="contenedor">
  <h1 class="courgete">Reseñas</h1>
  <p></p>
  <p class="centrado">A continuacion, se mostrarán las reseñas que los usuarios escriben sobre los platillos.</p>
    <?php
      if (@$_SESSION['user'] == 'administradorG'){
        echo "<div class='centrado'><input class='boto' type='button' name='insert' value='Insertar' onclick=location.href='resenainsert.php'></div>";
      }
    ?>
  <p></p>
  <div class="table-responsive">
    
  </div>
</div>