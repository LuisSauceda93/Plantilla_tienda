<?php

include ('../../../cone/conexion.php');
include ('../../../inc/funciones.php');
include ('../../../cone/connect_db.php');

$url = get_url();
get_encabezado();

//Factura

$nombreF=isset($_POST['nombreF']) ? $_POST['nombreF'] : NULL;
$domicilioF=isset($_POST['domicilioF']) ? $_POST['domicilioF'] : NULL;
$telefonoF=isset($_POST['telefonoF']) ? $_POST['telefonoF'] : NULL;
$correoF=isset($_POST['correoF']) ? $_POST['correoF'] : NULL;
$rfcF=isset($_POST['rfcF']) ? $_POST['rfcF'] : NULL;
$usuarioF=isset($_POST['userID']) ? $_POST['userID'] : NULL;

$sql = mysql_query("SELECT * FROM factura WHERE rfc = '".$rfcF."'");
$contar = mysql_num_rows($sql);

if($contar == 0){

								$consulta = "INSERT INTO factura (nombre,domicilio,telefono,correo,rfc,idUsuario)
															VALUES ('$nombreF',
																		  '$domicilioF',
																		  '$telefonoF',
																		  '$correoF',
																		  '$rfcF',
																		  '$usuarioF')";

								$mysqli->query("SET character_set_results = 'utf8'");
								$mysqli->query($consulta);

?>

<script type="text/javascript">
swal({
	title: "Buen trabajo!",
	text: "Datos de facturación agregados correctamente!",
	imageUrl: "dist/thumbs-up.jpg",
	confirmButtonText: "Aceptar",
	closeOnConfirm: false
},
function(){
window.location.href="<?php echo $url.'cuenta'; ?>";
});
</script>

<?php } else { ?>
		 <script type="text/javascript">
		 swal({
			 title: "Ups, ha ocurrido un problema!",
			 text: "El RFC que ingresaste ya existe!",
			 type: "error",
			 confirmButtonColor: "#DD6B55",
			 confirmButtonText: "Aceptar",
			 closeOnConfirm: false
			 },
			 function(){
			 window.location.href="<?php echo $url.'cuenta'; ?>";
			 });
		 </script>
 <?php } ?>
