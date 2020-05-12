<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->library('serv_ejecucion_app');
		$controlador=explode("/",$_SERVER['PHP_SELF']);$this->load->library('serv_administracion_usuarios');if(!$this->serv_administracion_usuarios->cargar_app_session($controlador[3])){show_404();}
	}
	public function index(){
		$js = $this->serv_ejecucion_app->cargar_js('inicio-arixjs');
		$this->load->view('arixshellbase',compact('js'));
	}
	public function notificaciones(){
		$this->load->view('app_inicio/notificaciones');
	}
}