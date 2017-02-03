<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <title>Crud sitio</title>
  <?php
  foreach($css_files as $file): ?>
  <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
  <?php endforeach; ?>
  <?php foreach($js_files as $file): ?>
  <script src="<?php echo $file; ?>"></script>
  <?php endforeach; ?>
  <link href="<?php echo base_url();?>/assets/css/styles.css" rel="stylesheet">
  <style type='text/css'>
    body
    {
      font-family: Arial;
      font-size: 14px;
    }
    a {
      color: blue;
      text-decoration: none;
      font-size: 14px;
    }
    a:hover
    {
      text-decoration: underline;
    }
    .nav{
      margin: 1em;
    }
  </style>
</head>
<body>

  <div id='cssmenu'>
<ul>
   <li class='active'><a href='<?php echo site_url('usuarios');?>'><span>Usuarios</span></a></li>
   <li><a href='<?php echo site_url('productos');?>'><span>Productos</span></a></li>
   <li><a href='<?php echo site_url('categorias');?>'><span>Categorias</span></a></li>
   <li class='last'><a href='<?php echo site_url('noticias');?>'><span>Noticias</span></a></li>
   <li class='last'><a href='<?php echo site_url('eventos');?>'><span>Eventos</span></a></li>
   <li class='last'><a href='<?php echo site_url('factura');?>'><span>Facturas</span></a></li>
   <li class='last'><a href='<?php echo site_url('pedidos');?>'><span>Pedidos</span></a></li>
   <li class='last'><a href='<?php echo site_url('det_pedidos');?>'><span>Detalles pedidos</span></a></li>
   <li class='last'><a href='<?php echo site_url('lista_de_deseos');?>'><span>Lista de deseos</span></a></li>
   <li class='last'><a href='<?php echo site_url('FAQ');?>'><span>FAQ</span></a></li>
   <li class='last'><a href='<?php echo 'http://localhost/'?>'><span>Volver al sitio</span></a></li>
   <li class='last log'><strong><a href='<?php echo site_url('login_crud/logout_ci');?>'><span>Cerrar sessión</span></a></strong></li>
</ul>
</div>

  <h2 style="text-align:center; color:grey">Carrito Online </h2>
  <div>
  <?php echo $output; ?>
  </div>

  <footer>

          <p><strong>&copy; IkonLAB 2016</strong></p>

  </footer>
</div>
</div>

</body>
</html>
