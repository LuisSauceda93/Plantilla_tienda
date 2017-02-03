<?php

include('inc/funciones.php');
include ('cone/conexion.php');

$buscador=isset($_POST['buscador']) ? $_POST['buscador'] : NULL;

$query="SELECT idNoticias, titulo,contenido,fecha,imagen,
        usuarios.nombre, usuarios.apellido
        FROM noticias
        JOIN usuarios
        ON usuarios.idUsuario=noticias.idUsuario
        WHERE titulo like '%$buscador%'  or contenido like '%$buscador%'
        ORDER BY idNoticias DESC";
$mysqli->query("SET character_set_results = 'utf8'");
$resultado=$mysqli->query($query);
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
            <div class="row">

                <!-- Titular -->
                <div class="col-md-6 col-md-offset-3 text-center titular">
                    <h2>Noticias</h2>
                    <p>Aquí se mostrarán algunas noticias relevantes y blogs</p>
                </div>

                <!-- Noticias -->
                <div class="col-lg-9 col-md-9 blog">
                    <div class="row">

                      <?php while($fila=$resultado->fetch_assoc()){ ?>

                      <article class=entrada>
                          <div class=col-md-6>
                              <a href="<?php echo $url."articulo?id=".$fila['idNoticias']?>">
                                  <img class=thumb src="<?php echo $url."/admin/assets/uploads/files/".$fila['imagen']?>">
                              </a>
                          </div>
                          <div class=col-md-6>
                              <a href="<?php echo $url."articulo?id=".$fila['idNoticias']?>">
                                <h3><?php echo $fila["titulo"] ?></h3>
                              </a>
                              <span>Fecha: <?php echo $fila['fecha'] ?> —
                                    Autor: <?php echo $fila['nombre'] ?> <?php echo $fila['apellido'] ?>
                              </span>
                              <p><?php $cadena = $fila['contenido'];
                                  echo limitarPalabras($cadena,30)."..."; ?></p>
                          </div>
                          <div class=col-md-12>
                              <div class=linea></div>
                          </div>
                          <div class=clearfix></div>
                      </article>

                      <?php } ?>

                    </div>
                </div>

                <div class="col-md-3 col-lg-3 no-padding-lf">

                  <?php
                  include('cone/connect_db.php');
                  $query2="SELECT *
                          FROM eventos
                          ORDER BY idEventos DESC LIMIT 5";
                  $mysqli->query("SET character_set_results = 'utf8'");
                  $resultado2=$mysqli->query($query2);

                   ?>

                  <div class="sidebar">
                      <div class="col-md-12">
                          <img src="img/img-750x400.jpg" alt="" class="thumb" />
                      </div>
                      <div class="col-md-12">
                          <h3>Eventos recientes</h3>
                          <ul>
                            <?php while($fila=$resultado2->fetch_assoc()){ ?>
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
