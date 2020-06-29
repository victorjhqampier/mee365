<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
<div class="col-xl-12 col-md-12">
    <div class="card-group">
        <div class="card">
            <div class="card-header text-center"><strong>USUARIO Y PERMISOS</strong></div>
            <div class="card-body">
               <form id="form-usuario-sucursal">
                    <div class="form-group">
                        <label for="input-user">Nombre del empleado</label>
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control" placeholder="Nombre del empleado" aria-label="Recipient's username" aria-describedby="basic-addon2" id="input-user" name="txtUser" readonly>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button"><i class="fa fa-times"></i></button>
                                <button class="btn btn-outline-secondary" type="button"><i class="fa fa-ellipsis-h"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="user-id">Nombre del usuario</label>
                        <input type="text" class="form-control form-control-sm" id="user-id" name="textId" placeholder="Correo del empleado" readonly>
                    </div>
                    <hr>
                    <div class="form-group input-group-sm">                        
                        <div class="form-check">
                          <label class="form-check-label"><input type="checkbox" id="input-read" name="txtRead" class="form-check-input" value="1" checked disabled>
                            Puede Ver
                          </label>
                        </div>
                         <div class="form-check">
                          <label class="form-check-label"><input type="checkbox" id="input-write" name="txtWrite" class="form-check-input" value="0">
                            Puede Crear
                          </label>
                        </div>
                        <div class="form-check">
                          <label class="form-check-label"><input type="checkbox" id="input-update" name="txtUpdate" class="form-check-input" value="0">
                            Puede Actualizar
                          </label>
                        </div>
                        <div class="form-check">
                          <label class="form-check-label"><input type="checkbox" id="input-delete" name="txtDelete" class="form-check-input" value="0">
                            Puede Eliminar
                          </label>
                        </div>                         
                    </div>
                </form> 
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary btn-sm" id="btn-probar-suc">Probar</button>                
            </div>
        </div>
        <div class="card">
            <div class="card-header text-center"><strong>SUCURSALES</strong></div>
            <div class="card-body">
                <form id="form-sucursales">
                    <div class="input-group input-group-sm mb-2">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                            <input type="checkbox" aria-label="Checkbox for following text input" checked>
                        </span>
                        <span class="input-group-text">BIBLIOTECA MUNICIPAL GAMALIEL CHURATA</span>
                      </div>
                    </div>
                    <div class="input-group input-group-sm mb-2">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                            <input type="checkbox" aria-label="Checkbox for following text input">
                        </span>
                        <span class="input-group-text">CASA DE LA CULTURA</span>
                      </div>
                    </div>
                    <div class="input-group input-group-sm mb-2">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                            <input type="checkbox" aria-label="Checkbox for following text input">
                        </span>
                        <span class="input-group-text">PISCINA MUNICIPAL PUNO</span>
                      </div>
                    </div>
                </form> 
            </div>
            <div class="card-footer">
                <small class="text-muted">Last updated 3 mins ago</small>
            </div>
        </div>
        <div class="card">
            <div class="card-header text-center"><strong>APLICACIONES Y ROLES</strong></div>
            <div class="card-body">
                <form id="form-aplicaciones-roles">
                    <div class="input-group input-group-sm mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="app-rol-1">Configuraciones</span>
                        </div>
                        <select class="form-control" aria-describedby="app-rol-1">
                          <option>Ninguno</option>
                          <option>Administrador</option>
                          <option>Asistente</option>
                        </select>
                        <small id="passwordHelpBlock" class="form-text text-muted col-md-12">
                          Sin permiso
                        </small>                        
                    </div>
                    <div class="input-group input-group-sm mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Arix Store</span>
                        </div>
                        <select class="form-control" aria-describedby="inputGroup-sizing-sm">
                          <option>Ninguno</option>
                          <option>Administrador</option>
                          <option>Asistente</option>
                        </select>
                        <small id="passwordHelpBlock" class="form-text text-muted col-md-12">
                          Sin permiso alguno
                        </small> 
                    </div>
                </form> 
            </div>
            <div class="card-footer">
                <small class="text-muted">Last updated 3 mins ago</small>
            </div>
        </div>
    </div>
</div>
<div class="col-xl-12 col-md-12 mt-2">
    <div class="alert alert-dark" role="alert">
        <code>
            <samp>> Última visita: cracion de usuario Uanes@gmail.com</samp>
            <p>> Por: Victor jhampier victorjhampier@gmail.com</p>
        </code>
    </div>
</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
    arixshell_cargar_ultimo_titulo('Nuevo');
    arixshell_cargar_idsec_unicos_byc("#btn_id_usuarios_nuevo","#con_id_usuarios_nuevo");
    arixshell_cargar_botones_menu('btn-guardar, btn-cerrar');
    //$('#form-usuario-sucursal #select-permiso').selectpicker();//inicializa la multiple seleccion
    $('.card').on("click", "#btn-probar-suc", function(){
        //var valores = ;
        //alert('caca');
        //$("#carneViewModal #carneViewForm").serialize()
        console.log($('form').serialize());
    });
    $(arixshell_descargar_idsec_unicos_byc(1)+' .card').on("click", "button", function() {//click unico en la página
        var a = $(this).closest('div').attr('id');
        alert('-> '+a);
    });
    $(arixshell_descargar_idsec_unicos_byc(0)).on("click", ".btn-cerrar", function() {
        arixshell_pagina_atras();
    });  
}); 
</script>