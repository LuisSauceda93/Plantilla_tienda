<?php

include('inc/funciones.php');
include ('cone/conexion.php');

$buscador=isset($_POST['buscador']) ? $_POST['buscador'] : NULL;

$query="SELECT * FROM Categorias WHERE nombre like '%$buscador%'";
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
    <section>
        <div class="container">
            <div class="row">

                <!-- Titular -->
                <div class="col-md-6 col-md-offset-3 text-center titular">
                    <h2>Catálogo</h2>
                    <p>Aquí se mostrarán todas las categorías de productos</p>
                </div>

                <!-- Catálogo -->
                <div class="col-md-12 catalogo">
                    <div class="row">

                      <?php while($fila=$resultado->fetch_assoc()){ ?>

                      <article>
                          <a href="<?php echo $url."categoria?id=".$fila['idCategoria']?>">
                            <img height="220px" class="thumb" src="<?php echo $url."/admin/assets/uploads/files/".$fila['imagen']?>">
                          </a>
                          <a href="<?php echo $url."categoria?id=".$fila['idCategoria']?>"><h3><?php echo $fila["nombre"] ?></h3></a>
                          <p><?php $cadena = $fila['descripcion'];
                              echo limitarPalabras($cadena,55)."...";//." <a href='http://www.google.com'><u>Ver mas</u></a>"; ?></p>
                      </article>

                      <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- / Contenido -->

  <!-- Cerrar BD -->

  <!-- / Cerrar BD -->

	<!-- Footer -->
    <?php get_pie(); ?>
    <!-- / Footer -->

	<!-- Scripts -->
    <?php get_scripts(); ?>
    <script type="text/javascript" src="/js/datos.js"></script>
    <!-- / Scripts -->

</body>
</html>
