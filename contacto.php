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
    <section id="contacto">
        <div class="container">
            <div class="row ajuste">

                <!-- Titular -->
                <div class="col-md-6 col-md-offset-3 text-center titular">
                    <h2>Contacto</h2>
                    <p>Queremos estar comunicados</p>
                </div>

                <!-- Contacto -->
                <div class="col-md-5">
                    <div class="row sidebar-left">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <h3 style="margin-top:0;">Contáctanos</h3>
                            <p>Muy lejos, más allá de las montañas de palabras, alejados de los países de las vocales y las consonantes, viven los textos simulados. Viven aislados en casas de letras, en la costa de la semántica, un gran océano de lenguas. Un riachuelo llamado Pons fluye por su pueblo y los abastece con las normas necesarias.</p>
                            <p>El gran Oxmox le desanconsejó hacerlo, ya que esas tierras estaban llenas de comas malvadas, signos de interrogación salvajes y puntos y coma traicioneros, pero el texto simulado no se dejó atemorizar. </p>
                            <h3>Visítanos</h3>
                            <p>Encuentranos en:<br />
                                Av. Zaragoza Pte. 332-A <br />
                                Plaza Negocentro, local 38, Col. Niños Héroes.<br />
                                Querétaro. CP 76010 <br>
                                <em>Recepción de visitas previa cita.</em></p>
                            <h3>Llámanos</h3>
                            <p>eléfono. +52 (442) 123 4567 & 765 4321 <br />
                                Whatsapp. +52 4421234567
                              </p>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12"><br>
                            <img src="img/img-750x400.jpg" class="thumb">
                        </div>
                    </div>
                </div>

                <!-- Contenedor del mapa y formulario -->
                <div class="col-md-7">
                    <!--Formulario-->
                    <div class="row contenedor_form">

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <h1>Buzón de Mensajes</h1>
                            <form>
                                <div class="form-group">
                                    <label for="nombre">Nombre:</label>
                                    <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Dinos como te llamas" required>
                                </div>
                                <div class="form-group">
                                    <label for="correo">Correo:</label>
                                    <input type="email" name="correo" class="form-control" id="correo" placeholder="Proporsiónanos tu correo" required>
                                </div>
                                <label for="comentario">Comentario:</label>
                                <textarea class="form-control" name="comentario" id="comentario" rows="2" placeholder="Escribe tu comentario o consulta"></textarea>
                                <div class="checkbox">
                                    <p>
                                        <label for="">
                                            <input type="checkbox" name="aviso" value="" required>&nbsp; He leído y acepto el <a target="_blank" href="<?php echo get_url(); ?>aviso">aviso de privacidad</a>
                                        </label>
                                    </p>
                                </div>
                                <button type="submit" class="btn">Enviar</button>
                            </form>
                        </div>


                        <div class="col-md-12">
                            <div class="linea" style="margin-bottom:30px;"></div>
                        </div>

                        <!--Mapa-->
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <h1 class="titulo_ubicacion">¿Donde encontrarnos?</h1>
                            <iframe src="https://maps.google.com.mx/maps?f=q&source=s_q&hl=es&geocode=&q=ikonlab&aq=&sll=20.614423,-100.405737&sspn=0.193447,0.308647&ie=UTF8&hq=ikonlab&hnear=&t=m&cid=13824616189904077378&ll=20.58653,-100.402948&spn=0.003515,0.00456&z=17&iwloc=&output=embed"  frameborder="0" style="border:0" allowfullscreen></iframe>
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
