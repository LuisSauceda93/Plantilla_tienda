<?php

include ('../../../cone/conexion.php');
include ('../../../inc/funciones.php');

$url = get_url();
get_encabezado();

//Factura
$idPedidos = isset($_POST['id']) ? $_POST['id'] : NULL;
$pagar = isset($_POST['pagar']) ? $_POST['pagar'] : NULL;
$cancelar = isset($_POST['cancelar']) ? $_POST['cancelar'] : NULL;

$sqlw="SELECT lpad(pedidos.idpedidos,4,'0') as id,total,pedidos.idpedidos as idP,pedidos.idUsuario as idUsuarioP,cantidad,productos.nombre as nombreP,precio,estatus,estatus_pago,num_cuenta,num_clabe,nom_titular,forma_pago,nom_banco,num_tarjeta,forma_envio,usuarios.domicilio as domicilioU,pedidos.domicilio as domicilioP,productos.idProducto as idPro
				 FROM usuarios
				 JOIN pedidos
				 ON usuarios.idUsuario=pedidos.idUsuario
				 JOIN det_pedidos
				 ON pedidos.idpedidos=det_pedidos.idpedidos
				 JOIN productos
				 ON productos.idProducto=det_pedidos.idProducto
				 where pedidos.idpedidos='$idPedidos'";
$mysqli->query("SET character_set_results = 'utf8'");
$resultado=$mysqli->query($sqlw);
$row = $resultado->fetch_assoc();
$envio      = $row['forma_envio'];
$costoEnvio = 0;
$resultado=$mysqli->query($sqlw);

if ($envio == "Mensajería express") {
	$costoEnvio = 1;
} elseif ($envio == "Correos de México") {
	$costoEnvio = 2;
} else {
	$costoEnvio = 0;
}

$contador=0;

if (isset($_GET['paypal'])) {
	if($_GET['paypal'] == 'success') {
		pagPay();
		exit();

	}}

if ($pagar=="Pagar pedido") { ?>

	<form name='formTpv' method='post' action='https://www.sandbox.paypal.com/cgi-bin/webscr' style="border: 1px solid #CECECE;padding-left: 10px;">
		<input name="cmd" type="hidden" value="_cart">
		<input name="upload" type="hidden" value="1">
		<input name="business" type="hidden" value="alberto-meji-business@hotmail.com">
		<input name="shopping_url" type="hidden" value="<?php echo get_url() ?>compra">
		<input name="currency_code" type="hidden" value="MXN">
		<input name="return" type="hidden" value="<?php echo get_url() ?>admin/assets/uploads/cancelar?paypal=success&id=<?php echo $idPedidos ?>">
		<input type='hidden' name='cancel_return' value='<?php echo get_url() ?>pedido?id=<?php echo $idPedidos ?>'>
		<input name="notify_url" type="hidden" value="http://localhost/">
		<input name="rm" type="hidden" value="2">
	</from>
	<?php
		$subtotal = 0;
		$iva      = 0;
		$total    = 0;
		while($fila=$resultado->fetch_assoc()){
		$idProducto = $fila['idPro'];
		$nombre = $fila['nombreP'];
		$precio = $fila['precio'];
		$cantidad = $fila['cantidad'];

		$coste     = $precio   * $cantidad;
		$subtotal  = $subtotal + $coste;

		$iva_p     = $precio   * 0.16;
		$cargos_p  = $iva_p    + ($costoEnvio/($resultado->num_rows));

		$iva       = $subtotal * 0.16;
		$cargos    = $iva      + $costoEnvio;
		$total     = $subtotal + $cargos;
		$totalp    = $precio   + $cargos_p;

	 ?>
	<?php $contador++; ?>
	<input name="item_number_<?php echo $contador; ?>" type="hidden" value="<?php echo $idProducto; ?>">
	<input name="item_name_<?php echo $contador; ?>" type="hidden" value="<?php echo $nombre; ?>">
	<input name="amount_<?php echo $contador; ?>" type="hidden" value="<?php echo  number_format($totalp,2,'.',''); ?>">
	<input name="quantity_<?php echo $contador; ?>" type="hidden" value="<?php echo $cantidad; ?>">
<?php } ?>
	<script type='text/javascript'>
		document.formTpv.submit();
	</script>


<?php }else {

								$consulta = "UPDATE pedidos SET estatus='Cancelado' WHERE idPedidos = '$idPedidos'";
								$mysqli->query("SET character_set_results = 'utf8'");
								$mysqli->query($consulta);

?>

<script type="text/javascript">
swal({
	title: "Ups, lamentamos tu cancelación!",
	text: "El pedido ha sido cancelado!",
	type: 'warning',
	confirmButtonText: "Aceptar",
	closeOnConfirm: false
},
function(){
window.location.href="<?php echo $url.'pedidos'; ?>";
});
</script>
<?php 	}?>

<?php
 function pagPay() {
	 include ('../../../cone/conexion.php');
	 $idPedidos =$_GET['id'];
	 $query     = "UPDATE pedidos SET estatus_pago='Pagado' WHERE idPedidos = '$idPedidos'";
	 $mysqli->query($query);
	 header("Location:".get_url().'pedido?id='.$idPedidos);
	}
 ?>
