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
                $temp = $this->ci->serv_cifrado->cod_object_to_array($this->ci->arixkernel->arixkernel_obtener_id_dato('direction','config.recursos', array('recurso' => $jss[$i],'tipo' => 1)));                
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
                    $temp = $this->ci->serv_cifrado->cod_object_to_array($this->ci->arixkernel->arixkernel_obtener_id_dato('boton, icono, titulo','config.botones', array('boton' => $botones[$j], 'permiso'=>bindec($permisos_botones[$i]))));
                    if (!is_null($temp)) {
                        array_push($btns_autorizados, $temp);
                    }
                }
            }   
        }
        return $btns_autorizados;
    }
    public function exe_probar_acceso_tabla(){

    }


#REAHCER TODO DESDE AQUI

    public function exe_obtener_lista_ordenado($tuplas, $tabla, $orderby,$cant = 10, $cond = null){
        if($cond == null){
            return $this->ci->arixkernel->select_all_content_order($tuplas, $tabla, $orderby, $cant);
        }else{
            return $this->ci->arixkernel->select_all_content_where_order($tuplas,$tabla, $cond, $orderby, $cant);
        }
    }
    public function arixkernel_obtener_datos($tupla, $tabla, $limit = 100, $offset = 1, $array_condition ='', $string_orderby = '', $array_groupby = ''){
       return $this->ci->arixkernel->arixkernel_obtener_datos($tupla, $tabla, $limit, $offset, $array_condition, $string_orderby, $array_groupby);
    }

    #array('tabla_0'=>'tuplas','tabla_1'=>'tuplas','tabla_2'=>'tuplas');
        # verificar si se pueden acceder a las tablas
            #renombrar las tablas dinamicamente
            # verificar si se puede acceder a las tuplas de las tablas        
        # Si el tamaño de array es mayor que 2
            #from('table_0');
            #recorrer array
                #si existe table_i.id_table_i+1 = table_i+1.id_table_i+1
                    #entonces join('table_i.id_table_i+1 = table_i+1.id_table_i+1','inner');
                #si no, terminar recorrido


    public function rexe_obtener_dato_tablas_publicas($array_tabla_tupla =0, $offset = 0, $array_condition = '', $string_orderby = '', $array_groupby = ''){
        $this->ci->db->select('a.*');
        $this->ci->db->from('config.sucursales a');
        $this->ci->db->join('config.subcategorias b', 'a.subcategoria_id = b.subcategoria_id','inner');
        $this->ci->db->join('config.categorias c', 'b.categoria_id = c.categoria_id','inner');
        $this->ci->db->join('private.distritos d', 'a.distrito_id = d.distrito_id');
        $this->ci->db->join('private.provincias e', 'd.provincia_id = e.provincia_id');
        $this->ci->db->join('private.departamentos f', 'e.departamento_id = f.departamento_id');
        return $this->ci->db->get()->result();
    }
    private function exe_renombrar_cadena($array_tabla_tupla){// debe solucionarse con TABLAS HASH
        $table = array_keys ($array_tabla_tupla);
        $tupla = array_values ($array_tabla_tupla);
        for ($i=0; $i < count($table) ; $i++) {
            $temp = explode(".",$table[$i]);
            $temp = substr($temp[1], 0, 3);//hace el renamed
            $table[$i] = $table[$i].' '.$temp;
            $temp2 = explode(",",$tupla[$i]);
            for ($j=0; $j < count($temp2); $j++) { 
                $temp2[$j] = $temp.'.'.$temp2[$j];
            }
            $tupla[$i] = implode(", ", $temp2);
        }
        $array_tabla_tupla = array();
        array_push($array_tabla_tupla, $table, $tupla);
        return $array_tabla_tupla;
    }
    public function exe_obtener_dato_tablas_publicas($array_tabla_tupla =0, $offset = 0, $array_condition = '', $string_orderby = '', $array_groupby = ''){
        $table = $this->exe_renombrar_cadena($array_tabla_tupla);
        $this->ci->db->select(implode(",", $table[1]));
        $this->ci->db->from($table[0][0]);
        for ($i = 1; $i < count($table); $i++) { //ESTOY AQUI
            $this->ci->db->join($table[0][$i], 'a.subcategoria_id = b.subcategoria_id','inner');
        }
        //$this->ci->db->join('config.subcategorias b', 'a.subcategoria_id = b.subcategoria_id','inner');
        //return $this->ci->db->get()->result();
        return  $table[0][0];
    }


    function exe_obtener_dato($array_tupla =0, $array_tablas=0){

        return 0;
    }
   # exe_obtener_dato('*', array('config.sucursales', 'config.subcategorias', 'config.categorias', 1=>'private.distritos'));
/*FUNCIONES GENERALES ACCEDIDOS DESDE OTRAS APLICACIONES*/
    //TODAS ESTAS FUNCIONES SE USA PARA TRES ESTADOS 1-ACTUAL, 2-UNICO, 3-TODOS
    //todos los _id deben ir cifrados, solo algunas tuplas pueden ser leidas
    public function exe_obtener_dato_sucursales($id=true, $tuplas="*"){
        switch (gettype($id)) {
            case 'boolean':
                $id = $this->ci->serv_administracion_usuarios->use_obtener_dato_session('sucursal');
                return $this->ci->arixkernel->arixkernel_obtener_id_dato($tuplas,'config.v_sucursal_administradores', array('sucursal_id'=>$id));
                break;
            case 'string':
                $id = $this->ci->serv_cifrado->cod_decifrar_cadena($id);
                return $this->ci->arixkernel->arixkernel_obtener_id_dato($tuplas,'config.v_sucursal_administradores', array('sucursal_id'=>$id));
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
                return $this->ci->arixkernel->arixkernel_obtener_id_dato($tuplas,'config.v_sucursal_administradores', array('sucursal_id'=>$id));
                break;
            case 'string':
                $id = $this->ci->serv_cifrado->cod_decifrar_cadena($id);
                return $this->ci->arixkernel->arixkernel_obtener_id_dato($tuplas,'config.v_sucursal_administradores', array('sucursal_id'=>$id));
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
        return $this->ci->arixkernel->arixkernel_obtener_id_dato($tuplas, $tabla, array($this->exe_plural_to_singular($tabla)."_id"=>$id));
    }
    public function exe_pruebas($pal=0){
        //return $this->exe_plural_to_singular($pal);
        return $this->ci->session->userdata();
    }
}
