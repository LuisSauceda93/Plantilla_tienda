<?php

include('inc/funciones.php');

get_encabezado();
?>


    <!-- Login -->
    <?php get_login(); ?>
    <!-- / Login -->

	<!-- Barra de navegación -->
    <?php get_menu(); ?>
    <!-- / Barra de navegación -->

    <!-- Contenido -->
    <section id="registro">
        <div class="container">
            <div class="row ajuste">

                <!-- Titular -->
                <div class="col-md-6 col-md-offset-3 text-center titular">
                    <h2>Registro  de usuarios</h2>
                    <p>Para crear tu cuenta sólo tienes que llenar los campos con tus datos y listo.</p>
                </div>

                <!-- Formulario de registro-->
                <div class="col-lg-12 col-md-12 blog">
                    <hr>
                    <div class="row">

                        <div class="col-sm-12 col-md-12 col-lg-8 col-lg-offset-2">
                            <form method="post" name="formulario" action="<?php echo get_url(); ?>/admin/assets/uploads/regUser.php" enctype="multipart/form-data" >
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
                                    <input type="number" name="telefono" class="form-control" id="telefono"  placeholder="Numero telefonico" onKeyUp="return limitar(event,this.value,10)" onKeyDown="return limitar(event,this.value,10)" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Elije una contraseña:</label>
                                    <input type="password" name="password" class="form-control" id="password1" placeholder="Ingresa una contraseña" required>
                                    <input type="password" name="password2" class="form-control" id="password2"  placeholder="Confirma la contraseña" required>
                                </div>

                                <div class="form-group">
                                    <label for="file">Elije una foto <small>(Perfil)</small></label>
                                    <input type="file" name="foto">
                                </div>

                                <div class="form-group">
                                    <button type="submit" name="submit" class="btn">Crear registro</button>
                                </div>
                            </form>
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
