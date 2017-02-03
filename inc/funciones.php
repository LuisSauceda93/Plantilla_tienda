<?php

//Lista de funciones.

function get_url()
{
	/**
	 *En caso de servidor local: (Reemplazar directorio)
	 */

	$url='http://localhost/ikonlab-fwk/';
	return $url;

	/**
	 *En caso de servidor remoto (agregar subdirectorio si es necesario):
	 */
	//$url='http://'.$_SERVER['SERVER_NAME'];
	//return $url;
}

// URL's y titulares

function url(){
	$enlace_url = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
    return $enlace_url;
}

function slug(){

   $slug = basename($_SERVER["SCRIPT_FILENAME"], '.php') ;
   return $slug;

}


function sitename(){

   $sitename=  'Primer / Framework para proyectos con catálogo' ;
   return $sitename;

}

function subname(){

   $subname = '' ;
   return $subname;

}

function copyright(){

   $enlace = '';
   return $enlace;

}

// Snippets

function get_encabezado() {

	include('encabezado.php');

}

function get_menu() {

	include('menu.php');

}

function get_logo() {

	include('logo.php');

}

function get_pie() {

	include('pie.php');

}

function get_scripts() {

	include('scripts.php');

}

function get_login() {

	include('login.php');

}

function get_slider() {

	include('slider.php');

}

function get_conexion() {

	include('conexion.php');

}

function limitarPalabras($cadena, $longitud) {
$palabras = explode(' ', $cadena);
if (count($palabras) > $longitud)
return implode(' ', array_slice($palabras, 0, $longitud));
else
return $cadena;

}

?>
