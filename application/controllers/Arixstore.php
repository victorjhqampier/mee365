<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Arixstore extends CI_Controller {
	function __construct(){
		parent::__construct();
		$controlador=explode("/",$_SERVER['PHP_SELF']);$this->load->library('serv_administracion_usuarios');if(!$this->serv_administracion_usuarios->cargar_app_session($controlador[3])){show_404();}// cargas por defecto y manejar la secion
	}
	public function index(){
		$this->load->view('arixshellbase');
	}
}