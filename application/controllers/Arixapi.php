<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Arixapi extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->library('serv_administracion_usuarios');
		$this->load->library('serv_cifrado');
	}
	public function arixapi_iniciar_sesion(){// ****** no requiere SESION pero si conexion POST y comporbar sesion ya abierta
		if (!$this->serv_administracion_usuarios->probar_session() && $this->input->is_ajax_request()) {
			$user = $this->input->post('user');
			$pass = $this->input->post('pass');
			$user = $this->serv_administracion_usuarios->abrir_session($user,$pass);//esto es booleano
			//$user = $this->serv_administracion_usuarios->abrir_session('victorjhampier@gmail.com','9e794323b453885f5181f1b624');
			if ($user == true) {
				$this->serv_administracion_usuarios->autocargar_sucursal_session();//esta linea tuvo muchos problemas. este es la mejor manera hasta ahora
				echo json_encode(array('status' => true));
			}
			else{
				echo json_encode(array('status' => false));
			}
			
		}else{
			echo json_encode(array('status' => 403));//acceso denegado
		}
		
	}// OJO OJO COMO SABEN quien cierra la sesion
	public function arixapi_cerrar_sesion(){// ******requiere SESION y conexion POST
		if ($this->serv_administracion_usuarios->probar_session() && $this->input->is_ajax_request()) {
			echo json_encode(array('status' => $this->serv_administracion_usuarios->cerrar_session()));
		}else{
			echo json_encode(array('status' => 403));//acceso denedo
		}
	}
	public function arixapi_mostrar_apps_usuario(){// ******requiere SESION y conexion POST
		if ($this->input->is_ajax_request() && $this->serv_administracion_usuarios->probar_session()) {
			$apps = $this->serv_administracion_usuarios->aplicaciones_usuario();
			print_r(json_encode($apps));
		}else{
			echo json_encode(array('status' => 403));//acceso denedo
		}
		
	}
	public function arixapi_mostrar_menu_aplicaciones(){
		if ($this->input->is_ajax_request() && $this->serv_administracion_usuarios->probar_session()) {
			$lista_menu = $this->serv_administracion_usuarios->lista_menu_aplicaciones();
			echo json_encode($lista_menu);
		}else{
			echo json_encode(array('status' => 403));//acceso denedo
		}
	}
	public function arixapi_mostrar_usuario_actual(){
		if ($this->input->is_ajax_request() && $this->serv_administracion_usuarios->probar_session()) {
			echo json_encode($this->serv_administracion_usuarios->cargar_detalles_usuario());
		}
		else{
			echo json_encode(array('status' => 403));//acceso denedo
		}
	}
	public function arixapi_mostrar_sucursal_actual(){
		if ($this->input->is_ajax_request() && $this->serv_administracion_usuarios->probar_session()) {
			$sucursal = $this->serv_administracion_usuarios->cargar_sucursal_actual();
			if (!is_null($sucursal)) {
				$sucursal->sid = $this->serv_cifrado->cifrar_dato($sucursal->sid);
				echo json_encode($sucursal);
			}
			else{
				echo json_encode(array('status' => 403));
			}
		}
		else{
			echo json_encode(array('status' => 403));//acceso denedo
		}
	}
	public function arixapi_mostrar_sucursales(){
		if ($this->input->is_ajax_request() && $this->serv_administracion_usuarios->probar_session()) {
			$sucursal = $this->serv_administracion_usuarios->cargar_sucursal();
			if (!is_null($sucursal)) {
				for ($i=0; $i < count($sucursal); $i++) { 
					$sucursal[$i]->sid = $this->serv_cifrado->cifrar_dato($sucursal[$i]->sid);
				}
				echo json_encode($sucursal);
			}
			else{
				echo json_encode(array('status' => 403));
			}
		}
		else{
			echo json_encode(array('status' => 403));//acceso denedo
		}
	}
	public function index(){
		echo json_encode($this->serv_administracion_usuarios->probar_permisos('update'));
	}
}
