<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Configuraciones extends CI_Controller {
	function __construct(){
		parent::__construct();
		$controlador=explode("/",$_SERVER['PHP_SELF']);
		$this->load->library('serv_administracion_usuarios');
		$this->load->library('serv_ejecucion_app');
		$this->load->library('serv_cifrado');
		/*se debe denegar el acceso a ARIX CORE desde aquí*/
		//Controlador[3][2] depende de la carpeta en el que está
		if(!$this->serv_administracion_usuarios->use_cargar_app_session($controlador[3])){redirect(base_url());}
		//comprueba la sesion
		//ademas puede trabajar con muchas ventanas a la vez, actualiza por cada consulta
	}
	public function index(){
		//se cargan en ese orden
		$js = $this->serv_ejecucion_app->exe_cargar_js('configuraciones-arixjs, Chart');
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
	public function sucursales_detail(){
		if ($this->input->is_ajax_request()) {
			$this->load->view('app_configuraciones/sucursales_detalles');
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
	public function reportes(){
		if ($this->input->is_ajax_request()) {
			$this->load->view('gen_user_new');
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

	#REHACER TODO DESQUE AQUI CON EL NUEVO KERNEL Y SERVICIO DE EJECUCIÓN
	public function axconfiguraciones_cargar_lista_sucursales(){
		if ($this->input->is_ajax_request() && $this->input->post('type')){
			$tipo = $this->input->post('type'); // variable para cargar datos como iconos o lista datatables
			$lista = $this->serv_ejecucion_app->exe_obtener_lista_ordenado('imagen, sucursal_id uid, nombre, direccion, fregistro', 'config.sucursales', 'fregistro, ASC',20);
			for ($i=0; $i < count($lista); $i++) { 
				$lista[$i]->uid = $this->serv_cifrado->cod_cifrar_cadena($lista[$i]->uid);
			}
			echo json_encode($lista);
		}else{
			echo json_encode(array('status' => 403));
		}
	}
	public function axconfiguraciones_cargar_lista_usuarios(){
		if ($this->input->is_ajax_request() && $this->input->post('type')){
			$tipo = $this->input->post('type'); // variable para cargar datos como iconos o lista datatables
			$lista = $this->serv_ejecucion_app->exe_obtener_lista_ordenado('fotografia, cuenta_id uid, nombres, paterno, materno, documento, codigo, fmodificacion, estado, correo', 'config.v_persona_empleado_cuenta', 'fmodificacion, ASC',20);
			for ($i=0; $i < count($lista); $i++) { 
				$lista[$i]->uid = $this->serv_cifrado->cod_cifrar_cadena($lista[$i]->uid);
			}
			echo json_encode($lista);
		}else{
			echo json_encode(array('status' => 403));
		}
	}
	public function axconfiguraciones_cargar_datos_sucursal(){
		if ($this->input->is_ajax_request() && $this->input->post('data')){			
			$dato = $this->serv_ejecucion_app->exe_obtener_dato_unico($this->input->post('data'),'nombre', 'config.sucursales');
			return json_encode(array('neme'=>'error'));
		}else{
			echo json_encode(array('status' => 403));
		}
	}

	public function axconfiguraciones_pruebas(){		
		//$lista = $this->serv_ejecucion_app->exe_obtener_lista_ordenado('*', 'private.traductores', 'sal, ASC',20);
		$lista = $this->serv_ejecucion_app->arixkernel_obtener_datos('submenu_id, submenu', 'config.v_menu_subapp', 100, 0,'app_id = 1002 AND rol >= 4','',array('submenu_id','submenu'));
		$lista = $this->serv_cifrado->cod_cifrar_ids_matrices($lista);
		print_r($lista);		
	}
	public function sucursales_sub1(){
		if ($this->input->is_ajax_request()) {
			$this->load->view('app_configuraciones/sucursales_sub1');
		}
		else{
			show_404();
		}
	}
	public function sucursales_sub2(){
		if ($this->input->is_ajax_request()) {
			$this->load->view('app_configuraciones/sucursales_sub2');
		}
		else{
			show_404();
		}
	}
	public function sucursales_sub3(){
		if ($this->input->is_ajax_request()) {
			$this->load->view('app_configuraciones/sucursales_sub3');
		}
		else{
			show_404();
		}
	}
}