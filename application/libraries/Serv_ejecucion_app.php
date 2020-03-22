<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
    Servicio de ejecucion de apps
    1- cargar_css()
    2- cargar_js()
*/

class Serv_ejecucion_app {
	protected $ci;
    function __construct(){
		$this->ci =& get_instance();
        $this->ci->load->model('arixkernel');//agregamos el modelo
        $this->ci->load->library('arixkernel');
	}
    private function object_to_array($d) {//de STDclass a arrayPHP
        if (is_object($d)) {
            $d = get_object_vars($d);
        }
        if (is_array($d)) {
            return array_map(array($this, 'object_to_array'), $d);
        } else {
            return $d;
        }
    }
    public function cargar_js($jss = null){
       	if ($jss != null) {
            $jss = preg_replace('([^A-Za-z0-9\,._-])', '', $jss);//eliminacaracter raros
            $jss = explode(",", $jss);
            $new_list = array();
            $temp = '';
            for ($i=0; $i < count($jss); $i++) { 
                $temp = $this->object_to_array($this->ci->arixkernel->select_one_content('direction','config.recursos', array('recurso' => $jss[$i],'tipo' => 1)));                
                if (!is_null($temp)) {
                    array_push($new_list, $temp['direction']);
                }
            }
            return $new_list;
        }else{
            return false;
        }
    }
    public function cargar_css(){

    }
    public function subir_archivos(){

    }
    public function cargar_botones($usuario_permiso, $botones){
        $permisos_botones = ['1000','0100','0010','0001'];//LECTURA, ESCRITURA, ACTUALIZACION, BORRADO, un boton pertenese a un grupo
        $botones = preg_replace('([^A-Za-z0-9\,._-])', '', $botones);
        $botones = explode(",", $botones);
        $btns_autorizados = array();
        for ($i=0; $i < 4; $i++) { //recorremos la cantidad del binario PERMISOS,
            if (substr($usuario_permiso, $i,1) == 1) {//si tiene permiso entramos para buscar los botones
                for ($j=0; $j < count($botones); $j++) { //buscamos los botones solicitados
                    $temp = $this->object_to_array($this->ci->arixkernel->select_one_content('boton, icono','config.botones', array('boton' => $botones[$j], 'permiso'=>bindec($permisos_botones[$i]))));
                    if (!is_null($temp)) {
                        array_push($btns_autorizados, $temp);
                    }
                }
            }   
        }
        return $btns_autorizados;
    }
    public function cargar_lista_targetas($tabla, $cant){
        $tablas = array('usuarios' => 'config.v_persona_empleado_cuenta', 'empleados'=>'config.v_persona_empleado');
        $tuplas = array('usuarios' => 'cuenta_id uid, documento, codigo, nombres, paterno, materno, fotografia, estado, fregistro', 'usuarios', 'empleados'=>'empleado_id uid,');
        $condiciones = array('usuarios' => 'jefe_id IS NULL', 'empleados'=>'jefe_id IS NOT NULL');
        $tablas = $this->ci->arixkernel->select_all_content_where_order($tuplas[$tabla],$tablas[$tabla], $condiciones[$tabla], array('fmodificacion','DESC'), $cant);
        return $tablas;
    } 
}
