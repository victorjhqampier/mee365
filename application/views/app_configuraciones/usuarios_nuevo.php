<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="col-xl-12 col-md-12">
    <div class="card-group">
        <div class="card">
            <div class="card-header text-center"><strong>USUARIO Y PERMISOS</strong></div>
            <div class="card-body">
               <form id="form-usuario-sucursal">
                    <div class="form-group">
                        <label for="input-user">Nombre del empleado</label>
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control" placeholder="Nombre del empleado" aria-label="Recipient's username" aria-describedby="basic-addon2" id="input-user" name="txtUser">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button"><i class="fa fa-times"></i></button>
                                <button class="btn btn-outline-secondary" type="button"><i class="fa fa-ellipsis-h"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="user-id">Nombre del usuario</label>
                        <input type="text" class="form-control form-control-sm" id="user-id" name="textId" placeholder="Correo del empleado">
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
                <h5 class="card-title">Card title</h5>
                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
            </div>
            <div class="card-footer">
                <small class="text-muted">Last updated 3 mins ago</small>
            </div>
        </div>
        <div class="card">
            <div class="card-header text-center"><strong>APLICACIONES Y ROLES</strong></div>
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
            </div>
            <div class="card-footer">
                <small class="text-muted">Last updated 3 mins ago</small>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
    arix_cargar_ultimo_titulo('Nuevo');
    arixshell_cargar_botones_menu('btn-guardar, btn-cerrar');
    $('#form-usuario-sucursal #select-permiso').selectpicker();//inicializa la multiple seleccion
    $('.card').on("click", "#btn-probar-suc", function(){
        //var valores = ;
        //alert('caca');
        //$("#carneViewModal #carneViewForm").serialize()
        console.log($('form').serialize());
    });    
}); 
</script>