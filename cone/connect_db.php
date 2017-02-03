<?php
	$link =mysql_connect("localhost","root","123456");
	if($link){
		mysql_select_db("carrito",$link);
	}
?>
