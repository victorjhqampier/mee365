<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
	este el nucleo de arix mee
	1- select_all_content(string, string, int)
	2- select_one_content(string, string, array)
	3- select_all_content_where(string, string, array, int)
	4- select_all_content_where_group(string,string, array, array)
	5- select_all_content_where_order($tupla,$tabla, $condicion [array], $order [array], $cant_registros = 100)
*/

class Arixkernel extends CI_Model{	
	function __construct(){
		parent::__construct();
		date_default_timezone_set("America/Lima");
		$this->load->database('pdoarixdatabase');		
	}
	 private function arixkernel_table_to_id($plural){
        $plural = rtrim($plural, ' ');
        $plural = explode(".", $plural);
        $plural = $plural[count($plural)-1];
        $j = array('s','es','ces');
        $k = null;
        for ($i=0; $i < 3; $i++) {
            $ultimas = substr($plural,-1*($i+1));
            if($ultimas==$j[$i]){
                $k = $ultimas; 
            }else break;                       
        }
        $j = strlen($plural);
        $k = strlen($k);
        $plural = substr($plural, 0, $j-$k);
        return ($k==3)?$plural."z":$plural;
    }

	private function probar_permiso_user($dato = 'select'){// evalua si da permiso o no al usuario; resive como parametros CRUD
		$this->load->library('session');
		$this->db->select('binario');
		$permiso = $this->db->get_where('config.v_cuenta_permiso', array('cuenta_id' => $this->session->userdata('usuario')))->row();
		$dato = preg_replace('([^A-Za-z0-9])', '', $dato);
        $binario = array('select' => '1000', 'insert' => '0100', 'update' => '0010', 'delete' => '0001');        
        $permiso = $permiso->binario;
        $result = false;
        //usaremos compuerta logica AND
        for ($i=0; $i < 4; $i++) {
            $r = (substr($permiso, $i,1) and substr($binario[$dato], $i,1));
            if($r){
                $result = $r;
            }
            else{
                $r=false;//sin sentido
            }
        }
        return $result;
	}
	
	/*----------------------algoritmos obsoletos--- aun en uso-----------------*/
	public function select_all_content($tupla,$tabla, $cant_registros = 100){//selecciona N elementos de una tabla N>1
		$this->db->select($tupla);
		return $this->db->get($tabla,$cant_registros)->result();
	}
	public function select_all_content_where($tupla,$tabla, $condicion, $cant_registros = 100){ //selecciona N elementos de una tabla N>1 con una condicion
		$this->db->select($tupla);
		return $this->db->get_where($tabla, $condicion, $cant_registros)->result();
	}
	public function select_all_content_where_group($tupla,$tabla, $condicion, $group){
		$this->db->select($tupla);		
		$this->db->group_by($group);
		return $this->db->get_where($tabla,$condicion)->result();
	}
	public function select_all_content_order($tupla,$tabla, $orderby, $cant_registros = 100){
		$orderby = explode(",", $orderby);
		$this->db->select($tupla);		
		$this->db->order_by($orderby[0], $orderby[1]);
		return $this->db->get($tabla,$cant_registros)->result();
	}
	public function select_all_content_where_order($tupla,$tabla, $condicion, $orderby, $cant_registros = 100){
		$order = explode(",", $orderby);
		$this->db->select($tupla);		
		$this->db->order_by($orderby[0], $orderby[1]);
		return $this->db->get_where($tabla,$condicion,$cant_registros)->result();
	}
	public function select_one_content($tupla, $tabla, $condicion){//selecciona 1 elemento de un tabla
			$this->db->select($tupla);
			return $this->db->get_where($tabla, $condicion)->row();		
	}

/*----------------------algoritmos funcionales---------------------*/
	/*REESCRITURA DE LAS FUNCIONES*/

	//public function arixkernel_obtener_datos($tupla, $tabla, $limit = 100, $offset = 0, $array_condition = '', $array_orderby = '', $array_groupby = ''){

	//1: arixkernel_obtener_simple_data('submenu_id, submenu', 'config.v_menu_subapp', 0, 'app_id = 1003 AND rol >= 4', array('submenu_id','ASC'),array('submenu_id','submenu')
	public function arixkernel_obtener_simple_data($tupla, $tabla, $offset = 0, $array_condition = '', $array_orderby = '', $array_groupby = ''){//PENDIENTE REVISAR SI TIENE ACCESO A TABLA 
		$array_condition = (null == $array_condition) ? array() : $array_condition;
		$array_orderby = (null == $array_orderby) ? array('','') : $array_orderby;
		$this->db->select($tupla);
		$this->db->group_by($array_groupby);
		$this->db->order_by($array_orderby[0],$array_orderby[1]);
		return $this->db->get_where($tabla, $array_condition, 100, $offset)->result();
	}

	//public function arixkernel_obtener_id_dato($tupla, $tabla, $array_condicion){

	//1: arixkernel_obtener_data_by_id('*', 'private.personas', 2, array('documento'=>'70240254')
	//2: arixkernel_obtener_data_by_id('*', 'private.personas', false, array('documento'=>'70240254')
	public function arixkernel_obtener_data_by_id($tupla, $tabla, $compare_auto_id, $array_sec_condicion = ''){
		$array_sec_condicion = (null == $array_sec_condicion) ? array() : $array_sec_condicion;
		$this->db->select($tupla);
		if ($compare_auto_id==false) {			
			return $this->db->get_where($tabla, $array_sec_condicion)->row();
		}else{
			$table_id = $this->arixkernel_table_to_id($tabla).'_id';
			$this->db->where($table_id,$compare_auto_id);
			return $this->db->get_where($tabla, $array_sec_condicion)->row();
		}			
	}
	//1: arixkernel_obtener_complex_data(exe_contruir_consulta(array()), 0, array('sucursal_id >'=>0), array('sucursal_id','DESC'));
	public function arixkernel_obtener_complex_data($array_tabla_tupla, $offset = 0, $array_condition = '', $array_orderby = ''){
		$array_orderby = (null == $array_orderby) ? array('','') : $array_orderby;//PENDIENTE--- SOLO ACCESO A TABLAS PERMITIDAS
        $this->db->select(implode(",", $array_tabla_tupla[0]));
        $this->db->from($array_tabla_tupla[1][0]);
        for ($i=1; $i < count($array_tabla_tupla[1]); $i++) { 
            $this->db->join($array_tabla_tupla[1][$i], $array_tabla_tupla[2][$i],'inner');
        }
        $this->db->order_by($array_orderby[0], $array_orderby[1]);
        $this->db->limit(100, $offset);
        if($array_condition!=null){
        	$clave = array_keys ($array_condition);
        	$valor = array_values ($array_condition);
        	for ($i=0; $i < count($array_condition); $i++) {
            	$this->db->where($clave[$i], $valor[$i]);
        	}
        	return $this->db->get()->result();
        }
        else{
        	return $this->db->get()->result();
        }        
    }
}