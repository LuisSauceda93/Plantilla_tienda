<?php

include('inc/funciones.php');

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
    <section id="tienda">
        <div class="container">
            <div class="row">

              <?php
                include('cone/connect_db.php');

                $id=$_GET['id'];
                $sqlw = "SELECT idProducto,imagen,precio as precio,especificaciones,nombre,descripcion FROM productos where idProducto='$id'";
                mysql_query("SET character_set_results = 'utf8'");
                $result = mysql_query($sqlw);
                $registro = mysql_fetch_array($result);
               ?>

                <!-- Titular -->
                <div class="col-md-6 col-md-offset-3 text-center titular-producto">
                    <h2>Producto</h2>
                    <p>Aquí se mostrará la información técnica del producto</p>
                </div>

                <!-- Producto -->
                <div class="col-md-12">
                    <div class="producto">

                        <!-- Slider -->
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="row">
                                    <section>
                                      <img height="400px" class="thumb" src="<?php echo $url."/admin/assets/uploads/files/".$registro['imagen'];?>" alt="">
                                    </section>
                            </div>
                        </div>

                        <!-- Detalles del producto -->
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="row">
                                <article>
                                    <h3><?php echo $registro['nombre']; ?></h3>
                                    <strong>$<?php echo number_format($registro['precio'], 2, '.', ','); ?> MXN</strong><br>
                                    <p><?php echo $registro['especificaciones']; ?></p>
                                    <a href="<?php echo get_url(); ?>lista?id=<?php echo $registro['idProducto']?>" class="btn" role="button"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>&nbsp; Añadir a lista de deseos</a>
                                    <a id="addCart" href="<?php echo get_url(); ?>carrito?id=<?php echo $registro['idProducto']?>&action=agregar" class="btn" role="button"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>&nbsp; Agregar al Carrito</a>

                                    <div class="clearfix"></div>
                                </article>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Especificaciones y descrioción -->
                <div class="col-md-12">
                    <div class="tabs">

                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#descripcion" data-toggle="tab">Descripción</a></li>

                        </ul>

                        <div id="tab-contenido" class="tab-content">
                            <div class="tab-pane fade active in" id="descripcion">
                                <p><?php echo $registro['descripcion']; ?></p>
                            </div>

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
