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
    private function cod_cifrar_cadena_llave($data = 0, $llave=0, $indice = '03446434C89C4'){
        if ($data == 0) {
            $data = $this->ci->arixkernel->select_one_content('sal indice, llave','private.traductores',array('traductor_id' => rand (1, 997)));
            return $this->cod_object_to_array($data);
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
    public function cod_cifrar_matriz($base, $reemplazo){//ambos son arrays;
        for ($i = 0; $i < count($reemplazo); $i++) {
            $base[$i] = $this->cod_cifrar_cadena($base[$i]);
        }
    }
    /*public function cod_cifrar_matrices($array){//Trabajar en su optimizacion
        //$array = $this->object_to_array($array);
        $data = is_array(array_pop($array));//averigua si es multidemencional
        if($data == true){
            $data = array_keys(array_pop($array));//obtiene las llaves de los arrays
            $data = preg_grep('/(_id)/', $data);//selecciona las llaves que terminan en _id
            $data = elements($data,$array);
            $data = array_values ($data);//formatea las llaves
            for ($i=0; $i < count($array) ; $i++) {                
                for ($j=0; $j < count($data); $j++) { 
                    $array[$i][$data[$j]] = $this->cod_cifrar_cadena($array[$i][$data[$j]]);
                }
            }
            return $array;
        }else{
            return false;
        }
    }*/
    public function cod_cifrar_ids_matrices($array){
        $array = $this->cod_object_to_array($array);
        $llaves = $this->cod_cifrar_cadena_llave();
        $keys = array_keys(reset($array));
        //$keys = preg_grep('/(_id)/', reset($array));
        if (count(preg_grep('/(_id)/', reset($array))) != 0) {
            return $keys;
        }else if (count()){

        }
        else{
            return $array;
        }
    }
}