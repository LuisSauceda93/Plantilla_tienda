<?php
  include ('../inc/funciones.php');
  include ('conexion.php');

  $id  = $_GET['id'];
  $sql = "DELETE FROM lista_de_deseos WHERE idlista = '$id'";
  $mysqli->query($sql);
  header("Location:". get_url()."lista");
 ?>
