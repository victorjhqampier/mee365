<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Configuraciones extends CI_Controller {
	function __construct(){
		parent::__construct();
		$controlador=explode("/",$_SERVER['PHP_SELF']);
		$this->load->library('serv_administracion_usuarios');
		$this->load->library('serv_ejecucion_app');
		if(!$this->serv_administracion_usuarios->cargar_app_session($controlador[3])){show_404();}//comprueba la sesion
	}
	public function index(){
		//se cargan en ese orden
		$js = $this->serv_ejecucion_app->cargar_js('jquery.dataTables, boostrap.dataTables, configuraciones-arixjs');
		$this->load->view('arixshellbase',compact('js'));
	}

	public function sucursales(){
		if ($this->input->is_ajax_request()) {
			$this->load->view('app_configuraciones/sucursales');
		}
		else{
			show_404();
		}
	}
	public function empleados(){
		if ($this->input->is_ajax_request()) {
			$this->load->view('app_configuraciones/empleados');
		}
		else{
			show_404();
		}
	}
	public function areas(){
		if ($this->input->is_ajax_request()) {
			$this->load->view('app_configuraciones/areas');
		}
		else{
			show_404();
		}
	}
	public function usuarios(){
		if ($this->input->is_ajax_request()) {
			$this->load->view('app_configuraciones/usuarios');
		}
		else{
			show_404();
		}
	}
	public function usuarios_nuevo(){
		if ($this->input->is_ajax_request()) {
			$this->load->view('app_configuraciones/usuarios_nuevo');
		}
		else{
			show_404();
		}
	}
}