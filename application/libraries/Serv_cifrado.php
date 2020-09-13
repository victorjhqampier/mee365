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
    private function cod_cifrar_buscar_cadenas($array){//array
        return;
    }
}