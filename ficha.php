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
    <section id="catalogo">
        <div class="container">
            <div class="row gris catalogo">

              <?php
                include('cone/connect_db.php');

                $id=$_GET['id'];
                $sqlw = "SELECT * FROM productos where idProducto='$id'";
                $result = mysql_query($sqlw);
                $registro = mysql_fetch_array($result);
               ?>

                <!-- Titular -->
                <div class="col-md-6 col-md-offset-3 text-center titular">
                    <h2>Ficha Técnica</h2>
                    <p>Aquí se mostrará la información técnica del producto</p>
                </div>

                <!-- Ficha -->
                <div class="col-md-12">
                    <div class="ficha">

                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="row">

                                  <section>
                                    <img height="400px" class="thumb" src="<?php echo $url."/admin/assets/uploads/files/".$registro['imagen'];?>" alt=""/>
                                  </section>

                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="row">

                                <article>
                                    <h3><?php echo $registro['nombre']; ?></h3>
                                    <p><?php echo $registro['especificaciones']; ?></p>
                                    <a href="<?php echo $url."categoria?id=".$registro['idCategoria']?>" class="btn"><i class="fa fa-long-arrow-left"></i></a>

                                    <?php if ($registro['pdf']!=null) {?>
                                    <a href="<?php echo $url."admin/assets/uploads/descarga.php?archivo=".$registro['pdf'];?>" class="btn" onMouseMove="window.status='Hola, no me ves';" onMouseOut="window.status='';">Descargar PDF</a>
                                    <?php } ?>

                                    <a href="<?php echo $url."producto?id=".$registro['idProducto']?>" class="btn">Comprar</a>
                                    <div class="clearfix"></div>
                                </article>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-md-12">
                    <div class="tabs">

                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#descripcion" data-toggle="tab">Descripción</a></li>
                            <li class=""><a href="#comentarios" data-toggle="tab">Mas información</a></li>
                        </ul>

                        <div id="tab-contenido" class="tab-content">
                            <div class="tab-pane fade active in" id="descripcion">
                                <p><?php echo $registro['descripcion']; ?></p>
                            </div>
                            <div class="tab-pane fade" id="comentarios">
                              <h1>¿Qué quieres?</h1>
                              <form>
                                  <div class="form-group">
                                      <label for="exampleInputNombre1">Nombre:</label>
                                      <input type="text" class="form-control" id="exampleInputNombre1" placeholder="Dinos como te llamas" required>
                                  </div>
                                  <div class="form-group">
                                      <label for="exampleInputEmail1">Correo:</label>
                                      <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Proporsiónanos tu correo" required>
                                  </div>
                                      <label for="exampleInputComentario1">Comentario:</label>
                                      <textarea class="form-control" rows="2" placeholder="Escribe tu comentario o consulta"></textarea>
                                      <div class="checkbox">
                                      <p>
                                      <label for="">
                                      <input type="checkbox" required>&nbsp; He leído y acepto el <a target="_blank" href="<?php echo get_url(); ?>aviso">aviso de privacidad</a>
                                      </label>
                                      </p>
                                  </div>
                                  <button type="submit" class="btn largo">Enviar</button>
                              </form>
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
