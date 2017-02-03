<?php
 include ('../inc/funciones.php');

 session_start();
 unset($_SESSION['usuario']);
 unset($_SESSION['correo']);
 header("Location:". $_SERVER['HTTP_REFERER']);
?>
