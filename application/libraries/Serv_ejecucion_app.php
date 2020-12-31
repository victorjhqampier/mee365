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
    private function exe_crear_join($array_table, $array_runlebel = array(1,0,0,0,0,0)){
        $renamed_table = array();
        $table_id = array();
        for ($i=0; $i < count($array_table); $i++) {
            $tempf = explode(" ",$array_table[$i]);
             array_push($renamed_table, $tempf[1]);
             array_push($table_id, $this->exe_plural_to_singular($tempf[0]).'_id');
        }
        $array_table=array('NULL');
        for ($i=1; $i < count($renamed_table); $i++) {
            if ($array_runlebel[$i]==0) {
                $array_table[$i] = $renamed_table[$i-1].'.'.$table_id[$i].' = '.$renamed_table[$i].'.'.$table_id[$i];
            }else{
                $array_table[$i] = $renamed_table[0].'.'.$table_id[$i].' = '.$renamed_table[$i].'.'.$table_id[$i];
            }
            
        }
        return $array_table;
    }

/*FUNCIOMES RESERVADAS PARA EL SISTEMA*/
    public function exe_cargar_js($jss = null){
       	if ($jss != null) {
            $jss = preg_replace('([^A-Za-z0-9\,._-])', '', $jss);//eliminacaracter raros
            $jss = explode(",", $jss);
            $new_list = array();
            $temp = '';
            for ($i=0; $i < count($jss); $i++) { 
                $temp = $this->ci->serv_cifrado->cod_object_to_array($this->ci->arixkernel->arixkernel_obtener_data_by_id('direction','config.recursos',false,array('recurso' => $jss[$i],'tipo' => 1)));                
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
        return 0;
    }
    public function exe_subir_archivos(){
        return 0;
    }
    # FUNCIONES DISPONIBLES PARA EL USUARIO
    public function exe_obtener_botones($usuario_permiso, $botones){
        $permisos_botones = ['1000','0100','0010','0001'];//LECTURA, ESCRITURA, ACTUALIZACION, BORRADO, un boton pertenese a un grupo
        $botones = preg_replace('([^A-Za-z0-9\,._-])', '', $botones);
        $botones = explode(",", $botones);
        $btns_autorizados = array();
        for ($i=0; $i < 4; $i++) { //recorremos la cantidad del binario PERMISOS,
            if (substr($usuario_permiso, $i,1) == 1) {//si tiene permiso entramos para buscar los botones
                for ($j=0; $j < count($botones); $j++) { //buscamos los botones solicitados
                    $temp = $this->ci->serv_cifrado->cod_object_to_array($this->ci->arixkernel->arixkernel_obtener_data_by_id('boton, icono, titulo','config.botones', false, array('boton' => $botones[$j], 'permiso'=>bindec($permisos_botones[$i]))));
                    if (!is_null($temp)) {
                        array_push($btns_autorizados, $temp);
                    }
                }
            }   
        }
        return $btns_autorizados;
    }
    public function exe_contruir_consulta($array_tabla_tupla, $array_runlebel = array(1,0,0,0,0,0)){// CORREGIR con TABLAS HASH
        $table = array_keys ($array_tabla_tupla); //captura el nombre de la tabla
        $tupla = array_values ($array_tabla_tupla); //Captura las tuplas de la tabla
        $renamed_table = array(); //guarda los nuevos nombresde las tablas
        $table_id = array(); // guarda los id de las tablas
        for ($i=0; $i < count($table) ; $i++) {
            $temp = explode(".", $table[$i]); //separa nombre de esquema [0] y nombre de tabla [1]
            $temp = substr($temp[1], 0, 3);// almacena el nuevo nombre de la tabla
            array_push($renamed_table, $temp); //agrega renombre de la tabla
            array_push($table_id, $this->exe_plural_to_singular($table[$i]).'_id');
            $table[$i] = $table[$i].' '.$temp;
            $tupla[$i] = str_replace(' ', '', $tupla[$i]);
            $temp2 = explode(",",$tupla[$i]);
            for ($j=0; $j < count($temp2); $j++) { 
                $temp2[$j] = $temp.'.'.$temp2[$j];
            }
            $tupla[$i] = implode(",", $temp2);
        }
        $array_table=array('NULL');
        for ($i=1; $i < count($renamed_table); $i++) {
            if ($array_runlebel[$i]==0) {
                $array_table[$i] = $renamed_table[$i-1].'.'.$table_id[$i].' = '.$renamed_table[$i].'.'.$table_id[$i];
            }else{
                $array_table[$i] = $renamed_table[0].'.'.$table_id[$i].' = '.$renamed_table[$i].'.'.$table_id[$i];
            }            
        }
        $array_tabla_tupla = array();
        array_push($array_tabla_tupla, $tupla, $table, $array_table);
        return $array_tabla_tupla;
        /*$array_tabla_tupla = $this->exe_contruir_consulta(array(
            'config.sucursales'=>'*',
            'config.subcategorias'=>'subcategoria',
            'config.categorias'=>'categoria, categoria_id',
            'private.distritos'=>'distrito_id, distrito',
            'private.provincias'=>'provincia_id, provincia',
            'private.departamentos'=>'departamento_id, departamento'
        ), array(1,0,0,1,0,0));
            0 = une la tabla a su continuacion (tabla)
            1 = une la tabla a la tabla base es decir a la primera tabla (sucursal)
        */
    }
    //funcion para recuperar datos complejos con uniones --- 
    //[$tree_arrray] = esta funcion es resuelta por [exe_contruir_consulta]
    // $array_condition = array(clave => valor)
    // $array_orderby = array(valor, valor)
    public function exe_obtener_complex_data($tree_arrray, $offset, $array_condition, $array_orderby){
        $temp = $this->ci->arixkernel->arixkernel_obtener_complex_data($tree_arrray, $offset, $array_condition, $array_orderby);
        return $this->ci->serv_cifrado->cod_cifrar_ids_matrices($temp);
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
    public function exe_obtener_dato_sucursales($id=true, $tuplas="*"){
        switch (gettype($id)) {
            case 'boolean':
                $id = $this->ci->serv_administracion_usuarios->use_obtener_dato_session('sucursal');
                return $this->ci->arixkernel->arixkernel_obtener_data_by_id($tuplas,'config.v_sucursal_administradores', array('sucursal_id'=>$id));
                break;
            case 'string':
                $id = $this->ci->serv_cifrado->cod_decifrar_cadena($id);
                return $this->ci->arixkernel->arixkernel_obtener_data_by_id($tuplas,'config.v_sucursal_administradores', array('sucursal_id'=>$id));
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
                return $this->ci->arixkernel->arixkernel_obtener_data_by_id($tuplas,'config.v_sucursal_administradores', array('sucursal_id'=>$id));
                break;
            case 'string':
                $id = $this->ci->serv_cifrado->cod_decifrar_cadena($id);
                return $this->ci->arixkernel->arixkernel_obtener_data_by_id($tuplas,'config.v_sucursal_administradores', array('sucursal_id'=>$id));
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
        return $this->ci->arixkernel->arixkernel_obtener_data_by_id($tuplas, $tabla, array($this->exe_plural_to_singular($tabla)."_id"=>$id));
    }
    public function exe_pruebas($pal=0){
        //return $this->exe_plural_to_singular($pal);
        return $this->ci->session->userdata();
    }

    /* ----------------------------------------funciones que prueban a ARIKKERNEL------*/
    public function arixkernel_obtener_datos_xxx(){
        $tabla_tupla = array ( 
            0 => array ( 0 => 'suc.*', 1 => 'sub.subcategoria', 2 => 'cat.categoria,cat.categoria_id', 3 => 'dis.distrito_id,dis.distrito', 4 => 'pro.provincia_id,pro.provincia', 5 => 'dep.departamento_id,dep.departamento', ), 
            1 => array ( 0 => 'config.sucursales suc', 1 => 'config.subcategorias sub', 2 => 'config.categorias cat', 3 => 'private.distritos dis', 4 => 'private.provincias pro', 5 => 'private.departamentos dep', ), 
            2 => array ( 0 => 'NULL', 1 => 'suc.subcategoria_id = sub.subcategoria_id', 2 => 'sub.categoria_id = cat.categoria_id', 3 => 'suc.distrito_id = dis.distrito_id', 4 => 'dis.provincia_id = pro.provincia_id', 5 => 'pro.departamento_id = dep.departamento_id', )
        );
       $tabla_tupla = $this->ci->arixkernel->arixkernel_obtener_complex_data($tabla_tupla, 0, array('sucursal_id >'=>0), array('sucursal_id','DESC'));
        return $tabla_tupla;
    }

    public function arixkernel_obtener_datos_xxx2(){
       $tabla_tupla = $this->ci->arixkernel->arixkernel_obtener_simple_data('submenu_id, submenu', 'config.v_menu_subapp', 0, 'app_id = 1003 AND rol >= 4', array('submenu_id','ASC'),array('submenu_id','submenu'));
        return $tabla_tupla;
    }

    public function arixkernel_obtener_datos_xxx3(){
       $tabla_tupla = $this->ci->arixkernel->arixkernel_obtener_data_by_id('*', 'private.personas', false, array('documento'=>'48207109'));
        return $tabla_tupla;
    }
}
