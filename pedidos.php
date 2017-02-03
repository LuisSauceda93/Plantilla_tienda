<?php

include('inc/funciones.php');
include ('cone/conexion.php');

get_encabezado();
$url = get_url();
if(!isset($_SESSION['usuario']))
{
  header('Location: '. get_url());
  exit();
}

?>
    <!-- Login -->
    <?php get_login(); ?>
    <!-- / Login -->

	<!-- Barra de navegación -->
    <?php get_menu(); ?>
    <!-- / Barra de navegación -->

    <!-- Contenido -->
    <section id="pedidos">
        <div class="container">
            <div class="row ajuste">

                <!-- Titular -->
                <div class="col-md-6 col-md-offset-3 text-center titular">
                    <h2>Pedidos</h2>
                    <p>Aqui se muestran todos los pedidos realizados por el usuario</p>
                </div>

                <!-- Lista de pedidos -->
                <div class="col-lg-12 col-md-12">
                    <div class="row">

                      <?php
                        $correo = $_SESSION['correo'] ;
                        $sqlu = "SELECT idUsuario FROM usuarios WHERE correo ='$correo'";
                        $mysqli->query("SET character_set_results = 'utf8'");
                        $result = $mysqli->query($sqlu);
                        $row = $result->fetch_assoc();
                        $id = $row['idUsuario'];
                        $sqlw = "SELECT lpad(idpedidos,4,'0') as id,total,fecha as dat,idpedidos as idP,estatus
                                 FROM pedidos
                                 WHERE pedidos.idUsuario='$id'
                                 GROUP BY pedidos.idpedidos";
                        $mysqli->query("SET character_set_results = 'utf8'");
                        $resultado=$mysqli->query($sqlw);


                       ?>

                       <?php while($fila=$resultado->fetch_assoc()){ ?>

                        <article class="pedidos">
                            <div class="col-md-12 elemento">
                                <h3><a href="<?php echo $url."pedido?id=".$fila['idP']?>">Pedido #XBZ-<?php echo $fila['id']; ?></a><br /><small>Resumen:</small></h3>
                                <p>Fecha — <?php echo $fila['dat']; ?><br />Monto — MXN $<?php echo number_format($fila['total'], 2, '.', ','); ?><br>
                                Estatus — <?php echo $fila['estatus']; ?></p>
                            </div>
                            <div class="clearfix"></div>
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
