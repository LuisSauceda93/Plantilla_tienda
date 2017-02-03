<?php
include ('../../../inc/funciones.php');

//Utilizamos basename por seguridad, devuelve el
//nombre del archivo eliminando cualquier ruta.
$archivo = basename($_GET['archivo']);

$ruta = 'files/'.$archivo;


if (is_file($ruta)) {
  header('Content-type: application/pdf');
  header('Content-Disposition: attachmen; filename="'.$archivo.'"');
  readfile($ruta);
}

?>
