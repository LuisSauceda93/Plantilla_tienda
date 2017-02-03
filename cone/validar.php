<?php

  include ('../inc/funciones.php');
  include ('connect_db.php');


  $url = get_url();
  get_encabezado();


    $correo   = $_POST['correo'];
    $password = md5($_POST['password']);

    mysql_query("SET character_set_results = 'utf8'");
    $res = mysql_query("SELECT * FROM usuarios WHERE correo = '$correo'");

  if ($row = mysql_fetch_array($res)) {
    if ($row['contrasena'] == $password) {
      @session_start();
      $_SESSION['usuario'] = $row['nombre'];
      $_SESSION['correo']  = $correo;
      $_SESSION['tipo']    = $row['tipo'];
      header("Location:". $_SERVER['HTTP_REFERER']);
    } else {
  ?>
        <script type="text/javascript">
        swal({
          title: "Ups, ha ocurrido un problema!",
          text: "Usuario o contraseña incorrectos!",
          type: "error",
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Aceptar",
          closeOnConfirm: false
        },
        function(){
          //window.location.href="<?php echo $url.'#openModal'; ?>";
          history.back()
        });
        </script>
        <?php
      }
    } else {
      ?>
      <script type="text/javascript">
      swal({
        title: "Ups, ha ocurrido un problema!",
        text: "Los datos no existen!",
        type: "error",
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Aceptar",
        closeOnConfirm: false
      },
      function(){
        //window.location.href="<?php echo $url.'#openModal'; ?>";
        history.back()
      });
      </script>

      <?php
    }

    mysql_free_result($res);

    mysql_close();


    ?>
