<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
    Servicio de cifrado
    1- cifrar_palabra()
    2- decifrar_palabra()
    3- cifrar_passwd()
    4- probar_passwd()
*/

class Serv_cifrado {
	protected $ci;
    function __construct(){
		$this->ci =& get_instance();
        $this->ci->load->model('arixkernel');
	}    
    public function cod_object_to_array($d) {//de STDclass a arrayPHP
        if (is_object($d)) {
            $d = get_object_vars($d);
        }
        if (is_array($d)) {
            return array_map(array($this, 'cod_object_to_array'), $d);
        } else {
            return $d;
        }
    }
    private function cod_cifrar_cadena_llave($data = true, $llave=0, $indice = '03446434C89C4'){
        if (is_bool($data)) {
            $data = $this->ci->arixkernel->select_one_content('sal indice, llave','private.traductores',array('traductor_id' => rand (1, 997)));
            return $data;
        }else{
            $data = openssl_encrypt($data, "AES-256-CBC", $llave, 0, "0xE5e50a9b198741");
            return $indice.base64_encode($data);
        }
    }
    public function cod_cifrar_cadena($data){
        //$data = preg_replace('([^A-Za-z0-9])', '', $data);//borra caracteres raros (SOLO ALPHANUMERICOS)
        $key = $this->ci->arixkernel->select_one_content('sal, llave','private.traductores',array('traductor_id' => rand (1, 997)));
        $sal = $key->sal;
        $key = openssl_encrypt($data, "AES-256-CBC", $key->llave, 0, "0xE5e50a9b198741");
        return $sal.base64_encode($key);
    }
    public function cod_decifrar_cadena($data){
        $key = $this->ci->arixkernel->select_one_content('llave','private.traductores',array('sal' => substr($data,0, 13)));
        if (isset($key)){
            $key = openssl_decrypt(base64_decode(substr($data,13)), "AES-256-CBC", $key->llave, 0, "0xE5e50a9b198741");
            return $key;
        }else{
            return false;
        }        
    }    
    public function cod_cifrar_ids_matrices($array){ //REHACER CON TABLAS HASH -> debe ser optimizado
        $array = $this->cod_object_to_array($array);        
        if (is_array(reset($array))) {
            $key = array_keys(reset($array)); //guarda las llaves del array
            $key = array_values(preg_grep('/(_id)/', $key));//busca el patron y formatela las llaves del array
            if (count($key) > 0) {
                $llaves = $this->cod_cifrar_cadena_llave();
                for ($i = 0; $i < count($array); $i++) { 
                    for ($j = 0; $j < count($key); $j++) {
                        $array[$i][$key[$j]] = $this->cod_cifrar_cadena_llave($array[$i][$key[$j]], $llaves->llave, $llaves->indice);
                    }
                }
                unset($key, $llaves);
                return $array;
            }else{
                return $array;
            }
        }else{
            $key = array_keys($array);
            $key = array_values(preg_grep('/(_id)/', $key));        
            if (count($key) > 0) { 
                $llaves = $this->cod_cifrar_cadena_llave();
                for ($j = 0; $j < count($key); $j++) {
                    $array[$key[$j]] = $this->cod_cifrar_cadena_llave($array[$key[$j]], $llaves->llave, $llaves->indice);
                } 
                unset($key, $llaves);
                return $array;
            }else{
                return $array;
            }
        }
    }
}