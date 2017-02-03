<?php

include('inc/funciones.php');
include('cone/conexion.php');

get_encabezado();
$url=get_url();

if(!isset($_SESSION['usuario']))
{
?>
  <script type="text/javascript">
  swal({
title: "Recuerda!",
text: "Debes hacer login para poder agregar productos a lista de deseos!",
type: "warning",
confirmButtonColor: "#DD6B55",
confirmButtonText: "Aceptar",
closeOnConfirm: false
},
function(){
window.location.href="<?php echo $url.'#openModal'; ?>";
});
  </script>
<?php
exit();

}

$correo     = $_SESSION['correo'];
$sqlw       = "SELECT idUsuario FROM usuarios WHERE correo='$correo'";
$mysqli->query("SET character_set_results = 'utf8'");
$result     = $mysqli->query($sqlw);
$registro   = $result->fetch_assoc();

$idUsuario  = $registro['idUsuario'];

if (isset($_GET['id'])) {
  $idProducto = $_GET['id'];
  $sqlin      = "INSERT INTO lista_de_deseos(idProducto,idUsuario) VALUES ($idProducto,$idUsuario)";
  $mysqli->query($sqlin);
}

$sqlr      = "SELECT ld.idlista, p.idProducto, p.nombre, p.descripcion, p.precio, p.imagen FROM productos p
              JOIN lista_de_deseos ld ON p.idProducto = ld.idProducto
              JOIN usuarios u ON u.idUsuario = ld.idUsuario
              WHERE u.idUsuario = '$idUsuario'";
$resultado = $mysqli->query($sqlr);
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
            <div class="row ajuste">

                <!-- Titular -->
                <div class="col-md-6 col-md-offset-3 text-center titular-producto">
                    <h2>Lista de deseos</h2>
                    <p>Aquí se mostrarán todos los productos guardados</p>
                </div>

                <!-- Lista de deseos -->
                <div class="col-md-12">
                    <div class="carrito">

                        <div class="panel panel-default">

                            <div class="panel-heading">
                                <div class="row">

                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="row">

                                            <div class="col-md-1 text-center">
                                                Img
                                            </div>
                                            <div class="col-md-8">
                                                Descripción
                                            </div>
                                            <div class="col-md-2">
                                                Precio
                                            </div>
                                            <div class="col-md-1">
                                                Acción
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="panel-body">
                                <div class="row">

                                  <?php
                                    while($fila = $resultado->fetch_assoc()){
                                  ?>

                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="row">

                                            <div class="col-md-1">
                                                <a href="<?php echo get_url(); ?>producto?id=<?php echo $fila['idProducto'] ?>">
                                                    <img class="thumb" src="<?php echo get_url()."/admin/assets/uploads/files/".$fila['imagen'];?>" alt="...">
                                                </a>
                                            </div>

                                            <div class="col-md-8">
                                                <h4 class="media-heading"><?php echo $fila['nombre'] ?></h4>
                                                <p><?php $cadena = $fila['descripcion'];
                                                    echo limitarPalabras($cadena,30)."..."; ?></p>
                                            </div>

                                            <div class="col-md-2">
                                                <a href="<?php echo get_url(); ?>confirmar">MXN$ <?php echo number_format($fila['precio'], 2, '.', '') ?></a>
                                             </div>

                                            <div class="col-md-1">
                                                <div class="row">
                                                  <div class="col-md-6">
                                                    <a onMouseOver="this.style.cursor='pointer'" onClick="javascript:window.location='<?php echo get_url()?>cone/eliminar.php?id=<?php echo $fila['idlista'] ?>'" title="Eliminar"><i class="fa fa-times"></i></a>
                                                  </div>
                                                  <div class="col-md-6">
                                                    <a onMouseOver="this.style.cursor='pointer'"  onClick="javascript:window.location='<?php echo get_url()?>carrito?id=<?php echo $fila['idProducto'] ?>&action=agregar'" title="Agregar al carrito"> <i class="glyphicon glyphicon-shopping-cart"></i></a>
                                                  </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="linea clearfix"></div>

                                    <?php } ?>

                                </div>
                            </div>

                            <div class="panel-footer">

                                  <div class="row text-left">

                                      <div class="col-xs-2 col-sm-7 col-md-9">
                                        <a href="<?php echo get_url(); ?>tienda" class="btn" role="button"><span class="fa fa-shopping-basket" aria-hidden="true"></span>&nbsp; Seguir agregando a lista de deseos</a>
                                      </div>

                              </div>
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
