<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Arixapi extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->library('serv_administracion_usuarios');
		$this->load->library('serv_cifrado');
		$this->load->library('serv_ejecucion_app');
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
				//$sucursal->sid = $this->serv_cifrado->cod_cifrar_cadena($sucursal->sid);
				echo json_encode($sucursal->nombre);
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
					$sucursal[$i]->serial = $this->serv_cifrado->cod_cifrar_cadena($sucursal[$i]->serial);
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
	public function arixapi_change_sucursal(){		
		$new = $this->input->post('data');
		echo json_encode($this->serv_administracion_usuarios->cambiar_sucursal($new));
	}
	public function arixapi_cargar_botones($botones = 'btn-detalles, btn-guardar, btn-actualizar, btn-borrar'){
		if ($this->serv_administracion_usuarios->probar_session() && $this->input->is_ajax_request() && $this->input->post('data')){
			$botones = $this->input->post('data');
			$usuario_permiso = $this->serv_administracion_usuarios->mostrar_usuario_permiso();
			$usuario_permiso = $usuario_permiso->binario;
			echo json_encode($this->serv_ejecucion_app->exe_obtener_botones($usuario_permiso,$botones));
		}
		else{
			echo json_encode(array('status' => 403));
		}
	}
	public function arixapi_cargar_lista_card(){
		if ($this->serv_administracion_usuarios->probar_session() && $this->input->is_ajax_request() && $this->input->post('data')){
			$table = $this->input->post('data');
			$cant = $this->input->post('cant');
			$lista = $this->serv_ejecucion_app->cargar_lista_targetas($table,$cant);
			for ($i=0; $i < count($lista); $i++) { 
				$lista[$i]->uid = $this->serv_cifrado->cod_cifrar_cadena($lista[$i]->uid);
			}
			echo json_encode($lista);
		}else{
			echo json_encode(array('status' => 403));
		}
	}
	public function index(){
		echo 'estoy aqui';
	}
}