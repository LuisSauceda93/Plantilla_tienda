<?php

include('inc/funciones.php');
$url = get_url();

get_encabezado();

?>

    <!-- Login -->
    <?php get_login(); ?>
    <!-- / Login -->

	<!-- Barra de navegación -->
    <?php get_menu(); ?>
    <!-- / Barra de navegación -->

    <!-- Contenido -->
    <section id="eventos">
        <div class="container">
            <div class="row evento">
              <?php
                include('cone/connect_db.php');

                $id=$_GET['id'];
                $sqlw = "select * from eventos where idEventos='$id'";
                mysql_query("SET character_set_results = 'utf8'");
                $result = mysql_query($sqlw);
                $registro = mysql_fetch_array($result);
               ?>

                <!-- Titular -->
                <div class="col-md-9 titular">
                    <h2><?php echo $registro['titulo'] ?></h2>
                </div>

                <!-- Evento -->
                <div class="col-lg-9 col-md-9 eventos">
                    <div class="row">

                    <article class="entrada">
                        <div class="col-md-12">
                                <img src="<?php echo $url."/admin/assets/uploads/files/".$registro['imagen']?>" class="thumb">
                        </div>
                        <div class="col-md-12">
                            <h3><?php echo $registro['titulo'] ?></h3>
                            <span>Fecha: <?php echo $registro['fecha'] ?></span>
                            <p><?php echo $registro['contenido'] ?></p>
                        </div>
                        <div class="col-md-12">
                            <div class="linea"></div>
                        </div>
                        <div class="col-md-12">
                                <a href="<?php echo get_url(); ?>eventos" class="btn"><i class="fa fa-long-arrow-left"></i></a>
                                <a href="<?php echo get_url(); ?>contacto" class="btn">Solicitar informes</a>
                        </div>
                        <div class="clearfix"></div>
                    </article>

                    </div>
                </div>

                <div class="col-md-3 col-lg-3 no-padding-lf">

                  <?php
                  include('cone/conexion.php');
                  $query2="SELECT *
                          FROM noticias
                          ORDER BY idNoticias DESC LIMIT 5";
                  $mysqli->query("SET character_set_results = 'utf8'");
                  $resultado=$mysqli->query($query2);

                   ?>

                  <div class="sidebar">
                      <div class="col-md-12">
                          <img src="img/img-750x400.jpg" alt="" class="thumb" />
                      </div>
                      <div class="col-md-12">
                          <h3>Noticias recientes</h3>
                          <ul>
                            <?php while($fila=$resultado->fetch_assoc()){ ?>
                              <li><a href="<?php echo $url."articulo?id=".$fila['idNoticias']?>"><?php print $fila['titulo']; ?></a></li>
                            <?php } ?>

                          </ul>
                          <h3>Bloque de texto</h3>
                          <p>Muy lejos, más allá de las montañas de palabras, alejados de los países de las vocales y las consonantes, viven los textos simulados. Viven aislados en casas de letras, en la costa de la semántica, un gran océano de lenguas. Un riachuelo llamado Pons fluye por su pueblo y los abastece con las normas necesarias.</p>
                      </div>
                  </div>

                </div>

            </div>
        </div>
    </section>
    <!-- / Contenido -->

    <!-- Footer -->
    <?php get_pie(); ?>
    <!-- / Footer -->

    <!-- Scripts -->
    <?php get_scripts(); ?>
    <!-- / Scripts -->

</body>
</html>
