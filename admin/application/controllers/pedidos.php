<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Heredamos de la clase CI_Controller */
class pedidos extends CI_Controller {

  function __construct()
  {

    parent::__construct();

    /* Cargamos la base de datos */
    $this->load->database();

    /* Cargamos la libreria*/
    $this->load->library('grocery_crud');

    /* Añadimos el helper al controlador */
    $this->load->helper('url');
  }

  function index()
  {
    /*
     * Mandamos todo lo que llegue a la funcion
     * administracion().
     **/
    redirect('pedidos/administracion');
  }

  /*
   *
   **/
  function administracion()
  {
    
    if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'Administrador')
    {
      redirect(base_url().'index.php/login_crud');
    }

    try{

    /* Creamos el objeto */
    $crud = new grocery_CRUD();

    /* Seleccionamos el tema */
    $crud->set_theme('flexigrid');

    /* Seleccionmos el nombre de la tabla de nuestra base de datos*/
    $crud->set_table('pedidos');

    /* Le asignamos un nombre */
    $crud->set_subject('Pedidos');

    /* Asignamos el idioma español */
    $crud->set_language('spanish');

    /* Aqui le decimos a grocery que estos campos son obligatorios */
    $crud->required_fields(
      'idUsuario','idPedidos'
    );

    $crud->set_relation('idUsuario','Usuarios','nombre');
    $crud->field_type('estatus','enum',array('Recibido','En proceso','Enviado','Entregado','Cancelado'));
    $crud->field_type('estatus_pago','enum',array('Pendiente','Pagado'));
    $crud->field_type('forma_pago','enum',array('Bancaria','OXXO','PayPal'));
    $crud->field_type('forma_envio','enum',array('Mensajería Express','Correos de México','Entrega personal'));




    /* Aqui le indicamos que campos deseamos mostrar */
    $crud->columns(
      'idpedidos',
      'fecha',
      'estatus',
      'forma_pago',
      'nom_banco',
      'num_cuenta',
      'num_tarjeta',
      'num_clabe',
      'nom_titular',
      'estatus_pago',
      'forma_envio',
      'domicilio',
      'subtotal',
      'total',
      'idUsuario'
    );

    /* Generamos la tabla */
    $output = $crud->render();

    /* La cargamos en la vista situada en
    /applications/views/productos/administracion.php */
    $this->load->view('main/administracion', $output);

    }catch(Exception $e){
      /* Si algo sale mal cachamos el error y lo mostramos */
      show_error($e->getMessage().' --- '.$e->getTraceAsString());
    }
  }
}
