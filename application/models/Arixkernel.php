<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
	este el nucleo de arix mee
	1- select_all_content(string, string, int)
	2- select_one_content(string, string, array)
	3- select_all_content_where(string, string, array, int)
	4- select_all_content_where_group(string,string, array, array)
*/

class Arixkernel extends CI_Model{	
	function __construct(){
		parent::__construct();
		date_default_timezone_set("America/Lima");
		$this->load->database('pdoarixdatabase');
		//$this->ci->load->library('session');
	}
	/*private function probar_acceso_user($dato = 'select'){
		$dato = preg_replace('([^A-Za-z0-9])', '', $dato);
        $binario = array('select' => '1000', 'insert' => '0100', 'update' => '0010', 'delete' => '0001');
        $permiso = $this->ci->arixkernel->select_one_content('binario','config.v_cuenta_permiso', array('cuenta_id' => $this->ci->session->userdata('usuario')));
        $permiso = $permiso->binario;
        $result = false;
        //usaremos compuerta logica AND
        for ($i=0; $i < strlen($permiso); $i++) {
            $r = (substr($permiso, $i,1) and substr($binario[$dato], $i,1));
            if($r){
                $result = $r;
            }
            else{
                $r=false;
            }
        }
        return $result;
	}*/
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
	public function select_one_content($tupla, $tabla, $condicion){//selecciona 1 elemento de un tabla
		$this->db->select($tupla);
		return $this->db->get_where($tabla, $condicion)->row();
	}
}