<?php

include('inc/funciones.php');
include ('cone/conexion.php');

$query="SELECT * FROM eventos ORDER BY idEventos DESC LIMIT 4";
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

	<!-- Deslizador de banners -->
    <?php get_slider(); ?>
    <!-- / Deslizador de banners -->

    <!-- Contenido -->
    <section id="intro">
        <div class="container">
            <h3>Bienvenido a nuestro sitio</h3>
            <div>

              <?php while($fila=$resultado->fetch_assoc()){ ?>

                <article>
                  <a href="<?php echo $url."evento?id=".$fila['idEventos']?>">
                    <img height="160px" src="<?php echo $url."/admin/assets/uploads/files/".$fila['imagen']?>" alt="" />
                  </a>
                    <p><a href="<?php echo $url."evento?id=".$fila['idEventos']?>"><?php echo $fila['titulo']; ?></a></p>
                </article>


                <?php } ?>

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
