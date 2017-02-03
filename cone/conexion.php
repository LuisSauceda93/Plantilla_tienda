<?php

  // se inicia la conexion con la base de datos
	$mysqli=new mysqli("localhost","root","123456","carrito");

	if(mysqli_connect_errno()){
		echo 'Conexion Fallida : ', mysqli_connect_error();
		exit();
	}

?>
