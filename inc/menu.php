            <header class="navbar-wrapper">
                <div class="container pad-menu">

                    <!-- Logo -->
                    <?php get_logo(); ?>
                    <!-- / Logo -->

                    <div class="barra-menu">
                        <input type="checkbox" id="menuBar">
                        <label class="fa fa-2x fa-bars movil-menu" for="menuBar"></label>
                        <nav class="menu">
                            <a href="<?php echo get_url(); ?>index">Inicio</a>
                            <a href="<?php echo get_url(); ?>catalogo">Catálogo</a>
                            <a href="<?php echo get_url(); ?>eventos">Eventos</a>
                            <a href="<?php echo get_url(); ?>blog">Blog</a>
                            <a href="<?php echo get_url(); ?>contacto">Contacto</a>
                            <a href="<?php echo get_url(); ?>faq">FAQ</a>
                            <span class="menu-separador">|</span>
                            <a href='<?php echo get_url()?>carrito' class='glyphicon glyphicon-shopping-cart'></a>
                            <a href="<?php echo get_url(); ?>tienda">Tienda</a>
                            <?php
                              if(!isset($_SESSION['correo']))
                              {
                                echo "<a id='acceso' href='#openModal'>Login</a>";
                              } else {
                                echo "<a href='".get_url()."cuenta'>Cuenta</a>";
                                echo "<a id='acceso' href='".get_url()."cone/logout.php'>Logout</a>";
                              }
                             ?>
                        </nav>
                    </div>
                    <form class="" action="" method="post">
                      <div class="cBuscar">
                        <span class="h fa fa-search" ></span>
                        <input class="buscar" type="text" name="buscador" placeholder="Buscar">

                      </div>
                    </form>


                </div>
            </header>
            <div></div>
