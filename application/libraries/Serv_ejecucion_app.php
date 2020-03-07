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
            $jss = preg_replace('([^A-Za-z0-9\,._-])', '', $jss);
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
}
