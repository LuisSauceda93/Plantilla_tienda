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
    <section id="blog">
        <div class="container">
            <div class="row articulo">

                <!-- Titular -->
                <div class="col-md-12 titular">
                    <h2>Aviso de Privacidad</h2>
                </div>

                <!-- Aviso -->
                <div class="col-lg-9 col-md-9 blog">
                    <div class="row">

                    <article class="entrada">
                        <div class="col-md-12">
                            <h3>Tus datos están protegidos</h3>
                            <span>Última modificación: 1ro de enero de 2016</span>
                            <p>Muy lejos, más allá de las montañas de palabras, alejados de los países de las vocales y las consonantes, viven los textos simulados. Viven aislados en casas de letras, en la costa de la semántica, un gran océano de lenguas. Un riachuelo llamado Pons fluye por su pueblo y los abastece con las normas necesarias. Hablamos de un país paraisomático en el que a uno le caen pedazos de frases asadas en la boca. Ni siquiera los todopoderosos signos de puntuación dominan a los textos simulados; una vida, se puede decir, poco ortográfica. Pero un buen día, una pequeña línea de texto simulado, llamada Lorem Ipsum, decidió aventurarse y salir al vasto mundo de la gramática. El gran Oxmox le desanconsejó hacerlo, ya que esas tierras estaban llenas de comas malvadas, signos de interrogación salvajes y puntos y coma traicioneros, pero el texto simulado no se dejó atemorizar. Empacó sus siete versales, enfundó su inicial en el cinturón y se puso en camino. Cuando ya había escalado las primeras colinas de las montañas cursivas, se dio media vuelta para dirigir su mirada por última vez, hacia su ciudad natal Letralandia, el encabezamiento del pueblo Alfabeto y el subtítulo de su</p>
                        </div>

                        <div class="col-md-12">
                            <div class="linea"></div>
                        </div>

                        <div class="clearfix"></div>
                    </article>

                    <article class="entrada">
                        <div class="col-md-12">
                            <h3>Notifica una inconformidad</h3>
                            <p>Muy lejos, más allá de las montañas de palabras, alejados de los países de las vocales y las consonantes, viven los textos simulados. Viven aislados en casas de letras, en la costa de la semántica, un gran océano de lenguas.</p>
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
                                <textarea class="form-control" name="comentario" rows="2" placeholder="Escribe tu comentario o consulta"></textarea>
                                <div class="checkbox">
                                    <p>
                                        <label for="">
                                            <input type="checkbox" name="aviso" value="" required>&nbsp; He leído y acepto el <a target="_blank" href="aviso">aviso de privacidad</a>
                                        </label>
                                    </p>
                                </div>
                                <button type="submit" class="btn btn-default">Enviar</button>
                            </form>
                        </div>
                    </article>

                    </div>
                </div>

                <div class="col-md-3 col-lg-3 no-padding-lf">

                    <div class="sidebar">
                        <div class="col-md-12">
                            <img src="img/img-750x400.jpg" alt="" class="thumb" />
                        </div>
                        <div class="col-md-12">
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
