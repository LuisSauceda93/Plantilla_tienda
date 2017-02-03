<?php
    include ('../inc/funciones.php');
    include ('conexion.php');
    $url = get_url();
    get_encabezado();

    @session_start();

    if (isset($_GET['paypal'])) {
      if($_GET['paypal'] == 'success') {
        pagPay();
        exit();
      }
    } else {

      if(empty($_SESSION['correo'])) {
        header("Location:". $_SERVER['HTTP_REFERER']);
        exit();
      }else {
        if (empty($_SESSION['cesta'])) {
          header("Location:". $_SERVER['HTTP_REFERER']);
          exit();
        }

        $envio      = isset($_GET['envio']) ? $_GET['envio'] : NULL;
        $pago       = isset($_GET['pago'])  ? $_GET['pago']  : NULL;
        $costoEnvio = 0;

        if ($envio == "Mensajería express") {
          $costoEnvio = 1;

        } elseif ($envio == "Correos de México") {
          $costoEnvio = 2;

        } else {
          $costoEnvio = 0;
        
        }

        $correo = $_SESSION['correo'];
        $result = $mysqli->query("SELECT idUsuario FROM usuarios WHERE correo='$correo'");
        $fila   = $result->fetch_assoc();

        $idUsuario = $fila['idUsuario'];
        $fecha     = date('Y').'-'.date('m').'-'.date('d');

        $query     = "INSERT INTO pedidos(fecha, idUsuario, estatus,estatus_pago,forma_pago,forma_envio) VALUES('$fecha', $idUsuario, 'Recibido','Pendiente','$pago','$envio')";
        $mysqli->query($query);
        $idPedidos = $mysqli->insert_id;
        $contador  = 0;

        if ($_GET['pago']=='PayPal') { ?>

          <form name='formTpv' method='post' action='https://www.sandbox.paypal.com/cgi-bin/webscr' style="border: 1px solid #CECECE;padding-left: 10px;">
            <input name="cmd" type="hidden" value="_cart">
            <input name="upload" type="hidden" value="1">
            <input name="business" type="hidden" value="alberto-meji-business@hotmail.com">
            <input name="shopping_url" type="hidden" value="<?php echo get_url(); ?>compra">
            <input name="currency_code" type="hidden" value="MXN">
            <input name="return" type="hidden" value="<?php echo get_url(); ?>cone/agregar_pedido?paypal=success&id=<?php echo $idPedidos ?>">
            <input type='hidden' name='cancel_return' value='<?php echo get_url(); ?>pedido?id=<?php echo $idPedidos ?>'>
            <input name="notify_url" type="hidden" value="">
            <input name="rm" type="hidden" value="2">
          </from> <?php
        }

        $subtotal = 0;
        $iva      = 0;
        $total    = 0;

        foreach ($_SESSION['cesta'] as $idProducto => $cantidad) {

          $sqlw      = "SELECT * FROM productos WHERE idProducto='$idProducto'";
          $mysqli->query("SET character_set_results = 'utf8'");
          $resultado = $mysqli->query($sqlw);
          $registro  = $resultado->fetch_array();
          $precio    = $registro['precio'];
          $nombre    = $registro['nombre'];

          $coste     = $precio   * $cantidad;
          $subtotal  = $subtotal + $coste;

          $iva_p     = $precio   * 0.16;
          $cargos_p  = $iva_p    + ($costoEnvio/count($_SESSION['cesta']));

          $iva       = $subtotal * 0.16;
          $cargos    = $iva      + $costoEnvio;
          $total     = $subtotal + $cargos;
          $totalp    = $precio   + $cargos_p;

          if ($_GET['pago']=='PayPal') {
            $contador++;
            ?>
            <input name="item_number_<?php echo $contador; ?>" type="hidden" value="<?php echo $idProducto; ?>">
            <input name="item_name_<?php echo $contador; ?>" type="hidden" value="<?php echo $nombre; ?>">
            <input name="amount_<?php echo $contador; ?>" type="hidden" value="<?php echo  number_format($totalp,2,'.',''); ?>">
            <input name="quantity_<?php echo $contador; ?>" type="hidden" value="<?php echo $cantidad; ?>">
            <?php
          }


          $sql = "INSERT INTO det_pedidos(cantidad, idPedidos, idProducto)
          VALUES($cantidad,$idPedidos,$idProducto)";
          $mysqli->query($sql);
        }
        $sql2 = "UPDATE pedidos SET subtotal='$subtotal', total='$total' WHERE idPedidos = '$idPedidos'";
        $mysqli->query($sql2);
        unset($_SESSION['cesta']);

        if ($_GET['pago']=='PayPal') { ?>
          <script type='text/javascript'>
            document.formTpv.submit();
          </script>  <?php
        }
    }
  }


 ?>

 <script type="text/javascript">
 swal({
   title: "Excelente compra!",
   text: "Tu pedido a sido procesado correctamente!",
   imageUrl: "dist/thumbs-up.jpg",
   confirmButtonText: "Aceptar",
   closeOnConfirm: false
},
function(){
window.location.href="<?php echo $url."pedido?id=$idPedidos"; ?>";
});
 </script>

 <?php
  function pagPay() {
    include ('conexion.php');
    $idPedidos = $_GET['id'];
    $query     = "UPDATE pedidos SET estatus_pago='Pagado' WHERE idPedidos = '$idPedidos'";
    $mysqli->query($query);
    header("Location:".get_url().'pedido?id='.$idPedidos);
   }
  ?>
