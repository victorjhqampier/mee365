<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Arixstore extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->library('serv_ejecucion_app');
		$controlador=explode("/",$_SERVER['PHP_SELF']);$this->load->library('serv_administracion_usuarios');if(!$this->serv_administracion_usuarios->use_cargar_app_session($controlador[3])){show_404();}// cargas por defecto y manejar la secion
	}
	public function index(){
		$js = $this->serv_ejecucion_app->exe_cargar_js('arixstore-arixjs');
		$this->load->view('arixshellbase',compact('js'));
	}
}