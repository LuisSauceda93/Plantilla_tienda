<?php

include('inc/funciones.php');
include ('cone/conexion.php');
$url = get_url();
get_encabezado();
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
    <section id="pedido">
        <div class="container">
            <div class="row ajuste">

              <?php
              //Consulta Pedido
                $id=$_GET['id'];

                $correo = $_SESSION['correo'] ;
                $sqlu = "SELECT idUsuario FROM usuarios WHERE correo ='$correo'";
                $mysqli->query("SET character_set_results = 'utf8'");
                $result = $mysqli->query($sqlu);
                $row = $result->fetch_assoc();
                $idUsuario = $row['idUsuario'];
                $sqlw = "SELECT lpad(pedidos.idpedidos,4,'0') as id,total,subtotal,pedidos.idpedidos as idP,pedidos.idUsuario as idUsuarioP,cantidad,productos.nombre as nombreP,precio,estatus,estatus_pago,num_cuenta,num_clabe,nom_titular,forma_pago,nom_banco,num_tarjeta,forma_envio,usuarios.domicilio as domicilioU,pedidos.domicilio as domicilioP
                         FROM usuarios
                         JOIN pedidos
                         ON usuarios.idUsuario=pedidos.idUsuario
                         JOIN det_pedidos
                         ON pedidos.idpedidos=det_pedidos.idpedidos
                         JOIN productos
                         ON productos.idProducto=det_pedidos.idProducto
                         where pedidos.idpedidos='$id' AND pedidos.idUsuario ='$idUsuario'";
                $mysqli->query("SET character_set_results = 'utf8'");
                $resultado=$mysqli->query($sqlw);
                $registro = $resultado->fetch_assoc();
                $estatus = $registro['estatus'];
                $forma_pago = $registro['forma_pago'];
                $estatus_pago = $registro['estatus_pago'];
                $forma_envio = $registro['forma_envio'];
                $subtotal = 0;

               ?>
                <!-- Titular -->
                <div class="col-md-12 titular">
                    <h2>Pedido</h2>
                    <p>Confirmación de pedido y detalles de pago <a class="pedidos" href="<?php echo $url."pedidos"?>">Ver todos lo pedidos</a></p>
                </div>

                <!-- Confirmación de pedido -->
                <div class="col-lg-7 col-md-12">
                    <div class="row">

                    <article class="entrada">
                        <div class="col-md-12">
                            <div class="row">


                                <h3>Pedido #XBZ-<?php echo $registro['id']?></h3>
                                <p>A continuación se presentan los detalles del pedido</p>

                                <div class="linea"></div>

                                <h3>Estatus del pedido</h3>
                              <!--Recibido-->
                                <?php
                                  if ($estatus=="Recibido") {
                                    ?>

                                    <span class="estatus warning act">Recibido</span>
                                <?php
                                  }else {
                                ?>
                                <span class="estatus">Recibido</span>
                                <?php
                                  }
                                 ?>
                                 <!--En proceso-->
                                 <?php
                                   if ($estatus=="En proceso") {
                                     ?>
                                     <span class="estatus warning act">En proceso</span>
                                 <?php
                                   }else {
                                 ?>
                                 <span class="estatus">En proceso</span>
                                 <?php
                                   }
                                  ?>
                                  <!--Enviado-->
                                  <?php
                                    if ($estatus=="Enviado") {
                                      ?>
                                      <span class="estatus warning act">Enviado</span>
                                  <?php
                                    }else {
                                  ?>
                                  <span class="estatus">Enviado</span>
                                  <?php
                                    }
                                   ?>
                                   <!--Entregado-->
                                   <?php
                                     if ($estatus=="Entregado") {
                                       ?>
                                       <span class="estatus success act">Entregado</span>
                                   <?php
                                     }else {
                                   ?>
                                   <span class="estatus">Entregado</span>

                                   <?php
                                     }
                                    ?>

                                    <!--Cancelado-->
                                    <?php
                                      if ($estatus=="Cancelado") {
                                        ?>

                                        <span class="estatus cancel act">Cancelado</span>

                                        <div class="" style="display:none;">
                                        </div>

                                    <?php
                                      }else {



                                    if($estatus_pago=="Pendiente"){ ?>

                                    <span class="estatus">Cancelado</span>
                                    <div class="" style="display:block">
                                      <h3>Detalles de pago</h3>
                                      <p><span class="estatus warning act">Pendiente de pago</span><span class="estatus">Pagado (verificado)</span></p>
                                      <?php if ($forma_pago=="Bancaria") { ?>

                                      <p>

                                          <strong>DATOS DE PAGO</strong><br />
                                          <strong>Forma de pago seleccionada</strong>: <?php print $registro['forma_pago'];  ?><br />
                                          <strong>Banco</strong>: <?php print $registro['nom_banco']; ?><br />
                                          <strong>No. de cuenta</strong>: <?php print $registro['num_cuenta']; ?><br />
                                          <strong>No. clabe</strong>: <?php print $registro['num_clabe']; ?><br />
                                          <strong>Titular</strong>: <?php print $registro['nom_titular']; ?><br /><br />
                                          <strong>DATOS DE ENVIO</strong><br />
                                          <?php
                                          if ($forma_envio=="Mensajería Express") { ?>
                                          <strong>Forma de envio seleccionada</strong>: <?php print $registro['forma_envio'];?><br />
                                          <strong>Entrega al domicilio</strong>: <?php print $registro['domicilioU']; ?>
                                        <?php } elseif ($forma_envio=="Correos de México") { ?>
                                          <strong>Forma de envio seleccionada</strong>: <?php print $registro['forma_envio'];?><br />
                                          <strong>Entrega al domicilio</strong>: <?php print $registro['domicilioU']; ?>
                                        <?php } else { ?>
                                          <strong>Forma de envio seleccionada</strong>: <?php print $registro['forma_envio'];?><br />
                                          <strong>Recoger en</strong>: <?php print $registro['domicilioP']; ?>
                                        <?php  } ?>
                                      </p>
                                      <form class="" action="<?php echo get_url(); ?>/admin/assets/uploads/cancelar.php" method="post">
                                    <input type="hidden" name="id" value="<?php echo $id ?>">
                                    <input type="submit" name="cancelar" class="btn" value="Cancelar pedido">
                                      </form>
                                      <?php }elseif ($forma_pago=="OXXO") { ?>

                                        <p>
                                          <strong>DATOS DE PAGO</strong><br />
                                          <strong>Forma de pago seleccionada</strong>: <?php print $registro['forma_pago'];  ?><br />
                                          <strong>Banco</strong>: <?php print $registro['nom_banco']; ?><br />
                                          <strong>No. de tarjeta</strong>: <?php print $registro['num_tarjeta']; ?><br />
                                          <strong>Titular</strong>: <?php print $registro['nom_titular']; ?><br /><br />
                                          <strong>DATOS DE ENVIO</strong><br />
                                          <?php
                                          if ($forma_envio=="Mensajería Express") { ?>
                                          <strong>Forma de envio seleccionada</strong>: <?php print $registro['forma_envio'];?><br />
                                          <strong>Entrega al domicilio</strong>: <?php print $registro['domicilioU']; ?>
                                        <?php } elseif ($forma_envio=="Correos de México") { ?>
                                          <strong>Forma de envio seleccionada</strong>: <?php print $registro['forma_envio'];?><br />
                                          <strong>Entrega al domicilio</strong>: <?php print $registro['domicilioU']; ?>
                                        <?php } else { ?>
                                          <strong>Forma de envio seleccionada</strong>: <?php print $registro['forma_envio'];?><br />
                                          <strong>Recoger en</strong>: <?php print $registro['domicilioP']; ?>
                                        <?php  } ?>
                                      </p>
                                      <form class="" action="<?php echo get_url(); ?>/admin/assets/uploads/cancelar.php" method="post">
                                    <input type="hidden" name="id" value="<?php echo $id ?>">
                                    <input type="submit" name="cancelar" class="btn" value="Cancelar pedido">
                                      </form>
                                            <?php } else { ?>

                                              <p>
                                                  <strong>DATOS DE PAGO</strong><br />
                                                  <strong>Forma de pago seleccionada</strong>: <?php print $registro['forma_pago'];  ?><br /><br />
                                                  <strong>DATOS DE ENVIO</strong><br />
                                                  <?php
                                                  if ($forma_envio=="Mensajería Express") { ?>
                                                  <strong>Forma de envio seleccionada</strong>: <?php print $registro['forma_envio'];?><br />
                                                  <strong>Entrega al domicilio</strong>: <?php print $registro['domicilioU']; ?>
                                                <?php } elseif ($forma_envio=="Correos de México") { ?>
                                                  <strong>Forma de envio seleccionada</strong>: <?php print $registro['forma_envio'];?><br />
                                                  <strong>Entrega al domicilio</strong>: <?php print $registro['domicilioU']; ?>
                                                <?php } else { ?>
                                                  <strong>Forma de envio seleccionada</strong>: <?php print $registro['forma_envio'];?><br />
                                                  <strong>Recoger en</strong>: <?php print $registro['domicilioP']; ?>
                                                <?php  } ?>

                                              </p>
                                              <div class="row">
                                <div class="col-xs-3">
                                  <form class="" action="<?php echo get_url(); ?>/admin/assets/uploads/cancelar.php" method="post">
                                  <input type="submit" name="pagar" class="btn pagar" value="Pagar pedido">
                                  <input type="hidden" name="id" value="<?php echo $id ?>">

                                    </form>
                                </div>
                                  <div class="col-xs-3">
                                    <form class="" action="<?php echo get_url(); ?>admin/assets/uploads/cancelar.php" method="post">
                                  <input type="hidden" name="id" value="<?php echo $id ?>">
                                  <input type="submit" name="cancelar" class="btn" value="Cancelar pedido">
                                    </form>
                                  </div>
                              </div>
                                          <?php } ?>
                                        </p>
                                    </div>

                                    <?php }elseif ($estatus_pago=="Pagado") {?>

                                      <span class="estatus">Cancelado</span>
                                      <div class="" style="display:block">
                                        <h3>Detalles de pago</h3>
                                        <p><span class="estatus">Pendiente de pago</span><span class="estatus act success">Pagado (verificado)</span></p>
                                        <?php if ($forma_pago=="Bancaria") { ?>

                                        <p>
                                          <strong>DATOS DE PAGO</strong><br />
                                          <strong>Forma de pago seleccionada</strong>: <?php print $registro['forma_pago'];  ?><br />
                                          <strong>Banco</strong>: <?php print $registro['nom_banco']; ?><br />
                                          <strong>No. de cuenta</strong>: <?php print $registro['num_cuenta']; ?><br />
                                          <strong>No. clabe</strong>: <?php print $registro['num_clabe']; ?><br />
                                          <strong>Titular</strong>: <?php print $registro['nom_titular']; ?><br /><br />
                                          <strong>DATOS DE ENVIO</strong><br />
                                          <?php
                                          if ($forma_envio=="Mensajería Express") { ?>
                                          <strong>Forma de envio seleccionada</strong>: <?php print $registro['forma_envio'];?><br />
                                          <strong>Entrega al domicilio</strong>: <?php print $registro['domicilioU']; ?>
                                        <?php } elseif ($forma_envio=="Correos de México") { ?>
                                          <strong>Forma de envio seleccionada</strong>: <?php print $registro['forma_envio'];?><br />
                                          <strong>Entrega al domicilio</strong>: <?php print $registro['domicilioU']; ?>
                                        <?php } else { ?>
                                          <strong>Forma de envio seleccionada</strong>: <?php print $registro['forma_envio'];?><br />
                                          <strong>Recoger en</strong>: <?php print $registro['domicilioP']; ?>
                                        <?php  } ?>
                                        </p>
                                        <?php }elseif ($forma_pago=="OXXO") { ?>

                                          <p>
                                            <strong>DATOS DE PAGO</strong><br />
                                            <strong>Forma de pago seleccionada</strong>: <?php print $registro['forma_pago'];  ?><br />
                                            <strong>Banco</strong>: <?php print $registro['nom_banco']; ?><br />
                                            <strong>No. de tarjeta</strong>: <?php print $registro['num_tarjeta']; ?><br />
                                            <strong>Titular</strong>: <?php print $registro['nom_titular']; ?><br /><br />
                                            <strong>DATOS DE ENVIO</strong><br />
                                            <?php
                                            if ($forma_envio=="Mensajería Express") { ?>
                                            <strong>Forma de envio seleccionada</strong>: <?php print $registro['forma_envio'];?><br />
                                            <strong>Entrega al domicilio</strong>: <?php print $registro['domicilioU']; ?>
                                          <?php } elseif ($forma_envio=="Correos de México") { ?>
                                            <strong>Forma de envio seleccionada</strong>: <?php print $registro['forma_envio'];?><br />
                                            <strong>Entrega al domicilio</strong>: <?php print $registro['domicilioU']; ?>
                                          <?php } else { ?>
                                            <strong>Forma de envio seleccionada</strong>: <?php print $registro['forma_envio'];?><br />
                                            <strong>Recoger en</strong>: <?php print $registro['domicilioP']; ?>
                                          <?php  } ?>
                                        </p>
                                              <?php } else { ?>
                                                <p>
                                                    <strong>DATOS DE PAGO</strong><br />
                                                    <strong>Forma de pago seleccionada</strong>: <?php print $registro['forma_pago'];  ?><br /><br />
                                                    <strong>DATOS DE ENVIO</strong><br />
                                                    <?php
                                                    if ($forma_envio=="Mensajería Express") { ?>
                                                    <strong>Forma de envio seleccionada</strong>: <?php print $registro['forma_envio'];?><br />
                                                    <strong>Entrega al domicilio</strong>: <?php print $registro['domicilioU']; ?>
                                                  <?php } elseif ($forma_envio=="Correos de México") { ?>
                                                    <strong>Forma de envio seleccionada</strong>: <?php print $registro['forma_envio'];?><br />
                                                    <strong>Entrega al domicilio</strong>: <?php print $registro['domicilioU']; ?>
                                                  <?php } else { ?>
                                                    <strong>Forma de envio seleccionada</strong>: <?php print $registro['forma_envio'];?><br />
                                                    <strong>Recoger en</strong>: <?php print $registro['domicilioP']; ?>
                                                  <?php  } ?>

                                                </p>
                                            <?php } ?>
                                      </div>

                                    <?php
                                  } else { ?>

                                    <span class="estatus">Cancelado</span>
                                    <div class="" style="display:block">
                                      <h3>Detalles de pago</h3>
                                      <p><span class="estatus">Pendiente de pago</span><span class="estatus">Pagado (verificado)</span></p>
                                      <?php if ($forma_pago=="Bancaria") { ?>

                                      <p>

                                          <strong>DATOS DE PAGO</strong><br />
                                          <strong>Forma de pago seleccionada</strong>: <?php print $registro['forma_pago'];  ?><br />
                                          <strong>Banco</strong>: <?php print $registro['nom_banco']; ?><br />
                                          <strong>No. de cuenta</strong>: <?php print $registro['num_cuenta']; ?><br />
                                          <strong>No. clabe</strong>: <?php print $registro['num_clabe']; ?><br />
                                          <strong>Titular</strong>: <?php print $registro['nom_titular']; ?><br /><br />
                                          <strong>DATOS DE ENVIO</strong><br />
                                          <?php
                                          if ($forma_envio=="Mensajería Express") { ?>
                                          <strong>Forma de envio seleccionada</strong>: <?php print $registro['forma_envio'];?><br />
                                          <strong>Entrega al domicilio</strong>: <?php print $registro['domicilioU']; ?>
                                        <?php } elseif ($forma_envio=="Correos de México") { ?>
                                          <strong>Forma de envio seleccionada</strong>: <?php print $registro['forma_envio'];?><br />
                                          <strong>Entrega al domicilio</strong>: <?php print $registro['domicilioU']; ?>
                                        <?php } else { ?>
                                          <strong>Forma de envio seleccionada</strong>: <?php print $registro['forma_envio'];?><br />
                                          <strong>Recoger en</strong>: <?php print $registro['domicilioP']; ?>
                                        <?php  } ?>
                                      </p>
                                      <?php }elseif ($forma_pago=="OXXO") { ?>

                                        <p>
                                          <strong>DATOS DE PAGO</strong><br />
                                          <strong>Forma de pago seleccionada</strong>: <?php print $registro['forma_pago'];  ?><br />
                                          <strong>Banco</strong>: <?php print $registro['nom_banco']; ?><br />
                                          <strong>No. de tarjeta</strong>: <?php print $registro['num_tarjeta']; ?><br />
                                          <strong>Titular</strong>: <?php print $registro['nom_titular']; ?><br /><br />
                                          <strong>DATOS DE ENVIO</strong><br />
                                          <?php
                                          if ($forma_envio=="Mensajería Express") { ?>
                                          <strong>Forma de envio seleccionada</strong>: <?php print $registro['forma_envio'];?><br />
                                          <strong>Entrega al domicilio</strong>: <?php print $registro['domicilioU']; ?>
                                        <?php } elseif ($forma_envio=="Correos de México") { ?>
                                          <strong>Forma de envio seleccionada</strong>: <?php print $registro['forma_envio'];?><br />
                                          <strong>Entrega al domicilio</strong>: <?php print $registro['domicilioU']; ?>
                                        <?php } else { ?>
                                          <strong>Forma de envio seleccionada</strong>: <?php print $registro['forma_envio'];?><br />
                                          <strong>Recoger en</strong>: <?php print $registro['domicilioP']; ?>
                                        <?php  } ?>
                                      </p>
                                            <?php } else { ?>

                                              <p>
                                                  <strong>DATOS DE PAGO</strong><br />
                                                  <strong>Forma de pago seleccionada</strong>: <?php print $registro['forma_pago'];  ?><br /><br />
                                                  <strong>DATOS DE ENVIO</strong><br />
                                                  <?php
                                                  if ($forma_envio=="Mensajería Express") { ?>
                                                  <strong>Forma de envio seleccionada</strong>: <?php print $registro['forma_envio'];?><br />
                                                  <strong>Entrega al domicilio</strong>: <?php print $registro['domicilioU']; ?>
                                                <?php } elseif ($forma_envio=="Correos de México") { ?>
                                                  <strong>Forma de envio seleccionada</strong>: <?php print $registro['forma_envio'];?><br />
                                                  <strong>Entrega al domicilio</strong>: <?php print $registro['domicilioU']; ?>
                                                <?php } else { ?>
                                                  <strong>Forma de envio seleccionada</strong>: <?php print $registro['forma_envio'];?><br />
                                                  <strong>Recoger en</strong>: <?php print $registro['domicilioP']; ?>
                                                <?php  } ?>

                                              </p>
                                          <?php } ?>
                                        </p>
                                    </div>

                              <?php }} ?>


                            </div>
                        </div>

                        <div class="clearfix"></div>
                    </article>

                    </div>
                </div>

                <div class="col-md-12 col-lg-5 no-padding-lf">

                    <div class="carrito">

                        <h3><small>Detalles de la compra:</small></h3>

                        <div class="panel panel-default">

                            <div class="panel-heading">
                                <div class="row">

                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="row">

                                            <div class="col-xs-6 col-sm-6 col-md-7">
                                                Producto
                                            </div>
                                            <div class="col-xs-2 col-sm-2 col-md-1">
                                                #
                                            </div>
                                            <div class="col-xs-4 col-sm-4 col-md-4">
                                                Precio
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="panel-body">
                                <?php
                                  $resultado=$mysqli->query($sqlw);
                                  while($fila=$resultado->fetch_assoc()){
                                  $subtotal = $registro['subtotal'];
                                 ?>
                                <div class="row">

                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="row">

                                            <div class="col-xs-6 col-sm-6 col-md-7">
                                                <?php echo $fila['nombreP']; ?>
                                            </div>
                                            <div class="col-xs-2 col-sm-2 col-md-1">
                                                <?php echo $fila['cantidad']; ?>
                                            </div>
                                            <div class="col-xs-4 col-sm-4 col-md-4">
                                                <?php echo "MXN$ ".number_format($fila['precio'], 2, '.', ','); ?>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="linea clearfix"></div>

                                </div>
                                <?php } ?>
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
                                          <?php

                                            $iva    = $subtotal*0.16;
                                            $total  = $registro['total'];
                                            $cargos = $total - ($subtotal+$iva);

                                           ?>
                                            <p><?php echo "MXN$".number_format($subtotal, 2, '.', ','); ?></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="row text-left">

                                        <div class="col-xs-2 col-sm-2 col-md-7">
                                        </div>
                                        <div class="col-xs-5 col-sm-5 col-md-2">
                                            <p>IVA (16%) más cargos adicionales (monto envío)</p>
                                        </div>
                                        <div class="col-xs-5 col-sm-5 col-md-3">
                                            <p><?php echo "MXN$".number_format(($iva + $cargos), 2, '.', ',') ?></p>
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
                                            <p class="negrita"><?php echo "MXN$".number_format($total, 2, '.', ','); ?></p>
                                        </div>

                                    </div>
                                </div>

                                <div class="clearfix"></div>

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
