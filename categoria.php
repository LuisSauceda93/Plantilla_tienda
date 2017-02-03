<?php

include('inc/funciones.php');
include ('cone/conexion.php');
$buscador=isset($_POST['buscador']) ? $_POST['buscador'] : NULL;
get_encabezado();
$url = get_url();
?>
    <!-- Login -->
    <?php get_login(); ?>
    <!-- / Login -->

	<!-- Barra de navegación -->
    <?php get_menu(); ?>
    <!-- / Barra de navegación -->

    <!-- Contenido -->
    <section id="catalogo">
        <div class="container">
            <div class="row catalogo">

                <!-- Slider -->
                <div class="col-md-12">

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

                <?php
                  include('cone/connect_db.php');
                  $id=$_GET['id'];
                  $sqlw = "SELECT productos.imagen as img,productos.nombre as nom,categorias.nombre as nom_cate,productos.idProducto as ID
                           FROM productos
                           JOIN categorias
                           ON productos.idCategoria=categorias.idCategoria
                           where productos.idCategoria='$id' and productos.nombre like '%$buscador%'" ;
                  $mysqli->query("SET character_set_results = 'utf8'");
                  $resultado=$mysqli->query($sqlw);
                  mysql_query("SET character_set_results = 'utf8'");
                  $result = mysql_query($sqlw);
                  $registro = mysql_fetch_array($result);
                 ?>

                <!-- Titular -->
                <div id="cat" class="col-md-6 col-md-offset-3 text-center titular">
                    <h2><?php echo $registro['nom_cate']; ?></h2>
                    <p>Aquí se mostrarán los productos de la categoría</p>
                </div>

                <!-- Categoría -->
                <div class="col-md-12">
                    <div class="row galeria">

                        <?php while($fila=$resultado->fetch_assoc()){ ?>

                        <article>
                            <a href="<?php echo $url."ficha?id=".$fila['ID']?>">
                                <img height="194px" src="<?php echo $url."/admin/assets/uploads/files/".$fila['img']?>" alt="" class="thumb"/>
                                <p><?php echo $fila['nom']; ?></p>
                            </a>
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
