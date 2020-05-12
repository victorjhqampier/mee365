<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
    Servicio de adminitracion de usuarios
    1- abrir_sesion () / carga a la sesion los datos de cuenta id, y sucursal
    2- cerrar_sesion()
    3- 
    
*/

class Serv_administracion_usuarios {
	
    protected $ci;
    function __construct(){
		$this->ci =& get_instance();// $this no funciona en las librerias
		$this->ci->load->model('arixkernel');//agregamos el modelo
        $this->ci->load->library('session');
	}
    private function subapp_for_this_rol($rol,$app){//traduce de rol de usuario a rol de sub aplicacion
        if ($rol == 2) {//SuperUsuario
            return 'app_id = '.$app.' AND rol >= 4';
        }
        elseif ($rol == 3) {//Administrador
            return 'app_id = '.$app.' AND rol >= 6';
        }
        elseif ($rol == 4) {//Asistente
            return 'app_id = '.$app.' AND (rol = 5 OR rol = 7)';
        }
        else{
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
    public function abrir_session($correo, $pass){
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
    public function cerrar_session(){
        $this->ci->session->unset_userdata($this->ci->session->userdata()); //de compativiliad
        $this->ci->session->sess_destroy();
        return true;
    }    
    public function probar_session(){
        if ($this->ci->session->userdata('sesion')=='Ciy12Kjs2gyAvfrZMgqS2vm4uCuHHMN8tqKaKwumWEUvnWOeCQEx5Fxe2Ax'){
            return true;
        }else{
            return false;
        }
    }
    public function aplicaciones_usuario(){//la cuenta_id se recupera de la sesion
        return $this->ci->arixkernel->select_all_content_where('app, controller, rol','config.v_cuenta_app_rol',array('cuenta_id' => $this->ci->session->userdata('usuario'), 'rol_id !='=>1));// rol_id=1 => sin permiso
    }
    public function cargar_app_session($controlador){//requiere al usuario asi que tambien la sesion
        $controlador = $this->ci->arixkernel->select_one_content('app_id','config.v_cuenta_app_rol', array('controller' => $controlador,'cuenta_id' => $this->ci->session->userdata('usuario'),'rol_id !='=>1));// rol_id=1 => sin permiso
        if (!is_null ($controlador)) {            
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
    public function autocargar_sucursal_session(){
        $sucursal = $this->ci->arixkernel->select_all_content_where('sucursal_id','config.cuentasucursal', array('cuenta_id' => $this->ci->session->userdata('usuario')),1);
        if (!is_null($sucursal)) {
            $this->ci->session->set_userdata('sucursal', $sucursal[0]->sucursal_id);
            return true;
        }else{
            return false;
        }
        
    }
    public function cargar_sucursal_session($sucursal){
        $sucursal = $this->ci->arixkernel->select_one_content('sucursal_id','config.cuentasucursal', array('cuenta_id' => $this->ci->session->userdata('usuario'), 'sucursal_id' => $sucursal));
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
    public function lista_menu_aplicaciones(){
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
    public function cargar_detalles_usuario(){
        $cuenta = $this->ci->session->userdata('usuario');
        $usuario = $this->ci->arixkernel->select_one_content('documento, nombres, paterno, materno','config.v_persona_empleado_cuenta', array('cuenta_id' => $cuenta));
        return $usuario;
    }
    public function cargar_sucursal_actual(){//solo recupera de la sesion
        $sucursal_actual = $this->ci->session->userdata('sucursal');
        $usuario = $this->ci->arixkernel->select_one_content('sucursal_id sid, nombre','config.sucusales', array('sucursal_id' => $sucursal_actual));
        return $usuario;
    }
    public function cargar_sucursal(){
        $cuenta = $this->ci->session->userdata('usuario');
        $sucursales = $this->ci->arixkernel->select_all_content_where('sucursal_id sid, nombre','config.v_cuenta_sucursal', array('cuenta_id' => $cuenta));
        return $sucursales;
    }
    public function mostrar_usuario_permiso(){
        $cuenta = $this->ci->session->userdata('usuario');
        $permiso = $this->ci->arixkernel->select_one_content('permiso_id permiso, binario','config.v_cuenta_permiso', array('cuenta_id' => $cuenta));
        return $permiso;
    }
}