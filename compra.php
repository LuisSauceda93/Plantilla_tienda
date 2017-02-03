<?php

include('inc/funciones.php');

get_encabezado();
if(empty($_SESSION['cesta']))
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
    <section id="compra">
        <div class="container">
            <div class="row ajuste">

                <!-- Titular -->
                <div class="col-md-12 titular">
                    <h2>Compra</h2>
                    <p>Corrobora tu compra y proporciona los datos</p>
                </div>

                <!-- Proceso de compra -->
                <div class="col-lg-7 col-md-7">
                    <div class="row">

                    <article class="entrada">
                        <div class="col-md-12">
                            <div class="row">

                                <h3>Finalizar compra</h3>
                                <p>A continuación se presentan los detalles para realizar tu compra y confirmar el pedido</p>

                                <div class="linea"></div>

                                <h3><strong>1.</strong> Identifícate o regístrate</h3>
                                <p>Muy lejos, más allá de las montañas de palabras, alejados de los países de las vocales y las consonantes, viven los textos simulados. Viven aislados en casas de letras, en la costa de la semántica, un gran océano de lenguas.</p>

                                <?php if (!isset($_SESSION['usuario'])) { ?>

                                <div class="tabs">

                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#login" data-toggle="tab">Login</a></li>
                                        <li><a href="#registro" data-toggle="tab">Registro</a></li>
                                    </ul>

                                    <div id="tab-contenido" class="tab-content">
                                        <div class="tab-pane fade active in" id="login">
                                            <form method="post" action="<?php echo get_url(); ?>cone/validar.php">
                                                <div class="form-group">
                                                    <label for="usuario">E-Mail:</label>
                                                    <input type="text" name="correo" class="form-control" id="usuario" placeholder="Ingresar tu correo electrónico" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="password">Contraseña:</label>
                                                    <input type="password" name="password" class="form-control" id="password" placeholder="Ingresar password" required>
                                                </div>
                                                <button type="submit" class="btn btn-default log">Login</button>
                                            </form>
                                        </div>
                                        <div class="tab-pane fade" id="registro">

                                            <form method="post" name="formulario" action="<?php echo get_url(); ?>/admin/assets/uploads/regCompra.php" enctype="multipart/form-data" >
                                                <div class="form-group">
                                                    <label for="nombre">Datos de indentificación:</label>
                                                    <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre" required>
                                                    <input type="text" name="apellidos" class="form-control" id="apellidos" placeholder="Apellidos" required>
                                                    <textarea class="form-control" name="descripcion" id="descripcion" rows="2" placeholder="Escribe tu descripcion"></textarea>
                                                    <input type="hidden" name="fechaAlta" class="form-control" id="fechaAlta" value="<?php echo date('Y').'-'.date('m').'-'.date('d'); ?>" required>
                                                    <input type="hidden" name="tipo" class="form-control" id="tipo" value="Cliente" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="correo">Dirección de correo:</label>
                                                    <input type="email" name="correo" class="form-control" id="correo" placeholder="Ingresa tu correo electrónico" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="domicilio">Domicilio <small>(Dirección de entrega para compras)</small>:</label>
                                                    <input type="text" name="domicilio" class="form-control" id="domicilio" placeholder="Calle y número, Colonia, CP, Ciudad, Pais" required>
                                                    <input type="number" name="telefono" class="form-control" id="telefono"  placeholder="Numero telefonico" required onKeyUp="return limitar(event,this.value,10)" onKeyDown="return limitar(event,this.value,10)">
                                                </div>
                                                <div class="form-group">
                                                  <label for="factura">¿Requiere factura? <small>(sólo para México)</small></label><br />
                                                    <input style="margin-left: 15px;" type="radio" name="factura" id="factura1" value="Si" onclick="toggle(this)" required>&nbsp; Si requiero la factura<br /><br>
                                                    <div class="form-group" id="factura" style="display:none;">
                                                        <label for="nombre"><strong>Datos de facturación:</strong></label>
                                                        <input type="text" name="rfcF" class="form-control" id="rfcF" placeholder="RFC" >
                                                        <input type="text" name="nombreF" class="form-control" id="nombre" placeholder="Nombre" >
                                                        <input type="text" name="domicilioF" class="form-control" id="domicilio" placeholder="Domicilio fiscal" >
                                                        <input type="number" class="form-control" name="telefonoF" id="telefono" placeholder="Numero telefonico" onKeyUp="return limitar(event,this.value,10)" onKeyDown="return limitar(event,this.value,10)">
                                                        <input class="form-control" name="correoF" id="correo" placeholder="Correo de facturación" >
                                                        <input type="hidden" name="userID" class="form-control" id="userID" value="<?php echo $registro['idUsuario']; ?>" >

                                                    </div>
                                                    <input style="margin-left: 15px;" type="radio" name="factura" id="factura2" value="No" onclick="toggle(this)">&nbsp; No la requiero<br />
                                                </div>
                                                <div class="form-group">
                                                    <label for="password">Elije una contraseña:</label>
                                                    <input type="password" name="password" class="form-control" id="password1" placeholder="Ingresa una contraseña" required>
                                                    <input type="password" name="password2" class="form-control" id="password2"  placeholder="Confirma la contraseña" required>
                                                </div>
                                                <p>
                                                    <label for="">
                                                        <input type="checkbox" name="aviso" value="" required>&nbsp; He leído y acepto el <a target="_blank" href="aviso">aviso de privacidad</a>
                                                    </label>
                                                </p>
                                                <div class="form-group">
                                                    <button type="submit" name="submit" class="btn">Crear registro</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>

                                </div>

                                <?php } else { ?>

                                  <p> Ya estás identificado como <strong> <?php echo $_SESSION['usuario'] ?> </strong> ¿No eres tú? Cambia de sesión <strong> <a href="#openModal">aquí</a></strong></p>

                                  <?php } ?>

                                <div class="linea"></div>

                                <h3><strong>2.</strong> Método de envío y forma de pago</h3>
                                <p style="padding-bottom: 10px;">Muy lejos, más allá de las montañas de palabras, alejados de los países de las vocales y las consonantes, viven los textos simulados. Viven aislados en casas de letras, en la costa de la semántica, un gran océano de lenguas.</p>

                                <form method="get" action="<?php echo get_url(); ?>cone/agregar_pedido.php">
                                    <div class="form-group col-sm-12 col-md-6 col-lg-6">
                                        <div class="row">
                                            <label for="envio">Seleccione un método de envío:</label><br />
                                            <input style="margin-left: 15px;" type="radio" name="envio" id="envio1" value="Mensajería express" required>&nbsp; Mensajería exprés<br />
                                            <input style="margin-left: 15px;" type="radio" name="envio" id="envio2" value="Correos de México">&nbsp; Correos de México (MexPost)<br />
                                            <input style="margin-left: 15px;" type="radio" name="envio" id="envio3" value="Entrega personal">&nbsp; Entrega personal (recoger en sitio)<br />
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-12 col-md-6 col-lg-6">
                                        <div class="row">
                                            <label for="pago">Seleccione una forma de pago:</label><br />
                                            <input style="margin-left: 15px;" type="radio" name="pago" id="pago1" value="Bancaria" required>&nbsp; Depósito bancario / Transferencia<br />
                                            <input style="margin-left: 15px;" type="radio" name="pago" id="pago2" value="PayPal">&nbsp; PayPal<br />
                                            <input style="margin-left: 15px;" type="radio" name="pago" id="pago3" value="OXXO">&nbsp; Tienda Oxxo <small>(sólo México)</small><br />
                                        </div>
                                    </div>

                                    <div class="linea clearfix"></div>

                                    <h3><strong>3.</strong> Corrobora tu compra y confirma pedido</h3>
                                    <p style="padding-bottom: 10px;">Muy lejos, más allá de las montañas de palabras, alejados de los países de las vocales y las consonantes, viven los textos simulados.</p>

                                    <div class="carrito">

                                        <div class="panel panel-default">

                                            <div class="panel-heading">
                                                <div class="row">

                                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                                        <div class="row">

                                                            <div class="col-xs-6 col-sm-6 col-md-7">
                                                                Producto
                                                            </div>
                                                            <div class="col-xs-2 col-sm-2 col-md-2">
                                                                Cantidad
                                                            </div>
                                                            <div class="col-xs-4 col-sm-4 col-md-3">
                                                                Precio
                                                            </div>

                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="panel-body">
                                                <div class="row">

                                                  <?php
                                                  include ('cone/connect_db.php');

                                                  if (isset($_SESSION['cesta'])) {

                                                    foreach ($_SESSION['cesta'] as $id => $cantidad) {

                                                      $sqlw     = "SELECT * FROM productos WHERE idProducto='$id'";
                                                      mysql_query("SET character_set_results = 'utf8'");
                                                      $result   = mysql_query($sqlw);
                                                      $registro = mysql_fetch_array($result);

                                                      $nombre   = $registro['nombre'];
                                                      $precio   = $registro['precio'];

                                                      $coste    = $precio * $cantidad;
                                                      $subtotal = $_SESSION['subtotal'];
                                                      $iva      = $_SESSION['iva'];
                                                      $total    = $_SESSION['total'];

                                                    ?>

                                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                                        <div class="row">

                                                            <div class="col-xs-6 col-sm-6 col-md-7">
                                                                <?php echo $nombre ?>
                                                            </div>
                                                            <div class="col-xs-2 col-sm-2 col-md-2">
                                                                <?php echo $cantidad ?>
                                                            </div>
                                                            <div class="col-xs-4 col-sm-4 col-md-3">
                                                                MXN$ <?php echo number_format($precio, 2, '.', ',') ?>
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
                                                            <p>MXN$ <?php echo number_format($subtotal, 2, '.', ',') ?></p>
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
                                                            <p>MXN$ <?php echo number_format($iva, 2, '.', ',') ?></p>
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
                                                            <p class="negrita">MXN$ <?php echo number_format($total, 2, '.', ',') ?></p>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="clearfix"></div>

                                                <?php } ?>

                                            </div>
                                        </div>

                                    </div>
                                  <?php  if(empty($_SESSION['correo'])) {?>
                                    <button type="submit" class="btn largo" disabled="disabled">Confirmar pedido</button>
                                  <?php }else { ?>
                                    <button type="submit" class="btn largo">Confirmar pedido</button>
                                  <?php } ?>
                                </form>

                            </div>
                        </div>
                    </article>

                    </div>
                </div>

                <div class="col-md-5 col-lg-5 no-padding-lf">

                    <div class="sidebar">
                        <div class="col-md-12">
                            <img src="img/img-750x400.jpg" alt="" class="thumb" />
                        </div>
                        <div class="col-md-12">
                            <h3>Ayuda en tu compra:</h3>
                            <p>Muy lejos, más allá de las montañas de palabras, alejados de los países de las vocales y las consonantes, viven los textos simulados. Viven aislados en casas de letras, en la costa de la semántica, un gran océano de lenguas. Un riachuelo llamado Pons fluye por su pueblo y los abastece con las normas necesarias. Hablamos de un país paraisomático en el que a uno le caen pedazos de frases asadas en la boca. Ni siquiera los todopoderosos signos de puntuación dominan a los textos simulados; una vida, se puede decir, poco ortográfica. Pero un buen día, una pequeña línea.</p>
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
