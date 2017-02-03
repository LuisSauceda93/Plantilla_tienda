<?php

include ('../../../cone/conexion.php');
include ('../../../inc/funciones.php');
include ('../../../cone/connect_db.php');


$url = get_url();
get_encabezado();
//Usuario
$nombre=isset($_POST['nombre']) ? $_POST['nombre'] : NULL;
$apellidos=isset($_POST['apellidos']) ? $_POST['apellidos'] : NULL;
$telefono=isset($_POST['telefono']) ? $_POST['telefono'] : NULL;
$correo=isset($_POST['correo']) ? $_POST['correo'] : NULL;
$password=isset($_POST['password']) ? $_POST['password'] : NULL;
$password2=isset($_POST['password2']) ? $_POST['password2'] : NULL;
$domicilio=isset($_POST['domicilio']) ? $_POST['domicilio'] : NULL;
$descripcion=isset($_POST['descripcion']) ? $_POST['descripcion'] : NULL;
$fechaAlta=isset($_POST['fechaAlta']) ? $_POST['fechaAlta'] : NULL;
$tipo=isset($_POST['tipo']) ? $_POST['tipo'] : NULL;

//Factura
$nombreF=isset($_POST['nombreF']) ? $_POST['nombreF'] : NULL;
$domicilioF=isset($_POST['domicilioF']) ? $_POST['domicilioF'] : NULL;
$telefonoF=isset($_POST['telefonoF']) ? $_POST['telefonoF'] : NULL;
$correoF=isset($_POST['correoF']) ? $_POST['correoF'] : NULL;
$rfcF=isset($_POST['rfcF']) ? $_POST['rfcF'] : NULL;

$sql = mysql_query("SELECT * FROM usuarios WHERE correo = '".$correo."'");
$contar = mysql_num_rows($sql);


if($contar == 0){

        if ($password==$password2) {

//Insercion tabla Usuarios
                $consulta = "INSERT INTO usuarios(nombre,apellido,telefono,correo,contrasena,domicilio,descripcion,foto,fecha_alta,tipo)
                VALUES ('$nombre',
                        '$apellidos',
                        '$telefono',
                        '$correo',
                        MD5('$password'),
                        '$domicilio',
                        '$descripcion',
                        '',
                        '$fechaAlta',
                        '$tipo')";


              $mysqli->query($consulta);
              $idUsuario = $mysqli->insert_id;

//Insercion tabla Factura
              $consulta2 = "INSERT INTO factura (nombre,domicilio,telefono,correo,rfc,idUsuario)
                            VALUES ('$nombreF',
                                    '$domicilioF',
                                    '$telefonoF',
                                    '$correoF',
                                    '$rfcF',
                                    '$idUsuario')";

              $mysqli->query("SET character_set_results = 'utf8'");
              $mysqli->query($consulta2);

      ?>

      <script type="text/javascript">
      swal({
        title: "Buen trabajo!",
        text: "Usuario registrado correctamente!",
        imageUrl: "dist/thumbs-up.jpg",
        confirmButtonText: "Aceptar",
        closeOnConfirm: false
    },
    function(){
    window.location.href="<?php echo $url.'compra'; ?>";
    });
      </script>
<?php

        }else {
?>

    <script type="text/javascript">
      swal({
      title: "Ups, ha ocurrido un problema!",
      text: "Las contraseñas no coinciden!",
      type: "error",
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Aceptar",
      closeOnConfirm: false
      },
      function(){
      window.location.href="<?php echo $url.'compra'; ?>";
      });
    </script>
<?php
      }}else { ?>
 						<script type="text/javascript">
 						swal({
 							title: "Ups, ha ocurrido un problema!",
 							text: "El correo que ingresaste ya existe!",
 							type: "error",
 							confirmButtonColor: "#DD6B55",
 							confirmButtonText: "Aceptar",
 							closeOnConfirm: false
 							},
 							function(){
 							window.location.href="<?php echo $url.'compra'; ?>";
 							});
 						</script>
 				<?php } ?>
