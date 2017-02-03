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
    <section id="blog">
        <div class="container">
            <div class="row articulo">

                      <?php
                      include('cone/connect_db.php');

                      $id=$_GET['id'];
                      $sqlw = "SELECT * FROM noticias WHERE idNoticias='$id'";
                          mysql_query("SET character_set_results = 'utf8'");
                          mysql_query("ALTER TABLE noticias DROP idNoticias");
                          mysql_query("ALTER TABLE noticias AUTO_INCREMENT = 1");
                          mysql_query("ALTER TABLE noticias ADD idNoticias int NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST");
                          $result = mysql_query($sqlw);
                          $registro = mysql_fetch_array($result);
                          $menos=$registro['idNoticias'];
                          $mas=$registro['idNoticias'];
                       ?>

                        <!-- Titular -->
                        <div class="col-md-9 titular">
                            <h2><?php echo $registro['titulo'] ?></h2>
                        </div>

                        <!-- Evento -->
                        <div class="col-lg-9 col-md-9">
                            <div class="row">
                             <?php
                             if(mysql_num_rows($result)==1){

                                 $menos--;
                                 $mas++;

                                 ?>

                            <article class="entrada">
                                <div class="col-md-12">
                                        <img src="<?php echo $url."admin/assets/uploads/files/".$registro['imagen']?>" class="thumb">
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

                                        <a href="<?php echo $url."articulo?id=".$menos?>" class="btn"><i class="fa fa-long-arrow-left"></i></a>
                                        <a href="<?php echo get_url(); ?>blog" class="btn">Noticias</a>
                                        <a href="<?php echo $url."articulo?id=".$mas?>" class="btn"><i class="fa fa-long-arrow-right"></i></a>

                                     <?php } else{

                                         echo"<script>window.location='blog'</script>;";

                                       }

                                        ?>

                                </div>
                                <div class="clearfix"></div>
                            </article>

                            </div>
                        </div>
                  <div class="col-md-3 col-lg-3 no-padding-lf">

                    <?php
                    include('cone/conexion.php');
                    $query2="SELECT *
                            FROM eventos
                            ORDER BY idEventos DESC LIMIT 5";
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
                                <li><a href="<?php echo $url."evento?id=".$fila['idEventos']?>"><?php print $fila['titulo']; ?></a></li>
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
