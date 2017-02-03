<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Heredamos de la clase CI_Controller */
class Usuarios extends CI_Controller {

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

   redirect('usuarios/administracion');
  /*
   *
   **/
}


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
    $crud->set_table('usuarios');

    /* Le asignamos un nombre */
    $crud->set_subject('Usuarios');

    /* Asignamos el idioma español */
    $crud->set_language('spanish');

    /* Aqui le decimos a grocery que estos campos son obligatorios */
    $crud->required_fields(
      'idUsuario'
    );

    $crud->set_field_upload('foto','assets/uploads/files');

    $crud->field_type('contrasena', 'password');

    $crud->field_type('tipo','enum',array('Cliente','Administrador'));







    /* Aqui le indicamos que campos deseamos mostrar */
    $crud->columns(
      'idUsuario',
      'nombre',
      'apellido',
      'telefono',
      'contrasena',
      'correo',
      'domicilio',
      'descripcion',
      'foto',
      'fecha_alta',
      'tipo'
    );

    $crud->callback_before_insert(function($post){
            $post['contrasena'] = md5($post['contrasena']);
            return $post;
        });
    $crud->callback_before_update(function($post){
            $post['contrasena'] = md5($post['contrasena']);
            return $post;
        });

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
