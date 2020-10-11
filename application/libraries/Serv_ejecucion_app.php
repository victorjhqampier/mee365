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
        //$this->ci->load->library('arixkernel');
        $this->ci->load->library('serv_cifrado');
        $this->ci->load->library('serv_administracion_usuarios');
	}
    private function exe_plural_to_singular($plural){
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
    private function exe_verificar_tabla_tupla($tabla, $tupla, $rpt = false){

    }
    
/*FUNCIOMES RESERVADAS PARA EL SISTEMA*/
    public function exe_cargar_js($jss = null){
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
    public function exe_cargar_css(){

    }
    public function exe_subir_archivos(){

    }
    public function exe_obtener_botones($usuario_permiso, $botones){
        $permisos_botones = ['1000','0100','0010','0001'];//LECTURA, ESCRITURA, ACTUALIZACION, BORRADO, un boton pertenese a un grupo
        $botones = preg_replace('([^A-Za-z0-9\,._-])', '', $botones);
        $botones = explode(",", $botones);
        $btns_autorizados = array();
        for ($i=0; $i < 4; $i++) { //recorremos la cantidad del binario PERMISOS,
            if (substr($usuario_permiso, $i,1) == 1) {//si tiene permiso entramos para buscar los botones
                for ($j=0; $j < count($botones); $j++) { //buscamos los botones solicitados
                    $temp = $this->object_to_array($this->ci->arixkernel->select_one_content('boton, icono, titulo','config.botones', array('boton' => $botones[$j], 'permiso'=>bindec($permisos_botones[$i]))));
                    if (!is_null($temp)) {
                        array_push($btns_autorizados, $temp);
                    }
                }
            }   
        }
        return $btns_autorizados;
    }
    public function exe_obtener_lista_ordenado($tuplas, $tabla, $orderby,$cant = 10, $cond = null){
        if($cond == null){
            return $this->ci->arixkernel->select_all_content_order($tuplas, $tabla, $orderby, $cant);
        }else{
            return $this->ci->arixkernel->select_all_content_where_order($tuplas,$tabla, $cond, $orderby, $cant);
        }
    }
/*FUNCIONES GENERALES ACCEDIDOS DESDE OTRAS APLICACIONES*/
    //TODAS ESTAS FUNCIONES SE USA PARA TRES ESTADOS 1-ACTUAL, 2-UNICO, 3-TODOS
    //todos los _id deben ir cifrados, solo algunas tuplas pueden ser leidas
    public function exe_obtener_dato_sucursales($id=true, $tuplas="*"){
        switch (gettype($id)) {
            case 'boolean':
                $id = $this->ci->serv_administracion_usuarios->use_obtener_dato_session('sucursal');
                return $this->ci->arixkernel->select_one_content($tuplas,'config.v_sucursal_administradores', array('sucursal_id'=>$id));
                break;
            case 'string':
                $id = $this->ci->serv_cifrado->cod_decifrar_cadena($id);
                return $this->ci->arixkernel->select_one_content($tuplas,'config.v_sucursal_administradores', array('sucursal_id'=>$id));
                break;
            case 'integer':
                return $this->ci->arixkernel->select_all_content_order($tuplas,'config.v_sucursal_administradores', 'fregistro, DESC', $id);
                break;
            default:
                return array('result'=>'error!');
        }
    }
    public function exe_obtener_datos_usuario($id = true, $tuplas = '*'){
        switch (gettype($id)) {
            case 'boolean':
                $id = $this->ci->serv_administracion_usuarios->use_obtener_dato_session('sucursal');
                return $this->ci->arixkernel->select_one_content($tuplas,'config.v_sucursal_administradores', array('sucursal_id'=>$id));
                break;
            case 'string':
                $id = $this->ci->serv_cifrado->cod_decifrar_cadena($id);
                return $this->ci->arixkernel->select_one_content($tuplas,'config.v_sucursal_administradores', array('sucursal_id'=>$id));
                break;
            case 'integer':
                return $this->ci->arixkernel->select_all_content_order($tuplas,'config.v_sucursal_administradores', 'fregistro, DESC', $id);
                break;
            default:
                return array('result'=>'error!');
        }
    }
    public function exe_obtener_dato_empleados(){
        return;
    }
    public function exe_obtener_dato_empcategorias(){
        return;
    }
    public function exe_obtener_dato_profesiones(){
        return;
    }
    public function exe_obtener_dato_apps(){
        return;
    }
    public function exe_obtener_dato_departamentos(){
        return;
    }
    public function exe_obtener_dato_provincias(){
        return;
    }
    public function exe_obtener_dato_distritos(){
        return;
    }
    public function exe_obtener_dato_unico($id, $tuplas, $tabla){
        $id = $this->ci->serv_cifrado->cod_decifrar_cadena($id);
        return $this->ci->arixkernel->select_one_content($tuplas, $tabla, array($this->exe_plural_to_singular($tabla)."_id"=>$id));
    }
    public function exe_pruebas($pal=0){
        //return $this->exe_plural_to_singular($pal);
        return $this->ci->session->userdata();
    }
}
