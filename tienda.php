<?php

include('inc/funciones.php');
include ('cone/conexion.php');

$buscador=isset($_POST['filtro2']) ? $_POST['filtro2'] : NULL;
$filtro=isset($_POST['filtro']) ? $_POST['filtro'] : NULL;

$query="SELECT productos.imagen as img,productos.nombre as nom,productos.idProducto as idP,productos.precio as pre,categorias.nombre as nomC
        FROM productos
        JOIN categorias
        ON productos.idCategoria=categorias.idCategoria
        WHERE categorias.nombre like '%$filtro%'";
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
    <section id="tienda">
        <div class="container">
            <div class="row">

                <div class="col-md-12">

                    <!-- Slider -->
                    <div id="contSlider" style="padding: 5px; border-radius: 4px;">
                        <div id="cSlider">
                            <div id="slider">
                                <section><img src="img/slide.jpg" alt=""></section>
                                <section><img src="img/slide.jpg" alt=""></section>
                                <section><img src="img/slide.jpg" alt=""></section>
                                <section><img src="img/slide.jpg" alt=""></section>
                            </div>
                            <i class="fa fa-lg fa-chevron-left" id="btnPrev"></i>
                            <i  class="fa fa-lg fa-chevron-right" id="btnNext"></i>
                        </div>
                    </div>

                </div>

                <!-- Titular -->
                <div class="col-md-6 col-md-offset-3 text-center titular">
                    <h2>Tienda</h2>


                    <?php   include('cone/connect_db.php');
                      $sqlw = "SELECT *
                               FROM categorias";
                      $mysqli->query("SET character_set_results = 'utf8'");

                      $mysqli->query("SET character_set_results = 'utf8'");
                      $resultado2=$mysqli->query($sqlw);
                        ?>
                            <div class="row">
                              <?php
                                 while($fila2=$resultado2->fetch_assoc()){

                              ?>

                             <div class="col-xs-3 col-sm-2 col-md-2">
                                <form  method="post" action="">
                                  <input class="status" type="hidden" name="filtro" value="<?php print $fila2['nombre'];?>">
                                  <input  class="status" type="submit" value="<?php print $fila2['nombre'];?>">
                                </form>
                              </div>
                               <?php } ?>

                                          <form method="post" action="">
                                              <input type="hidden" name="filtro2" value="">
                                              <input  class="status" type="submit" value="Todos">
                                          </form>

                                        </div>
                                </div>

                <!-- Tienda -->
                <div class="col-md-12">
                    <div class="tienda">

                      <?php while($fila=$resultado->fetch_assoc()){ ?>

                        <article>
                            <a href="<?php echo get_url(); ?>producto?id=<?php echo $fila['idP'] ?>">
                                <img height="180px" src="<?php echo $url."/admin/assets/uploads/files/".$fila['img'] ?>" alt="..." class="thumb">
                            </a>
                            <p>
                                <span class="tit"><a href="<?php echo get_url(); ?>producto?id=<?php echo $fila['idP'] ?>"><?php echo $fila['nom'] ?></a></span>
                                <span class="precio">MXN$ <?php echo number_format($fila['pre'], 2, '.', ',') ?></span>
                            </p>
                        </article>

                        <?php } ?>

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
