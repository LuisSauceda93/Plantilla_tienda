
            <div id="openModal" class="modalbg login">
                <form class="dialog form-horizontal" method="post" action="<?php echo get_url(); ?>cone/validar.php">
                    <h3 class="text-center">Iniciar sesión</h3>
                    <hr>
                    <a href="#close" title="Close" class="close"><i class="fa fa-times"></i></a>
                    <div class="form-group">
                        <label for="usuario" class="col-sm-3 control-label">E-Mail</label>
                        <div class="col-sm-9">
                            <input type="text" name="correo" class="form-control" id="usuario" placeholder="Correo electrónico" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-sm-3 control-label">Contraseña</label>
                        <div class="col-sm-9">
                            <input type="password" name="password" class="form-control" id="password" placeholder="Contraseña" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="mantener"> Mantener sesión
                                </label>
                                <br>
                                <label>
                                    <p>¿No tienes una cuenta? <a href="<?php echo get_url(); ?>registro">Regístrate</a></p>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-6">
                            <button type="submit" class="btn">Login</button>
                        </div>
                    </div>
                </form>
            </div>
