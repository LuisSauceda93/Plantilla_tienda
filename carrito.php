<?php

include('inc/funciones.php');
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
            <div class="row ajuste">

                <!-- Titular -->
                <div class="col-md-6 col-md-offset-3 text-center titular-producto">
                    <h2>Carrito</h2>
                    <p>Aquí se mostrarán todos los productos añadidos al carrito <a href="<?php echo $url?>tienda">seguir comprando</a></p>
                </div>

                <!-- Carrito -->
                <div class="col-md-12">
                    <div class="carrito">

                        <div class="panel panel-default">

                            <div class="panel-heading">
                                <div class="row">

                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="row">

                                            <div class="col-xs-2 col-sm-2 col-md-1 text-center">
                                                Img
                                            </div>
                                            <div class="col-xs-5 col-sm-5 col-md-6">
                                                Descripción
                                            </div>
                                            <div class="col-xs-1 col-sm-1 col-md-2">
                                                Cant.
                                            </div>
                                            <div class="col-xs-2 col-sm-2 col-md-2">
                                                Precio
                                            </div>
                                            <div class="col-xs-2 col-sm-2 col-md-1">
                                                Elim.
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>


                            <div class="panel-body">
                                <div class="row">
                                  <?php
                                  include ('cone/connect_db.php');

                                  if (isset($_GET['id'])) {
                                    $id = $_GET['id'];
                                  }
                                  else {
                                    $id = 0;
                                    if (!isset($_SESSION['cesta'])) {
                                      $_SESSION['cesta'] =  array();
                                    }
                                  }

                                  if (isset($_GET['action'])) {
                                    $action = $_GET['action'];
                                  }
                                  else {
                                    $action = "";
                                  }


                                  switch($action) {

                                    case "agregar":
                                      if(!isset($_SESSION['cesta'][$id])) {
                                        $_SESSION['cesta'][$id] = 1;
                                        $_SESSION['xCantidad']  = 1;
                                      }else {}
                                    break;

                                    case "sumar":
                                      $_SESSION['cesta'][$id]++;
                                      $_SESSION['xCantidad']++;
                                      break;

                                    case "restar":
                                      if(isset($_SESSION['cesta'][$id])) {
                                        $_SESSION['cesta'][$id]--;
                                        if($_SESSION['cesta'][$id]==0) {
                                          unset($_SESSION['cesta'][$id]);
                                        }
                                      }

                                    break;
                                    case "quitar":
                                      if(isset($_SESSION['cesta'][$id])) {
                                        unset($_SESSION['cesta'][$id]);
                                      }
                                    break;

                                    default:
                                    break;

                                  }

                                  if(isset($_SESSION['cesta'])) {

                                    $subtotal  = 0.0;
                                    $total     = 0.0;
                                    $iva       = 0.0;
                                    $xCantidad = 0;

                                    foreach($_SESSION['cesta'] as $id => $cantidad) {

                                      $sqlw        = "SELECT * FROM productos WHERE idProducto='$id'";
                                                     mysql_query("SET character_set_results = 'utf8'");
                                      $result      = mysql_query($sqlw);
                                      $registro    = mysql_fetch_array($result);

                                      $id          = $registro['idProducto'];
                                      $nombre      = $registro['nombre'];
                                      $descripcion = $registro['descripcion'];
                                      $imagen      = $registro['imagen'];
                                      $precio      = $registro['precio'];

                                      $coste       = $precio    * $cantidad;
                                      $subtotal    = $subtotal  + $coste;
                                      $iva         = $subtotal  * 0.16;
                                      $total       = $subtotal  + $iva;
                                      $xCantidad   = $xCantidad + $cantidad;

                                      $_SESSION['subtotal'] = $subtotal;
                                      $_SESSION['iva']      = $iva;
                                      $_SESSION['total']    = $total;

                                  ?>

                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="row">

                                            <div class="col-xs-2 col-sm-2 col-md-1">
                                                <a href="<?php echo $url?>producto?id=<?php echo $id ?>">
                                                    <img class="thumb" src="<?php echo $url."/admin/assets/uploads/files/".$imagen?>" alt="...">
                                                </a>
                                            </div>

                                            <div class="col-xs-5 col-sm-5 col-md-6">
                                                <h4 class="media-heading"><?php echo $nombre ?></h4>
                                                <p><?php $cadena = $descripcion;
                                                    echo limitarPalabras($cadena,30)."...";?></p>
                                            </div>

                                            <div class="col-xs-1 col-sm-1 col-md-2">
                                              <div class="row">
                                                <div class="col-xs-4 col-sm-4 col-md-4 text-center">
                                                  <a onMouseOver="this.style.cursor='pointer'"  onClick="javascript:window.location='<?php echo $url?>carrito?id=<?php echo $id ?>&action=sumar'">
                                                    <i class="fa fa-plus-circle"></i>
                                                  </a>
                                                 </div>
                                                <div class="col-xs-4 col-sm-4 col-md-4 text-center">
                                                  <strong><?php echo $cantidad ?></strong>
                                                </div>
                                                <div class="col-xs-4 col-sm-4 col-md-4 text-center">
                                                  <a onMouseOver="this.style.cursor='pointer'"  onClick="javascript:window.location='<?php echo $url?>carrito?id=<?php echo $id ?>&action=restar'">
                                                    <i class="fa fa-minus-circle"></i>
                                                  </a>
                                                 </div>
                                              </div>
                                             </div>

                                            <div class="col-xs-2 col-sm-2 col-md-2">
                                                <a href="<?php echo $url?>confirmar">MXN$ <?php echo number_format($coste, 2, '.', ',') ?></a>
                                             </div>

                                            <div class="col-xs-2 col-sm-2 col-md-1">
                                                <a onMouseOver="this.style.cursor='pointer'"  onClick="javascript:window.location='<?php echo $url?>carrito?id=<?php echo $id ?>&action=quitar'"><i class="fa fa-times"></i></a>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="linea clearfix"></div>

                                    <?php } ?>

                                </div>
                            </div>

                            <div class="panel-footer">

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="row text-left">

                                        <div class="col-xs-2 col-sm-2 col-md-7">
                                        </div>
                                        <div class="col-xs-5 col-sm-5 col-md-2">
                                            <p>Subtotal</p>
                                        </div>
                                        <div class="col-xs-5 col-sm-5 col-md-3">
                                            <p>MXN$<?php echo number_format($subtotal, 2, '.', ',') ?></p>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="row text-left">

                                        <div class="col-xs-2 col-sm-2 col-md-7">
                                        </div>
                                        <div class="col-xs-5 col-sm-5 col-md-2">
                                            <p>IVA (16%)</p>
                                        </div>
                                        <div class="col-xs-5 col-sm-5 col-md-3">
                                            <p>MXN$<?php echo number_format($iva, 2, '.', ',')?></p>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="row text-left">

                                        <div class="col-xs-2 col-sm-2 col-md-7">
                                        </div>
                                        <div class="col-xs-5 col-sm-5 col-md-2">
                                            <p class="negrita">Total</p>
                                        </div>
                                        <div class="col-xs-5 col-sm-5 col-md-3">
                                            <p class="negrita">MXN$<?php echo number_format($total, 2, '.', ',') ?></p>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="row text-left">

                                        <div class="col-xs-2 col-sm-7 col-md-9">
                                          <a href="<?php echo get_url(); ?>tienda" class="btn" role="button"><span class="fa fa-shopping-basket" aria-hidden="true"></span>&nbsp; Seguir comprando</a>
                                        </div>
                                        <div class="col-xs-9 col-sm-5 col-md-3">
                                          <?php
                                          if(empty($_SESSION['cesta']))
                                          {?>
                                          <a href="" class="btn" disabled="disabled" role="button"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>&nbsp; Procesar pedido</a>
                                        <?php } else { ?>
                                            <a href="<?php echo get_url(); ?>compra" class="btn" role="button"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>&nbsp; Procesar pedido</a>

                                      <?php } ?>

                                        </div>

                                    </div>
                                </div>

                                <div class="clearfix"></div>

                                <?php } ?>

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
