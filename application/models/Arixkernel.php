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
	/*----------------------valido desde aqui---------------------*/
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

	/*REESCRITURA DE LAS FUNCIONES*/
	//select_all_content
	public function arixkernel_obtener_datos($tupla, $tabla, $limit = 100, $offset = 0, $array_condition = '', $string_orderby = '', $array_groupby = ''){
		$array_condition = (null == $array_condition) ? array() : $array_condition; 
		$this->db->select($tupla);
		$this->db->group_by($array_groupby);
		$this->db->order_by($string_orderby);
		return $this->db->get_where($tabla, $array_condition, $limit, $offset)->result();
	}
	public function arixkernel_obtener_id_dato($tupla, $tabla, $array_condicion){
		$this->db->select($tupla);
		return $this->db->get_where($tabla, $array_condicion)->row();	
	}
	public function arixkernel_obtener_datos_join($array_tabla_tupla=0, $offset = 0, $array_condition = '', $string_orderby = '', $array_groupby = ''){
        $this->ci->db->select(implode(",", $array_tabla_tupla[0]));
        $this->ci->db->from($array_tabla_tupla[1][0]);
        for ($i=1; $i < count($array_tabla_tupla[1]); $i++) { 
            $this->ci->db->join($array_tabla_tupla[1][$i], $array_tabla_tupla[2][$i],'inner');
        }
        $this->ci->db->where('estado', true);//EN CONSTRUCCION
        return $this->ci->db->get()->result();
    }
}