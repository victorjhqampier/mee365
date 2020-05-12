<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('serv_administracion_usuarios');
		if ($this->serv_administracion_usuarios->probar_session()) {
			redirect(base_url('inicio'));
		}else{
			return;
		}
	}
	public function index()
	{
		$this->load->view('login');
	}
}
