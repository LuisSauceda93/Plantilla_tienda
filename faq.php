<?php

include('inc/funciones.php');
include ('cone/conexion.php');

$buscador=isset($_POST['buscador']) ? $_POST['buscador'] : NULL;

$query="SELECT * FROM preguntas WHERE pregunta like '%$buscador%' or respuesta like '%$buscador%'";
$mysqli->query("SET character_set_results = 'utf8'");
$resultado=$mysqli->query($query);

get_encabezado();

?>
    <!-- Login -->
    <?php get_login(); ?>
    <!-- / Login -->

	<!-- Barra de navegación -->
    <?php get_menu(); ?>
    <!-- / Barra de navegación -->

    <!-- Contenido -->
    <section id="faq">
        <div class="container">
            <div class="row ajuste">

                <!-- Titular -->
                <div class="col-md-6 col-md-offset-3 text-center titular">
                    <h2>FAQ's</h2>
                    <p>Respuestas a preguntas frecuentes</p>
                </div>

                <!-- Preguntas precuentes -->
                <div class="col-lg-12 col-md-12">
                    <div class="row">

                      <?php while($fila=$resultado->fetch_assoc()){ ?>

                        <article>
                            <div class="col-md-10">
                                <h3><?php echo $fila['pregunta']; ?></h3>
                                <strong>Respuesta</strong>:<?php echo $fila['respuesta']; ?>
                            </div>
                            <div class="clearfix"></div>
                        </article>

                        <?php } ?>

                    </div>
                </div>

                <!--confirmidad y formulario-->
                <div class="col-lg-12 col-md-12">
                    <div class="row contenedor_form">

                        <div class="col-md-12">
                            <div class="linea" style="margin-bottom:40px;"></div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-8">
                        <h1>Haz una pregunta</h1>

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
                            <button type="submit" class="btn btn-default">Enviar</button>
                        </form>

                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-4">
                            <img src="img/img-400x400.jpg" class="thumb">
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
