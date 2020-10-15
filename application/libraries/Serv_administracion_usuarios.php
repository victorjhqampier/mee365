<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Serv_administracion_usuarios {	
    protected $ci;
    function __construct(){
		$this->ci =& get_instance();// $this no funciona en las librerias
		$this->ci->load->model('arixkernel');//agregamos el modelo
        $this->ci->load->library('session');
        $this->ci->load->library('serv_cifrado');
	}
    private function subapp_for_this_rol($rol,$app){//traduce de rol de usuario a rol de sub aplicacion
        switch ($rol) {
            case 1:
                return 'app_id = '.$app.' AND rol >= 4';
                break;
            case 2:
                return 'app_id = '.$app.' AND rol >= 6';
                break;
            case 3:
                return 'app_id = '.$app.' AND (rol = 5 OR rol = 7)';
                break;
            default:
               return false;
        }
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
    public function use_crear_password_no_return($pass){
        return password_hash($pass,PASSWORD_DEFAULT,array("cost"=>12));
    }
    public function use_abrir_session($correo, $pass){
        $correo = $this->ci->arixkernel->select_one_content('cuenta_id cuenta, correo, pass','config.cuentas', array('correo' => $correo,'estado' => true));
        if(!empty($correo)){
            if (password_verify($pass,$correo->pass)){
                $correo = array(
                    'sesion' => "Ciy12Kjs2gyAvfrZMgqS2vm4uCuHHMN8tqKaKwumWEUvnWOeCQEx5Fxe2Ax",
                    'usuario' => $correo->cuenta,
                    'sucursal' => 0,//$pass[0]->sucursal_id,
                    'app'=> 0
                );
                $this->ci->session->set_userdata($correo);
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    public function use_cerrar_session(){
        $this->ci->session->unset_userdata($this->ci->session->userdata()); //de compativiliad
        $this->ci->session->sess_destroy();
        return true;
    }    
    public function use_probar_session(){
        if ($this->ci->session->userdata('sesion')=='Ciy12Kjs2gyAvfrZMgqS2vm4uCuHHMN8tqKaKwumWEUvnWOeCQEx5Fxe2Ax'){
            return true;
        }else{
            return false;
        }
    }
    public function use_aplicaciones_usuario(){//la cuenta_id se recupera de la sesion
        return $this->ci->arixkernel->select_all_content_where('app, controller','config.v_cuenta_app_rol',array('cuenta_id' => $this->ci->session->userdata('usuario'), 'rol_id !='=>4));// rol_id=4 => sin permiso
    }
    public function use_cargar_app_session($controlador){//requiere al usuario asi que tambien la sesion
        $controlador = $this->ci->arixkernel->select_one_content('app_id','config.v_cuenta_app_rol', array('controller' => $controlador,'cuenta_id' => $this->ci->session->userdata('usuario'),'rol_id !='=>4));// rol_id=4 => sin permiso
        if ($this->use_probar_session() && !is_null($controlador)) {
            if ($this->ci->session->userdata('app') == $controlador->app_id) {//si la app ya esta cargado NO hagas nada
                return true;
            }
            else{
                $this->ci->session->set_userdata('app', $controlador->app_id);
                return true;
            }            
        }
        else{
            return false;
        }
    }
    public function use_autocargar_sucursal_session(){
        $sucursal = $this->ci->arixkernel->select_all_content_where('sucursal_id','config.v_cuenta_sucursal', array('cuenta_id' => $this->ci->session->userdata('usuario'), 'estado'=> true),1);
        if (!is_null($sucursal)) {
            $this->ci->session->set_userdata('sucursal', $sucursal[0]->sucursal_id);
            return true;
        }else{
            return false;
        }    
    }
    public function cargar_sucursal_session($sucursal){
        $sucursal = $this->ci->arixkernel->select_one_content('sucursal_id','config.cuentasucursal', array('cuenta_id' => $this->ci->session->userdata('usuario'), 'sucursal_id' => $sucursal, 'estado'=> true));
        if (!is_null($sucursal)) {
            if ($this->ci->session->userdata('sucursal') != $sucursal->sucursal_id) {
                $this->ci->session->set_userdata('sucursal', $sucursal->sucursal_id);
                return true;
            }
            else{//si la sucursal ya esta cargado NO hagas nada
                return true;
            }            
        }else{
            return false;
        }
    }
    public function use_lista_menu_aplicaciones(){
        $cuenta = $this->ci->session->userdata('usuario');
        $app = $this->ci->session->userdata('app');
        $rol = $this->ci->arixkernel->select_one_content('rol_id, rol','config.v_cuenta_app_rol', array('cuenta_id' => $cuenta, 'app_id' => $app));
        if (!is_null($rol)) {
            $cuenta = $rol->rol_id; // SE REASIGNA EL VALOR DE cuenta a ROL int
            $rol = $this->ci->arixkernel->select_all_content_where_group('submenu_id, submenu','config.v_menu_subapp',$this->subapp_for_this_rol($cuenta,$app), array('submenu_id','submenu'));
            $rol = $this->object_to_array($rol);//hacemos la conversion para agregar arrays
            //$Rol hasta ahora es un array con los submenus, ahora agregamos sus elementos (Subapp)
            for ($i=0; $i < count($rol); $i++) { 
                array_push($rol[$i],$this->ci->arixkernel->select_all_content_where('subapp, controller','config.v_menu_subapp','submenu_id = '.$rol[$i]['submenu_id'].' AND '.$this->subapp_for_this_rol($cuenta,$app)));
                unset($rol[$i]['submenu_id']);//elinamos llaves primarias
            }
            return $rol;

        }else{
            return false;
        }
    }
    public function use_cargar_sessiondata_usuario(){
        $cuenta = $this->ci->session->userdata('usuario');
        $usuario = $this->ci->arixkernel->select_one_content('documento, nombres, paterno, materno','config.v_persona_empleado_cuenta', array('cuenta_id' => $cuenta));
        return $usuario;
    }
    public function use_obtener_sucursal_actual(){//solo recupera de la sesion
        $sucursal_actual = $this->ci->session->userdata('sucursal');//sucursal_id sid
        $usuario = $this->ci->arixkernel->select_one_content('numero, nombre','config.sucursales', array('sucursal_id' => $sucursal_actual));
        return $usuario;
    }
    public function use_obtener_otros_sucursales(){//listar sucursales adiciones a la actual
        $cuenta = $this->ci->session->userdata('usuario'); 
        $suc = $this->ci->session->userdata('sucursal');
        $sucursales = $this->ci->arixkernel->select_all_content_where('sucursal_id serial, numero, nombre','config.v_cuenta_sucursal', array('cuenta_id' => $cuenta, 'sucursal_id !=' => $suc, 'estado' => true));
        return $sucursales;
    }
    public function probar_usuario_sucursal($newsucursal){//true = tiene acceso
        $cuenta = $this->ci->session->userdata('usuario');
        $cuenta = $this->ci->arixkernel->select_one_content('sucursal_id','config.v_cuenta_sucursal', array('cuenta_id' => $cuenta, 'sucursal_id'=>$newsucursal));
        if (!is_null($cuenta)) {
            return true;
        }else{
            return false;
        }
    }
    public function cambiar_sucursal($newsucursal){
        $newsucursal = $this->ci->serv_cifrado->cod_decifrar_cadena($newsucursal);
        if (is_numeric($newsucursal)) {
            if ($this->probar_usuario_sucursal($newsucursal)){
                $this->ci->session->set_userdata('sucursal', $newsucursal);
                return true;
            }else{
                return false;
            }            
        }else{
            return false;
        }
    }    
    public function use_mostrar_usuario_permiso(){
        $cuenta = $this->ci->session->userdata('usuario');
        $permiso = $this->ci->arixkernel->select_one_content('permiso_id permiso, binario','config.v_cuenta_permiso', array('cuenta_id' => $cuenta));
        return $permiso;
    }
    public function use_obtener_dato_session($data){
        return $this->ci->session->userdata($data);
    }
}