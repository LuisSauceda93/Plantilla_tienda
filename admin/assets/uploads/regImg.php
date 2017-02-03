<?php

include ('../../../cone/conexion.php');
include ('../../../inc/funciones.php');

$url = get_url();
get_encabezado();

//Usuario
$id=isset($_POST['ID']) ? $_POST['ID'] : NULL;
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





	//ahora vamos a verificar si el tipo de archivo es un tipo de imagen permitido.
	//y que el tamaño del archivo no exceda los 10mb
	$permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
	$limite_kb = 10000;

	if (in_array($_FILES['foto']['type'], $permitidos) && $_FILES['foto']['size'] <= $limite_kb * 1024){

		$imagen = rand(0,10000).$_FILES['foto']['name'];
		$ruta = 'files/' .$imagen;

				$foto = $imagen;

        if ($password==$password2) {

        $resultado = @move_uploaded_file($_FILES["foto"]["tmp_name"], $ruta);



                $consulta = "UPDATE usuarios
                   SET   nombre='$nombre',
                         apellido='$apellidos',
                         telefono='$telefono',
                         contrasena='$password',
												 correo='$correo',
                         domicilio='$domicilio',
                         descripcion='$descripcion',
                         foto='$foto',
                         fecha_alta='$fechaAlta',
                         tipo='$tipo'
									WHERE  idUsuario='$id'";

							$mysqli->query("SET character_set_results = 'utf8'");
              $mysqli->query($consulta);

							?>
											<script type="text/javascript">
											swal({
												title: "Buen trabajo!",
												text: "Foto actualizada correctamente!",
												imageUrl: "dist/thumbs-up.jpg",
												confirmButtonText: "Aceptar",
												closeOnConfirm: false
										},
										function(){
										window.location.href="<?php echo $url.'cuenta'; ?>";
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
				window.location.href="<?php echo $url.'cuenta'; ?>";
				});
					</script>
			<?php
        }
	} else {
		?>
		<script type="text/javascript">
		swal({
			title: "Ups, ha ocurrido un problema!",
			text: "Archivo no permitido, es un tipo de archivo prohibido o excede el tamaño de 10 MB!",
			type: "error",
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Aceptar",
			closeOnConfirm: false
			},
			function(){
			window.location.href="<?php echo $url.'cuenta'; ?>";
			});
		</script>
		<?php
	}

 ?>
