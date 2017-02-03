<?php

include('inc/funciones.php');
include('cone/conexion.php');

$url = get_url();
get_encabezado();

if(!isset($_SESSION['correo']))
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
    <section id="cuenta">
        <div class="container">
            <div class="row ajuste">

              <?php
                  include ('cone/connect_db.php');

                  $correo = $_SESSION['correo'];
                  $sqlw = "SELECT *
                           FROM usuarios
                           WHERE correo ='$correo'";
                  mysql_query("SET character_set_results = 'utf8'");
                  $result = mysql_query($sqlw);
                  $registro = mysql_fetch_array($result);
                ?>

                <!-- Titular -->
                <div class="col-md-12 titular">
                    <h2>Mi cuenta</h2>
                    <p>
                      Hola <strong><?php echo $_SESSION['usuario'] ?></strong> bienvenido a tu perfil.
                    </p>
                    <?php if ($_SESSION['tipo'] == 'Administrador') {?>
                      <form id="my_form" action="<?php echo $url ?>admin/index.php/usuarios/administracion" method="post">
                        <input type="hidden" name="tipo" value="Administrador">
                        <p>
                          ¿Deseas <a href="javascript:{}" onclick="document.getElementById('my_form').submit(); return false;">ir al CRUD </a> del sistema?
                        </p>
                      </form>
                      <?php } ?>
                </div>

                <!-- Datos de usuario -->
                <div class="col-md-12">
                    <div class="usaurio">

                      <?php
                          include ('cone/connect_db.php');

                          $id= $registro['idUsuario'];
                          $sqlw2 = "SELECT *
                                   FROM factura
                                   WHERE idUsuario ='$id'";
                          mysql_query("SET character_set_results = 'utf8'");
                          $result2   = mysql_query($sqlw2);
                          $registro2 = mysql_fetch_array($result2);
                          $idF = $registro2['idUsuario'];
                        ?>

                        <div class="col-sm-12 col-md-4 col-lg-3">
                            <div class="row">
                                <img src="<?php echo $url."/admin/assets/uploads/files/".$registro['foto']?>" alt="" class="thumb"></img>
                                <a href="<?php echo get_url(); ?>lista" class="btn cta1" role="button"></span>Lista de deseos</a>
                                 <a href="<?php echo $url."pedidos" ?>" class="btn cta2" role="button"></span>Pedidos</a>
                              <?php
                              if ($id==$idF) {
                              ?>
                                <a href="" style="display:none;" class="btn largo" id="mostrar-form" role="button"></span>Agregar datos de facturación</a>
                              <?php
                              }else {
                              ?>
                              <script type="text/javascript">
                              swal({   title: "Recuerda!",   text: "Debes agregar los datos de facturación para realizar tus pedidos!",   type: "warning",    showLoaderOnConfirm: true, });
                              </script>
                                <a href="" class="btn largo" id="mostrar-form" role="button"></span>Agregar datos de facturación</a>
                              <?php
                              }
                              ?>
                              <a href="" class="btn largo" id="mostrar-img" role="button"></span>Cambiar foto de perfil</a>

                            </div>
                        </div>

                        <!--Titulo del articulo-->
                        <div class="col-sm-12 col-md-8 col-lg-9">

                            <!--Descrion del producto-->
                                <div class="row">



                                    <article>
                                        <h3><?php echo $registro['nombre']." ".$registro['apellido'] ?></h3>
                                        <p><strong>Correo electrónico:</strong> <?php echo $registro['correo'] ?></p>
                                        <p><strong>Teléfono:</strong> <?php echo $registro['telefono'] ?></p>
                                        <p><strong>Domicilio (para entregas):</strong><br /><?php echo $registro['domicilio'] ?></p><br>
                                        <p><strong>Datos de facturación:</strong><br />
                                          <strong>RFC:</strong> <?php echo $registro2['rfc']; ?><br />
                                          <strong>Nombre:</strong> <?php echo $registro2['nombre'];?><br />
                                          <strong>Domicilio:</strong> <?php echo $registro2['domicilio'];?><br />
                                          <strong>Teléfono:</strong> <?php echo $registro2['telefono'];?><br />
                                          <strong>Correo:</strong> <?php echo $registro2['correo'];?></p>



                                          <!--Insertar Datos factura -->
                                          <form method="post" id="formulario" name="formulario" style="display:none;" action="<?php echo get_url(); ?>/admin/assets/uploads/regFac.php">
                                              <div class="form-group">
                                                  <label for="nombre"><strong>Datos de facturación:</strong></label>
                                                  <input type="text" name="rfcF" class="form-control" id="rfcF" required placeholder="RFC" >
                                                  <input type="text" name="nombreF" class="form-control" id="nombre" placeholder="Nombre" required>
                                                  <input type="text" name="domicilioF" class="form-control" id="domicilio" placeholder="Domicilio fiscal" required>
                                                  <input type="number" class="form-control" name="telefonoF" id="telefono" placeholder="Numero telefonico" onKeyUp="return limitar(event,this.value,10)" onKeyDown="return limitar(event,this.value,10)" required>
                                                  <input class="form-control" name="correoF" id="correo" placeholder="Correo de facturación" required>
                                                  <input type="hidden" name="userID" class="form-control" id="userID" value="<?php echo $registro['idUsuario']; ?>" required>
                                                  <div class="form-group">
                                                      <button type="submit" name="submit" class="btn">Guardar datos</button>
                                                  </div>
                                              </div>
                                            </form>

                                            <!--Actualizar foto User -->
                                            <form method="post" id="formulario2" name="formulario2" style="display:none;" action="<?php echo get_url(); ?>/admin/assets/uploads/regImg.php" enctype="multipart/form-data">
                                              <div class="form-group">

                                                  <input type="hidden" name="ID" class="form-control" id="ID" placeholder="ID" required value="<?php print $registro['idUsuario'];?>">
                                                  <input type="hidden" name="nombre" class="form-control" id="nombre" placeholder="Nombre" required value="<?php print $registro['nombre'];?>">
                                                  <input type="hidden" name="apellidos" class="form-control" id="apellidos" placeholder="Apellidos" required value="<?php print $registro['apellido'];?>">
                                                  <input class="form-control" type="hidden" name="descripcion" id="descripcion" rows="2" placeholder="Escribe tu descripcion" value="<?php print $registro['descripcion'];?>">
                                                  <input type="hidden" name="fechaAlta" class="form-control" id="fechaAlta" value="<?php print $registro['fecha_alta'];?>" required>
                                                  <input type="hidden" name="tipo" class="form-control" id="tipo" value="<?php print $registro['tipo'];?>" required>
                                              </div>
                                              <div class="form-group">

                                                  <input type="hidden" name="correo" class="form-control" id="correo" placeholder="Ingresa tu correo electrónico" required value="<?php print $registro['correo'];?>">
                                              </div>
                                              <div class="form-group">

                                                  <input type="hidden" name="domicilio" class="form-control" id="domicilio" placeholder="Calle y número, Colonia, CP, Ciudad, Pais" required value="<?php print $registro['domicilio'];?>">
                                                  <input type="hidden" name="telefono" class="form-control" id="telefono"  placeholder="Numero telefonico" onKeyUp="return limitar(event,this.value,10)" onKeyDown="return limitar(event,this.value,10)" required value="<?php print $registro['telefono'];?>">
                                              </div>
                                              <div class="form-group">

                                                  <input type="hidden" name="password" class="form-control" id="password1" placeholder="Ingresa una contraseña" required value="<?php print $registro['contrasena'];?>">
                                                  <input type="hidden" name="password2" class="form-control" id="password2"  placeholder="Confirma la contraseña" required value="<?php print $registro['contrasena'];?>">
                                              </div>

                                              <div class="form-group">
                                                  <label for="file">Elije una foto <small>(Perfil)</small></label>
                                                  <input type="file" name="foto">
                                              </div>

                                              <div class="form-group">
                                                  <button type="submit" name="submit" class="btn">Guardar</button>
                                              </div>
                                                </div>
                                              </form>



                                        <div class="clearfix"></div>
                                    </article>
                                </div>

                        </div>

                    </div>
                </div>

                <div class="col-md-12">
                    <div class="tabs">

                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#desc" data-toggle="tab">Descripción</a></li>
                        </ul>

                        <div id="tab-contenido" class="tab-content">
                            <div class="tab-pane fade active in" id="desc">
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
